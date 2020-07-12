@extends('adminlte.master')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Edit Pertanyaan</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action={{ url('/pertanyaan/'.$id)}} method="POST" role="form">
        <div class="card-body">
            <div class="form-group">
                {{ method_field('put')}}
                @csrf
                <input hidden name="id" value="{{ $id }}">
                <label>Judul</label>
                <input class="form-control" type="text" name="judul" value="{{ $pertanyaan->judul }}"><br>

                <label>Isi</label>
                <textarea class="form-control" id="summary-ckeditor" name="isi" cols="30" rows="10">{!! $pertanyaan->isi !!}</textarea>

                @php
                    $tags = [];
                    foreach ($pertanyaan->tags as $value) {
                        array_push($tags, $value->tag_name);
                    }
                    $tags = implode(",",$tags);
                @endphp
                <label for="">Tags</label>
                <input class="form-control" type="text" name="tag" value="{{ $tags }}">

                <input hidden type="text" name="tanggal_dibuat" value="{{ $pertanyaan->tanggal_dibuat }}"><br>
                
                <input hidden type="text" name="tanggal_diperbarui" value="{{ \Carbon\Carbon::now() }}"><br>

                <button class="btn btn-primary">Update Pertanyaan</button>
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