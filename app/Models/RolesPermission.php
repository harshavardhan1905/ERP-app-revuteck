<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $table = 'role_permissions';

    protected $fillable = [
        'role_id',
        'permission_id',
    ];

    public $timestamps = true;

    /**
     * 🔹 Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * 🔹 Permission
     */
    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }
}