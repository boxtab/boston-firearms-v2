<?php

namespace App\Models;

use App\Models\Traits\Attribute\AppointmentAttribute;
use App\Models\Traits\Method\AppointmentMethod;
use App\Models\Traits\Relationship\AppointmentRelationship;
use App\Models\Traits\Scope\AppointmentScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Appointment extends Model
{
    use HasFactory,
        SoftDeletes,
        AsSource,
        Filterable,
        AppointmentRelationship,
        AppointmentMethod,
        AppointmentAttribute,
        AppointmentScope;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_id',
        'event_date',
        'start_time',
        'end_time',
        'spots',
        'remaining_spots',
        'registration_fee',
        'deposit_fee',
        'payment_type',
        'has_live_fire',
        'is_guest_allowed',
        'added_by'
    ];

    protected $appends = [
        'date_time_formatted',
        'session',
        'url'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'added_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'event_date'   => 'date',
        'start_time'   => 'datetime',
        'end_time'     => 'datetime',
    ];

    /**
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'event_id',
        'event_date',
        'start_time',
        'end_time',
        'spots',
        'registration_fee',
        'deposit_fee',
        'payment_type',
        'has_live_fire',
        'is_guest_allowed',
        'added_by',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'event_id',
        'event_date',
        'start_time',
        'end_time',
        'spots',
        'registration_fee',
        'deposit_fee',
        'payment_type',
        'has_live_fire',
        'is_guest_allowed',
        'added_by',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
