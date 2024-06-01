<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>@yield('title')</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-primary-subtle position-fixed w-100">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav justify-content-end w-100">
                        @if (@Auth::user())
                            <!-- collapsable user multiple options -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a></li>
                                    <li><a class="dropdown-item" href="{{ route('user.password') }}">Change Password</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <!-- spawn delete form overlay -->
                                    <li><a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-form">Delete account</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="d-flex justify-content-center align-items-center h-100" style="padding-top: 70px;">
            @yield('content')
        </div>
    </body>
    @if (@Auth::user())
        <!-- Delete form overlay -->
        <div class="modal fade" id="delete-form" tabindex="-1" aria-labelledby="delete-form-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="delete-form-label">Delete Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete your account?</p>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-between w-100">
                            <p class="text-danger"> This action is irreversible </p>
                            <form action="{{ route('user.delete', ['id' => Auth::user()->id]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete Account</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#delete-form">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        @yield('script')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
