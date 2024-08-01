<footer class="bg-dark py-5" style="border-top: 4px solid #034f84;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h1 class="text-title">MidaCollection</h1>
                <p class="text-white">MidaCollection is a shopping platform that offers a variety of handcrafted products designed to enhance household items and provide the best service with an easy-to-use interface.</p>
                <div class="mt-3">
                    <a href="#" class="btn btn-outline-primary">Learn More</a>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <h1 class="text-title">Quick Links</h1>
                <ul class="list-unstyled">
                    @guest
                        <li><a href="/" class="text-decoration-none text-white quicks-links">Home</a></li>
                        <li><a href="/product" class="text-decoration-none text-white quicks-links">Products</a></li>
                        <li><a href="/auth/login" class="text-decoration-none text-white quicks-links">Login</a></li>
                    @endguest
                    @auth
                        <li><a href="/my/home" class="text-decoration-none text-white quicks-links">Home</a></li>
                        <li><a href="/my/product" class="text-decoration-none text-white quicks-links">Products</a></li>
                        @if (auth()->user()->role == 'admin')
                            <li><a href="/my/dashboard/product" class="text-decoration-none text-white quicks-links">Dashboard</a></li>
                        @endif
                    @endauth
                </ul>
            </div>
            <div class="col-md-4 mb-3">
                <h1 class="text-title">Contact Us</h1>
                <p class="text-white">Get in touch with us through social media:</p>
                <div class="social-media d-flex gap-3">
                    <a href="https://www.instagram.com/auliya.bm" target="_blank" class="fs-5 text-white"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://wa.me/085179635320" class="fs-5 text-white"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="https://www.tiktok.com/@o0owll" target="_blank" class="fs-5 text-white"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>
        </div>
        <hr class="bg-primary">
        <div class="row mt-4">
            <div class="col text-center">
                <p class="text-muted">Copyright &copy; 2024 by <a href="https://github.com/auliyabm" class="text-primary" target="_blank">Auliya Balindra</a></p>
            </div>
        </div>
    </div>
</footer>

<style>
    .text-title {
        color: #034f84;
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    p {
        margin-bottom: 15px;
    }

    .quicks-links:hover {
        text-decoration: underline;   
        background-color: #034f84; /* Slight background color on hover */
        transform: scale(1.1); /* Slightly enlarge the link */
    }

    .social-media a:hover {
        color: #034f84;
        transform: scale(1.3);
        transition: transform 0.3s ease;
    }

    hr {
        border: none;
        height: 2px;
        background: #034f84;
        margin: 20px 0;
    }

    .btn-outline-primary {
        border-color: #034f84;
        color: #034f84;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-outline-primary:hover {
        background-color: #034f84;
        color: white;
    }
</style>
