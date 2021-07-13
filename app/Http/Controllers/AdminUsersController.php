<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\BL\AdminBL;
use App\Enums\SaveResult;

class AdminUsersController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (count($request->all()) <= 1) {
            $users = Admin::query()->join('users',function ($join){
                $join->on('admins.user_id', '=', 'users.id')->where('users.role_id','=',1);
            })->paginate(5);
        }
        else {
            $query = AdminBL::searchUsers($request->all());
            $users = $query->paginate(5);
            if($users->items() == null){
                return redirect()->route('adminUsers')->with('error', 'Ningún usuario coincide con el criterio de búsqueda. Intente de nuevo.');
            }
            else{
                $users->appends([
                    'name' => ($request->name == null?'':$request->name)
                ]);
            }
            $request->flash();
        }

        return view('adminusers.index',[
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminusers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = AdminBL::createUser($request->all());

        switch ($result) {
            case SaveResult::SUCCESS:
                return redirect()->route('adminUsers')->with('sucess', 'Usuario creado correctamente.');
            case SaveResult::INTERNAL_ERROR:
                return redirect()->route('adminUsers')->with('error', 'El usuario no pudo ser creado.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = AdminBL::deleteAdmin($id);

        if ($result) {
            return redirect()->route('adminUsers')->with('sucess', 'Usuario eliminada.');
        }
        else {
            return redirect()->route('adminUsers')->with('error', 'El usuario no pudo ser eliminado.');
        }
    }
}
