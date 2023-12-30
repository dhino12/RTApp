@extends('dashboard/layouts/main')

@section('container')
<div class="w-full px-6 py-6 mx-auto">
    <style>
        .trix-button-group.trix-button-group--file-tools {
            display:none;
        }
        button[data-align='left bottom'] {
            background: #ff000099;
            position: absolute;
            border: 2px solid red;
            transform: translate3d(32px, -12px, 0px) scale3d(1, 1, 1) !important;
            visibility: hidden;
            transition: all .2s ease;
        }
        .filepond--item:hover button[data-align="left bottom"] {
            transform: translate3d(32px, 0px, 0px) !important;
            visibility: visible;
            cursor: pointer;
        }
    </style>
    
    <!-- breadcrumb -->
    @include('dashboard/components/navbar')
    <!-- cards row 4 -->
    <div class="flex flex-col lg:flex-row -mx-3 gap-5">
        <div class="lg:w-72 lg:mr-0 h-fit mx-5 px-5 pt-5 pb-2 lg:sticky top-32 bg-white shadow-soft-xxs rounded-xl">
            <li class="list-none">
                <a href="#profile" class="flex items-center gap-3 px-4 py-2 transition-colors rounded-lg ease-soft-in-out text-slate-500 hover:bg-gray-200">
                    <span class="material-symbols-outlined">
                        account_circle
                    </span>
                    <span class="">Profile</span>
                </a>
            </li>
            <li class="list-none my-2">
                <a href="#delete" class="flex items-center gap-3 px-4 py-2 transition-colors rounded-lg ease-soft-in-out text-slate-500 hover:bg-gray-200">
                    <span class="material-symbols-outlined">
                        delete
                    </span>
                    <span class="inline-block">Delete</span>
                </a>
            </li>
        </div>
        <div class="flex-1 px-5 mt-7">
            <div class="flex items-center gap-5 mb-8 p-5 shadow-xl shadow-slate-100 bg-white rounded-xl">
                {{-- <label for="images" class="relative group">
                    @if ($profile->images->name)
                        <img 
                            src="/images/{{ $profile->images->name }}"
                            alt="" 
                            class="filepond w-20 h-20 rounded-xl hover:cursor-pointer hover:hue-rotate-60"
                        >
                    @else
                        <img alt="" class="filepond w-20 h-20 rounded-xl hover:cursor-pointer hover:hue-rotate-60">
                    @endif
                </label> --}}
                @if ($profile->images?->name != '')
                    <div class="relative group">
                        <img src="/images/{{ $profile->images->name }}" class="w-20 h-20 rounded-xl hover:hue-rotate-60">
                        <form action="/delete-force" method="post" enctype="multipart/form-data" >
                            @csrf
                            @method("delete")
                            <button class="absolute right-5 top-5 bottom-0 rounded-full bg-red-500/80 w-10 h-10 invisible group-hover:visible group-hover:cursor-pointer">
                                X
                            </button>
                        </form>
                    </div>
                @else
                    <form action="/dashboard/profile/upload" method="post" enctype="multipart/form-data" class="text-center">
                        @csrf
                        <input 
                            type="file"
                            name="images"
                            class="filepond w-20 h-20"
                        />
                    </form>
                @endif
                <div>
                    <h1 class="font-bold text-2xl tracking-normal">{{ $profile->name }}</h1>
                    <p>{{ $profile->username }}</p>
                </div>
            </div>
            <div id="profile" class="flex flex-col gap-5 p-5 mb-8 bg-white shadow-xl shadow-slate-100 rounded-xl">
                <h1 class="font-bold text-xl tracking-normal">Basic Info</h1>
                @if(session()->has('success'))
                    <div class="bg-lime-100 border border-green-400 text-green-800 px-4 py-3 rounded relative mb-5" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="/dashboard/profile/{{ $profile->id }}" method="post" class="flex justify-center flex-col my-5 gap-5 w-full">
                    @csrf
                    @method("put")
                    <div class="flex gap-5 md:flex-row flex-col">
                        <span class="w-full">
                            <label for="title" class="font-semibold">Name</label>
                            <input 
                                type="text" 
                                name="name"
                                id="text" 
                                class="w-full mt-2 rounded-md h-10 px-2 py-2 border-2 border-slate-200 text-slate-800 block text-base placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-red-500 invalid:focus:ring-red-700 invalid:focus:border-red-700 peer" 
                                placeholder="Full Name"
                                value="{{ old('title', $profile->name) }}"
                                required
                            >
                            @error('name')
                                <div class="text-red-500 font-bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </span>
                        <span class="w-full">
                            <label for="username" class="font-semibold">username</label>
                            <input 
                                type="text" 
                                name="username" 
                                id="username" 
                                class="w-full mt-2 rounded-md h-10 px-2 py-2 border-2 border-slate-200 text-slate-800 block text-base placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-red-500 invalid:focus:ring-red-700 invalid:focus:border-red-700 peer" 
                                placeholder="Username..."
                                value="{{ old('username', $profile->username) }}"
                                required
                            >
                            @error('username')
                                <div class="text-red-500 font-bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </span>
                    </div>
                    <div class="flex gap-5 md:flex-row flex-col">
                        <span class="w-full">
                            <label for="email" class="font-semibold">Email</label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                class="w-full mt-2 rounded-md h-10 px-2 py-2 border-2 border-slate-200 text-slate-800 block text-base placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-red-500 invalid:focus:ring-red-700 invalid:focus:border-red-700 peer" 
                                placeholder="Judul Kegiatan Gallery..."
                                value="{{ old('email', $profile->email) }}"
                                required
                            >
                            @error('email')
                                <div class="text-red-500 font-bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </span>
                        <span class="w-full">
                            <label for="password" class="font-semibold">password</label>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                class="w-full mt-2 rounded-md h-10 px-2 py-2 border-2 border-slate-200 text-slate-800 block text-base placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-red-500 invalid:focus:ring-red-700 invalid:focus:border-red-700 peer"
                                placeholder="Password"
                                value=""
                            >
                            @error('password')
                                <div class="text-red-500 font-bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </span>
                        
                        {{-- <input type="file" id="images" name="images" class="invisible" accept="image/png, image/jpeg"> --}}
                    </div>
                    <div id="">
                        <label for="description" class="font-semibold mb-2">Deskripsi Diri Kamu</label>
                        <input 
                            type="hidden"
                            name="self_information" 
                            id="self_information" 
                            class="w-full mt-2 rounded-md h-10 px-2 py-2 border-2 border-slate-200 block text-base placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-red-500 invalid:focus:ring-red-700 invalid:focus:border-red-700 peer" 
                            value="{{ old('self_information', $profile->self_information) }}"
                            placeholder="Deskripsikan dirimu ...."
                        >
                        <trix-editor input="self_information" placeholder="masukan konten deskripsi"></trix-editor>
                    </div>
                    <div class="mt-5"> 
                        <button type="submit" class="bg-gradient-to-l from-cyan-400 to-blue-600 px-4 py-2 mt-3 rounded-lg font-semibold text-white active:scale-[0.95] hover:scale-[1.05] transition-all lg:mt-0">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
            <div id="delete" class="mb-8 p-5 shadow-xl shadow-slate-100 bg-white rounded-xl">
                <h5 class="font-bold text-lg">Delete Account</h5>
                <p class="mb-0 leading-normal text-sm text-red-700 font-semibold">
                    Setelah menghapus akun, semua data termasuk gallery & blog yang kamu posting akan terhapus, <br> dan tidak ada jalan untuk kembali (recover). Harap pastikan.
                </p>
                <div class="flex items-center gap-5 justify-between mt-5">
                    <span>
                        <p class="font-bold">Confirm</p>
                        <p class="font-medium text-sm">Saya ingin menghapus akun.</p>
                    </span>
                    <form action="/dashboard/profile/{{ $profile->id }}" method="post">
                        @csrf
                        @method("delete")
                        <button 
                            type="submit"
                            class="bg-gradient-to-l from-red-400 to-red-600 px-4 py-2 mt-3 rounded-lg font-semibold text-white active:scale-[0.95] hover:scale-[1.05] transition-all lg:mt-0"
                            onclick="return confirm('Yakin Hapus Akun ?')"
                        >
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>

