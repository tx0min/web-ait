<?php

namespace App\Http\Controllers;

use App\Http\Requests\SociValidate;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackController extends Controller
{
    public function index()
    {
        $user=Auth::user();
        return view('backend', compact('user'));
    }


    public function uploadProfilePicture(Request $request){
        dd($request->all());

        //basic auth admin 

        //subo el archivo
        //POST /wp-json/wp/v2/media
        //form data : file

        //Con el ID recogido, modifico el usuario
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
