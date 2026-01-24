<header class="bg-black shadow-sm sticky top-0 z-50 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between h-16">

            {{-- LOGO --}}
            <a href="{{ url('/') }}" class="flex items-center gap-3">
               <img src="/images/mu-logo.png" class="h-10">

                <span class="text-lg font-extrabold tracking-wide text-white hidden sm:block">
                    MAN UNITED STORE
                </span>
            </a>

            {{-- NAVIGATION (DESKTOP) --}}
            <nav class="hidden md:flex items-center gap-8">
                <a href="{{ url('/') }}"
                   class="font-medium text-white transition hover:text-red-500">
                    Home
                </a>
                <a href="#"
                   class="font-medium text-white transition hover:text-red-500">
                    Jersey
                </a>
                <a href="#"
                   class="font-medium text-white transition hover:text-red-500">
                    Apparel
                </a>
                <a href="#"
                   class="font-medium text-white transition hover:text-red-500">
                    Accessories
                </a>
            </nav>

            {{-- RIGHT SECTION --}}
           <div class="flex items-center gap-5">
            <button id="themeToggle" class="text-white hover:text-red-500">🌙</button>
            {{-- cart --}}
            </div>

            {{-- CART ICON --}}
            <a href="{{ route('cart.index') }}"
            class="relative text-gray-300 hover:text-red-500 transition">

                <!-- Icon Cart -->
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.293 2.293A1 1 0 007.618 17H17m0 0a2 2 0 100 4 2 2 0 000-4zm-10 2a2 2 0 100 4 2 2 0 000-4z" />
                </svg>

                {{-- Badge Quantity --}}
                @php
                    $cartCount = session('cart')
                        ? collect(session('cart'))->sum('qty')
                        : 0;
                @endphp

                @if ($cartCount > 0)
                    <span
                        class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold
                            w-5 h-5 rounded-full flex items-center justify-center">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

                {{-- MOBILE MENU BUTTON --}}
                <button class="md:hidden focus:outline-none text-white"
                        onclick="document.getElementById('mobileMenu').classList.toggle('hidden')">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

            </div>
        </div>

        {{-- MOBILE MENU --}}
        <div id="mobileMenu" class="hidden md:hidden pb-4 border-t border-gray-800">
            <a href="{{ url('/') }}"
               class="block py-2 text-white hover:text-red-500">
                Home
            </a>
            <a href="#"
               class="block py-2 text-white hover:text-red-500">
                Jersey
            </a>
            <a href="#"
               class="block py-2 text-white hover:text-red-500">
                Apparel
            </a>
            <a href="#"
               class="block py-2 text-white hover:text-red-500">
                Accessories
            </a>
        </div>
    </div>
    <script>
    const toggle = document.getElementById('themeToggle');
    const html = document.documentElement;

    // Load saved theme
    if (localStorage.getItem('theme') === 'dark') {
        html.classList.add('dark');
        toggle.textContent = '☀️';
    }

    toggle.addEventListener('click', () => {
        html.classList.toggle('dark');

        if (html.classList.contains('dark')) {
            localStorage.setItem('theme', 'dark');
            toggle.textContent = '☀️';
        } else {
            localStorage.setItem('theme', 'light');
            toggle.textContent = '🌙';
        }
    });
</script>

</header>
