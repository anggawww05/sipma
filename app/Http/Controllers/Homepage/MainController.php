<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class MainController extends Controller
{
    // menampilkan halaman beranda
    public function index(): View
    {
        return view('homepage.index', [
            'title' => 'Halaman Beranda',
        ]);
    }
}
