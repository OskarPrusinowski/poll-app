import UserList from './components/User/list'

import CompanyList from './components/Company/list'


export default{
    mode:'history',
    routes:[
        {
            path:'/user/list',
            component:UserList
        },
        {
            path:'/company/list',
            component:CompanyList
        },
    ]
}
