<header
    class="site-header group/header relative z-50 text-white transition-[background,shadow]"
    x-data="{ navOffsetTop: $refs.navbar.offsetTop - parseInt(getComputedStyle($refs.navbar).marginTop, 10), isSticky: false }"
    x-init="window.scrollY > navOffsetTop && (isSticky = true)"
    @resize.window.debounce.500ms="navOffsetTop = $refs.navbar.offsetTop - parseInt(getComputedStyle($refs.navbar).marginTop, 10)"
    @scroll.window="window.scrollY > navOffsetTop ? (isSticky = true) : (isSticky = false)"
    :class="{ 'lqd-is-sticky': isSticky }"
>
    <!-- Pre-header Announcement -->
    @if($fSectSettings->preheader_active)
        <div
            class="site-preheader flex items-center justify-center px-3 pt-4 text-center text-2xs text-white/70 opacity-0 transition-all duration-500 group-[.page-loaded]/body:opacity-100"
        >
            <p>
                <span class="me-3 bg-gradient-to-r from-gradient-from to-gradient-to to-50% bg-clip-text text-4xs font-semibold uppercase tracking-wide text-transparent">
                    Limited Offer
                </span>
                <span class="opacity-70">
                    Sign up and receive 20% bonus discount on checkout.
                </span>
            </p>
        </div>
    @endif

    <!-- Navbar -->
    <div
        class="hidden"
        x-ref="navbar-placeholder"
        style="height: var(--header-height)"
        :class="{ 'hidden': !isSticky }"
    ></div>

    <nav
        class="site-header-nav relative flex items-center justify-between px-7 py-6 text-xs/tight opacity-0 transition-all duration-300 group-[.lqd-is-sticky]/header:fixed group-[.lqd-is-sticky]/header:top-0 group-[.lqd-is-sticky]/header:w-full group-[&.lqd-is-sticky]/header:bg-black group-[.page-loaded]/body:opacity-100 group-[&.lqd-is-sticky]/header:shadow-[0_4px_20px_rgba(0,0,0,0.03)] max-sm:px-2"
        id="frontend-local-navbar"
        x-ref="navbar"
        x-init="document.body.style.setProperty('--header-height', $refs.navbar.offsetHeight + 'px')"
    >
        <!-- Logo -->
        <a
            class="site-logo relative basis-1/3 max-lg:basis-1/3"
            href="{{ route('index') }}"
        >
            @if (isset($setting->logo_sticky))
                <img
                    class="peer absolute start-0 top-1/2 -translate-y-1/2 translate-x-3 opacity-0 transition-all group-[.lqd-is-sticky]/header:translate-x-0 group-[.lqd-is-sticky]/header:opacity-100"
                    src="{{ custom_theme_url($setting->logo_sticky_path, true) }}"
                    @if (isset($setting->logo_sticky_2x_path)) srcset="/{{ $setting->logo_sticky_2x_path }} 2x" @endif
                    alt="{{ $setting->site_name }} logo"
                >
            @endif
            <img
                class="transition-all group-[.lqd-is-sticky]/header:peer-first:translate-x-2 group-[.lqd-is-sticky]/header:peer-first:opacity-0"
                src="{{ custom_theme_url($setting->logo_path, true) }}"
                @if (isset($setting->logo_2x_path)) srcset="/{{ $setting->logo_2x_path }} 2x" @endif
                alt="{{ $setting->site_name }} logo"
            >
        </a>

        <!-- Navigation Links -->
        <div
            class="site-nav-container basis-1/3 transition-all max-lg:absolute max-lg:right-0 max-lg:top-full max-lg:max-h-0 max-lg:w-full max-lg:overflow-hidden max-lg:bg-black max-lg:text-white [&.lqd-is-active]:max-lg:max-h-[calc(100vh-150px)]">
            <div class="max-lg:max-h-[inherit] max-lg:overflow-y-scroll">
                <ul
                    class="textxs flex items-center justify-center gap-14 whitespace-nowrap text-center font-medium uppercase max-xl:gap-10 max-lg:flex-col max-lg:items-start max-lg:gap-5 max-lg:p-10">
                @php
                    $setting->menu_options = $setting->menu_options
                    ? $setting->menu_options
                     : '[{"title": "Home","url": "#banner","target": false},{"title": "Features","url": "#features","target": false},{"title": "How it Works","url": "#how-it-works","target": false},{"title": "Testimonials","url": "#testimonials","target": false},{"title": "Pricing","url": "#pricing","target": false},{"title": "FAQ","url": "#faq","target": false}]';
                            $menu_options = json_decode($setting->menu_options, true);
                        @endphp
                        @foreach ($menu_options as $menu_item)
                    <li>
                        <a
						class="relative transition-colors hover:text-primary [&.active]:text-primary"
                            href="{{ Route::currentRouteName() != 'index' ? url('/') . $menu_item['url'] : $menu_item['url'] }}"
                            target="{{ $menu_item['target'] === false ? '_self' : '_blank' }}"
                            >
                            {{ __($menu_item['title']) }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex basis-1/3 justify-end gap-2 max-lg:basis-2/3">
            @if (!auth()->check())
            <a
		        class="relative inline-flex items-center rounded-lg border-2 border-white/10 px-4 py-2 font-medium text-white transition-all duration-300 hover:scale-105 hover:border-primary hover:bg-primary hover:text-primary-foreground hover:shadow-lg hover:shadow-primary/5"
                href="{{ LaravelLocalization::localizeUrl(route('login')) }}">
                {!! __($fSetting->sign_in) !!}
            </a>
            @endif
            @if (!auth()->check())
            <a
		        class="relative inline-flex items-center rounded-lg border-2 border-white/10 bg-white/[2%] px-4 py-2 font-medium text-white transition-all duration-300 hover:scale-105 hover:border-primary hover:bg-primary hover:text-primary-foreground hover:shadow-lg hover:shadow-primary/5"
                href="{{ LaravelLocalization::localizeUrl(route('register')) }}">
                    {!! __($fSetting->join_hub) !!}
                
                <span class="lqd-outline-glow absolute inline-block rounded-[inherit] pointer-events-none overflow-hidden lqd-outline-glow-effect-1 [--outline-glow-w:2px]">
                <span class="lqd-outline-glow-inner absolute start-1/2 top-1/2 inline-block aspect-square min-h-[150%] min-w-[150%] rounded-[inherit]"></span>
            </span>
			</a>
            @endif
			

            <button class="mobile-nav-trigger size-10 group flex shrink-0 items-center justify-center rounded-full bg-white/10 lg:hidden">
                <span class="flex w-4 flex-col gap-1">
                    <span
                        class="inline-flex h-[2px] w-full bg-white transition-transform first:origin-left last:origin-right group-[&.lqd-is-active]:first:-translate-y-[2px] group-[&.lqd-is-active]:first:translate-x-[3px] group-[&.lqd-is-active]:first:rotate-45 group-[&.lqd-is-active]:last:-translate-x-[2px] group-[&.lqd-is-active]:last:-translate-y-[8px] group-[&.lqd-is-active]:last:-rotate-45">
					</span>
                    <span
                        class="inline-flex h-[2px] w-full bg-white transition-transform first:origin-left last:origin-right group-[&.lqd-is-active]:first:-translate-y-[2px] group-[&.lqd-is-active]:first:translate-x-[3px] group-[&.lqd-is-active]:first:rotate-45 group-[&.lqd-is-active]:last:-translate-x-[2px] group-[&.lqd-is-active]:last:-translate-y-[8px] group-[&.lqd-is-active]:last:-rotate-45">
					</span>
                </span>
            </button>
        </div>
    </nav>
	@includeWhen($fSetting->floating_button_active, 'landing-page.header.floating-button')
</header>

@includeWhen($app_is_demo, 'landing-page.header.envato-link')

@includeWhen(in_array($settings_two->chatbot_status && ($settings_two->chatbot_login_require == false || ($settings_two->chatbot_login_require == true && auth()->check())), [
        'frontend',
        'both',
    ]),
    'panel.chatbot.widget',
    ['page' => 'landing-page']
)
