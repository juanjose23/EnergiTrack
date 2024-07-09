<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Planes;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
class Home extends Controller
{
    //
    public function index()
    {
        return view('Page.index');
    }
    public function nosotros()
    {
        return view('Page.about');
    }
    public function contacto()
    {
        return view('Page.contacto');
    }

    public function subcripciones()
    {
        $planes = Planes::with(['condiciones','precios' => function ($query) {
            $query->where('estado', 1);
        }])
        ->whereHas('precios', function ($query) {
            $query->where('estado', 1);
        })
        ->get();
       //return $planes;
        return view('Page.planes',compact('planes'));
    }

    public function compra($id)
    {
        $plan = Planes::with(['condiciones','precios','categorias' => function ($query) {
                $query->where('estado', 1);
            }])
            ->whereHas('precios', function ($query) {
                $query->where('estado', 1);
            })
            ->find($id);
    
        if (!$plan) {
            abort(404, 'Plan no encontrado');
        }
    
        return view('Page.compra', compact('plan'));
    }
    

    public function charge(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $charge = Charge::create([
            'amount' => 1000,
            'currency' => 'usd',
            'description' => 'Example charge',
            'source' => $request->stripeToken,
        ]);
        return redirect()->back()->with('success', 'Pago realizado con éxito');
    }
}

