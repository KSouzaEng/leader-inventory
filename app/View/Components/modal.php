<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Order;

class modal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $orderId;
    public $order;
    public function __construct($orderId,Order $order)
    {
        $this->orderId = $orderId;
        $this->order = $order;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
