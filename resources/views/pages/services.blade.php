@extends('layouts.app')
@section('content')
<h1>{{$title}}</h1>

{{-- check if there is variable service data has More than 1 and IF TRUE than it runs --}}
@if (count($services) >0)
{{-- loop --}}
@foreach ($services as $service)
<ul class="list-group">
<li class="list-group-item">{{$service}}</li>
</ul>
@endforeach

    
@endif



@endsection