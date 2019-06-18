<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 11/08/2018
 * Time: 23:13
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else {


    set_include_path(get_include_path() . PATH_SEPARATOR . "..");
    $date = new DateTime('UTC');
    $dat = $date->format('d-m-Y-H-i-s');
    $filename = 'Liste des Aménagements-' . $dat . '.xlsx';
    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');


    $tableau = Bd_parametre::ListeAmenagement();

    $idcat = 2;
    $no = 3;
    $souscat = 4;


    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center', 'wrap_text' => true, 'widths' => [11, 30, 30, 30]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true, 'halign' => 'center');
    $writer->writeSheetHeader('feuil1', array('Numéro' => 'integer', 'Nom de la catégorie' => 'string', 'Nom de l\'aménagement' => 'string', 'Nom de la sous-catégorie' => 'string'), $format);
    $i = 1;
    $parametre = new Bd_parametre();
    foreach ($tableau as $tab):

        $cat = $tab[$idcat];
        $nomCat = $parametre->RecupererNomCategorie($cat);
        $idcat = $idcat + 5;
        $nomAm = $tab[$no];
        $no = $no + 5;
        $nomsouscat = $tab[$souscat];
        $souscat = $souscat + 5;
        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i, $nomCat, $nomAm, $nomsouscat), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i, $nomCat, $nomAm, $nomsouscat), $row_options = array('wrap_text' => true, 'halign' => 'center'));
        }

        $i++; endforeach;

    $writer->writeToStdOut();
}