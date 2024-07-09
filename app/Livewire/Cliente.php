<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Cliente extends Component
{
    use WithPagination;
    public $buscar = '';
    public $perPage = 10;
    public $ordenarPor = 'email';
    public $direccion = 'asc'; // Dirección de ordenamiento predeterminada
    public function render()
    {
        $usuarios = User::with(['personas', 'rolesusuarios'])
            ->whereHas('rolesusuarios', function ($query) {
                $query->where('roles_id', 1) // Filtrar por roles_id igual a 1
                    ->orWhere('roles_id', 2); // o roles_id igual a 2
            })
            ->where(function ($query) {
                $query->where('personas_id', 'like', '%' . $this->buscar . '%')
                    ->orWhere('email', 'like', '%' . $this->buscar . '%')
                    ->orWhereHas('personas', function ($query) {
                        $query->where('nombre', 'like', '%' . $this->buscar . '%')
                              ->where('apellido', 'like', '%' . $this->buscar . '%');
                    });
            })
            ->orderBy($this->ordenarPor, $this->direccion) // Convertir a minúsculas
            ->paginate($this->perPage);
    
        return view('livewire.cliente', compact('usuarios'));
    }
    
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->gotoPage(1); // Reiniciar el paginado a la página 1
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
}
