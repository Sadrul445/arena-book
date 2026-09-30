<nav class="fixed top-0 z-50 w-full">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div
            class="mt-4 flex h-16 items-center justify-between
                   rounded-2xl border border-white/10
                   bg-white/5 px-5 backdrop-blur-xl"
        >

            {{-- Logo --}}
            <a
                href="/"
                class="text-xl font-black tracking-tight"
            >
                Arena<span class="text-lime-400">Book</span>
            </a>


            {{-- Desktop Navigation --}}
            <div class="hidden items-center gap-8 md:flex">

                <a
                    href="#sports"
                    class="text-sm text-gray-300 transition hover:text-white"
                >
                    Sports
                </a>

                <a
                    href="#facilities"
                    class="text-sm text-gray-300 transition hover:text-white"
                >
                    Facilities
                </a>

                <a
                    href="#how-it-works"
                    class="text-sm text-gray-300 transition hover:text-white"
                >
                    How It Works
                </a>

                <a
                    href="#about"
                    class="text-sm text-gray-300 transition hover:text-white"
                >
                    About
                </a>

            </div>


            {{-- Actions --}}
            <div class="hidden items-center gap-3 md:flex">

                <a
                    href="#"
                    class="rounded-full px-4 py-2 text-sm text-gray-300
                           transition hover:bg-white/10"
                >
                    Login
                </a>

                <a
                    href="#sports"
                    class="rounded-full bg-lime-400 px-5 py-2
                           text-sm font-bold text-black
                           transition hover:scale-105"
                >
                    Book Now
                </a>

            </div>


            {{-- Mobile Menu Button --}}
            <button
                type="button"
                class="rounded-xl border border-white/10
                       p-2 text-gray-300 md:hidden"
            >
                ☰
            </button>

        </div>

    </div>

</nav>