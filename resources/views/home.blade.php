@extends('layouts.master')

@section('class','home-page')
@section('style','--text-color: '. $slide->color .'; --bg-color: '. $slide->bgcolor )

@section('content')
{{-- animation: kenburns 20s infinite; --}}
<div class="home-slide" >
    {{-- @dump($slide) --}}
    <div class="image" style="background-image:url({{$slide->image->url}})" >
    </div>
    <div class="gradient"  ></div>
    <a class="author-name" href="{{ route('socis',['soci_slug'=>$slide->author->slug]) }}">{{ $slide->author->display_name }}</a>
</div>
@endsection
