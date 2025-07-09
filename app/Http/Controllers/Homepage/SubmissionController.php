<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubmissionPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SubmissionController extends Controller
{
    // menampilkan daftar pengaduan
    public function index(Request $request): View
    {
        $submissionPosts = SubmissionPost::with(['comments', 'likes', 'submission.category'])
            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->search . '%')
                        ->orWhere('description', 'like', '%' . $request->search . '%');
                });
            })
            ->when($request->year, function ($query) use ($request) {
                $query->whereYear('created_at', $request->year);
            })
            ->when($request->month, function ($query) use ($request) {
                $monthNumber = \Carbon\Carbon::parse('1 ' . $request->month)->month;
                $query->whereMonth('created_at', $monthNumber);
            })
            ->when($request->category, function ($query) use ($request) {
                $query->whereHas('submission.category', function ($q) use ($request) {
                    $q->where('name', $request->category);
                });
            });

        if ($request->type === 'favorite') {
            $submissionPosts = $submissionPosts->withCount('likes')->orderByDesc('likes_count');
        } else {
            $submissionPosts = $submissionPosts->latest();
        }

        $submissionPosts = $submissionPosts->get();

        $years = DB::table('submission_posts')
            ->selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        return view('homepage.submission.index', [
            'title' => 'Halaman pengaduan',
            'submissionPosts' => $submissionPosts,
            'categories' => Category::all(),
            'years' => $years,
            'months' => $months,
            'filter' => $request,
        ]);
    }

    // menampilkan detail pengaduan
    public function show(int $id): View
    {
        $isLike = SubmissionPost::where('id', $id)
            ->whereHas('likes', function ($query) {
                $query->where('user_id', auth()->id());
            })->exists();

        return view('homepage.submission.detail', [
            'title' => 'Halaman Detail pengaduan',
            'submissionPost' => SubmissionPost::with(['comments.user.student', 'likes', 'submission.category'])->where('id', $id)->first(),
            'isLike' => $isLike,
        ]);
    }
}
