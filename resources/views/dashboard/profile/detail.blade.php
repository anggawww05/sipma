@extends('layout.dashboard')

@section('content')
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
    <form class="grid lg:grid-cols-2 gap-3 p-4 rounded-[4px] border border-[#0d1117]/[0.12]">
        <div class="lg:col-span-2">
            <label for="image_path" class="block text-sm font-medium">Foto Operator</label>
            <div class="wrapper mt-2">
                <img src="{{ $profile->image_path ? asset('storage/' . $profile->image_path) : 'https://placehold.co/400x400?text=Image+Not+Found' }}" alt="Foto Operator" class="w-[100px] aspect-square rounded-[4px] object-cover border border-[#0d1117]/[0.12]">
            </div>
        </div>
        <div>
            <label for="username" class="block text-sm font-medium">Username</label>
            <input type="text" id="username" name="username" value="{{ $profile->user->username }}" class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" readonly>
        </div>
        <div>
            <label for="full_name" class="block text-sm font-medium">Nama Lengkap</label>
            <input type="text" id="full_name" name="full_name" value="{{ $profile->full_name }}" class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" readonly>
        </div>
        <div>
            <label for="phone_number" class="block text-sm font-medium">Nomor Telepon</label>
            <input type="text" id="phone_number" name="phone_number" value="{{ $profile->phone_number }}" class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" readonly>
        </div>
        <div>
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" id="email" name="email" value="{{ $profile->user->email }}" class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" readonly>
        </div>
        @if(auth()->user()->operator_id)
            <div class="lg:col-span-2">
                <label for="type" class="block text-sm font-medium">Tipe Operator</label>
                <input type="text" id="type" name="type" value="{{ $profile->type }}" class="w-full mt-2 p-3 rounded-black text-[#0d1117] border border-[#0d1117]/[0.12] rounded-[4px]" readonly>
            </div>
        @endif
        <a href="{{ route('dashboard.profile.edit') }}" class="lg:col-span-2 bg-transparent hover:bg-[#0d1117]/[0.04] text-[#0d1117] p-3 rounded-[4px] focus:outline-none text-[0.875rem] border border-[#0d1117]/[0.12] hover:border-[#0d1117]/[0.24] w-fit">
            Edit Profil
        </a>
    </form>
@endsection
