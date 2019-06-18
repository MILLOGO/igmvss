<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 12/08/2018
 * Time: 20:20
 */

include_once('../../../Databases/FichierBD.php');
set_include_path( get_include_path().PATH_SEPARATOR."..");
$date = new DateTime('UTC');
$dat=$date->format('d-m-Y-H-i-s');
$filename='Bailleur-opérateur-Projet-'.$dat.'.xlsx';
header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');

if(isset($_GET['where'])) {
    $where = $_GET['where'];
    $requete = '';

    if($where!='') {
        $requete = "SELECT nomregion, nomprovince, nomcommune, nomlocalite, nomamenagement, nomcategorieamenagement, idprojet, nomoperateur, anneefinancement, nombailleur,
                   nomsite,superficieciblee FROM requete4 WHERE $where";
    }else{
        $requete = "SELECT nomregion, nomprovince, nomcommune, nomlocalite, nomamenagement, nomcategorieamenagement, idprojet, nomoperateur, anneefinancement, nombailleur
                    ,nomsite,superficieciblee FROM requete4";
    }
    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center','wrap_text' => true, 'widths' => [11, 25, 15, 15,15,15, 15, 30, 20,30,25,10,20]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true,'halign' => 'center');
    $writer->writeSheetHeader('feuil1', array('Numéro'=>'integer', 'Région'=>'string', 'Province'=>'string', 'Commune'=>'string', 'Localité'=>'string','site'=>'string','Superficie ciblée'=>'integer', 'Catégorie d\'aménagement'=>'string', 'Aménagement'=> 'string', 'Projet'=>'string', 'Opérateur'=>'string','Année'=>'integer','Bailleur'=>'string'), $format);
    $i = 1;
    $resultat = Bd_Requetes::ListeRequete1($requete);
    $reg=1; $pro=2; $com=3; $lo=4; $amen=5; $cat=6; $proj=7; $opt=8; $an=9; $bai=10; $sit=11; $super=12;
    $taille=12;
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
        $idprojet=$tab[$proj];
        if($idprojet!=-1){
            $req=new Bd_Requetes();
            $nomprojet=$req->RecupererNomProjet($idprojet);
        }else{
            $nomprojet='Aucun projet';
        }
        $proj=$proj+$taille;
        $nomOpt=$tab[$opt];
        $opt=$opt+$taille;
        $annee=$tab[$an];
        $an=$an+$taille;
        $bailleur=$tab[$bai];
        $bai=$bai+$taille;
        $site=$tab[$sit];
        $sit=$sit+$taille;
        $superficie=$tab[$super];
        $super=$super+$taille;

        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i, $nomReg, $nomPro, $nomCom, $nomLoca,$site,$superficie, $nomCat, $nomAmen, $nomprojet, strtoupper($nomOpt),$annee, strtoupper($bailleur)), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i, $nomReg, $nomPro, $nomCom, $nomLoca,$site,$superficie, $nomCat, $nomAmen, $nomprojet,strtoupper($nomOpt),$annee, strtoupper($bailleur)), $row_options = array('wrap_text' => true,'halign' => 'center'));
        }

        $i++; endforeach;

    $writer->writeToStdOut();

}?>
