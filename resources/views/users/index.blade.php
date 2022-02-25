@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('helpers.flash-messages')
                <h1 class="font-weight-bold mt-2"><i class="fa-solid fa-users"></i> List of users:</h1>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Surname</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone number</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->surname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <a href="#"><button class="btn btn-danger btn-sm delete" data-id="{{ $user->id }}"><i class="fa-solid fa-trash"></i></button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 mt-3">
                <div class="pagination justify-content-end">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    const deleteUrl = "{{ url('users') }}/";
@endsection

@section('javascript-files')
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection
