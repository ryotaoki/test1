<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;
use DB;


class PostsController extends Controller
{
   
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        // $posts = Post::orderBy('id', 'desc')->get();
        // $posts = Post::orderBy('id', 'desc')->take(5)->get();

        $posts = Post::orderBy('id', 'desc')->paginate(6);

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
            'title' => 'required',
            'description' => 'required',
            'salary_hr' => 'required',
            'type' => 'required',
            'required_skills' => 'required',
            'company_name' => 'required',
            'company_description' => 'required',
            'city' => 'required',
            // how to make pdf?
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

        
        // create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->user_id =auth()->user()->id;
        // if its integer how to change?
        $post->salary_hr = $request->input('salary_hr');
        $post->type = $request->input('type');
        $post->required_skills = $request->input('required_skills');
        $post->company_name = $request->input('company_name');
        $post->company_description = $request->input('company_description');
        $post->city = $request->input('city');
        $post->cover_image = $filenameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Job Post Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        
        //check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unauthorized page');
        }
        return view('posts.edit')->with('post',$post);
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
            'title' => 'required',
            'description' => 'required',
            'salary_hr' => 'required',
            'type' => 'required',
            'required_skills' => 'required',
            'company_name' => 'required',
            'company_description' => 'required',
            'city' => 'required',
            
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
        // create Post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        // if its integer how to change?
        $post->salary_hr = $request->input('salary_hr');
        $post->type = $request->input('type');
        $post->required_skills = $request->input('required_skills');
        $post->company_name = $request->input('company_name');
        $post->company_description = $request->input('company_description');
        $post->city = $request->input('city');
        if($request->hasFile('cover_image')){
            $post->cover_image = $filenameToStore;    

        }    

        $post->save();

        return redirect('/posts')->with('success', 'Job Post Updated');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
         //check for correct user
         if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unauthorized page');
        }
        if($post->cover_image != 'noimage.jpg'){
            //delete image
            Storage::delete('public/cover_images/'.$post->cover_image);
    
    
        }


        $post->delete();
        return redirect('/posts')->with('success', 'Job Post Removed');


    }

    // public function search(Request $request){
    //     $search = $request->get('search');
    //     $posts = DB::table('posts')->where('title', 'like', '%'.$search.'%')->with('users')->paginate(5);
    //     return view('posts.search')->with('posts',$posts);
    // }


}
