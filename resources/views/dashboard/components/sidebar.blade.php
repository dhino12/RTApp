{{-- sidenav --}}
<aside
    class="max-w-62.5 ease-nav-brand z-990 fixed inset-y-0 my-4 ml-4 block w-full -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-white p-0 antialiased shadow-none transition-transform duration-200 xl:left-0 xl:translate-x-0 xl:bg-transparent"
>
    <div class="h-20">
        <i class="absolute top-0 right-0 hidden p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden" sidenav-close></i>
        <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700" href="javascript:;" target="_blank">
            <h1 class="font-bold text-2xl">Informasi Warga</h1>
            <span class="font-semibold transition-all duration-200 ease-nav-brand">RT002/RW02 Jatibening Baru</span>
        </a>
    </div>
    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />
    <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
        <ul class="flex flex-col pl-0 mb-0">
            <li class="mt-0.5 w-full">
                <a class="{{ Request::is('dashboard') ? 'active' : ''  }} py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" 
                    href="/dashboard/">
                    <div class="{{ Request::is('dashboard') ? 'active-tab' : ''  }} shadow-soft-2xl bg-white mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5 p-5">
                        <span class="material-symbols-outlined text-[20px] text-[20px]">
                            dashboard
                        </span>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dashboard</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class="{{ Request::is('dashboard/blogs') ? 'active' : ''  }} py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" 
                    href="/dashboard/blogs"
                >
                    <div class="{{ Request::is('dashboard/blogs') ? 'active-tab' : ''  }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <span class="material-symbols-outlined text-[20px]">
                            vertical_split
                        </span>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Blogs</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class="{{ Request::is('dashboard/gallery') ? 'active' : ''  }} py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" 
                    href="/dashboard/gallery">
                    <div class="{{ Request::is('dashboard/gallery') ? 'active-tab' : ''  }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <span class="material-symbols-outlined text-[20px]">
                            gallery_thumbnail
                        </span>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Gallery</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class="{{ Request::is('dashboard/profile') ? 'active' : ''  }} py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" 
                    href="/dashboard/profile">
                    <div class="{{ Request::is('dashboard/profile') ? 'active-tab' : ''  }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <span class="material-symbols-outlined text-[20px]">
                            account_circle
                        </span>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Profile</span>
                </a>
            </li>

            <li class="w-full mt-4">
                <h6 class="pl-6 ml-2 mb-3 text-xs font-bold leading-tight uppercase opacity-60">Tentang RT002</h6>
            </li>
            <li class="mt-0.5 w-full">
                <a class="{{ Request::is('dashboard/about') ? 'active' : ''  }} py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" 
                    href="/dashboard/about"
                >
                    <div class="{{ Request::is('dashboard/about') ? 'active-tab' : ''  }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <span class="material-symbols-outlined text-[20px]">
                            home_app_logo
                        </span>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">About</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class="{{ Request::is('about') ? 'login' : ''  }} py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" href="../pages/sign-in.html">
                    <div class="{{ Request::is('about') ? 'active-tab' : ''  }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <span class="material-symbols-outlined text-[20px]">
                            login
                        </span>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Sign In</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" href="../pages/sign-up.html">
                    <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <span class="material-symbols-outlined text-[20px]">
                            app_registration
                        </span>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Sign Up</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="mx-4">
        <!-- load phantom colors for card after: -->
        <p
            class="invisible hidden text-gray-800 text-red-500 text-red-600 after:bg-gradient-to-tl after:from-gray-900 after:to-slate-800 after:from-blue-600 after:to-cyan-400 after:from-red-500 after:to-yellow-400 after:from-green-600 after:to-lime-400 after:from-red-600 after:to-rose-400 after:from-slate-600 after:to-slate-300 text-lime-500 text-cyan-500 text-slate-400 text-fuchsia-500"
        ></p>
        <div
            class="after:opacity-65 after:bg-gradient-to-tl after:from-slate-600 after:to-slate-300 relative flex min-w-0 flex-col items-center break-words rounded-2xl border-0 border-solid border-blue-900 bg-white bg-clip-border shadow-none after:absolute after:top-0 after:bottom-0 after:left-0 after:z-10 after:block after:h-full after:w-full after:rounded-2xl after:content-['']"
            sidenav-card
        >
            <div class="mb-7.5 absolute h-full w-full rounded-2xl bg-cover bg-center" style="background-image: url('./assets/img/curved-images/white-curved.jpeg');"></div>
            <div class="relative z-20 flex-auto w-full p-4 text-left text-white">
                <div class="flex items-center justify-center w-8 h-8 mb-4 text-center bg-white bg-center rounded-lg icon shadow-soft-2xl">
                    <i class="top-0 z-10 text-lg leading-none text-transparent ni ni-diamond bg-gradient-to-tl from-slate-600 to-slate-300 bg-clip-text opacity-80" sidenav-card-icon></i>
                </div>
                <div class="transition-all duration-200 ease-nav-brand">
                    <h6 class="mb-0 text-white">Need help?</h6>
                    <p class="mt-0 mb-4 text-xs font-semibold leading-tight">Please check our docs</p>
                    <a
                        href="https://www.creative-tim.com/learning-lab/tailwind/html/quick-start/soft-ui-dashboard/"
                        target="_blank"
                        class="inline-block w-full px-8 py-2 mb-0 text-xs font-bold text-center text-black uppercase transition-all ease-in bg-white border-0 border-white rounded-lg shadow-soft-md bg-150 leading-pro hover:shadow-soft-2xl hover:scale-102"
                    >
                        Documentation
                    </a>
                </div>
            </div>
        </div>
        <!-- pro btn  -->
        <a
            class="inline-block w-full px-6 py-3 my-4 text-xs font-bold text-center text-white uppercase align-middle transition-all ease-in border-0 rounded-lg select-none shadow-soft-md bg-150 bg-x-25 leading-pro bg-gradient-to-tl from-purple-700 to-pink-500 hover:shadow-soft-2xl hover:scale-102"
            target="_blank"
            href="https://www.creative-tim.com/product/soft-ui-dashboard-pro-tailwind?ref=sidebarfree"
        >
            Upgrade to pro
        </a>
    </div>
</aside>
<!-- end sidenav -->