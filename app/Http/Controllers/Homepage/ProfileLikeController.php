<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\SubmissionPost;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileLikeController extends Controller
{
    // menampilkan daftar pengajuan yang disukai oleh mahasiswa
    public function index(Request $request): View
    {
        if ($request->search) {
            $submissionPosts = SubmissionPost::with('likes')
                ->whereHas('likes', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                })->where('title', 'like', "%$request->search%")
                ->latest()
                ->get();
        } else {
            $submissionPosts = SubmissionPost::with('likes')
                ->whereHas('likes', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                })
                ->latest()
                ->get();
        }

        return view('homepage.profile-like.index', [
            'title' => 'Halaman Pengajuan Disukai',
            'submission_posts' => $submissionPosts,
            'search' => $request->search,
        ]);
    }
}
