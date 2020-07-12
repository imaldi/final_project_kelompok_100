@extends('adminlte.master')
@section('content')
<div class="card ml-3">
    <div class="card-header">
      <h3>{{ $pertanyaan->judul }}</h3>
    </div>
    <div class="card-body">
        <div class="pl-1">
        <blockquote>
                <table>
                    <tr>
                        <td>
                            {{-- upvote --}}
                            <form action="{{ url("/pertanyaan/$pertanyaan->id/up") }}" method="post">
                                @csrf
                                {{-- <input type="submit" class="" value="UP"> --}}
                                <button type="submit" value="UP" class="btn btn-primary"><i class="fas fa-chevron-up"></i></button>
                            </form>
                            <span class="card-vote-count">{{ $jumlah }}</span>
                            {{-- downvote --}}
                            <form action="{{ url("/pertanyaan/$pertanyaan->id/down") }}" method="post">
                                @csrf
                                {{-- <input type="submit" class="" value="DOWN"> --}}
                                <button type="submit" value="DOWN" class="btn btn-primary"><i class="fas fa-chevron-down"></i></button>
                            </form>
                        </td>
                        <td>
                            @auth
                                @if (Auth::user()->id == $pertanyaan->user->id)
                                    <form action="{{ url("/pertanyaan/$pertanyaan->id") }}" method="post" class="ml-3">
                                        @csrf
                                        @method("DELETE")
                                        
                                            <p>{!! $pertanyaan->isi !!}</p>
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        
                                    </form>
                                @endif
                            @endauth
                        </td>
                    </tr>
                </table>
                
                <table>
                    <td>
                        {{-- input komentar pertanyaan --}}
                        <form action="{{ url("/pertanyaan_komentar/$pertanyaan->id") }}" method="POST">
                            @csrf
                            <input type="text" name="comment" placeholder="berikan komentar">
                            <input type="submit" class="btn btn-primary" value="post">
                        </form>
                    </td>
                </table>
                
                <table>
                    
                    <small>
                        <p>Tag:<p>
                            <tr>
                                @foreach ($pertanyaan->tags as $item)
                            <td>
                                {{$item->tag_name}}
                            </td>
                            @endforeach
                            <td>
                            @auth
                            @if (Auth::user()->id == $pertanyaan->user->id)
                            <a href="{{ url('/pertanyaan/'.$pertanyaan->id.'/edit')}}">
                                <button class="btn btn-warning"> <i class="fas fa-edit"></i> </button>
                            </a>
                            @endif
                            @endauth
                            </td>
                        </tr>
                    </small>
            
                    <small>
                <tr>
                    <p>Komentar<p>
                </tr>
                
                @foreach ($comments as $comment)
                @auth
                        <tr>
                            <td>
                            @if (Auth::user()->id == $comment->pertanyaan->user->id)
                                <a href="{{ url("/pertanyaan_komentar/$comment->id/edit") }}"> {{$comment->isi}} </a> 
                                
                                <form action="{{ url("/pertanyaan_komentar/$comment->id") }}" method="post">
                                    {{-- <input type="submit" value="hapus"> --}}
                                    <button class="btn btn-danger"> <i class="fas fa-trash"></i> </button>
                                    @csrf
                                    @method("DELETE")
                                </form>
                                
                                @else
                                {{$comment->isi}}
                                @endif
                                @endauth
                                @endforeach
                            </td>
                        </tr>
                    </table>
                        
            </small>
        </blockquote>
    </div>
        @foreach ($pertanyaan->jawabans as $item)
        <div class="pl-5">
        <blockquote class="quote-secondary ml-5">
            <table>
                <tr>
                    <td>
                        {{-- upvote --}}
                        <form action="{{ url("/jawaban/$pertanyaan->id/up") }}" method="post">
                            @csrf
                            {{-- <input type="submit" class="" value="UP"> --}}
                            <button type="submit" value="UP" class="btn btn-primary"><i class="fas fa-chevron-up"></i></button>
                            <input hidden name="id_pertanyaan" value="{{$pertanyaan->id}}" >
                        </form>
                        <span class="card-vote-count">{{ $jumlah }}</span>
                        {{-- downvote --}}
                        <form action="{{ url("/jawaban/$pertanyaan->id/down") }}" method="post">
                            @csrf
                            {{-- <input type="submit" class="" value="DOWN"> --}}
                            <button type="submit" value="UP" class="btn btn-primary"><i class="fas fa-chevron-up"></i></button>
                            <input hidden name="id_pertanyaan" value="{{$pertanyaan->id}}" >
                        </form>
                    </td>
                    <td>
                        {!!$item->isi!!} dijawab oleh {{ $item->user->name}} 
                            @auth
                                @if (Auth::user()->id == $item->user->id)
                                    <a href="{{ url("/pertanyaan/$pertanyaan->id/jawaban/$item->id/edit") }}">
                                        <button class="btn btn-warning"> Edit </button>
                                    </a>
                                    <form action="{{ url("/pertanyaan/$pertanyaan->id/jawaban/$item->id") }}" method="post">
                                        @method("DELETE")
                                        @csrf
                                        {{-- <input type="submit" value="Hapus" class="btn btn-danger"> --}}
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif    
                            @endauth
                        </td>
                    </tr>
                </table>
                <table>
                            <tr>
                                <td>
                            {{-- input komentar jawaban --}}
                            <form action="{{ url("/jawaban_komentar/$item->id") }}" method="POST">
                                @csrf
                                <input type="text" name="comment_jawaban" placeholder="berikan komentar">
                                <input type="submit" class="btn btn-primary" value="post">
                                <input hidden name="id_pertanyaan" value="{{$pertanyaan->id}}">
                            </form>
                                </td>
                            </tr>
                    <tr>
                        <td>
                        <small>
                            <p>Komentar<p>
                            
                            @foreach ($comments_jawaban as $comment)
                                
                                    @auth
                                        @if (Auth::user()->id == $comment->jawaban->user->id)
                                            <a href="{{ url("/jawaban_komentar/$comment->id/edit") }}">{{$comment->isi}}
                                            </a>
                                            <form action="{{ url("/jawaban_komentar/$comment->id") }}" method="post">
                                                {{-- <input type="submit" value="hapus"> --}}
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                @csrf
                                                @method("DELETE")
                                            </form>
                                        @else
                                            {{$comment->isi}}
                                        @endif
                                    @endauth      
                            @endforeach
                        </small>
                        </td>
                    </tr>
                </table>
                    
                </blockquote>
            </div>
            @endforeach
        <label for="">Beri jawaban</label>
        <form action="{{ url("/pertanyaan/{$pertanyaan->id}/jawaban") }}" method="post">
            <textarea class="form-control" id="summary-ckeditor" name="isi" id="" cols="30" rows="7"></textarea><br>
            @csrf
            <button type="submit" class="btn btn-success">Jawab</button>
        </form>
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