<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Resources\FoodResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\FoodDetailResource;

class FoodController extends Controller
{
    public function index() 
    {
        $foods = Food::All();
        return FoodDetailResource::collection($foods->loadMissing('writer:id,username', 'reviews'));
    }

    public function show($id)
    {
        $food = Food::with('writer:id,username')->findOrFail($id);
        return new FoodDetailResource($food->loadMissing('writer:id,username', 'reviews:id,food_id,user_id,reviews_content'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'food_name' => 'required|max:255',
            'food_type' => 'required',
            'recipe_content' => 'required',
        ]);

        $image = null;
        if ($request->file)
        {
            $fileName = $this->generateRandomString();
            $extension = $request->file->extension();
            $image = $fileName.'.'.$extension;
            
            Storage::putFileAs('image', $request->file, $image);
        }

        $request['image'] = $image;
        $request['author'] = Auth::user()->id;

        $food = Food::create($request->all());

        return new FoodDetailResource($food->loadMissing('writer:id,username'));
    }

    function generateRandomString($lenght = 30)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        
        for ($i = 0; $i < 10; $i++) {
            $randomString = $characters[random_int(0, strlen($charactersLength - 1))];
        }

        return $randomString;
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'food_name' => 'required|max:255', 
            'food_type' => 'required',
            'recipe_content' => 'required',        
        ]);

        $food = Food::findorfail($id);
        $food->update($request->all());

        return new FoodDetailResource($food->loadMissing('writer:id,username'));
    }
    public function delete($id)
    {
        $food = Food::findOrFail($id);
        $food->delete();

        return new FoodDetailResource($food->loadMissing('writer:id,username'));
    }
}
