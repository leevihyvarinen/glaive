<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Icon extends Component
{
    public $name;

    public function __construct($name = null)
    {
        $this->name = $name;
    }

    public function render()
    {
        if (!empty($this->name)) {
            $path = get_theme_file_path('/public/icons/' . $this->name . '.svg');

            if (file_exists($path)) {
                $content = file_get_contents($path);
                return $content;
            }
        }

        return null;
    }
}
