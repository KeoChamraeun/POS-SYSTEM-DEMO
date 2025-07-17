<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{  asset('backend/assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{  asset('backend/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{  asset('backend/assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="{{  asset('backend/assets/plugins/tabler-icons/tabler-icons.css')}}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{  asset('backend/assets/css/style.css')}}">

</head>

<body class="account-page bg-white">
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper login-new">
                <div class="row w-100">
                    <div class="col-lg-5 mx-auto">
                        <div class="login-content user-login">
                            <div class="login-logo">
                                <a href="{{ route('dashboard') }}">
                                    <img src="data:image/png;base64,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" alt="img">
                                </a>
                            </div>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="card">
                                    <div class="card-body p-5">
                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        <div class="login-userheading">
                                            <h3>Sign In</h3>
                                            <h4>Access the POS admin panel using your email and password.</h4>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email <span class="text-danger"> *</span></label>
                                            <div class="input-group">
                                                <input type="text" name="email" class="form-control border-end-0">
                                                <span class="input-group-text border-start-0">
                                                    <i class="ti ti-mail"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password <span class="text-danger">
                                                    *</span></label>
                                            <div class="pass-group">
                                                <input type="password" name="password" class="pass-input form-control">
                                                <span class="ti toggle-password ti-eye-off text-gray-9"></span>
                                            </div>
                                        </div>
                                        <!-- <div class="form-login authentication-check">
                                            <div class="row">
                                                <div class="col-12 d-flex align-items-center justify-content-between">
                                                    <div class="text-end">
                                                        <a class="text-orange fs-16 fw-medium"
                                                            href="{{ route('password.request') }}">Forgot Password?</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="form-login">
                                            <button type="submit" class="btn btn-primary w-100">Sign In</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                            <p>2025 RAEUN POS</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="{{  asset('backend/assets/js/jquery-3.7.1.min.js') }}"></script>

    <!-- Feather Icon JS -->
    <script src="{{  asset('backend/assets/js/feather.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{  asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{  asset('backend/assets/js/script.js') }}"></script>
</body>

</html>