<?php

namespace App\Models;

use App\Models\Traits\Attribute\EventAttribute;
use App\Models\Traits\Method\EventMethod;
use App\Models\Traits\Relationship\EventRelationship;
use App\Models\Traits\Scope\EventScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Illuminate\Notifications\Notifiable;

class Event extends Model
{
    use HasFactory,
        SoftDeletes,
        EventRelationship,
        EventMethod,
        EventAttribute,
        EventScope,
        AsSource,
        Filterable;

    /**
     * @var string
     */
    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'short_description',
        'description',
        'price',
        'active',
        'has_live_fire',
        'slug',
        'is_contact_form_only',
        'position',
        'is_featured',
        'custom_template',
        'waiver',
        'course_certification_number',
        'faqs',
        'who_class_for',
        'added_by',
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
        'active'          => 'boolean',
        'has_live_fire'   => 'boolean',
        'is_contact_form_only' => 'boolean',
        'who_class_for' => 'array',
        'faqs' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'radiobutton_active',
        'radiobutton_has_live_fire',
    ];

    /**
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'title',
        'short_description',
        'description',
        'price',
        'active',
        'has_live_fire',
        'slug',
        'waiver',
        'course_certification_number',
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
        'title',
        'short_description',
        'description',
        'price',
        'active',
        'has_live_fire',
        'slug',
        'waiver',
        'course_certification_number',
        'added_by',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
