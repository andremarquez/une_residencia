<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--link rel="stylesheet" href="css/app.css"-->
    <link rel="stylesheet" href="css/login.css">
    <title>Inicio de Sesión</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="center">

        <div class="container">
            <div class="row justify-between">
                <div>
                    <div class="card  center">
                        <h1 class="card-header">{{ __('Iniciar Sesión') }}</h1>

                        <div class="card-body ">
                            <form method="POST" action="{{ route('auth.login') }}">
                                @csrf

                                <div class="">
                                    <!--label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label-->

                                    <div class="campo">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                                        <span></span>
                                        <label>Usuario</label>
                                    </div>
                                </div>

                                <div class=" mt-2">
                                    <!--label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label-->

                                    <div class="campo">
                                        <input id="password" type="password" class="form-control" name="password" required>
                                        <span></span>
                                        <label> Password</label>

                                    </div>
                                </div>

                                <!--div class="form-group row  campo">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div-->
                                @error('email')
                                <div class="invalid-feedback py-2 text-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror

                                <div class=" mb-0">
                                    <div class="offset-md-4">
                                        <input type="submit" class="btn btn-primary" value="{{ __('Iniciar Sesión') }}" />
                                        </input>

                                        <div class="signup_link">
                                            <a href="/">Ir a P&aacute;gina Principal</a>
                                        </div>

                                        @if (Route::has('password.request'))
                                        <!--a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a-->
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>