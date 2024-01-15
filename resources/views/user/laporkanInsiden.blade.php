<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Sistem Laporan Insiden</title>
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
            font-family: 'Open Sans', sans-serif;
            box-sizing: border-box;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-sizing: border-box;
            text-align: center;
            color: rgba(0, 114, 185, 0.90);
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: rgba(0, 114, 185, 0.90);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="left-box">
            <div class="title-box">
                <h2 style="font-size: 20px; margin: 0; padding: 0">LOGIN SISTEM</h2>
                <h2 style="font-size: 20px; margin: 0; padding: 0;">LAPORKAN INSIDEN</h2>
            </div>
            <div class="login-form">
                <form id="loginForm" method="post">
                    @csrf
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    <p style="font-size: 10px; color:#323232">Jika lupa password hubungi admin di admin@ap1.co.id.</p>
                    <button onclick="submitForm()">Login</button>
                </form>
            </div>
        </div>
        <div class="right-box">
            <img src="img/loginGambar.svg" alt="Login Image" style="max-height: 100%; max-width: 100%;">
            <a href="{{ route('user.beranda') }}" class="back-to-home">Kembali Ke Beranda</a>
        </div>

        @if ($errors->has('popup'))
            <script>
                alert('Anda telah mencapai batas percobaan login maksimum. Silakan tunggu selama 20 detik.');
            </script>
        @endif

        @if (isset($token) && isset($role_user))
            <script>
                console.log('Token and Role_user are set. Redirecting...');
                var token = "{{ $token }}";
                var role_user = "{{ $role_user }}";
                
                // Simulate the response data for testing
                var responseData = {
                    access_token: token,
                    user: {
                        role_user: role_user
                    }
                };

                // Log the entire response for debugging
                console.log('Login response:', responseData);

                var redirectRoute;

                switch (responseData.user.role_user) {
                    case 'Admin':
                        redirectRoute = "{{ route('admin.contentManagement') }}";
                        break;
                    case 'Pelapor':
                        redirectRoute = "{{ route('pelapor.reportPelapor') }}";
                        break;
                    case 'Pimpinan':
                        redirectRoute = "{{ route('pimpinan.dashboard') }}";
                        break;
                    case 'Superuser':
                        redirectRoute = "{{ route('superuser') }}";
                        break;
                    default:
                        redirectRoute = "{{ route('user.beranda') }}";
                }

                // Set the values to data attributes
                document.getElementById('loginForm').setAttribute('data-token', token);
                document.getElementById('loginForm').setAttribute('data-role-user', role_user);
                document.getElementById('loginForm').setAttribute('data-redirect-route', redirectRoute);
            </script>
        @endif
    </div>

    <script>
        function submitForm() {
            var emailInput = document.getElementById('email');
            var passwordInput = document.getElementById('password');

            if (!emailInput.value.endsWith('@gmail.com')) {
                alert('Please enter an email address ending with @gmail.com.');
                return;
            }

            fetch('{{ url('api/auth/login') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    email: emailInput.value,
                    password: passwordInput.value,
                }),
            })
            .then(response => response.json())
            .then(data => {
                console.log('Login response:', data);

                if (data.error) {
                    alert(data.error);
                } else {
                    localStorage.setItem('token', data.access_token);
                    localStorage.setItem('role_user', data.user.role_user);

                    var redirectRoute;

                    switch (data.user.role_user) {
                        case 'Admin':
                            redirectRoute = "{{ route('admin.contentManagement') }}";
                            break;
                        case 'Pelapor':
                            redirectRoute = "{{ route('pelapor.reportPelapor') }}";
                            break;
                        case 'Pimpinan':
                            redirectRoute = "{{ route('pimpinan.dashboard') }}";
                            break;
                        case 'Superuser':
                            redirectRoute = "{{ route('superuser') }}";
                            break;
                        default:
                            redirectRoute = "{{ route('user.beranda') }}";
                    }

                    window.location.href = redirectRoute;
                    console.log(data.role_user);
                    console.log(redirectRoute);
                }
            })
            .catch(error => {
                console.error('Error during login:', error);
                alert('Login failed. Please try again.');
            });
        }
    </script>
</body>
</html>
