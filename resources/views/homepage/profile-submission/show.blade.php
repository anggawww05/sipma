@extends('layout.main')

@section('content')
    <section class="p-6 w-screen h-full">
        <div class="mt-20 max-w-[1000px] mx-auto flex flex-col gap-3">
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
            <form>
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <div class=" bg-white rounded-lg shadow-md p-4  border-1 border-gray-300 flex flex-col gap-1 ">
                    <h1 class="flex justify-center text-[20px] font-semibold">Formulir Pengaduan {{ $submission->category->name }}</h1>
                    <div class="p-6 flex flex-col gap-4">
                        <label for="category_id">Kategori<span class="text-red-500">*</span>
                            <input type="text" name="category_id" id="category_id"
                                   value="{{ $submission->category->name }}" readonly
                                   class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#141414]">
                        </label>
                        <div class="flex flex-col gap-1">
                            <label for="title" class="text-[16px]">Judul <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title"
                                   value="{{ $submission->title }}" readonly
                                   class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#141414]">
                        </div>
                        <div class="flex flex-col gap-1">
                            <label for="description" class="text-[16px]">Deskripsi <span class="text-red-500">*</span></label>
                            <textarea name="description" id="description" class="w-full h-48 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#141414]" readonly>{{ $submission->description }}</textarea>
                        </div>
                        @if($submission->survey)
                            <div class="flex flex-col gap-1">
                                <label for="survey" class="text-[16px]">Survey <span class="text-red-500">*</span></label>
                                <textarea name="survey" id="survey" class="w-full h-48 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#141414]" readonly>{{ $submission->survey }}</textarea>
                            </div>
                        @endif
                        <div class="flex flex-col gap-1">
                            <label for="image_path" class="text-[16px]">Bukti Foto <span class="text-red-500">*</span></label>
                            <label for="image_path" class="text-[12px] italic">Jika tidak memiliki bukti foto, dapat
                                menggunakan
                                foto dummy.</label>
                            <img id="image-preview" src="{{ $submission->image_path ? asset('storage/' . $submission->image_path) : 'https://placehold.co/400x400?text=Image+Not+Found' }}" alt="Foto Pengajuan" class="w-[100px] aspect-square rounded-[4px] object-cover border border-[#0d1117]/[0.12]">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
