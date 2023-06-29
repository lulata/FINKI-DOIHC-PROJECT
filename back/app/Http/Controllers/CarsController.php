<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarsController extends Controller
{
    private $validatorFields = [
        'name' => 'required',
        'transmission' => 'required',
        'color' => 'required',
        'brand' => 'required',
        'image_url' => 'required',
        'price' => 'required|integer',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Car::get(), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        return response()->json(Car::find($id), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->validatorFields);

    
        Car::create($data);

        return response()->json(['message' => 'Successfuly created car'], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate($this->validatorFields);
 
        $car = Car::find($id);

        $car->update($data);

        return response()->json(['message' => 'Successfuly updated car'], 200);    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = Car::find($id);

        if(!$car) {
            return response()->json(['message' => "Car doesn't exist"], 404);
        }

        $car->delete();

        return response()->json(['message' => 'Successfuly deleted car'], 200);    
    }
}
