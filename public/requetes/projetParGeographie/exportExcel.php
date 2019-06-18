<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 01/08/2018
 * Time: 21:52
 */

include_once('../../../Databases/FichierBD.php');

if(isset($_GET['where'])) {
    $where = $_GET['where'];
    $requete = '';

    if($where!='') {
        $requete = "SELECT DISTINCT nomregion, nomprovince, nomcommune, nomprojet, datedebutprojet, datefinprojet FROM requete8 WHERE $where";
    }else{
        $requete = "SELECT DISTINCT nomregion, nomprovince, nomcommune, nomprojet, datedebutprojet, datefinprojet FROM requete8";
    }

    set_include_path( get_include_path().PATH_SEPARATOR."..");
    $date = new DateTime('UTC');
    $dat=$date->format('d-m-Y-H-i-s');
    $filename='Projet-par-zone-géographique-'.$dat.'.xlsx';
    header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');


    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center', 'widths' => [10, 25, 15, 15, 35, 15, 15]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true);
    $writer->writeSheetHeader('feuil1', array('Numéro'=>'integer','Région'=>'string', 'Province'=>'string', 'Commune'=>'string', 'Projet'=>'string','Date de debut'=>'date','Date de fin'=>'date'), $format);
    $i = 1;
    $resultat = Bd_Requetes::ListeRequete1($requete);
    $reg=1; $pro=2; $com=3; $deb=5; $fin=6; $proj=4;
    foreach ($resultat as $tab):
        $nomReg=$tab[$reg];
        $reg=$reg+6;
        $nomPro=$tab[$pro];
        $pro=$pro+6;
        $nomCom=$tab[$com];
        $com=$com+6;
        $datedeb=$tab[$deb];
        $deb=$deb+6;
        $datefin=$tab[$fin];
        $fin=$fin+6;
        $nomprojet=$tab[$proj];
        $proj=$proj+6;

        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i,$nomReg,$nomPro, $nomCom,$nomprojet, $datedeb, $datefin), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i,$nomReg,$nomPro, $nomCom,$nomprojet, $datedeb, $datefin), $row_options = array('wrap_text' => true));
        }

        $i++; endforeach;

    $writer->writeToStdOut();

}?>