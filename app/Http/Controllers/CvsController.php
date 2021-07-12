<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cv;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use DB;
use App\User;
use App\Post;



class CvsController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => []]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cvs= Cv::orderBy('id', 'desc')->paginate(6);
        return view('cvs.index')->with('cvs', $cvs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cvs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'main_skills' => 'required',
            'work_experience' => 'required',
            'education' => 'required',
            'cover_image' => 'image|nullable|max:1999',


        ]);

                      //Handle File upload
        if($request->hasFile('cover_image')){
        // get filename with the extension
         $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        //get just filename 
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //get just ext
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        //Filename to store 
        $filenameToStore = $filename.'_'.time().'.'.$extension;
        // upload image
        $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
        
        } else {
        $filenameToStore ='noimage.jpg';
        };


        // create cv

        $cv = new Cv;
        $cv->main_skills = $request->input('main_skills');
        $cv->user_id =auth()->user()->id;

        $cv->work_experience = $request->input('work_experience');
        $cv->education = $request->input('education');
        $cv->cover_image = $filenameToStore;

        $cv->save();

        return redirect('/cvs')->with('success', 'Your CV Created');




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cv= Cv::find($id);
        return view('cvs.show')->with('cv', $cv);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cv =Cv::find($id);
        //check for correct user
        if(auth()->user()->id !== $cv->user_id){
            return redirect('/cvs')->with('error','Unauthorized page');
        }

        return view('cvs.edit')->with('cv',$cv);
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
        $this->validate($request,[
            'main_skills' => 'required',
            'work_experience' => 'required',
            'education' => 'required',
            
            
        ]);

            //Handle File upload
        if($request->hasFile('cover_image')){
        // get filename with the extension
         $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        //get just filename 
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //get just ext
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        //Filename to store 
        $filenameToStore = $filename.'_'.time().'.'.$extension;
        // upload image
        $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
        
        }; 
        
        $cv = Cv::find($id);
        $cv->main_skills = $request->input('main_skills');
        $cv->work_experience = $request->input('work_experience');
        $cv->education = $request->input('education');
        if($request->hasFile('cover_image')){
            $cv->cover_image =$filenameToStore;    

        }    
        $cv->save();

        return redirect('/cvs')->with('success', 'Your CV Updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cv =Cv::find($id);
        //check for correct user
        if(auth()->user()->id !== $cv->user_id){
            return redirect('/cvs')->with('error','Unauthorized page');
        }
        if($cv->cover_image != 'noimage.jpg'){
            //delete image
            Storage::delete('public/cover_images/'.$cv->cover_image);
    
    
        }


        $cv->delete();
        return redirect('/cvs')->with('success', 'Your CV Removed');



    }

    public function search(Request $request){
        // $posts=Post::all();
        // $search=$request->input('search');


        //     if($search != ""){
        //         // $user = User::where ( 'name', 'LIKE', '%' . $q . '%' )->orWhere ( 'email', 'LIKE', '%' . $q . '%' )->get ();
        //         $posts = DB::table('users')->join('cvs','users.id','=','cvs.user_id')->where('name', 'like', '%'.$search.'%')->paginate(5);

        //         if (count ( $posts ) > 0)
        //             return view ( 'cvs.search' )->with('posts',$posts)->withDetails ( $posts )->withQuery ( $search );
        //         else
        //             return view ( 'cvs.search' )->with('posts',$posts)->withMessage ( 'No Details found. Try to search again !' );
        //     }
        //     return view ( 'cvs.search' )->withMessage ( 'No Details found. Try to search again !' );
       


        // $search = $request->get('search');

        // if($search===" "){
        //      echo "Please enter some words to filter"; 
           
        // }else{ 
        //     $search = $request->get('search');
        //     $posts = DB::table('users')->join('cvs','users.id','=','cvs.user_id')->where('name', 'like', '%'.$search.'%')->paginate(5);



        // }
        // return view('cvs.search')->with('posts',$posts);


        $search = $request->get('search');

        // $posts = DB::table('posts')->where('title', 'like', '%'.$search.'%')->paginate(5);
        // $posts = User::where('name', 'like', '%'.$search.'%')->get();

        if(isset($search)){
            $posts = DB::table('users')->join('cvs','users.id','=','cvs.user_id')->where('name', 'like', '%'.$search.'%')->paginate(5);

            return view('cvs.search')->with('posts',$posts);

        }
        
       



     else {
       
        return view('cvs.message');

        // return view('cvs.search')->with('posts',$posts)->withMessage ( 'No Details found. Try to search again !' );

        }

        // $posts = DB::table('users')->join('cvs','users.id','=','cvs.user_id')->where('name', 'like', '%'.$search.'%')->paginate(5);
        // return view('cvs.search')->with('posts',$posts);

    }

    // Question sseach.blade.php
}
