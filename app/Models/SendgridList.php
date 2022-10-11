<?php

namespace App\Models;

use App\Models\Traits\Relationship\SendgridListRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class SendgridList
 * @package App\Models
 */
class SendgridList extends Model
{
    use HasFactory,
        SendgridListRelationship,
        AsSource,
        Filterable;

    /**
     * @var string
     */
    protected $table = 'sendgrid_lists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'list_id',
        'name',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'list_id',
        'name',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'list_id',
        'name',
        'created_at',
        'updated_at',
    ];
}
