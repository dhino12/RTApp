@extends('dashboard/layouts/main')

@section('container')
<div class="w-full px-6 py-6 mx-auto">
    
    <!-- breadcrumb -->
    @include('dashboard/components/navbar')
    <!-- cards row 4 -->
    <div class="flex flex-wrap my-6 -mx-3 overflow-hidden">
        <!-- card 1 -->
        <div class="flex-none w-full max-w-full px-3">
            
            @if(session()->has('success'))
                <div class="bg-lime-100 border border-green-400 text-green-800 px-4 py-3 rounded relative mb-5" role="alert">
                    <strong class="font-bold">Congratulations: </strong>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded relative mb-5" role="alert">
                    <strong class="font-bold">Failed: </strong>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="relative flex flex-col min-w-0 max-w-20 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <a href="/dashboard/blogs/create" class="bg-gradient-to-tl from-cyan-400 to-blue-400 active:scale-[0.95] transition-all hover:scale-[1.05] px-2.5 text-sm rounded-1.8 py-2.2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                    Tambah
                </a>
            </div>
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6 class="font-bold">Blog Posts Table</h6>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2">
                    @include('dashboard/components/table', [
                        "theads" => ["Author", "Title", "Category", "Dibuat", "action"],
                        "posts" => $blogs
                    ])
                </div>
            </div>
        </div>

        @if (!empty($blogsUser))
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <h6 class="font-bold">Blogs User Table (Only Admin)</h6>
                        <p>Admin dapat take down, postingan yang dibuat user</p>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2">
                        @include('dashboard/components/table', [
                            "theads" => ["Author", "Title", "Category", "Dibuat", "action"],
                            "posts" => $blogsUser,
                        ])
                    </div>
                    @if ($blogsUser->hasPages())
                        <div class="md:mx-10 mx-5 my-8">
                            {{ $blogsUser->links() }}
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
@endsection