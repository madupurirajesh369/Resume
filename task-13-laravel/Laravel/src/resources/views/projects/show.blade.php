@extends('users.layout')

@section('content')


<div class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="createModalLabel">Create Project</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('projects.store') }}" method="POST">
                @csrf
            
                 <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>userid:</strong>
                            <input type="text" name="user_id" class="form-control" placeholder="id"><br>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Title:</strong>
                            <input type="text" name="title" class="form-control" placeholder="Name"><br>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Status:</strong>
                            <input type="text" name="status" class="form-control" placeholder="status"><br>
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
                <h2>Projects: {{$user->name}}</h2>
            </div>
            <div class="col text-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    Create Project
                  </button>
                  <div class="pull-right" style="margin-right: 10px;float: right; padding-left:20px">
                    <a class="btn btn-success" href="{{ route('users.index') }}"> Back</a>
                </div>
            </div>
            
        </div>
    </div><br>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Status</th>
                <th  colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project1)
            <tr>
                <td>{{ $project1->id }}</td>
                <td>{{ $project1->title }}</td>
                <td>{{ $project1->status }}</td>
                <td>
                    <form action="{{ route('projects.destroy',$project1->id) }}" method="POST">
                        
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
                <td>
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" onclick="edit('{{ $project1->id }}', '{{ $project1->title }}', '{{ $project1->status }}')">Edit</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
        <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="editModalLabel">Edit Project</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="{{ route('projects.update', ':id') }}" method="POST">
                        @csrf
                        @method('PUT')
    
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Title:</strong>
                                    <input type="text" name="title" class="form-control" placeholder="Title" id="edit-title"><br>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Status:</strong>
                                    <input type="text" name="status" class="form-control" placeholder="status" id="edit-status"><br>
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

          {{ $projects->links() }}
 <script src="{{ asset('scripts/edit.js') }}"></script>

@endsection
