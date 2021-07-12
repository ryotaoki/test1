@extends('layouts.app')

@section('content')

<h1>Edit CV</h1>
{!! Form::open(['action' => ['CvsController@update', $cv->id ], 'method' => 'PUT', 'enctype' => 'multipart/form-data' ]) !!}
    <div class="form-group">
    {{Form::label('main_skills', 'Main Skills')}}
    {{Form::textarea('main_skills', $cv->main_skills,['class' => 'form-control', 'placeholder' => 'write your skills'])}}
    </div>
    <div class="form-group">
    {{Form::label('work_experience', 'Work Experience')}}
    {{Form::textarea('work_experience', $cv->work_experience,['class' => 'form-control', 'placeholder' => 'write your work experience'])}}
    </div>

    <div class="form-group">
    {{Form::label('education', 'Education')}}
    {{Form::textarea('education', $cv->education,['class' => 'form-control', 'placeholder' => 'write your education'])}}
    </div>
    <div class="form-group">
        {{Form::file('cover_image')}}

    </div>

 {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
    
{!! Form::close() !!}

 
    
@endsection
