import UserList from './components/User/list'
import UserCreate from './components/User/create'

import CompanyList from './components/Company/list'
import CompanyCreate from './components/Company/create'


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
