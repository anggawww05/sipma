<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class StudentController extends Controller
{
    // menampilkan daftar siswa
    public function index(Request $request): View
    {
        if ($request->search) {
            $students = Student::where('full_name', 'like', "%$request->search%")
                ->orWhere('phone_number', 'like', "%$request->search%")
                ->orWhere('study_program', 'like', "%$request->search%")
                ->orWhere('nim', 'like', "%$request->search%")
                ->orWhereHas('user', function ($query) use ($request) {
                    $query->where('username', 'like', "%$request->search%")
                        ->where('email', 'like', "%$request->search%");
                })
                ->latest()
                ->get();
        } else {
            $students = Student::latest()->get();
        }
        return view('dashboard.student.index', [
            'title' => 'Halaman Siswa',
            'students' => $students,
            'search' => $request->search,
        ]);
    }

    // menampilkan detail siswa
    public function show(int $id): View
    {
        return view('dashboard.student.detail', [
            'title' => 'Halaman Detail Siswa',
            'student' => Student::with('user')->where('id', $id)->firstOrFail(),
        ]);
    }

    // menampilkan halaman tambah siswa
    public function create(): View
    {
        return view('dashboard.student.create', [
            'title' => 'Halaman Tambah Siswa',
        ]);
    }

    // menyimpan siswa dalam database
    public function store(StudentStoreRequest $request)
    {
        try {
            $imagePath = null;
            if ($request->hasFile('image_path')) {
                $image = $request->file('image_path');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('student', $imageName, 'public');
            }

            $student = Student::create([
                'image_path' => $imagePath,
                'full_name' => $request->full_name,
                'phone_number' => $request->phone_number,
                'study_program' => $request->study_program,
                'nim' => $request->nim,
            ]);
            User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'student_id' => $student->id,
            ]);

            return redirect(route('dashboard.student.index'))->with('success', 'Berhasil membuat akun siswa!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('dashboard.student.index'))->with('failed', 'Gagal membuat akun siswa!');
        }
    }

    // menampilkan detail edit siswa
    public function edit(int $id): View
    {
        return view('dashboard.student.edit', [
            'title' => 'Halaman Edit Siswa',
            'student' => Student::with('user')->where('id', $id)->firstOrFail(),
        ]);
    }

    // mengupdate siswa dalam database
    public function update(StudentUpdateRequest $request, int $id)
    {
        try {
            $student = Student::with('user')->where('id', $id)->firstOrFail();
            $imagePath = $student->image_path;

            if ($request->hasFile('image_path')) {
                if ($student->image_path && Storage::disk('public')->exists($student->image_path)) {
                    Storage::disk('public')->delete($student->image_path);
                }

                $image = $request->file('image_path');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('student', $imageName, 'public');
            }

            $student->update([
                'image_path' => $imagePath,
                'full_name' => $request->full_name,
                'phone_number' => $request->phone_number,
                'study_program' => $request->study_program,
                'nim' => $request->nim,
            ]);
            $student->user->update([
                'username' => $request->username,
                'email' => $request->email,
            ]);
            if ($request->password) {
                $student->user->update([
                    'password' => bcrypt($request->password)
                ]);
            }

            return redirect(route('dashboard.student.index'))->with('success', 'Berhasil mengedit akun siswa!');
        } catch(\Exception $e) {
            logger($e->getMessage());
            return redirect(route('dashboard.student.index'))->with('failed', 'Gagal mengedit akun siswa!');
        }
    }

    // menghapus siswa dari database
    public function destroy(int $id)
    {
        try {
            $student = Student::with('user')->where('id', $id)->firstOrFail();

            if ($student->image_path && Storage::disk('public')->exists($student->image_path)) {
                Storage::disk('public')->delete($student->image_path);
            }

            $student->user->delete();
            $student->delete();

            return redirect(route('dashboard.student.index'))->with('success', 'Berhasil menghapus akun siswa!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('dashboard.student.index'))->with('failed', 'Gagal menghapus akun siswa!');
        }
    }
}
