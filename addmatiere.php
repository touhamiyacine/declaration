<script src="https://unpkg.com/vue@2.5.9/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.15.3/axios.min.js"></script>

<div id="body">
  <div id="app">
<div id="table1"  class="card">
  
  <div class="card-block">
      <h4 class="sub-title">Nouvelle  matiere</h4>
      <form>
        <div class="form-group row">
        
        <label class="col-sm-1 col-form-label">Nom :</label>
       
          <div class="col-sm-2 form-control-success">
              <input type="text" class="form-control success" value="" v-model="item.matiere"
              placeholder="matiere">
             
          </div>
          <label class="col-sm-1 col-form-label">unite :</label>
          <div class="col-sm-2 form-control-success">
          <select  v-model="item.unite" class="form-control">
                 
                 <option value="mg">mg</option>
                 <option value="kg">kg</option>
                 <option value="ml">ml</option>
                 <option value="cl">cl</option>
                 <option value="l">l</option>
               </select>
             
          </div>
          <label class="col-sm-1 col-form-label">Qte:</label>
          <div class="col-sm-2 form-control-success">
         
              <input   type="text" v-on:keypress="NumbersOnly" class="form-control success"  v-model="item.quantite"
              placeholder="quantité">
             
          </div>
          <div class="col-sm-2 form-control-success">
          <button v-on:click.prevent="insert()" class="btn btn-out-dashed btn-inverse btn-square">ADD</button>
          </div>
      </div>
         
        
      </form>


     
      
   
     
  </div>
</div>

</div>

<script>
 
  new Vue({
    el: '#app',
    data: {
      
        item: {matiere: "", unite: "", quantite: "0"},
        items: [],
      m:[],
      name : "",
      
    },
    mounted (){
        this.title = "Loading....";
        var vm = this;
        axios
          .get("test2.php")
          .then(function(response) {
            vm.m = response.data;
          })
          .catch(function(error) {
            alert(error);
          });
      },
      
     
    
    methods:{
     

      insert(){
        this.items.push({matiere:this.item.matiere, unite:this.item.unite, quantite:this.item.quantite})
            const matiere = JSON.stringify(this.items);
           
            
			
            
        axios.post('add-matiere.php', matiere).then(res => {
         
         
              })
              .catch(err => {
               
              })
              swal('',	'Insertion effectué','success');
              this.item = [];
        //  $("#body").load("produitformule.php");
        
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
  