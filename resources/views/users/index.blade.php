@extends('layout.app')
@section('content')
    <h1>Users</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary float-right mb-2"><i class="bi bi-plus-square-fill"></i>Add
        user</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">NPA</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->npa }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('users.show', $user->id) }}"><i class="bi bi-eye-fill"></i></a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary"><i
                                class="bi bi-pencil-square"></i></a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
