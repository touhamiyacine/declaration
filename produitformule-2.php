<script src="https://unpkg.com/vue@2.5.9/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.15.3/axios.min.js"></script>

<div id="body">
  <div id="app">
<div id="table1"  class="card">
  <div class="card-header">
      <h5>Nouvelle Formule</h5>
     
      
  </div>
  <div class="card-block">
      <h4 class="sub-title"> Produit</h4>
      <form>
        <div class="form-group row">
         
          <div class="col-sm-3 form-control-success">
          <select  v-model ="nameproduit" v-on:change="changeItem" class="form-control form-control" >
              <option v-for="i in produit" :value="i.nom" :key="i.id">
              {{ i.nom }}
              </option>
              </select>  
              </div>
              <div class="col-sm-3">
                 <select v-model="item.matiere"  v-on:change="changeItem2" class="form-control form-control">
                 <option value="" disabled>Select Formule</option>      
                 <option v-for="j in formule" :value="j.ID" :key="j.ID">
                    {{ j.nomformule }}
                  
             </option>
             </select>
                
              </div>
              <div class="col-sm-3 form-control-success">
              <input type="text" class="form-control success" value="" v-model="nameformule"
              placeholder="Nom Formule">
              </div>
         
          <button v-on:click.prevent="insert()" class="btn btn-out-dashed btn-inverse btn-square">Ajouter formule</button>
      </div>
         
        
      </form>


      <h4 class="sub-title">Matiére</h4>
      <form >
          
          <div class="form-group row">
              <div class="col-sm-3">
                <select  v-model="item.matiere" class="form-control">
                 
                  <option v-for="i in m" :value="i.nom" :key="i.id">
                    {{ i.nom }}
                  </option>
                </select>
                
              </div>
              <div class="col-sm-3 form-control-success">
                  <input type="text"  class="form-control success" v-model="item.quantite"
                  placeholder="valeur">
              </div>
           
              <div class="col-sm-3 form-control-success">
                <button v-on:click.prevent="addItem" :autofocus="'autofocus'" class="btn-sm btn-success btn-icon"><i class="icofont icofont-check-circled"></i></button>
            </div>
          </div>
         
      </form>
    <form>
      <div class="card-block table-border-style">
        <div class="table-responsive">
            <table id="form-name" class="table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>quantité</th>
                        </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in items">
                    <td>
                      
                      <span v-model="item.matiere">{{item.matiere}} </span>
                    </td>
                    <td>
                      <input v-if="item.edit" type="text" v-model="item.quantite" v-on:keyup.enter="item.edit = !item.edit">
                      <span v-else>{{item.quantite}} </span>
                    </td>
                    <td><button v-on:click.prevent="item.edit = !item.edit" class="btn-sm btn-inverse btn-icon"><i class="icofont icofont-exchange"></i></button> 
                   
                     <button v-on:click.prevent="removeItem(index)" class="btn-sm btn-danger btn-icon  "><i class="ti-close"></i></i></button></td>
                  </tr>
                </tbody>
            </table>
        </div>
    </div>
    
  </form>
     
  </div>
</div>

</div>
</div>
<script>
  
  new Vue({
    el: '#app',
    data: {
      
        item: {quantite: "", matiere: "", edit: false},
        items: [],
      m:[],
      nameproduit : "",
      nameformule : "",
      produit:[],
      formule:[]
      
    },
    mounted (){
        this.title = "Loading....";
        var vm = this;
        var vm2 = this;
        axios
          .get("test2.php")
          .then(function(response) {
            vm.m = response.data;
          })
          .catch(function(error) {
            alert(error);
          });
          axios
          .get("listeproduit.php")
          .then(function(response2) {
            vm2.produit = response2.data;
          })
          .catch(function(error) {
            alert(error);
          });
      },
      
     
    
    methods:{
      changeItem() { 
       
       var vm2 = this;
   var nomproduit =  event.target.value;
           const p =  {
     "nameproduct":nomproduit}     
           axios.post('listeformule.php',p).then(function(response) {
                 vm2.formule = response.data;
                 
               })
               .catch(function(error) {
                 alert(error);
               });
         },
      changeItem2() {  var vm3 = this;
            this.nomformule = event.target.value;
    var nomformule =  event.target.value;
            const p =  {
      "nameformule":nomformule}     
            axios.post('listematiereformule.php',p).then(function(response) {
                  vm3.items = response.data;
                  
                })
                .catch(function(error) {
                  alert(error);
                });
          },



      addItem(){
        this.items.push({quantite:this.item.quantite, matiere:this.item.matiere, edit: false})
        this.item = [];
      //  $('#form-name').focus();
      },
      removeItem(index){
        this.items.splice(index, 1);
      },

      insert(){
            const article = JSON.stringify(this.items);
            var i ="name";

            const formul = {
                   m : article,
                   nameproduit : this.nameproduit, 
                   nameformule : this.nameformule, 

            }
            alert(article);
        axios.post('insert2.php', formul).then(res => {
          go('production-groupe.php');
        
              })
              .catch(err => {
                console.log(err)
              })
            
          },

    },
  });
  function go(page) {
    $("#body").load(page);
}


  
    </script>
  