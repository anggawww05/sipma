@extends('layout.main')

@section('content')
    <section>
        <div class="relative h-screen flex items-center justify-center bg-center bg-cover" style="background-image: url('{{ asset('images/landing-page.png') }}')">
            <div class="absolute inset-0 bg-gradient-to-br from-black/70 via-black/40 to-transparent"></div>
            <div class="relative z-10 flex flex-col items-center w-full px-4 md:px-0">
                <h1 class="text-white text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4 leading-tight text-center drop-shadow-lg">
                    Sistem Pengaduan<br>
                    <span class="block text-6xl md:text-7xl lg:text-8xl font-black text-[#F15B6C] drop-shadow-lg">Mahasiswa</span>
                </h1>
                <p class="mb-10 text-lg md:text-xl font-medium text-white max-w-2xl text-center drop-shadow-md" data-aos="fade-up">
                    SIPMA adalah platform pengaduan mahasiswa yang modern, efisien, dan mudah digunakan untuk menyampaikan aspirasi serta keluhan di lingkungan kampus.
                </p>
                <a href="{{ route('profile-submission.create') }}"
                    class="inline-flex items-center px-7 py-3 rounded-full bg-[#A91D3A] hover:bg-[#F15B6C] text-white font-semibold text-lg shadow-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#A91D3A] focus:ring-offset-2">
                    + Buat Pengaduan
                </a>
            </div>
        </div>
    </section>
    <section class="mt-10 px-12 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <!-- Tentang Kami -->
            <div class="flex flex-col space-y-4">
                <span class="text-[#A91D3A] text-2xl font-semibold uppercase tracking-widest">Tentang Kami</span>
                <h2 class="text-5xl md:text-7xl font-extrabold text-gray-900 leading-tight">SIPMA</h2>
                <div class="w-20 h-2 bg-gradient-to-r from-[#A91D3A] to-[#F15B6C] rounded-full"></div>
            </div>
            <div class="flex items-center">
                <p class="text-lg md:text-xl text-gray-700 leading-relaxed">
                    SIPMA (Sistem Pengaduan Mahasiswa) adalah platform digital modern yang memudahkan mahasiswa menyampaikan aspirasi, keluhan, dan saran kepada kampus secara cepat, transparan, dan terorganisir. Kami berkomitmen meningkatkan kualitas layanan dengan mendengar setiap suara mahasiswa melalui antarmuka yang intuitif dan ramah pengguna.
                </p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mt-16 items-center">
            <div class="flex items-center order-2 md:order-1">
                <p class="text-lg md:text-xl text-gray-700 leading-relaxed">
                    Kami menyediakan layanan pengaduan yang responsif, profesional, dan terpercaya. Setiap laporan mahasiswa diproses secara transparan dan akuntabel, mendorong perbaikan layanan serta menciptakan lingkungan kampus yang lebih baik dan inklusif.
                </p>
            </div>
            <div class="flex flex-col items-end space-y-4 order-1 md:order-2">
                <span class="text-[#A91D3A] text-2xl font-semibold uppercase tracking-widest">Tugas Kami</span>
                <h2 class="text-5xl md:text-7xl font-extrabold text-gray-900 leading-tight">Komitmen</h2>
                <div class="w-20 h-2 bg-gradient-to-l from-[#A91D3A] to-[#F15B6C] rounded-full"></div>
            </div>
        </div>
    </section>
    <section class="py-20 bg-gradient-to-b from-white via-gray-50 to-gray-100">
        <div class="flex flex-col items-center mb-16">
            <span class="italic text-3xl font-semibold mb-2 text-[#A91D3A]">Layanan</span>
            <span class="text-6xl md:text-8xl font-extrabold text-gray-900 tracking-tight">Kami</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-5xl mx-auto">
            <div class="flex flex-col items-center bg-white rounded-3xl shadow-lg p-8 hover:scale-105 transition-transform duration-300">
                <div class="w-20 h-20 flex items-center justify-center rounded-full bg-[#A91D3A]/10 border-4 border-[#A91D3A] text-3xl font-bold text-[#A91D3A] mb-6 shadow-md">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2v-8a2 2 0 012-2h2M12 15v-6m0 0l-3 3m3-3l3 3"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-800">Pengaduan Keluhan</h3>
                <p class="text-center text-gray-600">Sampaikan keluhan Anda secara mudah dan cepat melalui sistem kami.</p>
            </div>
            <div class="flex flex-col items-center bg-white rounded-3xl shadow-lg p-8 hover:scale-105 transition-transform duration-300">
                <div class="w-20 h-20 flex items-center justify-center rounded-full bg-[#A91D3A]/10 border-4 border-[#A91D3A] text-3xl font-bold text-[#A91D3A] mb-6 shadow-md">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a4 4 0 018 0v2m-4-6a4 4 0 100-8 4 4 0 000 8zm-6 8a2 2 0 012-2h12a2 2 0 012 2v2H3v-2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-800">Pelaporan Masalah</h3>
                <p class="text-center text-gray-600">Laporkan masalah yang Anda temui agar dapat segera ditindaklanjuti.</p>
            </div>
            <div class="flex flex-col items-center bg-white rounded-3xl shadow-lg p-8 hover:scale-105 transition-transform duration-300">
                <div class="w-20 h-20 flex items-center justify-center rounded-full bg-[#A91D3A]/10 border-4 border-[#A91D3A] text-3xl font-bold text-[#A91D3A] mb-6 shadow-md">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-800">Pemantauan Timeline</h3>
                <p class="text-center text-gray-600">Pantau perkembangan pengaduan Anda secara transparan dan real-time.</p>
            </div>
        </div>
    </section>
@endsection
