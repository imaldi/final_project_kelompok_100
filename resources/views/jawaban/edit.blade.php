@extends('adminlte.master')
@section('content')
<form action="{{ url("/pertanyaan/".$jawaban->pertanyaan->id."/jawaban/$jawaban->id") }}" method="post">

    <textarea name="isi" id="" cols="30" rows="10">{{ $jawaban->isi }}</textarea>
    @method("PUT")
    @csrf
    <button type="submit">Edit</button>
</form>
@endsection