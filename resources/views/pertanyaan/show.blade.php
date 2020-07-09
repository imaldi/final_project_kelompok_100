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

<ul>
    @foreach ($pertanyaan->jawabans as $item)
        <ol>{{$item->isi}} dijawab oleh {{ $item->user->name}} 
            <a href="{{ url("/pertanyaan/$pertanyaan->id/jawaban/$item->id/edit") }}">Edit</a>
            <form action="{{ url("/pertanyaan/$pertanyaan->id/jawaban/$item->id") }}" method="post">
                @method("DELETE")
                @csrf
                <input type="submit" value="Hapus">
            </form>
        </ol>
    @endforeach
    <li>
        <label for="">Beri jawaban</label>
        <form action="{{ url("/pertanyaan/{$pertanyaan->id}/jawaban") }}" method="post">
            <textarea name="isi" id="" cols="30" rows="10">
            </textarea><br>
            @csrf
            <button type="submit">Jawab</button>
        </form>
    </li>
</ul>