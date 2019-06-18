<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 11/08/2018
 * Time: 20:56
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else {

    set_include_path(get_include_path() . PATH_SEPARATOR . "..");
    $date = new DateTime('UTC');
    $dat = $date->format('d-m-Y-H-i-s');
    $filename = 'Liste des utilisateurs-' . $dat . '.xlsx';
    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');


    $tableau = Bd_user::ListerTousUser();

    $cle = 1;
    $no = 2;
    $preno = 3;
    $fct = 4;
    $serv = 5;
    $tel = 6;
    $ema = 7;
    $ident = 8;
    $pro = 10;

    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center', 'wrap_text' => true, 'widths' => [11, 36, 20, 15, 35, 15, 20, 20]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true, 'halign' => 'center');
    $writer->writeSheetHeader('feuil1', array('Numéro' => 'integer', 'Nom et Prénoms de l\'utilisateur' => 'string', 'Identifiant' => 'string', 'Téléphone' => 'string', 'Adresse email' => 'string', 'Fonction' => 'string', 'Service' => 'string', 'Profil' => 'string'), $format);
    $i = 1;
    $taille = 14;
    foreach ($tableau as $tab):
        $id = $tab[$cle];
        $cle = $cle + 10;
        $numero = $tab[$tel];
        $tel = $tel + 10;
        $nom = $tab[$no];
        $no = $no + 10;
        $prenom = $tab[$preno];
        $preno = $preno + 10;
        $fonction = $tab[$fct];
        $fct = $fct + 10;
        $service = $tab[$serv];
        $serv = $serv + 10;
        $email = $tab[$ema];
        $ema = $ema + 10;
        $identifiant = $tab[$ident];
        $ident = $ident + 10;
        $prof = $tab[$pro];
        if ($prof == 1) {
            $profil = 'Administrateur';
        } else {
            $profil = 'Utilisateur simple';
        }
        $pro = $pro + 10;

        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i, strtoupper($nom) . ' ' . $prenom, $identifiant, $numero, $email, $fonction, $service, $profil), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i, strtoupper($nom) . ' ' . $prenom, $identifiant, $numero, $email, $fonction, $service, $profil), $row_options = array('wrap_text' => true, 'halign' => 'center'));
        }

        $i++; endforeach;

    $writer->writeToStdOut();
}
