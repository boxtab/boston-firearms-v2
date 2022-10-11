<?php

namespace App\Models;

use App\Models\Traits\Relationship\RoleUsersRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RoleUsers
 * @package App\Models
 */
class RoleUsers extends Model
{
    use RoleUsersRelationship;

    protected $table = 'role_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'role_id',
    ];
}
