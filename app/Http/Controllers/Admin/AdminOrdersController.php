<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;


class AdminOrdersController extends Controller
{
    public function orders(Request $request)
    {
        $search = $request->input('search');
        $orders = Order::query();

        if (!empty($search)) {
            $orders->whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
                ->orWhere('status', 'like', "%$search%");
        }

        $orders = $orders->get();

        if ($request->ajax()) {
            return response()->json([
                'orders' => $orders->map(function ($order) {
                    return [
                        'order_id' => $order->order_id,
                        'user_id' => $order->user_id,
                        'name' => $order->user->name,
                        'total' => $order->total,
                        'address' => $order->address,
                        'status' => $order->status,
                        'created_at' => $order->created_at->format('Y-m-d H:i:s'),
                        'updated_at' => $order->updated_at->format('Y-m-d H:i:s'),
                        'order_url' => route('adminorder.show', ['order' => $order->order_id]),
                    ];
                })
            ]);
        }

        return view('newpages.newadminpages.adminorders', compact('orders'));
    }
}
