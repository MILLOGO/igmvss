<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 11/08/2018
 * Time: 08:51
 */

include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else {

    set_include_path(get_include_path() . PATH_SEPARATOR . "..");
    $date = new DateTime('UTC');
    $dat = $date->format('d-m-Y-H-i-s');
    $filename = 'Liste des appuis aux gestionnaires-' . $dat . '.xlsx';
    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    $tableau = Bd_GestionSite::ListerOperateurGestionnaireAppui();

    $cle = 22;
    $noOp = 1;
    $noGe = 9;
    $preno = 10;
    $typ = 21;
    $typege = 8;
    $datedeb = 23;
    $datef = 24;

    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center', 'wrap_text' => true, 'widths' => [11, 30, 35, 15, 20, 15, 15]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true, 'halign' => 'center');
    $writer->writeSheetHeader('feuil1', array('Numéro' => 'integer', 'Opérateur' => 'string', 'Nom et Prénoms du gestionnaire' => 'string', 'Type du gestionnaire' => 'string', 'Type d\'appui' => 'string', 'date début' => 'date', 'date fin' => 'date'), $format);
    $i = 1;
    $taille = 27;
    foreach ($tableau as $tab):

        $nomGe = $tab[$noGe];
        $noGe = $noGe + $taille;
        $prenomGe = $tab[$preno];
        $preno = $preno + $taille;
        $typeappui = $tab[$typ];
        $typ = $typ + $taille;
        $datedebut = $tab[$datedeb];
        $datedeb = $datedeb + $taille;
        $datefin = $tab[$datef];
        $datef = $datef + $taille;
        $nomOpt = $tab[$noOp];
        $noOp = $noOp + $taille;
        $typegest = $tab[$typege];
        $typege = $typege + $taille;

        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i, strtoupper($nomOpt), strtoupper($nomGe) . ' ' . $prenomGe, $typegest, $typeappui, $datedebut, $datefin), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i, strtoupper($nomOpt), strtoupper($nomGe) . ' ' . $prenomGe, $typegest, $typeappui, $datedebut, $datefin), $row_options = array('wrap_text' => true, 'halign' => 'center'));
        }

        $i++; endforeach;

    $writer->writeToStdOut();
}
