

<?php
$rqt="";
$row_res="";
$bdd = new PDO('mysql:localhost;dbname=kasa', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$rqt=$bdd->prepare("select m.id , m.nom   from kasa.produit as m ");
$rqt->execute();
$row_res=$rqt->fetchAll();

echo json_encode($row_res);
?>