@extends('layouts.master')

@section('content')

    {{-- @dump($disciplines) --}}
    <form method="post" action="{{ route('socis.search') }}" id="socis-form">
        @csrf
        <div class="row ">
            <div class="col-lg-8 col-md-6 mb-3">
                <div class="search-field">
                    <input type="text" class="form-control " placeholder="Buscar ..." id="term" name="term" value="{{ $term }}" >
                </div>
                
            </div>
            <div class="col-lg-4 col-md-6 mb-3">
                <select class="selectpicker" id="selector-disciplina" name="disciplina" title="Disciplines...">
                    <option value="0">Qualsevol</option>
                    @foreach($disciplines as $disciplina)
                        <option value="{{ $disciplina->slug }}" {{ $current_disciplina==$disciplina->slug?"selected":"" }} >{{ $disciplina->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" hidden></button>
        
    </form>
    <div class="socis grid" id="socis-grid">
        @if($users && !$users->isEmpty())
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
        @else
            <div class="display-4 p-5 text-center">
                Oops! no hi ha socis&hellip;
            </div>
        @endif
    </div>

@endsection
