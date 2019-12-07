@extends('layouts.app')
@section('title')
Login Register
@stop
@section('content')
<br>
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        @if(session()->get('fail'))
        <div class="alert alert-danger">
            {{ session()->get('fail') }}  
        </div>
        @endif
        @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}  
        </div>
        @endif
        <h2>LOGIN</h2>
        <form class="text-center" method="POST" action="{{route('login')}}">
            @csrf    
            <div class="form-group">
                <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" style="width:20%;">Login</button>
            </div>
        </form>
    </div>
    <div class="col-sm-4"></div>
</div>
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <h2>REGISTER</h2>
        <form class="text-center" method="POST" action="{{route('register')}}">
            @csrf
            <div class="form-group">
                <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary"  style="width:20%;">Register</button>
            </div>
        </form>
    </div>
    <div class="col-sm-4"></div>
</div>
@endsection
