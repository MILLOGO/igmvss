<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 11/08/2018
 * Time: 09:23
 */
include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else {


    set_include_path(get_include_path() . PATH_SEPARATOR . "..");
    $date = new DateTime('UTC');
    $dat = $date->format('d-m-Y-H-i-s');
    $filename = 'Liste des aménagements-' . $dat . '.xlsx';
    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center', 'wrap_text' => true, 'widths' => [11, 30, 35, 20, 15, 15, 15]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true, 'halign' => 'center');
    $writer->writeSheetHeader('feuil1', array('Numéro' => 'integer', 'Opérateur' => 'string', 'Projet' => 'string', 'Nom du site' => 'string', 'Superficie du site (ha)' => 'string', 'Superficie ciblée (ha)' => 'string', 'Localité' => 'string'), $format);
    $i = 1;
    $taille = 35;

    $tableau = Bd_GestionAmenagement::ListeAmenager();

    $cle = 1;
    $noSite = 9;
    $super = 10;
    $supercible = 5;
    $noPro = 13;
    $loc = 11;
    $op = 24;
    $ipr = 8;
    $typemes=34;
    $typeamenager=35;
    foreach ($tableau as $tab):

        $id = $tab[$cle];
        $cle = $cle + $taille;
        $idprojet = $tab[$ipr];
        $ipr = $ipr + $taille;
        $site = $tab[$noSite];
        $noSite = $noSite + $taille;
        $superficie = $tab[$super];
        $super = $super + $taille;
        $superficiecible = $tab[$supercible];
        $supercible = $supercible + $taille;
        $nomPro = $tab[$noPro];
        $noPro = $noPro + $taille;
        $nomOp = $tab[$op];
        $op = $op + $taille;
        $localite = $tab[$loc];
        $loc = $loc + $taille;
        $typemesure=$tab[$typemes];
        $typemes=$typemes+$taille;
        $typeamenagersite=$tab[$typeamenager];
        $typeamenager=$typeamenager+$taille;
        if($typemesure=='longueur'){
            if($superficie!=0){
                $superficie= $superficie." Km";
            }else{
                $superficie= 'inconnue';
            }

        }else{
            if($typemesure=='superficie') {
                if($superficie!=0){
                    $superficie= $superficie . " ha";
                }else{
                    $superficie= 'inconnue';
                }

            }else{
                $superficie= 'inconnue';
            }
        }

        if($typeamenagersite=='longueur'){
            if($superficiecible!=0){
                $superficiecible= $superficiecible." Km";
            }else{
                $superficiecible= 'inconnue';
            }

        }else{
            if($typeamenagersite=='superficie') {
                if($superficiecible!=0){
                    $superficiecible= $superficiecible . " ha";
                }else{
                    $superficiecible= 'inconnue';
                }

            }else{
                $superficiecible= 'inconnue';
            }
        }

        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i, strtoupper($nomOp), $nomPro, $site, $superficie, $superficiecible, $localite), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i, strtoupper($nomOp), $nomPro, $site, $superficie, $superficiecible, $localite), $row_options = array('wrap_text' => true, 'halign' => 'center'));
        }
        $i++; endforeach;

    $tableau = Bd_GestionAmenagement::ListeAmenagerSansProjet();

    $cle = 10;
    $noSite = 8;
    $super = 9;
    $supercible = 12;
    $loc = 3;
    $op = 16;
    $ipr = 15;
    $typemes=24;
    $typeamenager=25;
    $tail=25;
    foreach ($tableau as $tab):

        $id = $tab[$cle];
        $cle = $cle + $tail;
        $idprojet = $tab[$ipr];
        $ipr = $ipr + $tail;
        $site = $tab[$noSite];
        $noSite = $noSite + $tail;
        $superficie = $tab[$super];
        $super = $super + $tail;
        $superficiecible = $tab[$supercible];
        $supercible = $supercible + $tail;
        $nomOp = $tab[$op];
        $op = $op + $tail;
        $localite = $tab[$loc];
        $loc = $loc + $tail;
        $typemesure=$tab[$typemes];
        $typemes=$typemes+$tail;
        $typeamenagersite=$tab[$typeamenager];
        $typeamenager=$typeamenager+$tail;
        $nomPro = 'Aucun projet';

        if($typemesure=='longueur'){
            if($superficie!=0){
                $superficie= $superficie." Km";
            }else{
                $superficie= 'inconnue';
            }

        }else{
            if($typemesure=='superficie') {
                if($superficie!=0){
                    $superficie= $superficie . " ha";
                }else{
                    $superficie= 'inconnue';
                }

            }else{
                $superficie= 'inconnue';
            }
        }

        if($typeamenagersite=='longueur'){
            if($superficiecible!=0){
                $superficiecible= $superficiecible." Km";
            }else{
                $superficiecible= 'inconnue';
            }

        }else{
            if($typeamenagersite=='superficie') {
                if($superficiecible!=0){
                    $superficiecible= $superficiecible . " ha";
                }else{
                    $superficiecible= 'inconnue';
                }

            }else{
                $superficiecible= 'inconnue';
            }
        }

        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i, strtoupper($nomOp), $nomPro, $site, $superficie, $superficiecible, $localite), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i, strtoupper($nomOp), $nomPro, $site, $superficie, $superficiecible, $localite), $row_options = array('wrap_text' => true, 'halign' => 'center'));
        }
        $i++; endforeach;

    $writer->writeToStdOut();
}
