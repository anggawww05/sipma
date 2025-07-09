<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Http\Requests\LikeStoreRequest;
use App\Models\Like;

class LikeController extends Controller
{
    // menyimpan atau menghapus like pada postingan
    public function store(LikeStoreRequest $request)
    {
        try {
            $like = Like::where('user_id', $request->user_id)->where('submission_post_id', $request->submission_post_id)->first();
            if (!is_null($like)) {
                $like->delete();
                return redirect()->back()->with('success', 'Berhasil hapus menyukai postingan ini!');
            } else {
                Like::create($request->validated());
                return redirect()->back()->with('success', 'Berhasil menyukai postingan ini!');
            }
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menyukai postingan ini!');
        }
    }
}
