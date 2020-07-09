@extends('adminlte.master')

@section('content')
    <a href="{{ url("/tag") }}">Daftar tag</a>
    <h1> Daftar pertanyaan </h1>
    <a class="mb-5" href="{{ url("/pertanyaan/create")}}">Buat pertanyaan</a>

    
        @foreach ($pertanyaan as $item)
        <div>
            <a href="{{ url("/pertanyaan/{$item->id}") }}">{{$item->judul}}</a>
        </div>
        @endforeach
    

@endsection