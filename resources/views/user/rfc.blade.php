@extends('layout.userLayout')
@section('title', 'RFC 2350')
@section('content')

<div class="container" style="padding-top: 120px; ">
    <h3>RFC 2350</h3>
    <div id="pdf-container"></div>

</div>
@endsection
@push('scripts')
<script src="{{ asset('node_modules/pdfjs-dist/build/pdf.min.js') }}"></script>

<script>
    // Fetch the PDF file
    const pdfPath = "{{ route('rfc.pdf', ['filename' => 'rfc.pdf']) }}";
    const loadingTask = pdfjsLib.getDocument(pdfPath);

    loadingTask.promise.then(function(pdf) {
        // Display the first page
        pdf.getPage(1).then(function(page) {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            const viewport = page.getViewport({ scale: 1.5 });

            canvas.height = viewport.height;
            canvas.width = viewport.width;

            const renderContext = {
                canvasContext: context,
                viewport: viewport
            };

            page.render(renderContext).promise.then(function() {
                document.getElementById('pdf-container').appendChild(canvas);
            });
        });
    });
</script>
    
@endpush