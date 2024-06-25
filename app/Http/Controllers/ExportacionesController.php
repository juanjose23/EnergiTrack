<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;

class ExportacionesController extends Controller
{
    //
    public function pdf($colaboradores)
    {
        // Usar transacción para asegurar la consistencia de los datos
        DB::beginTransaction();

        try {
            // Consulta eficiente con carga ansiosa
            $empleado = User::with('personas')
                ->findOrFail($colaboradores);
          
            $contraseña = $empleado->personas->telefono;
            $usuario = $empleado->email;
            $empleado->updated_at = now();
            $empleado->save();
            // Generar PDF

            $data = [
                'usuario' => $usuario,
                'contraseña' => $contraseña,
            ];

            // Load HTML content
            $html = view('Report.Credenciales', $data)->render();

            // Instantiate Dompdf
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);

            // Set paper size and orientation
            $dompdf->setPaper('A4', 'portrait');

            // Render PDF (important step!)
            $dompdf->render();

            // Output PDF to browser
            return $dompdf->stream('document.pdf');
            // Commit de la transacción




        } catch (\Exception $e) {
            // Rollback de la transacción en caso de error
            DB::rollback();

            // Manejar el error según sea necesario
            return response()->json(['error' => 'Error al generar el PDF'], 500);
        }
    }
}
