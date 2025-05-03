<div @class([
    'group/pricing px-11 py-10 rounded-xl [&.featured]:bg-white [&.featured]:shadow-[0_4px_44px_hsl(0_0%_0%/7%)]',
    'featured' => $plan->is_featured == 1,
])>
    <p class="mb-3 text-purple-600">
        {!! $plan->name !!}
    </p>
    <p class="mb-8 text-4xl font-bold leading-none -tracking-tight text-heading-foreground">
        {{ currency()->symbol }}{{ formatPrice($plan->price, 2) }}
        <span class="text-sm font-normal tracking-normal text-foreground/50">
            /
            {{ $period ?? $plan->frequency == 'monthly' ? 'month' : 'year' }}
        </span>
    </p>

    <hr class="my-0">

    <ul class="pt-8">
        @if ($plan->trial_days > 0)
            <li class="mb-4 flex items-center">
                <span class="mr-3 inline-grid h-[22px] w-[22px] shrink-0 place-content-center rounded-xl bg-[#684AE2] bg-opacity-10 text-[#684AE2]">
                    <svg
                        width="13"
                        height="10"
                        viewBox="0 0 13 10"
                        fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path d="M3.952 7.537L11.489 0L12.452 1L3.952 9.5L1.78814e-07 5.545L1 4.545L3.952 7.537Z" />
                    </svg>
                </span>
                {{ number_format($plan->trial_days) . ' ' . __('Days of free trial.') }}
            </li>
        @endif
        @if (!empty($plan->features))
            @foreach (explode(',', $plan->features) as $feature)
                <li class="mb-4 flex items-center">
                    <span class="mr-3 inline-grid h-[22px] w-[22px] shrink-0 place-content-center rounded-xl bg-[#684AE2] bg-opacity-10 text-[#684AE2]">
                        <svg
                            width="13"
                            height="10"
                            viewBox="0 0 13 10"
                            fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path d="M3.952 7.537L11.489 0L12.452 1L3.952 9.5L1.78814e-07 5.545L1 4.545L3.952 7.537Z" />
                        </svg>
                    </span>
                    {{ trim(__($feature)) }}
                </li>
            @endforeach
        @endif
        <li class="mb-[0.625em]">
            <span class="mr-3 inline-grid h-[22px] w-[22px] shrink-0 place-content-center rounded-xl bg-[#684AE2] bg-opacity-10 text-[#684AE2]">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="14"
                    height="14"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path
                        stroke="none"
                        d="M0 0h24v24H0z"
                        fill="none"
                    />
                    <path d="M5 12l5 5l10 -10" />
                </svg>
            </span>
            @if ((int) $plan->total_words >= 0)
                <strong>@formatNumber($plan->total_words)</strong> {{ __('Word Tokens') }}
            @else
                <strong>{{ __('Unlimited') }}</strong> {{ __('Word Tokens') }}
            @endif
        </li>
        <li class="mb-[0.625em]">
            <span class="mr-3 inline-grid h-[22px] w-[22px] shrink-0 place-content-center rounded-xl bg-[#684AE2] bg-opacity-10 text-[#684AE2]">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="14"
                    height="14"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path
                        stroke="none"
                        d="M0 0h24v24H0z"
                        fill="none"
                    />
                    <path d="M5 12l5 5l10 -10" />
                </svg>
            </span>
            @if ((int) $plan->total_images >= 0)
                <strong>@formatNumber($plan->total_images)</strong> {{ __('Image Tokens') }}
            @else
                <strong>{{ __('Unlimited') }}</strong> {{ __('Image Tokens') }}
            @endif
        </li>
        @if (!empty($plan->inactiveFeatures))
            @foreach (explode(',', $plan->inactiveFeatures) as $feature)
                <li class="mb-4 flex items-center opacity-25">
                    <span class="mr-3 inline-grid h-[22px] w-[22px] shrink-0 place-content-center rounded-xl bg-[#684AE2] bg-opacity-10 text-[#684AE2]">
                        <svg
                            width="5"
                            height="2"
                            viewBox="0 0 5 2"
                            fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path d="M0 0.00299835H4.167V1.539H0V0.00299835Z" />
                        </svg>
                    </span>
                    {{ trim(__($feature)) }}
                </li>
            @endforeach
        @endif
    </ul>
    <div class="pt-10">
        <a
            class="group inline-flex items-center gap-3 rounded-full py-3 pe-6 ps-4 transition-all hover:scale-105 hover:bg-primary-foreground hover:text-primary hover:shadow-xl hover:shadow-black/5 group-[&.featured]/pricing:bg-primary group-[&.featured]/pricing:text-primary-foreground"
            href="{{ route('register', ['plan' => $plan->id]) }}"
        >
            <span
                class="size-10 inline-flex items-center justify-center rounded-full bg-primary/[7%] transition-all group-hover:scale-110 group-hover:bg-primary group-hover:text-primary-foreground group-[&.featured]/pricing:bg-primary-foreground/10 group-[&.featured]/pricing:text-primary-foreground"
            >
                <x-tabler-arrow-right class="size-4" />
            </span>
            {{ __('Select') }} {{ __($plan->name) }}
        </a>
    </div>
</div>
