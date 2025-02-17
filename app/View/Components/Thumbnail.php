<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Thumbnail extends Component
{
    public $size;

    protected $allowedSizes = ['thumbnail', 'medium', 'large', 'full'];
    protected $defaultSize = 'medium';

    public function __construct($size = null)
    {
        $this->size = in_array($size, $this->allowedSizes) ? $size : $this->defaultSize;
    }

    public function render()
    {
        $thumbnailId = get_post_thumbnail_id();
        $thumbnailUrl = $thumbnailId ? get_the_post_thumbnail_url(null, $this->size) : null;
        $thumbnailAlt = $thumbnailId ? get_post_meta($thumbnailId, '_wp_attachment_image_alt', true) : '';

        if ($thumbnailUrl) {
            return <<<HTML
                <img class="x-thumbnail" src="{$thumbnailUrl}" alt="{$thumbnailAlt}">
            HTML;
        }

        return '';
    }
}
