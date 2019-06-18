<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 11/08/2018
 * Time: 21:47
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else {

    set_include_path(get_include_path() . PATH_SEPARATOR . "..");
    $date = new DateTime('UTC');
    $dat = $date->format('d-m-Y-H-i-s');
    $filename = 'Liste des Communes-' . $dat . '.xlsx';
    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    $tableau = Bd_parametre::ListeCommune();
    $cle = 1;
    $idpro = 2;
    $nocom = 3;
    $nbrH = 4;
    $nbrF = 5;
    $totaPo = 6;
    $nbreM = 7;

    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center', 'wrap_text' => true, 'widths' => [11,30, 20, 20, 20, 20, 20, 20]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true, 'halign' => 'center');
    $writer->writeSheetHeader('feuil1', array('Numéro' => 'integer', 'Nom de la région' => 'string', 'Nom de la province' => 'string', 'Nom de commune' => 'string', 'Nombre d\'homme' => 'integer',
        'Nombre de femme' => 'integer', 'Nombre de ménage' => 'integer', 'Population total' => 'integer'), $format);
    $i = 1;
    $province = new Bd_parametre();
    foreach ($tableau as $tab):
        $idpr = $tab[$idpro];
        $nomprovince = $province->RecupererNomProvince($idpr);
        $idregion=$province->RecupererIdRegion($idpr);
        $nomReg=$province->RecupererNomRegion($idregion);
        $idpro = $idpro + 7;//j
        $nomCom = $tab[$nocom];
        $nocom = $nocom + 7;
        $nbreHomme = $tab[$nbrH];
        $nbrH = $nbrH + 7;
        $nbreFemme = $tab[$nbrF];
        $nbrF = $nbrF + 7;
        $population = $tab[$totaPo];
        $totaPo = $totaPo + 7;
        $nombreMenage = $tab[$nbreM];
        $nbreM = $nbreM + 7;
        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i, $nomReg, $nomprovince, $nomCom, $nbreHomme, $nbreFemme, $nombreMenage, $population), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i, $nomReg, $nomprovince, $nomCom, $nbreHomme, $nbreFemme, $nombreMenage, $population), $row_options = array('wrap_text' => true, 'halign' => 'center'));
        }

        $i++; endforeach;

    $writer->writeToStdOut();
}