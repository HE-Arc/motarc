@extends('layout.app')

@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <a class="btn btn-primary" href="{{ route('ads.index') }}">Retour</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data" >
        @csrf

        <div class="row">
            <div class="col-12 col-lg-6 offset-0 offset-lg-3">
                <div class="card">
                    <div class="card-header">
                        Nouvelle annonce
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="inputPrice">Prix</label>
                                <input type="number" name="price" class="form-control" id="inputPrice">
                            </div>
                            <div class="row mt-3">
                                <div class="form-group col-6">
                                    <label for="inputKm">Km</label>
                                    <input type="number" name="km" class="form-control" id="inputKm">
                                </div>
                                <div class="form-group col-6">
                                    <label for="inputPower_kw">Puissance</label>
                                    <input type="number" name="power_kw" class="form-control" id="inputPower_kw"
                                        step="0.1">
                                </div>
                                <div class="form-group col-6">
                                    <label for="inputColor">Couleur</label>
                                    <input type="text" name="color_hexa" class="form-control" id="inputColor">
                                </div>

                                <input type="text" name="user_id" id="user_id" class="form-control"
                                    value="{{ $user->id }}" hidden>
                            </div>

                            <div class="form-group col-12">
                                <label for="inputModel">Mod??le</label>
                                <select class="form-control" name="model_id" id="inputModel">
                                    <option value="">Mod??le inconnu...</option>
                                    @foreach ($models as $model)
                                        <option value="{{ $model->id }}">{{ $model->brand }} {{ $model->category }}
                                            {{ $model->model }} {{ $model->year }} {{ $model->capacity }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="file" name="images[]" id="images" class="form-control" multiple>

                            <button type="submit" class="btn btn-primary mt-3">Cr??er</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @csrf
@endsection
