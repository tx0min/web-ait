<?php

namespace App;

use Corcel\Model\Taxonomy;
use Corcel\Model\User as CorcelUser;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Log;

class User extends CorcelUser
{

    // use HasTaxonomies;

    protected $api_client;
    protected $rest_fields = ["disciplines"];
    protected $api_fields = ["first_name", "last_name", "nickname", "display_name","telefon", "localitat","adreca", "soci_biografia", "soci_email", "soci_web", "facebook", "twitter", "instagram", "youtube", "linkedin"];
    protected $valid_mimes = [ "image/png" , "image/jpg", "image/jpeg", "image/gif" ];
    protected $max_file_size;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->max_file_size = config('ait.image-max-size');

        $this->api_client = new Client([
			'base_uri' => config('ait.wordpress.url'),
			'verify' =>false
		]);
    }


    public function taxonomies()
    {
        return $this->belongsToMany(
            Taxonomy::class, 'term_relationships', 'object_id', 'term_taxonomy_id'
        );
    }

    /**
     * @param string $taxonomy
     * @param mixed $terms
     * @return PostBuilder
     */
    public function scopeTaxonomy($query, $taxonomy, $terms)
    {
        $query->whereHas('taxonomies', function ($query) use ($taxonomy, $terms) {
            $query->where('taxonomy', $taxonomy)
                ->whereHas('term', function ($query) use ($terms) {
                    $query->whereIn('slug', is_array($terms) ? $terms : [$terms]);
                });
        });
    }




    public function scopeSlug($query, $slug){
        $query->where('user_login',$slug);
    }




    public function scopeByTerm($query, $term){
        $query->where('user_nicename','%'.$term.'%')
            ->orWhere(function($query) use($term){
                $query->hasMetaLike('first_name','%'.$term.'%');
            })
            ->orWhere(function($query) use($term){
                $query->hasMetaLike('last_name','%'.$term.'%');
            })
            ->orWhere(function($query) use($term){
                $query->hasMetaLike('nickname','%'.$term.'%');
            });
    }


    public function scopeSocis($query){

        $query->hasMeta('es_soci',1);

    }


    public static function scopeJunta($query){
        $query->hasMeta('es_junta',1);
    }




    public static function getBySlug($soci_slug){
        $user=self::slug($soci_slug)->first();
        if(!$user) abort(404, "No s'ha trobat l'usuari");
        return $user;
    }




    public function biografia($nl2br=false){
        $ret= $this->acf->text('soci_biografia');
        if($nl2br) $ret=nl2br($ret);
        return $ret;
    }


    public function emailContacte(){
        return $this->acf->text('soci_email');
    }

    public function web(){
        return $this->acf->text('soci_web');
    }

    public function displayName(){
        $display=$this->acf->text('display_name');
        if($display=="full_name") return implode(" ",[$this->first_name,$this->last_name]);
        else return isset($this->{$display})?$this->{$display}:$this->nickname;
    }

    public function get_display(){
        return $this->acf->select('display_name','nickname');
    }

    public function galeria(){
        return $this->acf->gallery('galeria');
    }

    public function hasProfileImage(){
        $image= $this->profileImage();
        return $image && $image->url!=null;
    }
    public function profileImage(){
        return $this->acf->image('profile_picture');
    }

    public function hasFeaturedImage(){
        $image= $this->featuredImage();
        return $image && $image->url!=null;
    }
    
    public function featuredImage(){
        return $this->acf->image('featured_image');
    }


    private function getACField($field_name){
        //GET acf/v3/users/user_id/field_name
        $response=$this->api_client->request('GET', 'acf/v3/users/'.$this->ID.'/'.$field_name,
            [
                'auth' => [
                    config('ait.wordpress.user'),
                    config('ait.wordpress.password')
                ]
            ]
        );
        return json_decode($response->getBody()->getContents())->{$field_name};

    }

    public static function createUser($form_params=[]){
        $tmpuser=new User();
        $response=$tmpuser->api_client->request('POST', 'wp/v2/users',[
            'auth' => [
                config('ait.wordpress.user'),
                config('ait.wordpress.password')
            ],
            'form_params' => $form_params
        ]);
        return $response;
    }

    public function updatePassword($password){
        
        // Log::debug("Calling to url: wp/v2/users/".$this->ID);
        // Log::debug("Options:");
        // Log::debug($args);
		
        $response=$this->api_client->request('POST', 'wp/v2/users/'.$this->ID,[
            'auth' => [
                config('ait.wordpress.user'),
                config('ait.wordpress.password')
            ],
            'form_params' => [
                'password' => $password
            ]
        ]);

        // Log::debug( "STATUS:".$response->getStatusCode() );
        // Log::debug("BODY:");
        // Log::debug($response->getBody());

        return $response;

    }

    public function setACFields($fields){
        return  $this->api_client->request('POST', 'acf/v3/users/'.$this->ID,
            [
                'auth' => [
                    config('ait.wordpress.user'),
                    config('ait.wordpress.password')
                ],
                'form_params' => [
                    'fields' => $fields
                ]
            ]
        );
    }


    public function setACField($field_name, $value){
        return  $this->setACFields([
            $field_name => $value
        ]);
    }


    public function disciplines(){
       return $this->getACField('disciplines');
    }




    public function renderProfileImage($options=[]){
        return $this->renderImage($this->profileImage(), $options);
    }


    public function renderFeaturedImage($options=[]){
        return $this->renderImage($this->featuredImage(), $options);

    }



    protected function getImageOptions($options=[]){
        if(!is_array($options)) $options=[];

        $defaults=[
            "size" => "medium",
            "class" => "",
            "title" => $this->display_name,
        ];

        $options=array_merge($defaults,$options);
        $options["size"] = config('ait.sizes.'.$options["size"]);

        return $options;

    }


    protected function getImageSrc($image, $options=[]){
        $imgsrc=asset('img/pencil-placeholder.png');
        if($image && $image->url){
            if($options["size"]=="full" || $image->mime_type=="image/gif"){
                $imgsrc=$image->url;
            }else{
                $imgsrc=$image->size($options["size"])->url;
                
            }
            if(!$imgsrc) $imgsrc=$image->url;
        }

        return $imgsrc;
    }




    public function getFeaturedImageSrc( $options=[]){
        // dump($options);
        
        $image=$this->featuredImage();
        $options=$this->getImageOptions($options);
        
        return $this->getImageSrc($image, $options);
        // die();
    }


    public function renderImage($image, $options=[]){
        // dump($options);
        $options=$this->getImageOptions($options);
        // dump($options);
        $imgsrc=$this->getImageSrc($image, $options);    
        return '<img src="'. $imgsrc. '" class="'.$options["class"].'" alt="'.$options["title"].'">';
    }




    public function sortPictures($picture_type, $image_ids=[]){
        $this->saveImageIds($picture_type, $image_ids);
        return [
            "status"=>"success"
        ];
    }

    public function removePicture($picture_type, $image_id=null){
        if($image_id){
            $image_ids=$this->getCurrentImageIds($picture_type);
            // dump($image_id);
            $image_ids=array_diff( $image_ids, [$image_id] );
            // dd($image_ids);
            if($image_ids){
                $this->saveImageIds($picture_type, $image_ids);
            }else{
                $this->saveMeta([$picture_type=>null]);

            }

            return [
                "status"=>"success",
                "removed" => $image_id
            ];

        }else{
            $this->saveMeta([$picture_type=>null]);
            return [
                "status"=>"success"
            ];
        }


    }


    protected function saveImageIds($picture_type,$image_ids){
        return $this->setACField($picture_type,$image_ids);
    }

    protected function getCurrentImageIds($picture_type){
        $current=$this->acf->gallery($picture_type);
        $image_ids=[];
        if($current){
            $image_ids=$current->pluck('attachment.ID')->toArray();
        }
        return $image_ids;

    }


    protected function errorMessage($code, $name=""){
        $message="Error desconegut";

        switch($code){
            case 415: $message= __("El format de l'arxiu <strong>:name</strong> no és correcte. Només pots pujar imatges JPG, PNG o GIF.",["name"=>$name]); break;
            case 413: $message= __("La mida de l'arxiu <strong>:name</strong> és massa gran. Només pots pujar arxius de fins a 3MB.",["name"=>$name]); break;
            default:break;
        }

        return to_object([
            "code"=>$code,
            "message"=>$message
        ]);

    }
    public function uploadPicture($picture_type, Request $request){


        $size= config("ait.sizes.medium");

        // if($request->multiple){
        //     $uploaded_images=[];
        //     $errors=[];
        //     foreach($request->file as $file){

        //         $pic=$this->doUploadPicture($file);
        //         if(is_int($pic)){
        //             $error=$this->errorMessage($pic,$file->getClientOriginalName());

        //             $errors[]= $error->message;//$file->getClientOriginalName();
        //         }else{
        //             $uploaded_images[]=$pic;
        //         }
        //     }



        //     $image_ids=$this->getCurrentImageIds($picture_type);

        //     $retimages=[];

        //     foreach($uploaded_images as $uploaded_image){
        //         $image_ids[]=$uploaded_image->id;
        //         $imageurl=isset($uploaded_image->media_details->sizes->{$size})? $uploaded_image->media_details->sizes->{$size}->source_url:$uploaded_image->source_url;

        //         $retimages[]=[
        //             "id"=>$uploaded_image->id,
        //             "url"=>$imageurl,
        //         ];
        //     }


        //     try{

        //         $this->saveImageIds($picture_type, $image_ids);

        //         return [
        //             "status"=>"success",
        //             "images" => $retimages,
        //             "errors" => $errors
        //         ];
        //     }  catch(Exception $e){
        //         //dd($e);
        //     }

        // }else{
            $image=$this->doUploadPicture($request->file);
            if($image){
                if(is_int($image)){
                    $error=$this->errorMessage($image);
                    abort($error->code, $error->message);
                }else{
                    if($request->multiple){
                        $image_ids=$this->getCurrentImageIds($picture_type);
                        $image_ids[]=$image->id;
                        $this->saveImageIds($picture_type, $image_ids);
                    }else{
                        $this->saveMeta([$picture_type=>$image->id]);
                    }

                    $imageurl = isset($image->media_details->sizes->{$size})? $image->media_details->sizes->{$size}->source_url:$image->source_url;
                    return [
                        "status"=>"success",
                        "imageurl" => $imageurl,
                        "imageid" => $image->id
                    ];
                }
            }else{
                $error=$this->errorMessage(400);
                abort($error->code, $error->message);
            }

        // }






    }


    private function doUploadPicture($file){
        $fileName=$file->getClientOriginalName();

        if($file->getSize() > $this->max_file_size) return 413;

        if(!in_array($file->getMimeType(), $this->valid_mimes)) return 415;

        $fileContent = File::get($file->path());
        try{

            //subo el archivo
            //POST /wp-json/wp/v2/media
            //form data : file
            $response=$this->api_client->request('POST', 'wp/v2/media', [
                'auth' => [
                    config('ait.wordpress.user'),
                    config('ait.wordpress.password')
                ],
                "multipart"=>[
                    [
                        'name' => 'file',
                        'contents' => $fileContent,
                        'filename' => $fileName,
                    ],
                    [
                        'name' => 'author',
                        'contents' => $this->ID,
                    ]

                ]
            ]);

            $image=json_decode($response->getBody()->getContents());
            return $image;

        }catch(Exception $e){
            return $e;
        }
    }


    public function saveRest($fields){
        $this->setACFields($fields);
    }

    public function saveAll($fields){
        $rest=[];
        $api=[];

        foreach($fields as $key=>$value){
            if(in_array($key, $this->rest_fields)) $rest[$key]=$value;
            if(in_array($key, $this->api_fields)) $api[$key]=$value;
        }
        $this->saveMeta($api);
        $this->saveRest($rest);

    }
}
