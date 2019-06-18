<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 11/08/2018
 * Time: 07:26
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


    $tableau = Bd_GestionSite::ListerTousGestionnaire();

    $cle = 1;
    $no = 3;
    $preno = 4;
    $typ = 2;
    $numeC = 5;
    $email = 6;
    $sexe = 8;
    $genre = 12;

    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center', 'wrap_text' => true, 'widths' => [11, 35, 20, 35, 15, 15]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true, 'halign' => 'center');
    $writer->writeSheetHeader('feuil1', array('Numéro' => 'integer', 'Nom et Prénoms du gestionnaire' => 'string', 'Téléphone' => 'string', 'Adresse email' => 'string', 'Type' => 'string', 'Genre' => 'string'), $format);
    $i = 1;
    $taille = 14;
    foreach ($tableau as $tab):

        $numero = $tab[$numeC];
        $numeC = $numeC + $taille;
        $nom = $tab[$no];
        $no = $no + $taille;
        $prenom = $tab[$preno];
        $preno = $preno + $taille;
        $type = $tab[$typ];
        $typ = $typ + $taille;
        $emailB = $tab[$email];
        $email = $email + $taille;
        if ($type == 'individuel') {
            $genreGes = $tab[$sexe];
            $sexe = $sexe + $taille;
            $genre = $genre + $taille;
        } else {
            $genreGes = $tab[$genre];
            $sexe = $sexe + $taille;
            $genre = $genre + $taille;
        }
        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i, strtoupper($nom) . ' ' . $prenom, $numero, $emailB, $type, $genreGes), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i, strtoupper($nom) . ' ' . $prenom, $numero, $emailB, $type, $genreGes), $row_options = array('wrap_text' => true, 'halign' => 'center'));
        }

        $i++; endforeach;

    $writer->writeToStdOut();
}
