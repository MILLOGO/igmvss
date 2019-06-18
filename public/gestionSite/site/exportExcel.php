<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 07/08/2018
 * Time: 17:04
 */
    include_once('../../../DataBases/FichierBD.php');
if(!$_SESSION){
    header('location:../../');
}else {

    set_include_path(get_include_path() . PATH_SEPARATOR . "..");
    $date = new DateTime('UTC');
    $dat = $date->format('d-m-Y-H-i-s');
    $filename = 'Liste des sites-' . $dat . '.xlsx';
    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    $tableau = Bd_GestionSite::ListeSite();

    $cle = 1;
    $noStie = 2;
    $super = 3;
    $noGe = 5;
    $preno = 6;
    $sta1 = 11;
    $sta2 = 12;
    $voc = 14;
    $loca = 17;
    $typesi=24;

    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center', 'wrap_text' => true, 'widths' => [11, 25, 20, 35, 30, 20, 15]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true);
    $writer->writeSheetHeader('feuil1', array('Numéro' => 'integer', 'Nom du Site' => 'string', 'Mesure du site' => 'string', 'Nom Prénoms du gestionnaire ' => 'string', 'Status foncier' => 'string', 'Vocation' => 'string', 'Localité' => 'string'), $format);
    $i = 1;
    $taille=24;
    foreach ($tableau as $tab):
        $id = $tab[$cle];
        $cle = $cle + $taille;
        $site = $tab[$noStie];
        $noStie = $noStie + $taille;
        $superficie = $tab[$super];
        $super = $super + $taille;
        $nomGe = $tab[$noGe];
        $noGe = $noGe + $taille;
        $prenomGe = $tab[$preno];
        $preno = $preno + $taille;
        $reconait = $tab[$sta1];
        $sta1 = $sta1 + $taille;
        $exploit = $tab[$sta2];
        $sta2 = $sta2 + $taille;
        $vocation = $tab[$voc];
        $voc = $voc + $taille;
        $localite = $tab[$loca];
        $loca = $loca + $taille;
        $typemesure=$tab[$typesi];
        $typesi=$typesi+$taille;

        if($typemesure=='longueur'){
            if($superficie!=0){
                $superficie= $superficie." km";
            }else{
                $superficie= " inconnue";
            }

        }else{
            if($typemesure=='superficie'){
                if($superficie!=0){
                    $superficie= $superficie." ha";
                }else{
                    $superficie= " inconnue";
                }
            }else{
                $superficie= " inconnue";
            }

        }
        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i, $site, $superficie, $nomGe . ' ' . $prenomGe, $reconait . " " . $exploit, $vocation, $localite), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i, $site, $superficie, $nomGe . ' ' . $prenomGe, $reconait . " " . $exploit, $vocation, $localite), $row_options = array('wrap_text' => true));
        }

        $i++; endforeach;

    $writer->writeToStdOut();
}

