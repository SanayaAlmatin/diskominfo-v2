<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TmKoordinatWifi;
use App\Support\WifiCoordinateNormalizer;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class WifiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('search')->trim()->value();

        $wifis = TmKoordinatWifi::select(['id', 'n_wilayah', 'ssid', 'latitude', 'longitude', 'kecepatan'])
            ->when($search, fn ($q) => $q->where(function ($q) use ($search) {
                $q->where('n_wilayah', 'like', "%{$search}%")
                  ->orWhere('ssid', 'like', "%{$search}%");
            }))
            ->orderBy('id', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('admin.wifi.index', compact('wifis', 'search'));
    }

    public function create()
    {
        return view('admin.wifi.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validatedPayload($request);

        TmKoordinatWifi::create($validated);

        return redirect()->route('admin.wifi.index')
            ->with('success', 'Data Titik WiFi berhasil ditambahkan.');
    }

    public function edit(TmKoordinatWifi $wifi)
    {
        $normalizedCoordinates = WifiCoordinateNormalizer::normalizeForStorage($wifi->latitude, $wifi->longitude);

        return view('admin.wifi.edit', compact('wifi', 'normalizedCoordinates'));
    }

    public function update(Request $request, TmKoordinatWifi $wifi)
    {
        $validated = $this->validatedPayload($request);

        $wifi->update($validated);

        return redirect()->route('admin.wifi.index')
            ->with('success', 'Data Titik WiFi berhasil diperbarui.');
    }

    public function destroy(TmKoordinatWifi $wifi)
    {
        $wifi->delete();

        return redirect()->route('admin.wifi.index')
            ->with('success', 'Data Titik WiFi berhasil dihapus.');
    }

    private function validatedPayload(Request $request): array
    {
        $validated = $request->validate([
            'n_wilayah' => ['required', 'string', 'max:100'],
            'latitude' => ['required', 'string', 'max:32'],
            'longitude' => ['required', 'string', 'max:32'],
            'keterangan' => ['nullable', 'string'],
            'kecepatan' => ['nullable', 'string', 'max:255'],
            'ssid' => ['nullable', 'string', 'max:255'],
        ]);

        $coordinates = WifiCoordinateNormalizer::normalizeForStorage(
            $validated['latitude'],
            $validated['longitude'],
        );

        if ($coordinates === null) {
            throw ValidationException::withMessages([
                'latitude' => 'Koordinat latitude dan longitude tidak valid.',
                'longitude' => 'Koordinat latitude dan longitude tidak valid.',
            ]);
        }

        return array_merge($validated, $coordinates);
    }
}
