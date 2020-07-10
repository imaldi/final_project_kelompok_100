@extends('adminlte.master')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Quick Example</h3>
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
                <textarea class="form-control" name="isi" id="" cols="30" rows="10">{{ $pertanyaan->isi}}</textarea>

                <input hidden type="text" name="tanggal_dibuat" value="{{ $pertanyaan->tanggal_dibuat }}"><br>
                
                <input hidden type="text" name="tanggal_diperbarui" value="{{ \Carbon\Carbon::now() }}"><br>

                <button class="btn btn-primary">Update Pertanyaan</button>
            </div>
        </div>
    </form>
@endsection
{{-- <form action="{{ url("/pertanyaan/$pertanyaan->id") }}" method="post">
    <label for="">Judul</label>
    <input type="text" name="judul" id="" placeholder="judul" value="{{ $pertanyaan->judul }}">
    <br>
    <label for="">Isi</label>
    <textarea name="isi" id="" cols="30" rows="10"> {{$pertanyaan->isi }} </textarea>
    <br>
    

    @foreach ($tag as $item)
        <input type="checkbox"
        @foreach ($pertanyaan->tags as $mytag)
            @if ($mytag->id == $item->id)
                checked    
            @endif
        @endforeach
        name="tag[]" id="" value="{{$item->id}}">  {{$item->tag_name}}
    @endforeach
    
    <button type="submit">Tambah</button>
    @csrf
    @method("PUT")
</form> --}}