@extends('layouts/headerfooter')
@section('content')
<div class="container my-2">
    @include('modals/addBlogModal')
    @if(session('message'))
        <h3 class="text-success">{{session('message')}}</h3>
    @endif
    @if(count($blogs) > 0)
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Blog Image</th>
                <th scope="col">Description</th>
                <th scope="col">Blog Image</th>
                <th scope="col">Added by</th>
                <th scope="col">status</th>
              </tr>
            </thead>
            <tbody>
                @foreach($blogs as $index => $blog)
              <tr>
                <th scope="row">{{ $index + 1 }}</th>
                <td>{{ $blog['title'] }}</td>
                <td>
                  <img src="{{ asset('storage/blogImages/'.$blog->image) }}" width="90px" alt="blog image">
                </td>
                <td>{{ $blog['description'] }}</td>
                <td>{{ $blog['image'] }}</td>
                <td>{{ $blog['user_id'] }}</td>
                <td>{{ $blog['status'] }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
    @else
          <p>No blogs added till now</p>
    @endif
</div>
@endsection