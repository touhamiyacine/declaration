
   
<script src="https://unpkg.com/vue@2.5.9/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.15.3/axios.min.js"></script>

<div id="body">
  <div id="app">
<div id="table1"  class="card">
  <div class="card-header">
      <h5></h5>
      <span>FACTURE PROFORMA</span>
      
  </div>
  <div class="card-block">
      <h4 class="sub-title">type facture (exworks/renduà) , VT/DISTRUB</h4>
      <form>
        <div class="form-group row">
         
          <div class="col-sm-3 form-control-success">
          <select  class="form-control form-control" >
          <option value="">EXWORKS/rendu</option>
          <option value="EXWORKS">EXWORKS</option>
          <option value="rendu">rendu</option>
              </select>  
              </div>
              <div class="col-sm-3 form-control-success">
          <select  class="form-control form-control" >
          <option value="">VT/DISTRUB</option>
          <option value="VT">VT</option>
          <option value="DISTRUB">DISTRUB</option>
              </select>  
              </div>
              <div class="col-sm-3">
                <select  v-model="idclient" class="form-control">
                <option value="" disabled>Select Client</option> 
                  <option v-for="i in client" :value="i" :key="i.id">
                    {{ i.raison }}  
                  </option>
                </select>
                
              </div>


      </div>
         
        
      </form>
      <h4 class="sub-title">liste produit</h4>
      <form >
          
          <div class="form-group row">
              <div class="col-sm-4">
                <select  v-model="item.desc" class="form-control">
                <option value="" disabled>Select Produit</option> 
                  <option v-for="i in m" :value="i" :key="i.id">
                    {{ i.nomproduit }}  {{ i.volume }}
                  </option>
                </select>
                
              </div>
              <div class="col-sm-2 form-control-success">
              <input type="text" class="form-control success" value="" v-model="item.quantite"
              placeholder="UNITE">
              </div>
              <div class="col-sm-2 form-control" v-model="item.prixunite"  >
              {{item.desc.prixHT}} 
               </div>
               <div class="col-sm-2 form-control" v-model="item.prix"  >
              {{item.desc.prixHT*item.quantite}}
               </div>
           
              <div class="col-sm-2 form-control-success">
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
                        <th>designation</th>
                        <th>unite</th>
                        <th>prix/unite</th>
                        <th>prix</th>
                        </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in items">
                    <td>
                      <span v-model="item.desc">{{item.desc}} </span>
                    </td>
                    <td>
                      <span v-model="item.quantite">{{item.quantite}} </span>
                    </td>
                    
                    <td>
                      <span v-model="item.prixunite">{{item.prixunite}} </span>
                    </td>
                    <td>
                      <span v-model="item.prix">{{item.prix}} </span>
                    </td>
                    
                    <td><button v-on:click.prevent="item.edit = !item.edit" class="btn-sm btn-inverse btn-icon"><i class="icofont icofont-exchange"></i></button> 
                   
                     <button v-on:click.prevent="removeItem(index)" class="btn-sm btn-danger btn-icon  "><i class="ti-close"></i></i></button></td>
                  </tr>
                </tbody>
            </table>
        </div>
    </div>
    
  </form>
  <tr class="text-bold">
                        
                        <td>  <h5>  Total: {{total}} </h5> </td>
                    </tr>
  </div>
</div>
<div id="invoice" class="card">
  <div class="card-header">
 
  <button v-on:click.prevent="insert()" class="btn btn-sm btn-outline-danger">insert</button>
     
      <div class="card-header-right">    <ul class="list-unstyled card-option">        <li><i class="icofont icofont-simple-left "></i></li>        <li><i class="icofont icofont-maximize full-card"></i></li>        <li><i class="icofont icofont-minus minimize-card"></i></li>        <li><i class="icofont icofont-refresh reload-card"></i></li>        <li><i class="icofont icofont-error close-card"></i></li>    </ul></div>
  </div>
  
</div>
</div>
</div>
<script>
  
  new Vue({
    el: '#app',
    data: {
      
        item: {quantite: "", desc: "", prixunite: "" , prix: "" , edit: false},
        items: [],
      m:[],
      nameproduit : "",
      nameformule : "",
      produit:[],
      client:[],
      idclient:"",
      test:"",
      test2:"",
      totalp:0 ,
    },
    computed: {
  total: function(){
    
    return this.items.reduce(function(total, item){
      this.totalp = Number(total) + Number(item.prix); 
      return Number(total) + Number(item.prix); 
    },0);
  } },
    mounted (){
        this.title = "Loading....";
        var vm = this;
        var vm2 = this;
        var vm3 = this;

        axios
          .get("produitproforma.php")
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
          axios
          .get("listeclient.php")
          .then(function(response2) {
            vm3.client = response2.data;
          })
          .catch(function(error) {
            alert(error);
          });
      },
      
     
    
    methods:{
      addItem(){ 
        this.items.push({quantite:this.item.quantite, prixunite:this.item.desc.prixHT , prix:this.item.desc.prixHT*this.item.quantite
         , desc:this.item.desc.nomproduit, edit: false})
       
        
          this.item.quantite="";
          this.item.desc="";
          this.item.desc.prixHT="";
          this.item.prix="";
         vm.$forceUpdate();
       
        
      //  $('#form-name').focus();
      },
      removeItem(index){
        this.items.splice(index, 1);
      },
      imprimer : function() {
        let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');
        mywindow.document.write(document.getElementById("invoice").innerHTML);
        mywindow.print();
            },
      insert(){
            const produit = JSON.stringify(this.items);
            alert(produit);
            var i ="name";
            const formul = {
                   m : produit,
                   total : this.total, 
                   client : this.idclient.id, 
            }
           
        axios.post('insertproforma.php', formul).then(res => {
        
        
              })
              .catch(err => {
                console.log(err)
              })
              go('showproforma.php');
          },
    },
  });
  function go(page) {
    $("#body").load(page);
}
  
    </script>
  
