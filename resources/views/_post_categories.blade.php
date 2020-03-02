@if($categories=post_categories($post))
    @foreach($categories as $key=>$category)
        <a class="badge badge-dark" href="{{ route('blog.category',['category'=>$key]) }}" >{{$category}}</a>
    @endforeach
@endif