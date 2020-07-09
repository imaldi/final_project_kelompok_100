<form action="{{ url("/tag/{$tag->id}") }}" method="post">
    <input type="text" name="tag" value="{{ $tag->id }}">
    <button type="submit">Edit</button>
    @csrf
    @method("PUT")
</form>