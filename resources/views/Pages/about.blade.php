@extends('layout.app')

@section('body')
    <h1>{{$title}}</h1>
    @if (count($services) > 0)
        <ul>
            @foreach ($services as $item)
                <li>{{$item}}</li>
            @endforeach
        </ul>             
    @endif
@endsection