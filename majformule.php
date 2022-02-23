<?php
 $bdd = new PDO('mysql:localhost;dbname=kasa', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

 
$responseBody = file_get_contents('php://input');
  $json = json_decode($responseBody);
  //return data
  $nameproduct=$json->nameproduct;
  $rqt=$bdd->prepare("update kasa.formuleref  set etat=0 where   nomproduit ='$nameproduct'");
  $rqt->execute();




  $liste=json_decode($json->ID);
echo $liste ;
$rqt="";
$row_res="";

   $rqt=$bdd->prepare("update kasa.formuleref  set etat=1 where   ID in($liste)");
 
   $rqt->execute();



$rqt=$bdd->prepare("select m.ID , m.nomformule , m.nomproduit , IF( m.etat>0, true,false) AS etat from kasa.formuleref as m where  m.nomproduit ='$nameproduct'");
$rqt->execute();
$row_res=$rqt->fetchAll();

echo json_encode($row_res);

?>