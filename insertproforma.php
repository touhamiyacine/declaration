<?php 
  require_once("conn.php");
  $responseBody = file_get_contents('php://input');
  $json = json_decode($responseBody);
  //return data
  $datesys=date("Y-m-d H:i:s");  
  $total = $json->total;
  $idclient = $json->client;


 
  $rqt=$bdd->prepare("INSERT INTO kasa.clientproforma (`idclient`,`total`,`date`) 
  VALUES ('$idclient','$total',' $datesys')");
$rqt->execute();
$idprofoma = $bdd->lastInsertId();

  $produit = json_decode($json->m);
  
  foreach ($produit as $item)
{   
 $produit= $item->desc;
 $quantite = $item->quantite;
 $prixunite = $item->prixunite;
 $prix = $item->prix;

$rqt=$bdd->prepare("INSERT INTO kasa.produitproforma (`idproforma`,
`produit`,`unite`,`prixunite`,`prixtotal`) VALUES ('$idprofoma','$produit','$quantite','$prixunite',
'$prix')");

  $rqt->execute();


}

echo 1;


 ?>