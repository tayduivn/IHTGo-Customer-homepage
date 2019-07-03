<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Company;
use App\Models\Order;

class HomeController extends Controller
{

    public function index()
    {
        $customer = Customer::getUserOfCustomer();
        $company = Company::listCompanyAll();
        return view('index', ['customer' => $customer, 'company' => $company]);
    }
    public function contact()
    {
        $customer = Customer::getUserOfCustomer();
        $company = Company::listCompanyAll();
        return view('contact', ['customer' => $customer, 'company' => $company]);
    }
    public function price_list()
    {
        $customer = Customer::getUserOfCustomer();
        $company = Company::listCompanyAll();
        return view('price-list', ['customer' => $customer, 'company' => $company]);
    }
    public function news()
    {
        $customer = Customer::getUserOfCustomer();
        $company = Company::listCompanyAll();
        return view('news', ['customer' => $customer, 'company' => $company]);
    }
    public function new_detail()
    {
        $customer = Customer::getUserOfCustomer();
        $company = Company::listCompanyAll();
        return view('new-detail', ['customer' => $customer, 'company' => $company]);
    }
    public function order()
    {
        $customer = Customer::getUserOfCustomer();
        $company = Company::listCompanyAll();
        $order = Order::getList();
        $order_watting = Order::getList_Status(1);
        $order_no_delivery = Order::getList_Status(2);
        $order_beging_delivery = Order::getList_Status(3);
        $order_done_delivery = Order::getList_Status(4);
        $order_customer_cancel = Order::getList_Status(5);
        $order_iht_cancel = Order::getList_Status(6);
        $order_fail = Order::getList_Status(7);

        $sum_order = 0;
        foreach($order as $item) {
            $sum_order += $item->total_price;
        }
        return view('order', [
            'customer' => $customer,
            'company' => $company,
            'order' => $order,
            'order_watting'=>$order_watting,
            'order_no_delivery'=>$order_no_delivery,
            'order_beging_delivery'=>$order_beging_delivery,
            'order_done_delivery'=>$order_done_delivery,
            'order_customer_cancel'=>$order_customer_cancel,
            'order_iht_cancel'=>$order_iht_cancel,
            'order_fail'=>$order_fail,
            'sum_order' => $sum_order
        ]);
    }
    public function order_detail()
    {
        $customer = Customer::getUserOfCustomer();
        $company = Company::listCompanyAll();
        return view('order-detail', ['customer' => $customer, 'company' => $company]);
    }
}
