@extends('layout.main')

@section('content')
<div class="w-full bg-[#F6F6F6] py-16 min-h-screen pt-30">
    <div class="flex flex-col gap-4 justify-center items-center mx-auto">
        <div class="w-[800px] bg-white rounded-2xl shadow-xl border border-gray-200 flex flex-row p-8">
            <form action="{{ route('profile.edit') }}" method="POST" enctype="multipart/form-data" class="flex w-full">
                @csrf
                @method('PATCH')
                <div class="flex flex-row w-full gap-8">
                    {{-- Foto --}}
                    <div class="flex flex-col gap-6 w-[260px] items-center">
                        <div class="w-40 h-40 rounded-full border border-gray-300 shadow-sm overflow-hidden">
                            <img src="{{ auth()->user()->student->image_path ? asset('storage/' . auth()->user()->student->image_path) : 'https://placehold.co/400x400?text=Image+Not+Found' }}" alt="#"
                                class="object-cover w-full h-full" id="image-preview">
                        </div>
                        <input type="file" name="image_path" id="image-input" class="hidden">
                        <label for="image-input"
                            class="w-[120px] h-[38px] bg-[#F4F4F4] border border-gray-300 rounded-lg text-gray-500 flex items-center justify-center cursor-pointer hover:bg-gray-100 transition">
                            Pilih Gambar
                        </label>
                        @error('image_path')
                        <p class="message-error text-red-600 mt-1 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- Form --}}
                    <div class="flex-1 flex flex-col gap-4">
                        <div>
                            <label for="username" class="text-base font-semibold text-gray-700">Username</label>
                            <input type="text" id="username" name="username"
                                value="{{ auth()->user()->username }}"
                                class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 transition">
                            @error('username')
                            <p class="message-error text-red-600 mt-1 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="text-base font-semibold text-gray-700">Email</label>
                            <input type="email" id="email" name="email"
                                   value="{{ auth()->user()->email }}"
                                   class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 transition">
                            @error('email')
                            <p class="message-error text-red-600 mt-1 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="text-base font-semibold text-gray-700">Password</label>
                            <input type="password" id="password" name="password"
                                   class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 transition">
                            @error('password')
                            <p class="message-error text-red-600 mt-1 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="full_name" class="text-base font-semibold text-gray-700">Nama Lengkap</label>
                            <input type="text" id="full_name" name="full_name"
                                   value="{{ auth()->user()->student->full_name }}"
                                   class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 transition">
                            @error('full_name')
                            <p class="message-error text-red-600 mt-1 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="phone_number" class="text-base font-semibold text-gray-700">Nomor Telepon</label>
                            <input type="text" id="phone_number" name="phone_number"
                                   value="{{ auth()->user()->student->phone_number }}"
                                   class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 transition">
                            @error('phone_number')
                            <p class="message-error text-red-600 mt-1 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="study_program" class="text-base font-semibold text-gray-700">Prodi</label>
                            <input type="text" id="study_program" name="study_program"
                                   value="{{ auth()->user()->student->study_program }}"
                                   class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 transition">
                            @error('study_program')
                            <p class="message-error text-red-600 mt-1 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="nim" class="text-base font-semibold text-gray-700">NIM</label>
                            <input type="text" id="nim" name="nim"
                                   value="{{ auth()->user()->student->nim }}"
                                   class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 transition">
                            @error('nim')
                            <p class="message-error text-red-600 mt-1 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex gap-4 mt-4">
                            <a href="{{ route('profile.index') }}"
                               class="w-[110px] h-[38px] bg-gray-200 text-gray-700 rounded-lg flex items-center justify-center hover:bg-gray-300 transition">
                                Kembali
                            </a>
                            <button type="submit"
                                class="w-[110px] h-[38px] bg-[#A91D3A] hover:bg-[#CA3453] text-white rounded-lg transition">
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

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
