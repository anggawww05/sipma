@extends('layout.dashboard')

@section('content')
    @if (session()->has('failed'))
        <div class="mb-[16px] w-full text-[0.913rem] text-red-400 bg-red-400/[0.08] p-3 rounded-[3px]" role="alert">
            {{ session('failed') }}
        </div>
    @endif
    <form action="{{ route('dashboard.submission.update', $submission) }}" method="POST"
        class="grid lg:grid-cols-2 gap-3 p-4 rounded-[4px] border border-[#0d1117]/[0.12]" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="lg:col-span-2">
            <label for="image_path" class="block text-sm font-medium">Foto Pengajuan</label>
            <div class="wrapper mt-2 flex items-end gap-[6px]">
                <img id="image-preview"
                    src="{{ $submission->image_path ? asset('storage/' . $submission->image_path) : 'https://placehold.co/400x400?text=Image+Not+Found' }}"
                    alt="Foto Pengajuan"
                    class="w-[100px] aspect-square rounded-[4px] object-cover border border-[#0d1117]/[0.12]">
                <input type="file" name="image_path" id="image-input">
            </div>
            @error('image_path')
                <p class="message-error text-red-600 mt-1 text-[0.875rem]">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="title" class="block text-sm font-medium">Judul</label>
            <input type="text" id="title" name="title" placeholder="Masukkan judul pengajuan..."
                value="{{ $submission->title }}"
                class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" required>
            @error('title')
                <p class="message-error text-red-600 mt-1 text-[0.875rem]">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="category_id" class="block text-sm font-medium">Kategori</label>
            <select id="category_id" name="category_id"
                class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" required>
                @if (auth()->user()->operator)
                    @foreach ($categories as $category)
                        @if (auth()->user()->operator->type === $category->name)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                @else
                    <option value="">Pilih kategori pengajuan...</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected($category->id === $submission->category_id)>{{ $category->name }}</option>
                    @endforeach
                @endif
            </select>
            @error('category_id')
                <p class="message-error text-red-600 mt-1 text-[0.875rem]">{{ $message }}</p>
            @enderror
        </div>
        <div class="lg:col-span-2">
            <label for="available" class="block text-sm font-medium">Status Publish</label>
            <select id="available" name="available"
                class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" required>
                <option value="public" @selected($submission->available === 'public')>Public</option>
                <option value="private" @selected($submission->available === 'private')>Private</option>
            </select>
            @error('available')
                <p class="message-error text-red-600 mt-1 text-[0.875rem]">{{ $message }}</p>
            @enderror
        </div>
        <div class="lg:col-span-2">
            <label for="description" class="block text-sm font-medium">Konten</label>
            <textarea id="description" name="description" placeholder="Masukkan konten pengajuan..."
                class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" required
                rows="6">{{ $submission->description }}</textarea>
            @error('description')
                <p class="message-error text-red-600 mt-1 text-[0.875rem]">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="estimated_date" class="block text-sm font-medium">Estimasi Selesai</label>
            <input type="date" id="estimated_date" name="estimated_date"
                value="{{ $submission->estimated_date ? $submission->estimated_date->format('Y-m-d') : '' }}"
                class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" required>
            @error('estimated_date')
                <p class="message-error text-red-600 mt-1 text-[0.875rem]">{{ $message }}</p>
            @enderror
        </div>
        <div class="wrapper lg:col-span-2 flex items-center gap-[6px]">
            <button type="submit"
                class="cursor-pointer text-nowrap bg-[#A91D3A] hover:bg-[#CA3453] text-white p-3 rounded-[4px] focus:outline-none text-[0.875rem] border w-fit">
                Simpan Perubahan
            </button>
            <a href="{{ route('dashboard.submission.index') }}"
                class="bg-transparent hover:bg-[#0d1117]/[0.04] text-[#0d1117] p-3 rounded-[4px] focus:outline-none text-[0.875rem] border border-[#0d1117]/[0.12] hover:border-[#0d1117]/[0.24] w-fit">
                Batal Edit
            </a>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('image-input');
            const preview = document.getElementById('image-preview');
            input.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
