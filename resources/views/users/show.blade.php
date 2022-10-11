@extends('layout.app')

@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <a class="btn btn-primary" href="{{ route('users.index') }}"><i class="bi bi-arrow-return-left"></i></a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-6 offset-0 offset-lg-3">
            <div class="card">
                <div class="card-header">
                    Show user
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <strong>Name :</strong>
                            {{ $user->name }}
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-6">
                                <strong>Email :</strong>
                                {{ $user->email }}
                            </div>
                            <div class="form-group col-6">
                                <strong>NPA :</strong>
                                {{ $user->npa }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
