<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Http\Requests;
use DB;
use Hash;
use Validator;
use Auth;


class NewsController extends Controller
{	
	/**
     * Display all news with infinity Scroll.
     * Display all tags
     * 
     *
     */

	public function getNews(Request $request)
    {   
    	$posts = Post::paginate(6);
        $tags = Tag::all();

    	if ($request->ajax()) {
    		$view = view('news.data',compact('posts'))->render();
            return response()->json(['html'=>$view]);
        }

    	return view('news.post',compact('posts', 'tags'));
    }

     /**
     * Display detail of a news.
     *
     * 
     *
     */
    public function getDetail($slug)
    {
        $detail = Post::where('slug',$slug)->get()->first();
        $tags = Tag::all();
        return view('news.detail',compact('detail','tags'));
    }


     /**
     * Display category of a news.
     *
     * 
     *
     */
    public function getCategory($slug)
    {
        
    }
}
