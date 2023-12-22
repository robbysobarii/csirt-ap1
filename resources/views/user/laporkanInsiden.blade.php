<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Sistem Laporan Insiden</title>
    <!-- Tambahkan tag link untuk memuat font Open Sans -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
        body {
            background-image: url('img/login_bg.svg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            /* Atur font untuk seluruh body */
            font-family: 'Open Sans', sans-serif;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="left-box">
            <div class="title-box">
                <h2 style="margin: 0;padding: 0">LOGIN</h2>
                <p style="margin: 0;padding: 0;">SISTEM LAPORKAN INSIDEN</p>
            </div>
            <div class="login-form">
                <form id="loginForm" method="post" action="{{ route('masuk') }}">
                    @csrf
                    <input type="email" name="email_user" id="email_user" class="form-control" placeholder="Email" required>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
        <div class="right-box">
            <!-- Tambahkan elemen untuk gambar -->
            <img src="img/loginGambar.svg" alt="Login Image" style="max-height: 100%; max-width: 100%;">
            <!-- Tambahkan tautan kembali ke beranda -->
            <a href="{{ route('user.beranda') }}" class="back-to-home">Kembali Ke Beranda</a>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function (event) {
            var emailInput = document.getElementById('email_user');
            if (!emailInput.value.endsWith('@gmail.com')) {
                alert('Mohon masukkan alamat email yang berakhiran @gmail.com.');
                event.preventDefault(); // Mencegah form dari pengiriman jika email tidak valid
            }
        });
    </script>
</body>
</html>
