<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogStoreRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BlogController extends Controller
{
    // menampilkan daftar blog
    public function index(Request $request): View
    {
        if ($request->search) {
            $blogs = Blog::where('title', 'like', "%$request->search%")
                ->orWhere('description', 'like', "%$request->search%")
                ->orWhereHas('user', function ($query) use ($request) {
                    $query->where('username', 'like', "%$request->search%")
                        ->where('email', 'like', "%$request->search%");
                })
                ->latest()
                ->get();
        } else {
            $blogs = Blog::latest()->get();
        }
        return view('dashboard.blog.index', [
            'title' => 'Halaman Blog',
            'blogs' => $blogs,
            'search' => $request->search,
        ]);
    }

    // menampilkan detail blog
    public function show(int $id): View
    {
        return view('dashboard.blog.detail', [
            'title' => 'Halaman Detail Blog',
            'blog' => Blog::with('user')->where('id', $id)->firstOrFail(),
        ]);
    }

    // menampilkan halamana tambah blog
    public function create(): View
    {
        return view('dashboard.blog.create', [
            'title' => 'Halaman Tambah Blog',
        ]);
    }

    // menyimpan blog dalam database
    public function store(BlogStoreRequest $request)
    {
        try {
            $imagePath = null;
            if ($request->hasFile('image_path')) {
                $image = $request->file('image_path');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('blog', $imageName, 'public');
            }

            Blog::create([
                'image_path' => $imagePath,
                'user_id' => $request->user_id,
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return redirect(route('dashboard.blog.index'))->with('success', 'Berhasil membuat blog!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('dashboard.blog.index'))->with('failed', 'Gagal membuat blog!');
        }
    }

    // menampilakn detail edit blog
    public function edit(int $id): View
    {
        return view('dashboard.blog.edit', [
            'title' => 'Halaman Edit Blog',
            'blog' => Blog::with('user')->where('id', $id)->firstOrFail(),
        ]);
    }

    // mengupdate blog dalam database
    public function update(BlogUpdateRequest $request, int $id)
    {
        try {
            $blog = Blog::with('user')->where('id', $id)->firstOrFail();
            $imagePath = $blog->image_path;

            if ($request->hasFile('image_path')) {
                if ($blog->image_path && Storage::disk('public')->exists($blog->image_path)) {
                    Storage::disk('public')->delete($blog->image_path);
                }

                $image = $request->file('image_path');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('blog', $imageName, 'public');
            }

            $blog->update([
                'image_path' => $imagePath,
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return redirect(route('dashboard.blog.index'))->with('success', 'Berhasil mengedit blog!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('dashboard.blog.index'))->with('failed', 'Gagal mengedit blog!');
        }
    }

    // menghapus blog dari database
    public function destroy(int $id)
    {
        try {
            $blog = Blog::with('user')->where('id', $id)->firstOrFail();

            if ($blog->image_path && Storage::disk('public')->exists($blog->image_path)) {
                Storage::disk('public')->delete($blog->image_path);
            }

            $blog->delete();

            return redirect(route('dashboard.blog.index'))->with('success', 'Berhasil menghapus blog!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('dashboard.blog.index'))->with('failed', 'Gagal menghapus blog!');
        }
    }
}
