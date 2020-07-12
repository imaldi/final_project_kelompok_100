<form action="{{ url("/pertanyaan_komentar/$comment->id") }}" method="post">

    <input type="text" name="comment" id="" value="{{ $comment->isi }}">
    @csrf
    @method("PUT")
    <input type="submit" value="Edit komentar">
</form>