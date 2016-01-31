<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 1/10/16
 * Time: 1:54 PM
 */

namespace CodeOrders\V1\Rest\Clients;


use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Paginator\Adapter\DbTableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ClientsRepositoryFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $tableGateway = $serviceLocator->get('CodeOrders\\V1\\Rest\\Clients\\ClientsTableGateway');
        return new ClientsRepository($tableGateway);
    }
}