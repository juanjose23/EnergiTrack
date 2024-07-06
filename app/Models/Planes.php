<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planes extends Model
{
    use HasFactory;
    public function imagenes()
    {
        return $this->morphOne('App\Models\Media', 'imagenable');
    }

    public function categorias()
    {
        return $this->belongsTo(Categorias::class, 'categorias_id');
    }
    public function condiciones()
    {
        return $this->belongsToMany(Condiciones::class, 'plan_condiciones', 'planes_id', 'condiciones_id');
    }

    public function precios()
    {
        return $this->hasMany(Precios::class);
    }
}
