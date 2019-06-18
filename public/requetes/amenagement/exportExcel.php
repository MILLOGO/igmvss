<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 26/07/2018
 * Time: 10:16
 */


include_once('../../../Databases/FichierBD.php');
if(isset($_GET['where'])) {
    $where = $_GET['where'];
    $requete = '';

    if($where!='') {
        $requete = "SELECT nomregion, nomprovince, nomcommune, nomlocalite, nomamenagement, nomcategorieamenagement, SUM(superficieciblee)
                    AS superficietotal, extract(year from periodedebut) as annee, typemesuresite FROM requete1 WHERE $where GROUP BY nomregion, nomprovince,
                    nomcommune, nomlocalite, nomamenagement, nomcategorieamenagement, annee,typemesuresite";
    }else{
        $requete = "SELECT nomregion, nomprovince, nomcommune, nomlocalite, nomamenagement, nomcategorieamenagement, SUM(superficieciblee)
                    AS superficietotal, extract(year from periodedebut) as annee,typemesuresite FROM requete1 GROUP BY nomregion, nomprovince,
                    nomcommune, nomlocalite, nomamenagement, nomcategorieamenagement, annee,typemesuresite";
    }

    set_include_path( get_include_path().PATH_SEPARATOR."..");
    $date = new DateTime('UTC');
    $dat=$date->format('d-m-Y-H-i-s');
    $filename='Requetes-améngement-'.$dat.'.xlsx';
    header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    $resultat = Bd_Requetes::ListeRequete1($requete);
    $reg=1; $pro=2; $com=3; $lo=4; $amen=5; $cat=6; $sup=7; $ann=8;$typ=9; $taille=9;
    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center', 'widths' => [10, 25, 20, 20, 20, 30, 25,15,10]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true);
    $writer->writeSheetHeader('feuil1', array('Numéro'=>'integer', 'Région'=>'string', 'Province'=>'string', 'Commune'=>'string', 'Localité'=>'string',
        'Catégorie d\'aménagement'=>'string','Aménagement'=>'string', 'Mesure'=>'string', 'Année'=>'integer'), $format);

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
        $annee=$tab[$ann];
        $ann=$ann+$taille;
        $type=$tab[$typ];
        $typ=$typ+$taille;
        if($type=='longueur'){
            if($superficie!=0){
                $superficie= $superficie." Km";
            }else{
                $superficie= " inconnue";
            }

        }else{
            if($typ=='superficie') {
                if ($superficie != 0) {
                    $superficie = $superficie . " ha";
                } else {
                    $superficie = " inconnue";
                }
            }else{
                $superficie= " inconnue";
            }
        }
        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i, $nomReg, $nomPro, $nomCom, $nomLoca, $nomCat, $nomAmen,$superficie, $annee), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i, $nomReg, $nomPro, $nomCom, $nomLoca, $nomCat, $nomAmen,$superficie, $annee), $row_options = array('wrap_text' => true));
        }

        $i++; endforeach;

    $writer->writeToStdOut();

}?>

