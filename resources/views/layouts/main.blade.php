<!DOCTYPE html>
<html lang="en" class="scroll-smooth scroll-pt-32">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="theme-color" content="#db5945">
        <link rel="manifest" href="/assets/manifest.json">
        <link rel="apple-touch-icon" sizes="72x72" href="/assets/images/icons/icon-72x72.png" />
        <link rel="icon" type="image/png" href="/assets/images/icons/icon-512x512.png" />
        <title>Hello</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Afacad:wght@400;500;600;700&family=Inter:wght@400;600;700;900&family=Roboto:wght@300&display=swap"
            rel="stylesheet"
        />
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        />
        <script
            src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous"></script>
        <link href="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
        <script src="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.js"></script>
        <style type="text/tailwindcss">
            h1 {
                @apply text-4xl;
            }
            #body h1 {
                @apply text-3xl font-bold my-1;
            }
            ol {
                list-style-type: auto;
                margin-left: 2.5vh
            }
            ul {
                list-style-type: auto;
            }
            .item .activeIcon {
                @apply hidden;
            }
    
            .item.active .inactiveIcon {
                @apply hidden;
            }
    
            .item.active .activeIcon {
                @apply block;
            }
    
            .item:not(.active) .content {
                @apply h-0 overflow-hidden py-0;
            }
    
            .item .content {
                @apply py-8 px-3 ;
            }

            .attachment__caption {
                @apply text-center;
            }
            .dropdown:hover .dropdown-menu {
                display: block;
                list-style: none
            }

            .waves {
                width: 100%;
                height: 16vh;
                margin-bottom: -7px;
                min-height: 100px;
                max-height: 150px
            }

            .waves.waves-sm {
                height: 50px;
                min-height: 50px
            }

            .waves.no-animation .moving-waves>use {
                animation: none
            }

            .wave-rotate {
                transform: rotate(180deg)
            }

            .moving-waves>use {
                animation: f 40s cubic-bezier(.55,.5,.45,.5) infinite
            }

            .moving-waves>use:first-child {
                animation-delay: -2s;
                animation-duration: 11s
            }

            .moving-waves>use:nth-child(2) {
                animation-delay: -4s;
                animation-duration: 13s
            }

            .moving-waves>use:nth-child(3) {
                animation-delay: -3s;
                animation-duration: 15s
            }

            .moving-waves>use:nth-child(4) {
                animation-delay: -4s;
                animation-duration: 20s
            }

            .moving-waves>use:nth-child(5) {
                animation-delay: -4s;
                animation-duration: 25s
            }

            .moving-waves>use:nth-child(6) {
                animation-delay: -3s;
                animation-duration: 30s
            }

            @keyframes f {
                0% {
                    transform: translate3d(-90px,0,0)
                }

                to {
                    transform: translate3d(85px,0,0)
                }
            }

            @media (max-width: 767.98px) {
                .waves {
                    height:40px;
                    min-height: 40px
                }

                hr.horizontal {
                    background-color: transparent
                }

                hr.horizontal:not(.dark) {
                    background-image: linear-gradient(90deg,hsla(0,0%,100%,0),#fff,hsla(0,0%,100%,0))
                }

                hr.horizontal.vertical {
                    transform: rotate(90deg)
                }

                hr.horizontal.dark {
                    background-image: linear-gradient(90deg,transparent,rgba(0,0,0,.4),transparent)
                }
            }

            .card-hover {
                transition: .2s ease-out;
                overflow: hidden;
                transform-origin: 50% 0;
                transform: perspective(999px) rotateX(0deg) translateZ(0);
                backface-visibility: hidden;
                will-change: transform,box-shadow;
            }

            .card-hover:hover {
                transform: perspective(999px) rotateX(5deg) translate3d(0,-4px, 5px);
            }
            /*Overrides for Tailwind CSS */ 
        </style>
        <script>
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        fontFamily: {
                            afacad: ["Afacad"],
                            'sans-serif': ['sans-serif']
                        },
                        animation: {
                            "bounce-slow": "bounce 3s ease-in-out infinite",
                            heightIn: "heightIn .3s ease-in-out forwards",
                            heightOut: "heightIn .3s ease-in-out reverse",
                            showUpIcon: "showUpIcon .8s ease-in-out infinite alternate",
                        },
                        keyframes: {
                            heightIn: {
                                "0%": { height: "85px" },
                                "100%": { height: "300px" },
                            },
                            showUpIcon: {
                                "0%": {
                                    scale: '0.6',
                                    rotate: "80deg",
                                    opacity: '0'
                                },
                                "100%": {
                                    scale: "1.2",
                                    rotate: "0deg",
                                    opacity: '1'
                                }
                            },
                        },
                    },
                },
            };
        </script>
    </head>
    <body class="bg-slate-100">
        <header>
            @yield('header')
        </header>
        <main>
            @yield('container')
        </main>
        <footer class="relative">
            @yield('footer')
        </footer>

        <!-- <script src="https://unpkg.com/@themesberg/flowbite@1.1.1/dist/flowbite.bundle.js"></script> -->
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script>
            const dataCollapsNavbar = document.querySelector(
                "[data-collapse-toggle='navbar-default']"
            );
            const tagNav = document.querySelector("nav");
            const navbarDefault = document.querySelector("#navbar-default");

            dataCollapsNavbar.addEventListener("click", function () {
                if (navbarDefault.className.includes("hidden")) {
                    tagNav.classList.add("animate-heightIn");
                } else {
                    tagNav.classList.add("animate-heightOut");
                }
                navbarDefault.classList.toggle("hidden");
                navbarDefault.classList.toggle("flex");
                setTimeout(() => {
                    tagNav.classList.remove("animate-heightIn");
                    tagNav.classList.remove("animate-heightOut");
                }, 300);
            });
        </script>
        
        <script>
            let items = document.querySelectorAll("#accordion .item");
            items.forEach((item) => {
                item.addEventListener('click', (e) => { 
                    items.forEach((otherItem) => { 
                        if (otherItem !== item && otherItem.classList.contains("active")) {
                            otherItem.classList.remove("active");
                            otherItem.querySelector(".content").style.height = 0;
                        }
                    });
                    
                    item.classList.toggle("active");

                    if (item.classList.contains("active")) {
                        item.querySelector(".content").style.height = `${item.querySelector(".content").scrollHeight + 100}px`;
                    } else {
                        item.querySelector(".content").style.height = 0;
                    }
                });
            });
        </script>
        @yield('scripts')
    </body>
</html>
