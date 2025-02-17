<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ArrowLink extends Component
{
    /**
     * The title of the link.
     *
     * @var string
     */
    public $title;

    /**
     * The URL of the link.
     *
     * @var string
     */
    public $href;

    /**
     * The target attribute of the link.
     *
     * @var string|null
     */
    public $target;

    /**
     * Create a new component instance.
     *
     * @param string $title
     * @param string $href
     * @param string|null $target
     */
    public function __construct(string $title, string $href, ?string $target = null)
    {
        $this->title = $title;
        $this->href = $href;
        $this->target = $target;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $target = $this->target ? " target=\"{$this->target}\"" : '';
        $icon = <<<SVG
        <svg class="icon icon--arrow-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" height="24px" width="24px" fill="none">
            <path fill="currentColor" d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z" />
        </svg>
        SVG;
        
        return <<<HTML
        <a class="x-arrow-link" href="{$this->href}"{$target}>
            {$this->title}
            {$icon}
        </a>
        HTML;
    }
}
