@extends('layout.dashboard')

@section('content')
    @if(session()->has('failed'))
        <div class="mb-[16px] w-full text-[0.913rem] text-red-400 bg-red-400/[0.08] p-3 rounded-[3px]"
             role="alert">
            {{ session('failed') }}
        </div>
    @endif
    <form action="{{ route('dashboard.blog.update', $blog) }}" method="POST" class="grid lg:grid-cols-2 gap-3 p-4 rounded-[4px] border border-[#0d1117]/[0.12]" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="lg:col-span-2">
            <label for="image_path" class="block text-sm font-medium">Foto Blog</label>
            <div class="wrapper mt-2 flex items-end gap-[6px]">
                <img id="image-preview" src="{{ $blog->image_path ? asset('storage/' . $blog->image_path) : 'https://placehold.co/400x400?text=Image+Not+Found' }}" alt="Foto Blog" class="w-[100px] aspect-square rounded-[4px] object-cover border border-[#0d1117]/[0.12]">
                <input type="file" name="image_path" id="image-input">
            </div>
            @error('image_path')
            <p class="message-error text-red-600 mt-1 text-[0.875rem]">{{ $message }}</p>
            @enderror
        </div>
        <div class="lg:col-span-2">
            <label for="title" class="block text-sm font-medium">Judul</label>
            <input type="text" id="title" name="title" placeholder="Masukkan judul blog..." value="{{ $blog->title }}" class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" required>
            @error('title')
            <p class="message-error text-red-600 mt-1 text-[0.875rem]">{{ $message }}</p>
            @enderror
        </div>
        <div class="lg:col-span-2">
            <label for="description" class="block text-sm font-medium">Konten</label>
            <textarea rows="6" id="description" name="description" placeholder="Masukkan konten blog..." class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" required>{{ $blog->description }}</textarea>
            @error('description')
            <p class="message-error text-red-600 mt-1 text-[0.875rem]">{{ $message }}</p>
            @enderror
        </div>
        <div class="wrapper lg:col-span-2 flex items-center gap-[6px]">
            <button type="submit" class="cursor-pointer text-nowrap bg-[#A91D3A] hover:bg-[#CA3453] text-white p-3 rounded-[4px] focus:outline-none text-[0.875rem] border w-fit">
                Simpan Perubahan
            </button>
            <a href="{{ route('dashboard.blog.index') }}" class="bg-transparent hover:bg-[#0d1117]/[0.04] text-[#0d1117] p-3 rounded-[4px] focus:outline-none text-[0.875rem] border border-[#0d1117]/[0.12] hover:border-[#0d1117]/[0.24] w-fit">
                Batal Edit
            </a>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('image-input');
            const preview = document.getElementById('image-preview');
            input.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
