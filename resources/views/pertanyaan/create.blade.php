@extends('adminlte.master')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Quick Example</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action={{ url('/pertanyaan')}} method="POST" role="form">
        <div class="card-body">
            <div class="form-group">
                @csrf
                <label for="">Judul Pertanyaan</label>
                <input class="form-control" type="text" name="judul">
                <label for="">Pertanyaan Baru</label>
                <textarea class="form-control" name="isi" id="" cols="30" rows="10"></textarea>
                <input hidden name="tanggal_dibuat" value="{{ \Carbon\Carbon::now() }}">
                <input hidden name="tanggal_diperbarui" value="{{ \Carbon\Carbon::now() }}">
                <br>
                <button class="btn btn-primary" type="submit"> Create </button>
            </div>
        </div>
    </form>
@endsection