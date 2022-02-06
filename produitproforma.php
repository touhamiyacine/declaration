

<?php
$rqt="";
$row_res="";
$bdd = new PDO('mysql:localhost;dbname=kasa', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$rqt=$bdd->prepare("select id ,  nomproduit , volume , prixHT , prixTTC   from  kasa.exworks");
$rqt->execute();
$row_res=$rqt->fetchAll();

echo json_encode($row_res);
?>