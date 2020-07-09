@extends('adminlte.master')

@section('content')
    <h1> Daftar pertanyaan </h1>
    <a class="mb-5" href="{{ url("/pertanyaan/create")}}">Buat pertanyaan</a>

    
        @foreach ($pertanyaan as $item)
        <div>
            <a href="{{ url("/pertanyaan/{$item->id}") }}">{{$item->judul}}</a>
        </div>
        @endforeach
    

@endsection