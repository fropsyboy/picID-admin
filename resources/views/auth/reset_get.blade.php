<!DOCTYPE html>
<html lang="en">
<head>
    <title>Foteino Portal :: Password Reset </title>
    <!-- Meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Job search, company recruitment"
    />
    <script>
        addEventListener("load", function () { setTimeout(hideURLbar, 0); }, false); function hideURLbar() { window.scrollTo(0, 1); }
    </script>
    <!-- Meta tags -->
    <!--stylesheets-->
    <link href="{{ asset('auth/css/style.css') }}" rel='stylesheet' type='text/css' media="all">
    <!--//style sheet end here-->
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet">
</head>
<body>
<div class="mid-class">
    <div class="art-right-w3ls">

        <h2>Password Reset
            <a href="https://foteinotalento.com" style="color: #205e7e">
                <b> Foteino Talento </b>
            </a>
        </h2>
        <form action="{{ route('update_password') }}" method="post">
            @csrf
            <div class="main">
                @if(session()->get('error'))
                    <div class="alert alert-danger " >
                        <font color="red">
                            {{ session()->get('error') }}
                        </font>
                    </div>
                @endif
                <div class="form-left-to-w3l">
                    <input type="text" name="email" placeholder="email" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: #761b18;">{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>

                    <div class="form-left-to-w3l">
                        <input type="text" name="code" placeholder="Email Token" required  autofocus>

                    </div>

                    <div class="form-left-to-w3l">
                        <input type="password" name="password" placeholder="Password"  required  autofocus>

                    </div>

                    <div class="form-left-to-w3l">
                        <input type="password" name="cpassword"  placeholder="Confirm Password"  required autofocus>

                    </div>

            </div>

            <div class="btnn">
                <button type="submit" style="background-color: #205e7e; border-radius: 12px;">Update Password</button>
            </div>
        </form>
        <div class="w3layouts_more-buttn">
            <h3>Already Have an account... ?
                <a href="{{route('login')}}">Log In Here
                </a>
            </h3>
        </div>

    </div>
    <div class="art-left-w3ls">
        <h1 class="header-w3ls">
            Welcome to Foteino Talento
        </h1>
    </div>
</div>
<footer class="bottem-wthree-footer">
    <p>
        © 2020 Foteino LTD All Rights Reserved | Design by
        <a href="" target="_blank">Foteino</a>
    </p>
</footer>
</body>
</html>
