<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TailAdmin') }}</title>

    {{-- ✅ Tailwind CSS via CDN --}}
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->


    {{-- ✅ Tailwind Config Override --}}
    <!-- <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4f46e5',   // Indigo-600
                        success: '#22c55e',   // Green-500
                        warning: '#facc15',   // Yellow-400
                        danger: '#ef4444',    // Red-500
                        slate: {
                            950: '#0f172a',
                        }
                    },
                    fontFamily: {
                        sans: ['Prompt', 'ui-sans-serif', 'system-ui', 'sans-serif']
                    },
                    spacing: {
                        '128': '32rem',
                        '144': '36rem',
                    }
                }
            }
        }
    </script> -->

    {{-- ✅ CSS จาก TailAdmin --}}
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('/assets/css/content-all.css') }}"> -->

    {{-- ✅ โหลดฟอนต์ Prompt จาก Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body     
x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value =&gt; localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{'dark bg-gray-900': darkMode === true}" class="">

    <!-- ===== Preloader Start ===== -->
    @include('layouts.preloader')
    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">

        <!-- ===== Sidebar Start ===== -->
        @include('layouts.sidebar')
        <!-- ===== Sidebar End ===== -->

        <!-- ===== Content Area Start ===== -->
        <div
            class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto"
        >

        <!-- Small Device Overlay Start -->
        @include('layouts.overlay')
        <!-- Small Device Overlay End -->

        <!-- ===== Header Start ===== -->
        @include('layouts.header')
        <!-- ===== Header End ===== -->

        <!-- ===== Main Content Start ===== -->
        <main>
            @yield('content')
        </main>
        <!-- ===== Main Content End ===== -->
        </div>
        <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->

    <!-- <script src="{{ asset('/assets/js/index.js') }}"></script> -->
    <script src="{{ asset('/assets/js/bundle.js') }}"></script>
    

    {{-- Global Toast Notifications --}}
    {{-- <div class="fixed z-50 space-y-4 top-4 right-4">
        @foreach (['success', 'error', 'warning', 'info'] as $type)
        @if (session($type))
        <x-toast :type="$type" :title="ucfirst($type)" :message="session($type)" />
        @endif
        @endforeach
    </div> --}}

    <div id="toast-container" class="toast-container fixed top-4 right-4 z-[9999] space-y-4">

        @foreach (['success', 'error', 'warning', 'info'] as $type)
        @if (session()->has($type))
        <x-toast :type="$type" :title="ucfirst($type)" :message="session($type)" />
        @endif
        @endforeach
    </div>

    <style>
        .toast-container{
            top: 95px;
        }

        .animate-slide-in {
            animation: slide-in 0.4s ease-out;
        }

        @keyframes slide-in {
            0% {
                transform: translateX(100%);
                opacity: 0;
            }

            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

    </style>

    <script>
        setTimeout(() => {
            document.querySelectorAll('#toast-container .rounded-xl').forEach(el => el.remove());
        }, 4000);

    </script>
</body>
</html>
