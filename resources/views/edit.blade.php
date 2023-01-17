@extends('layouts/headerfooter')
@section('content')
<div class="container">
    <h1 class="text-center">Update User Details</h1>
    @if($errors->any())
      <h4>{{$errors->first()}}</h4>
    @endif
    @if(session('message'))
        <h3 class="text-success">{{session('message')}}</h3>
    @endif
<form action="" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label  class="form-label">User name</label>
      <input type="text" name="uname" class="form-control" value="{{ $user['name'] }}" >
      <span style="color:red">@error('uname') {{$message}} @enderror</span>
    </div>
    <div class="mb-3">
      <label class="form-label">Email address</label>
      <input type="email" name="email" value="{{ $user['email'] }}" class="form-control" aria-describedby="emailHelp">
      <span style="color:red">@error('email') {{$message}} @enderror</span>

    </div>
    <div class="mb-3">
      <label  class="form-label">Change profile image</label>
        <input type="file" value="{{$user['profile_pic']}}" name="profileImage">
        <span style="color:red">@error('profileImage') {{$message}} @enderror</span>
        <img src="{{ asset('uploads/images/'.$user['profile_pic']) }}" width="100px" alt="User Image">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>
@endsection
