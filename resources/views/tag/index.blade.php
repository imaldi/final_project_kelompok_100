<a href="{{ url("/tag/create")}}">tambahkan tag</a>

<ul>
    @foreach ($tags as $item)
    <li>    {{$item->tag_name}} || 
        <a href="{{ url("/tag/$item->id") }}">Edit</a> 
        <form action="{{ url("/tag/$item->id") }}" method="post">
            <input type="submit" value="Hapus">
            @csrf
            @method("DELETE")
        </form>
    </li> 
    @endforeach
    
</ul>