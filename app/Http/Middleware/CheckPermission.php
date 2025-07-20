<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckPermission
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthenticated');
        }

        $routeName = $request->route()->getName(); // เช่น users.edit

        // ✅ ยกเว้นบาง route ไม่ต้องเช็คสิทธิ์
        $skipRoutes = [
            'userlevel.permissions',
            'userlevel.permissions.update',
        ];
        if (in_array($routeName, $skipRoutes)) {
            return $next($request);
        }

        // ✅ แยก model, method
        [$model, $method] = explode('.', $routeName) + [null, 'list'];

        if (!$model || !$method) {
            abort(403, 'Permission format invalid');
        }

        // ✅ map Laravel action → permission method
        $methodMap = [
            'index'   => 'view',
            'show'    => 'view',
            'create'  => 'add',
            'store'   => 'add',
            'edit'    => 'edit',
            'update'  => 'edit',
            'destroy' => 'delete',
            'delete'  => 'delete',
        ];
        $method = $methodMap[$method] ?? $method;

        // ✅ เช็คสิทธิ์ในฐานข้อมูล
        $hasPermission = DB::table('userlevel_permission')
            ->where('userlevel_id', $user->userlevel_id)
            ->where('access_model', $model)
            ->where('access_method', $method)
            ->exists();

        if (!$hasPermission) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}
