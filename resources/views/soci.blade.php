@extends('layouts.master')


@section('footer')
    @include('layouts._footer')
@endsection

@section('content')

<div class="alignfull soci-featured-image" style="background-image:url({{ $user->getFeaturedImageSrc(['class'=>'','size'=>'full']) }}) ">
{{-- {!! $user->renderFeaturedImage(['class'=>'','size'=>'large']) !!} --}}
</div>
<div class="row soci-container" >
    <div class="col-xl-9">
        {{-- @dump($user->meta->where('meta_key','wp_capabilities')) --}}
        <div class="row align-items-start">
            <div class="col-lg-3 text-center text-lg-left">
                {!! $user->renderProfileImage(['class'=>'profile-picture','size'=>'medium']) !!}
            </div>
            <div class="col-lg-9 pt-4  text-break text-center text-lg-left">
                <h1 class="display-2 text-break">{{ $user->displayName() }}</h1>
                <div class="mb-3">
                    @if($web=$user->acf->url('soci_web')) <a href="{{ $web }}" target="_blank" class="d-block">{{ $web }}</a> @endif
                    @if($mail=$user->acf->text('soci_email')) <a href="mailto:{{ $mail }}" class="d-block">{{ $mail }}</a> @endif
                    @include("_social")
                </div>
                <p>{!! $user->biografia(true) !!}</p>
                @include("_user_disciplines")

            </div>




        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                @if($images=$user->galeria())
                    @foreach($images as $image)
                        <figure>
                            <a href="{{ $image->url}}" target="_blank"><img src="{{ $image->url}}" class="img-fluid w-100" /></a>
                        </figure>
                    @endforeach
                @endif

            </div>

        </div>
    </div>
</div>

@endsection
