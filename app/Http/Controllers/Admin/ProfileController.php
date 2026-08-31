<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil admin.
     */
    public function index()
    {
        return view('admin.profile.index', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Mengunggah dan menyimpan foto profil ke storage NAS.
     */
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $user = auth()->user();

        if ($request->hasFile('avatar')) {
            // Hapus file avatar lama jika ada di NAS
            if ($user->avatar && Storage::disk('nas')->exists($user->avatar)) {
                Storage::disk('nas')->delete($user->avatar);
            }

            // Simpan gambar baru ke folder avatars di disk nas
            $path = $request->file('avatar')->store('avatars', 'nas');
            $user->update(['avatar' => $path]);
        }

        $message = app()->getLocale() === 'id' 
            ? 'Foto profil berhasil diperbarui!' 
            : 'Profile photo updated successfully!';

        return back()->with('success', $message);
    }

    /**
     * Stream/Render foto dari storage NAS.
     */
    public function showAvatar()
    {
        $user = auth()->user();

        if (!$user->avatar || !Storage::disk('nas')->exists($user->avatar)) {
            abort(404);
        }

        return response()->file(Storage::disk('nas')->path($user->avatar));
    }
}