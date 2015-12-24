<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 12/24/15
 * Time: 7:43 PM
 */

namespace CodeOrders\V1\Rest\Orders;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class OrderItemTableGatewayFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        //$dbAdapter = $serviceLocator->get('DbAdapter');
        $dbAdapter = $serviceLocator->get('DbMySQL');
        $hydrator = new HydratingResultSet( new ClassMethods(), new OrderItemEntity() );
        $tableGateway = new TableGateway('order_item', $dbAdapter, null,$hydrator);
        return $tableGateway;
    }
}