<template>
  <div class="text-center">
    <v-dialog
      v-model="dialog"
      width="500"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          color="red lighten-2"
          dark
          v-bind="attrs"
          v-on="on"
          @click="getCampaign()"
        >
          {{action}} listę kontaktów
        </v-btn>
      </template>

      <v-card>
        <v-card-title class="text-h5 grey lighten-2">
          Dodaj plik
        </v-card-title>

        <v-divider></v-divider>
         <v-card-text style="height:35vh;">
            <v-layout column style="height:45vh;"><v-flex md6 style="overflow: auto">
    <v-simple-table >
        <thead>
            <tr><td>Id</td>
            <td>Mail</td></tr>
        </thead>
        <tbody>
            <tr v-for="(contact,index) in contacts" :key="contact.id">
                <td>{{index+1}}</td>
                <td>{{contact.email}}</td>
            </tr>
        </tbody>
        </v-simple-table>
    </v-flex>
    </v-layout>
        </v-card-text>
        <v-divider></v-divider>
<v-file-input
    accept=".xlsx,.xls,.csv"
    label="File input"
    v-model="file"
  ></v-file-input>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="submit(file)"
          >
            I accept
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import store from "../../store/index"

export default {
    props:["campaign","action"],
    data () {
      return {
        dialog: false,
        file:""
      }
    },
    computed:{
        contacts(){
            return store.getters.getCampaignContacts;
        }
    },
    methods:{
        submit(file){
            store.commit("setCampaign",this.campaign);
            store.commit("setFile",file);
            store.dispatch("importContacts",this);
            store.commit("setIsContactList",1);
            store.dispatch("updateCampaign",this);
            this.dialog=false;
        },
        async getCampaign(){
            store.commit("setCampaign",this.campaign);
            await store.dispatch("getCompaign",this);
            this.campaign=store.getters.getCampaign;
        }
    }
}
</script>
