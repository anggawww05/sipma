<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStoreRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\View\View;

class RegisterController extends Controller
{
    // menampilkan halaman register
    public function index(): View
    {
        return view('auth.register', [
            'title' => 'Halaman Register'
        ]);
    }

    // menyimpan data register
    public function store(RegisterStoreRequest $request)
    {
        try {
            $student = Student::create();
            User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'student_id' => $student->id,
            ]);
            return redirect(route('login.index'))->with('success', 'Berhasil mendaftar akun siswa!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('register.index'))->with('failed', 'Gagal mendaftar akun siswa!');
        }
    }
}
