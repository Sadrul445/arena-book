
@extends('layouts.app')

@section('title', 'Facilities | ArenaBook')

@section('content')

<div class="min-h-screen bg-neutral-950 px-4 pb-16 pt-28 text-white sm:px-6 lg:px-10">

    <div class="mx-auto max-w-7xl">

        {{-- Page Heading --}}
        <div class="mb-10">
            <p class="mb-2 text-sm font-semibold uppercase tracking-[0.25em] text-lime-400">
                ArenaBook / Facilities
            </p>

            <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">
                Explore Our Facilities
            </h1>

            <p class="mt-3 max-w-2xl text-sm leading-6 text-neutral-400 sm:text-base">
                Choose your preferred facility, check availability and view
                the estimated booking price.
            </p>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-500/30 bg-red-500/10 p-4 text-sm text-red-300">
                <p class="mb-2 font-semibold">Please check the following:</p>

                <ul class="list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Facility Cards --}}
        <div class="grid grid-cols-1 items-start gap-6 md:grid-cols-2 xl:grid-cols-3">

            @forelse ($facilities as $facility)

                <article
                    class="flex h-full flex-col rounded-2xl border border-white/10
                           bg-neutral-900/90 p-5 shadow-lg shadow-black/20
                           transition duration-300 hover:border-lime-400/30"
                >

                    {{-- Facility Information --}}
                    <div>
                        <div class="flex items-start justify-between gap-3">

                            <div>
                                <p class="mb-2 text-xs font-medium uppercase tracking-wider text-lime-400">
                                    {{ $facility->category->name ?? 'Facility' }}
                                </p>

                                <h2 class="text-xl font-bold">
                                    {{ $facility->name }}
                                </h2>
                            </div>

                            @if ($facility->status)
                                <span class="shrink-0 rounded-full border border-lime-400/20
                                             bg-lime-400/10 px-3 py-1 text-xs text-lime-300">
                                    Available
                                </span>
                            @else
                                <span class="shrink-0 rounded-full border border-red-400/20
                                             bg-red-400/10 px-3 py-1 text-xs text-red-300">
                                    Unavailable
                                </span>
                            @endif

                        </div>

                        @if ($facility->description)
                            <p class="mt-3 text-sm leading-6 text-neutral-400">
                                {{ $facility->description }}
                            </p>
                        @endif

                        @if ($facility->location)
                            <p class="mt-2 text-xs text-neutral-500">
                                Location: {{ $facility->location }}
                            </p>
                        @endif

                        @if ($facility->capacity_type === 'person')
                            <p class="mt-2 text-xs text-neutral-400">
                                Capacity: {{ $facility->capacity }} persons
                            </p>
                        @endif
                    </div>

                    {{-- Pricing Information from Database --}}
                    <div class="mt-5 border-t border-white/10 pt-4">

                        <h3 class="mb-3 text-sm font-semibold text-lime-400">
                            Pricing
                        </h3>

                        @forelse ($facility->pricingPeriods->where('status', true)->sortBy('priority') as $period)

                            <div class="mb-4 last:mb-0">

                                <div class="mb-2 flex flex-wrap items-center justify-between gap-2">
                                    <h4 class="text-sm font-semibold">
                                        {{ $period->name }}
                                    </h4>

                                    <span class="text-xs text-neutral-500">
                                        {{ substr($period->start_time, 0, 5) }}
                                        –
                                        {{ substr($period->end_time, 0, 5) }}
                                    </span>
                                </div>

                                @forelse ($period->pricingRules->where('status', true)->sortBy('duration_minutes') as $rule)

                                    <div class="flex items-center justify-between gap-3 py-1.5 text-sm">

                                        <span class="text-neutral-400">
                                            @if ($rule->duration_minutes < 60)
                                                {{ $rule->duration_minutes }} min
                                            @elseif ($rule->duration_minutes % 60 === 0)
                                                {{ $rule->duration_minutes / 60 }}
                                                {{ $rule->duration_minutes === 60 ? 'hour' : 'hours' }}
                                            @else
                                                {{ floor($rule->duration_minutes / 60) }} hour
                                                {{ $rule->duration_minutes % 60 }} min
                                            @endif
                                        </span>

                                        <span class="font-semibold tabular-nums">
                                            {{ $rule->currency }}
                                            {{ number_format((float) $rule->price, 2) }}
                                        </span>

                                    </div>

                                @empty
                                    <p class="text-xs text-neutral-500">
                                        No pricing rules configured.
                                    </p>
                                @endforelse

                            </div>

                        @empty
                            <p class="text-sm text-neutral-500">
                                Pricing information is not available yet.
                            </p>
                        @endforelse

                        <p class="mt-3 text-xs text-neutral-500">
                            @if ($facility->pricing_type === 'per_person')
                                Price per person, based on the selected duration.
                            @else
                                Price per booking unit, based on the selected duration.
                            @endif
                        </p>

                    </div>

                    {{-- Facility-specific Success Message --}}
                    @if (
                        session('availability_facility_id') &&
                        (int) session('availability_facility_id') === (int) $facility->id &&
                        session('availability_success')
                    )
                        <div class="mt-4 rounded-lg border border-lime-400/30
                                    bg-lime-400/10 p-3 text-sm text-lime-300">
                            {{ session('availability_success') }}
                        </div>
                    @endif

                    {{-- Facility-specific Error Message --}}
                    @if (
                        session('availability_facility_id') &&
                        (int) session('availability_facility_id') === (int) $facility->id &&
                        session('availability_error')
                    )
                        <div class="mt-4 rounded-lg border border-red-400/30
                                    bg-red-400/10 p-3 text-sm text-red-300">
                            {{ session('availability_error') }}
                        </div>
                    @endif

                    {{-- Facility-specific Price Estimate --}}
                    @if (
                        session('availability_quote') &&
                        (int) session('availability_quote.facility_id') === (int) $facility->id
                    )

                        @php
                            $quote = session('availability_quote');
                        @endphp

                        <div class="mt-4 rounded-xl border border-lime-400/30
                                    bg-lime-400/10 p-4">

                            <h3 class="mb-3 font-semibold text-lime-300">
                                Booking Price Estimate
                            </h3>

                            <div class="space-y-2 text-sm">

                                <div class="flex justify-between gap-3">
                                    <span class="text-neutral-300">Facility</span>
                                    <span class="text-right">{{ $quote['facility_name'] }}</span>
                                </div>

                                <div class="flex justify-between gap-3">
                                    <span class="text-neutral-300">Date</span>
                                    <span>{{ $quote['booking_date'] }}</span>
                                </div>

                                <div class="flex justify-between gap-3">
                                    <span class="text-neutral-300">Start Time</span>
                                    <span>{{ $quote['start_time'] }}</span>
                                </div>

                                <div class="flex justify-between gap-3">
                                    <span class="text-neutral-300">End Time</span>
                                    <span>{{ $quote['end_time'] }}</span>
                                </div>

                                <div class="flex justify-between gap-3">
                                    <span class="text-neutral-300">Pricing Period</span>
                                    <span>{{ $quote['pricing_period'] }}</span>
                                </div>

                                <div class="flex justify-between gap-3">
                                    <span class="text-neutral-300">Duration</span>
                                    <span>{{ $quote['duration_minutes'] }} min</span>
                                </div>

                                <div class="flex justify-between gap-3">
                                    <span class="text-neutral-300">
                                        {{ $quote['pricing_type'] === 'per_person' ? 'Persons' : 'Units' }}
                                    </span>
                                    <span>{{ $quote['quantity'] }}</span>
                                </div>

                                <div class="flex justify-between gap-3">
                                    <span class="text-neutral-300">Unit Price</span>
                                    <span>
                                        {{ $quote['currency'] }}
                                        {{ number_format((float) $quote['unit_price'], 2) }}
                                    </span>
                                </div>

                                <div class="mt-3 flex items-center justify-between gap-3
                                            border-t border-white/10 pt-3">

                                    <span class="font-semibold">Estimated Total</span>

                                    <span class="text-lg font-bold text-lime-300">
                                        {{ $quote['currency'] }}
                                        {{ number_format((float) $quote['total_price'], 2) }}
                                    </span>

                                </div>

                            </div>

                            <p class="mt-3 text-xs leading-5 text-neutral-400">
                                This is a price estimate only. Your booking has not
                                been confirmed or reserved yet.
                            </p>

                        </div>

                    @endif

                    {{-- Availability Form --}}
                    <div class="mt-5 flex-1 border-t border-white/10 pt-5">

                        <h3 class="mb-4 font-semibold">
                            Check Availability
                        </h3>

                        <form
                            action="{{ route('facilities.availability.check', $facility) }}"
                            method="POST"
                            class="space-y-4"
                        >
                            @csrf

                            <div>
                                <label
                                    for="booking_date_{{ $facility->id }}"
                                    class="mb-1.5 block text-sm text-neutral-300"
                                >
                                    Booking Date
                                </label>

                                <input
                                    id="booking_date_{{ $facility->id }}"
                                    type="date"
                                    name="booking_date"
                                    min="{{ now()->toDateString() }}"
                                    value="{{ old('booking_date') }}"
                                    required
                                    @disabled(!$facility->status)
                                    class="w-full rounded-lg border border-white/10
                                           bg-neutral-950 px-3 py-2.5 text-sm text-white
                                           outline-none focus:border-lime-400
                                           disabled:cursor-not-allowed disabled:opacity-50"
                                >
                            </div>

                            <div>
                                <label
                                    for="start_time_{{ $facility->id }}"
                                    class="mb-1.5 block text-sm text-neutral-300"
                                >
                                    Start Time
                                </label>

                                <input
                                    id="start_time_{{ $facility->id }}"
                                    type="time"
                                    name="start_time"
                                    value="{{ old('start_time', '18:00') }}"
                                    required
                                    @disabled(!$facility->status)
                                    class="w-full rounded-lg border border-white/10
                                           bg-neutral-950 px-3 py-2.5 text-sm text-white
                                           outline-none focus:border-lime-400
                                           disabled:cursor-not-allowed disabled:opacity-50"
                                >
                            </div>

                            <div>
                                <label
                                    for="duration_{{ $facility->id }}"
                                    class="mb-1.5 block text-sm text-neutral-300"
                                >
                                    Duration
                                </label>

                                <select
                                    id="duration_{{ $facility->id }}"
                                    name="duration_minutes"
                                    required
                                    @disabled(!$facility->status)
                                    class="w-full rounded-lg border border-white/10
                                           bg-neutral-950 px-3 py-2.5 text-sm text-white
                                           outline-none focus:border-lime-400
                                           disabled:cursor-not-allowed disabled:opacity-50"
                                >
                                    <option value="15" @selected(old('duration_minutes', '60') == '15')>
                                        15 minutes
                                    </option>

                                    <option value="30" @selected(old('duration_minutes', '60') == '30')>
                                        30 minutes
                                    </option>

                                    <option value="60" @selected(old('duration_minutes', '60') == '60')>
                                        1 hour
                                    </option>

                                    <option value="90" @selected(old('duration_minutes', '60') == '90')>
                                        1 hour 30 min
                                    </option>

                                    <option value="120" @selected(old('duration_minutes', '60') == '120')>
                                        2 hours
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label
                                    for="quantity_{{ $facility->id }}"
                                    class="mb-1.5 block text-sm text-neutral-300"
                                >
                                    {{ $facility->pricing_type === 'per_person' ? 'Quantity / Persons' : 'Quantity / Units' }}
                                </label>

                                <input
                                    id="quantity_{{ $facility->id }}"
                                    type="number"
                                    name="quantity"
                                    min="1"
                                    max="{{ $facility->capacity_type === 'person' ? min(50, $facility->capacity) : 1 }}"
                                    value="{{ old('quantity', 1) }}"
                                    required
                                    @disabled(!$facility->status)
                                    class="w-full rounded-lg border border-white/10
                                           bg-neutral-950 px-3 py-2.5 text-sm text-white
                                           outline-none focus:border-lime-400
                                           disabled:cursor-not-allowed disabled:opacity-50"
                                >
                            </div>

                            <button
                                type="submit"
                                @disabled(!$facility->status)
                                class="w-full rounded-full bg-lime-400 px-5 py-3
                                       text-sm font-bold text-black transition
                                       hover:bg-lime-300
                                       disabled:cursor-not-allowed disabled:opacity-50"
                            >
                                Check Availability
                            </button>

                        </form>

                    </div>

                </article>

            @empty

                <div class="col-span-full rounded-xl border border-white/10
                            bg-neutral-900 p-8 text-center">

                    <h2 class="text-xl font-semibold">
                        No Facilities Found
                    </h2>

                    <p class="mt-2 text-sm text-neutral-400">
                        Please check back later.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection
