<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    // menampilkan halaman login
    public function index(): View
    {
        return view('auth.login', [
            'title' => 'Halaman Login'
        ]);
    }

    // menyimpan data login
    public function store(LoginStoreRequest $request)
    {
        try {
            if (Auth::attempt($request->validated())) {
                $request->session()->regenerate();
                if (auth()->user()->student_id) {
                    return redirect(route('main.index'));
                }
                return redirect(route('dashboard.index'));
            }
            return redirect(route('login.index'))->with('failed', 'Email atau Password tidak ditemukan!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('login.index'))->with('failed', 'Gagal melakukan login!');
        }
    }

    // menghapus session dan melakukan logout
    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login.index')->with('success', 'Berhasil melakukan logout!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->route('login.index')->with('success', 'Gagal melakukan logout!');
        }
    }
}
