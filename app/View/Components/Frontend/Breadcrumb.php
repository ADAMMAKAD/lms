<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public array $links;
    public ?string $title;
    public ?string $subtitle;

    /**
     * Create a new component instance.
     * @param array $links
     * @param ?string $title
     * @param ?string $subtitle
     */
    public function __construct($links, $title, $subtitle = null) {
        $this->links = $links;
        $this->title = $title;
        $this->subtitle = $subtitle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.breadcrumb');
    }
}
