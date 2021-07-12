@extends('layouts.app')

@section('content')

<h1>create post</h1>
{!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    <div class="form-group">
    {{Form::label('title', 'Title')}}
    {{Form::text('title', '',['class' => 'form-control', 'placeholder' => 'type the title'])}}
    </div>
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{Form::textarea('description', '',['id'=> 'editor1', 'class' => 'form-control', 'placeholder' => 'type the job description'])}}
     </div>
     <div class="form-group">
        {{Form::label('salary_hr', 'Salary by Hour')}}
        {{Form::text('salary_hr', '',['class' => 'form-control', 'placeholder' => 'type salary hour with number'])}}
     </div>
     <div class="form-group">
        {{Form::label('type', 'Type of Job')}}
        {{Form::text('type', '',['class' => 'form-control', 'placeholder' => 'type of job'])}}
     </div>
     <div class="form-group">
        {{Form::label('required_skills', 'Required Skill')}}
        {{Form::textarea('required_skills', '',['id'=> 'editor2','class' => 'form-control', 'placeholder' => 'type required skills'])}}
     </div>
     <div class="form-group">
        {{Form::label('company_name', 'Company Name')}}
        {{Form::text('company_name', '',['class' => 'form-control', 'placeholder' => 'type company name'])}}
    </div>
    <div class="form-group">
        {{Form::label('company_description', 'Company Description')}}
        {{Form::textarea('company_description', '',['id'=> 'editor3','class' => 'form-control', 'placeholder' => 'type company description'])}}
    </div>
    <div class="form-group">
        {{Form::label('city', 'City')}}
        {{Form::text('city', '',['class' => 'form-control', 'placeholder' => 'type city'])}}
    </div>
    <div class="form-group">
        {{Form::file('cover_image')}}

    </div>
    


        

     {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
    
{!! Form::close() !!}



    
        

   
    
@endsection