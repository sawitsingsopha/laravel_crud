<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (!function_exists('getSidebarMenus')) {
    function getSidebarMenus(): array
    {
        $user = Auth::user();
        if (!$user) return [];

        $permissions = DB::table('userlevel_permission')
            ->where('userlevel_id', $user->userlevel_id)
            ->where('access_method', 'view')
            ->pluck('access_model')
            ->toArray();

        $menus = config('menu.sidebar');

        // กรองเมนูตามสิทธิ์
        return array_filter($menus, fn($menu) => in_array($menu['model'], $permissions));
    }
}
