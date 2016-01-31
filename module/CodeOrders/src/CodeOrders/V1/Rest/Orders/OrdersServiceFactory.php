<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 12/24/15
 * Time: 8:52 PM
 */

namespace CodeOrders\V1\Rest\Orders;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\TableGateway\TableGateway;

class OrdersServiceFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $orderRepository = $serviceLocator->get('CodeOrders\\V1\\Rest\\Orders\\OrdersRepository');
        $userRepository = $serviceLocator->get('CodeOrders\\V1\\Rest\\Users\\UsersRepository');
        $productsRepository = $serviceLocator->get('CodeOrders\\V1\\Rest\\Products\\ProductsRepository');
        return new OrdersService($orderRepository, $userRepository,$productsRepository );
    }
}