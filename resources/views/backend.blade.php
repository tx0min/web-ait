@extends('layouts.master')

@section('footer')
    @include('layouts._footer')
@endsection


@section('content')




<div class="row page-content ">
    <div class="col-xl-10">


        @include('layouts._messages')

        <form method="POST" action="{{ route('soci.save') }}" enctype="multipart/form-data" class="mb-3" id="user-form">
            @csrf
            @method('POST')

            <div class="row align-items-start">
                <div class="col-md-3 mb-4 order-md-12">
                    <h3 class="text-center">Imatge de perfil</h3>
                    <div id="profile_picture_container" class="p-3 text-center image-uploader @if(!$user->hasProfileImage()) empty @endif" data-picture-type="profile_picture"  data-url="{{ route('soci.upload',["picture_type"=>'profile_picture']) }}" data-method="post" data-multiple="false">
                        <figure>
                            {!! $user->renderProfileImage(['class'=>'profile-picture mb-3 image-thumbnail','size'=>'medium']) !!}
                            <a href="#" class="remover">@icon('times')</a>
                        </figure>
                        <button type="button" class="btn btn-block btn-light browse-button btn-lg" for="f_profile_picture">Canviar imatge</button>
                        <input type="file" hidden name="profile_picture" id="f_profile_picture"  aria-describedby="f_profile_picture" />

                        <div class="dropzone"><h3>Drop image here...</h3></div>

                    </div>
                    <small class="text-muted ">Aquesta imatge apareixerà arrodonida automàticament. La mida recomanada és de 150x150px. Mida màxima: {{ human_filesize(config('ait.image-max-size')) }} </small>


                    <h3 class="mt-5 text-center pb-2">Imatge de portada</h3>
                    <div id="featured_picture_container" class="image-uploader text-center  mb-3 @if(!$user->hasFeaturedImage()) empty @endif" data-picture-type="featured_image"  data-url="{{ route('soci.upload',["picture_type"=>'featured_image']) }}" data-method="post" data-multiple="false">
                        <figure>
                            {!! $user->renderFeaturedImage(['class'=>'mb-3 w-100 image-thumbnail','size'=>'large']) !!}
                            <a href="#" class="remover">@icon('times')</a>
                        </figure>
                        <button type="button" class="btn btn-block btn-light browse-button btn-lg" for="f_profile_picture">Canviar imatge</button>
                        <input type="file" hidden name="featured_image" id="f_featured_image"  aria-describedby="f_featured_image" />

                        <div class="dropzone"><h3>Drop image here...</h3></div>
                    </div>
                    <small class="text-muted ">Aquesta imatge apareixerà a la graella de socis en format quadrat. La mida recomanada és de 500x500px. Mida màxima: {{ human_filesize(config('ait.image-max-size')) }} </small>

                </div>



                <div class="col-md-9 order-md-1">


                    <ul class="nav nav-pills responsive-tabs nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" id="user-tab" data-toggle="tab" href="#user-tab-content" role="tab"><h3>Sobre tu</h3></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="xarxes-tab" data-toggle="tab" href="#xarxes-tab-content" role="tab"><h3>Contacte</h3></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="portfolio-tab" data-toggle="tab" href="#portfolio-tab-content" role="tab"><h3>Portafoli</h3></a>
                        </li>
                    </ul>


                    <div class="tab-content"">
                        <div class="tab-pane active py-md-5" id="user-tab-content" role="tabpanel" >


                            {{-- <div class="form-group">
                                <label for="f_numero_de_soci">Soci</label>
                                <input type="text" class="form-control" id="f_numero_de_soci" readonly  name="numero_de_soci" aria-describedby="f_numero_de_soci" value="{{ $user->acf->text('numero_de_soci') }}">
                            </div>--}}

                            <div class="form-group row">
                                <label for="f_username" class="col-md-3 col-form-label text-md-right">Usuari</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="f_user_login" disabled  name="user_login" aria-describedby="f_user_login" value="{{ $user->user_login }}">
                                </div>
                               

                            </div> 
                            <div class="form-group row">
                                {{-- <label for="f_password" class="col-md-3 col-form-label text-md-right">Contrassenya</label> --}}
                                <div class="col-md-9 offset-md-3">
                                    

                                    <button type="button" type="button" data-toggle="collapse" data-target="#change_password_fields"  id="btn_password" class="btn btn-block btn-light">Canviar contrasenya</button>
                                </div>
                            </div> 

                            <div class=" collapse  @error('new_password') show @enderror " id="change_password_fields">
                                <div class="form-group row">
                                    <div class="col-md-9 offset-md-3">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="f_password"  name="new_password" value="" placeholder="Nova contrasenya...">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="f_password_repeat"  name="new_password_confirmation" value="" placeholder="Repeteix la contrasenya...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="f_first_name" class="col-md-3 col-form-label text-md-right">Nom</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="f_first_name" name="first_name" value="{{ $user->first_name }}" >
                                </div>
                             </div>


                             <div class="form-group row">
                                <label for="f_last_name" class="col-md-3 col-form-label text-md-right">Cognoms</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="f_last_name" name="last_name" value="{{ $user->last_name }}">
                                </div>
                             </div>

                             <div class="form-group row">
                                <label for="f_nickname" class="col-md-3 col-form-label text-md-right">Alias</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control @error('nickname') is-invalid @enderror " id="f_nickname" name="nickname" aria-describedby="f_nickname" value="{{ $user->nickname }}">
                                </div>
                             </div>


                             <div class="form-group row">
                                <label for="f_display_name" class="col-md-3 col-form-label text-md-right">Mostrar</label>
                                <div class="col-md-9">
                                    <select class="selectpicker" id="f_display_name" name="display_name">
                                        @foreach($display_options as $key=>$option)
                                            <option {{ ($key==$user->get_display())?"selected":""  }}  value="{{ $key }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                             </div>


                             <div class="form-group row">
                                <label for="f_soci_biografia" class="col-md-3 col-form-label text-md-right">Breu biografia o Statement</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" id="f_soci_biografia" rows="8" name="soci_biografia">{{ $user->biografia() }}</textarea>
                                </div>
                             </div>

                             <div class="form-group row">
                                <label for="f_localitat" class="col-md-3 col-form-label text-md-right">Localitat</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="f_localitat" name="localitat" value="{{ $user->acf->text('localitat') }}"/>
                                </div>
                             </div>

                             <div class="form-group row">
                                <label for="f_adreca" class="col-md-3 col-form-label text-md-right">Adreça</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="f_adreca" name="adreca" value="{{ $user->acf->text('adreca') }}"/>
                                </div>
                             </div>

                             <div class="form-group row">
                                <label for="f_disciplines" class="col-md-3 col-form-label text-md-right @error('disciplines') text-danger @enderror">Disciplines @error('disciplines') @icon('exclamation-circle') @enderror</label>
                                <div class="col-md-9">
                                    @foreach($disciplines as $disciplina)
                                        <div class="custom-control custom-checkbox">
                                            <input {{ ( in_array($disciplina->term_id, $user_disciplines_ids)?"checked":"")  }} type="checkbox" class="custom-control-input" name="disciplines[]" id="disciplina-{{ $disciplina->term_id }}" value="{{ $disciplina->term_id }}">
                                            <label class="custom-control-label" for="disciplina-{{ $disciplina->term_id }}">{{ $disciplina->name }}</label>
                                        </div>

                                    {{-- <option  value="{{ $disciplina->term_id }}" >{{ $disciplina->name }}</option> --}}
                                    @endforeach
                                </div>
                             </div>



                            <div class="form-group row d-none d-md-block">
                                <div class="col-md-9 offset-md-3">
                                    <button type="submit" class="btn btn-lg btn-primary btn-block" >Guardar</button>
                                </div>
                            </div>


                        </div>

                        <div class="tab-pane  py-md-5" id="xarxes-tab-content" role="tabpanel" >

                            <div class="form-group row">
                                <label for="f_soci_email" class="col-md-3 col-form-label text-md-right">@icon('envelope') Email</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" id="f_soci_email" name="soci_email" placeholder="Email ..." value="{{ $user->emailContacte() }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="f_telefon" class="col-md-3 col-form-label text-md-right">@icon('phone') Telèfon</label>
                                <div class="col-md-9">
                                    <input type="telefon" class="form-control" id="f_telefon" name="telefon" placeholder="Telèfon ..." value="{{ $user->acf->text('telefon') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="f_soci_web" class="col-md-3 col-form-label text-md-right">@icon('globe') Web</label>
                                <div class="col-md-9">
                                    <input type="url" class="form-control" id="f_soci_web" name="soci_web" placeholder="Web ..." value="{{ $user->web() }}">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="f_facebook" class="col-md-3 col-form-label text-md-right">@icon('facebook-square',['type'=>'fab']) Facebook</label>
                                <div class="col-md-9">
                                    <input type="url" class="form-control" id="f_facebook" name="facebook" placeholder="Facebook URL ..." value="{{ $user->acf->text('facebook') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="f_twitter" class="col-md-3 col-form-label text-md-right">@icon('twitter',['type'=>'fab']) Twitter</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="f_twitter" name="twitter" placeholder="Twitter user ..." value="{{ $user->acf->text('twitter') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="f_instagram" class="col-md-3 col-form-label text-md-right">@icon('instagram',['type'=>'fab']) Instagram</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="f_instagram" name="instagram" placeholder="Instagram user ..." value="{{ $user->acf->text('instagram') }}">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="f_youtube" class="col-md-3 col-form-label text-md-right">@icon('youtube',['type'=>'fab']) Youtube</label>
                                <div class="col-md-9">
                                    <input type="url" class="form-control" id="f_youtube" name="youtube" placeholder="Youtube URL ..." value="{{ $user->acf->text('youtube') }}">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="f_linkedin" class="col-md-3 col-form-label text-md-right">@icon('linkedin',['type'=>'fab']) LinkedIn</label>
                                <div class="col-md-9">
                                    <input type="url" class="form-control" id="f_linkedin" name="linkedin" placeholder="LinkedIn URL ..." value="{{ $user->acf->text('linkedin') }}">
                                </div>
                            </div>


                            <div class="form-group row d-none d-md-block">
                                <div class="col-md-9 offset-md-3">
                                    <button type="submit" class="btn btn-lg btn-primary btn-block btn-lg" >Guardar</button>
                                </div>
                            </div>


                        </div>

                        <div class="tab-pane py-md-5" id="portfolio-tab-content" role="tabpanel" >


                            <div id="galeria_container" class="image-uploader mb-3" data-picture-type="galeria" data-url="{{ route('soci.upload',["picture_type"=>'galeria']) }}" data-method="post" data-multiple="false">
                                <div class="thumbnails-container row no-gutters mb-3">
                                    @if($images=$user->galeria())
                                        @foreach($images as $image)
                                            <div class="col-sm-4 col-md-3 col-6 p-2 thumb-image" data-id="{{ $image->attachment->ID }}" >
                                                <figure class="in">
                                                    <img src="{{ wp_image_url($image, config('ait.sizes.big') ) }}" class="img-fluid w-100 " />
                                                    <a href="#" class="remover">@icon('times')</a>
                                                </figure>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <button type="button" class="btn btn-block btn-lg btn-light browse-button" for="f_galeria">Afegir imatge/s</button>

                                <small class="text-muted d-block pt-3">Mida màxima: {{ human_filesize(config('ait.image-max-size')) }}</small>

                                <input type="file" hidden name="galeria" id="f_galeria"  aria-describedby="f_galeria" multiple />

                                <div class="dropzone"><h3>Drop image/s here...</h3></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>




            <div class="mobile-form-buttons">
                <button type="submit" class="btn btn-lg btn-primary btn-lg" >Guardar</button>
            </div>

        </form>

    </div>
</div>


@endsection
