@extends('users.layout')

@section('content')

<div class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="createModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
            
                 <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Email:</strong>
                            <textarea class="form-control" style="height:150px" name="email" placeholder="email"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            
            </form>
        </div>
      </div>
    </div>
  </div>


  
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2>Users</h2>
            </div>
            <div class="pull-right">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    Create
                  </button>
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
            <th width="350px">Action</th>
        </tr>
        @foreach ($hosts as $host)
        <tr>
            <td>{{ $host->id }}</td>
            <td>{{ $host->name }}</td>
            <td>{{ $host->email }}</td>
            <td>
                <form action="{{ route('users.destroy',$host->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('users.show',$host->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('users.edit',$host->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <a class="btn btn-primary" href="http://localhost:8000/api/host/projects/{{$host->id}}">Projects</a>
                </form>
            </td>
        </tr>



        @endforeach

    </table>
    {{ $hosts->links() }}


@endsection
