<?php

namespace App\Http\Controllers;

use App\BL\RegistroBL;
use App\Http\Middleware\Registro;
use App\Models\RegistroUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\BL\AdminBL;
use App\Enums\SaveResult;
use DB;

class RegisterUsersController extends Controller
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

        if (count($request->all()) < 1) {
            $users = Admin::query()->join('users',function ($join){
                $join->on('admins.user_id', '=', 'users.id')->where('users.role_id','=',5);
            })->paginate(10);
        }
        else {
            $query = RegistroBL::searchUsers($request->all());
            $users = $query->paginate(5);
            if($users->items() == null){
                return redirect()->route('registerUsers')->with('error', 'Ningún usuario coincide con el criterio de búsqueda. Intente de nuevo.');
            }
            else{
                $users->appends([
                    'name' => ($request->name == null?'':$request->name)
                ]);
            }
            $request->flash();
        }

        return view('registerusers.index',[
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
        return view('registerusers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = RegistroBL::createUser($request->all());

        switch ($result) {
            case SaveResult::SUCCESS:
                return redirect()->route('registerUsers')->with('sucess', 'Usuario creado correctamente.');
            case SaveResult::INTERNAL_ERROR:
                return redirect()->route('registerUsers')->with('error', 'El usuario no pudo ser creado.');
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
        $result = RegistroBL::deleteAdmin($id);

        if ($result) {
            return redirect()->route('registerUsers')->with('sucess', 'Usuario eliminada.');
        }
        else {
            return redirect()->route('registerUsers')->with('error', 'El usuario no pudo ser eliminado.');
        }
    }
}
