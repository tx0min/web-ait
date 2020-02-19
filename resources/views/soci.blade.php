@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row align-items-start">
        <div class="col col-sm-3 col-md-3 col-lg-2">
            <img src="{{ $user->acf->image('profile_picture')->url}}" class="profile-picture" />
        </div>
        <div class="col-sm-4 pt-2">
            <h5 class="display-3">{{ $user->display_name }}</h5>
        </div>
        <div class="col-sm-4 pt-4">
            {{$user->description}}
        </div>
        

           
    </div>
    <div class="row mt-4">
        <div class="col-md-10">
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
@endsection
