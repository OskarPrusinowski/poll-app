<template>
    <div class="content">
        <button @click="showCreateForm()">Create company</button>
        <table  class="content">
            <tr>
                <td>Id</td>
                <td>Nazwa</td>
                <td>Skrócona nazwa</td>
                <td>Opis</td>
                <td>Edytuj</td>
                <td>Usuń</td>
            </tr>
            <tr v-for="company in companies" :key="company.id">
                <td>{{company.id}}</td>
                <td>{{company.name}}</td>
                <td>{{company.compressed_name}}</td>
                <td>{{company.description}}</td>
                <td>
                    <button type="submit" @click="showUpdateForm(company.id)">Edytuj firmę</button>
                </td>
                <td>
                    <button type="submit" @click="deleteCompany(company.id)">
                        Usuń firmę
                    </button>
                </td>
            </tr>
        </table>
        <create :show="showDialog" v-on:hide="showCreateForm()"/>
        <update :id="id" :show="showUpdateDialog" v-on:hide="hideUpdateForm()"/>
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
    computed:{
        companies(){
            return store.getters.getCompanies;
        }
    },
    data(){
        return{
            showDialog:false,
            showUpdateDialog:false,
            id:0
        }
    }
    ,
    methods:{
        getCompanies(){
            store.dispatch("getCompanies",this);
        },
        deleteCompany(id){
            store.commit("setCompanyId",id);
            store.dispatch("deleteCompany",this);
            store.dispatch("getCompanies",this);
        },
        showCreateForm(){
            if(this.showUpdateDialog){
                this.showUpdateDialog=false;
            }
            if(this.showDialog){
                this.showDialog=false;
            }
            else{
                this.showDialog=true;
                store.dispatch("fetchCompanyInit");
            }

        },
        showUpdateForm(id){
            this.showUpdateDialog=true;

            if(this.showDialog){
                this.showDialog=false;
            }
            store.commit("setCompanyId",id);
            store.dispatch("getCompany",this);
        },
        hideUpdateForm(){
            this.showUpdateDialog=false;
        }
    },
    created(){
        this.getCompanies();
    }
}
</script>
