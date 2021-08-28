export default [{
    _name: 'CSidebarNav',
    _children: [{
            _name: 'CSidebarNavItem',
            name: 'Trang chủ',
            to: '/dashboard',
            icon: 'cil-home'
        },
        {
            _name: 'CSidebarNavDropdown',
            name: 'Quản lí vai trò',
            route: '/position',
            icon: 'cil-lan',
            items: [{
                name: 'Thêm vai trò',
                to: '/position/detail-position'
            },
                {
                    name: 'Danh sách vai trò',
                    to: '/position/positions'
                }
            ]
        },
        // {
        //     _name: 'CSidebarNavDropdown',
        //     name: 'Quản lí vai trò',
        //     route: '/role',
        //     icon: 'cil-drop',
        //     items: [{
        //             name: 'Thêm vai trò',
        //             to: '/role/detail-role'
        //         },
        //         {
        //             name: 'Danh sách vai trò',
        //             to: '/role/roles'
        //         }
        //     ]
        // },
        {
            _name: 'CSidebarNavDropdown',
            name: 'Quản lí tài khoản',
            route: '/account',
            icon: 'cil-user',
            items: [{
                    name: 'Thêm tài khoản',
                    to: '/account/detail-account'
                },
                {
                    name: 'Danh sách tài khoản',
                    to: '/account/accounts'
                }
            ]
        },
        {
            _name: 'CSidebarNavDropdown',
            name: 'Danh mục bài viết',
            route: '/category',
            icon: 'cil-list',
            items: [{
                    name: 'Thêm danh mục',
                    to: '/category/detail-category'
                },
                {
                    name: 'Danh sách danh mục',
                    to: '/category/categories'
                }
            ]
        },
        {
            _name: 'CSidebarNavDropdown',
            name: 'Quản lí bài viết',
            route: '/news',
            icon: 'cil-newspaper',
            items: [{
                    name: 'Thêm bài viết',
                    to: '/news/detail-news'
                },
                {
                    name: 'Danh sách bài viết',
                    to: '/news/list-news'
                }
            ]
        },
        {
            _name: 'CSidebarNavItem',
            name: 'Bài viết chờ phê duyệt',
            to: '/cv',
            icon: 'cil-reload'
        },
        {
            _name: 'CSidebarNavItem',
            name: 'Thùng rác',
            to: '/email-sub',
            icon: 'cil-recycle'
        },
        // {
        //     _name: 'CSidebarNavDropdown',
        //     name: 'Quản lí chi nhánh',
        //     route: '/branch',
        //     icon: 'cil-star',
        //     items: [{
        //             name: 'Thêm chi nhánh',
        //             to: '/branch/detail-branch'
        //         },
        //         {
        //             name: 'Danh sách chi nhánh',
        //             to: '/branch/branchs'
        //         }
        //     ]
        // },
        // {
        //     _name: 'CSidebarNavDropdown',
        //     name: 'Quản lí tuyên dụng',
        //     route: '/recruitment',
        //     icon: 'cil-bell',
        //     items: [{
        //             name: 'Đăng tin tuyển dụng',
        //             to: '/recruitment/detail-recruitment'
        //         },
        //         {
        //             name: 'Danh sách tin tuyển dụng',
        //             to: '/recruitment/list-recruitment'
        //         }
        //     ]
        // }
    ]
}]
