@extends('adminlte.master')
@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Daftar Pertanyaan</h3>
    </div>
<a href="{{ url("/tag/create")}}" class="btn btn-primary">tambahkan tag</a>

<div class="card-body">
    <table class="table table-bordered">
    <thead>
        <th>No</th>
        <th>List Tag</th>
        <th>Edit Tag</th>
        <th>Hapus Tag</th>
    </thead>
    @foreach ($tags as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{$item->tag_name}}</td>
        <td><a href="{{ url("/tag/$item->id") }}" class="btn btn-warning">Edit</a> 
        <td>
            <form action="{{ url("/tag/$item->id") }}" method="post">
                <input type="submit" value="Hapus" class="btn btn-danger">
                @csrf
                @method("DELETE")
            </form>
        </td>
    </tr>
    @endforeach
    

@endsection