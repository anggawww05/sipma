@extends('layout.main')

@section('content')
    <section class="p-6">
        <div class="mt-20 max-w-[1000px] mx-auto flex flex-col gap-3">
            <div class="flex justify-between items-center ">
                <a href="{{ route('blog.index') }}"
                    class="inline-flex items-center py-1 px-4 rounded-lg bg-[#141414] hover:bg-[#2B2B2B] text-white text-[16px]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 border-1 border-gray-300 flex flex-col gap-1">
                <h2 class="text-[20px] font-semibold mb-2">Detail Blog</h2>
                <div class="flex gap-6 flex-wrap">
                    <img src="{{ asset('storage/' . $blog->image_path) }}" alt="Blog Image"
                        class="w-[350px] h-[350px] object-cover rounded-lg border border-black/[0.12] flex-shrink-0">
                    <div class="flex flex-col gap-2 flex-1 min-w-0">
                        <div class="flex w-full justify-between items-center gap-2">
                            <h3 class="text-[20px] font-semibold truncate">{{ $blog->title }}</h3>
                            <p class="text-gray-600 text-sm whitespace-nowrap">{{ \Carbon\Carbon::parse($blog->created_at)->translatedFormat('j F Y - H:i') }}</p>
                        </div>
                        <p class="text-[16px] text-justify break-words">{{ $blog->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
