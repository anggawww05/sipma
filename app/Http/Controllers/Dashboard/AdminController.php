<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    // menampilkan daftar admin
    public function index(Request $request): View
    {
        if ($request->search) {
            $admins = Admin::where('full_name', 'like', "%$request->search%")
                ->orWhere('phone_number', 'like', "%$request->search%")
                ->orWhereHas('user', function ($query) use ($request) {
                    $query->where('username', 'like', "%$request->search%")
                        ->where('email', 'like', "%$request->search%");
                })
                ->latest()
                ->get();
        } else {
            $admins = Admin::latest()->get();
        }
        return view('dashboard.admin.index', [
            'title' => 'Halaman Admin',
            'admins' => $admins,
            'search' => $request->search,
        ]);
    }

    // menampilkan detail admin
    public function show(int $id): View
    {
        return view('dashboard.admin.detail', [
            'title' => 'Halaman Detail Admin',
            'admin' => Admin::with('user')->where('id', $id)->firstOrFail(),
        ]);
    }
}
