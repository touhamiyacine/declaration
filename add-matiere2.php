<?php 
  require_once("conn.php");

  $responseBody = file_get_contents('php://input');
  $json = json_decode($responseBody);
  //return data
  foreach ($json as $item)
  {
      $matiere= $item->desc;
      $unite= $item->unite;
      $quantite = $item->quantite;
     
  }
echo  $quantite;
echo $matiere;
  $rqt=$bdd->prepare("select quantite from  kasa.matierep  where nom='$matiere'");
echo "select quantite from  kasa.matierep e where nom=$matiere";
  $rqt->execute();
  while ($row_res=$rqt->fetch()) {
     $lastqte = $row_res['quantite'];
     echo $lastqte;
  }
  $quantiteG=$quantite+$lastqte;
  

$rqt=$bdd->prepare("UPDATE kasa.matierep set quantite ='$quantiteG'  where nom='$matiere'");
echo "UPDATE kasa.matierep set quantite = '$quantiteG'  where nom='$matiere'";
  $rqt->execute();




echo 1;


 ?>