<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportPostUpdateRequest;
use App\Models\SubmissionPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SubmissionPostController extends Controller
{
    // menampilkan daftar postingan pengaduan
    public function index(Request $request): View
    {
        $query = SubmissionPost::with(['submission.user', 'submission.category']);

        if (auth()->user()->operator_id) {
            $operatorType = auth()->user()->operator->type ?? null;
            if ($operatorType) {
                $query->whereHas('submission.category', function ($q) use ($operatorType) {
                    $q->where('name', $operatorType);
                });
            }
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
            });
        }

        $submissionPosts = $query->latest()->get();

        return view('dashboard.submission-post.index', [
            'title' => 'Halaman Pengajuan Posting',
            'submissionPosts' => $submissionPosts,
            'search' => $request->search,
        ]);
    }

    // menampilkan detail postingan pengaduan
    public function show(int $id): View
    {
        return view('dashboard.submission-post.detail', [
            'title' => 'Halaman Detail Pengajuan Posting',
            'submissionPost' => SubmissionPost::with(['submission.user', 'submission.category'])->where('id', $id)->firstOrFail(),
        ]);
    }

    // menampilkan halaman tambah pengajuan posting
    public function edit(int $id): View
    {
        return view('dashboard.submission-post.edit', [
            'title' => 'Halaman Edit Pengajuan Posting',
            'submissionPost' => SubmissionPost::with(['submission.user', 'submission.category'])->where('id', $id)->firstOrFail(),
        ]);
    }

    // menyimpan pengajuan posting dalam database
    public function update(ReportPostUpdateRequest $request, int $id)
    {
        try {
            $submissionPost = SubmissionPost::with(['submission.user', 'submission.category'])->where('id', $id)->firstOrFail();
            $imagePath = $submissionPost->image_path;

            if ($request->hasFile('image_path')) {
                if ($submissionPost->image_path && Storage::disk('public')->exists($submissionPost->image_path)) {
                    Storage::disk('public')->delete($submissionPost->image_path);
                }

                $image = $request->file('image_path');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('submission-post', $imageName, 'public');
            }

            $submissionPost->update([
                'image_path' => $imagePath,
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return redirect(route('dashboard.submission-post.index'))->with('success', 'Berhasil mengedit pengajuan posting!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('dashboard.submission-post.index'))->with('failed', 'Gagal mengedit pengajuan posting!');
        }
    }

    // menghapus pengajuan posting dari database
    public function destroy(int $id)
    {
        try {
            $submissionPost = SubmissionPost::with(['submission.user', 'submission.category'])->where('id', $id)->firstOrFail();
            $submissionPost->submission->update([
                'available' => 'private'
            ]);

            if ($submissionPost->image_path && Storage::disk('public')->exists($submissionPost->image_path)) {
                Storage::disk('public')->delete($submissionPost->image_path);
            }

            $submissionPost->delete();

            return redirect(route('dashboard.submission-post.index'))->with('success', 'Berhasil menghapus pengajuan posting!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('dashboard.submission-post.index'))->with('success', 'Gagal menghapus pengajuan posting!');
        }
    }
}
