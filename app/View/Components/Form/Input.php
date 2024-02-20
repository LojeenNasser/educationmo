<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Input extends Component
{
    public $title, $name, $value, $placeholder, $type;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $name, $value, $placeholder, $type)
    {
        $this->title = $title;
        $this->name = $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.input');
    }
}
