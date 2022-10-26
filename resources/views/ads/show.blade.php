@extends("layout.app")

@section("content")

<h1>Annonce</h1>

    <a href="{{ route('ads.index') }}" class="btn btn-primary mb-2">Retour</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Prix</th>
                <th scope="col">Km</th>
                <th scope="col">Puissance [kw]</th>
                <th scope="col">Couleur</th>
                <th scope="col">Marque</th>
                <th scope="col">Catégorie</th>
                <th scope="col">Modèle</th>
                <th scope="col">Année</th>
                <th scope="col">Capacité</th>
                <th scope="col">Propriétaire</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $ad->price }}</td>
                <td>{{ $ad->km }}</td>
                <td>{{ $ad->power_kw }}</td>
                <td>{{ $ad->color_hexa }}</td>
                <td>{{ $ad->model->brand }}</td>
                <td>{{ $ad->model->category }}</td>
                <td>{{ $ad->model->model }}</td>
                <td>{{ $ad->model->year }}</td>
                <td>{{ $ad->model->capacity }}</td>
                <td>{{ $ad->user->name }}</td>
            </tr>
        </tbody>
    </table>

@endsection
