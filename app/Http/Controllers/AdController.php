<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\BikeModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            if (str_contains($name, "from"))
            {
                array_push($filters, [substr($name, 4), '>=', $value]);
            }
            elseif (str_contains($name, "to"))
            {
                array_push($filters, [substr($name, 2), '<=', $value]);
            }
            else
            {
                array_push($filters, [$name, '=', $value]);
            }
        }

        $ads = DB::table('ads')
            ->join('bike_models', 'ads.model_id', '=', 'bike_models.id')
            ->join('users', 'ads.user_id', '=', 'users.id')
            ->select('ads.*', 'bike_models.*', 'users.*')
            ->where($filters)
            ->get();

        return $ads;
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
        $request->validate([
            'price' => 'required|integer',
            'km' => 'required|integer',
            'power_kw' => 'required|numeric',
            'color_hexa' => 'required',
            'model_id' => 'required|integer',
            'user_id' => 'required|integer',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000' // max : Max size in KB = 10MB
        ]);

        $ad = new Ad();
        $ad->price = $request->price;
        $ad->km = $request->km;
        $ad->power_kw = $request->power_kw;
        $ad->color_hexa = $request->color_hexa;
        $ad->model_id = $request->model_id;
        $ad->user_id = $request->user_id;
        $ad->save();

        if ($request->hasFile('images'))
        {
            foreach ($request->file('images') as $image)
            {
                $imageName = time() . Str::random(40) . '.' . $image->extension();

                $image->move(public_path('images'), $imageName);

                $ad->images()->create(['image_url' => $imageName]);
            }
        }

        return redirect()
            ->route("ads.index")
            ->with("success", "Ad created successfully");
    }

    public function destroy($id)
    {
        $ad = Ad::findOrFail($id)->delete();

        return redirect()
            ->route("ads.index")
            ->with("success", "Ad deleted successfully");
    }

    public function edit($id)
    {
        $ad = Ad::where('id', $id)->firstOrFail();

        if ($ad->user_id != auth()->user()->id)
        {
            return redirect()->route('ads.index')->with('Access failed', 'You are not the owrner of this ad.');
        }

        $models = BikeModel::all();

        return view('ads.edit', ['ad' => $ad], compact("models"));
    }

    public function update(Request $request, $id)
    {
        Ad::findOrFail($id)->update($request->all());

        return redirect()->route('ads.index')->with('success', 'Ad updated successfully');
    }
}
