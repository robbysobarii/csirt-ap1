@extends('layout.userLayout')
@section('title', 'Event Kami')
@section('content')

<div class="container" style="padding-top: 120px">
    <h3>Event Siber</h3>
    <hr style="margin-bottom: 30px">

    <table class="table" style="border-collapse: collapse; width: 100%; margin: auto;">
        <thead>
            <tr>
                <th>Acara</th>
                <th>Deskripsi</th>
                <th>Tanggal Awal</th>
                <th>Tanggal Akhir</th>
                <th>Tempat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
            <tr>
                <td>{{ $event->name }}</td>
                <td>{{ $event->description }}</td>
                <td>{{ $event->start_date }}</td>
                <td>{{ $event->end_date }}</td>
                <td>{{ $event->location }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
