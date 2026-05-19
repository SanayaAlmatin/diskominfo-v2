<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TmKoordinatWifi;
use Illuminate\Http\Request;

class WifiController extends Controller
{
    public function index()
    {
        $wifis = TmKoordinatWifi::orderBy('id', 'desc')->paginate(10);
        return view('admin.wifi.index', compact('wifis'));
    }

    public function create()
    {
        return view('admin.wifi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'n_wilayah'  => 'required|string|max:100',
            'latitude'   => 'required|string|max:20',
            'longitude'  => 'required|string|max:20',
            'keterangan' => 'nullable|string',
            'kecepatan'  => 'nullable|string|max:255',
            'ssid'       => 'nullable|string|max:255',
        ]);

        TmKoordinatWifi::create($validated);

        return redirect()->route('admin.wifi.index')
            ->with('success', 'Data Titik WiFi berhasil ditambahkan.');
    }

    public function edit(TmKoordinatWifi $wifi)
    {
        return view('admin.wifi.edit', compact('wifi'));
    }

    public function update(Request $request, TmKoordinatWifi $wifi)
    {
        $validated = $request->validate([
            'n_wilayah'  => 'required|string|max:100',
            'latitude'   => 'required|string|max:20',
            'longitude'  => 'required|string|max:20',
            'keterangan' => 'nullable|string',
            'kecepatan'  => 'nullable|string|max:255',
            'ssid'       => 'nullable|string|max:255',
        ]);

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
}
