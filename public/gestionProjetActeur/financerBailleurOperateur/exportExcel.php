<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 26/07/2018
 * Time: 08:36
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else {

    set_include_path(get_include_path() . PATH_SEPARATOR . "..");

    $date = new DateTime('UTC');
    $dat = $date->format('d-m-Y-H-i-s');
    $filename = 'Liste de financement des opérateurs-' . $dat . '.xlsx';
    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    $tableau = Bd_GestionProjetActeur::ListeFinanceOperateur();

    $cle=8;
    $nopro=1;
    $noBail=3;
    $noOp=5;
    $mont=6;
    $anne=7;

    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center', 'widths' => [10, 25, 25, 25, 15, 10]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true);
    $writer->writeSheetHeader('feuil1', array('Numéro' => 'integer', 'Nom de l\'opérateur' => 'string', 'Nom du bailleur' => 'string', 'Nom du projet' => 'string', 'Montant' => 'integer', 'Année' => 'integer'), $format);
    $i = 1;

    $gesttionprojetacteur=new Bd_GestionProjetActeur();
    $taille=8;
    foreach ($tableau as $tab):
        $id=$tab[$cle];
        $cle=$cle+$taille;
        $bailleur=$tab[$noBail];
        $noBail=$noBail+$taille;
        $operateur=$tab[$noOp];
        $noOp=$noOp+$taille;
        if($tab[$nopro]!=-1){
            $projet= $gesttionprojetacteur->RecupererNomProjet($tab[$nopro]);
        }else{
            $projet= "Aucun Projet";
        }

        $nopro=$nopro+$taille;
        $montant=$tab[$mont];
        $mont=$mont+$taille;
        $annee=$tab[$anne];
        $anne=$anne+$taille;

        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i, strtoupper($operateur), strtoupper($bailleur), $projet, $montant, $annee), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i, strtoupper($operateur), strtoupper($bailleur), $projet, $montant, $annee), $row_options = array('wrap_text' => true));
        }

        $i++; endforeach;

    $writer->writeToStdOut();
}

