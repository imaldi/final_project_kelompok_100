@extends('adminlte.master')
@section('content')
<div class="card">
    <div class="card-header">
      <h3>Buat Tag Baru</h3>
    </div>
    <div class="card-body">
        <form action="{{ url("/tag") }}" method="post">
            <input type="text" name="tag_name">
            <button type="submit" class="btn btn-success">Tambah</button>
            @csrf
        </form>
    </div>
</div>
@endsection