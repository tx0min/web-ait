@extends('layouts.master')

@section('content')

            
            
    @include('layouts._messages')
    
    
    <form method="POST" action="{{ route('soci.save') }}" enctype="multipart/form-data" class="mb-3" id="user-form">
        @csrf
        @method('POST')

        <div class="row align-items-start">
            <div class="col-sm-3 mb-4">
                <h5>@icon('user') Imatge de perfil</h5>
                <div id="profile_picture_container" class="p-3 text-center image-uploader @if(!$user->hasProfileImage()) empty @endif" data-picture-type="profile_picture"  data-url="{{ route('soci.upload',["picture_type"=>'profile_picture']) }}" data-method="post" data-multiple="false">
                    <figure>
                        {!! $user->renderProfileImage(['class'=>'profile-picture mb-3 image-thumbnail','size'=>'square-medium']) !!}
                        <a href="#" class="remover">@icon('times')</a>
                    </figure>
                    <button type="button" class="btn btn-block btn-light browse-button" for="f_profile_picture">Canviar imatge</button>
                    <input type="file" hidden name="profile_picture" id="f_profile_picture"  aria-describedby="f_profile_picture" />

                    <div class="dropzone"><h3>Drop image here...</h3></div>

                </div>
                <small class="text-muted ">Aquesta imatge apareixerà arrodonida automàticament. La mida recomanada és de 150x150px</small>

                <hr/>
                <h5>@icon('image')  Imatge destacada</h5>
                <div id="featured_picture_container" class="image-uploader text-center  mb-3 @if(!$user->hasFeaturedImage()) empty @endif" data-picture-type="featured_image"  data-url="{{ route('soci.upload',["picture_type"=>'featured_image']) }}" data-method="post" data-multiple="false">
                    <figure>
                        {!! $user->renderFeaturedImage(['class'=>'mb-3 w-100 image-thumbnail','size'=>'square-large']) !!}
                        <a href="#" class="remover">@icon('times')</a>
                    </figure>
                    <button type="button" class="btn btn-block btn-light browse-button" for="f_profile_picture">Canviar imatge</button>
                    <input type="file" hidden name="featured_image" id="f_featured_image"  aria-describedby="f_featured_image" />

                    <div class="dropzone"><h3>Drop image here...</h3></div>
                </div>
                <small class="text-muted ">Aquesta imatge apareixerà a la graella de socis en format quadrat. La mida recomanada és de 500x500px</small>
                
            </div>
            <div class="col-sm-9">


                <ul class="nav nav-tabs responsive-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="user-tab" data-toggle="tab" href="#user-tab-content" role="tab">Dades del soci</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="xarxes-tab" data-toggle="tab" href="#xarxes-tab-content" role="tab">@icon('envelope')  Contacte</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="portfolio-tab" data-toggle="tab" href="#portfolio-tab-content" role="tab">@icon('images') Portafoli</a>
                    </li>
                </ul>
            
            
                <div class="tab-content"">
                    <div class="tab-pane active p-3" id="user-tab-content" role="tabpanel" >
                        

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
                            <label for="f_soci_biografia">Biografia (breu)</label>
                            <textarea class="form-control" id="f_soci_biografia" name="soci_biografia">{{ $user->acf->text('soci_biografia') }}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary" >Guardar</button>
                        </div>
                            
        
                    </div>
        
                    <div class="tab-pane  p-3" id="xarxes-tab-content" role="tabpanel" >
                        
                        <div class="form-group">
                            
                            <div class="input-group">
                                <label for="f_soci_email" class="input-group-prepend">
                                    <span class="input-group-text" >@icon('envelope')</span>
                                </label>
                                <input type="email" class="form-control" id="f_soci_email" name="soci_email" placeholder="Email ..." value="{{ $user->acf->text('soci_email') }}">
                            </div>
                            

                        </div>
        
                        <div class="form-group">

                            <div class="input-group">
                                <label for="f_soci_web" class="input-group-prepend">
                                    <span class="input-group-text" >@icon('globe')</span>
                                </label>
                                <input type="url" class="form-control" id="f_soci_web" name="soci_web" placeholder="Web ..." value="{{ $user->acf->text('soci_web') }}">
                            </div>

                        </div>
                    
                        <div class="form-group">
                            <div class="input-group">
                                <label for="f_facebook" class="input-group-prepend">
                                    <span class="input-group-text" >@icon('facebook',['type'=>'fab'])</span>
                                </label>
                                <input type="url" class="form-control" id="f_facebook" name="facebook" placeholder="Facebook URL ..." value="{{ $user->acf->text('facebook') }}">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="input-group">
                                <label for="f_twitter" class="input-group-prepend">
                                    <span class="input-group-text" >@icon('twitter',['type'=>'fab'])</span>
                                </label>
                                <input type="text" class="form-control" id="f_twitter" name="twitter" placeholder="Twitter user ..." value="{{ $user->acf->text('twitter') }}">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="input-group">
                                <label for="f_instagram" class="input-group-prepend">
                                    <span class="input-group-text" >@icon('instagram',['type'=>'fab'])</span>
                                </label>
                                <input type="text" class="form-control" id="f_instagram" name="instagram" placeholder="Instagram user ..." value="{{ $user->acf->text('instagram') }}">
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="f_instagram" class="input-group-prepend">
                                    <span class="input-group-text" >@icon('youtube',['type'=>'fab'])</span>
                                </label>
                                <input type="url" class="form-control" id="f_youtube" name="youtube" placeholder="Youtube URL ..." value="{{ $user->acf->text('youtube') }}">
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="f_linkedin" class="input-group-prepend">
                                    <span class="input-group-text" >@icon('linkedin',['type'=>'fab'])</span>
                                </label>
                                <input type="url" class="form-control" id="f_linkedin" name="linkedin" placeholder="LinkedIn URL ..." value="{{ $user->acf->text('linkedin') }}">
                            </div>

                        </div>
                            

                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary" >Guardar</button>
                        </div>
                    </div>
        
                    <div class="tab-pane  p-3" id="portfolio-tab-content" role="tabpanel" >
                        
        
                        <div id="galeria_container" class="image-uploader" data-picture-type="galeria" data-url="{{ route('soci.upload',["picture_type"=>'galeria']) }}" data-method="post" data-multiple="false">
                            <div class="thumbnails-container row no-gutters mb-3">
                                @if($images=$user->acf->gallery('galeria'))
                                    @foreach($images as $image)
                                        <div class="col-sm-4 col-md-3 col-6 p-2 thumb-image" data-id="{{ $image->attachment->ID }}" >
                                            <figure> 
                                                <img src="{{ $image->size('square-big')->url}}" class="img-fluid w-100 " />
                                                <a href="#" class="remover">@icon('times')</a>
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
        </div>

        

        
        <div class="mobile-form-buttons">
            <button type="submit" class="btn btn-lg btn-primary" >Guardar</button>
        </div>

    </form>



    
@endsection
