<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class AdminMiddleware
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
        /** @var null|\App\Models\User $user */
        $user = $request->user();

        if ($user === null) {
            return abort(500);
        }

        if (!$user->is_admin)
        {
            return abort(401);
        }

        return $next($request);
    }
}
