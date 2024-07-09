<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    //
    public function index()
    {
       return view('Gestion_Ventas.Clientes.index');
    }
}
