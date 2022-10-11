<?php

namespace App\Orchid\Layouts\Event;

use App\Constants\ResultPerPageConstant;
use App\Orchid\Field\FaqInput;
use App\Orchid\Field\InputAddRemove;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\Radio;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layout;

class EventFaqsLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        $items = $this->query->get('event.faqs', [
            [
                'question' => '',
                'answer' => ''
            ]
        ]);
        return array_map(function ($item, $index){
            return FaqInput::make()
                           ->name('event[faqs]')
                           ->faqItem([
                               'index' => $index,
                               'question' => $item['question']??'',
                               'answer' => $item['answer']??''
                           ])
                           ->max(255)
                           ->vertical();
        }, $items, array_keys($items));
    }
}
