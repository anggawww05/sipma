<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    // menyimpan komentar dalam database
    public function store(CommentStoreRequest $request)
    {
        try {
            Comment::create($request->validated());
            return redirect()->back()->with('success', 'Berhasil membuat komentar!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal membuat komentar!');
        }
    }
}
