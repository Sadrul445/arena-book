@extends('layouts.app')

@section('title', 'ArenaBook — Sports Booking')

@section('content')

    {{-- HERO SECTION --}}
    {{-- HERO SECTION --}}
<section class="relative min-h-screen overflow-hidden">

    {{-- Background Image --}}
    <div class="absolute inset-0">

        <img
            src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?auto=format&fit=crop&w=2200&q=85"
            alt="Football stadium"
            class="h-full w-full object-cover"
        >

        {{-- Dark Overlay --}}
        <div class="absolute inset-0 bg-black/70"></div>

        {{-- Gradient --}}
        <div
            class="absolute inset-0
                   bg-gradient-to-b
                   from-black/50
                   via-black/70
                   to-[#050505]"
        ></div>

    </div>


    {{-- Hero Content --}}
    <div
        class="relative mx-auto flex min-h-screen
               max-w-7xl items-center px-6 pt-32 pb-24"
    >

        <div class="w-full">

            {{-- Badge --}}
            <div
                class="mb-7 inline-flex items-center gap-2
                       rounded-full border border-white/15
                       bg-white/10 px-4 py-2
                       backdrop-blur-xl"
            >

                <span
                    class="h-2 w-2 rounded-full bg-lime-400"
                ></span>

                <span
                    class="text-xs font-semibold uppercase
                           tracking-[0.2em] text-gray-200"
                >
                    Sports Booking Platform
                </span>

            </div>


            {{-- Heading --}}
            <h1
                class="max-w-5xl text-5xl font-black
                       leading-[0.9] tracking-tight
                       sm:text-7xl lg:text-9xl"
            >

                PLAY

                <span class="text-lime-400">
                    YOUR
                </span>

                GAME.

            </h1>


            {{-- Description --}}
            <p
                class="mt-8 max-w-2xl text-lg leading-8
                       text-gray-300 sm:text-xl"
            >
                Discover premium football, cricket and swimming
                facilities. Choose your time and book your game
                in just a few clicks.
            </p>


            {{-- Booking Search --}}
            <div
                class="mt-10 max-w-5xl rounded-3xl
                       border border-white/15
                       bg-black/50 p-3
                       shadow-2xl
                       backdrop-blur-2xl"
            >

                <div
                    class="grid gap-3 md:grid-cols-4"
                >

                    {{-- Sport --}}
                    <div
                        class="rounded-2xl bg-white/10
                               px-5 py-4"
                    >

                        <label
                            class="block text-xs font-semibold
                                   uppercase tracking-wider
                                   text-gray-400"
                        >
                            Sport
                        </label>

                        <select
                            class="mt-2 w-full bg-transparent
                                   font-semibold text-white
                                   outline-none"
                        >

                            <option
                                value=""
                                class="bg-black"
                            >
                                Choose Sport
                            </option>

                            <option
                                value="football"
                                class="bg-black"
                            >
                                Football
                            </option>

                            <option
                                value="cricket"
                                class="bg-black"
                            >
                                Cricket
                            </option>

                            <option
                                value="swimming"
                                class="bg-black"
                            >
                                Swimming
                            </option>

                        </select>

                    </div>


                    {{-- Date --}}
                    <div
                        class="rounded-2xl bg-white/10
                               px-5 py-4"
                    >

                        <label
                            class="block text-xs font-semibold
                                   uppercase tracking-wider
                                   text-gray-400"
                        >
                            Date
                        </label>

                        <input
                            type="date"
                            class="mt-2 w-full bg-transparent
                                   font-semibold text-white
                                   outline-none"
                        >

                    </div>


                    {{-- Players --}}
                    <div
                        class="rounded-2xl bg-white/10
                               px-5 py-4"
                    >

                        <label
                            class="block text-xs font-semibold
                                   uppercase tracking-wider
                                   text-gray-400"
                        >
                            Players
                        </label>

                        <select
                            class="mt-2 w-full bg-transparent
                                   font-semibold text-white
                                   outline-none"
                        >

                            <option class="bg-black">
                                2 Players
                            </option>

                            <option class="bg-black">
                                4 Players
                            </option>

                            <option class="bg-black">
                                6 Players
                            </option>

                            <option class="bg-black">
                                8 Players
                            </option>

                            <option class="bg-black">
                                10+ Players
                            </option>

                        </select>

                    </div>


                    {{-- Search Button --}}
                    <button
                        type="button"
                        class="rounded-2xl
                               bg-lime-400
                               px-6 py-4
                               font-black text-black
                               transition duration-300
                               hover:scale-[1.02]
                               hover:bg-lime-300"
                    >
                        Find Availability →
                    </button>

                </div>

            </div>


            {{-- Small Info --}}
            <div
                class="mt-6 flex flex-wrap gap-x-8 gap-y-3
                       text-sm text-gray-400"
            >

                <span>
                    ✓ Instant Booking
                </span>

                <span>
                    ✓ Flexible Slots
                </span>

                <span>
                    ✓ Secure Payment
                </span>

            </div>

        </div>

    </div>

</section>


    {{-- SPORTS SECTION --}}
    <section id="sports" class="border-t border-white/10 py-24">

        <div class="mx-auto max-w-7xl px-6">

            <div class="mb-12">

                <p class="text-sm font-semibold uppercase
                           tracking-[0.3em] text-lime-400">
                    Choose Your Sport
                </p>

                <h2 class="mt-3 text-4xl font-bold sm:text-5xl">
                    What do you want to play?
                </h2>

            </div>


            <div class="grid gap-5 md:grid-cols-3">


                {{-- Football --}}
                <div
                    class="group rounded-3xl border border-white/10
                           bg-white/5 p-7 backdrop-blur-xl
                           transition duration-500
                           hover:-translate-y-2
                           hover:bg-white/10">

                    <div class="text-5xl">
                        ⚽
                    </div>

                    <h3 class="mt-8 text-2xl font-bold">
                        Football
                    </h3>

                    <p class="mt-3 text-gray-400">
                        Book your football arena
                        and enjoy your game.
                    </p>

                    <a href="#" class="mt-8 inline-block font-semibold
                               text-lime-400">
                        Explore →
                    </a>

                </div>


                {{-- Cricket --}}
                <div
                    class="group rounded-3xl border border-white/10
                           bg-white/5 p-7 backdrop-blur-xl
                           transition duration-500
                           hover:-translate-y-2
                           hover:bg-white/10">

                    <div class="text-5xl">
                        🏏
                    </div>

                    <h3 class="mt-8 text-2xl font-bold">
                        Cricket
                    </h3>

                    <p class="mt-3 text-gray-400">
                        Find and reserve your
                        preferred cricket facility.
                    </p>

                    <a href="#" class="mt-8 inline-block font-semibold
                               text-lime-400">
                        Explore →
                    </a>

                </div>


                {{-- Swimming --}}
                <div
                    class="group rounded-3xl border border-white/10
                           bg-white/5 p-7 backdrop-blur-xl
                           transition duration-500
                           hover:-translate-y-2
                           hover:bg-white/10">

                    <div class="text-5xl">
                        🏊
                    </div>

                    <h3 class="mt-8 text-2xl font-bold">
                        Swimming
                    </h3>

                    <p class="mt-3 text-gray-400">
                        Reserve a swimming session
                        at your preferred time.
                    </p>

                    <a href="#" class="mt-8 inline-block font-semibold
                               text-lime-400">
                        Explore →
                    </a>

                </div>


            </div>

        </div>

    </section>


    {{-- HOW IT WORKS --}}
    <section id="how-it-works" class="border-t border-white/10 py-24">

        <div class="mx-auto max-w-7xl px-6">

            <div class="text-center">

                <p class="text-sm font-semibold uppercase
                           tracking-[0.3em] text-lime-400">
                    Simple Process
                </p>

                <h2 class="mt-3 text-4xl font-bold sm:text-5xl">
                    Book in 3 simple steps
                </h2>

            </div>


            <div class="mt-16 grid gap-6 md:grid-cols-3">

                <div class="rounded-3xl border border-white/10 p-8">

                    <span class="text-5xl font-black text-white/20">
                        01
                    </span>

                    <h3 class="mt-8 text-2xl font-bold">
                        Choose a Sport
                    </h3>

                    <p class="mt-3 text-gray-400">
                        Select football, cricket,
                        swimming or any available facility.
                    </p>

                </div>


                <div class="rounded-3xl border border-white/10 p-8">

                    <span class="text-5xl font-black text-white/20">
                        02
                    </span>

                    <h3 class="mt-8 text-2xl font-bold">
                        Select Your Slot
                    </h3>

                    <p class="mt-3 text-gray-400">
                        Pick your preferred date
                        and available time slot.
                    </p>

                </div>


                <div class="rounded-3xl border border-white/10 p-8">

                    <span class="text-5xl font-black text-white/20">
                        03
                    </span>

                    <h3 class="mt-8 text-2xl font-bold">
                        Confirm Booking
                    </h3>

                    <p class="mt-3 text-gray-400">
                        Confirm your booking
                        and receive your reservation details.
                    </p>

                </div>

            </div>

        </div>

    </section>

@endsection
