<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Requests\CreateAnimalRequest;
use App\Http\Resources\AnimalResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Animal;

class AnimalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AnimalResource::collection(Animal::orderBy('name', 'asc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAnimalRequest $request)
    {
        $validated = $request->validated();

        if($validated) {
            $animal = new Animal();

            $animal->species = request('species');
            $animal->breed = request('breed');
            $animal->name = request('name');
            $animal->source = request('source');
            $animal->microchip_number = request('microchip_number');
            $animal->gender = request('gender');
            $animal->birthdate = request('birthdate');
            $animal->description = request('description');
            $animal->weight = request('weight');
            $animal->fixed = request('fixed');

            $animal->save();

            return new AnimalResource($animal);
        }

        return response()->json(null, Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (is_null($id)) {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }

        return new AnimalResource(Animal::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
