<?php
namespace CodeOrders\V1\Rest\Orders;
use CodeOrders\V1\Rest\Products\ProductsRepository;
use CodeOrders\V1\Rest\Users\UsersRepository;
use Zend\Stdlib\Hydrator\ObjectProperty;
use Zend\Db\TableGateway\AbstractTableGateway;

class OrdersService {
    /**
     * @var $tableGateway
     */
    private $repository;

    /**
     * @var UsersRepository
     */
    private $userRepository;
    /**
     * @var ProductsRepository
     */
    private $productRepository;

    public function __construct(OrdersRepository $repository,
                                UsersRepository $userRepository,
                                ProductsRepository $productRepository){
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
    }

    public function create($data){
        $hydrator = new ObjectProperty();
        $data->user_id = $this->userRepository->getAuthenticated()->getId();
        $data->created_at = (new \DateTime())->format('Y-m-d');
        $data->total = 0;
        $items = $data->item;
        unset($data->item);
        $orderData = $hydrator->extract($data);
        $tableGateway = $this->repository->getTableGateway();


        /**
         * Watching transactions in orders
         */
        try {
            $tableGateway->getAdapter()->getDriver()->getConnection()->beginTransaction();
            $orderId = $this->repository->insert($orderData);
            $total = 0;
            foreach($items as $key => $item){
                $product = $this->productRepository->find($item['product_id']);
                $item['order_id'] = $orderId;
                $item['price'] = $product->getPrice();
                $item['total'] = $items[$key]['total'] = $item['quantity'] * $item['price'];
                $total += $item['total'];
                $this->repository->insertItem($item);
            }
            $this->repository->update(['total'=> $total], $orderId);
            $tableGateway->getAdapter()->getDriver()->getConnection()->commit();
            return ['order_id' => $orderId];
        }catch (\Exception $e){
            $tableGateway->getAdapter()->getDriver()->getConnection()->rollback();
            return 'error';
        }
    }
}