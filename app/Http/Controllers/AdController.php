<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;

class AdController extends Controller
{

    public function index()
    {
        $ads = Ad::all();
        return view('ads.index', compact('ads'));
    }

    public function show($id)
    {
        $ad = Ad::findOrFail($id);
        return view('ad.show', compact('ad'));
    }

    public function create()
    {
        return view('ads.create');
    }

    public function edit($id)
    {
        $ad = Ad::where('id', $id)->firstOrFail();
        return view('ad.edit', ['ad' => $ad]);
    }

    public function update(Request $request, $id)
    {
        Ad::findOrFail($id)->update($request->all());

        return redirect()->route('ad.index')->with('success', 'Ad updated successfully');
    }
}
