<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 1/10/16
 * Time: 2:20 PM
 */

namespace CodeOrders\V1\Rest\Clients;


use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

class ClientsTableGatewayFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $dbAdaper = $serviceLocator->get('DbAdapter');
        $hydrator = new HydratingResultSet(new ClassMethods(), new ClientsEntity());
        return new TableGateway('clients', $dbAdaper, null, $hydrator);
    }
}