<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Corcel\Model\Post;
use App\User;
use Corcel\Acf\Field\Image;

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
        return view('home', compact('slides','behaviour'));
    }

    public function socis($soci_slug=null){
        if($soci_slug){
            $user=User::getBySlug($soci_slug);
            return view('soci', compact('user'));
        }else{
            $users=User::getSocis();
            return view('socis', compact('users'));
        }
    }


    public function blog($post_slug=null){
        if($post_slug){
            $post=Post::slug($post_slug)->first();
            if(!$post) abort(404);
            return view('post', compact('post'));
        }else{
            $posts=Post::type('post')->published()->paginate();
            return view('blog', compact('posts'));
        }
    }

    public function associacio(){
        $page=Post::slug(config('ait.pages.associacio'))->first();
        return view('associacio', compact('page'));
    }

    public function festeSoci(){

        $page=Post::slug(config('fes-te-soci'))->first();

        return view('fes-te-soci',compact('page'));
    }
}
