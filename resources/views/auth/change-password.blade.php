<!DOCTYPE html>
<html>
    <head>
        <title>Change Password</title>
    </head>

    <body>
        <h1>Change Password</h1>

        <form method="POST" action="{{ route('user.password') }}">
            @csrf
            <label for="Old Password">Old Password</label>
            <input type="password" id="old_password" name="old_password" required>
            <label for="New Password">New Password</label>
            <input type="password" id="password" name="password" required>
            <label for="Confirm Password">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
            <button type="submit">Change Password</button>
        </form>
        <button onclick="window.location='{{ route('home') }}'">Back</button>
    </body>
</html>
