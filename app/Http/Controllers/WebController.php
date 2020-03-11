<?php

namespace App\Http\Controllers;

use App\Http\Requests\FesteSociValidate;
use App\Mail\PeticioAltaSoci;
use App\Models\AltaSoci;
use Illuminate\Http\Request;

use Corcel\Model\Post;
use App\User;
use Corcel\Acf\Field\Image;
use Corcel\Model\Option;
use Corcel\Model\Taxonomy;
use Exception;
use Illuminate\Support\Facades\Mail;

class WebController extends Controller
{

    public function home()
    {
        // $images=Post::type('page')->published()->get();
        $page=Post::slug(config('ait.pages.home'))->first();
        $behaviour = $page->acf->behaviour;
        $slides=$page->acf->repeater('images');
        // dd($behaviour);
        $slide=null;

        if($behaviour=="random"){
            $index=mt_rand(0,$slides->count()-1);
            // dump($index);
            $slides = $slides->slice($index,1);


        }
        // dd($slides);
        // dd($images);
        return view('home', compact('slides','behaviour','page'));
    }


    public function associacio(){
        $users=User::junta()->get();
        $page=Post::slug(config('ait.pages.associacio'))->first();
        return view('associacio', compact('page','users'));
    }

    public function wordpress(){
        $wp_api_url=config('ait.wordpress.url');
        if($wp_api_url){
            $wp_url=dirname($wp_api_url)."/wp-admin";
            // dd($wp_url);
            return redirect()->to($wp_url);
        }else{
            return redirect()->route('home');
        }
    }
    
    public function festeSoci(){

        $page=Post::slug(config('fes-te-soci'))->first();
        $disciplines= Taxonomy::where('taxonomy', 'disciplines')->get();
        
        return view('fes-te-soci',compact('page','disciplines'));
    }


    public function altaSoci(FesteSociValidate $request){
        // dd($request->all());
        $soci=new AltaSoci($request->all());
        $soci->save();
        $mailable=new PeticioAltaSoci($soci);
        
        try{
            // return $mailable;
            Mail::to(config('ait.email-alta-soci'))->send($mailable);
        
            return redirect()->route('fes-te-soci')->with(['success'=>"La teva sol·licitud s'ha enviat correctament. En breu ens posarem en contacte amb tu per confirmar la teva alta de soci."]);
        }catch(Exception $e){
            // dd($e);
            return redirect()
                ->route('fes-te-soci')
                ->with(['error'=>"Hi ha hagut algun enviant el correu..."]);
        }
    }
}
