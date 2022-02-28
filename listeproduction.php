

<?php
require_once("conn.php");
$rqt="";
$row_res="";

$rqt=$bdd->prepare("select  p.ID as ID ,f.nomproduit as nomproduit ,
f.nomformule as nomformule , p.quantiteprod as quantiteprod ,p.idgroupe as idgroupe, p.dateprod as dateprod
from kasa.production as p , kasa.formuleref as f 
where f.ID = p.IDFORMULE
order by p.ID ");
$rqt->execute();
$row_res=$rqt->fetchAll();

echo json_encode($row_res);
?>
