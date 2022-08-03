<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 mb-12">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home.index') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @auth
                    @if (Auth::user()->is_admin)
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Lista de Usuários') }}
                    </x-nav-link>
                    <x-nav-link :href="route('product.index')" :active="request()->routeIs('product.index')">
                        {{ __('Lista de Produtos') }}
                    </x-nav-link>
                    @endif
                    @endauth
                    <x-nav-link-0 :href="route('store.index', $section='todos')" :active="request()->routeIs('store.index') && request()->route()->parameters['section'] == 'todos'">
                        {{ __('Todos') }}
                    </x-nav-link-0>
                    <x-nav-link-1 :href="route('store.index', $section='papelaria')" :active="request()->routeIs('store.index') && request()->route()->parameters['section'] == 'papelaria'">
                        {{ __('Papelaria') }}
                    </x-nav-link-1>
                    <x-nav-link-2 :href="route('store.index', $section='escritorio')" :active="request()->routeIs('store.index') && request()->route()->parameters['section'] == 'escritorio'">
                        {{ __('Escritório') }}
                    </x-nav-link-2>
                    <x-nav-link-3 :href="route('store.index', $section='arte')" :active="request()->routeIs('store.index') && request()->route()->parameters['section'] == 'arte'">
                        {{ __('Arte') }}
                    </x-nav-link-3>
                    <x-nav-link-4 :href="route('store.index', $section='outros')" :active="request()->routeIs('store.index') && request()->route()->parameters['section'] == 'outros'">
                        {{ __('Outros') }}
                    </x-nav-link-4>
                </div>
            </div>

            <x-search-bar />

            <!-- Settings Dropdown -->
            @auth
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <a class="text-slate-500 mr-4" href="/cart">
                    <img width="14px" src="https://cdn-icons-png.flaticon.com/128/8081/8081347.png" alt="">
                </a>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex mt-1 items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account -->
                        <x-dropdown-link :href="route('user.show', Auth::user()->id )">
                            {{ __('Minha conta') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('cart.orders', Auth::user()->id )">
                            {{ __('Meus pedidos') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Sair') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @else

                @if (Route::has('login'))
                <div class="hidden top-0 right-0 py-4 sm:block">
                    @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                    <div class="flex mt-2">
                        <a class="text-slate-500 mr-4" href="/cart">
                            <img width="14px" src="https://cdn-icons-png.flaticon.com/128/8081/8081347.png" alt="">
                        </a>
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    </div>
                    @endauth
                </div>
                @endif
            </div>
            @endauth

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                @auth
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                @endauth
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
