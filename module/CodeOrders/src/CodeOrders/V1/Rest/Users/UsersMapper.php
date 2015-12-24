<?php
namespace CodeOrders\V1\Rest\Users;


use CodeOrders\V1\Rest\Users\UsersEntity;
use Zend\Stdlib\Hydrator\HydratorInterface;


class UsersMapper extends UsersEntity implements HydrationInterface
{
    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        return [
            'id' => $object->id,
            'username' => $object->username,
            'password' => $object->password,
            'first_name' => $object->firstName,
            'last_name' => $object->lastName,
            'role' => $object->role
        ];
    }
    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        $object->id = $data['id'];
        $object->username = $data['username'];
        $object->password = $data['password'];
        $object->firstName = $data['first_name'];
        $object->lastName = $data['last_name'];
        $object->role = $data['role'];
        return $object;
    }
}