<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\Storage;


Class  AdminViewOrderController extends Controller
{
    public function showOrder(Order $order)
    {
        $orderItems = $order->orderItems;
        return view('newpages.newadminpages.adminvieworder', compact('order', 'orderItems'));
    }
}
