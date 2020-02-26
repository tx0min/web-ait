@extends('layouts.master')

@section('class','home-page')


@section('content')

<div class="owl-carousel" id="home-slider" data-single="{{$behaviour=="random"}}">
    @foreach($slides as $slide)
        <div class="home-slide" data-color="{{$slide["color"]}}" data-bg-color="{{$slide["bgcolor"] }}" >
            {{-- @dump($slide) --}}
            <div class="image" style="background-image:url({{$slide["image"]->url}})" ></div>
            <div class="gradient"  ></div>
            <a class="author-name" href="{{ route('socis',['soci_slug'=>$slide["author"]->slug]) }}">{{ $slide["author"]->display_name }}</a>
            <h1 class="page-title ">Associació d’Il·lustradores de Tarragona </h1>

        </div>

    @endforeach
</div>

@endsection
