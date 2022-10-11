<?php

namespace App\Repositories;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class EventRepository
 * @package App\Repositories
 */
class EventRepository extends Repository implements EventRepositoryInterface
{
    /**
     * EventRepository constructor.
     * @param Event $model
     */
    public function __construct(Event $model)
    {
        parent::__construct($model);
    }

    /**
     * @param Event $event
     * @param array $eventFields
     */
    public function store(Event $event, array $eventFields)
    {
        $event->fill([
            'title'                         => $eventFields['title'],
            'short_description'             => $eventFields['short_description'],
            'description'                   => $eventFields['description'],
            'price'                         => $eventFields['price'],
            'active'                        => (int)$eventFields['radiobutton_active'] - 1,
            'has_live_fire'                 => (int)$eventFields['radiobutton_has_live_fire'] - 1,
            'slug'                          => $eventFields['slug'],
            'course_certification_number'   => $eventFields['course_certification_number'],
            'who_class_for'                 => $eventFields['who_class_for'],
            'faqs'                          => $eventFields['faqs'],
            'added_by'                      => Auth::id(),
        ]);

        $event->save();
    }
}
