<?php 
  require_once("conn.php");

  $responseBody = file_get_contents('php://input');
  $json = json_decode($responseBody);
  //return data
 
  

  
  
  foreach ($json as $item)
{   $matiere= $item->matiere;
 $unite= $item->unite;
 $quantite = $item->quantite;

$rqt=$bdd->prepare("INSERT INTO kasa.matierep (`nom`,`unite`,`quantite`) VALUES ('$matiere','$unite','$quantite')");

  $rqt->execute();


}

echo 1;


 ?>