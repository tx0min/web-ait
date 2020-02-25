<?php

namespace App\Http\Controllers;

use App\Http\Requests\SociValidate;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class BackController extends Controller
{
    
    protected $client=null;


    public function index()
    {
        $user=Auth::user();
        return view('backend', compact('user'));
    }


    private function doUploadPicture($file){
        $fileName=$file->getClientOriginalName();
        $fileContent = File::get($file->path());
        // dd($fileContent);
        try{
            // dd($client);
            
            //subo el archivo
            //POST /wp-json/wp/v2/media
            //form data : file

            $response=$this->client->request('POST', 'media', [
                'auth' => [
                    config('ait.wordpress.user'), 
                    config('ait.wordpress.password')
                ],
                "multipart"=>[
                    [
                        'name' => 'file',
                        'contents' => $fileContent,
                        'filename' => $fileName,
                    ]
                ]
            ]);

            // dd($response->getStatusCode());
            $image=json_decode($response->getBody()->getContents());
            return $image;

            //modifico las categorias del archivo
            
            
        }catch(Exception $e){
            dd($e);
        }
    }


    public function uploadPicture($picture_type, Request $request){
        // dump($picture_type);
        // dd($request->file);

        //basic auth admin 

        // sleep(10);

        $this->client = new Client([
			'base_uri' => config('ait.wordpress.url'),
			'verify' =>false
		]);
        
    //     $images=[];

    //    if(is_array($request->file)){
    //         foreach($request->file as $file){
    //             $images[]=$this->doUploadPicture($file);
    //         }
    //    }else{
            $image=$this->doUploadPicture($request->file);
    //    }
      
        // $ids=collect($images)->pluck('id')->toArray();
        // dd($ids);
        //Con el ID recogido, modifico el usuario
        $user=Auth::user();
        // dd($picture_type);
        // dd($image);
        // $currentimage=$user->meta->{$picture_type};
        // dd($currentimage);

        $user->saveMeta([$picture_type=>$image->id]);
        $size="square-medium";
        $imageurl=isset($image->media_details->sizes->{$size})? $image->media_details->sizes->{$size}->source_url:$image->source_url;
        return [
            "status"=>"success",
            "imageurl" => $imageurl
        ];
        //POST /wp-json/acf/v3/users/1?fields[profile_picture]
    }


    /** 
     * Guarda los campos del usuario
     * Las imagenes se hacen aparta
     */
    public function save(SociValidate $request)
    {
        try{
            //dd($request->all());
            $user=Auth::user();
            // dd($user);
            $user->saveMeta($request->all());
            
            return redirect()
                ->route('backend')
                ->with(['success'=>"ok"]);

        }catch(Exception $e){
            return redirect()
                ->route('backend')
                ->with(['error'=>"error"]); 
        }     
    }
}
