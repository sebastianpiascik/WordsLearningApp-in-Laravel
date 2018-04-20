<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
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
        $roles = array_slice(func_get_args(), 2); // nie przekazuje 2 pierwszych arg

        $user_role = $request->user()->roles()->first()->name;

//        dd($user_role);

        $string_roles='';
        foreach ($roles as $role) {
            $string_roles.=$role.', ';
        }

        if (! in_array($user_role, $roles)) {
            return redirect('/')->with('success','Strona dostępna wyłącznie dla osob z rolami: '.$string_roles);
        }

        return $next($request);
    }
}
