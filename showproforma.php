<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/vuetify@1.x/dist/vuetify.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons">
<div id="app">
<v-card>
    <v-card-title>
    <v-toolbar-title>Facture Proforma</v-toolbar-title>
      
      <v-spacer></v-spacer>
<v-text-field
          v-model="search"
          append-icon="search"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
        </v-card-title>
  <v-data-table   
       :headers="headers" :items="desserts" 
  :search="search" 
                      :current-items="getFiltered"   >
    <template v-slot:items="props">
        <tr  @click="selectRow(props.item)" >
        <td>{{ props.item.ID }}</td>
        <td>{{ props.item.idclient }}</td>
        <td>{{ props.item.date }}</td>
        <td>{{ props.item.total }}</td>
        <td><button v-on:click.prevent="view(props.item.ID)" class="icon-btn  btn-mini btn-danger btn-outline-danger btn-icon"><i class="icofont icofont-eye-alt"></i></button>
        </td>
        </tr>
      </template>
  </v-data-table>
  </v-card>
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
          text: 'ID',
          align: 'left',
          sortable: true,
          value: 'ID',
          class: 'my-header-style'
        
         
        },
        {
          text: 'idclient',
          value: 'idclient',
          class: 'my-header-style'
          
        },
        {
          text: 'date',
          value: 'date',
          class: 'my-header-style'
        },
        {
          text: 'total',
          value: 'total',
          class: 'my-header-style'
        },
        {
          text: 'Voir',
          value: 'Voir',
          class: 'my-header-style'
        },
       
       
      ],
      desserts: []
    }
  },
  mounted (){
     
      
     this.title = "Loading....";
     var vm = this;
     
     axios.post("listeproforma.php").then(function(response) {
         vm.desserts = response.data;
      
       })
       .catch(function(error) {
         alert(error);
       });
   },
   methods : {
 view (id)
 {
  window.open('pdfproforma.php?id='+id, 'Devis', 'height=600, width=800, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');
 }

   }




})


</script>
<style>
 table.v-table thead th {
  height: 10px;
  font-size: 15px !important;
      
      margin: 4px;
      color:#333;
      font-weight: normal;

 }
 table.v-table tbody td {
  height: 40px;
  margin: 2px;
  border: 1px solid #ededed;
  font-size: 15.5px !important;
  
 
}
tbody tr:nth-of-type(odd) {

  background-color: #c1cbe2;
}
 
.as-console-wrapper {
  display: none !important;
}
.tr-color {
  background: black !important; 
}
.my-header-style {
 
  background: #FFFFFF !important; 
  font-size: 10px !important;
  
  
}


</style>