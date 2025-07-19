<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

if (! function_exists('canList')) {
    function canList($model)
    {
        return DB::table('userlevel_permission')
            ->where('userlevel_id', Auth::user()->userlevel_id)
            ->where('access_model', $model)
            ->where('access_method', 'list')
            ->exists();
    }
}