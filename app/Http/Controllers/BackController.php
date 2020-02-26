<?php

namespace App\Http\Controllers;

use App\Http\Requests\SociValidate;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use File;

use Illuminate\Support\Facades\Auth;

class BackController extends Controller
{
    
    protected $client=null;


    public function index()
    {
        $user=Auth::user();

        return view('backend', compact('user'));
    }

    

    public function removePicture($picture_type, $image_id=null, Request $request){
        try{
            $user=Auth::user();
            return $user->removePicture($picture_type, $image_id);
        }catch(Exception $e){
            abort(500, "Error removing image");
        }  
    }

    public function sortPictures($picture_type, Request $request){
        try{
            $user=Auth::user();
            // dd($request->all());
            return $user->sortPictures($picture_type, $request->ids);
        }catch(Exception $e){
            abort(500, "Error sorting images");
        }    
    }
    
    public function uploadPicture($picture_type, Request $request){
        try{
            $user=Auth::user();
            return $user->uploadPicture($picture_type, $request);
        }catch(Exception $e){
            abort(500, "Error uploading image");
        }    
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
