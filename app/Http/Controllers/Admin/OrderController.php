<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\Searchable;
use Illuminate\View\View;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Invoice;

class OrderController extends Controller
{

    function __construct()
    {
        $this->middleware(['permission:job category create|job category update|job category delete']);
    }

    //
    use Searchable;

    public function index(): View
    {
        $query = Order::query();
        $query->with(['company', 'plan']);
        $this->search($query, ['package_name', 'transaction_id', 'order_id', 'payment_provider', 'amount', 'paid_in_currency', 'payment_status', 'created_at']);

        $orders = $query->orderBy('id', 'DESC')->paginate(20);

        return view('admin.order.index', compact('orders'));
    }

    public function show(string $id): View
    {
        $order = Order::findOrFail($id);

        return view('admin.order.show', compact('order'));
    }

    public function invoice(string $id)
    {
        // Create a new invoice instance with the invoice number 1234567890
        $order = Order::findOrFail($id);

        $customer = new Buyer([
            'name' => $order?->company?->name,
            'custom_fields' => [
                'email' => $order?->company?->email,
                'transaction' => $order?->transaction_id,
                'payment Method' => $order?->payment_provider,
            ],
        ]);

        $seller = new Party([
            'name' => config('settings.site_name'),
            'phone' => config('settings.site_phone'),
            'custom_fields' => [
                'email' => config('settings.site_email'),
                // 'business id' => '365#GG',
            ],
        ]);

        $item = InvoiceItem::make($order->package_name . ' Plan')
            ->pricePerUnit($order->amount);

        // Create invoice
        $invoice = Invoice::make()
            ->series($order->order_id)
            ->sequence(1001)
            ->currencyCode($order->paid_in_currency)
            ->currencySymbol($order->paid_in_currency)
            ->buyer($customer)
            ->seller($seller)
            ->status('paid')
            ->payUntilDays(0)
            ->addItem($item)
            ->logo(public_path($order->company->logo))
            ->filename('invoice_' . $order->order_id)
            ->date(now())
            ->notes('Thank you for your business!, For support, contact ' . config('settings.site_email'));

        return $invoice->download();
    }
}
