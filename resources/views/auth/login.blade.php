<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/assets/img/logo-shortcut.png">

    <title>MidaCollection - Login</title>

    {{-- Auth css --}}
    <link rel="stylesheet" href="/assets/css/auth.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <main>
        <div class="row">
            <div class="col-md-6">
                <div id="img-login"></div>
            </div>
            <div class="col-md-6">
                <div class="mt-5">
                    <header class="d-flex justify-content-center ">
                        <img src="/assets/img/logo-nama.png" alt="" width="200px">
                    </header>
                    <div class="row justify-content-center px-3 mt-5">
                        <div class="col-md-6">
                            <h2 class="fw-bold text mb-4" style="color: #034f84">Login</h2>

                            {{-- Alert untuk pesan status --}}
                            @if(session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="/auth/login" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold">Email address</label>
                                    <input type="email" name="email"
                                        class="form-control border border-primary  @error('email') is-invalid @enderror"
                                        id="email" placeholder="example@gmail.com">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-bold">Password</label>
                                    <input type="password" name="password"
                                        class="form-control border border-primary  @error('password') is-invalid @enderror"
                                        id="password">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn px-5 mt-3" style="background-color:#034f84; border-color:white; color:white">Login</button>
                                </div>
                            </form>

                            <p class="text-center mt-3">You don't have account? <a href="/auth/register"
                                    class="fw-bold text-decoration-none text-dark">Register</a></p>
                            <p class="text-center mt-3">Forgot Password? <a href="/auth/forgot-password"
                                    class="fw-bold text-decoration-none text-dark">Here</a></p>        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
