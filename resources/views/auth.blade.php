<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- <link rel="stylesheet" href="./styleAuth.css"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/styleAuth.css') }}">
    
    <link rel="icon" type="image/x-icon" href="{{ asset('images/autour-du-monde.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title>Authentication</title>
</head>

<body>
    @if ($errors->any())
    <div style="background-color: #FED7D7; border: 1px solid #EF4444; color: #EF4444; padding: 1rem; border-radius: 0.375rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);" role="alert">
        <ul style="list-style-type: disc; padding-left: 1rem;">
            @foreach ($errors->all() as $error)
            <li style="font-size: 0.875rem;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <h1>Create Account</h1>

                <span>or use your email for registeration</span>
                <input type="text" name="Fname" placeholder="First name">
                <input type="text" name="Lname" placeholder="Last name">
                <input type="tel" name="phone" placeholder="Phone number">
                <input type="email" name="email" placeholder="Email">
                <input type="hidden" name="bio">
                <input type="hidden" name="github">
                <input type="hidden" name="linkedin">

                <input type="password" name="password" placeholder="Password">
                <input type="password" name="password_confirmation" placeholder="Confirm Password">
                <button type="submit">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email password</span>
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <a href="#">Forget Your Password?</a>
                <button>Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/javascript/script.js') }}"></script>
</body>

</html>