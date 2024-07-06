<?php

namespace App\Livewire;

use App\Models\Planes;
use Livewire\Component;
use Livewire\WithPagination;

class Plan extends Component
{
    use WithPagination;
    public $buscar = '';
    public $perPage = 10;
    public $ordenarPor = 'nombre';
    public $direccion = 'asc';

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
    public function render()
    {
        $query = Planes::select('planes.id', 'planes.nombre', 'planes.descripcion', 'planes.dispositivos', 'planes.estado', 'categorias.nombre as categoria')
        ->leftJoin('categorias', 'planes.categorias_id', '=', 'categorias.id') // Join con la tabla categorias
        ->where(function ($q) {
            $q->where('planes.nombre', 'like', '%' . $this->buscar . '%')
                ->orWhere('planes.descripcion', 'like', '%' . $this->buscar . '%')
                ->orWhere('planes.dispositivos', 'like', '%' . $this->buscar . '%')
                ->orWhere('categorias.nombre', 'like', '%' . $this->buscar . '%');
        });
    
    // Aplicar ordenamiento dinámico
    if ($this->ordenarPor === 'categoria') {
        $query->orderBy('categorias.nombre', $this->direccion);
    } else {
        $query->orderBy('planes.' . $this->ordenarPor, $this->direccion);
    }
    
    // Obtener resultados paginados
    $planes = $query->paginate($this->perPage);
    
        return view('livewire.plan', compact('planes'));
    }
}
