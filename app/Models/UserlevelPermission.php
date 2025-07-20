<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserlevelPermission extends Model
{
    use HasFactory;

    protected $table = 'userlevel_permission';
    public $timestamps = false;

    protected $fillable = ['userlevel_id', 'access_model', 'access_method'];

    public function userLevel()
    {
        return $this->belongsTo(UserLevel::class, 'userlevel_id');
    }
}
