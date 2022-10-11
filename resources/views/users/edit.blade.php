@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <a class="btn btn-primary" href="{{ route('users.index') }}"><i class="bi bi-arrow-return-left"></i></a>
        </div>
    </div>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card col-12 col-lg-6 offset-0 offset-lg-3">
            <div class="card-header">
                Modify user
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="inputName">Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                            id="inputName">
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-6">
                            <label for="inputEmail">Email</label>
                            <input type="text" name="email" value="{{ $user->email }}" class="form-control"
                                id="inputEmail">
                        </div>
                        <div class="form-group col-6">
                            <label for="inputNpa">NPA</label>
                            <input type="text" name="npa" value="{{ $user->npa }}" class="form-control"
                                id="inputNpa">
                        </div>
                        <div class="form-group col-6">
                            <label for="inputPassword">Password</label>
                            <input type="password" name="password" class="form-control" id="inputPassword">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                </div>
            </div>
        </div>

    </form>
@endsection
