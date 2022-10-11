<?php

namespace App\Models;

use App\Models\Traits\Relationship\BlacklistRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Blacklist extends Model
{
    use HasFactory,
        AsSource,
        Filterable,
        BlacklistRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'booking_id',
        'reason',
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
        'booking_id',
        'reason',
        'added_by',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'booking_id',
        'reason',
        'added_by',
        'created_at',
        'updated_at',
    ];
}
