<?php
return array(
    'CodeOrders\\V1\\Rest\\Ptypes\\Controller' => array(
        'description' => 'Handles payment types',
        'collection' => array(
            'description' => 'Collection of PaymentTypes',
            'GET' => array(
                'description' => 'List all payment types',
                'response' => '{
   "_links": {
       "self": {
           "href": "/ptypes"
       },
       "first": {
           "href": "/ptypes?page={page}"
       },
       "prev": {
           "href": "/ptypes?page={page}"
       },
       "next": {
           "href": "/ptypes?page={page}"
       },
       "last": {
           "href": "/ptypes?page={page}"
       }
   }
   "_embedded": {
       "ptypes": [
           {
               "_links": {
                   "self": {
                       "href": "/ptypes[/:ptypes_id]"
                   }
               }
              "name": "Name of payment type"
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => 'Create a new payment type',
                'request' => '{
   "name": "Name of payment type"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/ptypes[/:ptypes_id]"
       }
   }
   "id":"Id of payment type"
   "name": "Name of payment type"
}',
            ),
        ),
        'entity' => array(
            'description' => 'PaymentType Entity',
            'GET' => array(
                'description' => 'Returns a payment type',
                'response' => '{
   "_links": {
       "self": {
           "href": "/ptypes[/:ptypes_id]"
       }
   }
  "id":"ID",
   "name": "Name of payment type"
}',
            ),
            'PATCH' => array(
                'description' => 'Update partialy a payment type',
                'request' => '{
   "name": "Name of payment type"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/ptypes[/:ptypes_id]"
       }
   }
   "name": "Name of payment type"
}',
            ),
        ),
    ),
);
