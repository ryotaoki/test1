{{-- @extends('layouts.app')

@section('content')
    <h1>Resumes</h1>
    @if (count($cvs)>0)

        @foreach ($cvs as $cv)
            <div class="card, p3, mb-2">
            <h3><a href="/cvs/{{$cv->id}}">CV: {{$cv->id}} Name by:{{$cv->user['name']}}</a></h3>
            <small>Written on {{$cv->created_at}} by by {{$cv->user['name']}}</small>
            


            </div>
            
        @endforeach
        {{$cvs->links()}}
    @else    
            <p>No Cvs found</p>
        
    @endif
@endsection --}}

@extends('layouts.app')

@section('content')

    <h1>Posts</h1>
    @if (count($cvs)>0)
        @foreach ($cvs as $cv)
            <div class="card, p3, mb-2">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                <img style= "width:50%" src="/storage/cover_images/{{$cv->cover_image}}" alt="">

                </div>
                <div class="col-md-8 col-sm-8">
                     {{-- go to this is SHOW api/Function --}}

                     <h3><a href="/cvs/{{$cv->id}}">CV: {{$cv->id}} Name by:{{$cv->user['name']}}</a></h3>
                     <small>Written on {{$cv->created_at}} by by {{$cv->user['name']}}</small>

                    



                </div>

            </div>
            



            </div>
            
            
        @endforeach
        {{$cvs->links()}}

    @else
        <p>No Posts found</p>

        
    @endif
    
@endsection