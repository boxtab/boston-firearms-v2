<?php

namespace App\Orchid\Field;


use Orchid\Screen\Fields\Input;

class FaqInput extends Input {

    /**
     * Blade template
     *
     * @var string
     */
    protected $view = 'platform::firearms.field.faq-input';

    /**
     * Default attributes value.
     *
     * @var array
     */
    protected $attributes = [
        'type'  => 'text',
        'class' => 'form-control',
        'placeholder' => 'Enter text here',
        'questionValue' => '',
        'answerValue' => 'zxc',
        'questionName' => 'asd',
        'answerName' => '',
    ];

    /**
     * Attributes available for a particular tag.
     *
     * @var array
     */
    protected $inlineAttributes = [
        'max',
        'min',
        'placeholder',
        'readonly',
        'required',
        'size',
        'type',
        'value',
        'mask',
    ];

    public function faqItem(array $item = []): self
    {
        if (empty($item)) {
            return $this;
        }

        return $this->addBeforeRender(function () use ($item){
            $this->set('questionValue', $item['question']??'');
            $this->set('answerValue', $item['answer']??'');
            $this->set('questionName', $this->get('name') . '[' . ($item['index']??0) .'][question]');
            $this->set('answerName', $this->get('name') . '[' . ($item['index']??0) .'][answer]');
        });
    }
}
