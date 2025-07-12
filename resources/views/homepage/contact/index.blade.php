@extends('layout.main')

@section('content')
    <div class="container py-5 h-screen w-screen">
        <div class="flex flex-col items-center justify-center min-h-screen">
            <h2 class="m-4 text-3xl font-bold text-gray-800">Pengaduan Layanan Telepon</h2>
            <p class="mb-6 text-gray-600">Silakan hubungi operator kami untuk bantuan lebih lanjut.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $operatorNames = ['Akademik', 'Kemahasiswaan', 'Fasilitas', 'Pelecehan'];
                @endphp
                @foreach ($users as $i => $user)
                    <div
                        class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center hover:shadow-lg transition-shadow duration-300">
                        <div class="mb-4 flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full">
                            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0z"></path>
                                <path d="M12 14v7"></path>
                                <path d="M6 21h12"></path>
                            </svg>
                        </div>
                        <h5 class="text-lg font-semibold text-gray-700 mb-2">
                            {{ $operatorNames[$i] ?? $user->username }}
                        </h5>
                        <p class="text-gray-500 flex items-center mb-1">
                            <svg class="w-5 h-5 mr-2 text-blue-400" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path d="M4 4h16v16H4V4z"></path>
                                <path d="M22 6l-10 7L2 6"></path>
                            </svg>
                            {{ $user->email }}
                        </p>
                        <p class="text-gray-500 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-400" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path
                                    d="M22 16.92V19a2 2 0 0 1-2.18 2A19.72 19.72 0 0 1 3 5.18 2 2 0 0 1 5 3h2.09a2 2 0 0 1 2 1.72c.13 1.06.37 2.09.72 3.08a2 2 0 0 1-.45 2.11l-1.27 1.27a16 16 0 0 0 6.58 6.58l1.27-1.27a2 2 0 0 1 2.11-.45c.99.35 2.02.59 3.08.72a2 2 0 0 1 1.72 2z">
                                </path>
                            </svg>
                            {{ $user->phone_number }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
