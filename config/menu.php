<?php

return [
    'sidebar' => [
        [
            'label' => 'Dashboard',
            'route' => 'dashboard.index',
            'icon' => 'dashboard',
            'model' => 'dashboard',
        ],
        [
            'label' => 'จัดการผู้ใช้งาน',
            'route' => 'users.index',
            'icon' => 'users',
            'model' => 'users',
        ],
        [
            'label' => 'สิทธิ์ผู้ใช้งาน',
            'route' => 'userlevel.index',
            'icon' => 'shield',
            'model' => 'userlevel',
        ]
        // [
        //     'label' => 'สินค้า',
        //     'route' => 'products.index',
        //     'icon' => 'box',
        //     'model' => 'products',
        // ],
    ],
];
