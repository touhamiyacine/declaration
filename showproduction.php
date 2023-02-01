<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/vuetify@1.x/dist/vuetify.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital@1&display=swap" rel="stylesheet">


<div id="app">
<v-card>
    <v-card-title>
    <v-toolbar-title>PRODUCTION</v-toolbar-title>
      
      <v-spacer></v-spacer>
<v-text-field
          v-model="search"
          append-icon="search"
          label="Search"
          item-key="name"
          single-line
          hide-details
        ></v-text-field>
        </v-card-title>
  <v-data-table dense :headers="headers" :items="desserts" class="elevation-1">
    <template v-slot:items="props">
        <tr  @click="selectRow(props.item)" >
        <td>{{ props.item.nomproduit }}</td>
        <td>{{ props.item.nomformule }}</td>
        <td>{{ props.item.dateprod }}</td>
        <td>{{ props.item.quantiteprod }}</td>
        <td>{{ props.item.idgroupe }}</td>
       
        </tr>
      </template>
  </v-data-table>

  </v-card>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vuetify@1.x/dist/vuetify.js"></script>


