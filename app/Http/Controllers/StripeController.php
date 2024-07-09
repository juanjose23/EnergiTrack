<?php

namespace App\Http\Controllers;

use App\Models\Ventas;
use Illuminate\Http\Request;
use App\Models\Payment;

class StripeController extends Controller
{
    //
    public function stripe(Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
        $totalInCents = intval($request->total * 100);

        $response = $stripe->checkout->sessions->create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'NIO',
                        'product_data' => [
                            'name' => $request->product_name,
                            'description' =>'Compra de plan',
                        ],
                        'unit_amount' => $totalInCents,
                    ],
                    'quantity' => $request->quantity,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('cancel'),
        ]);
        
        if(isset($response->id) && $response->id != ''){
            session()->put('plan', $request->id);
            session()->put('cantidad', $request->quantity);
            session()->put('instalacion', $request->instalacion);
            session()->put('precio', $request->price);
            session()->put('iva', $request->iva);
            session()->put('total', $request->total);
            return redirect($response->url);
        } else {
            return redirect()->route('cancel');
        }
    }

    public function success(Request $request)
    {
        if(isset($request->session_id)) {

            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);
         
    
            $payment = new Ventas();
            $payment->users_id = session()->get('IdUser');
            $payment->planes_id = session()->get('plan');
           
            $payment->precio = session()->get('precio');
            $payment->instalacion = session()->get('instalacion');
            $payment->iva =session()->get('iva') ;
            $payment->total =session()->get('total');
         
            $payment->estado = 1;
            $payment->save();
    
         
    
            session()->forget('plan');
            session()->forget('cantidad');
            session()->forget('precio');
            session()->forget('iva');
            session()->forget('instalacion');
            session()->forget('total');
            return redirect()->route('inicio')->with('success','Se ha completado la compra');
        } else {
            return redirect()->route('cancel');
        }
    }

    public function cancel()
    {
        session()->forget('plan');
        session()->forget('cantidad');
        session()->forget('precio');
        session()->forget('iva');
        session()->forget('instalacion');
        session()->forget('total');
        return redirect()->route('inicio')->with('success','Se ha cancelado la compra');
    }
}
