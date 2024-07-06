<?php

namespace App\Livewire;

use App\Models\Categorias;
use Livewire\Component;
use Livewire\WithPagination;
class Categoria extends Component
{
    use WithPagination;
    public $buscar = '';
    public $perPage = 10;
    public $ordenarPor = 'nombre';
    public $direccion = 'asc';
    public function render()
    {
        $categorias = Categorias::where(function ($query) {
            $query->where('nombre', 'like', '%' . $this->buscar . '%')
                ->orWhere('descripcion', 'like', '%' . $this->buscar . '%');
        })
            ->orderBy($this->ordenarPor, $this->direccion) // Aplicar ordenamiento
            ->paginate($this->perPage);
        return view('livewire.categoria', compact('categorias'));
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
