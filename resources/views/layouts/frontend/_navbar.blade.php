<header class="navbar navbar-expand-md navbar-light">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        {{-- <a href="#" class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pr-0 pr-md-3">
            <img src="{{ asset('static/logo.svg') }}" alt="Tabler" class="navbar-brand-image">
        </a> --}}
        <a href="/" class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pr-0 pr-md-3 mt-2">
            <h2 class="font-weight-bold text-azure">MO<span class="text-red">TEST</span></h2>
        </a>
        <div class="navbar-nav flex-row order-md-last">
            @guest
                <a href="{{ route('login') }}" class="nav-item mr-2">Login</a>
                <a href="{{ route('register') }}" class="nav-item">Register</a>
            @endguest
            @auth
                <div class="nav-item dropdown d-none d-md-flex mr-3">
                    <a href="{{ route('carts.index') }}" class="nav-link px-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="6" cy="19" r="2"></circle>
                            <circle cx="17" cy="19" r="2"></circle>
                            <path d="M17 17h-11v-14h-2"></path>
                            <path d="M6 5l14 1l-1 7h-13"></path>
                        </svg>
                        <span class="badge bg-red">{{ Auth::user()->carts()->count() }}</span>
                    </a>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-toggle="dropdown">
                        <span class="avatar" style="background-image: url({{ Auth::user()->avatar }})"></span>
                        <div class="d-none d-xl-block pl-2">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="mt-1 small text-muted">{{ Auth::user()->email }}</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @role('admin')
                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon dropdown-item-icon icon-tabler icon-tabler-layout-dashboard" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 4h6v8h-6z"></path>
                                    <path d="M4 16h6v4h-6z"></path>
                                    <path d="M14 12h6v8h-6z"></path>
                                    <path d="M14 4h6v4h-6z"></path>
                                </svg>
                                Dashboard
                            </a>
                        @else
                            <a class="dropdown-item" href="{{ route('member.dashboard') }}">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon dropdown-item-icon icon-tabler icon-tabler-layout-dashboard" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 4h6v8h-6z"></path>
                                    <path d="M4 16h6v4h-6z"></path>
                                    <path d="M14 12h6v8h-6z"></path>
                                    <path d="M14 4h6v4h-6z"></path>
                                </svg>
                                Dashboard
                            </a>
                        @endrole
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                <path d="M7 6a7.75 7.75 0 1 0 10 0"></path>
                                <line x1="12" y1="4" x2="12" y2="12"></line>
                            </svg>
                            Logout
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</header>
<div class="navbar-expand-md">
    <div class="navbar collapse navbar-collapse navbar-light" id="navbar-menu">
        <div class="container-xl">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('landing') ? 'active' : '' }}" href="/">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Home
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ Route::is('series*') ? 'active' : '' }}"
                        href="{{ route('series.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-certificate"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="15" cy="15" r="3"></circle>
                                <path d="M13 17.5v4.5l2 -1.5l2 1.5v-4.5"></path>
                                <path
                                    d="M10 19h-5a2 2 0 0 1 -2 -2v-10c0 -1.1 .9 -2 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -1 1.73">
                                </path>
                                <line x1="6" y1="9" x2="18" y2="9"></line>
                                <line x1="6" y1="12" x2="9" y2="12"></line>
                                <line x1="6" y1="15" x2="8" y2="15"></line>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            courses
                        </span>
                    </a>
                </li>
                  {{--  <li class="nav-item">
                    <a class="nav-link" href="{{ route('articles') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-news"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11">
                                </path>
                                <line x1="8" y1="8" x2="12" y2="8"></line>
                                <line x1="8" y1="12" x2="12" y2="12"></line>
                                <line x1="8" y1="16" x2="12" y2="16"></line>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Articles
                        </span>
                    </a>
                </li>--}}
            </ul>
            {{-- <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                <form action="." method="get">
                    <div class="input-icon">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <circle cx="10" cy="10" r="7" />
                                <line x1="21" y1="21" x2="15" y2="15" />
                            </svg>
                        </span>
                        <input type="text" class="form-control" placeholder="Search…">
                    </div>
                </form>
            </div> --}}
        </div>
    </div>
</div>
