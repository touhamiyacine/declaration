<?php
$responseBody = file_get_contents('php://input');
  $json = json_decode($responseBody);
  //return data

  $IDformule=$json->nameformule;
 
$rqt="";
$row_res="";


$bdd = new PDO('mysql:localhost;dbname=kasa', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$rqt=$bdd->prepare("select m.matiere , m.quantite
 from kasa.formule as m where m.IDFORMULE ='$IDformule'");
$rqt->execute();
$row_res=$rqt->fetchAll();

echo json_encode($row_res);
?>