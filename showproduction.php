<script src="https://unpkg.com/vue/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.15.3/axios.min.js"></script>

  
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css"
          href="../bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
          <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
    <!-- flag icon framework css -->
    <link rel="stylesheet" type="text/css" href="assets/pages/flag-icon/flag-icon.min.css">
    <!-- Menu-Search css -->
    <link rel="stylesheet" type="text/css" href="assets/pages/menu-search/css/component.css">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css"
          href="../bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/pages/data-table/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
          href="../bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
  
   <div id="app">
<div id="body">
<div class="card">
                                               
   <div class="card-block">
   <div class="dt-responsive table-responsive">
     <table id="order-table" 
           class="table table-striped table-bordered nowrap">
      <thead>
          <tr>
           <th>ID</th>
     <th>nomproduit</th>
               <th>nomformule</th>
           <th>dateprod</th>
           <th>quantite</th>
        
      </tr>
  </thead>
     <tbody>  
     <tr>
                    <td>
                      
                      <span>99 </span>
                    </td>
                    <td>
                      
                      <span>testprod </span>
                    </td>
                    <td   class="form-control-inverse">
                      
                      <span >formuletest  </span>
                      
                    </td>
                    <td   class="form-control-inverse">
                      
                      <span >/  </span>
                      
                    </td>
                    <td   class="form-control-inverse">
                      
                      <span >100  </span>
                      
                    </td>

                  </tr>




     <tr v-for="i in items">
                    <td>
                      
                      <span>{{i.ID}} </span>
                    </td>
                    <td>
                      
                      <span>{{i.nomproduit}} </span>
                    </td>
                    <td   class="form-control-inverse">
                      
                      <span >{{i.nomformule}}  </span>
                      
                    </td>
                    <td   class="form-control-inverse">
                      
                      <span >{{i.dateprod}}  </span>
                      
                    </td>
                    <td   class="form-control-inverse">
                      
                      <span >{{i.quantiteprod}}  </span>
                      
                    </td>

                  </tr>
        </tbody>
  <tfoot>
        <tr>
        <th>ID</th>
     <th>nomproduit</th>
               <th>nomformule</th>
           <th>dateprod</th>
           <th>quantite</th>
   </tr>
   </tr>
      </tfoot>
   </table>
       </div>
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
        
        axios.post("listeproduction.php").then(function(response) {
            vm.items = response.data;
         
          })
          .catch(function(error) {
            alert(error);
          });
      },
    });
  function go(page) {
    $("#body").load(page);
}


  
    </script>
  <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/pages/data-table/js/jszip.min.js"></script>
<script src="assets/pages/data-table/js/pdfmake.min.js"></script>
<script src="assets/pages/data-table/js/vfs_fonts.js"></script>
<script src="../bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="assets/pages/data-table/js/data-table-custom.js"></script>

<script src="assets/js/pcoded.min.js"></script>
<script src="assets/js/demo-12.js"></script>
<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="assets/js/script.js"></script>
<script type="text/javascript" src="../bower_components/i18next/js/i18next.min.js"></script>
<script type="text/javascript" src="../bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
<script type="text/javascript"
        src="../bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="../bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="../bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="../bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="../bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="../bower_components/bootstrap/js/bootstrap.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="../bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="../bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="../bower_components/modernizr/js/css-scrollbars.js"></script>

<!-- data-table js -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/pages/data-table/js/jszip.min.js"></script>
<script src="assets/pages/data-table/js/pdfmake.min.js"></script>
<script src="assets/pages/data-table/js/vfs_fonts.js"></script>
<script src="../bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>