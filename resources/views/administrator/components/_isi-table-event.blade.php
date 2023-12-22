@foreach ($events as $event)
<tr>
    <th scope="row">{{ $loop->iteration }}</th>
    <td>{{ $event->name }}</td>
    <td>{{ $event->description }}</td>
    <td>{{ $event->start_date }}</td>
    <td>{{ $event->end_date }}</td>
    <td>{{ $event->location }}</td>
    <td>
        <button class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanModal('update', {{ $event->id  }})">Edit</button>
        <form action="{{ route('events.delete', ['id' => $event->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this event?')">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-sm btn-danger ButtonAksi">Hapus</button>
        </form>
    </td>
</tr>
@endforeach