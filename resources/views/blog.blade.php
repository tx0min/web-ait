@extends('layouts.master')

@section('content')

    <form method="post" action="{{ route('blog.search') }}" id="blog-form" class="grid-form">
        @csrf
        <div class="row ">
            <div class="col-lg-8 col-6">
                <div class="search-field">
                    <input type="text" class="form-control " placeholder="Buscar ..." id="term" name="term" value="{{ $term }}" >
                </div>

            </div>
            <div class="col-lg-4 col-6">
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

        <div class="grid-container mt-3">
            <div class="blog grid are-images-unloaded" data-url="{{ route('blog') }}" data-page="1">
                <div class="grid__col-sizer"></div>
                <div class="grid__gutter-sizer"></div>

                @foreach($posts as $post)
                    @include('_blog_post')
                @endforeach
                {!! $posts->links() !!}

            </div>

            @include('_grid-loader')
    </div>

    @else
        <div class="display-4 p-5 text-center mt-3">
            Oops! no hi ha entrades&hellip;
        </div>
    @endif

@endsection
