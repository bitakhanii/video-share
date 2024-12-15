<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*if (!auth()->user()->hasVerifiedEmail()) {
            return redirect()->route('index')->with(['alert' => __('alerts.danger.verify'), 'alert-type' => 'danger']);
        }*/
        if (auth()->user() && auth()->user()->isAdmin) {
            return $next($request);
        }
        return redirect('/')->with('error', 'شما مجاز به دسترسی نیستید.');
    }
}
