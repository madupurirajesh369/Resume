@extends('users.layout')

@section('content')

<div class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="createModalLabel">Create User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
            
                 <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" class="form-control" placeholder="Name"><br>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Email:</strong>
                            <input type="text" name="email" class="form-control" placeholder="Email"><br>
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
            <div class="col text-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    Create user
                  </button>
            </div>
        </div>
    </div><br>

    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="Modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">User Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <dl id="content">
                    </dl>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col" colspan="4" style="text-align: center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                        <td>
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" onclick="edit('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}')">Edit</a>

                        </td>
                        <td>
                            <button class="btn btn-info" type="submit"
                                onclick="return handleAction({{ $user->id }})" data-bs-toggle="modal"
                                data-bs-target="#Modal">view</button>
                        </td>
                        <td>
                            <a href="{{ route('projects.show', $user->id) }}" class="btn btn-success"
                                >Projects</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <form id="editForm" action="{{ route('users.update', ':id') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Name:</strong>
                                        <input type="text" name="name"  class="form-control" placeholder="Name" id="edit-name"><br>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Email:</strong>
                                        <input type="text" name="email"  class="form-control" placeholder="Email" id="edit-email"><br>
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


    {{ $users->links() }}
@endsection


@section('script')
    <script src="{{ asset('scripts/view.js') }}"></script>
    <script src="{{ asset('scripts/edit1.js') }}"></script>
@endsection
