@php $no = 1; @endphp
@foreach ($data as $product)
    <tr>
        <td scope="col">{{ $no++ }}</td>
        <td scope="col">
            @php
                // Menghasilkan path gambar
                $imageName = trim($product->image ?? 'no-image.jpg', '"\''); // Menghapus tanda kutip dari nama gambar
                $imagePath = asset('images/' . $imageName); // Mendapatkan path gambar
            @endphp
            <img src="{{ $imagePath }}" alt="Product Image" width="50px" height="50px" class="img-thumbnail">
        </td>
        <td scope="col" style="white-space: nowrap;">{{ $product->name }}</td>
        <td scope="col" style="white-space: nowrap;">
            <sub>Rp. </sub>{{ number_format($product->price, 0, ',', '.') }}
        </td>
        <td scope="col">{{ $product->stock }}</td>
        <td scope="col" style="white-space: nowrap;">{{ $product->size }}</td>
        <td scope="col" style="white-space: nowrap;">
            <div class="btn-group" role="group">
                <button type="button" onclick="detail({{ $product->id }})" class="btn btn-success btn-detail">
                    <i class="fa-regular fa-eye"></i>
                </button>
                <button type="button" onclick="edit({{ $product->id }})" class="btn btn-warning btn-edit mx-1">
                    <i class="fa-regular fa-pen-to-square"></i>
                </button>
                <button type="button" onclick="destroy({{ $product->id }})" class="btn btn-danger btn-delete">
                    <i class="fa-regular fa-trash-can"></i>
                </button>
            </div>
        </td>
    </tr>
@endforeach
