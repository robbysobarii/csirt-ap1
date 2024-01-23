@extends('layout.userLayout')
@section('title', 'Event Kami')
@section('content')

<div class="container" style="padding-top: 120px">
    <h3>Event Siber</h3>
    <hr style="margin-bottom: 30px">

    <table class="table" style="border-collapse: collapse; width: 100%; margin: auto;">
        <thead>
            <tr>
                <th><h5>Acara</h5></th>
                <th><h5>Deskripsi</h5></th>
                <th><h5>Tanggal Awal</h5></th>
                <th><h5>Tanggal Akhir</h5></th>
                <th><h5>Tempat</h5></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
            <tr>
                <td><p>{{ $event->name }}</p></td>
                <td><p>{{ $event->description }}</p></td>
                <td><p>{{ $event->start_date }}</p></td>
                <td><p>{{ $event->end_date }}</p></td>
                <td><p>{{ $event->location }}</p></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
