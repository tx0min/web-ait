@extends('layouts.master')

@section('footer')
    @include('layouts._footer')
@endsection


@section('content')
    @if($post)
        <div class="single-post page-content">
            <div class="row mb-5">
                <div class="col-md-9">
                    <div class="display-1 ">{{ $post->post_title }}</div>
                    {{ post_date($post) }}
                    @include('_post_categories')
            
                </div>
            </div>
        

            {{-- @if($imagesrc = post_thumbnail_url($post,'size-featured'))
                <div class="alignfull featured-image" style="height:250px;background-image:url({{ $imagesrc }})">

                </div>
            @endif --}}

            <div class="row">
                <div class="col-md-9">
                    {!! $post->post_content !!}
                </div>
            </div>
        </div>
    @endif
@endsection
