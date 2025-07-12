<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Halaman Kontak Operator';
        // Ambil user yang memiliki operator_id tidak null
        $users = User::whereNotNull('operator_id')->get();
        return view('homepage.contact.index', compact('users', 'title'));
    }
}
