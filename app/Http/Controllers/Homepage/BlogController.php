<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    // menampilkan daftar blog
    public function index(Request $request): View
    {
        if ($request->search) {
            $blogs = Blog::where('title', 'like', "%$request->search%")
                ->latest()
                ->get();
        } else {
            $blogs = Blog::latest()->get();
        }

        return view('homepage.blog.index', [
            'title' => 'Halaman Blog',
            'blogs' => $blogs,
            'search' => $request->search,
        ]);
    }

    // menampilkan detail blog
    public function show(int $id): View
    {
        return view('homepage.blog.detail', [
            'title' => 'Halaman Detail Blog',
            'blog' => Blog::where('id', $id)->first(),
        ]);
    }
}
