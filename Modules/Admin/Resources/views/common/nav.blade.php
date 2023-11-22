<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary text-white fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ @route("home") }}">{{config('app.name')}}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is(route("admin-dashboard")) ? 'active' : '' }}" aria-current="page" href="{{@route("admin-dashboard")}}">Home</a>
                    </li>                    
                    
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is(url("/admin/roles")) ? 'active' : '' }}" href="{{@url("/admin/roles")}}">Roles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{@url("admin/permissions")}}">Permissions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("users.index")}}">Users</a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link" href="{{route("page-categories.index")}}">Page Categories</a>
                    </li>-->
                    <li class="nav-item">
                        <a class="nav-link" href="{{@route("logout")}}">Logout</a>
                    </li>
                    

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
            </div>
        </div>
    </nav>
</header>