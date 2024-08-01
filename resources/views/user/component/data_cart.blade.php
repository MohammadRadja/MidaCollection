<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="table-responsive">
   <table class="table table-striped" style="vertical-align: middle">
      <thead>
         <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Stock</th>
            <th scope="col">Price</th>
            <th scope="col">Size</th>
            <th scope="col">Count</th>
            <th scope="col">Action</th>
         </tr>
      </thead>
      <tbody>
         @php
         $no = 1;
         $total = 0;
         @endphp
         @foreach ($data as $product)
         @if (auth()->user()->id == $product->user_id)
         <tr>
            <th scope="row">{{ $no++ }}</th>
            <td><img src="/images/{{ $product->product->image }}" alt="cart-img" width="40px"></td>
            <td style="white-space: nowrap;">{{ $product->product->name }}</td>
            <td>{{ $product->product->stock }}</td>
            <td style="white-space: nowrap;">{{ $product->product->price }}</td>
            <td>{{ $product->size }}</td>
            <td>{{ $product->count }}</td>
            <td><a type="button" onclick="delete_product_cart({{ $product->id }})"
               class="text-danger fs-4"><i class="fa-solid fa-xmark"></i></a></td>
         </tr>
         @php
         $total += $product->product->price * $product->count;
         @endphp
         @endif
         @endforeach
      </tbody>
   </table>
</div>
<div class="btn-checkout d-flex justify-content-end">
   <div class="mt-2 mx-3"><span class="fw-bold">Total : </span><sub>Rp. </sub> {{ number_format($total, 0, ',', '.') }}
   </div>
   <button type="button" class="btn px-4" style="background-color:#034f84; border-color:white; color:white;" data-bs-toggle="modal"
      data-bs-target="#checkoutModall">Checkout</button>
</div>

<!-- Tambahkan modal checkout -->
<div class="modal fade" id="gantiAlamat" tabindex="-1" aria-labelledby="gantiAlamatLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header" style="background-color:#034f84; border-color:white; color:white">
            <h5 class="modal-title" id="gantiAlamat">Checkout</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12 mb-3">
                  <div class="mb-3">
                     <input type="input" name="iduser" id="iduser" class="form-control"
                        value="{{auth()->user()->id}}" hidden disabled>
                     <label for="alamat" class="form-label fw-bold">Address</label>
                     <input type="alamatUser" class="form-control" id="alamatUser"
                        value="{{ auth()->user()->address }}">
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" onclick="ubahalamat()" class="btn btn-dark">Save</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="checkoutModall" tabindex="-1" aria-labelledby="checkoutModallLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header" style="background-color:#034f84; border-color:white; color:white">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Checkout</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form action="/my/order/store" method="POST" id="order-form" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
               <div class="row">
               <div class="col-md-12 mb-3">
                  <div class="mb-3">
                     <label for="name" class="form-label fw-bold">Name</label>
                     <input type="text" class="form-control" id="name"
                        value="{{ auth()->user()->name }}" disabled>
                  </div>
                  <div class="mb-3">
                     <label for="email" class="form-label fw-bold">Email</label>
                     <input type="email" class="form-control" id="email"
                        value="{{ auth()->user()->email }}" disabled>
                  </div>
                  <div class="mb-3">
                     <label for="alamat" class="form-label fw-bold">Address</label>
                     <input type="alamat" class="form-control" id="alamat"
                        value="{{ auth()->user()->address }}" disabled>
                     <button type="button" class="btn px-4 mt-2" style="background-color:#034f84; border-color:white; color:white;" data-bs-toggle="modal"
                        data-bs-target="#gantiAlamat">Change</button>
                  </div>
                  <div class="row">
                     <label for="" class="form-label fw-bold">Transfer Via E-Wallet</label>
                     <div class="col-md-6 mb-3">
                        <img src="/assets/img/spay.jpg" width="30% " alt="">
                        <img src="/assets/img/no-spay-dana.jpg" width="35% " alt="">
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6 mb-3">
                        <img src="/assets/img/dana.jpg" width="35%" alt="">
                        <img src="/assets/img/no-spay-dana.jpg" width="35% " alt="">
                     </div>
                  </div>
                  <div class="row">
                     <label for="" class="form-label fw-bold mb-3">Transfer Via Bank</label>
                     <div class="col-md-6 mb-3">
                        <img src="/assets/img/bank-dki.jpg" width="35%" alt="">
                        <img src="/assets/img/norek-dki.jpg" width="35%" alt="">
                     </div>
                  </div>
                  <div class="mb-3">
                  <label for="file" class="form-label fw-bold">Upload Payment Transfer</label>
                     <input class="form-control" type="file" id="formFile"
                        accept="image/jpeg, image/jpg, image/png" name="image" required>
                        <small class="text-danger fw-italic">Maximum size: 2 MB. Please upload files in JPEG, JPG, or PNG format.</small>
                        </div>
               </div>
            </div>
            </div>
            <div class="modal-footer">
            <span><span class="fw-bold">Total : </span> <sub>Rp. </sub>
            <span>{{ number_format($total, 0, ',', '.') }}</span></span>
            <input type="number" hidden id="total" value="{{ $total }}">
            <button type="submit" class="btn btn-dark">Checkout <i
               class="fa-brands fa-shopify"></i></button>
            </div>
         </form>
      </div>
   </div>
