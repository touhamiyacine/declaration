<?php 
$bdd = new PDO('mysql:localhost;dbname=kasa', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$datesys=date("Y-m-d H:i:s");   
  

  $responseBody = file_get_contents('php://input');
  $json = json_decode($responseBody);
  
  $important = 0 ;

$qte= $json->qte;
$idformule= $json->idformule;  

$m= json_decode($json->m);
foreach ($m as $item) { $stock= $item->stock;$quantite = $item->quantite; if ( $stock-($qte* $quantite) < 0 ) { $important = 1 ;  }}
if($important== 0)
{ echo $important;
    $rqt=$bdd->prepare("INSERT INTO kasa.production (`IDFORMULE`,`quantiteprod`,`dateprod`) VALUES ('$idformule','$qte','$datesys')");
    $rqt->execute();
    $idprod = $bdd->lastInsertId();
    foreach ($m as $item) { 
        $stock= $item->stock;
        $quantite = $item->quantite;
        $matiere = $item->matiere;
        $qteconso=$qte* $quantite;
        $rqt=$bdd->prepare("INSERT INTO kasa.consommation (`IDPROD`,`matiere`,`quantite`) VALUES ('$idprod', '$matiere','$qteconso')");
        $rqt->execute();
        

    }






}
else { echo $important;}

 ?>