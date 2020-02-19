@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">

            
                
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="user-tab" data-toggle="tab" href="#user-tab-content" role="tab">Dades del soci</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="xarxes-tab" data-toggle="tab" href="#xarxes-tab-content" role="tab">Xarxes socials</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="portfolio-tab" data-toggle="tab" href="#portfolio-tab-content" role="tab">Portafoli</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    
                    @include('layouts._messages')
                    <form method="POST" action="{{ route('soci.save') }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="tab-content"">
                            <div class="tab-pane active" id="user-tab-content" role="tabpanel" >
                                <div class="row">
                                    <div class="col-sm-3 text-center">
                                        <div  id="profile_picture_container">
                                            <img src="{{ $user->acf->image('profile_picture')->url}}" class="profile-picture mb-3" />
                                            <button type="button" class="btn  btn-light browse-button" for="f_profile_picture">Canviar imatge</button>
                                            <input type="file" hidden name="profile_picture" id="f_profile_picture"  aria-describedby="f_profile_picture" />

                                            <div class="dropzone"><h3>Drop image here...</h3></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <label for="f_numero_de_soci">Soci</label>
                                            <input type="text" class="form-control" id="f_numero_de_soci" name="numero_de_soci" aria-describedby="f_numero_de_soci" value="{{ $user->acf->text('numero_de_soci') }}">
                                        </div>
                
                                        <div class="form-group">
                                            <label for="f_nickname">Alias</label>
                                            <input type="text" class="form-control" id="f_nickname" name="nickname" aria-describedby="f_nickname" value="{{ $user->nickname }}">
                                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="f_first_name">Nom</label>
                                            <input type="text" class="form-control" id="f_first_name" name="first_name" value="{{ $user->first_name }}" >
                                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                        </div>
                        
                                        <div class="form-group">
                                            <label for="f_last_name">Cognoms</label>
                                            <input type="text" class="form-control" id="f_last_name" name="last_name" value="{{ $user->last_name }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="f_display">Mostrar</label>
                                            <select class="custom-select" id="f_display" name="display">
                                                <option value="nickname">Alias</option>
                                                <option value="first_name">Nom</option>
                                                <option value="full_name">Nom i Cognoms</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="f_soci_email">Email</label>
                                            <input type="email" class="form-control" id="f_soci_email" name="soci_email" value="{{ $user->acf->text('soci_email') }}">
                                        </div>
                        
                                        <div class="form-group">
                                            <label for="f_soci_web">Web</label>
                                            <input type="url" class="form-control" id="f_soci_web" name="soci_web" value="{{ $user->acf->text('soci_web') }}">
                                        </div>
                        
                                        <div class="form-group">
                                            <label for="f_soci_biografia">Biografia (breu)</label>
                                            <textarea class="form-control" id="f_soci_biografia" name="soci_biografia">{{ $user->acf->text('soci_biografia') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane " id="xarxes-tab-content" role="tabpanel" >
                                TODO
                            </div>

                            <div class="tab-pane " id="portfolio-tab-content" role="tabpanel" >
                                <div cass="row">
                                    @if($images=$user->acf->gallery('galeria'))
                                        @foreach($images as $image)
                                            <div class="col col-2">
                                                <figure >
                                                    <img src="{{ $image->url}}" class="img-fluid w-100" />
                                                </figure>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-lg btn-primary">Guardar</button>
        
                    </form>
                </div>
            </div>

           
        </div>
    </div>
</div>
@endsection
