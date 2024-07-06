<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precios extends Model
{
    use HasFactory;
    public function planes()
    {
        return $this->belongsTo(Planes::class);
    }
    public function ObtenerProductosConCategorias()
    {
        $categorias = Categorias::with('planes')->whereNotIn('id', function ($query) {
            $query->select('planes_id')->from('precios');
        })->get();

        $categoriasConPlanes = [];

        foreach ($categorias as $categoria) {
            $categoriasConPlanes[$categoria->nombre] = $categoria->planes;
        }

        return $categoriasConPlanes;
    }
}
