<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 27/07/2018
 * Time: 08:30
 */


include_once('../../../Databases/FichierBD.php');

if(isset($_GET['where'])) {
    $where = $_GET['where'];
    $requete = '';

    if($where!=''){
        $requete = "SELECT nombailleur, nomprojet, budgetglobal, budgetgmv, datedebutprojet, datefinprojet
                    FROM requete6 WHERE $where";
    }else{
        $requete = "SELECT nombailleur, nomprojet, budgetglobal, budgetgmv, datedebutprojet, datefinprojet
                    FROM requete6";
    }

    set_include_path( get_include_path().PATH_SEPARATOR."..");
    $date = new DateTime('UTC');
    $dat=$date->format('d-m-Y-H-i-s');
    $filename='Projet-montant-'.$dat.'.xlsx';
    header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');


    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center', 'widths' => [10, 25, 30, 20, 20, 15, 15]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true);
    $writer->writeSheetHeader('feuil1', array('Numéro'=>'integer','Bailleur'=>'string','Projet'=>'string', 'Budget global'=>'integer', 'Budget GMV'=>'integer', 'Date de début'=>'date', 'Date de fin'=>'date'), $format);
    $i = 1;
    $resultat = Bd_Requetes::ListeRequete1($requete);
    $ba=1; $pro=2; $glo=3; $gmv=4; $deb=5; $fin=6;
    foreach ($resultat as $tab):
        $nomBail=$tab[$ba];
        $ba=$ba+6;
        $nomPro=$tab[$pro];
        $pro=$pro+6;
        $montantglo=$tab[$glo];
        $glo=$glo+6;
        $montanGmv=$tab[$gmv];
        $gmv=$gmv+6;
        $dateDeb=$tab[$deb];
        $deb=$deb+6;
        $datefin=$tab[$fin];
        $fin=$fin+6;

        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i,strtoupper($nomBail),$nomPro, $montantglo, $montanGmv, $dateDeb,$datefin), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i,strtoupper($nomBail),$nomPro, $montantglo, $montanGmv, $dateDeb,$datefin), $row_options = array('wrap_text' => true));
        }

        $i++; endforeach;

    $writer->writeToStdOut();

}?>