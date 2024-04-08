@extends('users.layout')

@section('content')
    <div class="container center mt-25">
        <div class="row create">
            <div class="pull-left">
                <h2>Projects</h2><br>
            </div>
            <div class="row">
                <div class="col">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <form action="{{ route('projects.create') }}" method="GET" target="_blank">
                            @csrf
                            <button class="btn btn-primary" type="submit">Create</button>
                        </form>
                    </div>
                </div>
                <div class="col text-end">
                    <form action="{{ route('users.index') }}" method="GET" target="_blank">
                        @csrf
                        <button class="btn btn-primary" type="submit">Users</button>
                    </form>
                </div>
            </div>
        </div><br>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->status }}</td>
                            <td>
                                <form
                                    action="{{ route('projects.destroy', ['project' => $project->id . '-' . $project->user_id]) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('projects.edit', $project->id) }}" method='GET' target="_blank">
                                    @csrf
                                    <button class="btn btn-primary" type="submit">Edit</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="pageLinks d-flex">
        {{ $projects->links() }}
    </div>
@endsection
@section('script')
    <script src="{{ asset('scripts/view.js') }}"></script>
@endsection