<?php
namespace CodeOrders\V1\Rest\Orders;

class OrdersEntity
{
    protected $id;
    protected $client_id;
    protected $user_id;
    protected $ptype_id;
    protected $total;
    protected $status;
    protected $created_at;
    protected $items;

    public function __construct()
    {
        $this->items = [];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return OrdersEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @param mixed $client_id
     * @return OrdersEntity
     */
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     * @return OrdersEntity
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPtypeId()
    {
        return $this->ptype_id;
    }

    /**
     * @param mixed $ptype_id
     * @return OrdersEntity
     */
    public function setPtypeId($ptype_id)
    {
        $this->ptype_id = $ptype_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     * @return OrdersEntity
     */
    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return OrdersEntity
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     * @return OrdersEntity
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param $item
     * @return $this
     */
    public function addItems($item)
    {
        $this->items[] = $item;
        return $this;
    }


}
