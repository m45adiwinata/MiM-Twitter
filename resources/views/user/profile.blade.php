@extends('layouts.app')
@section('title')
Profile
@stop
@section('additional_style')
<style>
    img#pp {
        height: 200px;
        width: 200px;
        border-radius:50%;
    }
    input {
        margin:2%;
    }
    .upload-btn-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }

    .btn {
        border: 2px solid gray;
        color: gray;
        background-color: white;
        padding: 8px 20px;
        border-radius: 8px;
        font-size: 20px;
        font-weight: bold;
    }

    .upload-btn-wrapper input[type=file] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
    }
</style>
@endsection
@section('content')
<br>
<form class="text-center" method="POST" action="{{route('update-profile', $user->id)}}"  enctype="multipart/form-data">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <img src="{{asset('images/profiles/default.jpg')}}" alt="" id="pp">
                <br><br>
                <div class="upload-btn-wrapper">
                    <button class="btn">Upload</button>
                    <input id="image" type="file" name="image" accept="image/*">
                </div>
            </div>
            <div class="col-sm-6 text-right border">
                @if(session()->get('fail'))
                <div class="alert alert-danger">
                    {{ session()->get('fail') }}  
                </div>
                @endif
                @if(session()->get('success'))
                <div class="alert alert-danger">
                    {{ session()->get('success') }}  
                </div>
                @endif
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Email" value="{{$user->email}}">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <br>
                <br>
                <br>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
</form>

@endsection

@section('additional_script')
<script src="{{asset('js/dropzone.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#image').change(function() {
            console.log($(this).val());
        });
    });
</script>
@endsection
