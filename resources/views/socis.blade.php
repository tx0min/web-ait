@extends('layouts.master')

@section('content')

    {{-- @dump($disciplines) --}}
    <div class="row ">
        <div class="col-lg-8 col-md-6 mb-3">

            <div class="input-group px-2">
                <label for="f_soci_email" class="input-group-prepend">
                    <span class="input-group-text" >@icon('search')</span>
                </label>
                <input type="text" class="form-control" placeholder="Buscar ..." >
            </div>
            
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="px-2">
                <select class="custom-select form-control-lg "  >
                    @foreach($disciplines as $disciplina)
                        <option value="{{ $disciplina->term_id }}">{{ $disciplina->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="socis grid">
        @if($users)
            @foreach($users as $user)
                {{-- @for($i=0;$i<3;$i++) --}}

                        <a class="soci grid-item" href="{{ route('socis',['soci_slug'=>$user->slug]) }}">
                            <figure class="mb-0">
                                 {!! $user->renderFeaturedImage(['class'=>'card-img-top','size'=>'medium']) !!}
                            </figure>
                            <div class="d-flex align-items-center py-2">

                                {!! $user->renderProfileImage(['class'=>'profile-picture size-xs','size'=>'small']) !!}
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
