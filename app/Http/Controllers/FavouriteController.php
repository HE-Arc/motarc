<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdUser;
use Inertia\Inertia;

class FavouriteController extends Controller
{
    public function index()
    {
        $favourites = auth()->user()->favourites;

        return Inertia::render('Favourites/Index', [
            'favourites' => $favourites,
        ]);
        //return view('favourites.index', compact('favourites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ad_id' => 'required|integer',
        ]);

        $favourite = new AdUser();
        $favourite->user_id = auth()->user()->id;
        $favourite->ad_id = $request->ad_id;
        $favourite->save();

        // TODO : redirect to where the user was before
        return redirect()->route('favourites.index')->with('success', 'Ad added to favourites.');
    }

    public function destroy($id)
    {
        $favourite = AdUser::findOrFail($id);
        $favourite->delete();

        // TODO : redirect to where the user was before
        return redirect()->route('favourites.index')->with('success', 'Ad removed from favourites.');
    }
}
