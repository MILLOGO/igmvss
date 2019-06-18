<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 11/08/2018
 * Time: 06:47
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else {

    set_include_path(get_include_path() . PATH_SEPARATOR . "..");
    $date = new DateTime('UTC');
    $dat = $date->format('d-m-Y-H-i-s');
    $filename = 'Liste des collecteurs-' . $dat . '.xlsx';
    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    $tableau = Bd_GestionSite::ListerTousCollecteur();

    $cle = 1;
    $no = 2;
    $preno = 3;
    $fct = 4;
    $numeC = 5;
    $email = 6;

    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center', 'wrap_text' => true, 'widths' => [11, 35, 20, 20, 35]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true);
    $writer->writeSheetHeader('feuil1', array('Numéro' => 'integer', 'Nom et Prénoms du collecteur ' => 'string', 'Fonction' => 'string', 'Téléphone' => 'string', ' Adresse Email' => 'string'), $format);
    $i = 1;
    $taille = 6;
    foreach ($tableau as $tab):
        $numero = $tab[$numeC];
        $numeC = $numeC + $taille;
        $nom = $tab[$no];
        $no = $no + $taille;
        $prenom = $tab[$preno];
        $preno = $preno + $taille;
        $fonction = $tab[$fct];
        $fct = $fct + $taille;
        $emailB = $tab[$email];
        $email = $email + $taille;
        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i, strtoupper($nom) . ' ' . $prenom, $fonction, $numero, $emailB), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i, strtoupper($nom) . ' ' . $prenom, $fonction, $numero, $emailB), $row_options = array('wrap_text' => true));
        }

        $i++; endforeach;

    $writer->writeToStdOut();
}

