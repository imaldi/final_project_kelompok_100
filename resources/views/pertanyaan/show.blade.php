@extends('adminlte.master')
@section('content')
<div class="card">
    <div class="card-header">
      <h3>{{ $pertanyaan->judul }}</h3>
    </div>
    <div class="card-body">
        <blockquote>
            
            <form action="{{ url("/pertanyaan/$pertanyaan->id") }}" method="post">
                @csrf
                @method("DELETE")
                {{ $pertanyaan->isi }}
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>

            <small>
                <p>Tag:<p>
                @foreach ($pertanyaan->tags as $item)
                    <p>{{$item->tag_name}}</p>
                @endforeach
            </small>
            <a href="{{ url("/pertanyaan/$pertanyaan->id/edit") }}">
                <button class="btn btn-warning"> Edit </button>
            </a>
        </blockquote>

        
        <ul>
            @foreach ($pertanyaan->jawabans as $item)
            <blockquote class="quote-secondary">
                <ol>{{$item->isi}} dijawab oleh {{ $item->user->name}} 
                    <a href="{{ url("/pertanyaan/$pertanyaan->id/jawaban/$item->id/edit") }}">
                        <button class="btn btn-warning"> Edit </button>
                    </a>
                    <form action="{{ url("/pertanyaan/$pertanyaan->id/jawaban/$item->id") }}" method="post">
                        @method("DELETE")
                        @csrf
                        <input type="submit" value="Hapus" class="btn btn-danger">
                    </form>
                </ol>
            </blockquote>
            @endforeach
            <li>
                <label for="">Beri jawaban</label>
                <form action="{{ url("/pertanyaan/{$pertanyaan->id}/jawaban") }}" method="post">
                    <textarea class="form-control" name="isi" id="" cols="30" rows="10"></textarea><br>
                    @csrf
                    <button type="submit" class="btn btn-success">Jawab</button>
                </form>
            </li>
        </ul>
    </div>
</div>
@endsection