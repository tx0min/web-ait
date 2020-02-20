@extends('layouts.master')

@section('content')


    <div class="socis grid">
        @if($users)
            @foreach($users as $user)
                {{-- @for($i=0;$i<3;$i++) --}}
                    
                        <a class="soci grid-item" href="{{ route('socis',['soci_slug'=>$user->slug]) }}">
                            <figure class="mb-0">
                            @if($featured=$user->acf->image('featured_image'))

                                @if($featured->url)
                                    <img src="{{ $featured->size('square-medium')->url}}" class="card-img-top" alt="...">
                                @else
                                    <img src="{{ asset('img/pencil-placeholder.png') }}" class="card-img-top" alt="...">
                                @endif
                            @endif
                            </figure>
                            <div class="d-flex align-items-center py-2">
                                
                                <img src="{{ $user->acf->image('profile_picture')->url}}" class="profile-picture size-xs" />
                                <div class="pl-2 text-break">
                                    <h5 class="mb-0 ">{{ $user->display_name }}</h5>
                                    {{-- @include("_social") --}}
                                </div>
                            </div>
                            
                        </a>
                    
                {{-- @endfor --}}

            @endforeach
        @endif
    </div>
        
@endsection
