<?php
namespace CodeOrders\V1\Rest\Orders;

class OrdersResourceFactory
{
    public function __invoke($services)
    {
        $ordersRepository = $services->get('CodeOrders\\V1\\Rest\\Orders\\OrdersRepository');
        $ordersService = $services->get('CodeOrders\\V1\\Rest\\Orders\\OrdersService');
        return new OrdersResource($ordersRepository, $ordersService);
    }
}
