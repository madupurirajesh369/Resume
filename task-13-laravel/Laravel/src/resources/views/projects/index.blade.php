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
            <form action="{{ route('projects.store') }}" method="POST">
                @csrf
            
                 <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>userid:</strong>
                            <input type="text" name="user_id" class="form-control" placeholder="id">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Title:</strong>
                            <input type="text" name="title" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Status:</strong>
                            <textarea class="form-control" style="height:150px" name="status" placeholder=""></textarea>
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
                <h2>Projects</h2>
            </div>
            <div class="pull-right">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    Create
                  </button>
                  <div class="pull-right" style="margin-right: 10px;float: right;">
                    <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                </div>
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
