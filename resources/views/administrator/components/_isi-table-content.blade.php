@foreach ($contents as $content)
    <tr style="max-width: 100%">
        <th scope="row">{{ $loop->iteration }}</th>
        <td style="word-wrap: break-word;"><b>{{ $content->judul }}</b></td>
        <td style="word-wrap: break-word; max-width:600px ;">{!! nl2br(e($content->isi_konten)) !!}</td>
        <td>
            <img src="{{ asset('storage/' . $content->gambar) }}" alt="Logo" class="img-fluid">
        </td>
        <td>{{ $content->type }}</td>
        <td>
            <a class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanEditModal({{ $content->id }})">Edit</a>
            <form action="{{ route('contents.delete', ['id' => $content->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this content?')">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-sm btn-danger ButtonAksi">Hapus</button>
            </form>
        </td>
    </tr>
@endforeach
