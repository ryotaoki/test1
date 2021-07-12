<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // go to Home
    public function index(){
        $title = 'Welcome to Career Finder';
        return view('pages.index')->with('title', $title);
    }
    // go to about page
    public function about(){
        $title ='About us';
        return view('pages.about')->with('title',$title);
    }
    // go to service page
    public function services(){
        $data =array(
            'title' => 'Our Services',
            'services' => ['Find Company', 'Find Review', 'Find Salary','Prefession','Find Job'],

        );

        return view('pages.services')->with($data);
    }

}
