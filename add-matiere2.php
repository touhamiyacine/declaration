<?php 
  $bdd = new PDO('mysql:localhost;dbname=kasa', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  $responseBody = file_get_contents('php://input');
  $json = json_decode($responseBody);
  //return data
 
  

  
  
  foreach ($json as $item)
{   $matiere= $item->matiere;
 $unite= $item->unite;
 $quantite = $item->quantite;

$rqt=$bdd->prepare("UPDATE kasa.matierep set quantite = $quantite+quantite where nom=$matiere")';
"UPDATE kasa.matierep set quantite = $quantite+quantite where nom='$matiere'")';
  $rqt->execute();


}

echo 1;


 ?>