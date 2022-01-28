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
        <button type="submit" @click="updateCompany(company)">Edytuj firmę</button>
    </div>
</template>

<script>
import store from '../../store/index'
export default {
    props:['show','id'],
    computed:{
        company(){
            return store.getters.getCompany;
        }
    },
    methods:{
        updateCompany(company){
            store.commit("setCompany",company);
            store.dispatch("updateCompany",this);
            setTimeout(() => {
            if(store.getters.getOk){
                store.dispatch("fetchCompanyInit");
                this.$emit("hide");
                store.dispatch('getCompanies',this);
            }}, 300);

        },
        getCompanies(){
            store.dispatch('getCompanies',this);
        },
        getCompany(){
            store.commit("setCompanyId",id);
            store.dispatch("getCompany",this);
        }
    },
    created(){
        store.dispatch("fetchCompanyInit");
        this.getCompany();
    }

}
</script>
