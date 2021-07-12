@extends('layouts.app')

@section('content')

<h1>{{$post->title}}</h1>
<div class="text-center">
    <img class="" style= "width:50%" src="/storage/cover_images/{{$post->cover_image}}" alt="">

</div>
<br>
<a href="/posts" class="btn btn-outline-secondary">Back</a>
<hr>
<div class="">
<p>Job Description:{!!$post->description!!}</p>
<p>Salary/Hr: {{$post->salary_hr}}</p>
<p>Type/Occupation:{{$post->type}}</p>
<p>Required Skills{!!$post->required_skills!!}</p>
<p>Campany Name: {{$post->company_name}}</p>
<p>Campany Description:{!!$post->campany_description!!}</p>
<p>City: {{$post->city}}</p>
<hr>
<small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
<hr>
@if(!Auth::guest())
@if(Auth::user()->id == $post->user_id)
<a href="/posts/{{$post->id}}/edit" class="btn btn-outline-secondary">Edit</a>

{!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right' ])!!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
{!!Form::close()!!}   
@endif 
@endif

</div>

    
        

   
    
@endsection