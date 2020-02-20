@extends('layouts.master')

@section('class','home-page')

@section('content')
{{-- animation: kenburns 20s infinite; --}}
<div class="home-slide" data-color="{{ $slide->color }}">
    {{-- @dump($slide) --}}
    <div class="image" style="background-image:url({{$slide->image->url}})" ></div>
    <a class="author-name" href="{{ route('socis',['soci_slug'=>$slide->author->slug]) }}">{{ $slide->author->display_name }}</a>
</div>
@endsection
