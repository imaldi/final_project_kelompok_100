<h1>{{ $pertanyaan->judul }}</h1>

<p>{{ $pertanyaan->isi }}</p>

Tag:
@foreach ($pertanyaan->tags as $item)
    <p>{{$item->tag_name}}</p>
@endforeach

<a href="{{ url("/pertanyaan/$pertanyaan->id/edit") }}">Edit</a>

<form action="{{ url("/pertanyaan/$pertanyaan->id") }}" method="post">
    @csrf
    @method("DELETE")
    <button type="submit">Hapus</button>
</form>