<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;
    public function planes()
    {
        return $this->hasMany(Planes::class, 'categorias_id');
    }
}
