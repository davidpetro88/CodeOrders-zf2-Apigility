<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 12/24/15
 * Time: 8:12 PM
 */

namespace CodeOrders\V1\Rest\Products;

use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ArraySerializable;

//use Zend\Stdlib\Hydrator\ClassMethods;


class ProductsRepositoryFactory implements FactoryInterface
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
//        $hydrator = new HydratingResultSet(new ClassMethods(), new ProductsEntity());
       $hydrator = new HydratingResultSet(new ArraySerializable(), new ProductsEntity());
        $tableGateway = new TableGateway('products', $dbAdapter, null, $hydrator);
        return new ProductsRepository($tableGateway);
    }
}