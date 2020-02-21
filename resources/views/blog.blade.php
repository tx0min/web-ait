@extends('layouts.master')

@section('content')


            @if($posts)
                @foreach($posts as $post)
                    <div class="">
                        {{-- @dump($user) --}}
                        <a href="{{ route('blog',['post_slug'=>$post->slug]) }}">{{ $post->post_title }}</a>
                    </div>
                @endforeach
            @endif
        
@endsection
