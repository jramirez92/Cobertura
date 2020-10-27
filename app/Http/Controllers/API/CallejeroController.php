<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Callejero\DecodeAdress;
use App\Models\Callejero;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleXMLElement;

class CallejeroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Callejero::all());
    }

    public function encode(DecodeAdress $request) {

        \Validator::make($request->all(), $request->rules());
        return $this->getEncode($request->calle, $request->numero, $request->cp);
    }

    public function getEncode($calle, $numero, $cp) {

        # Formateo Cadena Dirección
        $data = $calle.'+'.$numero.'%2C'.$cp;
        $payload = str_replace(' ', '+', $data);

        # Request a Servicio de Geocodificación
        $url = env('MAPS_URL').$payload.'&apiKey='.env('MAPS_KEY');
        $response = \Http::get($url)->body();
        $body = json_decode($response, true);

        # Devolución de los datos mediante JSON
        return response()->json($body['items'][0]['position']);
    }

    public function update() {
        # Servicio Callejero Catastro
        $url = "ovc.catastro.meh.es/ovcservweb/OVCSWLocalizacionRC/OVCCallejero.asmx/ConsultaVia";

        # Formato Petición a Catastro.
        $data = array('Provincia' => 'Cádiz', 'Municipio' => '', 'TipoVia' => '', 'NombreVia' => '');

        # Municipio sobre los que se desea realizar la consulta.
        $municipios = json_decode(
            DB::table('municipio')->get(['cp', 'nombre'])
        );

        # Número de calles añadidas en la consulta.
        $nCalles = 0;

        # Parámetros a consultar para el formato de nombres.
        $nombreCheck = array('DE', '(DE)','DEL', '(DEL)', '(DE LA)', 'LA', '(DE LOS)', '(DE LAS)');

        # Tipos de Vía
        $tiposVia = array('AV' => 'Avenida ', 'CL' => 'Calle ', 'CJ' => 'Callejon ', 'CM' => 'Camino ',
            'CT' => 'Cuesta ', 'CR' => 'Carretera ', 'GL' => 'Glorieta ', 'PJ' => 'Pasaje ', 'PS' => 'Paseo ',
            'PZ' => 'Plaza ');

        for($i = 0; $i < count($municipios); $i++) {

            $data['Municipio'] = $municipios[$i]->nombre;

            # Envío de Request mediante Curl.
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_HEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);

            # Eliminación Cabecera Respuesta.
            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $response = substr($response, $header_size);
            curl_close($ch);

            # Conversión de Datos XML a JSON.
            $obj = new SimpleXMLElement($response);
            $callejero = $obj->callejero[0];

            # Insercción de las nuevas calles en la base de datos.
            foreach($callejero as $calle) {

                # Comprobamos que el elemento se trata de una vía.
                $via = (string) $calle->dir->tv;
                if(!array_key_exists($via, $tiposVia)) {
                    continue;
                }

                # Comprueba si la Calle ya está registrada.
                $code = (int) $calle->dir->cv;
                $target = DB::table('callejero')
                    ->where([
                        ['municipio', '=', $municipios[$i]->cp],
                        ['codigo', '=', $code]
                    ])->first('id');


                if(is_null($target)) {
                    # Formateamos el nombre
                    $pieces = explode(' ',$calle->dir->nv);
                    if(in_array((string) end($pieces), $nombreCheck,false)) {
                        $nombre = mb_strtolower(end($pieces));
                        $e = 0; $lenght =  count($pieces) - 1;
                        foreach ($pieces as $word) {
                            if($e != $lenght) $nombre = $nombre." ".ucwords(mb_strtolower($word));
                            $e++;
                        }

                    } else {
                        $nombre = $calle->dir->nv;
                    }

                    # Concatenamos el tipo de vía
                    $nombre = $tiposVia[$via].$nombre;

                    # Insercción Vía en Base de Datos
                    DB::table('callejero')->insert([
                        'municipio' => $municipios[$i]->cp,
                        'codigo' => $code,
                        'nombre' => ucwords(mb_strtolower($nombre))
                    ]);

                    $nCalles++;
                }

            }
        }

        if($nCalles != 0) {
            return response()->json(['msg' => 'Se han añadido '.$nCalles.' nuevas calles al sistema.'], 201);
        } else {
            return response()->json(['msg' => 'Callejero actualizado. No existe ninguna calle nueva.'], 200);
        }
    }

}
