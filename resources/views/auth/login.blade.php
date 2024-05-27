@extends('base')
@section('title', 'Login')
@section('content')
    <div class="container justify-content-center align-items-center">
        <div class="row d-flex justify-content-center bg-primary-subtle p-5 rounded-3">
            <div class="col-md-4 border-end">
                <div class="h-100 flex-column d-flex py-2">

                    <div class="d-flex justify-content-center">
                        <h1>Login</h1>
                    </div>
                    <form action="{{ route('user.login') }}" method="post" class="d-flex flex-column h-100">
                        @csrf
                        <div class="w-100 mt-auto mb-auto d-flex flex-column">

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" class="form-control" id="email" placeholder="example@gmail.com">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" placeholder="Password" required class="form-control" id="password">
                            </div>
                            <div class="error">
                                @if (session('error'))
                                    {{ session('error') }}
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>

            <div class="col-md-4 border-start">
                <div class="h-100 flex-column d-flex py-2">
                    <div class="d-flex justify-content-center">
                        <h1>Register</h1>
                    </div>
                    <form action="{{ route('user.register') }}" method="post" class="d-flex flex-column">
                        @csrf
                        <div class="w-100 mt-auto mb-auto d-flex flex-column">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" placeholder="Name" required class="form-control" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" placeholder="example@gmail.com" required class="form-control" id="email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" placeholder="Password" required class="form-control" id="password">
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" placeholder="Password" required class="form-control" id="password_confirmation">
                            </div>
                            <div class="error">
                                @if (session('error'))
                                    {{ session('error') }}
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-auto">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

