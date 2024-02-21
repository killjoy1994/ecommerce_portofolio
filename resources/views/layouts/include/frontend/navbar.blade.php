<nav class="navbar fixed-top  navbar-expand-lg navbar-light bg-light px-3 py-2 shadow-sm">
    <div class="container-fluid mt-3">
        <div class="d-flex justify-content-between w-100">
            <div class="d-flex align-items-center">
                <a class="navbar-brand fs-2" href="/">
                    MyMarket.
                </a>
                <form action="/search" class="d-flex m-0 ms-5" style="width: 300px">
                    @csrf
                    <input class="form-control me-2" name="search" type="search" placeholder="Search"
                        aria-label="Search">
                    <button class="border-0 bg-transparent" type="submit"><i
                            class="fas fa-search fs-5 text-secondary"></i></button>
                </form>
            </div>
            <div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="d-flex align-items-center">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex align-items-center">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->route()->uri == '/' ? 'active-link' : '' }} fs-5"
                                    aria-current="page" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-5 {{ request()->route()->uri == 'categories' ? 'active-link' : '' }}"
                                    href="/categories">All Categories</a>
                            </li>
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link fs-5 {{ request()->route()->uri == 'login' ? 'active-link' : '' }}" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link fs-5 {{ request()->route()->uri == 'register' ? 'active-link' : '' }}" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->route()->uri == 'cart' ? 'active-link' : '' }} fs-5"
                                        href="/cart">Cart</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->route()->uri == 'orders' ? 'active-link' : '' }} fs-5"
                                        href="/orders">Orders</a>
                                </li>
                                <li>
                                    <div class="ms-3 d-flex align-items-center">
                                        {{-- <a style="color: black" class="me-4" href=""><i
                                        class="fas fa-search fs-5 text-secondary"></i></a> --}}
                                        {{-- <a class="ms-2" style="color: black" href=""><i class="fas fa-shopping-cart"></i></a> --}}
                                        <div class="btn-group dropstart">
                                            <div class="dropdown-toggle" type="button" id="dropdownMenuButton1"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-user fs-5 text-secondary"></i>
                                            </div>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="#">
                                                        @if (Auth::check())
                                                            {{ Auth::user()->name }}
                                                        @endif
                                                    </a></li>
                                                <li>
                                                    <div class="dropdown-item p-0">
                                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                                            onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                            {{ __('Logout') }}
                                                        </a>

                                                        <form id="logout-form" action="{{ route('logout') }}"
                                                            method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @endguest



                        </ul>

                    </div>

                </div>
            </div>
        </div>
    </div>
</nav>
