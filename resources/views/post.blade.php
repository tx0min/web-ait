@extends('layouts.master')

@section('footer')
    @include('layouts._footer')
@endsection


@section('content')
    @if($post)
        <div class="single-post page-content">
            <div class="row mb-5">
                <div class="col-md-7">
                    <div class="display-1 post-title ">{{ $post->post_title }}</div>
                    <div class="post-meta">
                        <div class="post-date">{{ post_date($post) }}</div>
                        <div class="post-categories">@include('_post_categories')</div>
                    </div>

                </div>
            </div>


            {{-- @if($imagesrc = post_thumbnail_url($post,'size-featured'))
                <div class="alignfull featured-image" style="height:250px;background-image:url({{ $imagesrc }})">

                </div>
            @endif --}}

            <div class="row post-body">
                <div class="col-md-7">
                    {!! $post->post_content !!}
                </div>
            </div>
        </div>
    @endif
@endsection
