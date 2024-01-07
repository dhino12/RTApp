@extends('layouts/main')

@section('header')
    <div class="w-full">
        <div
            class="absolute -z-10 w-full top-0 bg-gradient-to-b from-[#141727] to-[#3a416f] h-96 overflow-hidden"
        >
            <div class="w-full h-full bg-gradient-to-r from-cyan-700 to-blue-800 relative">
                <img src="https://source.unsplash.com/1000x600?indonesia" alt="" class="w-full h-full mix-blend-overlay object-cover object-top">
            </div>
            <div class="w-full absolute bottom-0 start-0 end-0" style="transform: scale(2);transform-origin: top center;color: #fff;">
                <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
                </svg>
            </div>
        </div>
        @include('components/navbar', [
            "className" => "relative container mt-5 mx-auto p-4 px-10 fill-white sm:px-[20vh] flex flex-col justify-between text-slate-200 transition-all duration-200 lg:flex-row lg:items-center"
        ])
        
        <div class="my-20 w-2/3 mx-auto text-center text-white">
            <h1 class="font-bold text-3xl mb-4">Categories</h1>
            <p class="font-inter font-semibold">Saling Peduli, Saling Mendukung: Rukun Tetangga Mewarnai Kehidupan Sehari-hari</p>
        </div>
    </div>
@endsection

@section('container')

<div class="bg-gradient-to-b from-transparent z-20 via-slate-100 via-20% to-slate-100">
    <div class="w-2/3 lg:w-1/2 mx-auto rounded-lg overflow-hidden py-5 px-8 -mt-10 bg-slate-100 shadow-lg">
        <h2 class="text-lg mb-3 font-bold">Search</h2>
        <form action="" class="flex justify-center flex-col lg:flex-row lg:gap-6 items-center">
            <input type="text" name="search" placeholder="Search of category" class="w-full shadow-md border-2 border-slate-200 rounded-md text-slate-800 h-10 px-2">
            <button type="submit" class="bg-gradient-to-l from-cyan-400 to-blue-600 px-4 rounded-lg font-semibold py-2 text-white mt-3 active:scale-[0.95] hover:scale-[1.05] transition-all lg:mt-0">Search</button>
        </form>
    </div>
    <div class="">
        <div class="w-96 mx-auto text-center mt-16">
            <span class="material-symbols-outlined text-3xl px-3 py-2 rounded-2xl shadow-lg bg-gradient-to-r from-cyan-400 to-blue-600 text-white">
                category
            </span>
            <h1 class="font-bold text-2xl mx-auto my-5">
                Jelajahi Kegiatan Berdasarkan Kategori
            </h1>
            <p>Telusuri Kategori, Temukan Kegembiraan dan Kenangan Bersama</p>
        </div>
        <div class="flex flex-wrap gap-4 mt-5 mx-3 justify-center">
            @foreach ($categories as $category)
                <a href="/posts?category={{ $category->slug }}">
                    <div class="relative shadow-md shadow-slate-500 overflow-hidden rounded-lg max-w-[18rem] sm:max-w-[22rem] max-h-80 mb-5 transition-all hover:scale-[1.02]">
                        <div class="h-56 bg-red-200">
                            <img src="https://source.unsplash.com/1000x600?design" alt="" class="w-full h-full shadow-lg object-cover object-center">
                        </div>
                        <div class="absolute bottom-0 bg-gradient-to-b from-slate-400/10 to-slate-900/80 w-full min-h-20 p-4 text-white">
                            <h1 class="font-bold text-2xl">{{ $category->title }}</h1>
                            <p>{{ count($category->blogs) + count($category->galleries) }} content</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('components/footer-wave')
@endsection