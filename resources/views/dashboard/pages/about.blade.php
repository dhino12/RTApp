@extends('dashboard/layouts/main')

@section('container')
<div class="w-full px-6 py-6 mx-auto">
    
    <!-- breadcrumb -->
    @include('dashboard/components/navbar')
    <!-- cards row 4 -->
    <div class="flex flex-col -mx-3 gap-5">
        <div class="flex-1 px-5 w-2/3 mx-auto mt-5"> 
            <div id="profile" class="flex flex-col gap-5 p-5 mb-8 bg-white shadow-xl shadow-slate-100 rounded-xl">
                <h1 class="font-bold text-xl tracking-normal">Basic Info</h1>

                <form action="" method="post" class="flex justify-center flex-col my-5 gap-5 w-full">
                    <span class="w-full">
                        <label for="title" class="font-bold text-black text-sm">Tentang RT002</label>
                        <textarea type="text" name="text" id="text" class="w-full mt-2 rounded-md h-10 px-2 py-2 border-2 border-slate-200 block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-red-500 invalid:focus:ring-red-700 invalid:focus:border-red-700 peer"
                            placeholder="Tentang RT002, lingkungan, atau kegiatan, dll" rows="5" required></textarea>
                    </span>
                    <span class="w-full">
                        <label for="visi" class="font-bold text-black text-sm">Visi</label>
                        <input type="text" name="visi" id="visi" class="w-full mt-2 rounded-md h-10 px-2 py-2 border-2 border-slate-200 block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-red-500 invalid:focus:ring-red-700 invalid:focus:border-red-700 peer" 
                            placeholder="masukan visi" required>
                    </span>
                    <span class="w-full">
                        <label for="misi" class="font-bold text-black text-sm">Misi</label>
                        <input type="text" name="misi" id="misi" class="w-full mt-2 rounded-md h-10 px-2 py-2 border-2 border-slate-200 block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-red-500 invalid:focus:ring-red-700 invalid:focus:border-red-700 peer" 
                            placeholder="masukan misi" required>
                    </span>
                    <span class="w-full">
                        <label for="email" class="font-bold text-black text-sm">Image</label>
                        <input type="file" id="images" name="images" accept="image/png, image/jpeg" class="block mt-3">
                    </span>
                    <div class="mt-5"> 
                        <button type="submit" class="bg-gradient-to-l from-cyan-400 to-blue-600 px-4 py-2 mt-3 rounded-lg font-semibold text-white active:scale-[0.95] hover:scale-[1.05] transition-all lg:mt-0">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection