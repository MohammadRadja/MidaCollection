@foreach ($data as $product)
    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
        <div class="card h-100 shadow-sm d-flex flex-column">
            <div class="position-relative">
                <img src="/images/{{ $product->image }}" class="card-img-top img-product" alt="Product Image">
                <div id="new-label" class="position-absolute top-0 start-0">
                    <div class="label-one text-center py-1 px-2" style="background-color:#034f84; color:white">
                        <span>New</span>
                    </div>
                    <div class="label-two bg-light"></div>
                </div>
            </div>
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="fs-5 mb-4"><sub>Rp.</sub> {{ number_format($product->price, 0, ',', '.') }}</p>
                <div class="mt-auto">
                    <div class="btn-group d-flex gap-2">
                        <a onclick="detail_product({{ $product->id }})" class="btn btn-custom">Detail</a>
                        @if (auth()->user()->role == 'admin')
                            <button type="button" onclick="onError()" class="btn btn-dark"><i class="fa-solid fa-cart-shopping"></i></button>
                        @endif
                        @if (auth()->user()->role == 'user')
                            <button type="button" onclick="modal_cart({{ $product->id }})" class="btn btn-dark"><i class="fa-solid fa-cart-shopping"></i></button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Modal -->
<div class="modal fade" id="modal_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#034f84; color:white;">
                <h1 class="modal-title fs-5" id="modal_product_label"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="data_modal_product">
                {{-- view data_modal_detail_product --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function onError() {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Product tidak tersedia untuk admin!',
        });
    }
</script>


<style>
    .img-product {
        height: 200px; /* Atur tinggi gambar sesuai keinginan */
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