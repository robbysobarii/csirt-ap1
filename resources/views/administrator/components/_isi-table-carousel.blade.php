@foreach ($carousels as $carousel)
    <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $carousel->heading_caption }}</td>
        <td>{{ $carousel->caption }}</td>
        <td><img src="{{ asset('storage/' .$carousel->image_path) }}" alt="Carousel Image" class="img-fluid"></td>
        <td>
            <button class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanModal('update', {{ $carousel->id }})">Edit</button>
            <form action="{{ route('carousel.delete', ['id' => $carousel->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this content?')">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-sm btn-danger ButtonAksi">Hapus</button>
            </form>
        </td>
    </tr>
@endforeach