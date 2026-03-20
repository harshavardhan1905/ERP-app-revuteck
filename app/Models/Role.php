<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;
  

    // Define your custom schema and table
    protected $table = 'master_erp.roles';
    

    // IMPORTANT: You must list all columns you want to allow Laravel to insert into
    protected $fillable = [
        'role_name',
        'role_code',
        'role_level',
        'role_category',
        'description',
        'is_system_role',
        'is_active',
    ];
}