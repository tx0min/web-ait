@extends('layouts.master')

@section('content')

            
            
    @include('layouts._messages')
    
    
    <form method="POST" action="{{ route('soci.save') }}" enctype="multipart/form-data" class="mb-3" id="user-form">
        @csrf
        @method('POST')

        <ul class="nav nav-tabs responsive-tabs">
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
    
    
        <div class="tab-content"">
            <div class="tab-pane active pt-3" id="user-tab-content" role="tabpanel" >
                <div class="row align-items-start">
                    <div class="col-sm-3 text-center">
                        <div id="profile_picture_container" class="p-3 image-uploader" data-url="{{ route('soci.upload',["picture_type"=>'profile_picture']) }}" data-method="post" data-multiple="false">
                            <img src="{{ $user->acf->image('profile_picture')->size('square-medium')->url}}" class="profile-picture mb-3 image-thumbnail" />
                            <button type="button" class="btn btn-block btn-light browse-button" for="f_profile_picture">Canviar imatge</button>
                            <input type="file" hidden name="profile_picture" id="f_profile_picture"  aria-describedby="f_profile_picture" />

                            <div class="dropzone"><h3>Drop image here...</h3></div>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <label for="f_numero_de_soci">Soci</label>
                            <input type="text" class="form-control" id="f_numero_de_soci" readonly  name="numero_de_soci" aria-describedby="f_numero_de_soci" value="{{ $user->acf->text('numero_de_soci') }}">
                        </div>

                        <div class="form-group">
                            <label for="f_nickname">Alias</label>
                            <input type="text" class="form-control " id="f_nickname" name="nickname" aria-describedby="f_nickname" value="{{ $user->nickname }}">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>
                        
                        <div class="form-group">
                            <label for="f_first_name">Nom</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="f_first_name" name="first_name" value="{{ $user->first_name }}" >
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

            <div class="tab-pane  pt-3" id="xarxes-tab-content" role="tabpanel" >
                TODO
            </div>

            <div class="tab-pane  pt-3" id="portfolio-tab-content" role="tabpanel" >

                <div id="featured_picture_container" class="image-uploader w-50" data-url="{{ route('soci.upload',["picture_type"=>'featured_image']) }}" data-method="post" data-multiple="false">
                    <img src="{{ $user->acf->image('featured_image')->url}}" class="mb-3 w-100 image-thumbnail" />
                    <button type="button" class="btn btn-block btn-light browse-button" for="f_profile_picture">Canviar imatge</button>
                    <input type="file" hidden name="featured_image" id="f_featured_image"  aria-describedby="f_featured_image" />

                    <div class="dropzone"><h3>Drop image here...</h3></div>
                </div>

                <div cass="row">
                    

                    <div id="galeria_container" class="image-uploader" data-url="{{ route('soci.upload',["picture_type"=>'galeria']) }}" data-method="post" data-multiple="false">
                        <div class="thumbnails-container">
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

                        <button type="button" class="btn btn-block btn-light browse-button" for="f_galeria">Afegir imatge/s</button>
                        <input type="file" hidden name="galeria" id="f_galeria"  aria-describedby="f_galeria" multiple />
    
                        <div class="dropzone"><h3>Drop image/s here...</h3></div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="form-buttons">
            <button type="submit" class="btn btn-lg btn-primary" >Guardar</button>
        </div>

    </form>



    
@endsection
