@extends('layouts.app')

@section('content')

    <h1>Posts</h1>
    @if (count($posts)>0)
        @foreach ($posts as $post)
            <div class="card, p3, mb-2">
            <div class="row">
                <div class="col-md-4 col-sm-4">

                </div>
                <div class="col-md-8 col-sm-8">
                     {{-- go to this is SHOW api/Function --}}

                    <h3><a href="/posts/{{$post->id}}">{{$post->name}}</a></h3>

                    <small>Written on {{$post->created_at}} by {{$post->name}}</small>
                    <br>
                    <small>Written on {{$post->created_at}} by {{$post->email}}</small>



                </div>

            </div>
            



            </div>
            
            
        @endforeach
        {{$posts->links()}}

    @else
        <p>No Posts found</p>

        
    @endif
    
@endsection