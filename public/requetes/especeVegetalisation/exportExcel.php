<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 12/08/2018
 * Time: 23:15
 */

include_once('../../../Databases/FichierBD.php');
if(isset($_GET['where'])) {
    $where = $_GET['where'];
    $requete = '';

    if($where!='') {
        $requete = "SELECT nomregion, nomprovince, nomcommune, nomlocalite, nomsite,superficieciblee,periodedebut,periodefin, tauxreprise,
                    tauxsurvie,quantitesemis,nbreplant,nomespece,typevegetalisation, typemesuresite FROM requete13 WHERE $where";
    }else{
        $requete = "SELECT nomregion, nomprovince, nomcommune, nomlocalite, nomsite,superficieciblee,periodedebut,periodefin, tauxreprise,
                    tauxsurvie,quantitesemis,nbreplant,nomespece,typevegetalisation, typemesuresite FROM requete13";
    }

    set_include_path( get_include_path().PATH_SEPARATOR."..");
    $date = new DateTime('UTC');
    $dat=$date->format('d-m-Y-H-i-s');
    $filename='Espèce-végétalisation-'.$dat.'.xlsx';
    header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    $resultat = Bd_Requetes::ListeRequete1($requete);
    $reg=1; $pro=2; $com=3; $lo=4; $sit=5; $sup=6; $pdeb=7; $pfin=8; $rep=9; $surv=10; $qtesem=11; $nbreplan=12; $esp=13; $veg=14; $typemes=15;

    $taille=15;
    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center','wrap_text' => true,
        'widths' => [11, 25, 15, 15, 15, 20, 10,10,10,10,20,25,15]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true,'halign' => 'center');
    $writer->writeSheetHeader('feuil1', array('Numéro' => 'integer', 'Région' => 'string', 'Province' => 'string', 'Commune' => 'string', 'Localité' => 'string',
        'Espèce' => 'string', 'nbre plant' => 'integer','Qté semis' => 'integer','Taux survie' => 'integer', 'Taux reprise' => 'integer',
        'Végétalisation' => 'string','Site' => 'string','Superficie' =>'string'), $format);
    $i = 1;
    foreach ($resultat as $tab):
        $nomReg=$tab[$reg];
        $reg=$reg+$taille;
        $nomPro=$tab[$pro];
        $pro=$pro+$taille;
        $nomCom=$tab[$com];
        $com=$com+$taille;
        $nomLoca=$tab[$lo];
        $lo=$lo+$taille;
        $site=$tab[$sit];
        $sit=$sit+$taille;
        $debut=$tab[$pdeb];
        $pdeb=$pdeb+$taille;
        $superficie=$tab[$sup];
        $sup=$sup+$taille;
        $fin=$tab[$pfin];
        $pfin=$pfin+$taille;
        $repris=$tab[$rep];
        $rep=$rep+$taille;
        $survie=$tab[$surv];
        $surv=$surv+$taille;
        $quantite=$tab[$qtesem];
        $qtesem+=$taille;
        $nbreplant=$tab[$nbreplan];
        $nbreplan+=$taille;
        $espece=$tab[$esp];
        $esp+=$taille;
        $vegetalisation=$tab[$veg];
        $veg+=$taille;
        $typemesuresite=$tab[$typemes];
        if($typemesuresite=='longueur'){
            $superficie=$superficie.' km';
        }else{
            $superficie=$superficie.' ha';
        }
        $typemes=$typemes+$taille;
        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i, $nomReg, $nomPro, $nomCom, $nomLoca, $espece, $nbreplant,$quantite,
                $survie,$repris,$vegetalisation,$site,$superficie), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i, $nomReg, $nomPro, $nomCom, $nomLoca, $espece, $nbreplant,$quantite,
                $survie,$repris,$vegetalisation,$site,$superficie), $row_options = array('wrap_text' => true,'halign' => 'center'));
        }

        $i++; endforeach;

    $writer->writeToStdOut();

}?>
