@extends('layouts/headerfooter')
@section('content')
<div class="container">
    <h1 class="text-center">Registration form</h1>
    @if($errors->any())
      <h4>{{$errors->first()}}</h4>
    @endif
    @if(session('message'))
        <h3 class="text-success">{{session('message')}}</h3>
    @endif
<form action="register" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label  class="form-label">User name</label>
      <input type="text" name="uname" class="form-control" value="{{old('uname')}}" >
      <span style="color:red">@error('uname') {{$message}} @enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label">Email address</label>
      <input type="email" name="email" value="{{old('email')}}" class="form-control" aria-describedby="emailHelp">
      <span style="color:red">@error('email') {{$message}} @enderror</span>

    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" name="upass" class="form-control">
      <span style="color:red">@error('upass') {{$message}} @enderror</span>
    </div>
    <div class="mb-3">
      <label  class="form-label">Confirm Password</label>
      <input type="password" name="cpass" class="form-control">
      <span style="color:red">@error('cpass') {{$message}} @enderror</span>
    </div>
    <div class="mb-3">
      <label  class="form-label">Choose profile image</label>
        <input type="file" value="{{old('profileImage')}}" name="profileImage">
        <span style="color:red">@error('profileImage') {{$message}} @enderror</span>

    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection
