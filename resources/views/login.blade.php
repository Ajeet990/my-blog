@extends('layouts/headerfooter')
@section('content')
<div class="container">
    <h1 class="text-center">LogIn form</h1>
    @if($errors->any())
        <h4>{{$errors->first()}}</h4>
    @endif

<form action="userLogin" method="POST" >
    @csrf
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
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection