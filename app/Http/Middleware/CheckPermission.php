<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle($request, Closure $next, $model, $method = 'list')
    {
        $userlevelId = Auth::user()->userlevel_id;

        $hasPermission = DB::table('userlevel_permission')
            ->where('userlevel_id', $userlevelId)
            ->where('access_model', $model)
            ->where('access_method', $method)
            ->exists();

        if (!$hasPermission) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}