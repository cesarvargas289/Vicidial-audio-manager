<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Campaign;
use Illuminate\Support\Facades\Auth;
use App\Campaign_User;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $userId = Auth::id();
        $usuarios = User::all();
        $campaigns= Campaign::all();
        $campaigns_user = Campaign_User::all();

        return view('adminlte::home', compact('usuarios', 'campaigns', 'userId', 'campaigns_user'));
    }
}