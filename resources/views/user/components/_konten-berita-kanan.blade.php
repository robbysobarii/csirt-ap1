@foreach($content as $index => $item)
    @if($content->count() > 5)
        @if($index < 6 && $index >= 2) <!-- Change condition to display only the first three items -->
            <div class="contentBerita" style="margin:auto; word-wrap: break-word;text-align: left; font-size: 13px">
                <img src="{{ asset('storage/' . $item->gambar) }}" alt="content" style="width: 100%; height: 120px; object-fit: cover; margin-bottom: 10px">
                <p style="color: #66B82E;font-style: italic;font-size: 13px;padding:0;margin:0">{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</p>
                <h6 style="text-align: justify;" class="pt-2">{{ \Illuminate\Support\Str::limit($item->judul, 30) }}</h6>
                <p style="text-align: justify;">{{ \Illuminate\Support\Str::limit($item->isi_konten, 120) }}</p>
                <div style="text-align: left">
                    <a href="{{ route('berita', ['id' => $item->id]) }}" class="selengkapKanan"><b>> Selengkapnya</b></a>
                </div>
            </div>
        @endif
    @else
        @if($index < 4 && $index >= 2) <!-- Change condition to display only the first three items -->
            <div class="contentBerita" style="margin:auto; word-wrap: break-word;text-align: left; font-size: 13px">
                <img src="{{ asset('storage/' . $item->gambar) }}" alt="content" style="width: 100%; height: 120px; object-fit: cover; margin-bottom: 10px">
                <p style="color: #66B82E;font-style: italic;font-size: 13px;padding:0;margin:0">{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</p>
                <h6 style="text-align: justify;" class="pt-2">{{ \Illuminate\Support\Str::limit($item->judul, 30) }}</h6>
                <p style="text-align: justify;">{{ \Illuminate\Support\Str::limit($item->isi_konten, 120) }}</p>
                <div style="text-align: left">
                    <a href="{{ route('berita', ['id' => $item->id]) }}" class="selengkapKanan"><b>> Selengkapnya</b></a>
                </div>
            </div>
        @endif
    @endif
@endforeach