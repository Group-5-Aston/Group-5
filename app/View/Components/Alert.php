<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Uses bootstrap default alerts. Change $type to the alert type, see
 * https://getbootstrap.com/docs/4.1/components/alerts/ on what types
 */

class Alert extends Component
{
    public $type;
    public $message;
    /**
     * Create a new component instance.
     */


    public function __construct($type = "success", $message = null)
    {
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
