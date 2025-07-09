<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileDashboardUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    // menampilkan halaman profil
    public function show(): View
    {
        return view('dashboard.profile.detail', [
            'title' => 'Halaman Detail Profil',
            'profile' => auth()->user()->hasRole() === 'admin' ? auth()->user()->admin : auth()->user()->operator,
        ]);
    }

    // menampilkan halaman edit profil
    public function edit(): View
    {
        return view('dashboard.profile.edit', [
            'title' => 'Halaman Edit Profil',
            'profile' => auth()->user()->hasRole() === 'admin' ? auth()->user()->admin : auth()->user()->operator,
        ]);
    }

    // mengupdate profil dalam database
    public function update(ProfileDashboardUpdateRequest $request)
    {
        try {
            $profile = auth()->user()->hasRole() === 'admin' ? auth()->user()->admin : auth()->user()->operator;
            $imagePath = $profile->image_path;

            if ($request->hasFile('image_path')) {
                if ($profile->image_path && Storage::disk('public')->exists($profile->image_path)) {
                    Storage::disk('public')->delete($profile->image_path);
                }

                $image = $request->file('image_path');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs(auth()->user()->hasRole(), $imageName, 'public');
            }

            $profile->user->update([
                'username' => $request->username,
                'email' => $request->email,
            ]);

            if ($request->email) $profile->user->update(['password' => bcrypt($request->password)]);

            $profile->update([
                'image_path' => $imagePath,
                'full_name' => $request->full_name,
                'phone_number' => $request->phone_number
            ]);

            if (auth()->user()->operator_id) $profile->update(['type' => $request->type]);

            return redirect(route('dashboard.profile.show'))->with('success', 'Berhasil mengedit akun profil!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('dashboard.profile.show'))->with('failed', 'Gagal mengedit akun profil!');
        }
    }
}
