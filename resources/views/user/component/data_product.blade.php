@foreach ($data as $product)
    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
        <div class="card">
            <img src="{{ asset('images/' . ($product->image ?? 'no-image.jpg')) }}" class="card-img-top img-product" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="fs-5"><sub>Rp.</sub> {{ number_format($product->price, 0, ',', '.') }}</p>
                <br>
                <br>
                <div class="btn-group d-flex gap-2">
                    <button type="button" class="btn btn-custom" 
                        onclick="detail_product({{ $product->id }})">Detail</button>
                    <button type="button" onclick="modal_cart({{ $product->id }})" class="btn btn-dark"><i
                            class="fa-solid fa-cart-shopping"></i></button>
                </div>
            </div>
        </div>
    </div>
@endforeach


<style>
    .img-product {
        height: 250px; /* Atur tinggi gambar sesuai keinginan */
        object-fit: cover; /* Agar gambar ter-crop dengan proporsi yang benar */
    }

    .card-title {
        min-height: 3rem; /* Atur tinggi minimum judul */
    }

    .card-body {
        display: flex;
        flex-direction: column;
    }

    .btn-custom {
        background-color: #034f84 !important; /* Menggunakan !important untuk prioritas tinggi */
        color: white !important;
        border-color: #034f84 !important;
    }

    .btn-custom:hover {
        background-color: #023e6d !important;
        border-color: #023e6d !important;
    }
</style>
