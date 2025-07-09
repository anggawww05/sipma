@extends('layout.main')

@section('content')
    <section class="p-6">
        <div class="mt-20 max-w-[1000px] mx-auto flex flex-col gap-3">
            <div class="flex justify-between items-center ">
                <a href="{{ route('submission.index') }}"
                    class="inline-flex items-center py-1 px-4 rounded-lg bg-[#141414] hover:bg-[#2B2B2B] text-white text-[16px]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
            </div>
            @if(session()->has('success'))
                <div class="mb-[16px] w-full text-[0.913rem] text-green-400 bg-green-400/[0.08] p-3 rounded-[3px]"
                     role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session()->has('failed'))
                <div class="mb-[16px] w-full text-[0.913rem] text-red-400 bg-red-400/[0.08] p-3 rounded-[3px]"
                     role="alert">
                    {{ session('failed') }}
                </div>
            @endif
            <div class=" bg-white rounded-lg shadow-md p-4  border-1 border-gray-300 flex flex-col gap-1">
                <h2 class="text-[20px] font-semibold mb-2">Detail Pengaduan</h2>
                <div class="flex gap-6 flex-wrap">
                    <img src="{{ asset('storage/' . $submissionPost->image_path) }}" alt="Pengaduan Image"
                        class="w-[350px] h-[350px] object-cover rounded-lg border border-black/[0.12] flex-shrink-0">
                    <div class="flex flex-col gap-2 flex-1 min-w-0">
                        <div class="flex w-full justify-between items-center gap-2">
                            <h3 class="text-[20px] font-semibold truncate">{{ $submissionPost->title }}</h3>
                            <p class="text-gray-600 text-sm whitespace-nowrap">{{ \Carbon\Carbon::parse($submissionPost->created_at)->translatedFormat('j F Y - H:i') }}</p>
                        </div>
                        <p class="text-[16px] text-justify break-words">{{ $submissionPost->description }}</p>
                        <p class="text-[16px] font-semibold">Kategori: {{ $submissionPost->submission->category->name }}</p>
                        <p class="text-[16px] font-semibold">Total Menyukai: {{ count($submissionPost->likes) }}</p>
                        <form action="{{ route('like.store') }}" method="POST" class="flex items-center gap-2 mt-2">
                            @csrf
                            <input type="hidden" name="submission_post_id" value="{{ $submissionPost->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <button type="submit" class="p-3 bg-red-800 text-[0.813rem] rounded-[3px] text-white">{{ !$isLike ? 'Sukai Postingan' : 'Hapus Sukai Postingan' }}</button>
                        </form>
                    </div>
                </div>
                <div class="mt-6 border-1 p-2 rounded-lg border-gray-300">
                    <h4 class="text-lg font-semibold mb-2">Komentar</h4>
                    <div class="flex flex-col gap-4 mb-4">
                        @if(count($submissionPost->comments) === 0)
                            <p class="col-span-4 w-full text-center text-[0.913rem] text-[#0d1117]/[0.42] my-8">Komentar pada postingan ini tidak ada.</p>
                        @else
                            @foreach($submissionPost->comments as $comment)
                                @if($comment->user_id == auth()->user()->id)
                                    <div class="flex items-start justify-end gap-2">
                                        <div>
                                            <span class="block text-xs text-right text-gray-500">{{ auth()->user()->student->full_name }}</span>
                                            <div class="bg-[#141414] text-white rounded-lg px-4 py-2 mt-1 text-xs max-w-md text-right">
                                                {{ $comment->message }}
                                            </div>
                                        </div>
                                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->student->full_name }}" alt="avatar" class="w-7 h-7 rounded-full">
                                    </div>
                                @else
                                    <div class="flex items-start gap-2">
                                        <img src="https://ui-avatars.com/api/?name={{ $comment->user->student->full_name }}" alt="avatar"
                                             class="w-7 h-7 rounded-full">
                                        <div>
                                            <span class="text-xs text-gray-500">{{ $comment->user->student->full_name }}</span>
                                            <div class="bg-[#141414] text-white rounded-lg px-4 py-2 mt-1 text-xs max-w-md">
                                                {{ $comment->message }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <!-- Form Komentar -->
                    <form action="{{ route('comment.store') }}" method="POST" class="flex items-center gap-2 mt-2">
                        @csrf
                        <input type="hidden" name="submission_post_id" value="{{ $submissionPost->id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="text" name="message" class="flex-1 border border-gray-300 rounded-lg p-2 text-sm"
                            placeholder="Tulis komentar disini....">
                        <button type="submit" class="bg-[#A91D3A] hover:bg-[#CA3453] text-white rounded-full p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
