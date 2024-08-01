@extends('layouts.index')
@section('title')
    Home
@endsection
@section('content')
    {{-- Start Carousel --}}
    <div class="jumbotron" style="height: 100vh">
        <div class="card w-100 d-flex justify-content-center align-items-center">
            <div class="gradient"></div>
            <div class="tagline text-white text-center">
                <div class="text">
                    <h1>Creating <span class="text" style="color:#034f84">Beautiful Creations</span> <br> Spreading Utility</h1>
                </div>
                @auth
                    <div class="button mt-5">
                        <a href="{{ auth()->user()->role == 'admin' ? '/my/dashboard/product' : '/my/product' }}"
                            class="btn py-2 px-5" style="background-color:#034f84; border-color:white; color:white">Shop Now <i class="fa-solid fa-cart-shopping"></i></a>
                    </div>
                @endauth
                @guest
                    <div class="button mt-5">
                        <a href="/product" class="btn" style="background-color:#034f84; border-color:white; color:white">Shop Now <i
                                class="fa-solid fa-cart-shopping"></i></a>
                    </div>
                @endguest

            </div>
        </div>
    </div>
    {{-- End Carousel --}}




    {{-- Start Content --}}
    <br>
    <header class="mb-5">
        <h2 class="text-center" style="color: #034f84" style="text-align: justify";>Review</h2>
    </header>
    <div class="container">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
        <div class="container">
            <div class="row">
            <div class="col-4">
                <div class="card">
                    <img src="/assets/img/ulasandafa.png" class="card-img-top" alt="...">
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <img src="/assets/img/ulasanaul.png" class="card-img-top" alt="...">
                </div>
            </div> 
            <div class="col-4">
                <div class="card">
                    <img src="/assets/img/ulasannahda.png" class="card-img-top" alt="...">
                </div>
            </div> 
            </div>
        </div>
        </div>
        <div class="carousel-item">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <img src="/assets/img/ulasancipa.png" class="card-img-top" alt="...">
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <img src="/assets/img/ulasanpute.png" class="card-img-top" alt="...">
                </div>
            </div> 
            <div class="col-4">
                <div class="card">
                    <img src="/assets/img/ulasandesy.png" class="card-img-top" alt="...">
                </div>
            </div> 
            </div>
        </div>
        <div class="carousel-item">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <img src="/assets/img/ulasandimas.png" class="card-img-top" alt="...">
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <img src="/assets/img/ulasanbyul.png" class="card-img-top" alt="...">
                </div>
            </div> 
            <div class="col-4">
                <div class="card">
                    <img src="/assets/img/ulasanhesti.png" class="card-img-top" alt="...">
                </div>
            </div> 
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>


    <section id="new-product" class="my-5">
            <header class="mb-5">
            <h2 class="text-center" style="color: #034f84">New Product</h2>
            </header>
            <section>
                <div class="row" id="data_product">
                    {{-- Data new product -> home_read_new_product --}}
                </div>
            </section>
        </section>
    </div>
    {{-- End Content --}}


    @include('user.component.loading')


    <script>
        $(document).ready(function() {
            $('#loading').removeClass('d-none')
            setTimeout(() => {
                read_data_product_home();
                $('#loading').addClass('d-none')
            }, 2000);
        })

        function read_data_product_home() {
            $.get("{{ url('my/new-product/read') }}", {}, function(data, status) {
                $('#data_product').html(data)
            })
        }

        function detail_product(id) {
            $.get("{{ url('my/product/detail') }}/" + id, {}, function(data, status) {
                $('#data_modal_product').html(data)
                $('#modal_product_label').html('Detail Product')
                $('#button_modal_detail').removeClass('d-none')
                $('#modal_product').modal('show')
            })
        }

        function modal_cart(id) {
            $.get("{{ url('my/home/product/modal-cart/') }}/" + id, {}, function(data, status) {
                $('#data_modal_product').html(data)
                $('#modal_product_label').html('Save to Cart')
                $('#button_modal_detail').addClass('d-none')
                $('#modal_product').modal('show')
            })
        }
    </script>
@endsection
