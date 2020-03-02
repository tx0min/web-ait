@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-xl-9">
        {{-- @dump($user->meta->where('meta_key','wp_capabilities')) --}}
        <div class="row align-items-start">
            <div class="col-lg-2 text-center text-lg-left">
                {!! $user->renderProfileImage(['class'=>'profile-picture','size'=>'medium']) !!}
            </div>
            <div class="col-lg-6 pt-2  text-break text-center text-lg-left">
                <h1 class="display-4 text-truncate">{{ $user->displayName() }}</h1>
                <p>{{ $user->biografia() }}</p>
                @if($disciplines=$user->disciplines())
                    @foreach($disciplines as $disciplina)
                        <a class="badge badge-dark" href="{{ route('socis.disciplina',['disciplina'=>$disciplina->slug])}}">{{ $disciplina->name }}</a>
                    @endforeach
                @endif
            </div>
            <div class="col-lg-3 pt-4 text-center text-lg-left">
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
