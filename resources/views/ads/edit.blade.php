@extends("layout.app")

@section("content")

<div class="row mb-3">
    <div class="col-12">
        <a class="btn btn-primary" href="{{ route('ads.index') }}">Retour</a>
    </div>
</div>

<form action="{{ route('ads.update', $ad->id ) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-12 col-lg-6 offset-0 offset-lg-3">
            <div class="card">
                <div class="card-header">
                    Modifier une annonce
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="inputPrice">Prix</label>
                            <input type="number" name="price" value="{{ $ad->price }}" class="form-control" id="inputPrice">
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-6">
                                <label for="inputKm">Km</label>
                                <input type="number" name="km" value="{{ $ad->km }}" class="form-control" id="inputKm">
                            </div>
                            <div class="form-group col-6">
                                <label for="inputPower_kw">Puissance</label>
                                <input type="number" name="power_kw" class="form-control" value="{{ $ad->power_kw }}" id="inputPower_kw">
                            </div>
                            <div class="form-group col-6">
                                <label for="inputColor">Couleur</label>
                                <input type="text" name="color_hexa" value="{{ $ad->color_hexa }}" class="form-control" id="inputColor">
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <label for="inputModel">Modèle</label>
                            <select class="form-control" name="model_id" id="inputModel">
                                @foreach ($models as $model)
                                    <option value="{{ $model->id }}" @if ($model->id == $ad->model_id)
                                        selected
                                    @endif>{{ $model->brand }} {{ $model->category }} {{ $model->model }} {{ $model->year }} {{ $model->capacity }}</option>
                                @endforeach
                            </select>
                        </div>

                        @foreach ($ad->images as $image)
                            <img style="max-width:600px;" src="/images/{{ $image->image_url }}" />
                        @endforeach

                        <input type="file" name="images[]" id="images" class="form-control" multiple>

                        <button type="submit" class="btn btn-primary mt-3">Modifier</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
