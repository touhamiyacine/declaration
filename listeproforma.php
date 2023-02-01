

<?php
require_once("conn.php");
$rqt="";
$row_res="";

$rqt=$bdd->prepare("select  p.ID , p.idclient , p.total , p.date
from kasa.clientproforma as p 

order by p.ID ");
$rqt->execute();
$row_res=$rqt->fetchAll();

echo json_encode($row_res);
?>
