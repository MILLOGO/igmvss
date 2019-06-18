<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 26/07/2018
 * Time: 01:07
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else {

    set_include_path(get_include_path() . PATH_SEPARATOR . "..");

    $date = new DateTime('UTC');
    $dat = $date->format('d-m-Y-H-i-s');
    $filename = 'Liste des projets-' . $dat . '.xlsx';
    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    $tableau = Bd_GestionProjetActeur::ListerTousProjet();

    $cle = 1;
    $nop = 2;
    $budg = 3;
    $gmv = 4;
    $datd = 5;
    $datf = 6;
    $noc = 7;
    $prenoc = 8;
    $numc = 9;
    $mail = 10;
    $sit = 11;
    $desc = 12;

    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center', 'widths' => [10, 25, 20, 20, 20, 20, 20, 30, 15, 30, 20, 30]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true);
    $writer->writeSheetHeader('feuil1', array('Numéro' => 'integer', 'Nom du projet' => 'string', 'Budget global' => 'integer', 'Budget GMV ' => 'integer', 'Date de début' => 'date', 'Date de fin' => 'date', 'Nom du contact' => 'string', 'Prénoms du contact' => 'string', 'Téléphone' => 'string', 'Email' => 'string', 'Site internet' => 'string', 'description' => 'string'), $format);
    $i = 1;
    foreach ($tableau as $tab):
        $nomP = $tab[$nop];
        $nop = $nop + 12;
        $budget = $tab[$budg];
        $budg = $budg + 12;
        $datedeb = $tab[$datd];
        $datd = $datd + 12;
        $datefin = $tab[$datf];
        $datf = $datf + 12;
        $nomcont = $tab[$noc];
        $noc = $noc + 12;
        $prenomcont = $tab[$prenoc];
        $prenoc = $prenoc + 12;
        $numerocont = $tab[$numc];
        $numc = $numc + 12;
        $email = $tab[$mail];
        $mail = $mail + 12;
        $site = $tab[$sit];
        $sit = $sit + 12;
        $descrip = $tab[$desc];
        $desc = $desc + 12;
        $budgmv = $tab[$gmv];
        $gmv = $gmv + 12;
        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i, $nomP, $budget, $budgmv, $datedeb, $datefin, $nomcont, $prenomcont, $numerocont,
                $email, $site, $descrip), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i, $nomP, $budget, $budgmv, $datedeb, $datefin, $nomcont, $prenomcont, $numerocont,
                $email, $site, $descrip), $row_options = array('wrap_text' => true));
        }

        $i++; endforeach;

    $writer->writeToStdOut();
}

