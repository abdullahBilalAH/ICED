<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS for Green Theme -->
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f0f8f0; /* Light green background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            border-color: #28a745; /* Green border for the card */
        }

        .nav-link.active {
            background-color: #28a745; /* Green background for active tab */
            color: white !important;
        }

        .nav-link {
            color: #28a745; /* Green color for inactive tabs */
        }

        .form-control {
            border-color: #28a745; /* Green border for input fields */
        }

        .form-control:focus {
            border-color: #218838; /* Darker green on focus */
            box-shadow: 0 0 0 0.2rem rgba(56, 168, 79, 0.25); /* Green shadow on focus */
        }

        .btn-primary {
            background-color: #28a745; /* Green button background */
            border-color: #28a745; /* Green button border */
        }

        .btn-primary:hover {
            background-color: #218838; /* Darker green on hover */
            border-color: #1e7e34; /* Darker green border on hover */
        }

        .form-check-label {
            color: #28a745; /* Green color for the Remember me label */
        }

        .text-secondary {
            color: #28a745; /* Green color for secondary text */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <!-- Pills navs -->
                        <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="tab-login" data-toggle="pill" href="#pills-login" role="tab"
                                   aria-controls="pills-login" aria-selected="true">Login</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-register" data-toggle="pill" href="#pills-register" role="tab"
                                   aria-controls="pills-register" aria-selected="false">Register</a>
                            </li>
                        </ul>
                        <!-- Pills navs -->

                        <!-- Pills content -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                                <!-- Login Form -->
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <!-- Email Address -->
                                    <div class="form-group">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group mt-4">
                                        <x-input-label for="password" :value="__('Password')" />
                                        <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="form-group form-check mt-4">
                                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                        <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
                                    </div>

                                    <div class="form-group mt-4 d-flex justify-content-between">
                                        @if (Route::has('password.request'))
                                            <a class="text-sm text-secondary" href="{{ route('password.request') }}">
                                                {{ __('Forgot your password?') }}
                                            </a>
                                        @endif

                                        <x-primary-button class="btn btn-primary">
                                            {{ __('Log in') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                                <!-- Register Form -->
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <!-- Name -->
                                    <div class="form-group">
                                        <x-input-label for="name" :value="__('Name')" />
                                        <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <!-- Email Address -->
                                    <div class="form-group mt-4">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group mt-4">
                                        <x-input-label for="password" :value="__('Password')" />
                                        <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="form-group mt-4">
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                        <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>

                                    <div class="form-group mt-4 d-flex justify-content-between">
                                        <a class="text-sm text-secondary" href="{{ route('login') }}">
                                            {{ __('Already registered?') }}
                                        </a>

                                        <x-primary-button class="btn btn-primary">
                                            {{ __('Register') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Pills content -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Files -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('js/mixitup.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
