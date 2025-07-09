<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TimelineStoreRequest;
use App\Http\Requests\TimelineUpdateRequest;
use App\Models\Submission;
use App\Models\Timeline;

class TimelineController extends Controller
{
    // menampilkan daftar pengajuan timeline
    public function show(int $submission_id, int $timeline_id)
    {
        return view('dashboard.timeline.detail', [
            'title' => 'Halaman Detail Pengajuan Timeline',
            'submission' => Submission::with(['user', 'category', 'submission_post', 'timelines'])->where('id', $submission_id)->firstOrFail(),
            'timeline' => Timeline::where('id', $timeline_id)->firstOrFail(),
        ]);
    }

    // menampilkan halaman tambah pengajuan timeline
    public function create(int $submission_id)
    {
        return view('dashboard.timeline.create', [
            'title' => 'Halaman Tambah Pengajuan Timeline',
            'submission' => Submission::with(['user', 'category', 'submission_post', 'timelines'])->where('id', $submission_id)->firstOrFail(),
        ]);
    }

    // menyimpan timeline pengaduan dalam database
    public function store(TimelineStoreRequest $request, int $submission_id)
    {
        try {
            $submission = Submission::with(['user', 'category', 'submission_post', 'timelines'])->where('id', $submission_id)->firstOrFail();

            Timeline::create([
                'submission_id' => $request->submission_id,
                // 'title' => $request->title ?? null,
                'description' => $request->description ?? null,
                'status' => $request->status,
                'order' => $request->order,
                'created_at' => now('Asia/Makassar'),
            ]);

            return redirect(route('dashboard.submission.show', $submission))->with('success', 'Berhasil membuat pengajuan timeline!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('dashboard.submission.show', $submission))->with('failed', 'Gagal membuat pengajuan timeline!');
        }
    }

    // menampilkan halaman edit timeline pengaduan
    public function edit(int $submission_id, int $timeline_id)
    {
        return view('dashboard.timeline.edit', [
            'title' => 'Halaman Edit Pengajuan Timeline',
            'submission' => Submission::with(['user', 'category', 'submission_post', 'timelines'])->where('id', $submission_id)->firstOrFail(),
            'timeline' => Timeline::where('id', $timeline_id)->firstOrFail(),
        ]);
    }

    // mengupdate timeline pengaduan dalam database
    public function update(TimelineUpdateRequest $request, int $submission_id, int $timeline_id)
    {
        try {
            $submission = Submission::with(['user', 'category', 'submission_post', 'timelines'])->where('id', $submission_id)->firstOrFail();
            $timeline = Timeline::where('id', $timeline_id)->firstOrFail();

            $timeline->update([
                // 'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'order' => $request->order,
            ]);

            return redirect(route('dashboard.submission.show', $submission))->with('success', 'Berhasil mengedit pengajuan timeline!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('dashboard.submission.show', $submission))->with('failed', 'Gagal mengedit pengajuan timeline!');
        }
    }

    // menghapus timeline pengaduan dari database
    public function destroy(int $submission_id, int $timeline_id)
    {
        try {
            $submission = Submission::with(['user', 'category', 'submission_post', 'timelines'])->where('id', $submission_id)->firstOrFail();
            $timeline = Timeline::where('id', $timeline_id)->firstOrFail();
            $timeline->delete();

            return redirect(route('dashboard.submission.show', $submission))->with('success', 'Berhasil menghapus pengajuan timeline!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('dashboard.submission.show', $submission))->with('failed', 'Gagal menghapus pengajuan timeline!');
        }
    }
}
