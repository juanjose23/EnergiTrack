<?php

namespace App\Livewire;

use App\Models\Planes;
use Livewire\Component;

class TarjetasPrecios extends Component
{
    public function render()
    {
        $planes = Planes::with(['precios' => function ($query) {
            $query->where('estado', 1);
        }])
        ->whereHas('precios', function ($query) {
            $query->where('estado', 1);
        })
        ->take(3)
        ->get();
        return view('livewire.tarjetas-precios',compact('planes'));
    }
}
