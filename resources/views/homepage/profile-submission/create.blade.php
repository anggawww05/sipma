@extends('layout.main')

@section('content')
    <section class="p-6 w-screen h-full">
        <div class="mt-20 max-w-[1000px] mx-auto flex flex-col gap-3">
            @if (session()->has('success'))
                <div class="flex items-center justify-center min-h-[60vh]">
                    <div class="border border-[#0d1117]/[0.12] rounded-[12px] shadow-lg bg-white p-8 max-w-md w-full">
                        <div class="flex flex-col items-center gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"
                                    fill="none" />
                                <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2l4-4" />
                            </svg>
                            <h2 class="text-2xl font-semibold text-gray-800 text-center">Pengaduan Berhasil Dikirim!</h2>
                            <p class="text-gray-600 text-center">Admin akan meninjau pengaduan anda selama <span
                                    class="font-semibold">1x24 jam</span>.</p>
                            <a href="{{ route('profile-submission.index') }}"
                                class="inline-block w-full py-2 px-4 bg-[#141414] text-white rounded-lg hover:bg-[#2B2B2B] transition-colors duration-200 text-center mt-4">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex justify-between items-center ">
                    <a href="{{ route('profile-submission.index') }}"
                        class="inline-flex items-center py-1 px-4 rounded-lg bg-[#141414] hover:bg-[#2B2B2B] text-white text-[16px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali
                    </a>
                </div>
                @if (session()->has('failed'))
                    <div class="mb-[16px] w-full text-[0.913rem] text-red-400 bg-red-400/[0.08] p-3 rounded-[3px]"
                        role="alert">
                        {{ session('failed') }}
                    </div>
                @endif
                <form action="{{ route('profile-submission.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <div class=" bg-white rounded-lg shadow-md p-4  border-1 border-gray-300 flex flex-col gap-1 ">
                        <h1 class="flex justify-center text-[20px] font-semibold">Formulir Pengaduan Akademik</h1>
                        <div class="p-6 flex flex-col gap-4">
                            <label for="category_id">Kategori<span class="text-red-500">*</span>
                                <select name="category_id" id="category_id"
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#141414] mt-1">
                                    <option value="" disabled selected>Pilih kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </label>
                            <div class="flex flex-col gap-1">
                                <label for="title" class="text-[16px]">Judul <span class="text-red-500">*</span></label>
                                <input type="text" name="title" id="title"
                                    placeholder="Masukkan judul pengaduan..."
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#141414]">
                                @error('title')
                                    <p class="message-error text-red-600 mt-1 text-[0.875rem]">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex flex-col gap-1">
                                <label for="description" class="text-[16px]">Deskripsi <span
                                        class="text-red-500">*</span></label>
                                <textarea name="description" id="description" placeholder="Masukkan deskripsi pengaduan..."
                                    class="w-full h-48 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#141414]"></textarea>
                                @error('description')
                                    <p class="message-error text-red-600 mt-1 text-[0.875rem]">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex flex-col gap-1">
                                <label for="image_path" class="text-[16px]">Bukti Foto <span
                                        class="text-red-500">*</span></label>
                                <label for="image_path" class="text-[12px] italic">Jika tidak memiliki bukti foto, dapat
                                    menggunakan
                                    foto dummy.</label>
                                <input type="file" name="image_path" id="image_path" accept="image/*"
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#141414]">
                                @error('image_path')
                                    <p class="message-error text-red-600 mt-1 text-[0.875rem]">{{ $message }}</p>
                                @enderror
                            </div>
                            <button
                                class="w-full py-2 px-4 bg-[#141414] text-white rounded-lg hover:bg-[#2B2B2B] transition-colors duration-200"
                                type="submit">
                                Kirim Pengaduan
                            </button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </section>
@endsection
