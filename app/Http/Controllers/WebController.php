<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Corcel\Model\Post;
use App\User;
use Corcel\Acf\Field\Image;
use Corcel\Model\Option;
use Corcel\Model\Taxonomy;
use Exception;

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

    public function festeSoci(){

        $page=Post::slug(config('fes-te-soci'))->first();

        return view('fes-te-soci',compact('page'));
    }
}
