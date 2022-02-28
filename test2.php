

<?php
require_once("conn.php");
$rqt="";
$row_res="";

$rqt=$bdd->prepare("select m.id , m.nom , m.unite  from kasa.matierep as m ");
$rqt->execute();
$row_res=$rqt->fetchAll();

echo json_encode($row_res);
?>