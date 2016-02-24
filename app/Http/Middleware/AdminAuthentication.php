<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;

use Closure;

class AdminAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $auth;
    
    public function __construct(Guard $auth){
        $this->auth = $auth;
    }
    
    public function handle($request, Closure $next)
    {
            if ($this->auth->check())
                  {
                      if ($this->auth->user()->is_admin == true)
                      {
                          return $next($request);
                      }
                  }
        return new RedirectResponse(url('/'));
    }
}
