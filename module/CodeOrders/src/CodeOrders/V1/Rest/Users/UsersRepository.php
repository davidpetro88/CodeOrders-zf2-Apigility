<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 12/24/15
 * Time: 2:20 PM
 */

namespace CodeOrders\V1\Rest\Users;


use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\DbTableGateway;
use ZF\MvcAuth\Identity\AuthenticatedIdentity;

class UsersRepository
{
    /**
     * @var TableGatewayInterface
     */
    private $tableGateway;
    /**
     * @var AuthenticatedIdentity
     */
    private $auth;


    public function __construct(TableGatewayInterface $tableGateway, AuthenticatedIdentity $auth)
    {
       $this->tableGateway = $tableGateway;
        $this->auth = $auth;
    }

    public function findAll()
    {
        $tableGateway = $this->tableGateway;
        $paginatorAdapter = new DbTableGateway($tableGateway);
        return new UsersCollection($paginatorAdapter);
    }

    public function find($id)
    {
        $resultSet = $this->tableGateway->select(['id' => (int)$id]);
        return $resultSet->current();
    }

    public function findByUsername($username)
    {
        return $this->tableGateway->select(['username' => $username])->current();
    }

    public function getAuthenticated()
    {
        return $this->findByUsername($this->auth->getAuthenticationIdentity()['user_id']);
    }
}
