@extends('layouts/headerfooter')
@section('content')
    
<div class="container">
    <h1 class="text-center">User list</h1>
        @if(session('login') == true)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Welcome</strong> successfully logged in.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Profile</th>
                    <th scope="col">Registered date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)                   
                <tr>
                    <th scope="row">{{$index + 1}}</th>
                    <td>{{$user['name']}}</td>
                    <td>{{$user['email']}}</td>
                    <td><img src="{{ asset('uploads/images/'.$user['profile_pic']) }}" width="100px" alt="User Image"></td>
                    <td>{{$user['created_at']}}</td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</body>
</html>
@endsection