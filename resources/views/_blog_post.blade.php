{{-- @dump($post) --}}
@php
    $importance=post_importance($post);
    $imagesrc=post_thumbnail_url($post, ($importance=='normal')?'square-medium':'size-'.$importance );
@endphp

<div class="post grid-item size-{{ $importance?$importance:'normal' }}" >
    <div class="post-inner">
        @if($imagesrc)
            <a href="{{ route('blog.post',['post_slug'=>$post->slug]) }}">
                <figure class="mb-0">
                    <img src ="{{ $imagesrc }}" class="card-img-top"/>
                </figure>
            </a>

        @endif

        <div class="p-3">
            
            {{ post_date($post) }}
            <h5><a href="{{ route('blog.post',['post_slug'=>$post->slug]) }}">{{ $post->post_title }}</a></h5>
            @include('_post_categories')
            
        </div>
    </div>

</div>