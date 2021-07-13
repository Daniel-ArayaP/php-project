<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Auth;

class WebPageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $viewRedir = route(Auth::user()->getIndexPage());

        $infogeneral = DB::table('forum_posts')
        ->join('person_profiles', 'forum_posts.create_by','=','person_profiles.id')
        ->select('person_profiles.first_name', 'person_profiles.last_name1', 'forum_posts.*')
        ->whereIn('forum_posts.id', [24,28,29])
        ->get();
        
        return view('layouts.pagWeb', ['infogeneral' => $infogeneral,'serviceDir' => $viewRedir]);
    }
}