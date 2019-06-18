<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 26/07/2018
 * Time: 10:59
 */


include_once('../../../Databases/FichierBD.php');
set_include_path( get_include_path().PATH_SEPARATOR."..");
$date = new DateTime('UTC');
$dat=$date->format('d-m-Y-H-i-s');
$filename='Projet-opérateur-'.$dat.'.xlsx';
header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');

if(isset($_GET['where'])) {
    $where = $_GET['where'];
    $requete = '';

    if ($where != '') {
        $requete = "SELECT nomregion, nomprovince, nomcommune, nomlocalite, nomamenagement, nomcategorieamenagement, idprojet, nomoperateur,extract(year from periodedebut) AS annee
                    FROM requete2 WHERE $where";
    } else {
        $requete = "SELECT nomregion, nomprovince, nomcommune, nomlocalite, nomamenagement, nomcategorieamenagement, idprojet, nomoperateur,extract(year from periodedebut) AS annee
                    FROM requete2";
    }

    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center', 'widths' => [10, 25, 15, 15, 15, 30, 30,30,25,10]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true);
    $writer->writeSheetHeader('feuil1', array('Numéro'=>'integer', 'Région'=>'string', 'Province'=>'string', 'Commune'=>'string', 'Localité'=>'string', 'Catégorie d\'aménagement'=>'string', 'Aménagement'=> 'string', 'Projet'=>'string', 'Opérateur'=>'string','Année'=>'integer'), $format);
    $i = 1;
    $resultat = Bd_Requetes::ListeRequete1($requete);
    $reg=1; $pro=2; $com=3; $lo=4; $amen=5; $cat=6; $proj=7; $opt=8; $an=9;
    foreach ($resultat as $tab):
        $nomReg=$tab[$reg];
        $reg=$reg+9;
        $nomPro=$tab[$pro];
        $pro=$pro+9;
        $nomCom=$tab[$com];
        $com=$com+9;
        $nomLoca=$tab[$lo];
        $lo=$lo+9;
        $nomAmen=$tab[$amen];
        $amen=$amen+9;
        $nomCat=$tab[$cat];
        $cat=$cat+9;
        $idprojet=$tab[$proj];
        if($idprojet!=-1){
            $req=new Bd_Requetes();
            $nomprojet=$req->RecupererNomProjet($idprojet);
        }else{
            $nomprojet='Aucun projet';
        }
        $proj=$proj+9;
        $nomOpt=$tab[$opt];
        $opt=$opt+9;
        $annee=$tab[$an];
        $an=$an+9;

        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i, $nomReg, $nomPro, $nomCom, $nomLoca, $nomCat, $nomAmen, $nomprojet, strtoupper($nomOpt),$annee), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i, $nomReg, $nomPro, $nomCom, $nomLoca, $nomCat, $nomAmen, $nomprojet,strtoupper($nomOpt),$annee), $row_options = array('wrap_text' => true));
        }

        $i++; endforeach;

    $writer->writeToStdOut();

}?>

