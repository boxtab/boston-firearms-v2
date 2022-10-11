<?php

namespace App\Models;

use App\Models\Traits\Attribute\PaymentAttribute;
use App\Models\Traits\Method\PaymentMethod;
use App\Models\Traits\Relationship\PaymentRelationship;
use App\Models\Traits\Scope\PaymentScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Payment
 * @package App\Models
 */
class Payment extends Model
{
    use SoftDeletes,
        PaymentAttribute,
        PaymentRelationship,
        PaymentScope,
        PaymentMethod;

    /**
     * @var string
     */
    protected $table = 'payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gateway',
        'type',
        'client_id',
        'booking_id',
        'transaction_id',
        'amount',
        'gateway_fee',
        'taxes',
        'status',
        'payment_token',
        'errors'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

}
