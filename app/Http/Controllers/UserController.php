<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Campaign_User;
use App\Http\Requests;
use App\Rol_User;
use App\Role;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;


class UserController extends Controller
{
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
        $request->user()->authorizeRoles('admin');

        $usuarios = User::all();
        $roles = Role::all();
        $rol_de_usuarios = Rol_User::all();
        $campaigns_user = Campaign_User::all();
        $campaigns= Campaign::all();
        $campanas ='';
        return view('user.index', compact('usuarios', 'roles', 'rol_de_usuarios', 'campaigns_user', 'campaigns', 'campanas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles('admin');
        $usuarios = User::all();
        $roles = Role::all();
        $rol_de_usuarios = Rol_User::all();
        $campaigns = Campaign::all();
        return view('user.create', compact('usuarios', 'roles', 'rol_de_usuarios', 'campaigns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->authorizeRoles('admin');
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',

        ]);
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        //Asignación de roles al usuario en tabla intermedia
        $user_id =DB::getPdo()->lastInsertId();
        $rol = Input::get('rol');
        $rol_id = DB::table('roles')->where('name', $rol)->value('id');
        Rol_User::create(['role_id'=>$rol_id, 'user_id'=>$user_id]);

        //Asignación de campañas a el usuario en tabla intermedia
        foreach(Input::get('campaigns') as $campaigns){
        $campaign_id = DB::table('campaigns')->where('name', $campaigns)->value('id');
        Campaign_User::create(['campaign_id'=>$campaign_id, 'user_id'=>$user_id]);
            }

        //Redireccionar
        Return redirect()->route('user.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $request->user()->authorizeRoles('admin');

        $user = User::findOrFail($id);
        $campaigns = Campaign::orderBy('name')->pluck('name', 'id');
        $roles = Role::all();
        $roles_user = Rol_User::all();
        $selectedvalue_rol = DB::table('role_user')->where('user_id', $id)->value('role_id');
        $campaigns_user = Campaign_User::all();
        $selectedvalue_campaign = array();
        foreach ($campaigns_user as $campaign_user){
            if($id == $campaign_user->user_id ){
                $selectedvalue_campaign[$campaign_user->id]= $campaign_user->campaign_id;
            }
        }

        return view('user.edit', compact('user', 'campaigns', 'roles', 'roles_user', 'selectedvalue_rol', 'campaigns_user', 'selectedvalue_campaign', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $password = Input::get('password');

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',

        ]);

        //Se verifica si el password esta encriptado si lo está, actualiza todo menos el password si no, encripta el password y actualiza
        if( strlen($password) == 60 ){
            User::findOrFail($id)->update($request->except('password'));
        }else{
            User::findOrFail($id)->update($request->all());
            User::findOrFail($id)->update( [
                    'password' => bcrypt($request['password']),
                ]
            );
        }


        //Función para eliminar los registros en la tabla intermedia
        $campaign_users= Campaign_User::all();
        foreach ($campaign_users as $campaign_user){
            $deletedRows = Campaign_User::where('user_id', $id)->delete();
        }

        //Función para agregar nuevos registros en la tabla intermedia
        $user_id = Campaign_User::all()->pluck('user_id')->toArray();
        foreach (Input::get('campaigns') as $campaign){
            if(in_array($id, $user_id)){
                Campaign_User::updateOrCreate(['campaign_id'=>$campaign, 'user_id'=>$id]);
            }else{
                Campaign_User::create(['campaign_id'=>$campaign, 'user_id'=>$id]);
            }
        }

        //Actualizacion de rol al usuario en tabla intermedia
        $rol = Input::get('rol');
        Rol_User::where('user_id', $id)->update(['role_id' => $rol]);


        //Redireccionamos
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->user()->authorizeRoles('admin');
        User::findOrFail($id)->delete();
        $id_role = DB::table('role_user')->where('user_id', $id)->value('id');
        //Borra la relación en tabla role_user entre usuario y rol
        Rol_User::findOrFail($id_role)->delete();
        $campaign_users= Campaign_User::all();
        foreach ($campaign_users as $campaign_user){
            $deletedRows = Campaign_User::where('user_id', $id)->delete();
        }
        //Redireccionar
        return redirect()->route('user.index');
    }
}
