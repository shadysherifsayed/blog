<nav class="navbar navbar-expand" id="main-navbar">

    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ img('logo') }}" />
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" 
        data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">

        <ul class="navbar-nav ml-auto align-items-center">

            @if(auth()->guard('admin')->check() || auth()->check())
            @php
                if(auth()->guard('admin')->check()) {
                    $authUser = auth()->guard('admin')->user();
                } elseif(auth()->check()) {
                    $authUser = auth()->user();
                }
            @endphp
            <li class="nav-item">
                <a id="user-profile" class="nav-link">
                    <div style="background-image: url('{{ $authUser->avatar }}')" class="avatar"></div>
                    <span> {{ $authUser->name }} </span>
                </a>
            </li>

            <li class="nav-item">
                <a id="logout" class="nav-link">
                    <form action="{{ auth()->guard('admin')->check() ? route('logout') : route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        <button class="icon btn">
                            <i class="typcn typcn-power"></i>
                        </button>
                    </form>
                </a>
            </li>

            @else
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link">
                    <span>Login</span>
                </a>
            </li>
             <li class="nav-item">
                <a href="{{ route('register') }}" class="nav-link">
                    <span>Register</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</nav>
