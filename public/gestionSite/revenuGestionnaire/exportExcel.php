<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 11/08/2018
 * Time: 08:19
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else {

    set_include_path(get_include_path() . PATH_SEPARATOR . "..");
    $date = new DateTime('UTC');
    $dat = $date->format('d-m-Y-H-i-s');
    $filename = 'Revenu annuel des gestionnaires-' . $dat . '.xlsx';
    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    $tableau = Bd_GestionSite::ListeRevenu();

    $type = 1;
    $noGe = 2;
    $preno = 3;
    $num = 4;
    $mail = 5;
    $mont = 7;
    $anne = 8;
    $cle = 9;

    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center', 'wrap_text' => true, 'widths' => [11, 35, 20, 35, 15, 20, 10]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true, 'halign' => 'center');
    $writer->writeSheetHeader('feuil1', array('Numéro' => 'integer', 'Nom et Prénoms du gestionnaire' => 'string', 'Téléphone' => 'string', 'Adresse email' => 'string', 'Type' => 'string', 'Montant annuel (FCFA)' => 'integer', 'Année' => 'integer'), $format);
    $i = 1;
    $taille = 14;
    foreach ($tableau as $tab):

        $id = $tab[$cle];
        $cle = $cle + 9;
        $typeGest = $tab[$type];
        $type = $type + 9;
        $numero = $tab[$num];
        $num = $num + 9;
        $nomGe = $tab[$noGe];
        $noGe = $noGe + 9;
        $prenomGe = $tab[$preno];
        $preno = $preno + 9;
        $email = $tab[$mail];
        $mail = $mail + 9;
        $montant = $tab[$mont];
        $mont = $mont + 9;
        $annee = $tab[$anne];
        $anne = $anne + 9;

        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i, strtoupper($nomGe) . ' ' . $prenomGe, $numero, $email, $typeGest, $montant, $annee), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i, strtoupper($nomGe) . ' ' . $prenomGe, $numero, $email, $typeGest, $montant, $annee), $row_options = array('wrap_text' => true, 'halign' => 'center'));
        }

        $i++; endforeach;

    $writer->writeToStdOut();
}
