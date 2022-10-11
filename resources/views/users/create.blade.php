@extends('layout.app')

@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <a class="btn btn-primary" href="{{ route('users.index') }}"><i class="bi bi-arrow-return-left"></i></a>
        </div>
    </div>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-12 col-lg-6 offset-0 offset-lg-3">
                <div class="card">
                    <div class="card-header">
                        New user
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="inputName">Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                    id="inputName">
                            </div>
                            <div class="row mt-3">
                                <div class="form-group col-6">
                                    <label for="inputEmail">Email</label>
                                    <input type="text" name="email" value="{{ old('email') }}" class="form-control"
                                        id="inputEmail">
                                </div>
                                <div class="form-group col-6">
                                    <label for="inputNpa">NPA</label>
                                    <input type="number" name="npa" value="{{ old('npa') }}" class="form-control"
                                        id="npa">
                                </div>
                                <div class="form-group col-6">
                                    <label for="inputPassword">Password</label>
                                    <input type="password" name="password" value="{{ old('password') }}"
                                        class="form-control" id="password">
                                </div>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger mt-3 col-12">
                                    <strong>Whoops!</strong> Il y a un problème avec vos entrées.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary mt-3">Enregister</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