<script>
    // We register the plugins required to do 
    // image previews, cropping, resizing, etc.
    // We want to preview images, so we register
    FilePond.registerPlugin(
        FilePondPluginImagePreview,
        FilePondPluginFileValidateSize,
        FilePondPluginFileValidateType
    );

    // Select the file input and use 
    // create() to turn it into a pond
    FilePond.create(
        document.querySelector('input[type="file"]'),
        {
            labelIdle: `<p class="text-xs">Drag & Drop or <span class="filepond--label-action">Browse</span></p>`,
            imagePreviewHeight: 170,
            imageCropAspectRatio: '1:1',
            imageResizeTargetWidth: 200,
            imageResizeTargetHeight: 200,
            stylePanelLayout: 'compact circle',
            styleLoadIndicatorPosition: 'center bottom',
            styleProgressIndicatorPosition: 'right bottom',
            styleButtonRemoveItemPosition: 'left bottom',
            styleButtonProcessItemPosition: 'right bottom',
            allowFileSizeValidation: true,
            labelMaxFileSizeExceeded: 'File terlalu besar',
            maxFileSize: '50MB',
            acceptedFileTypes: ['image/png',"image/gif","image/jpeg"],
        }
    );
    
    FilePond.setOptions({
        server: {
            process: '/upload-force',
            revert: '/delete-force',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });
</script>
<script>
    window.addEventListener('load', function (event) {
        // delete tmp
        fetch('/delete-tmp', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                username: '{{ auth()->user()->username }}'
            })
        })
            .then(response => response.json())
            .then(data => console.log(data))
    });
</script>
@endsection