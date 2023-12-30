@extends('dashboard/layouts/main')

@section('container')
<div class="w-full px-6 py-6 mx-auto">
    <!-- breadcrumb -->
    @include('dashboard/components/navbar')
    <div class="flex flex-wrap -mx-3">
        <!-- card1 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-sans text-sm font-semibold leading-normal">Total Blog Post</p>
                                <h5 class="mb-0 font-bold">
                                    30
                                    <span class="text-sm leading-normal font-weight-bolder text-lime-500">+55%</span>
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-cyan-400 to-blue-600">
                                <span class="material-symbols-outlined text-2xl leading-7 relative top-2.5 text-white">
                                    notes
                                </span>
                                {{-- <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- card2 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-sans text-sm font-semibold leading-normal">Total Gallery Post</p>
                                <h5 class="mb-0 font-bold">
                                    10
                                    <span class="text-sm leading-normal font-weight-bolder text-lime-500">+3%</span>
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-cyan-400 to-blue-600">
                                <span class="material-symbols-outlined text-2xl leading-8 relative top-2.5 text-white">
                                    gallery_thumbnail
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- card3 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-sans text-sm font-semibold leading-normal">Total Views</p>
                                <h5 class="mb-0 font-bold">
                                    +3,462
                                    <span class="text-sm leading-normal text-red-600 font-weight-bolder">-2%</span>
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-cyan-400 to-blue-600">
                                <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- card4 -->
        <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-sans text-sm font-semibold leading-normal">Sales</p>
                                <h5 class="mb-0 font-bold">
                                    $103,430
                                    <span class="text-sm leading-normal font-weight-bolder text-lime-500">+5%</span>
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-cyan-400 to-blue-600">
                                <i class="ni leading-none ni-cart text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cards row 4 -->
    <div class="flex flex-wrap my-6 -mx-3 overflow-hidden">
        <!-- card 1 -->
        <div class="w-full max-w-full px-3 mt-0 mb-6 md:mb-0 md:w-1/2 md:flex-none lg:w-2/3 lg:flex-none">
            <div class="border-black/12.5 mb-5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                    <div class="flex flex-wrap mt-0 -mx-3">
                        <div class="flex-none w-7/12 max-w-full px-3 mt-0 lg:w-1/2 lg:flex-none">
                            <h6 class="font-bold">Gallery</h6>
                            <p class="mb-0 text-sm leading-normal">
                                <i class="fa fa-check text-cyan-500"></i>
                                <span class="ml-1 font-semibold">{{ count($gallerys) }} done</span>
                                posts
                            </p>
                        </div>
                        <div class="flex-none w-5/12 max-w-full px-3 my-auto text-right lg:w-1/2 lg:flex-none">
                            <div class="relative pr-6 lg:float-right">
                                <a dropdown-trigger class="cursor-pointer" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v text-slate-400"></i>
                                </a>
                                <p class="hidden transform-dropdown-show"></p>
                                <ul
                                    dropdown-menu
                                    class="z-100 text-sm transform-dropdown shadow-soft-3xl duration-250 before:duration-350 before:font-awesome before:ease-soft min-w-44 -ml-34 before:text-5.5 pointer-events-none absolute top-0 m-0 mt-2 list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:top-0 before:right-7 before:left-auto before:z-40 before:text-white before:transition-all before:content-['\f0d8']"
                                >
                                    <li class="relative">
                                        <a
                                            class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300"
                                            href="javascript:;"
                                        >
                                            Action
                                        </a>
                                    </li>
                                    <li class="relative">
                                        <a
                                            class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300"
                                            href="javascript:;"
                                        >
                                            Another action
                                        </a>
                                    </li>
                                    <li class="relative">
                                        <a
                                            class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300"
                                            href="javascript:;"
                                        >
                                            Something else here
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-auto p-6 px-0 pb-2">
                    @include('dashboard/components/table', [
                        "theads" => ["Author", "Title", "Category", "Dibuat"],
                        "posts" => $gallerys
                    ])
                </div>
            </div>
            <div class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                    <div class="flex flex-wrap mt-0 -mx-3">
                        <div class="flex-none w-7/12 max-w-full px-3 mt-0 lg:w-1/2 lg:flex-none">
                            <h6 class="font-bold">Blog</h6>
                            <p class="mb-0 text-sm leading-normal">
                                <i class="fa fa-check text-cyan-500"></i>
                                <span class="ml-1 font-semibold">{{ count($blogs) }} done</span>
                                posts
                            </p>
                        </div>
                        <div class="flex-none w-5/12 max-w-full px-3 my-auto text-right lg:w-1/2 lg:flex-none">
                            <div class="relative pr-6 lg:float-right">
                                <a dropdown-trigger class="cursor-pointer" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v text-slate-400"></i>
                                </a>
                                <p class="hidden transform-dropdown-show"></p>
                                <ul
                                    dropdown-menu
                                    class="z-100 text-sm transform-dropdown shadow-soft-3xl duration-250 before:duration-350 before:font-awesome before:ease-soft min-w-44 -ml-34 before:text-5.5 pointer-events-none absolute top-0 m-0 mt-2 list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:top-0 before:right-7 before:left-auto before:z-40 before:text-white before:transition-all before:content-['\f0d8']"
                                >
                                    <li class="relative">
                                        <a
                                            class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300"
                                            href="javascript:;"
                                        >
                                            Action
                                        </a>
                                    </li>
                                    <li class="relative">
                                        <a
                                            class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300"
                                            href="javascript:;"
                                        >
                                            Another action
                                        </a>
                                    </li>
                                    <li class="relative">
                                        <a
                                            class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300"
                                            href="javascript:;"
                                        >
                                            Something else here
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-auto p-6 px-0 pb-2">
                    @include('dashboard/components/table', [
                        "theads" => ["Author", "Title", "Category", "Dibuat"],
                        "posts" => $blogs
                    ])
                </div>
            </div>
        </div>
        <!-- card 2 -->
        <div class="w-full max-w-full px-3 md:w-1/2 md:flex-none lg:w-1/3 lg:flex-none">
            <div class="relative flex h-full min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-clip-border">
                <div class="border-black/12.5 shadow-soft-xl mb-5 rounded-2xl border-b-0 border-solid bg-white p-6">
                    <h6>Cuaca Hari ini</h6>
                    <p class="text-sm leading-normal">
                        <i class="fa fa-arrow-up text-lime-500"></i>
                        <span class="font-semibold">24%</span> this month
                    </p>
                </div>
                <div class="border-black/12.5 shadow-soft-xl mb-5 rounded-2xl border-b-0 border-solid bg-white p-6">
                    <div class="border-black/12.5 border-b-0 border-solid">
                        <h6 class="mb-0">Calendar</h6>
                        <div class="flex">
                            <div class="mb-0 font-semibold leading-normal text-sm widget-calendar-day">Saturday</div>
                            <span>,&nbsp;</span>
                            <div class="mb-1 font-semibold leading-normal text-sm widget-calendar-year">2023</div>
                        </div>
                        <hr class="h-px mb-0 bg-gradient-to-r from-transparent via-black/40 to-transparent" />
                    </div>
                    <div class="flex-auto pt-4">
                        <div data-toggle="widget-calendar" id="calendar" class="fc fc-media-screen fc-direction-ltr fc-theme-standard"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection