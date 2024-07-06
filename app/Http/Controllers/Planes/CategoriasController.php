<?php

namespace App\Http\Controllers\Planes;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategorias;
use App\Http\Requests\UpdateCategorias;
use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoriasController extends Controller
{
    //
    public function index()
    {
       return view('Gestion_Planes.Categorias.index');
    }

    public function create()
    {
        return view('Gestion_Planes.Categorias.create');
    }

    public function store(StoreCategorias $request)
    {
        $categoria = new Categorias();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->estado = $request->estado;
        $categoria->save();
        Session::flash('success', 'Se ha registado correctamente la operación');
        return redirect()->route('categorias.index');
    }
    public function edit($categorias)
    {
        $categorias = Categorias::findOrFail($categorias);

        return view('Gestion_Planes.Categorias.edit', compact('categorias'));
    }
    //
    public function update(UpdateCategorias $request, $categorias)
    {
        $categoria = Categorias::findOrFail($categorias);
        // Verificar si los datos han cambiado
        if (

            $categoria->nombre != $request->nombre ||
            $categoria->descripcion != $request->descripcion ||
            $categoria->estado != $request->estado
        ) {


            $categoria->nombre = $request->nombre;
            $categoria->descripcion = $request->descripcion;
            $categoria->estado = $request->estado;
            $categoria->save();

            // Mostrar mensaje solo si hay cambios
            Session::flash('success', 'El proceso se ha completado exitosamente.');
        }

        return redirect()->route('categorias.index');
    }
    //
    public function destroy($categorias)
    {
        // Encuentra el cargo por su ID
        $categoria = Categorias::findOrFail($categorias);

        // Cambia el estado del cargo
        $categoria->estado = $categoria->estado == 1 ? 0 : 1;
        $categoria->save();
        // Redirige de vuelta a la página de índice con un mensaje flash
        Session::flash('success', 'El estado del categoria ha sido cambiado exitosamente.');

        return redirect()->route('categorias.index');
    }
   
}
