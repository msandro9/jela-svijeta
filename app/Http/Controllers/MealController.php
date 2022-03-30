<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\MealResource;
use App\Http\Requests\GetMealsRequest;
use App\Http\Resources\MealCollection;
use App\Http\Requests\StoreMealRequest;
use App\Http\Requests\UpdateMealRequest;

class MealController extends Controller
{
    public function __invoke(GetMealsRequest $request)
    {
        return new MealCollection(
            Meal::getMealsInCategory($request->category)
                ->diffTime($request->diff_time)
                ->whereHasTags($request->tags)
                ->withIncludes($request->with)
                ->paginate($request->per_page, ['*'], 'page', $request->page)
                ->withQueryString()
        );
    }
}
