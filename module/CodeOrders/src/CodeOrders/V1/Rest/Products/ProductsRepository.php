<?php

namespace CodeOrders\V1\Rest\Products;


use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\DbTableGateway;

class ProductsRepository
{
    /**
     * @var TableGatewayInterface
     */
    private $tableGateway;
    /**
     * Constructor of class
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct(TableGatewayInterface $tableGateway){
        $this->tableGateway = $tableGateway;
    }

    public function findAll(){
        $tableGateway = $this->tableGateway;
        $paginatorAdapter = new DbTableGateway($tableGateway);
        return new ProductsCollection($paginatorAdapter);
    }

    public function find($id){
        $resultSet = $this->tableGateway->select(['id' => (int)$id]);
        if($resultSet->count() == 1) return $resultSet->current();
        return false;
    }

    public function create($productEntity){
        return $this->tableGateway->insert((array) $productEntity);
    }

    public function patch($id, $data)
    {
        $this->tableGateway->update((array)$data, ["id" => (int)$id]);
        return $this->find($id);
    }

    public function update($id, $data){
        $this->tableGateway->update((array)$data, ["id" => (int)$id]);
        return $this->find($id);
    }

    public function delete($id){
        $this->tableGateway->delete(['id' => (int)$id]);
        return true;
    }

    public function findByUsername($username)
    {
        return $this->tableGateway->select(['username' => $username])->current();
    }

}