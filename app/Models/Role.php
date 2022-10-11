<?php

namespace App\Models;

use App\Models\Traits\Relationship\RoleRelationship;

/**
 * Class Role
 * @package App\Models
 */
class Role
{
    use RoleRelationship;

    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'name',
        'permissions',
    ];
}
