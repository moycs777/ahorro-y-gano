<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\user\category;
use App\Promotion;
use App\Model\user\tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /*public function index()
    {
        $posts = post::where('status',1)->orderBy('created_at','DESC')->paginate(5);
        return view('user.blog',compact('posts'));
    }*/
    public function index()
    {
        $ofertas = Promotion::where('id', '>=', 1)->orderBy('created_at','DESC')->paginate(5);
        return view('user.index',compact('ofertas'));
    }

    /*public function tag(tag $tag)
    {
        $posts = $tag->posts();
        return view('user.blog',compact('posts'));
    }

    public function category(category $category)
    {
        $posts = $category->posts();
        return view('user.blog',compact('posts'));
    }*/
}
