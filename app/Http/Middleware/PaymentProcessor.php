<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PaymentProcessor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Obtenemos el secret_key que envia la pasarela
        $secret_key = $request->headers->get('secret-key');

        $response = [];

        if ( !isset($secret_key) ) 
        {
            $response['error'] = [
                'message' => 'The secret key is missing',
                'type' => 'auth' 
            ];
        } 

        if( $secret_key != config('services.payment_processor.secret_key') ) 
        {
            $response['error'] = [
                'message' => 'The secret is wrong',
                'type' => 'auth' 
            ];
        }

        if(isset($response['error'])) 
        {
            return response()->json($response, 401);
        }
        
        return $next($request);
    }
}
