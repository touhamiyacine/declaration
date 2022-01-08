<script src="https://unpkg.com/vue@2.5.9/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.15.3/axios.min.js"></script>

<div id="body">
  <div id="app">
<div id="table1"  class="card">
  <div class="card-header">
      <h5>Nouveau Produit</h5>
      <span>l'insertion d'une nouvelle formule</span>
      
  </div>
  <div class="card-block">
      <h4 class="sub-title">Nom Produit</h4>
      <form>
        <div class="form-group row">
         
          <div class="col-sm-3 form-control-success">
              <input type="text" class="form-control success" value="" v-model="name"
              placeholder="nom produit">
             
          </div>
          <button v-on:click.prevent="insert()" class="btn btn-out-dashed btn-inverse btn-square"> Valider formule</button>
      </div>
         
        
      </form>


      <h4 class="sub-title">Formule</h4>
      <form >
          
          <div class="form-group row">
              <div class="col-sm-3">
                <select  v-model="item.desc" class="form-control">
                 
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
                      
                      <span v-model="item.desc">{{item.desc}} </span>
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
<div class="card">
  <div class="card-header">
  <button v-on:click.prevent="insert()" class="btn btn-sm btn-outline-danger">insert</button>
      <span>use class <code>table</code> inside table element</span>
      <div class="card-header-right">    <ul class="list-unstyled card-option">        <li><i class="icofont icofont-simple-left "></i></li>        <li><i class="icofont icofont-maximize full-card"></i></li>        <li><i class="icofont icofont-minus minimize-card"></i></li>        <li><i class="icofont icofont-refresh reload-card"></i></li>        <li><i class="icofont icofont-error close-card"></i></li>    </ul></div>
  </div>
  
</div>
</div>
</div>
<script>
  
  new Vue({
    el: '#app',
    data: {
      
        item: {quantite: "", desc: "", edit: false},
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
      addItem(){
        this.items.push({quantite:this.item.quantite, desc:this.item.desc, edit: false})
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
                   nom : this.name, 
                   

            }
            alert(article);
        axios.post('insert.php', formul).then(res => {
          go('index.php');
        
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
  