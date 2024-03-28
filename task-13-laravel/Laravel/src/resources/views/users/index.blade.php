@extends('users.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2>Users</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
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
            <th>Name</th>
            <th>Email</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($hosts as $host)
        <tr>
            <td>{{ $host->id }}</td>
            <td>{{ $host->name }}</td>
            <td>{{ $host->detail }}</td>
            <td>
                <form action="{{ route('users.destroy',$host->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('users.show',$host->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('users.edit',$host->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {{ $hosts->links() }}


@endsection
