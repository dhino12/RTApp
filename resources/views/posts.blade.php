@extends('layouts/main')

@section('header')
    <div class="w-full">
        <div
            class="absolute -z-10 w-full top-0 bg-gradient-to-b from-[#141727] to-[#3a416f] h-96 overflow-hidden"
        >
            <div class="w-full h-full bg-gradient-to-r from-cyan-700 to-blue-800 relative">
                <img src="https://source.unsplash.com/1000x600?indonesia" alt="" class="w-full h-full mix-blend-overlay object-cover object-top">
            </div>
            <svg class="waves w-full absolute bottom-0 " xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
                </defs>
                <g class="moving-waves">
                    <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40"></use>
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)"></use>
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)"></use>
                    <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)"></use>
                    <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)"></use>
                    <use xlink:href="#gentle-wave" x="48" y="16" fill="#f1f5f9"></use>
                </g>
            </svg>
        </div>
        @include('components/navbar', [
            "className" => "container mt-5 mx-auto p-4 px-10 fill-white sm:px-[20vh] flex flex-col justify-between transition-all duration-200 lg:flex-row lg:items-center text-white"
        ])
        <div class="my-20 md:w-1/2 mx-auto text-center text-white">
            <h1 class="font-bold md:text-3xl text-2xl mb-4">{!! $title !!}</h1>
        </div>
    </div>
@endsection

@section('container') 
@php
    function getImage($data): string {
        $pattern = '/&quot;url&quot;:&quot;([^&]*)&quot;/';
        preg_match($pattern, $data->body, $bodyImageMatch);
        $bodyImageMatch = count($bodyImageMatch) == 0 ? 'https://source.unsplash.com/1000x600?football' : $bodyImageMatch[1];
        $galleryImages = count($data->images) == 0 ? false : '/images/' . $data->images[0]->name;
        $image = $galleryImages ?: $bodyImageMatch ;
        return $image;
    }
@endphp
<div class="relative bg-gradient-to-b from-transparent z-20 via-slate-100 via-20% to-slate-100">
    <div class="w-2/3 lg:w-1/2 mx-auto rounded-lg overflow-hidden py-5 px-8 -mt-10 bg-[#ffffffcc]/60 backdrop-blur-2xl shadow-lg">
        <form action="" method="GET" class="flex justify-center flex-col lg:flex-row lg:gap-6 items-center">
            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            @if (request('author'))
                <input type="hidden" name="author" value="{{ request('author') }}">
            @endif
            <input type="text" name="search" placeholder="Search of {{ request()->segment(2) }}" class="w-full shadow-md border-2 border-slate-200 rounded-md text-slate-800 h-12 px-2" value="{{ request('search') }}">
            <button type="submit" class="bg-gradient-to-l from-cyan-400 to-blue-600 px-4 rounded-lg font-semibold py-2 text-white mt-3 active:scale-[0.95] hover:scale-[1.05] transition-all lg:mt-0">Search</button>
        </form>
    </div>
    <div class="lg:w-1/3 md:mx-auto mx-3 text-center mt-16">
        @if (request('category'))
            @include('components/quoteCategory')
        @endif
        @if (request('author'))
            @include('components/quoteAuthor')
        @endif
    </div>
    <div class="md:mx-24 mx-5 @if(!request('category') && !request('author')) mt-32 @else mt-16 @endif">
        @if (count($posts) == 0) <span></span>
        @else
            <div class="mt-2">
                <p class="font-semibold text-lg">Galeri Aktifitas</p>
            </div>
            <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($posts as $post)
                    <a href="/post/gallery/{{ $post->slug }}" class="relative card-hover rounded-2xl overflow-hidden sm:bg-red-200 md:min-h-[50vh] shadow-lg shadow-slate-300">
                        <div class="bg-gradient-to-b from-slate-400 to-slate-900 h-96 md:h-full">
                            <img src="{{ getImage($post) }}" alt="" class="mix-blend-overlay w-full h-full object-cover">
                        </div>
                        <div class="absolute bottom-0 mb-5 mx-5 text-white">
                            <h2 class="text-2xl font-afacad font-semibold mb-4 line-clamp-2">{{ $post->title }}.</h2>
                            <p class="line-clamp-2">{{ strip_tags($post->body) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            
            @if ($posts->hasPages())
            <div class="md:mx-10 mx-5 mt-8">
                {{ $posts->links() }}
            </div>
            @endif
        @endif
        @if (count($blogs) == 0) <span></span>
        @else 
            <div class="mt-24">
                <p class="font-semibold text-lg">Blogs</p>
            </div>
            <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($blogs as $blog)
                    <a href="/post/blog/{{ $blog->slug }}">
                        <div class="max-w-[18rem] sm:max-w-[22rem] mb-12 transition-all hover:scale-[1.02]">
                            <div class="h-56 bg-red-200">
                                <img src="{{ getImage($blog) }}" alt="" class="w-full h-full rounded-lg shadow-lg object-cover object-center">
                            </div>
                            <div class="flex justify-between flex-col items-start h-40 rounded-2xl pb-5">
                                <span>
                                    <h2 class="min-h-[4rem] mt-3 mb-0 font-semibold text-slate-800 text-2xl font-afacad line-clamp-2 capitalize">
                                        {{ $blog->title }}
                                    </h2>
                                    <p class="min-h-[4.5rem] text-slate-600 text-justify line-clamp-3">
                                        {{ strip_tags($blog->body) }}
                                    </p>
                                </span>
                                <button class="font-semibold font-afacad text-blue-500 text-xl mt-2 mb-0 flex items-center justify-between w-full">Baca Selengkapnya
                                    <span class="activeIcon material-symbols-outlined">keyboard_arrow_right</span>
                                </button>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            
            @if ($blogs->hasPages())
                <div class="md:mx-10 mx-5 mt-8">
                    {{ $blogs->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection

@section('footer')
    @include('components/footer-wave')
@endsection