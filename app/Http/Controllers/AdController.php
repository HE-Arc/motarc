<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\BikeModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Models\User;

class AdController extends Controller
{
    public function index(Request $request)
    {
        $bikeModels = BikeModel::all();

        if (auth()->user()) {
            $favourites = auth()->user()->favourites;
        } else {
            $favourites = [];
        }

        if (empty($request->all())) {
            $ads = Ad::with(['model', 'user', 'images'])->paginate(3);

            return Inertia::render('Ads/Index', [
                'ads' => $ads,
                'favourites' => $favourites,
                'bikeModels' => $bikeModels,
                'params' => '',
            ]);
        }

        $filters = array();

        $filtersColors = array();
        $filtersAd = array();
        $filtersModel = array();

        foreach ($request->all() as $name => $value) {
            if (str_contains($name, "min")) {
                array_push($filters, [substr($name, 3), '>=', $value]);
            } elseif (str_contains($name, "max")) {
                array_push($filters, [substr($name, 3), '<=', $value]);
            } elseif (str_contains($name, "color")) {
                foreach ($value as $color) {
                    array_push($filters, ['color', '=', $color]);
                }
            } elseif (!str_contains($name, "page")) {
                array_push($filters, [$name, '=', $value]);
            }
        }

        foreach ($filters as $filter) {
            if (in_array($filter[0], ['price', 'km', 'power_kw'])) {
                array_push($filtersAd, $filter);
            } elseif (in_array($filter[0], ['color'])) {
                array_push($filtersColors, $filter);
            } else {
                array_push($filtersModel, $filter);
            }
        }

        $ads = Ad::query()
            ->with(['user', 'images'])
            ->withWhereHas('model', function ($query) use ($filtersModel, $filtersColors) {
                $query->where($filtersModel);
            })->where($filtersAd)
            ->where(function ($query) use ($filtersColors) {
                foreach ($filtersColors as $filter) {
                    $query->orWhere($filter[0], $filter[1], $filter[2]);
                }
            })->paginate(3);

        // First attempt with DB. It works but it's not as elegant as the query above. We asked a stackoverflow question about this.
        // https://stackoverflow.com/questions/74799272/multiple-where-clauses-on-multiple-tables-laravel-without-join
        /* $ads = DB::table('ads') // Ad::where($filters)
            ->join('bike_models', 'ads.model_id', '=', 'bike_models.id')
            ->join('users', 'ads.user_id', '=', 'users.id')
            ->join('images', 'ads.id', '=', 'images.ad_id')
            ->select('ads.*', 'bike_models.*', 'users.*', 'images.*')
            ->where($filters)
            ->get(); */

        // Create string from params
        $params = '';
        foreach ($request->all() as $name => $value) {
            if (!str_contains($name, "page")) {
                //dd($name, $value);
                if (is_array($value)) {
                    foreach ($value as $v) {
                        $params .= $name . '[]=' . $v . '&';
                    }
                } else {
                    $params .= $name . '=' . $value . '&';
                }
                //$params .= $name . '=' . $value . '&';
            }
        }

        return Inertia::render('Ads/Index', [
            'ads' => $ads,
            'favourites' => $favourites,
            'bikeModels' => $bikeModels,
            "params" => $params,
        ]);
    }

    public function show($id)
    {
        $ad = Ad::with(['model', 'user', 'images'])->findOrFail($id);

        return Inertia::render('Ads/Show', [
            'ad' => $ad,
        ]);
    }

    public function myAds()
    {
        // get ads of current user
        //$ads = auth()->user()->ads;

        // with pagination
        $user = User::findOrFail(auth()->user()->id);
        $ads = $user->ads()->with(['model', 'images'])->paginate(1);

        // convert pagination to json
        //$ads = json_decode($ads->toJson());

        return Inertia::render('Ads/MyAds', [
            'ads' => $ads,
        ]);
    }

    public function create()
    {
        $user = auth()->user();
        $models = BikeModel::all();

        return Inertia::render('Ads/Create', [
            'models' => $models,
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'price' => 'required|integer',
            'km' => 'required|integer',
            'power_kw' => 'required|numeric',
            'color' => 'required',
            'model_id' => 'required|integer',
            'user_id' => 'required|integer',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000' // max : Max size in KB = 10MB
        ]);

        $ad = new Ad();
        $ad->price = $request->price;
        $ad->km = $request->km;
        $ad->power_kw = $request->power_kw;
        $ad->color = $request->color;
        $ad->model_id = $request->model_id;
        $ad->user_id = $request->user_id;
        $ad->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . Str::random(40) . '.' . $image->extension();

                $image->move(public_path('storage/images'), $imageName);

                $ad->images()->create(['image_url' => $imageName]);
            }
        }

        return redirect()
            ->route("ads.show", $ad->id)
            ->with("success", "Ad created successfully");
    }

    public function destroy($id)
    {
        $ad = Ad::findOrFail($id);

        // Delete images from public/images folder
        foreach ($ad->images as $image) {
            $image_path = public_path("storage/images") . '\\' . $image->image_url;

            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }

        $ad->delete();

        // redirect where the user came from with inertia
        return redirect()->back()->with('success', 'Ad deleted successfully');
    }

    public function edit($id)
    {
        $ad = Ad::where('id', $id)->with("images")->with("model")->firstOrFail();

        if ($ad->user_id != auth()->user()->id) {
            return redirect()->route('ads.index')->with('Access failed', 'You are not the owner of this ad.');
        }

        $models = BikeModel::all();

        return Inertia::render('Ads/Edit', [
            'ad' => $ad,
            'models' => $models,
        ]);
    }

    public function update(Request $request, $id)
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

        $ad = Ad::findOrFail($id);

        $ad->update($request->all());

        if ($request->hasFile('images')) {
            // Remove old images
            foreach ($ad->images as $image) {
                $image_path = public_path("storage/images") . '\\' . $image->image_url;

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            // Remove old images from database
            $ad->images()->delete();

            // Add new images
            foreach ($request->file('images') as $image) {
                $imageName = time() . Str::random(40) . '.' . $image->extension();

                $image->move(public_path('storage/images'), $imageName);

                $ad->images()->create(['image_url' => $imageName]);
            }
        }

        // redirect where the user came from with inertia
        return redirect()->route('ads.show', $id)->with('success', 'Ad updated successfully');
    }
}
