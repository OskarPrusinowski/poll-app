<template>
    <div class="content">
        <button @click="showCreateForm()">Stwórz użytkownika</button>
        <table class="content">
            <tr>
                <td>Id</td>
                <td>Imię</td>
                <td>Nazwisko</td>
                <td>Login</td>
                <td>Email</td>
                <td>Firma</td>
                <td>Edytuj</td>
                <td>Usuń</td>
            </tr>
            <tr v-for="user in users" :key="user.id">
                <td>{{user.id}}</td>
                <td>{{user.name}}</td>
                <td>{{user.surname}}</td>
                <td>{{user.login}}</td>
                <td>{{user.email}}</td>
                <td v-if="user.company">{{user.company.name}}</td>
                <td v-else></td>
                <td>
                    <button type="submit" @click="showUpdateForm(user.id)">Edytuj użytkownika</button>
                </td>
                <td>
                    <button type="submit" @click="deleteUser(user.id)">
                        Usuń użytkownika
                    </button>
                </td>
            </tr>
        </table>
        <create :show="showDialog" @hide="showCreateForm()"/>
        <update :id="id" :show="showUpdateDialog" @hide="hideUpdateForm()"/>
    </div>
</template>

<script>
import store from '../../store/index'
import create from './create.vue'
import update from './update.vue'

export default {
    components:{
        create:create,
        update:update
    },
    data(){
        return{
            showDialog:false,
            showUpdateDialog:false,
            id:0
        }
    },
    computed:{
        users(){
            return store.getters.getUsers;
        }
    },
    methods:{
        getUsers(){
            store.dispatch("getUsers",this);
        },
        deleteUser(id){
            store.commit("setUserId",id);
            store.dispatch('deleteUser',this);
            store.dispatch("getUsers",this);
        },
        showCreateForm(){
            if(this.showDialog){
                this.showDialog=false;
            }
            else{
                this.showDialog=true;
                store.dispatch("fetchUserInit");
            }
            if(this.showUpdateDialog){
                this.showUpdateDialog=false;
            }
        },
        showUpdateForm(id){
            this.showUpdateDialog=true;
            if(this.showDialog){
                this.showDialog=false;
            }
            store.commit("setUserId",id);
            store.dispatch("getUser",this);
        },
        hideUpdateForm(){
            this.showUpdateDialog=false;
        }
    },
    created(){
        this.getUsers();
    }
}
</script>
<style>
.content{
    margin:15px auto;
    text-align:center;
}
.link{
    margin: 100px;
}

</style>
