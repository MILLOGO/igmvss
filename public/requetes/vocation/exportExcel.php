<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 10/08/2018
 * Time: 20:14
 */

include_once('../../../Databases/FichierBD.php');
if(isset($_GET['where'])) {
    $where = $_GET['where'];
    $requete = '';

    if($where!='') {
        $requete = "SELECT nomregion, nomprovince, nomcommune, nomlocalite, nomvocation, nomcategorievocation, SUM(superficiesite)AS superficietotal,typemesuresite
                    FROM requete12 WHERE $where GROUP BY nomregion, nomprovince,nomcommune, nomlocalite, nomvocation, nomcategorievocation,typemesuresite";
    }else{
        $requete = "SELECT nomregion, nomprovince, nomcommune, nomlocalite, nomvocation, nomcategorievocation, SUM(superficiesite) AS superficietotal,typemesuresite
                    FROM requete12 GROUP BY nomregion, nomprovince,nomcommune, nomlocalite, nomvocation, nomcategorievocation,typemesuresite";
    }

    set_include_path( get_include_path().PATH_SEPARATOR."..");
    $date = new DateTime('UTC');
    $dat=$date->format('d-m-Y-H-i-s');
    $filename='Vocation-par-unité-géographique-'.$dat.'.xlsx';
    header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    $resultat = Bd_Requetes::ListeRequete1($requete);
    $reg=1; $pro=2; $com=3; $lo=4; $amen=5; $cat=6; $sup=7; $typemesure=8; $taille=8;
    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center', 'widths' => [10, 25, 15, 15, 15, 30, 30,25]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true);
    $writer->writeSheetHeader('feuil1', array('Numéro' => 'integer', 'Région' => 'string', 'Province' => 'string', 'Commune' => 'string', 'Localité' => 'string', 'Catégorie d\'aménagement' => 'string', 'Aménagement' => 'string','Superficie totale' =>'string'), $format);
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
        $nomAmen=$tab[$amen];
        $amen=$amen+$taille;
        $nomCat=$tab[$cat];
        $cat=$cat+$taille;
        $superficie=$tab[$sup];
        $sup=$sup+$taille;
        $typemesuresite=$tab[$typemesure];
        $typemesure=$typemesure+$taille;

        if($typemesuresite=='inconnu' || $typemesuresite=='superficie'){
            if($superficie==0){
                $superficie='inconnu';
            }else{
                $superficie=$superficie.' ha';
            }
        }else{
            if($superficie==0){
                $superficie='inconnu';
            }else{
                $superficie=$superficie.' km';
            }
        }
        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i, $nomReg, $nomPro, $nomCom, $nomLoca, $nomCat, $nomAmen,$superficie), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i, $nomReg, $nomPro, $nomCom, $nomLoca, $nomCat, $nomAmen,$superficie), $row_options = array('wrap_text' => true));
        }

        $i++; endforeach;

    $writer->writeToStdOut();

}?>
