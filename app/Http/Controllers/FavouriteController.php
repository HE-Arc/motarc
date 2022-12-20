<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdUser;
use Inertia\Inertia;
use App\Models\User;

class FavouriteController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(auth()->user()->id);
        $favourites = $user->favourites()->with(['user', 'model', 'images'])->paginate(2);

        //$favourites = json_decode($favourites->toJson());

        return Inertia::render('Favourites/Index', [
            'favourites' => $favourites,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ad_id' => 'required|integer',
        ]);

        $request->merge([
            'user_id' => auth()->user()->id,
        ]);

        AdUser::create($request->all());

        // redirect where the user was and keep scroll position
        return redirect()->back()->with('success', 'Ad added to favourites.');

        //return redirect()->route('favourites.index')->with('success', 'Ad added to favourites.');
    }

    public function destroy($id)
    {
        $favourite = AdUser::findOrFail($id);
        $favourite->delete();

        // redirect where the user was and keep scroll position
        return redirect()->back()->with('success', 'Ad removed from favourites.');
    }
}
