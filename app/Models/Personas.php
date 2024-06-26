<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    use HasFactory;
    
    public function usuarios()
    {
        return $this->HasOne('App\Models\User');
    }
}
