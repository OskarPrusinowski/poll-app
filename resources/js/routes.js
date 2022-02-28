import UserList from './components/Users/list'
import CompanyShow from './components/Companies/show'

import CompanyList from './components/Companies/list'

import CampaignsList from './components/Campaigns/list'
import CampaignsRead from './components/Campaigns/read'


export default{
    mode:'history',
    routes:[
        {
            path:'/users/list',
            component:UserList
        },
        {
            path:'/companies/list',
            component:CompanyList
        },
        {
            path:'/companies/:id',
            component:CompanyShow,
        },
        {
            path:'/campaigns/list',
            component:CampaignsList,
        },
        {
            path:'/campaigns/read/:id/:contactId',
            component:CampaignsRead,
        },
    ]
}
