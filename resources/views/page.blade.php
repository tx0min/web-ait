@extends('layouts.master')

@section('footer')
    @include('layouts._footer')
@endsection


@section('content')
<div class="page-content single-post">
    <div class="row mb-5">
        <div class="col-md-7">
            <div class="anim from-bottom in">
                <h1 class="post-title display-1 ">{{ $page->post_title }}</h1>
            </div>
            <div class="post-body anim from-bottom delay-1 in">
                {!! $page->post_content !!}
            </div>
        </div>
    </div>
</div>
@endsection
