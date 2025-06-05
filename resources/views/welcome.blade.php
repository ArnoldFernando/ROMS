<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Records Office Management System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
        }

        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-custom {
            background-color: #dc3545;
            color: white;
        }

        .btn-custom:hover {
            background-color: #bb2d3b;
        }

        .logo {
            width: 100px;
            height: auto;
            margin-bottom: 20px;
        }
    </style>

</head>

<body>

    <div class="container hero-section">
        <div class="row"
            style="background: rgba(255, 255, 255, 0.25); backdrop-filter: blur(10px); border-radius: 20px; box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18); padding: 40px;">

            <div class="col-lg-5 mx-auto p-4 mt-5">
                <!-- Logo -->
                {{--  <img src="{{ asset('image/csu.png') }}" alt="Logo" class="logo">  --}}

                <!-- Title & Description -->
                <h1 class="display-3 fw-bold mb-3">Records Office</h1>
                <h1 class="display-5">Management System</h1>
                <p class="lead mb-4">Efficiently manage and access student and faculty records in one streamlined
                    platform.
                </p>

                <!-- Buttons -->
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-outline-dark me-2">Go to Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-custom me-2">Log In</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline-secondary">Register</a>
                        @endif
                    @endauth
                @endif
            </div>

            <div class="col-lg-7 d-none d-lg-block">
                <!-- Optional Image -->
                <img src="{{ asset('image/bg.svg') }}" alt="Hero Image" class="img-fluid">
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
