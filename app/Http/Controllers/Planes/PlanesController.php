<?php

namespace App\Http\Controllers\Planes;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlanes;
use App\Http\Requests\UpdatePlan;
use App\Models\Categorias;
use App\Models\Condiciones;
use App\Models\Media;
use App\Models\Plan_Condiciones;
use App\Models\Planes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
class PlanesController extends Controller
{
    //
    public function index()
    {
       return view('Gestion_Planes.Planes.index');
    }

    public function create()
    {
        $categorias=Categorias::where('estado',1)->get();
        $condiciones=Condiciones::all();
        return view('Gestion_Planes.Planes.create',compact('categorias','condiciones'));
    }

    public function store(StorePlanes $request)
    {
        $plan = new Planes();
        $plan->categorias_id = $request->categorias;
        $plan->nombre = $request->nombre;
        $plan->descripcion = $request->descripcion;
        $plan->estado = $request->estado;
        $plan->dispositivos = $request->dispositivos;

        $plan->save();
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreArchivo = time() . '.' . $imagen->getClientOriginalExtension(); // Generar un nombre único para el archivo
            
            // Almacenar físicamente el archivo en el almacenamiento
            $rutaArchivo = $imagen->storeAs('public/Planes', $nombreArchivo);
        
            // Crear el registro en la tabla media con la URL correcta
            $nuevaImagen = new Media();
            $nuevaImagen->url = Storage::url('Planes/' . $nombreArchivo); // Ajustar la URL según la ubicación de tu almacenamiento
            $nuevaImagen->imagenable_id = $plan->id;
            $nuevaImagen->imagenable_type = get_class($plan);
            $nuevaImagen->save();
        }
        $plan->condiciones()->sync($request->condiciones);
        return redirect()->route('plan.index')->with('success', 'Plan creado exitosamente.');
    }
    public function edit(Planes $plan)
    {
        $plan = Planes::findOrFail($plan->id);
        $categorias=Categorias::where('estado',1)->get();
     
        return view('Gestion_Planes.Planes.edit', compact('plan','categorias'));
    }
    //
    public function update(UpdatePlan $request, $planes)
    {
        $plan = Planes::findOrFail($planes);
        // Verificar si los datos han cambiado
    
        $plan->categorias_id = $request->categorias;
        $plan->nombre = $request->nombre;
        $plan->descripcion = $request->descripcion;
        $plan->estado = $request->estado;
        $plan->dispositivos = $request->dispositivos;

        if ($request->hasFile('imagen')) {
            if($plan->imagenes)
            {
                Storage::delete(str_replace('storage', 'public', $plan->imagenes->url));

                // Eliminar el registro de la imagen en la base de datos
                $plan->imagenes->delete();
            }
            $imagen = $request->file('imagen');
            $nombreArchivo = time() . '.' . $imagen->getClientOriginalExtension(); // Generar un nombre único para el archivo
            
            // Almacenar físicamente el archivo en el almacenamiento
            $rutaArchivo = $imagen->storeAs('public/Planes', $nombreArchivo);
        
            // Crear el registro en la tabla media con la URL correcta
            $nuevaImagen = new Media();
            $nuevaImagen->url = Storage::url('Planes/' . $nombreArchivo); // Ajustar la URL según la ubicación de tu almacenamiento
            $nuevaImagen->imagenable_id = $plan->id;
            $nuevaImagen->imagenable_type = get_class($plan);
            $nuevaImagen->save();
        }
        $plan->save();
        return redirect()->route('plan.index')->with('success', 'Plan actualizado exitosamente.');
    }
    //
    public function destroy($plan)
    {
        // Encuentra el cargo por su ID
        $planes = Planes::findOrFail($plan);

        // Cambia el estado del cargo
        $planes->estado = $planes->estado == 1 ? 0 : 1;
        $planes->save();
        // Redirige de vuelta a la página de índice con un mensaje flash
        Session::flash('success', 'El estado  ha sido cambiado exitosamente.');

        return redirect()->route('plan.index');
    }



    public function show(Planes $plan)
    {
        $planes=Planes::findOrFail($plan->id);
        $condiciones = $plan->condiciones()->get();
        $condicionSelect = Condiciones::whereNotExists(function ($query) use ($plan) {
            $query->select(DB::raw(1))
                  ->from('plan_condiciones')
                  ->whereColumn('condiciones.id', 'plan_condiciones.condiciones_id')
                  ->where('plan_condiciones.planes_id', $plan->id);
        })->get();
        
        return view('Gestion_Planes.Planes.show',compact('planes','condiciones','condicionSelect'));
    }

    public function nuevascondiciones(Request $request)
    {
      
        $plan = Planes::findOrFail($request->id);
    
        $condiciones = $request->condiciones; 
        // Recorre las condiciones y agrégalas manualmente a la tabla pivote
        foreach ($condiciones as $condicionId) {
            Plan_Condiciones::firstOrCreate([
                'planes_id' => $plan->id,
                'condiciones_id' => $condicionId,
            ]);
        }
        return redirect()->back()->with('success', ' Se ha registrado correctamente');
    }
    public function destroycon(Request $request)
    {
        // Obtener el ID de la condición que se desea eliminar
        $idCondicion = $request->input('id_condicion');
    
        // Buscar el registro que deseas eliminar
        $condicion = Plan_Condiciones::where('planes_id', $request->id)
            ->where('condiciones_id', $idCondicion)
            ->first();
  
        if ($condicion) {
            // Eliminar el registro encontrado
            $condicion->delete();
    
            // Redireccionar de vuelta a la página anterior con un mensaje de éxito
            return redirect()->back()->with('success', 'La condición se ha eliminado correctamente');
        } else {
            // Si no se encontró el registro, redirigir con un mensaje de error o manejar como sea necesario
            return redirect()->back()->with('error', 'No se encontró la condición para eliminar');
        }
    }
}
