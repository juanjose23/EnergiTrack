<?php

namespace App\Http\Controllers\Planes;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePrecios;
use App\Models\Planes;
use App\Models\Precios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PreciosController extends Controller
{
    //
    public function index()
    {
        return view('Gestion_Planes.Precios.index');
    }

    //
    public function create()
    {
        $Precios = new Precios();
        $productos = $Precios->ObtenerProductosConCategorias();
        // return $productos;
        return view('Gestion_Planes.Precios.create', compact('productos'));
    }

    public function store(StorePrecios $request)
    {
        try {
            $precios = new Precios();
            $precios->planes_id = $request->planes;
            $precios->precios = $request->precios;
            $precios->estado = 1;
            $precios->save();
            Session::flash('success', 'Se ha registrado el precio de manera exitosa.');
            return redirect()->route('precios.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Ocurrió un error al intentar registrar el precio.');
            echo $e->getMessage();
            // return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }
    //
    public function edit(Precios $precios)
    {
        $precio = Precios::with(['planes'])->findOrFail($precios->id);
        $planes = Planes::findOrFail($precio->planes_id);
        $historial = Precios::where('planes_id', $planes->id)->get();
        return view('Gestion_Planes.Precios.edit', compact('precio', 'planes', 'historial'));
    }
    public function update(StorePrecios $request, $precios)
    {
        //Cambiar estado del precio anterior
        $precio = Precios::findOrFail($precios);
        $precio->estado = 2;
        $precio->save();

        $preciosN = new Precios();
        $preciosN->planes_id = $request->planes;
        $preciosN->precios = $request->precios;
        $preciosN->estado = 1;
        $preciosN->save();

        Session::flash('success', 'Se ha registrado la operacion con éxito.');
        return redirect()->route('precios.index');
    }
    public function show(Precios $precios)
    {
        $precio = Precios::findOrFail($precios->id);
        $historial = Precios::where('productosdetalles_id', $precio->productosdetalles_id)->get();

        return view('Gestion_Catalogos.Precios.show', compact('precio', 'historial'));
    }
    public function destroy(Precios $precios)
    {
        //Cambiar estado del precio anterior
        $precio = Precios::findOrFail($precios->id);
        $precio->estado = 2;
        $precio->save();

        Session::flash('success', 'Se ha registrado el cambio de estado de manera exitosa.');
        return redirect()->route('precios.index');
    }
 
}
