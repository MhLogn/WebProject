<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CarZone - Trang web bán ô tô</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Tailwind (nếu có Vite hoặc hot) -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }

        .brand-card:hover {
            transform: scale(1.05);
            transition: all 0.3s ease;
        }

        footer a:hover {
            color: #000;
        }
    </style>
</head>

<body class="bg-light text-dark d-flex flex-column min-vh-100">

    <!-- Header -->
    <header class="container py-4">
        @if (Route::has('login'))
            <nav class="d-flex justify-end justify-content-end gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary btn-sm">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">
                        Đăng nhập
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-success btn-sm">
                            Đăng ký
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <!-- Main Content -->
    <main class="container text-center flex-grow-1">
        <h1 class="display-5 fw-semibold mt-4" style="color: green;">Welcome To CarZone</h1>
        <a href="" target="_blank" class="gap-4"> 
            <img src="{{ asset('storage/logo/logo-carzone.png') }}" alt="Car Zone Logo" class="h-20 w-auto d-block mx-auto">
        </a> 
        <p class="lead text-muted mt-3">
            Chào mừng bạn đến với CarZone – nơi cung cấp các dòng xe chất lượng cao và dịch vụ đáng tin cậy
        </p>
        <p class="lead text-muted mt-3">
            Đăng nhập hoặc đăng ký vào trang web để tận hưởng toàn bộ tiện ích của chúng tôi.
        </p>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="{{ route('register') }}" class="btn btn-primary">
                Tạo tài khoản cho riêng mình
            </a>
        </div>

        <h2 class="mt-5 mb-3 h4 text-secondary">Các thương hiệu</h2>

        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-4 justify-content-center">
            @php
                $brands = [
                    ['car' => 'bmw-car.png', 'logo' => 'BMW-logo.png'],
                    ['car' => 'lam-car.png', 'logo' => 'lam-logo.png'],
                    ['car' => 'lexus-car.png', 'logo' => 'lexus-logo.png'],
                    ['car' => 'mer-car.png', 'logo' => 'mer-logo.png'],
                    ['car' => 'pc-car.png', 'logo' => 'pc-logo.png'],
                    ['car' => 'rr-car.png', 'logo' => 'rr-logo.png'],
                    ['car' => 'vin-car.png', 'logo' => 'vin-logo.png'],
                ];
            @endphp

            @foreach ($brands as $brand)
                <div class="col brand-card text-center shadow-sm bg-white p-3 rounded">
                    <a  href="{{ route('register') }}">
                        <img src="{{ asset('storage/welcomeImg/' . $brand['car']) }}" alt="Car" class="img-fluid mb-2" style="max-height: 100px;">
                        <img src="{{ asset('storage/logo/' . $brand['logo']) }}" alt="Logo" class="img-fluid" style="max-height: 60px;">
                    </a>
                </div>
            @endforeach
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-top mt-5 py-4 text-center text-muted">
        <div class="container d-flex flex-column flex-md-row justify-content-center gap-5">
            <div class="text-center">
                <a href="#" class="text-decoration-none d-block mb-2">Về chúng tôi</a>
                <a href="https://www.facebook.com/hamanhlong.2206" target="_blank" rel="noopener noreferrer" class="d-inline-block">
                    <img src="{{ asset('storage/logo/facebook-icon.png') }}" alt="Facebook" class="img-fluid" style="height: 24px;">
                </a>
            </div>


            <div class="text-center">
                <a href="#" class="text-decoration-none d-block mb-2">Liên hệ</a>
                <a href="https://zalo.me/0377191508" target="_blank" rel="noopener noreferrer" class="d-inline-block">
                    <img src="{{ asset('storage/logo/zalo-icon.png') }}" alt="Zalo" class="img-fluid" style="height: 24px;">
                </a>
            </div>
        </div>
        
        <div class="mt-3">
            <a href="mailto:hamanhlong39@gmail.com" class="text-decoration-none d-block mb-2">
                Gmail: hamanhlong39@gmail.com
            </a>
        </div>
        <p class="mt-3 mb-0">&copy; {{ date('Y') }} CarZone. Have a nice day!</p>
    </footer>

</body>
</html>
