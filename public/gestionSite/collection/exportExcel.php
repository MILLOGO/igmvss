<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 11/08/2018
 * Time: 07:06
 */

include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else {

    set_include_path(get_include_path() . PATH_SEPARATOR . "..");
    $date = new DateTime('UTC');
    $dat = $date->format('d-m-Y-H-i-s');
    $filename = 'Liste des observations des sites-' . $dat . '.xlsx';
    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    $tableau = Bd_GestionSite::ListeCollection();

    $no = 1;
    $preno = 2;
    $numeC = 4;
    $dat = 7;
    $numFi = 8;
    $nosit = 9;
    $super = 10;

    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center', 'wrap_text' => true, 'widths' => [11, 35, 20, 20, 15, 25, 10]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true, 'halign' => 'center');
    $writer->writeSheetHeader('feuil1', array('Numéro' => 'integer', 'Nom et Prénoms du collecteur ' => 'string', 'Téléphone' => 'string', 'Nom du site' => 'string', 'Superficie' => 'integer', 'date d\'observation' => 'date', 'N°fiche' => 'string'), $format);
    $i = 1;
    $taille = 12;
    foreach ($tableau as $tab):
        $numero = $tab[$numeC];
        $numeC = $numeC + $taille;
        $nom = $tab[$no];
        $no = $no + $taille;
        $prenom = $tab[$preno];
        $preno = $preno + $taille;
        $nomSite = $tab[$nosit];
        $nosit = $nosit + $taille;
        $superficie = $tab[$super];
        $super = $super + $taille;
        $datepass = $tab[$dat];
        $dat = $dat + $taille;
        $numFiche = $tab[$numFi];
        $numFi = $numFi + $taille;
        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i, strtoupper($nom) . ' ' . $prenom, $numero, $nomSite, $superficie, $datepass, $numFiche), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i, strtoupper($nom) . ' ' . $prenom, $numero, $nomSite, $superficie, $datepass, $numFiche), $row_options = array('wrap_text' => true, 'halign' => 'center'));
        }

        $i++; endforeach;

    $writer->writeToStdOut();
}
