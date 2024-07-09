<?php

namespace App\Livewire;

use App\Models\Ventas;
use Livewire\Component;
use Livewire\WithPagination;

class Venta extends Component
{
    use WithPagination;
    public $buscar = '';
    public $perPage = 10;
    public $ordenarPor = 'nombre';
    public $direccion = 'asc';

    public function render()
    {
        $query = Ventas::select(
            'ventas.id',
            'ventas.instalacion',
            'ventas.precio',
            'ventas.iva',
            'ventas.total',
            'planes.id as plan_id',
            'planes.nombre',
           
            'ventas.estado',
            'categorias.nombre as categoria',
            'personas.nombre as personas',
            'personas.apellido',
            'users.email',
        )
            ->leftJoin('users', 'ventas.users_id', '=', 'users.id') // Join con la tabla users
            ->leftJoin('personas', 'users.personas_id', '=', 'personas.id') // Join con la tabla personas
            ->leftJoin('planes', 'ventas.planes_id', '=', 'planes.id') // Join con la tabla planes
            ->leftJoin('categorias', 'planes.categorias_id', '=', 'categorias.id') // Join con la tabla categorias
            ->where(function ($q) {
                $q->where('ventas.precio', 'like', '%' . $this->buscar . '%')
                    ->orWhere('ventas.instalacion', 'like', '%' . $this->buscar . '%')
                    ->orWhere('ventas.iva', 'like', '%' . $this->buscar . '%')
                    ->orWhere('planes.nombre', 'like', '%' . $this->buscar . '%')
                    ->orWhere('categorias.nombre', 'like', '%' . $this->buscar . '%')
                    ->orWhere('personas.nombre', 'like', '%' . $this->buscar . '%')
                    ->orWhere('personas.apellido', 'like', '%' . $this->buscar . '%');
            });

        // Aplicar ordenamiento dinámico
        if ($this->ordenarPor === 'categoria') {

            $query->orderBy('categorias.nombre', $this->direccion);
        }
        if ($this->ordenarPor === 'personas') {
            $query->orderBy('personas.nombre', $this->direccion);// Arreglar el nombre de la tabla
        } else {
            $query->orderBy( $this->ordenarPor, $this->direccion);
        }

        // Obtener resultados paginados
        $ventas = $query->paginate($this->perPage);

        return view('livewire.venta',compact('ventas'));
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
