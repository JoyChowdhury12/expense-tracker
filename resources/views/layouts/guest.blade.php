<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- ✅ Favicon (ADDED) -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif !important;
            background-color: #f4f7fe;
            color: #2b3674;
        }

        .auth-card {
            background: white;
            border-radius: 20px;
            border: none;
            box-shadow: 0px 10px 40px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(67, 24, 255, 0.15);
            border-color: #4318FF;
        }

        .btn-primary {
            background-color: #4318FF;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background-color: #3311cc;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(67, 24, 255, 0.2);
        }
    </style>
</head>

<body>
    <div class="auth-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-5">
                    <div class="text-center mb-4">
                        <a href="/">
                            <x-application-logo style="width: 80px; height: auto; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);" />
                        </a>
                        <h3 class="fw-bold mt-4 tracking-tight" style="color: #2b3674;">Welcome</h3>
                        <p class="text-muted">Enter your credentials to access your dashboard</p>
                    </div>
                    
                    <div class="auth-card p-4 p-sm-5">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>