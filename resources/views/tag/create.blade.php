<form action="{{ url("/tag") }}" method="post">
    <input type="text" name="tag_name">
    <button type="submit">Tambah</button>
    @csrf
</form>