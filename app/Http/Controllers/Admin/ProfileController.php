<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TmNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Calculate article stats
        $totalArtikel = TmNews::where('author_id', $user->id)->count();
        $dipublikasikan = TmNews::where('author_id', $user->id)->where('status', 1)->count();
        $menunggu = TmNews::where('author_id', $user->id)->where('status', 0)->count();

        return view('admin.profile.index', compact('user', 'totalArtikel', 'dipublikasikan', 'menunggu'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'nama'      => ['required', 'string', 'max:255'],
            'username'  => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'no_telp'   => ['nullable', 'string', 'max:20'],
            'instansi'  => ['nullable', 'string', 'max:255'],
            'alamat'    => ['nullable', 'string'],
            'photo'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
        ]);

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $data['photo'] = $request->file('photo')->store('users', 'public');
        }

        $user->update($data);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function destroyPhoto()
    {
        $user = auth()->user();

        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
            $user->update(['photo' => null]);
            return back()->with('success', 'Foto profil berhasil dihapus.');
        }

        return back();
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password berhasil diubah.');
    }
}
