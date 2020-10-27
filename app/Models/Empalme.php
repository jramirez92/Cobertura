<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empalme extends Model
{
    use HasFactory;

    /**
     * @var string Nombre de la tabla que almacena al modelo.
     */
    protected $table = 'empalme';

    /**
     * @var string[] Campos que pueden ser rellenados de forma masiva.
     */
    protected $fillable = ['id', 'cp', 'calle_id', 'numero', 'lat', 'lon', 'in', 'out', 'con'];

    /**
     * @var string[] Campos que no serán devueltos en JSON.
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Obtiene todos los nodos de distribución conectados a la caja de empalme.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function distribucion() {
        return $this->hasMany('App\Models\Distribucion');
    }
}
