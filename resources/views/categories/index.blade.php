@extends('welcome')

@section('content')
        @foreach($points as $point)
        {{var_dump($point)}}
        @endforeach
@endsection