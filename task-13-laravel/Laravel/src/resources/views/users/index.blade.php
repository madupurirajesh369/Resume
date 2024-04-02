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
        <table class="table table-hover" id="userTable">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col" colspan="4">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hosts as $user)
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
                            <form action="{{ route('users.edit', $user->id) }}" method='GET'>
                                @csrf
                                <button class="btn btn-primary" type="submit">Edit</button>
                            </form>
                        </td>
                        <td>
                            <button class="btn btn-primary" type="submit"
                                onclick="return handleAction({{ $user->id }})" data-bs-toggle="modal"
                                data-bs-target="#Modal">view</button>
                        </td>
                        <td>
                            <a href="{{ route('projects.show', $user->id) }}" class="btn btn-primary"
                                target="_blank">Projects</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    {{ $hosts->links() }}


@endsection


@section('script')
    <script src="{{ asset('scripts/view.js') }}"></script>
@endsection
