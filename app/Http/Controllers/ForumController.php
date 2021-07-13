<?php

namespace App\Http\Controllers;

use DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests\CreateAdminForumCategoryRequest;
use App\Http\Requests\CreateAdminForumTitleRequest;
use App\Http\Requests\CreateAdminForumPostRequest;
use App\Http\Requests\CreateAdminForumReplyRequest;

use App\Models\Admin;
use App\Models\Student;
use App\Models\AdminForumCategory;
use App\Models\AdminForumTitles;
use App\Models\AdminForumPosts;
use App\Models\AdminForumReplies;

class ForumController extends Controller
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

    private function getProfileUserID() 
    {
        switch (Auth::user()->role_id) 
        {
            case '1':   return Admin::where('user_id', Auth::user()->id)->first();    
            case '2':   return Student::where('user_id', Auth::user()->id)->first();
            default:    return 0;
        }
    }

    private function getForumTitles() 
    {
        $forum_titles = DB::table('forum_titles')->get();
        return $forum_titles;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forum_categories = DB::table('forum_categories')->get();
        foreach ($forum_categories as $index => $cat) 
        {
            if (!isset($cat->{"titles"})) 
            {
                $cat->{"titles"} = [];
            }
            $forum_titles = DB::table('forum_titles')->where('parent_category_id','=',$cat->category_id)->get();

            foreach ($forum_titles as $index => $title)
            {
                if (!isset($title->{"latestPost"})) 
                {
                    $title->{"latestPost"} = [];
                }

                $posts = DB::table('forum_posts')
                ->join('person_profiles', 'forum_posts.create_by','=','person_profiles.id')
                ->select('person_profiles.first_name', 'person_profiles.last_name1', 'forum_posts.post_title', 'forum_posts.id',
                'forum_posts.created_at')
                ->where('forum_posts.parent_title_id','=',$title->id)
                ->latest('forum_posts.id')
                ->first();

                $title->{"latestPost"} = $posts;
            }


            $cat->{"titles"} =  (array)$forum_titles;
        }
        
        return view('Forum.index', [
            "userID"=>$this->getProfileUserID()->person_profile_id,
            "forum_categories" => $forum_categories,
            "menu_izq" => $this->getForumTitles(),
            ]
        );
    }

  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSearch()
    {
        $search = Input::get('search');

        $forum_posts = 
            DB::table('forum_posts')
            ->join('person_profiles', 'forum_posts.create_by','=','person_profiles.id')
            ->select('person_profiles.first_name', 'person_profiles.last_name1', 'forum_posts.*')
            ->where('post_title', 'like', "%".$search."%")
            ->get();
        
        return view('Forum.search', [
            "forum_posts" => $forum_posts,
            "menu_izq" => $this->getForumTitles(),
            ]
        );
    }

    public function editForumCategroies(Request $request) 
    {
        $cat = AdminForumCategory::where('category_id','=',$request->id)->first();
        return view('Forum.editCat', ["category" => $cat,"menu_izq" => $this->getForumTitles(),]);        
    }

    public function editForumTitles(Request $request) {
        $forum_categories = DB::table('forum_categories')->get();
        $titulo = AdminForumTitles::where('id','=',$request->id)->first();
        return view('Forum.editTitle', ["title" => $titulo, "categorias" => $forum_categories,"menu_izq" => $this->getForumTitles(),]);        
    }

    public function editForumPost(Request $request) 
    {

        $post = DB::table('forum_posts')
            ->where('forum_posts.id','=',$request->id)->first();

        return view('Forum.editPost', [
            "userID"=>$this->getProfileUserID()->person_profile_id,
            "post"=>$post,
            "menu_izq" => $this->getForumTitles(),
        ]);
    }

    public function downloadFiles($id)
    {        
        $tmp=DB::table('forum_posts')->where('id',$id)->value('file_path');

        $storage_path = storage_path();
        $url = $storage_path . '/app/rinconAcademico/' . $tmp;
        if (\Storage::exists('rinconAcademico/' . $tmp)) {
            return response()->download($url);
        } else {
            return redirect()->route('trainingList')->with('error', 'Error en econtrar el archivo');
        }
    }


    public function updateForumCategory(AdminForumCategory $cat, CreateAdminForumCategoryRequest $request)
    {
        $cat->category_name= request()->category_name;
        $cat->role_visibilite= request()->role_visibilite;
        $cat->save();
        \Session::flash('flash_message', 'Datos actualizados correctamente');
        return Redirect('adminForumCategroies');
    }

    public function updateForumTitle(AdminForumTitles $title, CreateAdminForumTitleRequest $request)
    {
        $title->parent_category_id= request()->parent_cat_id;
        $title->title= request()->title;
        $title->description= request()->descripcion;
        $title->save();
        \Session::flash('flash_message', 'Datos actualizados correctamente');
        return Redirect('adminForumTitles');
    }

    public function updateForumPost(AdminForumPosts $id, CreateAdminForumPostRequest $request) 
    {        
        try {
            $id->post_title = request()->postName;
            $id->post_body = request()->content;
            $id->save();
            $replies = DB::table('forum_replies')
                ->join('person_profiles', 'forum_replies.created_by','=','person_profiles.id')
                ->select('person_profiles.first_name', 'person_profiles.last_name1', 'forum_replies.*')
                ->where('forum_replies.post_id','=',$id->id)->get();
            
                \Session::flash('flash_message', 'Datos actualizados correctamente');

            return view('Forum.replies', [
                "userID"=>$this->getProfileUserID(),
                "pid" => $id->id,
                "replies" => $replies,
                "post" => $id,
                "menu_izq" => $this->getForumTitles(),
            ]);
        } catch (\Exception $e) {
            \Session::flash('messagetext', request()->content);
            return $e->getMessage();
        }  
    }

    public function createForumCategory(CreateAdminForumCategoryRequest $request)
    {
        $cat=new AdminForumCategory;
        $cat->category_name= request()->category_name;
        $cat->role_visibilite= request()->role_visibilite;
        $cat->save();
        return Redirect('adminForumCategroies')->with('success', 'Los datos del curso se han guardado correctamente');
    }

    public function createForumTitle(CreateAdminForumTitleRequest $request)
    {
        $title=new AdminForumTitles;
        $title->parent_category_id= request()->parent_cat_id;
        $title->title= request()->title;
        $title->description= request()->descripcion;
        $title->save();
        return Redirect('adminForumTitles')->with('success', 'Los datos del curso se han guardado correctamente');
    }

    public function createForumPost(CreateAdminForumPostRequest $request)
    {
        $file_path = null;
 
        if (!is_null($request->file('file')))
        {
            $file = $request->file('file');
            $encrypt = (new \DateTime())->format('Y.m.d') . '.' . rand(0, 1000) . '.';
            $validatedData = Validator::make($request->all(), [
                'file' => 'max:500000',
            ]);

            if ($validatedData) 
            { 
                $name = $file->getClientOriginalName();
                \Storage::disk('local')->put($encrypt . $name, \File::get($file));
                \Storage::move($encrypt . $name, 'rinconAcademico/' . $encrypt . $name);
                $file_path = $encrypt . $name;
            } else {
                return Redirect('/forum/'. request()->title_id .'/titles')->with('error', 'el archivo no cumple con lo requerido');
            }
        }

        $post=new AdminForumPosts;
        $post->post_title= request()->postName;
        $post->post_body= request()->content;
        $post->create_by= request()->created_by;
        $post->parent_title_id = request()->title_id;
        $post->file_path = $file_path;
        $post->save();

        return Redirect('/forum/'. request()->title_id .'/titles')->with('success', 'Post creado exitosamente');
    }

    public function createForumReply(CreateAdminForumReplyRequest $request) 
    {
        $reply=new AdminForumReplies;
        $reply->post_id= request()->title_id;
        $reply->created_by= request()->created_by;
        $reply->reply_body= request()->content;
        $reply->save();

        return Redirect('/forum/'. request()->title_id .'/replies');
    }

    public function deleteForumCategroies(AdminForumCategory $cat) 
    {
        $cat->delete();
        return Redirect('adminForumCategroies');
    }

    public function deleteForumTitle(AdminForumTitles $title) 
    {
        $title->delete();
        return Redirect('adminForumTitles');
    }

    public function deleteForumPost(AdminForumPosts $pid) 
    {
        $tid = $pid->parent_title_id;
        $pid->delete();
        return Redirect('/forum/'. $tid .'/titles');
    }

    public function insertNewChat(Request $request) 
    {
        $insert = DB::table('chat')->insert(
            ['person_profile_id' => $request->uid, 'msg' => $request->msg]
        );
        echo 'ok';
    }

    public function adminCreateCategories() 
    {
        return view('Forum.createCat', [
            "menu_izq" => $this->getForumTitles(), 
        ]);
    }

    public function adminCreateTitle() 
    {
        $forum_categories = AdminForumCategory::all();
        return view('Forum.createTitle', [
            "categorias" => $forum_categories,
            "menu_izq" => $this->getForumTitles(),
        ]);
    }

    public function adminCategories() {
        $forum_categories = AdminForumCategory::all();
        return view('Forum.adminCat', [
            "categorias" => $forum_categories,
            "menu_izq" => $this->getForumTitles(),
        ]);
    }

    public function adminTitles() {
        $forum_titles = DB::table('forum_titles')
            ->join('forum_categories','forum_categories.category_id','=','forum_titles.parent_category_id')
            ->select('forum_titles.*', 'forum_categories.category_name')
            ->get();

        return view('Forum.adminTitles', [
            "titulos" => $forum_titles,
            "menu_izq" => $this->getForumTitles(),
        ]);
    }

    public function showTitles(Request $request) 
    {
        $title = AdminForumTitles::select('title')->where('id','=',$request->catid)->first();
        
        $posts = DB::table('forum_posts')
            ->join('person_profiles', 'forum_posts.create_by','=','person_profiles.id')
            ->select('person_profiles.first_name', 'person_profiles.last_name1', 'forum_posts.*')
            ->where('forum_posts.parent_title_id','=',$request->catid)
            ->latest('forum_posts.id')
            ->get();

        return view('Forum.posts', [
            "userID"=> $this->getProfileUserID()->person_profile_id,
            "category_title" => $title->title,
            "category_id" => $request->catid,
            "posts" => $posts,
            "menu_izq" => $this->getForumTitles(),
            ]
        );
    }

    public function generateForumPost(Request $request) 
    {
        return view('Forum.createPost', [
            "userID"=> $this->getProfileUserID()->person_profile_id,
            "tid" => $request->tid,
            "menu_izq" => $this->getForumTitles(),
        ]);        
    }

    public function generateForumReplies(Request $request) 
    {
        $post = DB::table('forum_posts')
            ->join('person_profiles', 'forum_posts.create_by','=','person_profiles.id')
            ->join('forum_titles', 'forum_posts.parent_title_id', '=', 'forum_titles.id')
            ->select('person_profiles.first_name', 'person_profiles.last_name1', 'forum_posts.*', 'forum_titles.title')
            ->where('forum_posts.id','=',$request->pid)->first();

        $replies = DB::table('forum_replies')
            ->join('person_profiles', 'forum_replies.created_by','=','person_profiles.id')
            ->select('person_profiles.first_name', 'person_profiles.last_name1', 'forum_replies.*')
            ->where('forum_replies.post_id','=',$request->pid)->get();

        return view('Forum.replies', [
            "userID"=>$this->getProfileUserID(),
            "pid" => $request->pid,
            "replies" => $replies,
            "post" => $post,
            "menu_izq" => $this->getForumTitles(),
        ]);        
    }
}
