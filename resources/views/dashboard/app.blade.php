<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ACS Admin Dashboard</title>
    {{-- Tailwind CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://kit.fontawesome.com/c5608c8cee.js" crossorigin="anonymous"></script>
    @livewireStyles

</head>

<body class="bg-slate-200">
    <header>
        <nav
            class="bg-gradient-to-b from-slate-900 to-gray-700 px-2 sm:px-4 py-2.5 dark:bg-gray-900 fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
            <div class="flex flex-wrap justify-between items-center mx-auto">
                <a href="https://albertacraneservice.com/" wire:navigate class="flex items-center">
                    <img src="{{ asset('img/acs-logo-new.png') }}" class="mr-3 h-6 sm:h-16"
                        alt="Used Cranes | Alberta Crane Service">
                </a>
                <x-admin-nav />
            </div>
        </nav>
    </header>
    <!-- Main content area -->
    <main class="block min-h-screen">
        <div class="w-full px-1  lg:h-screen lg:px-2 lg:py-4">
            <div
                class="mt-20 md:mt-0 flex flex-col md:flex-row md:justify-between mb-5 bg-slate-100 rounded-md shadow-md p-2">
                <h2 class="text-xl uppercase font-bold">Admin Dashboard</h2>
                <span class="text-xl font-bold">
                    Welcome! {{ucwords(Auth::user()->name)}}
                </span>
            </div>
            <div class='flex gap-2 pb-10 w-full'>
                <div class="hidden lg:block lg:w-1/4 space-y-5">
                    <div class="bg-slate-100 shadow-md rounded-md">
                        <h3 class="text-white bg-cyan-700 rounded-tl-md rounded-tr-md p-2 hover:bg-cyan-800">
                            <strong>Menu</strong>
                        </h3>
                        <ul class="space-y-2 p-4">
                            <a href='{{ route('admin.dashboard') }}' wire:navigate>
                                <li class="hover:text-white hover:bg-cyan-700 rounded-md p-2 cursor-pointer">
                                    Dashboard
                                </li>
                            </a>
                            <a href='{{ route('profile.user') }}' wire:navigate>
                                <li class="hover:text-white hover:bg-cyan-700 rounded-md p-2 cursor-pointer">
                                    My Account
                                </li>
                            </a>
                            <a href='{{route('logout.user')}}' wire:navigate>
                                <li class="hover:text-white hover:bg-cyan-700 rounded-md p-2 cursor-pointer">
                                    Logout
                                </li>
                            </a>
                        </ul>
                    </div>
                    <div class="bg-slate-100 shadow-md rounded-md">
                        <h3 class="text-white bg-cyan-700 rounded-tl-md rounded-tr-md p-2 hover:bg-cyan-800">
                            <strong>Inventory</strong>
                        </h3>
                        <ul class="space-y-2 p-4">
                            <a href='{{ route('add.crane.inventory') }}' wire:navigate>
                                <li class="hover:text-white hover:bg-cyan-700 rounded-md p-2 cursor-pointer">
                                    Add New Crane
                                </li>
                            </a>
                            <a href='{{ route('show.inventory') }}' wire:navigate>
                                <li class="hover:text-white hover:bg-cyan-700 rounded-md p-2 cursor-pointer">
                                    Show Inventory
                                </li>
                            </a>
                            <a href='{{ route('add.part.inventory') }}' wire:navigate>
                                <li class="hover:text-white hover:bg-cyan-700 rounded-md p-2 cursor-pointer">
                                    Add Part
                                </li>
                            </a>
                            <a href='{{ route('add.equipment.inventory') }}' wire:navigate>
                                <li class="hover:text-white hover:bg-cyan-700 rounded-md p-2 cursor-pointer">
                                    Add Equipment
                                </li>
                            </a>

                            {{-- <li class="hover:text-white hover:bg-cyan-700 rounded-md p-2 cursor-pointer">
                                Add Crane Categories
                            </li>
                            <li class="hover:text-white hover:bg-cyan-700 rounded-md p-2 cursor-pointer">
                                Add Part Categories
                            </li> --}}
                        </ul>
                    </div>
                    <div class="bg-slate-100 shadow-md rounded-md">
                        <h3 class="text-white bg-cyan-700 rounded-tl-md rounded-tr-md p-2 hover:bg-cyan-800">
                            <strong>User Management</strong>
                        </h3>
                        <ul class="space-y-2 p-4">

                            <li class="hover:text-white hover:bg-cyan-700 rounded-md p-2 cursor-pointer">
                                Coming Soon
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="w-full block bg-slate-100 shadow-md rounded-md lg:h-fit xl:w-3/4">
                    {{ $slot }}
                </div>
            </div>
            <div class="flex justify-between mb-5 bg-slate-100 rounded-md shadow-md p-2">
                Some random information here?
            </div>
        </div>
        </div>
    </main>
    <div class="block p-2 bg-slate-200">&nbsp;</div>
    <!-- end main content -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    @livewireScripts
    @yield('scripts')
</body>

</html>
