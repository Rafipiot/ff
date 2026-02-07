<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .auth-wrapper {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }
        
        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }
        
        .form-control {
            border-radius: 8px;
            padding: 12px;
            border: 1.5px solid #e0e0e0;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }
        
        .form-control:focus {
            border-color: #4361ee;
            box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.15);
            background-color: #fff;
        }
        
        .login-btn {
            padding: 12px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .login-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
        }
            .auth-wrapper {
        min-height: 100vh;
        background: linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.8)), 
                    url('images/img_eatlah.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    
        
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="container">
            <div class="row justify-content-center min-vh-100 align-items-center">
                <div class="col-md-4">
                    <div class="auth-card card p-4">
                        <!-- Logo -->
                        <div class="text-center mb-4">
                            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="img-fluid" style="max-height: 70px;">
                        </div>

                        <!-- Welcome Text -->
                        <div class="text-center mb-4">
                            <p class="text-muted small">Please sign in to your account</p>
                        </div>

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <!-- Email Input -->
                            <div class="mb-3">
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="Email address"
                                       required 
                                       autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="mb-4">
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Password"
                                       required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-primary login-btn">
                                    Sign In
                                </button>
                            </div>

                            <!-- Register Link -->
                            @if (Route::has('register'))
                                <div class="text-center">
                                    <span class="text-muted small">Don't have an account?</span>
                                    <a href="{{ route('register') }}" class="small text-primary text-decoration-none ms-1 fw-medium">
                                        Sign up
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>