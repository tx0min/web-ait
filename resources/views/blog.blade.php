@extends('layouts.master')

@section('content')

    <form method="post" action="{{ route('blog.search') }}" id="blog-form">
        @csrf
        <div class="row ">
            <div class="col-lg-8 col-md-6 mb-3">
                <div class="search-field">
                    <input type="text" class="form-control " placeholder="Buscar ..." id="term" name="term" value="{{ $term }}" >
                </div>
                
            </div>
            <div class="col-lg-4 col-md-6 mb-3">
                <select class="selectpicker form-submitter" id="selector-category" name="category" title="Categories...">
                    <option value="0">Qualsevol</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" {{ $category==$cat->slug?"selected":"" }} >{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" hidden></button>
        
    </form>
    @if($posts && !$posts->isEmpty())
    
        <div class="infinite-scroll">

            <div class="blog grid">
                <div class="grid-sizer"></div>
                
                @foreach($posts as $post)
                    @include('_blog_post')
                @endforeach
                
                
            </div>        
            {!! $posts->links() !!}
    </div>

    @else
        <div class="display-4 p-5 text-center">
            Oops! no hi ha entrades&hellip;
        </div>
    @endif

@endsection
