<script>
    // Cart
    $(document).ready(function() {
        read_cart()
    })

    function read_cart() {
        $.get("{{ url('my/cart/read') }}", {}, function(data, status) {
            $("#data_cart").html(data);
        })
    }



    function delete_product_cart(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success mx-1',
                cancelButton: 'btn btn-danger mx-1'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'get',
                    url: '/my/cart/destroy/' + id,
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your product has been deleted.',
                            'success'
                        )
                        read_cart()
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });

            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your product is safe :)',
                    'error'
                )
            }
        })
    }


    // For order ======================================================
    // Add data Product
$(document).ready(function() {

$('#order-form').on('submit', function(event) {
    //event.preventDefault();
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
   
   
       if (total == payment || total < payment){
        event.preventDefault();
        // Ambil data form
    var formData = new FormData(this);

    // Kirim data form menggunakan AJAX
    $.ajax({
        type: 'POST',
        url: '/my/order/store',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            $('#checkoutModall').modal('hide');
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

        }
        });
    
});
</script>
