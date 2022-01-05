<?php 
  $bdd = new PDO('mysql:localhost;dbname=kasa', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  $responseBody = file_get_contents('php://input');
  $json = json_decode($responseBody);
  //return data
 
  $produit = $json->nom;

  $rqt=$bdd->prepare("INSERT INTO kasa.produit (`nom`) VALUES ('$produit')");

  $rqt->execute();

  






  $matiere = json_decode($json->m);
  
  foreach ($matiere as $item)
{   
 $matiere= $item->desc;
 $quantite = $item->quantite;

$rqt=$bdd->prepare("INSERT INTO kasa.formule (`produit`,`matiere`,`quantite`) VALUES ('$produit','$matiere','$quantite')");

  $rqt->execute();


}

echo 1;


 ?>