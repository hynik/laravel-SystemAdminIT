<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Router;
class UserController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $routers = Router::all();

        if ($user->isAdmin()) {
            
            return view('pages.admin.home');
            
        }
        // elseif ($user->hasRole('staff-it')){
        //     return view('routers.index', compact('routers'));
        // }

        return view('routers.index', compact('routers'));
    }
}
