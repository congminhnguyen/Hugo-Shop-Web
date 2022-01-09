<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\CartService;
use App\Models\Customer;

class CartController extends Controller
{
    protected $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        return view('admin.carts.customer', [
            'title' => 'Order List',
            'customers' => $this->cart->getCustomer()
        ]);
    }

    public function update(Request $request, Customer $customer)
    {
        $result = $this->cart->updateCustomer($request, $customer);
        if($result){
            return redirect('admin/carts/customer');
        }
        return redirect()->back();
    }

    public function show(Customer $customer)
    {
        $carts = $this->cart->getProductForCart($customer);

        return view('admin.carts.detail', [
            'title' => 'Order Detail' . $customer->name,
            'customer' => $customer,
            'carts' => $customer,
            'carts' => $carts
        ]);
    }
}
