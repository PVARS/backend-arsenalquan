import Vue from 'vue'
import Router from 'vue-router'

// Containers
// const TheContainer = () =>
//     import ('@/containers/TheContainer')
import TheContainer from "../containers/TheContainer";

// Views
// const Dashboard = () =>
//     import ('@/views/Dashboard')
import Dashboard from "../views/Dashboard";

// const Roles = () =>
//     import ('@/views/role/ListRole')
// const DetailRole = () =>
//     import ('@/views/role/DetailRole')
// import Roles from "../views/role/ListRole";
// import DetailRole from "../views/role/DetailRole";

// const Accounts = () =>
//     import ('@/views/account/ListAccount')
// const DetailAccount = () =>
//     import ('@/views/account/DetailAccount')
import Accounts from "../views/account/ListAccount";
import DetailAccount from "../views/account/DetailAccount";

// const Categories = () =>
//     import ('@/views/category/Categories')
// const DetailCategory = () =>
//     import ('@/views/category/DetailCategory')
import Categories from "../views/category/Categories";
import DetailCategory from "../views/category/DetailCategory";

// const ListNews = () =>
//     import ('@/views/news/ListNews')
// const DetailNews = () =>
//     import ('@/views/news/DetailNews')
import ListNews from "../views/news/ListNews";
import DetailNews from "../views/news/DetailNews";

// const Positions = () =>
//     import ('@/views/position/Positions')
// const DetailPosition = () =>
//     import ('@/views/position/DetailPosition')
import Positions from "../views/position/Positions";
import DetailPosition from "../views/position/DetailPosition";

// const Branchs = () =>
//     import ('@/views/branch/Branchs')
// const DetailBranch = () =>
//     import ('@/views/branch/DetailBranch')
import Branchs from "../views/branch/Branchs";
import DetailBranch from "../views/branch/DetailBranch";

// const ListRecruitment = () =>
//     import ('@/views/recruitment/ListRecruitment')
// const DetailRecruitment = () =>
//     import ('@/views/recruitment/DetailRecruitment')
import ListRecruitment from "../views/recruitment/ListRecruitment";
import DetailRecruitment from "../views/recruitment/DetailRecruitment";

// const ListCV = () =>
//     import ('@/views/CV/ListCV')
import ListCV from "../views/CV/ListCV";

// const EmailSub = () =>
//     import ('@/views/emailsub/ListEmailSub')
import EmailSub from "../views/emailsub/ListEmailSub";

// Views - Pages
// const Page404 = () =>
//     import ('@/views/pages/Page404')
// const Page500 = () =>
//     import ('@/views/pages/Page500')
// const Login = () =>
//     import ('@/views/pages/Login')
import Page404 from "../views/pages/Page404";
import Page500 from "../views/pages/Page500";
import Login from "../views/pages/Login";

// const Forms = () =>
//     import ('@/views/base/Forms')
import Forms from "../views/base/Forms";
import axios from 'axios';

Vue.use(Router)

export default new Router({
    mode: 'history',
    linkActiveClass: 'active',
    scrollBehavior: () => ({ y: 0 }),
    routes: configRoutes()
})

function configRoutes() {
    return [
        {
            path: '/forms',
            name: 'Forms',
            component: Forms
        },{
            path: '/login',
            name: 'Login',
            component: Login
        }, {
            path: '/',
            redirect: '/dashboard',
            name: 'Trang chủ',
            component: TheContainer,
            beforeEnter: (to, from, next) => {
                const data = JSON.parse(localStorage.getItem('user_info'));
                
                if (!data) {
                    return next({name: 'Login'});
                } else {
                    let token = data['access_token'];

                    axios.get('/api/v1/admin/authenticated', {headers: {'Authorization': 'Bearer ' + token}}).then(()=> {
                        next()
                    }).catch(()=> {
                        return next({name: 'Login'})
                    })
                }
            },
            children: [{
                    path: 'dashboard',
                    name: 'Thống kê',
                    component: Dashboard
                },
                // {
                //     path: 'role',
                //     redirect: '/role/roles',
                //     name: 'Vai trò',
                //     component: {
                //         render(c) { return c('router-view') }
                //     },
                //     children: [{
                //             path: 'detail-role',
                //             name: 'Chi tiết vai trò',
                //             component: DetailRole
                //         },
                //         {
                //             path: 'roles',
                //             name: 'Danh sách vai trò',
                //             component: Roles
                //         }
                //     ]
                // },
                {
                    path: 'account',
                    redirect: '/account/accounts',
                    name: 'Tài khoản',
                    component: {
                        render(c) { return c('router-view') }
                    },
                    children: [{
                            path: 'detail-account',
                            name: 'Chi tiết tài khoản',
                            component: DetailAccount
                        },
                        {
                            path: 'accounts',
                            name: 'Danh sách tài khoản',
                            component: Accounts
                        }
                    ]
                },
                {
                    path: 'category',
                    redirect: '/category/categories',
                    name: 'Danh mục',
                    component: {
                        render(c) { return c('router-view') }
                    },
                    children: [{
                            path: 'detail-category',
                            name: 'Chi tiết danh mục',
                            component: DetailCategory
                        },
                        {
                            path: 'categories',
                            name: 'Danh sách danh mục',
                            component: Categories
                        }
                    ]
                },
                {
                    path: 'news',
                    redirect: '/news/list-news',
                    name: 'Bài viết',
                    component: {
                        render(c) { return c('router-view') }
                    },
                    children: [{
                            path: 'detail-news',
                            name: 'Chi tiết bài viết',
                            component: DetailNews
                        },
                        {
                            path: 'list-news',
                            name: 'Danh sách bài viết',
                            component: ListNews
                        }
                    ]
                },
                {
                    path: 'position',
                    redirect: '/position/positions',
                    name: 'Vị trí',
                    component: {
                        render(c) { return c('router-view') }
                    },
                    children: [{
                            path: 'detail-position',
                            name: 'Chi tiết vị trí',
                            component: DetailPosition
                        },
                        {
                            path: 'positions',
                            name: 'Danh sách vị trí',
                            component: Positions
                        }
                    ]
                },
                {
                    path: 'branch',
                    redirect: '/branch/branchs',
                    name: 'Chi nhánh',
                    component: {
                        render(c) { return c('router-view') }
                    },
                    children: [{
                            path: 'branchs',
                            name: 'Chi tiết chi nhánh',
                            component: DetailBranch
                        },
                        {
                            path: 'detail-branch',
                            name: 'Danh sách chi nhánh',
                            component: Branchs
                        }
                    ]
                },
                {
                    path: 'recruitment',
                    redirect: '/recruitment/list-recruitment',
                    name: 'Tuyển dụng',
                    component: {
                        render(c) { return c('router-view') }
                    },
                    children: [{
                            path: 'detail-recruitment',
                            name: 'Chi tiết tuyển dụng',
                            component: DetailRecruitment
                        },
                        {
                            path: 'list-recruitment',
                            name: 'Danh sách tuyển dụng',
                            component: ListRecruitment
                        }
                    ]
                },
                {
                    path: 'cv',
                    name: 'CV',
                    component: ListCV
                },
                {
                    path: 'email-sub',
                    name: 'Email đăng ký',
                    component: EmailSub
                },
                {
                    path: '/pages',
                    redirect: '/pages/404',
                    name: 'Pages',
                    component: {
                        render(c) { return c('router-view') }
                    },
                    children: [{
                            path: '404',
                            name: 'Page404',
                            component: Page404
                        },
                        {
                            path: '500',
                            name: 'Page500',
                            component: Page500
                        }
                    ]
                }
            ]
        },

    ]
}
