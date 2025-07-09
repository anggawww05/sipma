<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileSubmissionStoreRequest;
use App\Http\Requests\ProfileSubmissionUpdateRequest;
use App\Models\Category;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileSubmissionController extends Controller
{
    // menampilkan daftar pengaduan mahasiswa
    public function index(Request $request): View
    {
        if ($request->search) {
            $submissions = Submission::with(['user', 'category', 'submission_post',])
                ->where('user_id', auth()->user()->id)
                ->where('ticket_number', 'like', "%$request->search%")
                ->orWhere('title', 'like', "%$request->search%")
                ->orWhere('description', 'like', "%$request->search%")
                ->orWhere('status', 'like', "%$request->search%")
                ->orWhere('available', 'like', "%$request->search%")
                ->orWhereHas('user', function ($query) use ($request) {
                    $query->where('username', 'like', "%$request->search%")
                        ->where('email', 'like', "%$request->search%");
                })->orWhereHas('category', function ($query) use ($request) {
                    $query->where('name', 'like', "%$request->search%");
                })
                ->latest()
                ->get();
        } else {
            $submissions = Submission::with(['user', 'category', 'submission_post'])
                ->where('user_id', auth()->user()->id)
                ->latest()
                ->get();
        }

        return view('homepage.profile-submission.index', [
            'title' => 'Halaman pengaduan Saya',
            'submissions' => $submissions,
            'search' => $request->search,
        ]);
    }

    // menampilkan detail pengaduan
    public function show(int $id)
    {
        return view('homepage.profile-submission.show', [
            'title' => 'Halaman Detail pengaduan',
            'submission' => Submission::where('id', $id)->first(),
        ]);
    }

    // menampilkan halaman tambah pengaduan
    public function create()
    {
        return view('homepage.profile-submission.create', [
            'title' => 'Halaman Tambah pengaduan',
            'categories' => Category::all(),
        ]);
    }

    // menyimpan pengaduan dalam database
    public function store(ProfileSubmissionStoreRequest $request)
    {
        try {
            $imagePath = null;
            if ($request->hasFile('image_path')) {
                $image = $request->file('image_path');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('submission', $imageName, 'public');
            }

            $submission = Submission::create([
                'image_path' => $imagePath,
                'user_id' => $request->user_id,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'description' => $request->description,
            ]);

            $ticketNumber = substr(strtoupper(Str::of(Category::findOrFail($request->category_id)->name)->before(' ')), 0, 3) . '-' . $submission->id;
            $submission->update(['ticket_number' => $ticketNumber]);

            return redirect()->back()->with('success', 'Berhasil membuat pengaduan!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('profile-submission.index'))->with('failed', 'Gagal membuat pengaduan!');
        }
    }

    // menampilkan halaman edit pengaduan
    public function edit(int $id)
    {
        return view('homepage.profile-submission.edit', [
            'title' => 'Halaman Survey pengaduan',
            'submission' => Submission::where('id', $id)->first(),
        ]);
    }

    // mengupdate pengaduan dalam database
    public function update(ProfileSubmissionUpdateRequest $request, int $id)
    {
        try {
            $submission = Submission::with(['user', 'category', 'submission_post'])->where('id', $id)->firstOrFail();
            $submission->update(['survey' => $request->survey]);
            return redirect(route('profile-submission.index'))->with('success', 'Berhasil menambahkan survey pengaduan!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('profile-submission.index'))->with('success', 'Gagal menambahkan survey pengaduan!');
        }
    }

    // mengubah status pengaduan menjadi pending
    public function destroy(int $id)
    {
        try {
            $submission = Submission::with(['user', 'category', 'submission_post'])->where('id', $id)->firstOrFail();
            $submission->update(['status' => 'pending']);
            return redirect(route('profile-submission.index'))->with('success', 'Berhasil mengubah status pengaduan!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('profile-submission.index'))->with('success', 'Gagal mengubah status pengaduan!');
        }
    }
}
