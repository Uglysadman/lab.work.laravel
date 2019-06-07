<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_users', 'user_id', 'role_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function hasAccess(array $permissions)
    {
        foreach ($this->roles as $role)
        {
            if ($role->hasAccess($permissions)){
                return true;
            }
        }
        return false;
    }

    public function hasRole($roleSlug)
    {
        return $this->roles()->where('slug', $roleSlug)->count() == 1;
    }
}
