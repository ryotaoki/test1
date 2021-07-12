@extends('layouts.app')

@section('content')

    <h1>Posts</h1>
 
    @if (count($posts)>0)
        @foreach ($posts as $post)
            <div class="card, p3, mb-2">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                <img style= "width:50%" src="/storage/cover_images/{{$post->cover_image}}" alt="">

                </div>
                <div class="col-md-8 col-sm-8">
                     {{-- go to this is SHOW api/Function --}}

                    <h3><a href="/cvs/{{$post->id}}">{{$post->name}}</a></h3>
                    <small>Written on {{$post->created_at}} by {{$post->name}}</small>
                    <br>
                    <small>Written on {{$post->created_at}} by {{$post->email}}</small>



                </div>

            </div>
            



            </div>
            
            
        @endforeach
        {{$posts->links()}}

    @elseif($posts===0)
        <p>Filter the posts,please</p>

    @else
        <p>No posts found.</p>

        
    @endif

    
    
@endsection