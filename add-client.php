<?php 
  require_once("conn.php");

  $responseBody = file_get_contents('php://input');
  $json = json_decode($responseBody);
  //return data
 
  

  
  
  foreach ($json as $item)
{   $raison= $item->raison;
 $adr= $item->adr;
 $rc = $item->rc;

$rqt=$bdd->prepare("INSERT INTO kasa.client (`raison`,`adresse`,`rc`) VALUES ('$raison','$adr','$rc')");

  $rqt->execute();


}

echo 1;


 ?>