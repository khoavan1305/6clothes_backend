<?php 
    return [
     
        [
        'label'=> 'Quản lý sản phẩm',
        'route'=> 'product.index',
        'icon'=> ' fa-archive',
        'item' => [
            [
            'label'=> 'Danh sách sản phẩm',
            'route'=> 'product.index'
        ],
        [
            'label'=> 'Thêm sản phẩm',
            'route'=> 'product.create'
        ],
    ],
        ],
        [
        'label'=> 'Quản lý tài khoản',
        'route'=> 'user.index',
        'icon'=> 'fa-user',
        'item' => [
            [
            'label'=> 'Danh sách tài khoản',
            'route'=> 'user.index'

        ],
        [
            'label'=> 'Thêm tài khoản',
            'route'=> 'user.create'

        ],
    ],
        ],
        [
        'label'=> 'Quản lý bình luận',
        'route'=> 'comment.index',
        'icon'=> ' fa-comments',
        'item' => [
            [
            'label'=> 'Danh sách bình luận',
            'route'=> 'comment.index'

        ],
    ],
        ],
        [
        'label'=> 'Quản lý đơn hàng',
        'route'=> 'order.index',
        'icon'=> 'fa-shopping-cart',
        'item' => [
            [
            'label'=> 'Danh sách',
            'route'=> 'order.index'
        ],
    ],
        ],
        [
            'label'=> 'Quản lý Thương Hiệu',
            'route'=> 'brand.index',
            'icon'=> ' fa-archive',
            'item' => [
                [
                'label'=> 'Danh sách thương hiệu',
                'route'=> 'brand.index'
            ],
            [
                'label'=> 'Thêm thương hiệu',
                'route'=> 'brand.create'
            ],
        ],
            ],
        [
            'label'=> 'Quản lý danh mục',
            'route'=> 'category.index',
            'icon'=> ' fa-archive',
            'item' => [
                [
                'label'=> 'Danh sách danh mục',
                'route'=> 'category.index'
            ],
            [
                'label'=> 'Thêm danh mục',
                'route'=> 'category.create'
            ],
        ],
            ],
        [
            'label'=> 'Quản lý voucher',
            'route'=> 'voucher.index',
            'icon'=> ' fa-archive',
            'item' => [
                [
                'label'=> 'Danh sách voucher',
                'route'=> 'voucher.index'
            ],
            [
                'label'=> 'Thêm voucher',
                'route'=> 'voucher.create'
            ],
        ],
            ],
    ]


?>