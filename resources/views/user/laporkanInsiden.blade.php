<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Sistem Laporan Insiden</title>
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
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                <button>Login</button>
            </div>
        </div>
        <div class="right-box">
            <!-- Tambahkan elemen untuk gambar -->
            <img src="img/loginGambar.svg" alt="Login Image" style="max-height: 100%; max-width: 100%;">
            <!-- Tambahkan tautan kembali ke beranda -->
            <a href="{{ route('user.beranda') }}" class="back-to-home">Kembali Ke Beranda</a>
        </div>
    </div>
</body>
</html>
