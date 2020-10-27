<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Callejero extends Model
{
    use HasFactory;

    protected $table = 'callejero';

    protected $fillable = ['municipio', 'nombre'];

    protected $hidden = ['id', 'codigo', 'created_at', 'updated_at'];
}
