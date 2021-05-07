<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="{{ asset('images/bhinneka-logo.png') }}" width="89" height="25" alt="CoreUI Logo">
        <img class="navbar-brand-minimized" src="{{ asset('images/sygnet.svg') }}" width="25" height="25" alt="CoreUI Logo">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown row pr-md-5">
            <a class="nav-link nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img class="img-avatar" src="{{ asset('images/avatars/blank-profile.png') }}" alt="admin@bootstrapmaster.com">
            </a>
            <span>
                <p class="mb-0">{{ auth()->user()->NmUser }}</p>
                <p class="mb-0" style="font-size: 14px">{{ auth()->user()->role->Nama }}</p>
            </span>
            <div class="dropdown-menu dropdown-menu-left">
                @if(!auth()->user()->FlgLDAP)
                <a class="dropdown-item" href="{{ route('change.password.index') }}">
                    <em class="fa fa-shield"></em> Ubah Password</a>
                @endif
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <em class="fa fa-lock"></em> {{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</header>
