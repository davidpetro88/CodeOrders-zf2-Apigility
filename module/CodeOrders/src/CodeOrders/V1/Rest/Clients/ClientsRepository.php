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

class ClientsRepository
{

    /**
     * @var AbstractTableGateway
     */
    private $tableGateway;

    public function __construct(AbstractTableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function findAll()
    {
        $paginatorAdapter = new DbTableGateway($this->tableGateway);
        return new ClientsCollection($paginatorAdapter);
    }

}