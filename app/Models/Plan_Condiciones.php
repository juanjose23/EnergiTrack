<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan_Condiciones extends Model
{
    use HasFactory;
    protected $table="plan_condiciones";
    protected $fillable = [
        'planes_id', 
        'condiciones_id',
    ];

    public function condiciones()
    {
        return $this->belongsToMany(Condiciones::class, 'plan_condiciones', 'planes_id', 'condiciones_id');
    }

}
