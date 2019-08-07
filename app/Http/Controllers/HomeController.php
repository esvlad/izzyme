<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function auth()
    {
      if(Role::user_role(Auth::id()) != 'partner'){
        return redirect('/admin');
      } else return redirect('/partners');
    }
}
