@extends('base')
@section('title', 'Change Password')
@section('content')
    <div class="container justify-content-center align-items-center">
        <div class="row d-flex justify-content-center bg-primary-subtle p-5 rounded-3">
            <div class="col-md-4">
                <div class="h-100 flex-column d-flex py-2">
                    <div class="d-flex justify-content-center">
                        <h1>Change Password</h1>
                    </div>
                    <form action="{{ route('user.password') }}" method="post" class="d-flex flex-column h-100">
                        @csrf
                        <div class="w-100 mt-auto mb-auto d-flex flex-column">
                            <div class="mb-3">
                                <label for="old_password" class="form-label">Old Password</label>
                                <input type="password" name="old_password" class="form-control" id="old_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" name="password" required class="form-control" id="password">
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" required class="form-control" id="password_confirmation">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary w-100 me-1">Change Password</button>
                            <button onclick="window.location='{{ route('home') }}'" class="btn btn-warning">Back</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
