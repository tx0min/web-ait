@extends('layouts.master')

@section('content')


            <div class="card-columns socis">

                @if($users)
                    @foreach($users as $user)
                        <a class=" card text-decoration-none border-0" href="{{ route('socis',['soci_slug'=>$user->slug]) }}">
                            <figure><img src="{{ $user->acf->image('featured_image')->size('featured')->url}}" class="card-img-top" alt="..."></figure>
                            <div class="d-flex mt-3 align-items-center">
                                <img src="{{ $user->acf->image('profile_picture')->url}}" class="profile-picture size-xs" />
                                <div class="pl-2">
                                    <h5 class="mb-0">{{ $user->display_name }}</h5>
                                    {{$user->description}}
                                </div>
                            </div>
                            {{-- <div class="card-footer">
                                <small class="text-muted">Last updated 3 mins ago</small>
                            </div> --}}
                        </a>
                        


                    @endforeach
                @endif
            </div>
        
@endsection
