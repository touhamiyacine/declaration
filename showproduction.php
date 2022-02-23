<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/vuetify@1.x/dist/vuetify.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
<div id="app">
<v-card>
    <v-card-title>
    <v-toolbar-title>PRODUCTION</v-toolbar-title>
      
      <v-spacer></v-spacer>
<v-text-field
          v-model="search"
          append-icon="search"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
        </v-card-title>
  <v-data-table   :headers="headers" :items="desserts" 
  :search="search" class="tr-color"
                      :current-items="getFiltered">
    <template v-slot:items="props">
        <tr @click="selectRow(props.item)" >
        <td>{{ props.item.nomproduit }}</td>
        <td>{{ props.item.nomformule }}</td>
        <td>{{ props.item.dateprod }}</td>
        <td>{{ props.item.quantiteprod }}</td>
        <td>{{ props.item.idgroupe }}</td>
       
        </tr>
      </template>
  </v-data-table>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vuetify@1.x/dist/vuetify.js"></script>


<script>
new Vue({
  el: "#app",
  methods: {
   
    getFiltered(e){
      console.log(e)
    }

  },
  data() {
    return {
      search: '',
      headers: [{
          text: 'produit',
          align: 'left',
          sortable: true,
          value: 'name',
          class: 'my-header-style'
         
        },
        {
          text: 'Formule',
          value: 'Formule',
          class: 'my-header-style'
          
        },
        {
          text: 'date',
          value: 'date',
          class: 'my-header-style'
        },
        {
          text: 'quantite',
          value: 'quantite',
          class: 'my-header-style'
        },
        {
          text: 'groupe',
          value: 'groupe',
          class: 'my-header-style'
        },
       
      ],
      desserts: []
    }
  },
  mounted (){
     
      
     this.title = "Loading....";
     var vm = this;
     
     axios.post("listeproduction.php").then(function(response) {
         vm.desserts = response.data;
      
       })
       .catch(function(error) {
         alert(error);
       });
   }




})


</script>
<style>
 table.v-table thead th {
      font-size: 16px !important;
      color : white ;

 }
 table.v-table tbody td {
    font-size: 13px !important;
}
  .primary,
.primary:hover {
  /** avoid using !important, added just for example**/
  background-color: red !important;
}

.as-console-wrapper {
  display: none !important;
}
.tr-color {
  background: black !important; 
}
.my-header-style {
  background: #B4C3CA !important; 
  color: black !important; 
}

</style>