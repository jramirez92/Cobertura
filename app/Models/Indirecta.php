<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indirecta extends Model
{
    use HasFactory;

    protected $table = 'indirecta';

    protected $fillable = [
        'id', 'cp', 'calle_id', 'numero', 'lat', 'lon'
    ];

    public function calle() {
        $this->belongsTo('App\Models\Callejero');
    }
}
