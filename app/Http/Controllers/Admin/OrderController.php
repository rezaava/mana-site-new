<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Services;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    //

    public function index()
    {
        $orders = Order::latest()->paginate(15);

        foreach ($orders as $order) {
            $order['service'] = Services::where('id', $order->service_id)->first();
        }

        return view('admin.orders.index', compact('orders'));
    }
    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()
            ->route('orders.index')
            ->with('success', 'تیکت با موفقیت حذف شد.');
    }
}
