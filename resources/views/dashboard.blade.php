@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <div class="panel-body">
                        <a href="/posts/create" class="btn btn-primary">Create Post</a>
                        <a href="/cvs/create" class="btn btn-primary">Create Your CV</a>


                        <h3>Your Post</h3>
                       @if(count($posts)>0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td><a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a></td>
                                <td>
                                    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right' ])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                    {!!Form::close()!!}    
                                </td>
                            
                            
                                {{-- access to post data  user data to email --}}
                                {{-- {{$post->user['email']}} --}}
                            </tr>

                         
                                
                            @endforeach
                        </table>    
                        @else
                            <p>You have no posts</p>       
                        @endif     

                        {{-- you CV --}}
                        <h3>Your CV</h3>
                       @if(count($cvs)>0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($cvs as $cv)
                            <tr>
                                <td>{{$cv->user->name}}:  CV:{{$cv->id}}</td>
                                {{-- <td>{{$cv->id}}</td> --}}
                                <td><a href="/cvs/{{$cv->id}}/edit" class="btn btn-primary">Edit</a></td>
                                <td>
                                    {!!Form::open(['action' => ['CvsController@destroy', $cv->id], 'method' => 'POST', 'class' => 'float-right' ])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                    {!!Form::close()!!}    
                                </td>
                            
                            
                                {{-- access to post data  user data to email --}}
                                {{-- {{$post->user['email']}} --}}
                            </tr>

                         
                                
                            @endforeach
                        </table>    
                        @else
                            <p>You have no posts</p>       
                        @endif     
                       
                            
                            
                        
                       
                        
                        


                    </div>

                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
