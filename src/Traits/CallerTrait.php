<?php

namespace Dmitriidigital\UnitPay\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Dmitriidigital\UnitPay\Exceptions\InvalidPaidOrder;
use Dmitriidigital\UnitPay\Exceptions\InvalidSearchOrder;

trait CallerTrait
{
    /**
     * @param Request $request
     * @return mixed
     *
     * @throws InvalidSearchOrder
     */
    public function callSearchOrder(Request $request)
    {
        if (is_null(config('unitpay.searchOrder'))) {
            throw new InvalidSearchOrder();
        }

        return App::call(config('unitpay.searchOrder'), [
            'order_id' => $request->input('params.account'),
            'payment_type' => $request->input('params.paymentType'),
        ]);
    }

    /**
     * @param Request $request
     * @param $order
     * @return mixed
     * @throws InvalidPaidOrder
     */
    public function callPaidOrder(Request $request, $order)
    {
        if (is_null(config('unitpay.paidOrder'))) {
            throw new InvalidPaidOrder();
        }

        return App::call(config('unitpay.paidOrder'), ['order' => $order]);
    }
}
