<?php

namespace App\Models;

use App\Models\Traits\Relationship\NotificationEventRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class NotificationEvent
 * @package App\Models
 */
class NotificationEvent extends Model
{
    use HasFactory,
        NotificationEventRelationship,
        AsSource,
        Filterable;

    /**
     * @var string
     */
    protected $table = 'notification_events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'sendgrid_list_id',
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
        'name',
        'slug',
        'sendgrid_list_id',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'slug',
        'sendgrid_list_id',
        'created_at',
        'updated_at',
    ];
}
