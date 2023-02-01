
   
<script src="https://unpkg.com/vue@2.5.9/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.15.3/axios.min.js"></script>

<div id="body">
  <div id="app">
  <div class="page-header card">
 <div class="row align-items-end">
  <div class="col-lg-8">
     <div class="page-header-title">
    <i class="icofont icofont-file-code bg-c-blue"></i>
    <div class="d-inline">
   <h4>Client</h4>
                                   <span> l'ajout d'un nouveau client  </span>
      </div>
        </div>
       </div>
    <div class="col-lg-4">
    <div class="page-header-breadcrumb">
   <ul class="breadcrumb-title">
 <li class="breadcrumb-item">
   <a href="index.php">
    <i class="icofont icofont-home"> Accueil</i>
     </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">Liste client</a>
        </li>
       <li class="breadcrumb-item"><a href="#!">Modifier client</a>
      </li>
    </ul>
    </div>
    </div>
     </div>
     </div>



<div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- Basic Inputs Validation start -->
      <div class="card">
            <div class="card-header">
 
      
         <div class="card-header-right">                                                             <i class="icofont icofont-spinner-alt-5"></i>                                                         </div>
     </div>
       <div class="card-block">
   <form>
        <div class="form-group row">
       <label class="col-sm-2 col-form-label">Client :</label>
        <div class="col-sm-10">
       <input v-model="item.raison" type="text" class="form-control" name="Client" id="Client" placeholder="Raison sociale">
       <span class="messages"></span>
           </div>
         </div>
       <div class="form-group row">
             <label class="col-sm-2 col-form-label">Adresse :</label>
          <div class="col-sm-10">
         <input v-model="item.adr" type="text" class="form-control" id="Adresse" name="Adresse" placeholder="Adresse">
           <span class="messages"></span>
          </div>
          </div>
           
            <div class="form-group row">
            <label class="col-sm-2 col-form-label">R.C : </label>
             <div class="col-sm-10">
              <input v-model="item.rc" type="text" class="form-control" id="R.C" name="R.C" placeholder="registre commerce">
             <span class="messages"></span>
              </div>
               </div>
                
                        <div class="form-group row">
                         <label class="col-sm-2"></label>
                         <div class="col-sm-10">
     <button v-on:click.prevent="insert()" class="btn btn-out-dashed btn-inverse btn-square">Inserer</button>
                          </div>
                         </div>
                            </form>
                           </div>
                           </div>
                           </div>
                           </div>
                           </div>


                           </div>
                           </div> </div>
                           </div>










<script>
  
  new Vue({
    el: '#app',
    data: {
      
        item: {raison: "", adr: "", rc: "" },
        items: [],
      m:[],
      nameproduit : "",
      nameformule : "",
      produit:[],
      test:"",
      test2:""
      
    },
   
    mounted (){
       
      },
      
     
    
    methods:{
      insert(){    
        this.items.push({raison:this.item.raison , adr:this.item.adr , rc:this.item.rc})
            const matiere = JSON.stringify(this.items);
           
           
			
            
        axios.post('add-client.php', matiere).then(res => { }).catch(err => { })
              
              swal('',	'Insertion effectué','success');
              this.item = [];
        //  $("#body").load("produitformule.php"); */
        
          },
    
     
    },
  });
  function go(page) {
    $("#body").load(page);
}
  
    </script>
  
