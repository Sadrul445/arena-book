@extends('layouts.app')

@section('title', 'Facilities | ArenaBook')

@section('content')
    <section class="min-h-screen bg-neutral-950 px-5 py-28 text-white">
        <div class="mx-auto max-w-7xl">

            <div class="mb-12">
                <p class="mb-3 text-sm font-semibold uppercase tracking-[0.3em] text-lime-400">
                    Explore ArenaBook
                </p>

                <h1 class="text-4xl font-bold md:text-6xl">
                    Our Facilities
                </h1>

                <p class="mt-4 max-w-2xl text-neutral-400">
                    Discover our sports and recreational facilities
                    and find the perfect experience for you.
                </p>
            </div>

            @forelse ($categories as $category)
                <div class="mb-14">

                    <h2 class="mb-6 text-2xl font-bold">
                        {{ $category->name }}
                    </h2>

                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

                        @foreach ($category->facilities as $facility)
                            <article
                                class="rounded-2xl border border-white/10
                                        bg-white/5 p-6 transition
                                        hover:border-lime-400/50">

                                <h3 class="text-xl font-semibold">
                                    {{ $facility->name }}
                                </h3>

                                <p class="mt-2 text-sm text-neutral-400">
                                    {{ $facility->description ?? 'Explore this facility and book your preferred time.' }}
                                </p>

                                <div class="mt-5 border-t border-white/10 pt-4">

                                    <p class="mb-3 text-sm font-medium text-lime-400">
                                        Pricing
                                    </p>

                                    @forelse ($facility->pricingPeriods as $period)
                                        <div class="mb-4">

                                            <h4 class="mb-2 text-sm font-semibold text-white">
                                                {{ $period->name }}
                                            </h4>

                                            @forelse ($period->pricingRules as $rule)
                                                <div class="flex items-center justify-between py-1">

                                                    <span class="text-sm text-neutral-400">
                                                        @if ($rule->duration_minutes >= 60)
                                                            {{ intdiv($rule->duration_minutes, 60) }}
                                                            hour{{ $rule->duration_minutes >= 120 ? 's' : '' }}

                                                            @if ($rule->duration_minutes % 60 > 0)
                                                                {{ $rule->duration_minutes % 60 }} min
                                                            @endif
                                                        @else
                                                            {{ $rule->duration_minutes }} minutes
                                                        @endif
                                                    </span>

                                                    <span class="font-semibold text-white">
                                                        ৳{{ number_format((float) $rule->price, 0) }}
                                                    </span>

                                                </div>
                                            @empty
                                                <p class="text-sm text-neutral-500">
                                                    Pricing not configured yet.
                                                </p>
                                            @endforelse

                                        </div>
                                    @empty
                                        <p class="text-sm text-neutral-500">
                                            Pricing information unavailable.
                                        </p>
                                    @endforelse

                                    <p class="mb-4 text-xs text-neutral-500">
                                        {{ $facility->pricing_type === 'per_person' ? 'Price per person' : 'Price per booking' }}
                                    </p>

                                    @if (session('availability_success'))
                                        <div
                                            class="mb-4 rounded-lg border border-lime-400/30
                bg-lime-400/10 p-3 text-sm text-lime-300">
                                            {{ session('availability_success') }}
                                        </div>
                                    @endif

                                    @if (session('availability_error'))
                                        <div
                                            class="mb-4 rounded-lg border border-red-400/30
                bg-red-400/10 p-3 text-sm text-red-300">
                                            {{ session('availability_error') }}
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div
                                            class="mb-4 rounded-lg border border-red-400/30
                bg-red-400/10 p-3 text-sm text-red-300">
                                            <ul class="list-inside list-disc">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form action="{{ route('facilities.availability.check', $facility) }}" method="POST"
                                        class="mt-5 border-t border-white/10 pt-5">
                                        @csrf

                                        <h4 class="mb-4 font-semibold text-white">
                                            Check Availability
                                        </h4>

                                        <div class="space-y-4">

                                            <div>
                                                <label class="mb-1 block text-sm text-neutral-300">
                                                    Booking Date
                                                </label>

                                                <input type="date" name="booking_date" min="{{ now()->toDateString() }}"
                                                    value="{{ old('booking_date') }}" required
                                                    class="w-full rounded-lg border border-white/10
                       bg-neutral-900 px-3 py-2 text-white" />
                                            </div>

                                            <div>
                                                <label class="mb-1 block text-sm text-neutral-300">
                                                    Start Time
                                                </label>

                                                <input type="time" name="start_time"
                                                    value="{{ old('start_time', '18:00') }}" required
                                                    class="w-full rounded-lg border border-white/10
                       bg-neutral-900 px-3 py-2 text-white" />
                                            </div>

                                            <div>
                                                <label class="mb-1 block text-sm text-neutral-300">
                                                    Duration
                                                </label>

                                                <select name="duration_minutes" required
                                                    class="w-full rounded-lg border border-white/10
                       bg-neutral-900 px-3 py-2 text-white">
                                                    <option value="15">15 minutes</option>
                                                    <option value="30">30 minutes</option>
                                                    <option value="60" selected>1 hour</option>
                                                    <option value="90">1.5 hours</option>
                                                    <option value="120">2 hours</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label class="mb-1 block text-sm text-neutral-300">
                                                    Quantity / Persons
                                                </label>

                                                <input type="number" name="quantity" min="1"
                                                    max="{{ $facility->capacity_type === 'person' ? min(50, $facility->capacity) : 1 }}"
                                                    value="1" required
                                                    class="w-full rounded-lg border border-white/10
                       bg-neutral-900 px-3 py-2 text-white" />
                                            </div>

                                            <button type="submit"
                                                class="w-full rounded-full bg-lime-400 px-5 py-3
                   font-semibold text-black transition
                   hover:bg-lime-300">
                                                Check Availability
                                            </button>

                                        </div>
                                    </form>
                                </div>

                            </article>
                        @endforeach

                    </div>
                </div>
            @empty
                <p class="text-neutral-400">
                    No facilities are currently available.
                </p>
            @endforelse

        </div>
    </section>
@endsection
