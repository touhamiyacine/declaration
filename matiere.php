<script src="https://unpkg.com/vue/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.15.3/axios.min.js"></script>

<div id="body">
  <div id="app">
<div id="table1"  class="card">
  <div class="card-header">
     
      
  </div>
  <div class="card-block">
      <h4 class="sub-title">Matiére Premiére</h4>
    
     
      <form>


      
      
      <div class="card-block table-border-style">
        <div class="table-responsive">
            <table   id="form-name" class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Qte-stock</th>
                       
                        </tr>
                </thead>
                <tbody>
                  <tr v-for="i in items">
                    <td>
                      
                      <span>{{i.id}} </span>
                    </td>
                    <td>
                      
                      <span>{{i.nom}} {{i.unite}} </span>
                    </td>
                    <td   class="form-control-inverse">
                      
                      <span >{{i.quantite}}  </span>
                      
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
      qte:0,
      
      
      
    },
    mounted (){
        this.title = "Loading....";
        var vm = this;
        axios.get("listematiere.php").then(function(response) {
            vm.items = response.data;
         
          })
          .catch(function(error) {
            alert(error);
          });
      },
      
     
    
    methods:{

     
      insert(){
            const article = JSON.stringify(this.items);
            const formul = {
                   m : article,
                   qte : this.qte,
                   idformule :this.nomformule, }
            
        axios.post('testprod.php', formul).then((response) => {
   if(response.data==1) { alert("Qte matiere insufisante");} 
}, (error) => {
  console.log(error);
});
            
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
  function go(page) {
    $("#body").load(page);
}


  
    </script>
  