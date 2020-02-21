@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-9">
            @if($post)
                <div class="display-1 mb-5">{{ $post->post_title }}</div>
                
                {!! $post->post_content !!}
            @endif
        </div>
    </div>
@endsection
