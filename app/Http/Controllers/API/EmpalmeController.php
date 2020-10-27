<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Empalme\UpdateEmpalme;
use App\Http\Requests\StoreEmpalme;
use App\Models\Empalme;
use http\Env\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EmpalmeController extends Controller
{
    /**
     * Muestra todos las Cajas de Empalme registradas.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Empalme::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreEmpalme $request)
    {
        Validator::make($request->all(), $request->rules());
        $empalme = new Empalme($request->all());
        $coordenadas = CallejeroController::
        $empalme->save();
        return response()->json($empalme, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json(Empalme::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateEmpalme $request, $id)
    {
        Validator::make($request->all(), $request->rules());
        $empalme = Empalme::findOrFail($id);
        $empalme->fill($request->all());
        $empalme->save();
        return response()->json($empalme);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $empalme = Empalme::findOrFail($id);
        if(empty($empalme->distribucion())) {
            Empalme::destroy($id);
            return response()->json(['msg' => 'La caja de empalme se ha eliminado del sistema.'], 200);
        } else {
            return response()->json(
                [
                    'msg' => 'La caja de empalme tiene distribuiciones asociadas. Deben ser reubicadas previamente.'
                ], 409);
        }
    }
}
