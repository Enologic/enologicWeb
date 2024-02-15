@extends('layouts.template')

@section('general')
    {{-- HEADER --}}
    <nav class="navbar navbar-expand navbar-light bg-warning shadow-sm">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link fw-medium" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        {{-- @if (Auth::user()->email_verified_at) --}}
                        <div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                </li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            {{-- @endif --}}
                        </div>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- Vista principal --}}
    {{-- Aquí irán todos los yields de las vistas que tengamos. --}}
    <main>
        @yield('add')
        @yield('cart')
        @yield('checkout')
        @yield('profile')
        @yield('show')
        @yield('viewOrders')
        @yield('wishlist')
    </main>


    {{-- FOOTER --}}
    <footer>
        <div class="text-center py-3 border-1 bg-warning">
            <span class="fw-medium">
                Proyecto E-commerce - Enologic, 2º DAW
            </span>
        </div>
    </footer>
@endsection
