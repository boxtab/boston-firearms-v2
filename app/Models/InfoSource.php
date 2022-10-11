<?php

namespace App\Models;

use App\Models\Traits\Attribute\InfoSourceAttribute;
use App\Models\Traits\Relationship\InfoSourceRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

/**
 * Class InfoSource
 * @package App\Models
 */
class InfoSource extends Model
{
    use HasFactory,
        InfoSourceRelationship,
        InfoSourceAttribute,
        AsSource,
        Filterable;

    /**
     * @var string
     */
    protected $table = 'info_sources';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'added_by',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'added_by',
    ];

    /**
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'title',
        'added_by',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'title',
        'added_by',
        'created_at',
        'updated_at',
    ];
}
