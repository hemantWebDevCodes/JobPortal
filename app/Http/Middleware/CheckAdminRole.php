<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

       if($request->user() == null){
          return redirect()->route('Home');
       }

       if($request->user()->role != 'admin'){
         session()->flash('error','You Are Not Authorized to Acess this Page.');
          return redirect()->route('Account.Profile');
       }
     
        return $next($request);
    }
}
