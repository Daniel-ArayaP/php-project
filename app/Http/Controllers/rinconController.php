<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class rinconController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    private function getForumTitles() 
    {
        $forum_titles = DB::table('forum_titles')->get();
        return $forum_titles;

    }


    public function index(Request $request)
    {

        $infogeneral = DB::table('forum_posts')
        ->join('person_profiles', 'forum_posts.create_by','=','person_profiles.id')
        ->select('person_profiles.first_name', 'person_profiles.last_name1', 'forum_posts.*')
        ->where('forum_posts.id', '=', 30)
        ->get();

        return view('rincon.inicio',['mainPage' => $infogeneral, 'menu_izq' => $this->getForumTitles() ]);
    }



}