<form action="{{ url("/pertanyaan") }}" method="post">
    <label for="">Judul</label>
    <input type="text" name="judul" id="" placeholder="judul">
    <br>
    <label for="">Isi</label>
    <textarea name="isi" id="" cols="30" rows="10"> </textarea>
    <br>
    <select name="tag" id="" multiple>
        @foreach ($tag as $item)
            <option value="{{$item->tag_name}}">{{$item->tag_name}}</option>
        @endforeach
    </select>
    <button type="submit">Tambah</button>
    @csrf
</form>