<?php

namespace App\Livewire;

use App\Models\Planes;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Precios as precio;
class Precios extends Component
{
    use WithPagination;
    public $buscar = '';
    public $perPage = 10;
    public $ordenarPor = 'nombre';
    public $direccion = 'asc';

    public function render()
    {
        $planes = Planes::with(['precios' => function ($query) {
            $query->where('estado', 1);
        }])
        ->whereHas('precios', function ($query) {
            $query->where('estado', 1);
        })
        ->orWhereDoesntHave('precios', function ($query) {
            $query->where('estado', 1);
        })
        ->orderBy($this->ordenarPor, $this->direccion) // Aplicar ordenamiento
        ->paginate($this->perPage);

        return view('livewire.precios',compact('planes'));
    }
    public function ordenar($columna)
    {

        if ($columna === $this->ordenarPor) {
            $this->direccion = $this->direccion === 'asc' ? 'desc' : 'asc';
        } else {
            $this->direccion = 'asc';
        }
        $this->ordenarPor = $columna; // Establecer la columna de ordenamiento
    }
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->gotoPage(1); // Reiniciar el paginado a la página 1
    }
}
