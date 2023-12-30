@extends('layouts/main')

@section('header')
    <div class="w-full fixed px-8 z-10">
        @include('components/navbar', [
            "className" => "container mt-5 mx-auto py-4 px-6 shadow-md shadow-slate-300 rounded-t-[50px] rounded-b-[50px] bg-[#ffffffcc] backdrop-blur-2xl flex flex-col justify-between transition-all duration-200 lg:flex-row lg:items-center lg:w-[80rem]"
        ])
    </div>
@endsection

@section('container')
<div class="mb-10 md:mb-0 grid grid-cols-1 lg:grid-cols-2">
    <div class="mt-36 mx-12 md:w-96 md:mx-auto">
        @if(session()->has('success'))
            <div class="bg-lime-100 border border-green-400 text-green-800 px-4 py-3 rounded relative mb-5" role="alert">
                <strong class="font-bold">Congratulations: </strong>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session()->has('loginError'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5" role="alert">
                <strong class="font-bold">Kesalahan terjadi: </strong>
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h1 class="font-bold text-2xl mb-2">Login</h1>
        <p class="mb-4">Masukan data diri untuk mendaftar</p>
        <form action="/login" method="POST">
            @csrf
            <div class="w-full mb-5">
                <label for="email" class="block mb-1 text-sm font-semibold">Email <span class="text-red-800">*</span></label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="w-full shadow-sm rounded-md h-10 px-2 py-2 border-2 border-slate-200 block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-red-500 invalid:focus:ring-red-700 invalid:focus:border-red-700 peer
                        @error('email') is-invalid @enderror
                    " 
                    placeholder="masukan email.." 
                    required
                >
            @error('email')
                <div class="text-red-700">
                    {{ $message }}
                </div>
            @enderror
            </div>
            <div class="w-full">
                <label for="password" class="block mb-1 text-sm font-semibold">Password <span class="text-red-800">*</span></label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="w-full shadow-sm border-2 border-slate-200 rounded-md h-10 px-2 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-500 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer" 
                    placeholder="password..." 
                    required
                >
            </div>
            <button type="submit" class="block mx-auto w-full my-5 px-4 py-3 shadow-md active:scale-[0.95] hover:scale-[1.05] transition-all text-white font-semibold bg-gradient-to-r from-cyan-400 to-blue-600 rounded-lg uppercase">
                 Login
            </button>
            <p class="text-center">Belum punya akun? <a href="/register" class="decoration-transparent font-bold text-blue-600 hover:text-red-500">Register</a></p>
        </form>
    </div>
    <div class=" min-h-[90vh] hidden bg-gradient-to-r from-cyan-400 to-blue-600 lg:flex items-center justify-center flex-col mt-10 mr-5 rounded-2xl">
        <img src="assets/dashboard.png" alt="" class="lg:max-w-[500px] relative z-20 filter -hue-rotate-15">
        <h2 class="text-3xl text-white text-center font-afacad font-bold">Akses Lebih, Segera Login !</h2>
        <p class="mt-3 mx-14 text-white text-center font-semibold">Akses Lebih, Login Sekarang dan Berkontribusi untuk masyarakat luas dalam menyampaikan informasi</p>
    </div>
</div>
@endsection