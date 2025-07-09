@extends('layout.main')

@section('content')
    <section class="p-6">
        <div class="mt-20 max-w-[1000px] mx-auto flex flex-col gap-3">
            <div class="flex justify-between items-center ">
                <a href="{{ route('track.index') }}"
                    class="inline-flex items-center py-1 px-4 rounded-lg bg-[#141414] hover:bg-[#2B2B2B] text-white text-[16px]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
            </div>
            <div class=" bg-white rounded-lg shadow-md p-4  border-1 border-gray-300 flex flex-col gap-1">
                <div class="w-full bg-white rounded-xl shadow-md p-6  text-center border border-gray-300">
                    <h2 class="text-xl font-semibold mb-4">Timeline Pengaduan</h2>
                    <div class="bg-black text-white font-bold text-lg py-2 px-4 rounded-md inline-block mb-6">
                        #{{ $submission->ticket_number }}
                    </div>
                    @if($submission->estimated_date)
                        <div class="mb-4">
                            <span class="font-medium">Estimasi Selesai:</span>
                            <span class="text-blue-700">{{ \Carbon\Carbon::parse($submission->estimated_date)->locale('id')->translatedFormat('j F Y') }}</span>
                        </div>
                    @endif
                    <h3 class="font-semibold text-md mb-2">Detail Status</h3>
                    <hr class="border-t border-black w-3/4 mx-auto mb-4">
                    <div class="text-sm space-y-6 text-left">
                        @foreach($submission->timelines as $timeline)
                            <div>
                                <p class="text-center font-medium">{{ $timeline->title }} ({{ \Carbon\Carbon::parse($timeline->created_at)->translatedFormat('j F Y - H:i') }})</p>
                                <p class="text-center font-semibold {{ $timeline->status == 'Pengaduan Diterima' ? 'text-blue-600' : ($timeline->status == 'Selesai' ? 'text-green-600' : 'text-yellow-600') }}">{{ $timeline->status }}</p>
                                <p class="text-center text-gray-700">
                                    {{ $timeline->description }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
