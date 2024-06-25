<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
class Privilegios extends Component
{
     use WithPagination;
    public $buscar = '';
    public $perPage = 10;
    public $ordenarPor = 'nombre';
    public $direccion = 'asc';
    public function render()
    {
        $roles = \App\Models\Privilegios::with(['submodulos', 'submodulos.modulos', 'roles'])
        ->select('privilegiosroles.roles_id', 'roles.nombre', \DB::raw('COUNT(privilegiosroles.submodulos_id) as cantidad'))
        ->join('roles', 'privilegiosroles.roles_id', '=', 'roles.id') // Unir con la tabla roles
        ->groupBy('privilegiosroles.roles_id', 'roles.nombre') // Agrupar por roles_id y roles.nombre
        ->where(function ($query) {
            $query->whereHas('roles', function ($query) {
                $query->where('roles.nombre', 'like', '%' . $this->buscar . '%')
                    ->orWhere('roles.descripcion', 'like', '%' . $this->buscar . '%');
            });
        })
        ->orderBy($this->ordenarPor, $this->direccion) // Ordenar usando la columna de roles
        ->paginate($this->perPage);
    
    
        return view('livewire.privilegios',compact('roles'));
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
