<!--ayo pakai layout yg sudah dibuat-->
@extends('layout')

@section('content')
    <!--MATERI LARAVEL ELOQUENT - Model-->
    <h2>{{$listing['title']}}</h2>
    <p>{{$listing['description']}}</p>

    <a href="/home">Back to see all listings</a>
@endsection