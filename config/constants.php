<?php

return [
    'user_type' => [
        'admin'     => 0,
        'user'  => 1,
    ],
    'emptyData'         => new \stdClass(),
    'validResponse'     => [
        'success'    => true,
        'statusCode' => 200,
    ],
    'invalidResponse'   => [
        'success'    => false,
        'statusCode' => 400,
    ],
    'invalidToken'      => [
        'success'    => false,
        'statusCode' => 401,
        'message'    => 'Unauthorized User!',
    ],
    'type'      => [
        'image'    => 'image',
        'description' => 'description'
    ],
    'side'      => [
        'left'    => 'left',
        'right' => 'right',
        'center'    => 'center',
    ],
];
