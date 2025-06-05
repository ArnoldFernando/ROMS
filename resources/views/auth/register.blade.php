<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
        }

        .card {
            border-radius: .75rem;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            padding: 1rem;
        }

        .card-header {
            background: transparent;
            border-bottom: none;
            font-size: 1.25rem;
            font-weight: 600;
            text-align: center;
            color: #2575fc;
            margin-bottom: .5rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.15rem rgba(37, 117, 252, .25);
        }

        .btn-primary {
            background: #2575fc;
            border: none;
            font-size: 0.95rem;
            padding: .5rem .75rem;
        }

        .btn-primary:hover {
            background: #6a11cb;
        }

        .login-logo {
            display: block;
            margin: 0 auto 5px auto;
            max-width: 60px;
        }

        .system-name {
            text-align: center;
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 10px;
            color: #333;
        }

        a {
            color: #2575fc;
            font-size: 0.875rem;
        }

        a:hover {
            color: #6a11cb;
        }

        .form-label {
            font-size: 0.875rem;
        }

        .form-control {
            font-size: 0.875rem;
            padding: .4rem .6rem;
        }

        .container {
            padding-top: 4vh;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-start">
            <div class="col-md-6 col-lg-4">

                <!-- Logo -->
                <img src="{{ asset('image/csu.png') }}" alt="Logo" class="login-logo">

                <!-- System Name -->
                <div class="system-name">Record's Office Management System</div>

                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-2">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>

                        <div class="mt-2 text-center">
                            <a href="{{ route('login') }}">{{ __('Already have an account? Login') }}</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
