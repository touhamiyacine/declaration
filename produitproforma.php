

<?php
require_once("conn.php");
$rqt="";
$row_res="";

$rqt=$bdd->prepare("select id ,  nomproduit , volume , prixHT , prixTTC   from  kasa.exworks");
$rqt->execute();
$row_res=$rqt->fetchAll();

echo json_encode($row_res);
?>