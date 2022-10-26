@extends('layout.app')

@section('content')
    <!-- iterate through the favourites and display elements in a nice way -->
    @foreach ($favourites as $favourite)
        <div class="row">
            <div class="col-12 col-lg-6 offset-0 offset-lg-3">
                <div class="card">
                    <div class="card-header">
                        Ad
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <strong>id :</strong>
                                {{ $favourite->id }}
                            </div>
                            <div class="row mt-3">
                                <div class="form-group col-6">
                                    <strong>price :</strong>
                                    {{ $favourite->price }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
