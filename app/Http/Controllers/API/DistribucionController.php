<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDistribucion;
use App\Http\Requests\UpdateDistribucion;
use App\Models\Distribucion;
use Illuminate\Support\Facades\Validator;

class DistribucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Distribucion::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreDistribucion $request)
    {
        Validator::make($request->all(), $request->rules());
        $distribucion = new Distribucion($request->all());
        $distribucion->save();
        return response()->json($distribucion, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $distribucion = Distribucion::findOrFail($id)->load('empalme');
        return response()->json($distribucion, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateDistribucion $request, $id)
    {
        Validator::make($request->all(), $request->rules());
        $distribucion = Distribucion::findOrFail($id);
        $distribucion->fill($request->all());
        $distribucion->save();
        return response()->json($distribucion, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Distribucion::destroy($id);
        return response()->json(['msg' => 'La caja de distribución ha sido eleminada del sistema.'], 200);
    }
}
