<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class OrderController extends Controller
{
    //

    function index() : View
    {
         $orders = Order::paginate(20);
        return view('admin.order.index',compact('orders'));
    }

    function show(string $id) : View
    {
        $order = Order::findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    function invoice()
    {

        $customer = new Buyer([
            'name'          => 'John Doe',
            'custom_fields' => [
                'email' => 'test@example.com',
            ],
        ]);

        $item = InvoiceItem::make('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->discountByPercent(10)
            ->taxRate(15)
            ->shipping(1.99)
            ->addItem($item);

        return $invoice->stream();
    }

}
