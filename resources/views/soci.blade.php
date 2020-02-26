@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-9">
        {{-- @dump($user->meta->where('meta_key','wp_capabilities')) --}}
        <div class="row align-items-start">
            <div class="col col-sm-3 col-md-3 col-lg-2">
                {!! $user->renderProfileImage(['class'=>'profile-picture','size'=>'square-medium']) !!}
            </div>
            <div class="col-lg-6 col-md-9 pt-2  text-break">
                <h1 class="display-4 ">{{ $user->displayName() }}</h1>
                <p>{{ $user->biografia() }}</p>
            </div>
            <div class="col-lg-2 col-md-12 pt-4">
                @if($web=$user->acf->url('soci_web')) <a href="{{ $web }}" target="_blank">{{ $web }}</a> @endif
                @if($mail=$user->acf->text('soci_email')) <a href="mailto:{{ $mail }}">{{ $mail }}</a> @endif
                @include("_social")
            </div>



        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                @if($images=$user->galeria())
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
