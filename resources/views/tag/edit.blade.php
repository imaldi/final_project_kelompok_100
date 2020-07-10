@extends('adminlte.master')
@section('content')
<div class="card">
    <div class="card-header">
      <h3>Edit Tag</h3>
    </div>
    <div class="card-body">
        <form action="{{ url("/tag/{$tag->id}") }}" method="post">
            <input type="text" name="tag" value="{{ $tag->id }}">
            <button type="submit" class="btn btn-success">Edit</button>
            @csrf
            @method("PUT")
        </form>
    </div>
@extends('adminlte.master')
@section('content')