<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BikeModel;
use Inertia\Inertia;

class SearchController extends Controller
{
    // send bike models to search page
    public function index()
    {
        $bikeModels = BikeModel::all();

        return Inertia::render('Home', [
            'bikeModels' => $bikeModels,
        ]);
    }
}
