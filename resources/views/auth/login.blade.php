<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>

    <body>
        <h1>Login</h1>
        <form action="{{ route('user.login') }}" method="post">
            @csrf
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <h1>Register</h1>
        <form action="{{ route('user.register') }}" method="post">
            @csrf
            <input type="text" name="name" placeholder="Name" required>
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            <button type="submit">Register</button>
        </form>
    </body>
</html>

