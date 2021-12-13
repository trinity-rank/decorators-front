<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Decorators extends Component
{
    public $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.decorators.decorators');
    }
}
