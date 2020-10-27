<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Distribucion
 * @package App\Models
 * @mixin \Eloquent
 */
class Distribucion extends Model
{
    use HasFactory;

    /**
     * @var string Nombre de la tabla que almacena al modelo.
     */
    protected $table = 'distribucion';

    /**
     * @var string[] Campos que pueden ser rellenados de forma masiva.
     */
    protected $fillable =  ['id', 'empalme_id', 'cp', 'lat', 'lon', 'in', 'out', 'con'];

    /**
     * @var string[] Campos que no serán devueltos en JSON
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Devuelve la caja de empalme que suministra la conexión al nodo.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empalme() {
        return $this->belongsTo('\App\Models\Empalme');
    }
}
