<?php

namespace App\Http\Middleware;

use Closure;

class CameFromPaypal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $payer_id = request('PayerID') ?? false;
        $paymentId = request('paymentId') ?? false;
        $payment_status = (bool)request('success') ?? false;
        $user_id = request('user_id') ?? false;

        if ($payment_status && $payer_id && $paymentId && $user_id) {
            return $next($request);
        }

        return redirect('home');
    }
}
