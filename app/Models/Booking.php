<?php

namespace App\Models;

use App\Models\Traits\Attribute\BookingAttribute;
use App\Models\Traits\Method\BookingMethod;
use App\Models\Traits\Relationship\BookingRelationship;
use App\Models\Traits\Scope\BookingScope;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Booking
 * @package App\Models
 */
class Booking extends Model
{
    use BookingRelationship,
        BookingAttribute,
        BookingMethod,
        BookingScope,
        AsSource,
        Filterable,
        SoftDeletes;

    const STATUS_PENDING = 1;
    const STATUS_BOOKED = 2;
    const STATUS_CANCELED = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'appointment_id',
        'client_id',
        'info_source_id',
        'guests',
        'groupon_code',
        'status',
        'visited',
        'is_waiver',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    /**
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'appointment_id',
        'client_id',
        'payment_id',
        'guests',
        'groupon_code',
        'visited',
        'is_waiver',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'appointment_id',
        'client_id',
        'payment_id',
        'guests',
        'groupon_code',
        'visited',
        'is_waiver',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
