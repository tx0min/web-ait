@extends('layouts.master')

@section('footer')
    @include('layouts._footer')
@endsection


@section('content')
<div class="page-content">
    <div class="row mb-5">
        <div class="col-md-9">
            {!! $page->post_content !!}
        </div>
    </div>


    <div class="alignfull mt-5">
        <div class="container ">
            <div class="row ">
                {{-- <div class="col-md-4 text-center text-md-left mb-5">
                    <h2>La junta</h2>
                </div> --}}

                @foreach($users as $user)
                    <div class="col-md-4">
                        <div class="row align-items-center mb-5">
                            <div class="col-md-3 text-center text-md-left"><a href="{{ route('socis.soci',['soci_slug'=>$user->slug]) }}">{!! $user->renderProfileImage(['class'=>'profile-picture size-md','size'=>'medium']) !!}</a></div>
                            <div class="col-md-9 text-center text-md-left ">
                                <h3 class="text-truncate"><a href="{{ route('socis.soci',['soci_slug'=>$user->slug]) }}">{{ $user->displayName() }}</a></h3>
                                <h4>{{ $user->acf->text('carrec') }}</h4>

                                <div>@include("_social")</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
