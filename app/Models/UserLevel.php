<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserLevel extends Model
{
    use HasFactory;

    protected $table = 'user_level';
    protected $primaryKey = 'userlevel_id';
    public $timestamps = true;

    protected $fillable = ['user_level_name'];

    public function permissions()
    {
        return $this->hasMany(UserlevelPermission::class, 'userlevel_id');
    }
}
