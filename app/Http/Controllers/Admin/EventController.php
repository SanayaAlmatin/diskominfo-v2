<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TmEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TmEvent::query();

        // Filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('label', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->filled('label')) {
            $query->where('label', $request->label);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status == 'aktif' ? 1 : 0);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('start_date', [$request->start_date, $request->end_date]);
        }

        $events = $query->orderBy('start_date', 'desc')->paginate(10);
        $events->appends($request->all());

        // Stats
        $now = Carbon::now()->toDateString();
        $totalEvent = TmEvent::count();
        $aktifEvent = TmEvent::where('is_active', 1)->count();
        $akanDatangEvent = TmEvent::where('start_date', '>', $now)->count();
        $selesaiEvent = TmEvent::where('end_date', '<', $now)->orWhere(function($q) use ($now) {
            $q->whereNull('end_date')->where('start_date', '<', $now);
        })->count();
        $bulanIniEvent = TmEvent::whereMonth('start_date', Carbon::now()->month)
                               ->whereYear('start_date', Carbon::now()->year)
                               ->count();

        // Get unique labels for filter
        $labels = TmEvent::select('label')->distinct()->pluck('label');

        return view('admin.events.index', compact(
            'events', 
            'totalEvent', 
            'aktifEvent', 
            'akanDatangEvent', 
            'selesaiEvent', 
            'bulanIniEvent',
            'labels'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $labels = TmEvent::select('label')->distinct()->pluck('label');
        return view('admin.events.create', compact('labels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $data = $request->except(['image']);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $data['image'] = $path;
        }

        TmEvent::create($data);

        return redirect()->route('events.index')->with('success', 'Event berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TmEvent $event)
    {
        return view('admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TmEvent $event)
    {
        $labels = TmEvent::select('label')->distinct()->pluck('label');
        return view('admin.events.edit', compact('event', 'labels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TmEvent $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $data = $request->except(['image']);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }
            $path = $request->file('image')->store('events', 'public');
            $data['image'] = $path;
        }

        $event->update($data);

        return redirect()->route('events.index')->with('success', 'Event berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TmEvent $event)
    {
        if ($event->image && Storage::disk('public')->exists($event->image)) {
            Storage::disk('public')->delete($event->image);
        }
        
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus.');
    }
}
