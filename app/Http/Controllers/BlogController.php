<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Corcel\Model\Post;
use Corcel\Model\Option;
use Corcel\Model\Taxonomy;
use Exception;

class BlogController extends Controller
{

   

    public static $excluded_categories=["sin-categoria","uncategorized"];

    public function search(Request $request){
        return $this->blog($request->category, $request->term);
        
    }


   
    public function post($post_slug){
        $post=Post::slug($post_slug)->first();
        if(!$post) abort(404);
        return view('post', compact('post'));
    }



    public function category($category){
        return $this->blog($category);
    }



    public function blog($category=null, $term=null){

        $categories = Taxonomy::where('taxonomy', 'category')->get()->filter(function($category){
            return !in_array($category->slug, self::$excluded_categories);
        });

        // dd($categories);
        
       
        

        $posts=Post::type('post')->newest()->published();
        
        
        if($category){
            $posts=$posts->taxonomy('category', $category);
        }
        if($term){
            $posts=$posts->where(function($query) use ($term){
                $query->where('post_title', 'like', '%'.$term.'%')
                    ->orWhere('post_content','like', '%'.$term.'%');
            });
        }
        // dump(fullquery($posts));

        $posts=$posts->simplePaginate(10);

        // dd($posts);
        return view('blog', compact('posts','categories','term','category'));
        
    }

}
