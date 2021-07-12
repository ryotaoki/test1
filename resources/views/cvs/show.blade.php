@extends('layouts.app')

@section('content')

<div class="text-center">
    <img class="" style= "width:50%" src="/storage/cover_images/{{$cv->cover_image}}" alt="">

</div>

<h1>resume :{{$cv->id}}</h1>
<a href="/cvs" class="btn btn-outline-secondary">Back</a>
<hr>
<div class="">
<p>Name:{!!$cv->user->name!!}</p>
<p>Email:{!!$cv->user->email!!}</p>


<p>Main Skills:{!!$cv->main_skills!!}</p>
<p>Work Experience: {!!$cv->work_experience!!}</p>
<p>Education:{!!$cv->education!!}</p>

<hr>
<small>Written on {{$cv->created_at}}</small>
<hr>


@if(!Auth::guest())
@if(Auth::user()->id == $cv->user_id)
<a href="/cvs/{{$cv->id}}/edit" class="btn btn-outline-secondary">Edit</a>

{!!Form::open(['action' => ['CvsController@destroy', $cv->id], 'method' => 'POST', 'class' => 'float-right' ])!!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
{!!Form::close()!!} 
@endif 
@endif     

</div>

    
        

   
    
@endsection