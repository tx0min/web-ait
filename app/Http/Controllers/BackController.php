<?php

namespace App\Http\Controllers;

use App\Http\Requests\SociValidate;
use Corcel\Model\Taxonomy;
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

        //dump($display);
        $display_options=[
            // "user_login" => "Username",
            "nickname" => "Alias",
            "first_name" => "Nom",
            "full_name" => "Nom i Cognoms",
        ];

        $disciplines= Taxonomy::where('taxonomy', 'disciplines')->get();
        $user_disciplines= $user->disciplines();
        $user_disciplines_ids= collect($user_disciplines)->pluck('term_id')->toArray();
        // dd($disciplines);
        return view('backend', compact('user','display_options','disciplines','user_disciplines','user_disciplines_ids'));
    }



    public function removePicture($picture_type, $image_id=null, Request $request){
        try{
            $user=Auth::user();
            return $user->removePicture($picture_type, $image_id);
        }catch(Exception $e){
            abort(500, "No s'ha pogut esborrar la imatge");
        }
    }

    public function sortPictures($picture_type, Request $request){
        try{
            $user=Auth::user();
            // dd($request->all());
            return $user->sortPictures($picture_type, $request->ids);
        }catch(Exception $e){
            abort(500, "No s'han pogut reordenar les imatges");
        }
    }

    public function uploadPicture($picture_type, Request $request){
        // try{
            $user=Auth::user();
            return $user->uploadPicture($picture_type, $request);
        // }catch(Exception $e){
        //     return $e;
        //     // dd($e);
        //     // abort(500, "Error uploading image");
        // }
    }




    /**
     * Guarda los campos del usuario
     * Las imagenes se hacen aparta
     */
    public function save(SociValidate $request)
    {
        try{
            // dd($request->all());
            $user=Auth::user();
            // dd($user);
            // dd($request->all());
            $user->saveAll($request->all());
            if($request->new_password){
                $ret=$user->updatePassword($request->new_password);
                // dd($ret);
                
            }
            
            return redirect()
                ->route('backend')
                ->with(['success'=>"El perfil s'ha guardat correctament!"]);

        }catch(Exception $e){
            dd($e);
            return redirect()
                ->route('backend')
                ->with(['error'=>"Hi ha hagut algun error guardant el perfil..."]);
        }
    }
}
