@extends('layouts.master')

@section('class','home-page')


@section('content')

<div class="owl-carousel" id="home-slider" data-single="{{$behaviour=="random"}}">
    @foreach($slides as $slide)
        @if($slide["image"] && $slide["image"]->url)

            <div class="home-slide" data-color="{{$slide["color"]}}" data-bg-color="{{$slide["bgcolor"] }}" >
                {{-- @dump($slide) --}}
                <div class="image" style="background-image:url({{$slide["image"]->url}})" ></div>
                <div class="gradient" style="opacity:{{ $slide["grad_opac"] }}" ></div>
                @if($author = $slide["author"])

                    <a class="author-name" href="{{ route('socis.soci',['soci_slug'=>$author->slug]) }}">{{ user_display_name($author) }}</a>
                @endif

                <div class="page-content">
                    <h1 class="page-title ">
                        @if($slide["content"])
                            {!! nl2br($slide["content"]) !!}
                        @else
                            {!! $page->post_content !!}
                        @endif
                    </h1>
                </div>

            </div>
        @endif

    @endforeach
</div>

@endsection
