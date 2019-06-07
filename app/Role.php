<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class Role extends Model
{
    public $timestamps = false;

    protected $table = 'roles';

    protected $fillable = [
        'name', 'slug', 'permissions'
    ];

    protected $casts = [
        'permissions' => 'array'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'roles_users', 'role_id', 'user_id');
    }

    public function hasAccess(array $permissions)
    {
        foreach ($permissions as $permission){
            if ($this->hasPermission($permission)){
                return true;
            }
        }
        return false;
    }

    public function hasPermission($permission)
    {
        return $this->permissions[$permission] ?? false;
    }
}
