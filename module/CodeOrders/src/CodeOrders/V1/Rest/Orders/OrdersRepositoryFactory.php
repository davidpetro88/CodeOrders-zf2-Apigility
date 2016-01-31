<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 12/24/15
 * Time: 8:56 PM
 */

namespace CodeOrders\V1\Rest\Orders;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\TableGateway\TableGateway;

class OrdersRepositoryFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $dbAdapter = $serviceLocator->get('DbAdapter');
        $hydrator = new HydratingResultSet(new ClassMethods(), new OrdersEntity());
        $tableGateway = new TableGateway('orders', $dbAdapter, null, $hydrator);
        $orderItemTableGateway = $serviceLocator->get('CodeOrders\\V1\\Rest\\Orders\\OrderItemTableGataway');
        $clientTableGateway = $serviceLocator->get('CodeOrders\\V1\\Rest\\Clients\\ClientsTableGateway');
        return new OrdersRepository($tableGateway, $orderItemTableGateway,$clientTableGateway);
    }
}