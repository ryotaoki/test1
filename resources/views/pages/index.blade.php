@extends('layouts.app')
@section('content')

<div class="jumbotron text-center">
<h1 class="display-4">{{$title}}</h1>
    <p class="lead"><strong>Start from here. You will Change</strong></p>
    <hr class="my-4">
    <p>Have you started?</p>
    @if(Auth::user())
    <p>
      <a class="btn btn-primary btn-lg" href="/dashboard" role="button">Dashboard</a>

    </p>
    
    @else
    <p>
        <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
        <a class="btn btn-success btn-lg" href="/register" role="button">Register</a>
    

    </p>

    

   
    @endif

   

  
    {{-- <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
    <a class="btn btn-primary btn-lg" href="/register" role="button">Register</a> --}}

  </div>

@endsection