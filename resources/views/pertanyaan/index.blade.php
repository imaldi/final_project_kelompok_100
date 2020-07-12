@extends('adminlte.master')
@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Daftar Pertanyaan</h3>
    </div>
        <a href="{{ url('/pertanyaan/create')}}" class="pt-2 pl-5">
            <button class="btn btn-primary"> Create New Question </button>
        </a>
        <br>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
            <thead>
                <th>No</th>
                <th>List Pertanyaan</th>
                <th>Edit Pertanyaan</th>
                <th>Detail QnA</th>
            </thead>
            <tbody>
                @foreach ($pertanyaans as $pertanyaan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{!! $pertanyaan->isi !!}</td>
                    <td>

                        @auth
                            @if (Auth::user()->id == $pertanyaan->user->id)
                                <a href="{{ url('/pertanyaan/'.$pertanyaan->id.'/edit')}}">
                                    <button class="btn btn-warning"> Edit Pertanyaan </button>
                                </a>
                            @endif
                        @endauth
                    </td>
                    <td>
                    <a href="{{url('/pertanyaan/'.$pertanyaan->id)}}">
                            <button class="btn btn-primary"> Lihat Detail QnA </button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
@endsection
{{-- @extends('adminlte.master')

@section('content')
    <a href="{{ url("/tag") }}">Daftar tag</a>
    <h1> Daftar pertanyaan </h1>
    <a class="mb-5" href="{{ url("/pertanyaan/create")}}">Buat pertanyaan</a>

    
        @foreach ($pertanyaan as $item)
        <div>
            <a href="{{ url("/pertanyaan/{$item->id}") }}">{{$item->judul}}</a>
        </div>
        @endforeach
    

@endsection --}}