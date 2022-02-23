

<?php
$rqt="";
$row_res="";
$bdd = new PDO('mysql:localhost;dbname=kasa', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$rqt=$bdd->prepare("select  p.ID as ID ,f.nomproduit as nomproduit ,
f.nomformule as nomformule , p.quantiteprod as quantiteprod ,p.idgroupe as idgroupe, p.dateprod as dateprod
from kasa.production as p , kasa.formuleref as f 
where f.ID = p.IDFORMULE
order by p.ID ");
$rqt->execute();
$row_res=$rqt->fetchAll();

echo json_encode($row_res);
?>
