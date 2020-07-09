<form action="{{ url("/pertanyaan") }}" method="post">
    <label for="">Judul</label>
    <input type="text" name="judul" id="" placeholder="judul">
    <br>
    <label for="">Isi</label>
    <textarea name="isi" id="" cols="30" rows="10"> </textarea>
    <br>
    @foreach ($tag as $item)
        <input type="checkbox" name="tag[]" id="" value="{{$item->id}}">  {{$item->tag_name}}
    @endforeach
    <button type="submit">Tambah</button>
    @csrf
</form>