<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 25/07/2018
 * Time: 23:46
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else {

    set_include_path(get_include_path() . PATH_SEPARATOR . "..");
    $date = new DateTime('UTC');
    $dat = $date->format('d-m-Y-H-i-s');
    $filename = 'Liste des opérateurs-' . $dat . '.xlsx';
    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    $tableau = Bd_GestionProjetActeur::ListerTousOperateur();

    $cle = 1;
    $nop = 2;
    $nocop = 3;
    $prenocop = 4;
    $emailcop = 5;
    $numecop = 6;
    $fctcop = 7;
    $siteop = 8;
    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center', 'widths' => [10, 25, 25, 25, 25, 30, 30, 30]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true);
    $writer->writeSheetHeader('feuil1', array('Numéro' => 'integer', 'Nom de l\'opérateur' => 'string', 'Nom du contact' => 'string', 'Prénoms du contact ' => 'string', 'Téléphone' => 'string', 'Email' => 'string', 'Fonction' => 'string', 'Site internet' => 'string'), $format);
    $i = 1;
    foreach ($tableau as $tab):
        $numercopera = $tab[$numecop];
        $numecop = $numecop + 8;
        $nomcopera = $tab[$nocop];
        $nocop = $nocop + 8;
        $nomopera = $tab[$nop];
        $nop = $nop + 8;
        $prenomcopera = $tab[$prenocop];
        $prenocop = $prenocop + 8;
        $emailcopera = $tab[$emailcop];
        $emailcop = $emailcop + 8;
        $fctcopera = $tab[$fctcop];
        $fctcop = $fctcop + 8;
        $siteopera = $tab[$siteop];
        $siteop = $siteop + 8;
        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i, strtoupper($nomopera), strtoupper($nomcopera), $prenomcopera, $numercopera, $emailcopera, $fctcopera, $siteopera), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i, strtoupper($nomopera), strtoupper($nomcopera), $prenomcopera, $numercopera, $emailcopera, $fctcopera, $siteopera), $row_options = array('wrap_text' => true));
        }

        $i++; endforeach;

    $writer->writeToStdOut();
}

