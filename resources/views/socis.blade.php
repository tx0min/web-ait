@extends('layouts.master')

@section('footer')
    @include('layouts._footer')
@endsection

@section('content')
    <div class="page-content">
        {{-- @dump($disciplines) --}}
        <form method="post" action="{{ route('socis.search') }}" id="socis-form" class="grid-form">
            @csrf
            <div class="row ">
                <div class="col-xl-9 col-lg-8 col-6">
                    <div class="search-field">
                        <input type="text" class="form-control " placeholder="Buscar ..." id="term" name="term" value="{{ $term }}" >
                    </div>

                </div>
                <div class="col-xl-3 col-lg-4 col-6">
                    <select class="selectpicker form-submitter" id="selector-disciplina" name="disciplina" title="Disciplines...">
                        <option value="0">Qualsevol</option>
                        @foreach($disciplines as $dis)
                            <option value="{{ $dis->slug }}" {{ $disciplina==$dis->slug?"selected":"" }} >{{ $dis->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" hidden></button>

        </form>


        @if($users && !$users->isEmpty())
            <div class="socis grid are-images-unloaded " id="socis-grid">
                <div class="grid__col-sizer"></div>
                <div class="grid__gutter-sizer"></div>
                @foreach($users as $user)
                    {{-- @for($i=0;$i<3;$i++) --}}

                            <div class="soci grid__item" >
                                <div class="grid-inner">
                                    <a href="{{ route('socis.soci',['soci_slug'=>$user->slug]) }}">
                                        <figure class="mb-0">
                                            {!! $user->renderFeaturedImage(['class'=>'card-img-top','size'=>'big']) !!}
                                        </figure>
                                    </a>
                                    <div class="d-flex align-items-start p-2">

                                        <a href="{{ route('socis.soci',['soci_slug'=>$user->slug]) }}"">
                                            {!! $user->renderProfileImage(['class'=>'profile-picture size-xs','size'=>'small']) !!}
                                        </a>
                                        <div class="pl-2 text-break">
                                            <a href="{{ route('socis.soci',['soci_slug'=>$user->slug]) }}">
                                                <h3 class="mb-0 ">{{ $user->displayName() }}</h3>
                                            </a>
                                            @include("_social")
                                            @include("_user_disciplines")

                                        </div>
                                    </div>
                                </div>

                            </div>

                    {{-- @endfor --}}

                @endforeach
                {!! $users->links() !!}
            </div>
            @include('_grid-loader')
        @else
            <div class="display-4 p-5 mt-3 text-center">
                Oops! no hi ha socis&hellip;
            </div>
        @endif
    </div>

@endsection
