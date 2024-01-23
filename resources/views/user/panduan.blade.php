@extends('layout.userLayout')
@section('title', 'Layanan | Panduan Teknis')
@section('content')
<div class="container">
    <div class="breadcrumb breadTop" >
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Layanan</li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Panduan Teknis</a></li>
        </ol>
    </div>
    <h3>Panduan Teknis</h3>
    <hr>

    <div class="text-center" style="margin-top: 30px">
        <h4>Daftar Panduan</h4>
    </div>

    <table class="table" style="border-collapse: collapse; width: 100%; margin: auto;">
        <tbody>
            <tr>
                <td style="border-bottom: 1px solid #dee2e6;display: flex;justify-content: space-between;align-content: center">
                    <a href="{{ route('detailPanduan', ['filename' => 'panduan_malware.pdf', 'name' => 'Panduan Penanganan Insiden Malware']) }}" style="margin: 0;padding: 0"><p>Panduan Penanganan Insiden Malware</p></a>
                    <span id="file_size_panduan_malware" style="float: right;"><p>(PDF - Loading...)</p></span>
                </td>
            </tr>
            <tr>

                <td style="border-bottom: 1px solid #dee2e6;display: flex;justify-content: space-between;align-content: center">
                    <a href="{{ route('detailPanduan', ['filename' => 'panduan_ddos.pdf', 'name' => 'Panduan Penanganan Insiden Serangan DDoS']) }}" style="margin: 0;padding: 0"><p>Panduan Penanganan Insiden Serangan DDoS</p></a>
                    <span id="file_size_panduan_ddos" style="float: right;"><p>(PDF - Loading...)</p></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid #dee2e6;display: flex;justify-content: space-between;align-content: center">
                    <a href="{{ route('detailPanduan', ['filename' => 'panduan_phishing.pdf', 'name' => 'Panduan Penanganan Insiden Serangan Phishing']) }}" style="margin: 0;padding: 0"><p>Panduan Penanganan Insiden Serangan Phishing</p></a>
                    <span id="file_size_panduan_phising" style="float: right;"><p>(PDF - Loading...)</p></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid #dee2e6;display: flex;justify-content: space-between;align-content: center">
                    <a href="{{ route('detailPanduan', ['filename' => 'panduan_sql_injection.pdf', 'name' => 'Panduan Penanganan Insiden Serangan SQL Injection']) }}" style="margin: 0;padding: 0"><p>Panduan Penanganan Insiden Serangan SQL Injection</p></a>
                    <span id="file_size_panduan_injection" style="float: right;"><p>(PDF - Loading...)</p></span>
                </td>
            </tr>
            <tr>
                <td style="display: flex;justify-content: space-between;align-content: center">
                    <a href="{{ route('detailPanduan', ['filename' => 'panduan_web_defacement.pdf', 'name' => 'Panduan Penanganan Insiden Web Defacement']) }}" style="margin: 0;padding: 0"><p>Panduan Penanganan Insiden Web Defacement</p></a>
                    <span id="file_size_panduan_defacement" style="float: right;"><p>(PDF - Loading...)</p></span>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@endsection
<!-- Tambahkan ini pada akhir konten Anda -->
@push('scripts')
<script>
    // Fungsi untuk mengambil ukuran file dan menambahkannya ke elemen span
    function getFileSize(url, spanId) {
        var xhr = new XMLHttpRequest();
        xhr.open('HEAD', url, true);
        xhr.onreadystatechange = function () {
            if (this.readyState === this.DONE) {
                if (this.status === 200) {
                    var fileSize = this.getResponseHeader("Content-Length");
                    document.getElementById(spanId).innerText = `${formatBytes(fileSize)}`;
                } else {
                    document.getElementById(spanId).innerText = `(PDF - Not Found)`;
                }
            }
        };
        xhr.send();
    }

    // Fungsi untuk mengubah ukuran file menjadi format yang lebih mudah dibaca
    function formatBytes(bytes, decimals = 2) {
        if (bytes === 0) return '0 Bytes';

        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

        const i = Math.floor(Math.log(bytes) / Math.log(k));

        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

    // Panggil fungsi untuk setiap tautan panduan
    getFileSize("{{ asset('file/panduan_malware.pdf') }}", "file_size_panduan_malware");
    getFileSize("{{ asset('file/panduan_ddos.pdf') }}", "file_size_panduan_ddos");
    getFileSize("{{ asset('file/panduan_phishing.pdf') }}", "file_size_panduan_phising");
    getFileSize("{{ asset('file/panduan_sql_injection.pdf') }}", "file_size_panduan_injection");
    getFileSize("{{ asset('file/panduan_web_defacement.pdf') }}", "file_size_panduan_defacement");

</script>
@endpush
