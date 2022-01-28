<template>
    <div v-show="show" class="example">
        <div class="input_row">
            <div>
            <label for="name">Nazwa</label>
            <input type="text" name="name" v-model="company.name"></div>
            <div class="input_row"><label for="compressed_name">Skrócona nazwa</label>
            <input type="text" name="compressed_name" v-model="company.compressed_name"></div>
            <div class="input_row"> <label for="description">Opis</label>
            <input type="text" name="description" v-model="company.description"></div>

            </div>
        <button type="submit" @click="$emit('hide')">Anuluj</button>
        <button type="submit" @click="createCompany(company)">Dodaj firmę</button>
    </div>
</template>

<script>
import store from '../../store/index'
export default {
    props:['show'],
    computed:{
        company(){
            return store.getters.getCompany;
        }
    },
    methods:{
        createCompany(company){
            store.commit("setCompany",company);
            store.dispatch("createCompany",this);
            setTimeout(() => {
                if(store.getters.getOk){
                store.dispatch("fetchCompanyInit");
                this.$emit("hide");
                store.dispatch('getCompanies',this);
            }}, 300);

        },
        getCompanies(){
            store.dispatch('getCompanies',this);
        }
    },
    created(){
        store.dispatch("fetchCompanyInit");
    }

}
</script>
<style>
.example{
    min-width:350px;
    min-height:150px;
    background-color:#fff;
    border:1px solid #ced4da;
    position: absolute;
    top:19vh;
    left: calc(50vw - 175px);
    padding:20px;
    text-align: right;
}
.input_row{
    padding:5px 0;
}
</style>
