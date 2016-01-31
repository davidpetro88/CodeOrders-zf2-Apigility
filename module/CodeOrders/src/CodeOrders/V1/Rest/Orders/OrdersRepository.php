<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 12/24/15
 * Time: 8:58 PM
 */

namespace CodeOrders\V1\Rest\Orders;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Paginator\Adapter\ArrayAdapter;

class OrdersRepository
{
    /**
     * @var AbstractTableGateway
     */
    private $tableGateway;
    /**
     * @var AbstractTableGateway
     */
    private $orderItemTableGateway;
    /**
     * @var AbstractTableGateway
     */
    private $clientTableGateway;

    public function __construct(AbstractTableGateway $tableGataway, AbstractTableGateway $orderItemTableGateway, AbstractTableGateway $clientTableGateway){
        $this->tableGateway = $tableGataway;
        $this->orderItemTableGateway = $orderItemTableGateway;
        $this->clientTableGateway = $clientTableGateway;
    }

    public function fecthAll(){
        $hydrator = new ClassMethods();
        $hydrator->addStrategy('items', new OrderItemHydratorStrategy(new ClassMethods()));
        $orders = $this->tableGateway->select();
        $res = [];
        /** @var  $order \CodeOrders\V1\Rest\Orders\OrdersEntity */
        foreach ($orders as $order){
            $items = $this->orderItemTableGateway->select(['order_id' => $order->getId()]);
            foreach ($items as $item){
                $order->addItem($item);
            }
            $res[] = $hydrator->extract($order);
        }
        $arrayAdapter = new ArrayAdapter($res);
        $ordersCollection = new OrdersCollection($arrayAdapter);
        return $ordersCollection;
    }

    public function find($id)
    {
        $resultSet = $this->tableGateway->select(['id' => (int) $id]);
        if($resultSet->count() == 1)
        {
            $hydrator = new ClassMethods();
            $hydrator->addStrategy('items', new OrderItemHydratorStrategy(new ClassMethods()));
            $order = $resultSet->current();

            $client = $this->clientTableGateway->select(['id' => $order->getClientId()])->current();

            $sql = $this->orderItemTableGateway->getSql();
            $select = $sql->select();
            $select->join('products', 'order_items.product_id = products.id', ['product_name' => 'name'])
                   ->where(['order_id' => $order->getId()]);
            $items = $this->orderItemTableGateway->selectWith($select);
            $order->setClient($client);
            foreach( $items as $item){
                $order->addItem($item);
            }

            $data = $hydrator->extract($order);
            return $data;
        }

        return false;
    }

    public function insert(array $data)
    {
        $this->tableGateway->insert($data);
        $id = $this->tableGateway->getLastInsertValue();
        return $id;
    }

    public function insertItem(array $data)
    {
        $this->orderItemTableGateway->insert($data);
        return $this->orderItemTableGateway->getLastInsertValue();
    }

    public function update(array $data, $id)
    {
        $this->tableGateway->update($data,['id' => $id]);
        return $id;
    }

    public function getTableGateway(){
        return $this->tableGateway;
    }

}