<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    /**
     * The title of the button.
     *
     * @var string
     */
    public $title;

    /**
     * The URL of the button.
     *
     * @var string
     */
    public $href;

    /**
     * The target attribute of the button.
     *
     * @var string|null
     */
    public $target;

    /**
     * The rel attribute of the button.
     *
     * @var string|null
     */
    public $rel;

    /**
     * The size of the button.
     *
     * @var string
     */
    public $size;

    /**
     * The color of the button.
     *
     * @var string
     */
    public $color;

    /**
     * Create a new component instance.
     *
     * @param string $title
     * @param string $href
     * @param string|null $target
     * @param string|null $rel
     * @param string $size
     * @param string $color
     */
    public function __construct(
        string $title,
        string $href,
        ?string $target = null,
        ?string $rel = null,
        string $size = 'medium',
        string $color = 'white'
    ) {
        $this->title = $title;
        $this->href = $href;
        $this->target = $target;
        $this->rel = $rel;

        $validSizes = ['small', 'medium', 'large'];
        $validColors = ['gray', 'white'];

        $this->size = in_array($size, $validSizes) ? $size : 'medium';
        $this->color = in_array($color, $validColors) ? $color : 'white';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $rel = $this->rel ? " rel=\"{$this->rel}\"" : '';
        $target = $this->target ? " target=\"{$this->target}\"" : '';
        $classes = "x-button x-button--{$this->size} x-button--{$this->color}";

        return <<<HTML
        <a class="{$classes}" href="{$this->href}"{$target}{$rel}>
            {$this->title}
        </a>
        HTML;
    }
}
