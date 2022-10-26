<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\BikeModel;

class AdController extends Controller
{

    public function index(Request $request)
    {
        if (empty($request->all()))
        {
            $ads = Ad::with('model')->with('user')->get();
            return view('ads.index', compact('ads'));
        }

        $filters = array();

        foreach ($request->all() as $name => $value)
        {
            if(str_contains($name, "from"))
            {
                array_push($filters, [substr($name, 4), '>=', $value]);
            }
            elseif(str_contains($name, "to"))
            {
                array_push($filters, [substr($name, 2), '<=', $value]);
            }
            else
            {
                array_push($filters, [$name, '=', $value]);
            }
        }

        // filtrer les annonces en fonction des paramètres
        return Ad::with('model')->with('user')->where($filters)->get();
    }

    public function show($id)
    {
        $ad = Ad::findOrFail($id);
        return view('ads.show', compact('ad'));
    }

    public function create()
    {
        $user = auth()->user();
        $models = BikeModel::all();
        return view('ads.create', compact("models"), compact("user"));
    }

    public function store(Request $request)
    {
        // TODO
        // $request->validate([

        // ]);

        Ad::create($request->all());

        return redirect()
            ->route("ads.index")
            ->with("success", "Ad created successfully");
    }

    public function edit($id)
    {
        $ad = Ad::where('id', $id)->firstOrFail();
        return view('ads.edit', ['ad' => $ad]);
    }

    public function update(Request $request, $id)
    {
        Ad::findOrFail($id)->update($request->all());

        return redirect()->route('ads.index')->with('success', 'Ad updated successfully');
    }
}
