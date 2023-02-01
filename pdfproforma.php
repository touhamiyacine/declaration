

<?php
 require_once("conn.php");
$id="";
if (isset($_REQUEST['id'])) { 
    $id = $_REQUEST['id'];
    
    
    }

   
    
include("convert.php");
require('tfpdf.php');
class PDF extends TFPDF
{
// En-t?te
function Header()
{
 $this->SetFont('Arial','B',10);
 $this->Image('kasa.png',6,4,190);
	 $this->Cell(150,5,'','O','0','L');
	 $this->SetFont('Arial','B',12);
	// $this->Cell(60,5,'MAPFRE | Assistance','O','0','L');
      $this->SetFont('Arial','B',10);
	  $this->Ln(30);
}

// Pied de page
function Footer()
{
    // Positionnement ? 1,5 cm du bas
    $this->SetY(-15);
    // Police Arial italique 8
    $this->SetFont('Arial','I',6);
    // Num?ro de page
    $this->Cell(0,8,'Page '.$this->PageNo().'/{nb}',0,0,'C');$this->Ln(3);
	$this->Cell(0,8,"Siége Social : 27 Rue mokdes Benyoucef , Birtouta alger ,  ",0,0,'C');
	$this->Ln(2);
	$this->Cell(0,8,"RC : 16/00-1014068 B 19   NIF : 001916101406813 *AI N° 16540701003",0,0,'C');
	$this->Ln(2);
	$this->Cell(0,8,"Tel : +213 (0) 550/996/668  Site Web : https://kasa-mortiers.com/  ",0,0,'C');
	}
}
$rqtc=$bdd->prepare("select  c.raison as raison  , c.adresse as adresse  , c.rc as rc  , p.date as date from kasa.clientproforma as p  , kasa.client as c where c.ID = p.idclient and p.ID='$id'");
   
$rqtc->execute();
$raison="";
$adresse="";
$rc="";
$date="";

while($rows_c=$rqtc->fetch())
{
    $raison=$rows_c['raison'];
    $adresse=$rows_c['adresse'];
    $rc=$rows_c['rc'];
    $date=$rows_c['date'];
}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Cell(185,5," Date :  ".date("d/m/Y", strtotime($date))."",'0','0','L'); 
$pdf->Ln(5);
$pdf->SetFillColor(205,205,205);
$pdf->SetFont('Arial','B',16);   
$pdf->Cell(190,8,"Facture Pro forma",'0','0','C'); 

$pdf->Ln();

$pdf->Cell(190, 8, 'N°' . $id. '', '0', '0', 'C');

    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFont('Arial', 'I', 8);
   
    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 14);
//$pdf->Ln(2);
    $pdf->SetFillColor(7, 27, 81);
    $pdf->SetTextColor(255, 255, 255);
  
//Le client
         
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 5, "Client", '1', '1', 'C', '1');
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(221, 221, 221);
        $pdf->Cell(40, 5, 'Raison Sociale', '1', '0', 'L', '1');
        $pdf->Cell(55, 5, "" . $raison . "", '1', '0', 'C');
        $pdf->Cell(40, 5, 'Adresse', '1', '0', 'L', '1');
        $pdf->Cell(55, 5, "" . $adresse . "", '1', '0', 'C');
        $pdf->Ln();
        $pdf->Cell(40, 5, 'N°R.C', '1', '0', 'L', '1');
        $pdf->Cell(55, 5, "" . $rc . "", '1', '0', 'C');
        $pdf->Cell(40, 5, 'N°I.F', '1', '0', 'L', '1');
        $pdf->Cell(55, 5, "" . $rc . "", '1', '0', 'C');
        $pdf->Ln();
        
        $pdf->Ln(2);   
        $pdf->Ln();
        $pdf->Ln(2);
        $global=0;
        $rqtc=$bdd->prepare("SELECT produit , unite , prixunite , prixtotal  FROM kasa.produitproforma WHERE `idproforma`='$id'");
   
        $rqtc->execute();
        
        
            $pdf->SetFillColor(7, 27, 81);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->SetFont('Arial', 'B', 10);
            
          
            $pdf->Cell(65, 5, 'Produit', '1', '0', 'C', '1');
            $pdf->Cell(30, 5, 'unite', '1', '0', 'C', '1');
            $pdf->Cell(40, 5, 'prixHT', '1', '0', 'C', '1');
            $pdf->Cell(50, 5, 'Montant', '1', '1', 'C', '1');
       
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFillColor(221, 221, 221);
            while ($rows_c=$rqtc->fetch()) {
                $produit=$rows_c['produit'];
                $unite=$rows_c['unite'];
                $prixunite=$rows_c['prixunite'];
                $prixtotal=$rows_c['prixtotal'];
                $pdf->SetFont('Arial', 'B', 8);
                $pdf->Cell(75, 5, "" . $produit . "", '1', '0', 'C');
                
                $pdf->Cell(45, 5, "" . $unite . "", '1', '0', 'C');
                
                $pdf->Cell(25, 5, "" . number_format($prixunite, 2, ',', ' ') . "  DZD", '1', '0', 'R');
                
                $pdf->Cell(25, 5, "" . number_format($prixtotal, 2, ',', ' ') . "  DZD", '1', '0', 'R');
                $pdf->Ln();
                $global = $prixtotal+$global;
                
            }
            $tva=0;
            $tva=$global*0.19;
            $pdf->Ln();
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(80, 5, 'TOTAL HT :', '1', '0', 'C', '1');
            $pdf->Cell(110, 5, "" . number_format($global, 2, ',', ' ') . "  DZD", '1', '0', 'C');
            $pdf->Ln();
            $pdf->Cell(80, 5, 'TV (19%) :', '1', '0', 'C', '1');
            $pdf->Cell(110, 5,"" . number_format($tva, 2, ',', ' ') . "  DZD", '1', '0', 'C');
            $pdf->Ln();
            $pdf->Cell(80, 5, 'TOTAL TTC :', '1', '0', 'C', '1');
            $pdf->Cell(110, 5, "" . number_format($tva+$global, 2, ',', ' ') . "  DZD", '1', '0', 'C');
            $pdf->Ln();
    //Le client
             
  
  
    









$pdf->Output();
?>