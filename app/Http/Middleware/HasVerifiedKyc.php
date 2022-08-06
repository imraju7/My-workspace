<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasVerifiedKyc
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
        $user = auth()->user()->load(['role']);
        if ($user->role->name == 'customer') {
            if (!$user->customer) {
                return redirect()->route('customer.kyc')->with('warning','You need to fill up your information first');
            }
        }
        if ($user->role->name == 'candidate') {
            if (!$user->candidate) {
                return redirect()->route('candidate.kyc')->with('warning','You need to fill up your information first');
            }
        }
        return $next($request);
    }
}
