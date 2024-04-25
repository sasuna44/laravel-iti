@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row f-column justify-content-evenly align-items-center">
            <h1 class="fw-bolder w-50" >Add New Post</h1>
        <a href="/posts/create" class="btn btn-primary mt-5 w-25  ">Add Now</a>

        </div>        
        <table class="table table-light table-striped table-hover  mt-3 p-5 rounded-5">
            <thead>
                <tr>
                    <th>ID</th> 
                    <th>Name</th>
                    <th>Body</th> 
                    <th>Posted By</th>
                    <th>Image</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post['id'] }}</td>
                        <td>{{ $post['title'] }}</td> 
                        <td>{{ $post['body'] }}</td> 
                        <td>{{ $post->user->name }}</td>   
                        <td>
                            <img src="{{ asset('images/' . $post->image) }}" alt="not exist" style="max-width: 100px;">
                        </td>    
                        <td><a href="/posts/{{ $post['id'] }}" class="btn btn-success">VIEW</a></td>
                        <td><a href="/posts/{{ $post['id'] }}/edit" class="btn btn-primary">EDIT</a></td>
                        <td>
                            <form action="/posts/{{ $post['id'] }}" method="POST">
                                @csrf
                                @method("delete")   
                                <button type="submit" class="btn btn-danger">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
