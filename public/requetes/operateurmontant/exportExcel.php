<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 27/07/2018
 * Time: 07:53
 */

include_once('../../../Databases/FichierBD.php');

if(isset($_GET['where'])) {
    $where = $_GET['where'];
    $requete = '';

    if($where!=''){
        $requete = "SELECT nombailleur, nomoperateur, nomregion, nomprovince, nomcommune, nomlocalite, anneefinancement, montantfinancement
                    FROM requete7 WHERE $where";
    }else{
        $requete = "SELECT nombailleur, nomoperateur, nomregion, nomprovince, nomcommune, nomlocalite, anneefinancement, montantfinancement
                    FROM requete7";
    }
    set_include_path( get_include_path().PATH_SEPARATOR."..");
    $date = new DateTime('UTC');
    $dat=$date->format('d-m-Y-H-i-s');
    $filename='Opérateur-montant-'.$dat.'.xlsx';
    header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');


    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center', 'widths' => [10, 25, 25, 25, 15, 15, 15,15,10]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true);
    $writer->writeSheetHeader('feuil1', array('Numéro'=>'integer','Bailleur'=>'string','Opérateur'=>'string', 'Région'=>'string', 'Province'=>'string', 'Commune'=>'string', 'Localité'=>'string','Montant'=>'integer','Année'=>'integer'), $format);
    $i = 1;
    $resultat = Bd_Requetes::ListeRequete1($requete);
    $ba=1; $pro=4; $reg=3; $lo=6; $com=5; $op=2; $mon=8; $an=7;
    foreach ($resultat as $tab):
        $nomBail=$tab[$ba];
        $ba=$ba+8;
        $nomOpt=$tab[$op];
        $op=$op+8;
        $montant=$tab[$mon];
        $mon=$mon+8;
        $nomregion=$tab[$reg];
        $reg=$reg+8;
        $nomprovince=$tab[$pro];
        $pro=$pro+8;
        $nomcommune=$tab[$com];
        $com=$com+8;
        $nomlocalite=$tab[$lo];
        $lo=$lo+8;
        $annee=$tab[$an];
        $an=$an+8;

        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i,$nomBail,$nomOpt, $nomregion, $nomprovince, $nomcommune, $nomlocalite,$montant,$annee), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i,$nomBail,$nomOpt, $nomregion, $nomprovince, $nomcommune, $nomlocalite,$montant,$annee), $row_options = array('wrap_text' => true));
        }

        $i++; endforeach;

    $writer->writeToStdOut();

}?>