@extends("layout.app")

@section("content")

<h1>Annonces</h1>

    <a href="{{ route('ads.create') }}" class="btn btn-primary mb-2">Ajouter une annonce</a>

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
                <th scope="col">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ads as $ad)
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
                <td>
                    <a class="btn btn-info" href="{{ route('ads.show', $ad->id) }}">Afficher</a>
                    <a class="btn btn-primary" href="{{ route('ads.edit', $ad->id) }}">Modifier</a>
                    <form action="{{ route('ads.destroy', $ad->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection
