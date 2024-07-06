<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condiciones extends Model
{
    use HasFactory;
    public function planes()
    {
        return $this->belongsToMany(Planes::class, 'plan_condiciones', 'condiciones_id', 'planes_id');
    }
    
}
