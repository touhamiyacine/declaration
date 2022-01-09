<?php
$responseBody = file_get_contents('php://input');
  $json = json_decode($responseBody);
  //return data

  $IDformule=$json->nameformule;
 
$rqt="";
$row_res="";


$bdd = new PDO('mysql:localhost;dbname=kasa', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$rqt=$bdd->prepare(" select  m.matiere as matiere , m.quantite as quantite 
 , p.unite as unite ,  p.quantite as stock
from kasa.formule as m   , kasa.matierep as p where  m.matiere =p.nom and m.IDFORMULE ='$IDformule'");
$rqt->execute();
$row_res=$rqt->fetchAll();

echo json_encode($row_res);
?>