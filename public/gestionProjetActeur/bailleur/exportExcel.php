<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 24/07/2018
 * Time: 09:26
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else {

    set_include_path(get_include_path() . PATH_SEPARATOR . "..");


    $date = new DateTime('UTC');
    $dat = $date->format('d-m-Y-H-i-s');
    $filename = 'Liste des bailleurs-' . $dat . '.xlsx';
    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    $tabBailleur = Bd_GestionProjetActeur::ListeTousBailleur();
    $idbail = 1;
    $nomb = 2;
    $nomc = 3;
    $prenomC = 4;
    $numeC = 5;
    $email = 6;
    $desc = 7;
    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center', 'widths' => [10, 25, 25, 25, 25, 30, 30]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true);
    $writer->writeSheetHeader('feuil1', array('Numéro' => 'integer', 'Nom du bailleur' => 'string', 'Nom' => 'string', 'Prénoms' => 'string', 'Téléphone' => 'string', 'Email' => 'string', 'Description' => 'string'), $format);
    $i = 1;
    foreach ($tabBailleur as $tab):
        $id = $tab[$idbail];
        $idbail = $idbail + 7;
        $numero = $tab[$numeC];
        $numeC = $numeC + 7;
        $nombail = $tab[$nomb];
        $nomb = $nomb + 7;
        $prenomcont = $tab[$prenomC];
        $prenomC = $prenomC + 7;
        $nomcont = $tab[$nomc];
        $nomc = $nomc + 7;
        $emailB = $tab[$email];
        $email = $email + 7;
        $descrip = $tab[$desc];
        $desc = $desc + 7;
        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i, strtoupper($nombail), strtoupper($nomcont), $prenomcont, $numero, $emailB, $descrip), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i, strtoupper($nombail), strtoupper($nomcont), $prenomcont, $numero, $emailB, $descrip), $row_options = array('wrap_text' => true));
        }

        $i++; endforeach;

    $writer->writeToStdOut();
}

