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
          Click Me
        </v-btn>
      </template>

      <v-card>
        <v-card-title class="text-h5 grey lighten-2">
          Privacy Policy
        </v-card-title>

        <v-card-text>
            <v-layout column style="height:50vh;"><v-flex md6 style="overflow: auto">
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
            <tr v-for="(contact,index) in contacts" :key="contact.id">
                <td>{{index+1}}</td>
                <td>{{contact.email}}</td>
            </tr>
            <tr v-for="(contact,index) in contacts" :key="contact.id">
                <td>{{index+1}}</td>
                <td>{{contact.email}}</td>
            </tr>
            <tr v-for="(contact,index) in contacts" :key="contact.id">
                <td>{{index+1}}</td>
                <td>{{contact.email}}</td>
            </tr>
            <tr v-for="(contact,index) in contacts" :key="contact.id">
                <td>{{index+1}}</td>
                <td>{{contact.email}}</td>
            </tr>
            <tr v-for="(contact,index) in contacts" :key="contact.id">
                <td>{{index+1}}</td>
                <td>{{contact.email}}</td>
            </tr>
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

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="dialog = false"
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
    props:["campaign"],
    data(){
        return{
            dialog:false
        }
    },
    computed:{
        contacts(){
            return store.getters.getCampaignContacts;
        }
    },
    methods:{
        async getCampaign(){
            store.commit("setCampaign",this.campaign);
            await store.dispatch("getCompaign",this);
            this.campaign=store.getters.getCampaign;
        }
    },
    created(){
    }
}
</script>