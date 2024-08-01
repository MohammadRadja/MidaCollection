<div class="row">
    <div class="col-md-4">
        <img src="{{ asset('images/' . ($product->image ?? 'no-image.jpg')) }}" alt="" width="100%">
    </div>
    <div class="col-md-8">
        <table class="table table-striped">
            <tr>
                <th scope="row">Name</th>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <th scope="row">Price</th>
                <td>{{ $data->price }}</td>
            </tr>
            <tr>
                <th scope="row">Stock</th>
                <td>{{ $data->stock }}</td>
            </tr>
            <tr>
                <th scope="row">Category</th>
                <td>{{ $data->category }}</td>
            </tr>
            <tr>
                <th scope="row">Size</th>
                <td>{{ $data->size }}</td>
            </tr>
        </table>
    </div>
</div>
