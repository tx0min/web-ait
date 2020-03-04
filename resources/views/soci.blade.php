@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-xl-9">
        {{-- @dump($user->meta->where('meta_key','wp_capabilities')) --}}
        <div class="row align-items-start">
            <div class="col-lg-3 text-center text-lg-left">
                {!! $user->renderProfileImage(['class'=>'profile-picture','size'=>'medium']) !!}
            </div>
            <div class="col-lg-9 pt-2  text-break text-center text-lg-left">
                <h1 class="display-4 text-break">{{ $user->displayName() }}</h1>
                <div class="mb-3">
                    @if($web=$user->acf->url('soci_web')) <a href="{{ $web }}" target="_blank" class="d-block">{{ $web }}</a> @endif
                    @if($mail=$user->acf->text('soci_email')) <a href="mailto:{{ $mail }}" class="d-block">{{ $mail }}</a> @endif
                    @include("_social")
                </div>
                <p>{{ $user->biografia() }}</p>
                @include("_user_disciplines")

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
