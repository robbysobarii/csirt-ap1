@foreach ($galleries as $gallery)
    <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $gallery->judul }}</td>
        <td>{{ $gallery->caption }}</td>
        <td><img src="{{ asset('storage/' . $gallery->gambar) }}" alt="Gambar" class="img-fluid"></td>
        <td>
            <button class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanModal('update', {{ $gallery->id }})">Edit</button>
            <form action="{{ route('gallery.delete', ['id' => $gallery->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this content?')">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-sm btn-danger ButtonAksi">Hapus</button>
            </form>
        </td>
    </tr>
@endforeach