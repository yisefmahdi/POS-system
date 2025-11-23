    <header class="bg-white shadow fixed w-full top-0 z-50">
        <div class="flex items-center justify-between px-4 py-3">

            <!-- Mobile Menu Button -->
            <button id="menuBtn" class="text-gray-700 md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <h1 class="text-xl font-semibold">POS Systeem</h1>

            <!-- Icons -->
            <div class="flex items-center gap-4">
                <div class="relative flex items-center gap-4">

                    <!-- Notifications Button -->
                    <button class="relative">
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-1 rounded">3</span>
                        <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>


                    <!-- Dropdown Button -->
                    <div class="relative">
                        <button id="profileBtn" class="flex items-center gap-2 focus:outline-none">
                            <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}"
                                class="h-9 w-9 rounded-full" />
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="profileMenu"
                            class="hidden absolute right-0 mt-2 w-44 bg-white shadow-lg rounded-lg py-2 z-50">
                            <!-- Profile Link -->
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 hover:bg-gray-100">Profiel</a>

                            <!-- Logout Form -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 hover:bg-gray-100">Uitloggen</button>
                            </form>
                        </div>
                    </div>


                </div>


            </div>
        </div>
    </header>
