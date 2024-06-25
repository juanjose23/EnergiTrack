<?php

namespace App\Livewire;

use App\Models\RolesModel;
use Livewire\Component;
use Livewire\WithPagination;
class Rol extends Component
{
    use WithPagination;
    public $buscar = '';
    public $perPage = 10;
    public $ordenarPor = 'nombre';
    public $direccion = 'asc'; // Dirección de ordenamiento predeterminada
    public function render()
    {
        // Realizar la búsqueda en todos los atributos del modelo
        $roles = RolesModel::where(function ($query) {
            $query->where('nombre', 'like', '%' . $this->buscar . '%')
                ->orWhere('descripcion', 'like', '%' . $this->buscar . '%');
        })
        ->orderBy($this->ordenarPor, $this->direccion) // Aplicar ordenamiento
        ->paginate($this->perPage);

        return view('livewire.rol',compact('roles'));
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
