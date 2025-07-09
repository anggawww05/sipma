<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\View\View;

class ProfileController extends Controller
{
    //function untuk menampilkan halaman profil
    public function index(): View
    {
        return view('homepage.profile.index', [
            'title' => 'Halaman Profil',
        ]);
    }

    //function untuk menampilkan halaman edit profil
    public function edit(): View
    {
        return view('homepage.profile.edit', [
            'title' => 'Halaman Edit Profil',
        ]);
    }

    //function untuk mengupdate data profile
    public function update(ProfileUpdateRequest $request)
    {
        try {
            $imagePath = null;
            if ($request->hasFile('image_path')) {
                $image = $request->file('image_path');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('student', $imageName, 'public');
            }

            auth()->user()->update([
                'username' => $request->username,
                'email' => $request->email,
            ]);

            if ($request->password) {
                auth()->user()->update(['password' => bcrypt($request->password)]);
            }

            auth()->user()->student->update([
                'image_path' => $imagePath,
                'full_name' => $request->full_name,
                'phone_number' => $request->phone_number,
                'study_program' => $request->study_program,
                'nim' => $request->nim,
            ]);

            return redirect(route('profile.index'))->with('failed', 'Berhasil mengedit profil!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('profile.index'))->with('failed', 'Gagal mengedit profil!');
        }
    }
}
