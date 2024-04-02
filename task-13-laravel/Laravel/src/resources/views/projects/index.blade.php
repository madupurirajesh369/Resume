@extends('users.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2>Projects</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('projects.create') }}"> Create</a>
            </div>
            <div class="pull-right" style="margin-right: 10px;">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Status</th>
            <th width="350px">Action</th>
        </tr>
        @foreach ($project1 as $project1)
        <tr>
            <td>{{ $project1->id }}</td>
            <td>{{ $project1->title }}</td>
            <td>{{ $project1->status }}</td>
            <td>
                <form action="{{ route('projects.destroy',$project1->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('projects.edit',$project1->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach

    


@endsection
