@extends('layouts/main')

@section('header')
    <div class="w-full">
        @include('components/navbar', [
            "className" => "bg-slate-800 pt-5 mx-auto p-4 px-10 sm:px-[20vh] flex flex-col justify-between transition-all duration-200 lg:flex-row lg:items-center text-white"
        ])
    </div>
@endsection

@section('container')
<div class="relative shadow-md shadow-slate-300 mx-5 mb-10 mt-10 pb-14 rounded-2xl pt-12 md:w-[55%] md:mt-20 md:mx-auto overflow-hidden">
    <div class="absolute z-10 w-full top-0 bg-gradient-to-r from-cyan-400 to-blue-600 overflow-hidden h-52">
        <svg class="waves w-full absolute bottom-0" style="height:7vh;min-height:50px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
            </defs>
            <g class="moving-waves fill-slate-200">
                <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40"></use>
                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)"></use>
                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)"></use>
                <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)"></use>
                <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)"></use>
                <use xlink:href="#gentle-wave" x="48" y="16" fill="#f1f5f9"></use>
            </g>
        </svg>
    </div>
    <div class="mx-10 relative z-20 flex flex-col lg:flex-row justify-between">
        <div>
            <h1 class="text-3xl font-afacad font-bold text-white">Sering Ditanyakan 
                <span class="inline-block animate-bounce">?</span>
            </h1>
            <p class="font-sans text-white">Last modified: Feb 01 2021</p>
        </div>
        <form method="GET" class="mt-5 flex items-center gap-2 flex-col md:flex-row">
            <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Capek scroll ? cari aja disini" class="md:min-w-[32vh] w-full shadow-md border-2 border-slate-200 rounded-md text-slate-800 h-12 px-2">
            <button type="submit" class="mt-2 md:mt-0 bg-gradient-to-l from-cyan-400 to-blue-600 px-4 rounded-lg font-semibold py-2 text-white active:scale-[0.95] hover:scale-[1.05] transition-all">Search</button>
        </form>
    </div>
    <div class="mt-32 mx-5 md:mx-14 relative z-20">
        <h2 class="font-bold text-xl font-afacad md:text-2xl">Syarat dan Prosedur Pengurusan Dokumen</h2>
        <div class="grid grid-cols-1 mt-5 gap-2" id="accordion">
            @foreach ($faqs as $question)
                <div class="item hover:shadow-lg hover:scale-105 transition-all rounded-lg overflow-hidden">
                    <div class="header p-6 bg-slate-200 font-bold flex justify-between items-center cursor-pointer rounded-lg">
                        <div>
                            <h2 class="text-sm md:text-base">{{ $question->title }}</h2>
                        </div>
                        
                        <span class="activeIcon material-symbols-outlined">keyboard_arrow_down</span>
                        <span class="inactiveIcon material-symbols-outlined">keyboard_arrow_up</span>
                    </div>
                    <div class="content text-black text-sm md:text-base transition-all duration-500" style="height: 0;" id="content-text">
                        <p class="mb-5" >
                            {!! $question->body !!}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script>
    const special = /[\\[{().+*?|^$]/g;
    function searchHighlight() {
        const contentsText = document.querySelectorAll('#content-text');
        let input = document.querySelector('#search').value;
        let headerText = ''
        contentsText.forEach(contentText => {

            if (input !== "") {
                if (special.test(input)) input = input.replace(special, "$&");
                let regExp = new RegExp(input, 'gi');
                contentText.innerHTML = (contentText.textContent).replace(regExp, "<mark>$&</mark>")
                
                headerText = contentText.previousSibling.previousElementSibling.querySelector('h2')
                headerText.innerHTML = (headerText.textContent).replace(regExp, "<mark>$&</mark>")
            }
        });
    }
    document.addEventListener("DOMContentLoaded", searchHighlight)
</script>
@endsection

@section('footer')
    @include('components/footer-wave')
@endsection