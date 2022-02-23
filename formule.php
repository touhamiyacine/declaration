<script src="https://unpkg.com/vue/dist/vue.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.15.3/axios.min.js"></script>

<div id="body">
  <div id="app">
<div id="table1"  class="card">
 
  <div class="card-block">
      <h4 class="sub-title">Liste Formule</h4>
    
      <form >
          
          <div class="form-group row">
        
              <div class="col-sm-5">
              
                <select  v-model ="produit" v-on:change="changeItem2" class="form-control form-control" >
                <option value="" disabled>Select Produit</option>      
                <option v-for="i in m" :value="i.nom" :key="i.id">
              {{ i.nom }}
              </option>
              </select>  
                 
                
              </div>
              
              <div class="col-sm-3">
              <div class="icon-btn">
              <button @click.prevent="majformule()" class="btn btn-success"><i class="icofont icofont-check-circled"></i></button>
             
              </div>
            </div>
          </div>
         
         
         
          </div>
      </form>
        
      <form>


      <div class="form-group row">
      <div class="col-sm-6">
      <div class="card-block table-border-style">
     
        <div class="table-responsive">
            <table  class="table ">
            <thead>
   <tr>
     <th><input type="checkbox" class="checkbox"/></th>
     <th>ID</th>
     <th>Name</th>
     <th>Voir formule</th>
   </tr>
  </thead>
  <tbody>
    <tr v-for="itm in items" :key="itm.id">
 
      <td><input type="checkbox"    true-value="1" true-value="0"   class="checkbox" v-model="itm.etat"/></td>
      <td>{{ itm.ID }}</td>
      <td>{{ itm.nomformule }}</td>
      <td> 
         <button @click.prevent="addToCount(itm.ID)" class="icon-btn  btn-mini btn-danger btn-outline-danger btn-icon"><i class="icofont icofont-eye-alt"></i></button>
        
        </td>
    </tr>
  </tbody>


            </table>
            
           
        </div>
    </div>
    </div>

    <div class="col-sm-6">
      <div class="card-block table-border-style">
     
        <div class="table-responsive">
            <table class="table">
            <thead>
   <tr>
    
    
     <th>Name</th>
     <th>unite</th>
     <th>stock</th>
   </tr>
  </thead>
  <tbody>
    <tr v-for="f in items2" :key="f.matiere">
 
      
      <td>{{ f.matiere }}</td>
      <td>{{ f.unite }}</td>
      <td>{{ f.stock }}</td>
     
    </tr>
  </tbody>


            </table>
            
           
        </div>
    </div>
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
        items2: [],
          m:[],
          groupe:[],
      name : "",
      produit :"",
      groupeid :"",
      selected: "",
      formule :[],
      nomproduit:"",
      nameproduct :"",
      qte:0,
      date:"",
      selected: [],
		selectAll2: false,
    userIds:[],
    currentSelections: []
      
    },
    mounted (){
        this.title = "Loading....";
        var vm = this;
        axios.get("listeproduit.php").then(function(response) {
            vm.m = response.data;
         
          }).catch(function(error) { alert(error); });
          
        
        
        },
        computed: {
  allSelected() {
    return this.items.every(itm => itm.selected);
  }
}
,
watch: {
    items: {
      handler() {  
        this.currentSelections = this.items.filter( itm =>  {
            if (itm.etat == "1") 
                return true;
            
        })
          .map( itm => itm.ID )
          .toString();
      },
      deep: true
    }
  },
    
    methods:{
      majformule() {  
        const f = JSON.stringify(this.currentSelections);
            const p =  {  "nameproduct":this.nameproduct,
      ID:f  }     
            axios.post('majformule.php',p).then(function(response) {
            
                 // vm2.items.forEach( itm => vm2.$set(itm, "selected", false));
                })
                .catch(function(error) {
                  alert(error);
                });
          },
           changeItem2() {  var vm2 = this;
            this.nameproduct = event.target.value;
    var nameproduct =  event.target.value;
            const p =  {
      "nameproduct":nameproduct}     
            axios.post('listeformuleproduit.php',p).then(function(response) {
                  vm2.items = response.data;
                 // vm2.items.forEach( itm => vm2.$set(itm, "selected", false));
                })
                .catch(function(error) {
                  alert(error);
                });
          },
          addToCount(id) { var vm3 = this;  
            const p =  {
      "nameformule":id}
            axios.post('listematiereformule.php',p).then(function(response) {
               
              vm3.items2 = response.data;
                 
                })
                .catch(function(error) {
                  alert(error);
                });
          },
   
          selectAll() {
      let all_s = this.allSelected;
      this.items.forEach( itm => itm.selected = !all_s );
    }
		


    },
   



  });
  function go(page) {
    $("#body").load(page);
}


  
    </script>
  