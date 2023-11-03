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
        [
            'label'=> 'Thêm bình luận',
            'route'=> 'comment.create'

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
    ]


?>