<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class DashboardController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // access to login person id
        $user_id =auth()->user()->id;
        $user =User::find($user_id);
        // can buring multiple wih
        return view('dashboard')->with('posts',$user->posts)->with('cvs',$user->cvs);

    }
}
