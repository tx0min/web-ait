@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-9">
        {{-- @dump($user->meta->where('meta_key','wp_capabilities')) --}}
        <div class="row align-items-start">
            <div class="col col-sm-3 col-md-3 col-lg-2">
                <img src="{{ $user->acf->image('profile_picture')->size('square-medium')->url}}" class="profile-picture" />
            </div>
            <div class="col-lg-6 col-md-9 pt-2  text-break">
                <h1 class="display-4 ">{{ $user->display_name }}</h1>
                @if($user->url) <p><a href="{{ $user->url }}" target="_blank">{{ $user->url }}</a></p> @endif
                {{$user->acf->text('soci_biografia') }}
            </div>
            <div class="col-lg-2 col-md-12 pt-4">
                @include("_social")
            </div>
            

            
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                @if($images=$user->acf->gallery('galeria'))
                    @foreach($images as $image)
                        <figure>
                            <img src="{{ $image->url}}" class="img-fluid w-100" />
                        </figure>
                    @endforeach
                @endif
                
            </div>

        </div>
    </div>
</div>

@endsection
