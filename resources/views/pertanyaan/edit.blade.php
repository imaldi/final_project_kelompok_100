<form action="{{ url("/pertanyaan/$pertanyaan->id") }}" method="post">
    <label for="">Judul</label>
    <input type="text" name="judul" id="" placeholder="judul" value="{{ $pertanyaan->judul }}">
    <br>
    <label for="">Isi</label>
    <textarea name="isi" id="" cols="30" rows="10"> {{$pertanyaan->isi }} </textarea>
    <br>
    

    @foreach ($tag as $item)
        <input type="checkbox"
        @foreach ($pertanyaan->tags as $mytag)
            @if ($mytag->id == $item->id)
                checked    
            @endif
        @endforeach
        name="tag[]" id="" value="{{$item->id}}">  {{$item->tag_name}}
    @endforeach
    
    <button type="submit">Tambah</button>
    @csrf
    @method("PUT")
</form>