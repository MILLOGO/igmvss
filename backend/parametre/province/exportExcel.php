<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 11/08/2018
 * Time: 21:38
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else {

    set_include_path(get_include_path() . PATH_SEPARATOR . "..");
    $date = new DateTime('UTC');
    $dat = $date->format('d-m-Y-H-i-s');
    $filename = 'Liste des Provinces-' . $dat . '.xlsx';
    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');


    $tableau = Bd_parametre::ListeProvince();
    $idregion = 2;
    $des = 3;

    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center', 'wrap_text' => true, 'widths' => [11, 30, 30]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true, 'halign' => 'center');
    $writer->writeSheetHeader('feuil1', array('Numéro' => 'integer', 'Nom de la province' => 'string', 'Nom de région' => 'string'), $format);
    $i = 1;
    $region = new Bd_parametre();
    foreach ($tableau as $tab):
        $regi = $tab[$idregion];
        $nomregion = $region->RecupererNomRegion($regi);
        $idregion = $idregion + 3;
        $nomprovince = $tab[$des];
        $des = $des + 3;

        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i, $nomprovince, strtoupper($nomregion)), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i, $nomprovince, strtoupper($nomregion)), $row_options = array('wrap_text' => true, 'halign' => 'center'));
        }

        $i++; endforeach;

    $writer->writeToStdOut();
}
