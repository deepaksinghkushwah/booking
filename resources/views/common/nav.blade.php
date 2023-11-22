<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ @route("home") }}">{{config('app.name')}}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{@route("home")}}">Home</a>
                    </li>                    
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{@route("user-dashboard")}}">Dasbhboard</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{@route("login")}}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{@route("register-user")}}">Signup</a>
                    </li>
                    @endauth

                    @can("appointment-list-user")
                    <li class="nav-item">
                        <a class="nav-link" href="{{@route("appointment.index")}}">Book Appointment</a>
                    </li>
                    @endcan
                    @hasrole('Booking')
                    <li class="nav-item">
                        <a class="nav-link" href="{{@route("booking-show-settings")}}">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{@route("booking-show-slots-form")}}">Setup Booking Slots</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{@route("booking-list")}}">Booking</a>
                    </li>


                    @endhasrole

                    <!--                <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Dropdown
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </li>-->

                </ul>
                @auth
                <div class="dropdown d-flex text-white">
                    <a class="dropdown-toggle btn" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu2">
                        @hasanyrole('Admin|Sub-Admin')
                        <li><a class="dropdown-item" href="{{ @route("admin-dashboard") }}">Admin Dashboard</a></li>                    
                        @endhasanyrole
                        <li><a class="dropdown-item" href="{{ @route("logout") }}">Logout</a></li>                    
                    </ul>
                </div>            
                @endauth
            </div>
        </div>
    </nav>
</header>