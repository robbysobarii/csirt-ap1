@extends('layout.userLayout')
@section('title', 'RFC 2350')
@section('content')

<div class="container" style="padding-top: 120px; ">
    <h3>RFC 2350</h3>
    <iframe src="{{ route('rfc.pdf', ['filename' => 'rfc.pdf']) }}" width="100%" height="1000px" scrolling="yes" frameborder="0"></iframe>

</div>
@endsection
@push('scripts')
<script>
    document.addEventListener('dragstart', function (e) {
        e.preventDefault();
    });
    document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    });
</script>

@endpush