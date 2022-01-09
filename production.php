<script src="https://unpkg.com/vue/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.15.3/axios.min.js"></script>

<div id="body">
  <div id="app">
<div id="table1"  class="card">
  <div class="card-header">
      <h5>production</h5>
      <span>production</span>
      
  </div>
  <div class="card-block">
      <h4 class="sub-title">Nom Produit</h4>
    
      <form >
          
          <div class="form-group row">
              <div class="col-sm-3">
              
                <select  v-model ="produit" v-on:change="changeItem" class="form-control" >
              <option v-for="i in m" :value="i.nom" :key="i.id">
              {{ i.nom }}
              </option>
              </select>  
                 
                
              </div>
              <div class="col-sm-3">
                 <select v-model="item.desc"  v-on:change="changeItem2" class="form-control">
             <option v-for="j in formule" :value="j.ID" :key="j.ID">
                    {{ j.nomformule }}
             </option>
             </select>
                
              </div>
              <div class="col-sm-2 form-control-success">
         
              <input type="text" v-on:keypress="NumbersOnly" class="form-control success"  
              placeholder="quantité">
             
          </div>
          </div>
         
      </form>
        
      </form>


      <h4 class="sub-title">Formule</h4>
      
      <div class="card-block table-border-style">
        <div class="table-responsive">
            <table id="form-name" class="table">
                <thead>
                    <tr>
                        <th>matiere</th>
                        <th>quantité</th>
                        </tr>
                </thead>
                <tbody>
                  <tr v-for="i in items">
                    <td>
                      
                      <span>{{i.matiere}} </span>
                    </td>
                    <td>
                      
                      <span>{{i.quantite}} </span>
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
      name : "",
      produit :"",
      selected: "",
      formule :[],
      nomproduit:"",
      nomformule :"",
      
    },
    mounted (){
        this.title = "Loading....";
        var vm = this;
        axios.get("listeproduit.php").then(function(response) {
            vm.m = response.data;
          
          })
          .catch(function(error) {
            alert(error);
          });
      },
      
     
    
    methods:{
     
     
      changeItem() {  var vm2 = this;
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
  function go(page) {
    $("#body").load(page);
}


  
    </script>
  