<?php

namespace App\View\Components;

use Exception;
use Illuminate\Support\Facades\Log;
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
        try {
            $filesInFolder = \File::files(resource_path().'/views/components/decorators');

            $doesDecoratorExists = collect($filesInFolder)->map(function ($path) {
                return str_replace('.blade', '', pathinfo($path)['filename']);
            })
                ->contains(function ($decoratorName) {
                    return $decoratorName === $this->decorator['layout'];
                });

            if(!$doesDecoratorExists || $this->decorator['data'] == null) {
                return;
            }
            $data = $this->decorator['data'];
            $model = $this->model;

            return view('components.decorators.'.$this->decorator['layout'], compact('data', 'model'));

        } catch (Exception $e) {

            Log::error($e->getMessage().' for decorator: '.$this->decorator['layout']);

            return;
        }
    }
}
