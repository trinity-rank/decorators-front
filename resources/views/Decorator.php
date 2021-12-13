<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Decorator extends Component
{
    public $decorator;
    public $model;

    public function __construct($decorator, $model)
    {
        $this->decorator = $decorator;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $filesInFolder = \File::files(resource_path().'/views/components/decorators');

        $doesDecoratorExists = collect($filesInFolder)->map(function ($path) {
            return str_replace('.blade', '', pathinfo($path)['filename']);
        })
            ->contains(function ($decoratorName) {
                return $decoratorName === $this->decorator['layout'];
            });

        if(!$doesDecoratorExists) {
            return;
        }

        $data = $this->decorator['data'];
        $model = $this->model;

        return view('components.decorators.'.$this->decorator['layout'], compact('data', 'model'));
    }
}
