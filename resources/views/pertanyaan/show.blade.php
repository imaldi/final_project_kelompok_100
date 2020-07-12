@extends('adminlte.master')
@section('content')
<div class="card">
    <div class="card-header">
      <h3>{{ $pertanyaan->judul }}</h3>
    </div>
    <div class="card-body">
        
        <blockquote>
                    <div class="row">
                    <div class="card-vote pr-3">
                        {{-- upvote --}}
                        <form action="{{ url("/pertanyaan/$pertanyaan->id/up") }}" method="post">
                            @csrf
                            <input type="submit" class="" value="UP">
                        </form>
                        <span class="card-vote-count">{{ $jumlah }}</span>
                        {{-- downvote --}}
                        <form action="{{ url("/pertanyaan/$pertanyaan->id/down") }}" method="post">
                            @csrf
                            <input type="submit" class="" value="DOWN">
                        </form>
                        
                    </div>
                    @auth
                        @if (Auth::user()->id == $pertanyaan->user->id)
                            <form action="{{ url("/pertanyaan/$pertanyaan->id") }}" method="post">
                                @csrf
                                @method("DELETE")
                                <p>{!! $pertanyaan->isi !!}</p>
                                <button type="submit" class="btn btn-danger">Hapus</button>
                                </div>
                            </form>
                        @endif
                    @endauth
                    {{-- input komentar pertanyaan --}}
                    <form action="{{ url("/pertanyaan_komentar/$pertanyaan->id") }}" method="POST">
                        @csrf
                        <input type="text" name="comment" placeholder="berikan komentar">
                        <input type="submit" class="btn btn-primary" value="post">
                    </form>

            <small>
                <p>Tag:<p>
                <ul>
                @foreach ($pertanyaan->tags as $item)
                        <li>{{$item->tag_name}}</li>
                @endforeach
                </ul>
            </small>
            <small>
                <p>Komentar<p>
                <ul>
                @foreach ($comments as $comment)
                    @auth
                        @if (Auth::user()->id == $comment->pertanyaan->user->id)
                            <li> <a href="{{ url("/pertanyaan_komentar/$comment->id/edit") }}"> {{$comment->isi}} </a> 
                            <form action="{{ url("/pertanyaan_komentar/$comment->id") }}" method="post">
                                <input type="submit" value="hapus">
                                @csrf
                                @method("DELETE")
                            </form>
                            </li>
                        @else
                            <li>  {{$comment->isi}} </li>
                        @endif
                    @endauth
                @endforeach
                </ul>
            </small>
            @auth
                @if (Auth::user()->id == $pertanyaan->user->id)
                    <a href="{{ url("/tag/create") }}">
                        <button class="btn btn-warning"> Edit </button>
                    </a>
                @endif
            @endauth
        </blockquote>

        <ul>
            @foreach ($pertanyaan->jawabans as $item)
            <blockquote class="quote-secondary">
                <div class="row">
                    {{-- upvote --}}
                    <form action="{{ url("/jawaban/$pertanyaan->id/up") }}" method="post">
                        @csrf
                        <input type="submit" class="" value="UP">
                        <input hidden name="id_pertanyaan" value="{{$pertanyaan->id}}" >
                    </form>
                    <span class="card-vote-count">{{ $jumlah }}</span>
                    {{-- downvote --}}
                    <form action="{{ url("/jawaban/$pertanyaan->id/down") }}" method="post">
                        @csrf
                        <input type="submit" class="" value="DOWN">
                        <input hidden name="id_pertanyaan" value="{{$pertanyaan->id}}" >
                    </form>
                    
                <ol>{!!$item->isi!!} dijawab oleh {{ $item->user->name}} 
                    @auth
                        @if (Auth::user()->id == $item->user->id)
                            <a href="{{ url("/pertanyaan/$pertanyaan->id/jawaban/$item->id/edit") }}">
                                <button class="btn btn-warning"> Edit </button>
                            </a>
                            <form action="{{ url("/pertanyaan/$pertanyaan->id/jawaban/$item->id") }}" method="post">
                                @method("DELETE")
                                @csrf
                                <input type="submit" value="Hapus" class="btn btn-danger">
                            </form>
                        @endif    
                    @endauth
                    {{-- input komentar jawaban --}}
                    <form action="{{ url("/jawaban_komentar/$item->id") }}" method="POST">
                        @csrf
                        <input type="text" name="comment_jawaban" placeholder="berikan komentar">
                        <input type="submit" class="btn btn-primary" value="post">
                        <input hidden name="id_pertanyaan" value="{{$pertanyaan->id}}">
                    </form>
                </ol>
                <small>
                    <p>Komentar<p>
                    <ul>
                    @foreach ($comments_jawaban as $comment)
                        <li>
                            @auth
                                @if (Auth::user()->id == $comment->jawaban->user->id)
                                    <a href="{{ url("/jawaban_komentar/$comment->id/edit") }}">{{$comment->isi}}
                                    </a>
                                    <form action="{{ url("/jawaban_komentar/$comment->id") }}" method="post">
                                        <input type="submit" value="hapus">
                                        @csrf
                                        @method("DELETE")
                                    </form>
                                @else
                                    {{$comment->isi}}
                                @endif
                            @endauth    
                        
                        </li>
                    @endforeach
                    </ul>
                </small>
                </div>
            </blockquote>
            @endforeach
            <li>
                <label for="">Beri jawaban</label>
                <form action="{{ url("/pertanyaan/{$pertanyaan->id}/jawaban") }}" method="post">
                    <textarea class="form-control" id="summary-ckeditor" name="isi" id="" cols="30" rows="7"></textarea><br>
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
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'summary-ckeditor' );
    </script>
@endpush