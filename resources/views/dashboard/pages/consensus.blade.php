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
            <div class="mb-5">
                <a href="/dashboard/consensus/create" class="inline-block bg-gradient-to-tl from-cyan-400 to-blue-400 active:scale-[0.95] transition-all hover:scale-[1.05] px-2.5 text-sm rounded-1.8 py-2.2 whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                    Tambah
                </a>
                <button id="open-btn" class="inline-block bg-gradient-to-tl from-lime-400 to-green-400 active:scale-[0.95] transition-all hover:scale-[1.05] px-2.5 text-sm rounded-1.8 py-2.2 whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                    Import CSV
                </button>
                <form action="/dashboard/consensus/export" method="post" class="inline-block">
                    @csrf
                    <button class="bg-gradient-to-tl from-red-400 to-red-400 active:scale-[0.95] transition-all hover:scale-[1.05] px-2.5 text-sm rounded-1.8 py-2.2 whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                        Export CSV
                    </button>
                </form>
            </div>
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6 class="font-bold">Informasi Warga</h6>
                    <p>Data yang ditampilkan user hanya yang terbaru (paling atas) berdasarkan <b>tanggal dibuat</b></p>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2">
                    @include('dashboard/components/table-consensus', [
                        "theads" => ["Author", "Laki-laki", "Perempuan", "Total Populasi", "Total Keluarga", "Dibuat"],
                        "posts" => $consensus
                    ])
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal" class="fixed hidden top-0 bottom-0 left-0 z-0 insert-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-[70vh] shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-purple-100">
                <span class="material-symbols-outlined">
                    csv
                </span>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">Import CSV</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Tolong gunakan <a href="" class="text-red-800 font-bold">format ini</a> agar hasil yang diharapkan sesuai. <br>
                    Pastikan sudah di export ke csv, bagaimana caranya ? <a href="https://convertio.co/xlsx-csv/" class="text-red-800 font-bold">ini caranya</a>
                </p>
            </div>
            <form action="/dashboard/consensus/import" method="post" enctype="multipart/form-data" class="items-center px-4 py-3 flex flex-col justify-center">
                @csrf
                <input type="file" name="csv_file" accept=".csv"/>
                <button id="ok-btn" class="bg-gradient-to-tl from-lime-400 to-green-400 active:scale-[0.95] transition-all hover:scale-[1.05] px-2.5 py-2.2 my-3 text-sm rounded-1.8 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                    submit
                </button>
            </form>
        </div> 
    </div>
</div>
@endsection

@section('script')

<script>
    let modal = document.getElementById('modal');
    let btn = document.getElementById('open-btn');
    let button = document.getElementById('ok-btn');
    console.log(btn);
    btn.onclick = function () {
        console.log(modal);
        modal.style.display = 'block';
    };

    button.onclick = function () {
        modal.style.display = 'none';
    };
    
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }    
</script>
    
@endsection