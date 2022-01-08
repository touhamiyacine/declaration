<?php 
  $bdd = new PDO('mysql:localhost;dbname=kasa', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  $responseBody = file_get_contents('php://input');
  $json = json_decode($responseBody);
  //return data
 
  $nomproduit = $json->nameproduit;
  $nomformule = $json->nameformule;


  $rqt=$bdd->prepare("INSERT INTO kasa.produit (`nom`) VALUES ('$nomproduit')");

  $rqt->execute();
  $rqt=$bdd->prepare("INSERT INTO kasa.formuleref (`nomformule`,`nomproduit`) 
  VALUES ('$nomformule','$nomproduit')");
$rqt->execute();
$idformule = $bdd->lastInsertId();

  $matiere = json_decode($json->m);
  
  foreach ($matiere as $item)
{   
 $matiere= $item->desc;
 $quantite = $item->quantite;

$rqt=$bdd->prepare("INSERT INTO kasa.formule (`IDFORMULE`,
`produit`,`matiere`,`quantite`) VALUES ('$idformule','$nomproduit','$matiere','$quantite')");

  $rqt->execute();
echo "INSERT INTO kasa.formule (`IDFORMULE`,
`produit`,`matiere`,`quantite`) VALUES ('$idformule','$nomproduit','$matiere','$quantite')";

}

echo 1;


 ?>