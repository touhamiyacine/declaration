<?php
require_once("conn.php");
$responseBody = file_get_contents('php://input');
  $json = json_decode($responseBody);
  //return data

  $nameproduct=$json->nameproduct;

$rqt="";
$row_res="";



$rqt=$bdd->prepare("select m.ID , m.nomformule , m.nomproduit from kasa.formuleref as m where m.etat=1 and  m.nomproduit ='$nameproduct'");
$rqt->execute();
$row_res=$rqt->fetchAll();

echo json_encode($row_res);
?>