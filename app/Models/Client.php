<?php

namespace App\Models;

use App\Models\Traits\Attribute\ClientAttribute;
use App\Models\Traits\Method\ClientMethod;
use App\Models\Traits\Relationship\ClientRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Client extends Model
{
    use HasFactory,
        AsSource,
        Filterable,
        ClientMethod,
        ClientAttribute,
        ClientRelationship,
        Notifiable;

    /**
     * @var string
     */
    protected $table = 'clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'date_of_birth',
        'is_guest',
        'ip_address',
        'squareup_customer_id',
        'paypal_payer_id',
        'added_by',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'added_by',
        'squareup_customer_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_guest' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'radiobutton_is_guest',
    ];

    /**
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'first_name',
        'last_name',
        'phone',
        'email',
        'is_guest',
        'added_by',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'first_name',
        'last_name',
        'phone',
        'email',
        'is_guest',
        'added_by',
        'created_at',
        'updated_at',
    ];
}
