<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 12/24/15
 * Time: 8:59 PM
 */

namespace CodeOrders\V1\Rest\Orders;


use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;
use Zend\Stdlib\Hydrator\ClassMethods;
use AssetManager\Exception\RuntimeException;

class OrderItemHydratorStrategy implements StrategyInterface
{
    /**
     * @var ClassMethods $hydrator
     */
    private $hydrator;
    /**
     * Constructor of class
     * @param ClassMethods $hydrator
     */
    public function __construct(ClassMethods $hydrator){
        $this->hydrator = $hydrator;
    }

    /**
     * {@inheritDoc}
     * @see \Zend\Stdlib\Hydrator\Strategy\StrategyInterface::extract()
     */
    public function extract( $items ) {
        $data = [];
        foreach($items as $item)
            $data[] = $this->hydrator->extract($item);
        return $data;
    }
    /**
     * {@inheritDoc}
     * @see \Zend\Stdlib\Hydrator\Strategy\StrategyInterface::hydrate()
     */
    public function hydrate( $value ) {
        throw new RuntimeException('Hydrations is not suported');
    }
}