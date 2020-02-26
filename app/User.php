<?php

namespace App;

use Corcel\Model\User as CorcelUser;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use File;


class User extends CorcelUser
{

    protected $api_client;


    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->api_client = new Client([
			'base_uri' => config('ait.wordpress.url'),
			'verify' =>false
		]);
    }



    public static function getSocis(){
        return self::all()->filter(function($user){
            return $user->acf->boolean('es_soci');
        });
    }

    public static function getMembresJunta(){
        return self::all()->filter(function($user){
            return $user->acf->boolean('es_junta');
        });
    }


    public static function getBySlug($soci_slug){
        $user=self::where('user_login',$soci_slug)->first();
        if(!$user) abort(404, "User not found");
        return $user;
    }




    public function biografia(){
        return $this->acf->text('soci_biografia');
    }


    public function email(){
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

    public function renderProfileImage($options=[]){
        return $this->renderImage($this->profileImage(), $options);
    }

    public function renderFeaturedImage($options=[]){
        return $this->renderImage($this->featuredImage(), $options);

    }

    public function renderDisplayOptions(){
        $display=$this->acf->select('display_name');
        //dump($display);
        $options=[
            "user_login" => "Username",
            "nickname" => "Alias",
            "first_name" => "Nom",
            "full_name" => "Nom i Cognoms",
        ];

        $ret='<select class="custom-select" id="f_display_name" name="display_name">';
        foreach($options as $key=>$option){
            $ret.="<option ".(($key==$display)?"selected":"")." value='".$key."'>".$option."</option>";
        }
        $ret.="</select>";
        return $ret;
    }
    public function renderImage($image, $options=[]){
        // dump($image);
        if(!is_array($options)) $options=[];

        $defaults=[
            "size" => "square-medium",
            "class" => "",
            "title" => $this->display_name,
        ];

        $options=array_merge($defaults,$options);


        if($image && $image->url){
            if($image->mime_type=="image/gif"){
                $imgsrc=$image->url;
            }else{
                $imgsrc=$image->size($options["size"])->url;
            }
            if(!$imgsrc) $imgsrc=$image->url;
        }else{
            $imgsrc=asset('img/pencil-placeholder.png');
        }

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
        return  $this->api_client->request('POST', 'acf/v3/users/'.$this->ID,
            [
                'auth' => [
                    config('ait.wordpress.user'),
                    config('ait.wordpress.password')
                ],
                'form_params' => [
                    'fields' => [
                        $picture_type => $image_ids
                    ]
                ]
            ]
        );
    }

    protected function getCurrentImageIds($picture_type){
        $current=$this->acf->gallery($picture_type);
        $image_ids=[];
        if($current){
            $image_ids=$current->pluck('attachment.ID')->toArray();
        }
        return $image_ids;

    }
    public function uploadPicture($picture_type, Request $request){


        $size="square-medium";

        if($request->multiple){
            $uploaded_images=[];
            foreach($request->file as $file){
                $uploaded_images[]=$this->doUploadPicture($file);
            }



            $image_ids=$this->getCurrentImageIds($picture_type);

            $retimages=[];

            foreach($uploaded_images as $uploaded_image){
                $image_ids[]=$uploaded_image->id;
                $imageurl=isset($uploaded_image->media_details->sizes->{$size})? $uploaded_image->media_details->sizes->{$size}->source_url:$uploaded_image->source_url;

                $retimages[]=[
                    "id"=>$uploaded_image->id,
                    "url"=>$imageurl,
                ];
            }


            try{

                $this->saveImageIds($picture_type, $image_ids);

                return [
                    "status"=>"success",
                    "images" => $retimages
                ];
            }  catch(Exception $e){
                //dd($e);
            }

        }else{
            $image=$this->doUploadPicture($request->file);

            $this->saveMeta([$picture_type=>$image->id]);

            $imageurl=isset($image->media_details->sizes->{$size})? $image->media_details->sizes->{$size}->source_url:$image->source_url;
            return [
                "status"=>"success",
                "imageurl" => $imageurl,
                "imageid" => $image->id
            ];
        }






    }


    private function doUploadPicture($file){
        $fileName=$file->getClientOriginalName();
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
}
