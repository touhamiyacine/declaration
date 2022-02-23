<script src="https://unpkg.com/vue/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.15.3/axios.min.js"></script>

<div id="body">
  <div id="app">
<div id="table1"  class="card">
  <div class="card-header">
      <h5>production</h5>
    
      
  </div>
  <div class="card-block">
     
    
      <form >
          
          <div class="form-group row">
          <div class="col-sm-3">
              
              <select  v-model ="groupeid" v-on:change="changeItem" class="form-control form-control" >
              <option value="" disabled>Select Groupe</option>              
              <option v-for="j in groupe" :value="j.id" :key="j.id">
            {{ j.nom }}
            </option>
            </select>  
               
              
            </div>
              <div class="col-sm-3">
              
                <select  v-model ="produit" v-on:change="changeItem" class="form-control form-control" >
                <option value="" disabled>Select Produit</option>      
                <option v-for="i in m" :value="i.nom" :key="i.id">
              {{ i.nom }}
              </option>
              </select>  
                 
                
              </div>
              <div class="col-sm-3">
                 <select v-model="item.desc"  v-on:change="changeItem2" class="form-control form-control">
                 <option value="" disabled>Select Formule</option>      
                 <option v-for="j in formule" :value="j.ID" :key="j.ID">
                    {{ j.nomformule }}
                  
             </option>
             </select>
                
              </div>
              <div class="col-sm-3">
              <div class="icon-btn">
              <button v-on:click.prevent="go('formule.php')" class="btn btn-inverse btn-outline-inverse"><i class="icofont icofont-settings-alt"></i></button>
              </div>
            </div>
          </div>
          <div class="form-group row">
          
              <div class="col-sm-3 form-control-success">
         
              <input type="text"    v-on:keypress="NumbersOnly" class="form-control"  v-model="qte"
              placeholder="quantité">
             
          </div>
          <div class="col-sm-3 form-control-success">
          <input class="form-control" type="datetime-local"  v-model="date" />
          </div>
          <div class="col-sm-2 form-control-success">
         
          <button v-on:click.prevent="insert()"  class="btn  btn-outline  btn-inverse btn-square">Valider</button>
          
          </div>
          <div class="col-sm-2 form-control-success">
         
          <!--button   v-on:click.prevent="changerformule()" class="btn btn-danger "> <i class="ti-settings"></i> </button-->
             
          </div>
          </div>
      </form>
        
      <form>


      
      
      <div class="card-block table-border-style">
        <div class="table-responsive">
            <table   id="form-name" class="table">
                <thead>
                    <tr>
                        <th>matiere</th>
                        <th>mesure</th>
                        <th>Qte-stock</th>
                        <th>Qte-Consommation</th>
                       
                        </tr>
                </thead>
                <tbody>
                  <tr v-for="i in items">
                    <td>
                      
                      <span>{{i.matiere}} </span>
                    </td>
                    <td>
                      
                      <span>{{i.quantite}} {{i.unite}} </span>
                    </td>
                    <td   class="form-control-inverse">
                      
                      <span >{{i.stock}}  </span>
                      
                    </td>
                    <td   class="form-control-inverse">
                      
                      <span >{{i.quantite*qte}}  </span>
                      
                    </td>



                    
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
      
        item: {matiere: "", quantite: ""},
        items: [],
          m:[],
          groupe:[],
      name : "",
      produit :"",
      groupeid :"",
      selected: "",
      formule :[],
      nomproduit:"",
      nomformule :"",
      qte:0,
      date:"",
      
      
      
    },
    mounted (){
        this.title = "Loading....";
        var vm = this;
        axios.get("listeproduit.php").then(function(response) {
            vm.m = response.data;
         
          }).catch(function(error) { alert(error); });
          var vm2 = this;
          axios.get("listegroupe.php").then(function(response) {
            vm2.groupe = response.data;
         
          }).catch(function(error) { alert(error); });
        
        
        },
      
     
    
    methods:{
         
changerformule()
{
  $("#body").load("produitformule-2.php");
},
     
      insert(){
            const article = JSON.stringify(this.items);
            const formul = {
                   m : article,
                   qte : this.qte,
                   date : this.date,
                   idformule :this.nomformule,
                   groupeid :this.groupeid, }
        
        axios.post('addprod.php', formul).then((response) => {
   if(response.data==1) { swal('','Qte matiere insufisante','warning');} 
   swal('',	'Produiction effectué','success');
}, (error) => {
  console.log(error);
});
            
          },
           go(page) {
    $("#body").load(page);
},
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
          changeItem2() {  var vm2 = this;
            this.nomformule = event.target.value;
    var nomformule =  event.target.value;
            const p =  {
      "nameformule":nomformule}     
            axios.post('listematiereformule.php',p).then(function(response) {
                  vm2.items = response.data;
                  
                })
                .catch(function(error) {
                  alert(error);
                });
          },
          NumbersOnly(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
        evt.preventDefault();;
      } else {
        return true;
      }
    }
    },
   



  });



  
    </script>
  