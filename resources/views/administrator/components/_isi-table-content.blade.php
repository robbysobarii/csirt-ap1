@foreach ($contents as $content)
    <tr class="container-fluid">
        <th scope="row"><p>{{ $loop->iteration }}</p></th>
        <td style="word-wrap: break-word;"><b><p>{{ $content->judul }}</p></b></td>
        <td style="word-wrap: break-word;" ><p>{!! nl2br(e($content->isi_konten)) !!}</p></td>
        <td>
            <img src="{{ asset('storage/' . $content->gambar) }}" alt="Logo" class="img-fluid">
        </td>
        <td>{{ $content->type }}</td>
        <td>
            <a class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanEditModal({{ $content->id }})"><p>Edit</p></a>
            <form action="{{ route('contents.delete', ['id' => $content->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this content?')">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-sm btn-danger ButtonAksi"><p>Hapus</p></button>
            </form>
        </td>
    </tr>
@endforeach
