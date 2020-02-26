@extends('layouts.master')

@section('content')


    <div class="socis grid">
        @if($users)
            @foreach($users as $user)
                {{-- @for($i=0;$i<3;$i++) --}}

                        <a class="soci grid-item" href="{{ route('socis',['soci_slug'=>$user->slug]) }}">
                            <figure class="mb-0">
                                 {!! $user->renderFeaturedImage(['class'=>'card-img-top','size'=>'square-medium']) !!}
                            </figure>
                            <div class="d-flex align-items-center py-2">

                                {!! $user->renderProfileImage(['class'=>'profile-picture size-xs','size'=>'square-small']) !!}
                                <div class="pl-2 text-break">
                                    <h5 class="mb-0 ">{{ $user->displayName() }}</h5>
                                    {{-- @include("_social") --}}
                                </div>
                            </div>

                        </a>

                {{-- @endfor --}}

            @endforeach
        @endif
    </div>

@endsection
