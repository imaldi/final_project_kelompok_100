@extends('adminlte.master')
@section('content')
<div class="card card-primary ml-3">
    <div class="card-header">
      <h3 class="card-title">Buat Pertanyaan Baru </h3>
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
                <textarea class="form-control" id="summary-ckeditor" name="isi" cols="30" rows="10"></textarea>
                <label for="">Tags</label>
                <input class="form-control" type="text" name="tag">
                <input hidden name="tanggal_dibuat" value="{{ \Carbon\Carbon::now() }}">
                <input hidden name="tanggal_diperbarui" value="{{ \Carbon\Carbon::now() }}">
                <br>
                <button class="btn btn-primary" type="submit"> Create </button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'summary-ckeditor' );
    </script>
@endpush