</div>
<script>
   function validation_paymnet() {
   
   }
   
   function read_cart() {
       $.get("{{ url('my/cart/read') }}", {}, function(data, status) {
           $("#data_cart").html(data);
       })
   }
   
   function ubahalamat() {
       $.ajax({
               type: 'post',
               url: '/my/cart/address',
               data: {
                   id: $('#iduser').val(),
                   address: $('#alamatUser').val(),
                   _token: $('meta[name="csrf-token"]').attr('content')
               },
               dataType: "json",
               success: function(response) {
                   $('#gantiAlamat').modal('hide');
                   read_cart()
                   Swal.fire({
                       icon: 'success',
                       title: 'Address',
                       text: 'Address Succesfully Changed!',
                   })
               },
               error: function(xhr, status, error) {
                   console.log(xhr.responseText)
                   Swal.fire({
                       icon: 'error',
                       title: 'Oops...',
                       text: 'Contact Admin!',
                   })
               }
           });
   }
   
   // Alert Error Payment via bank and via E-Wallet
   function alert_payment_error() {
       Swal.fire({
           icon: 'error',
           title: 'Oops...',
           text: 'Payment not available!',
       })
   }
   
   function ubah(){
       $('#checkoutModal').modal('hide');
       $('#gantialamat').modal('show');
   }
   
   function order_store() {
       // Validation payment
       var total = $("#total").val();
       var payment = $("#manual_transfer_payment").val();
   
       // Validasi input pembayaran
       if (Number.isNaN(payment)) {
           Swal.fire({
               icon: 'error',
               title: 'Oops...',
               text: 'Pembayaran harus berupa angka!',
           })
           console.log("Pembayaran harus berupa angka.");
           return;
       }
   
       // Validasi apakah jumlah pembayaran lebih besar dari 0
       if (payment <= 0) {
           Swal.fire({
               icon: 'error',
               title: 'Oops...',
               text: 'Pembayaran harus lebih besar dari Rp. 0!',
           })
           return;
       }
   
       if (total > payment) {
           Swal.fire({
               icon: 'error',
               title: 'Oops...',
               text: 'Uang anda tidak cukup!',
           })
   
           return;
       }
       
       if (payment > total) {
           Swal.fire({
               icon: 'error',
               title: 'Oops...',
               text: 'Harap masukkan nominal yang sesuai!',
           })
           return;
       }
   
   
       if (total == payment || total < payment) {
   
           $.ajaxSetup({
           headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
           });
           var products = [];
   
           $('#add-to-order').each(function(index, element) {
               var product = {
                   user_id: $('#user_id').val(),
                   name: $('#name').val(),
                   stock: $('#stock').val(),
                   price: $('#price').val(),
                   category: $('#category').val(),
                   sold: $('#sold').val(),
                   count: $('#count').val(),
                   size: $('#size').val(),
                   status: $('#status').val(),
                   image: $('#image').val(),
                   payment: $('#payment').val(),
                   images: $('#formFile')[0].files[0],
               };
               products.push(product);
           });
           console.log(products);
           $('#product_count').val(products.length);
           $.ajax({
               type: 'post',
               url: '/my/order/store',
               data: products,
               processData: false,
               contentType: false,
               dataType: "json",
               success: function(response) {
                   $('#checkoutModal').modal('hide');
                   read_cart()
                   Swal.fire({
                       icon: 'success',
                       title: 'Pembayaran Berhasil!',
                       text: 'Pesanan berhasil ' + (payment).toLocaleString('id-ID', {
                           style: 'currency',
                           currency: 'IDR'
                       })
                   })
               },
               error: function(xhr, status, error) {
                   console.log(xhr.responseText)
                   Swal.fire({
                       icon: 'error',
                       title: 'Oops...',
                       text: 'No product selected!',
                   })
               }
           });
   
           console.log("Lunas");
           return;
       } else {
           Swal.fire({
               icon: 'error',
               title: 'Oops...',
               text: 'Uang anda tidak cukup!',
           })
       }
   
   }
</script>