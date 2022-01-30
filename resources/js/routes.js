import UserList from './components/Users/list'

import CompanyList from './components/Companies/list'


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
