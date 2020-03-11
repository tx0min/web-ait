@extends('layouts.master')

@section('footer')
    @include('layouts._footer')
@endsection


@section('content')



<div class="row page-content">
    <div class="col-md-3">
        <video src="{{ asset('img/video-apuntate.mp4') }}" autoplay loop class="embed-responsive"></video>
    </div>
    <div class="col-md-6">

        @include('layouts._messages')

        <form method="POST" action="{{ route('fes-te-soci.alta') }}" enctype="multipart/form-data" class="mb-3" id="fes-te-soci-form">
            @csrf
            @method('POST')
            
            <div class="form-group row">
                <label for="f_user_login" class="col-md-3 col-form-label text-md-right">Nom d'usuari</label>
                <div class="col-md-9">
                    <input type="text" class="form-control @error('user_login') is-invalid @enderror" id="f_user_login" name="user_login" value="{{ old('user_login') }}" >
                    <small class="form-text text-muted">
                        El necessitaràs per accedir al teu perfil de la web i gestionar el teu portafoli.
                      </small>
                </div>
             </div>

            <div class="form-group row">
                <div class="col-md-9 offset-md-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="f_password"  name="password" value="" placeholder="Contrasenya...">
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="f_password_repeat"  name="password_confirmation" value="" placeholder="Repeteix-la...">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="f_first_name" class="col-md-3 col-form-label text-md-right">Nom</label>
                <div class="col-md-9">
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="f_first_name" name="first_name" value="{{ old('first_name') }}" >
                </div>
             </div>
            <div class="form-group row">
                <label for="f_last_name" class="col-md-3 col-form-label text-md-right">Cognoms</label>
                <div class="col-md-9">
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="f_last_name" name="last_name" value="{{ old('last_name') }}" >
                </div>
             </div>

            <div class="form-group row">
                <label for="f_user_email" class="col-md-3 col-form-label text-md-right">Email</label>
                <div class="col-md-9">
                    <input type="text" class="form-control @error('user_email') is-invalid @enderror" id="f_user_email" name="user_email" value="{{ old('user_email') }}" >
                </div>
             </div>

             <div class="form-group row">
                <label for="f_telefon" class="col-md-3 col-form-label text-md-right">Telèfon</label>
                <div class="col-md-9">
                    <input type="text" class="form-control @error('telefon') is-invalid @enderror" id="f_telefon" name="telefon" value="{{ old('telefon') }}" >
                </div>
             </div>


            <div class="form-group row">
                <label for="f_data_naixement" class="col-md-3 col-form-label text-md-right">Data de naixement</label>
                <div class="col-md-9">
                    <input type="text" class="form-control @error('data_naixement') is-invalid @enderror" id="f_data_naixement" name="data_naixement" value="{{ old('data_naixement') }}" >
                    {{-- <small class="form-text text-muted">
                        Format dia/mes/any
                    </small> --}}
                </div>
             </div>


             <div class="form-group row">
                <label for="f_localitat" class="col-md-3 col-form-label text-md-right">Localitat</label>
                <div class="col-md-9">
                    <input type="text" class="form-control @error('localitat') is-invalid @enderror" id="f_localitat" name="localitat" value="{{ old('localitat') }}" >
                </div>
             </div>
             <div class="form-group row">
                <label for="f_adreca" class="col-md-3 col-form-label text-md-right">Adreça</label>
                <div class="col-md-9">
                    <input type="text" class="form-control @error('adreca') is-invalid @enderror" id="f_adreca" name="adreca" value="{{ old('adreca') }}" >
                </div>
             </div>

             <div class="form-group row">
                <label for="f_disciplines" class="col-md-3 col-form-label text-md-right @error('disciplines') text-danger @enderror">Disciplines @error('disciplines') @icon('exclamation-circle') @enderror</label>
                <div class="col-md-9">
                    @foreach($disciplines as $disciplina)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="disciplines[]" id="disciplina-{{ $disciplina->term_id }}" value="{{ $disciplina->term_id }}">
                            <label class="custom-control-label" for="disciplina-{{ $disciplina->term_id }}">{{ $disciplina->name }}</label>
                        </div>

                    {{-- <option  value="{{ $disciplina->term_id }}" >{{ $disciplina->name }}</option> --}}
                    @endforeach
                </div>
             </div>


             <div class="form-group row">
                <div class="col-md-9 offset-md-3 ">
                    <button type="submit" class="btn btn-lg btn-primary btn-block" >Sol·licitar alta de soci</button>
                </div>
            </div>
        </form>

    </div>
</div>
    @endsection
