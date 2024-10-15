<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AppMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $route = explode('.', $request->route()->getName())[0];

        $user = Auth::user();

        $permissions = [];

        if ($user->permssion) {
            $permissions = json_decode($user->permssion, true)[$route];
        }

        $groups = $user->groups;

        foreach ($groups as $group) {
            $permission = $group->permission;
        }

        Gate::define('all-user', function ($permissions) {
            return in_array('all-user', $permissions);
        });

        $module = $request->route($route);

        if ($module && in_array($request->route()->getActionName(), $permissions)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($module && $module->id) {
            $module_id = $module->id;

            $relactions = Str::plural($route);

            $permission = $user->{$relactions}
                ->where('id', $module_id)->first();

            $groups = $user->groups;

            foreach ($groups as $group) {
                $permission = $group->{$relactions}->where('id', $module_id)->first();
            }

            if (!$permission) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        }

        return $next($request);
    }
}
