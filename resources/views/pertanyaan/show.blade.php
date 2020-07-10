@extends('adminlte.master')
@section('content')
<div class="card">
    <div class="card-header">
      <h3>{{ $pertanyaan->judul }}</h3>
    </div>
    <div class="card-body">
        
        <blockquote>
            <form action="{{ url("/pertanyaan/$pertanyaan->id") }}" method="post">
                <div class="row">
                <div class="card-vote pr-3">
                    <div class="card-vote-up"></div>
                    <span class="card-vote-count">0</span>
                    <div class="card-vote-down"></div>
                    <div class="card-vote-star"></div>
                </div>
                @csrf
                @method("DELETE")
                <p>{!! $pertanyaan->isi !!}</p>
                <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>

            <small>
                <p>Tag:<p>
                <ul>
                @foreach ($pertanyaan->tags as $item)
                    <li>{{$item->tag_name}}</li>
                @endforeach
                </ul>
            </small>
            <a href="{{ url("/tag/create") }}">
                <button class="btn btn-warning"> Edit </button>
            </a>
        </blockquote>

        
        <ul>
            @foreach ($pertanyaan->jawabans as $item)
            <blockquote class="quote-secondary">
                <div class="row">
                    <div class="card-vote">
                        <div class="card-vote-up"></div>
                        <span class="card-vote-count">0</span>
                        <div class="card-vote-down"></div>
                        <div class="card-vote-star"></div>
                    </div>
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
                </div>
            </blockquote>
            @endforeach
            <li>
                <label for="">Beri jawaban</label>
                <form action="{{ url("/pertanyaan/{$pertanyaan->id}/jawaban") }}" method="post">
                    <textarea class="form-control" name="isi" id="" cols="30" rows="7"></textarea><br>
                    @csrf
                    <button type="submit" class="btn btn-success">Jawab</button>
                </form>
            </li>
        </ul>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        Upvote.create('id');
    </script>
@endpush