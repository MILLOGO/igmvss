<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 10/08/2018
 * Time: 23:29
 */

include_once('../../../Databases/FichierBD.php');

if(isset($_GET['where'])) {
    $where = $_GET['where'];
    $requete = '';

    if($where!='') {
        $requete = "SELECT nomregion, nomprovince, nomcommune, nomlocalite, nomgestionnaire, prenomgestionnaire, nomprojet, nomoperateur, typegestionnaire,typeappui,datedebutappui,datefinappui,nomsite
                    FROM requete9 WHERE $where";
    }else{
        $requete = "SELECT nomregion, nomprovince, nomcommune, nomlocalite, nomgestionnaire, prenomgestionnaire, nomprojet, nomoperateur, typegestionnaire,typeappui,datedebutappui,datefinappui,nomsite
                    FROM requete9";
    }

    set_include_path( get_include_path().PATH_SEPARATOR."..");
    $date = new DateTime('UTC');
    $dat=$date->format('d-m-Y-H-i-s');
    $filename='Appuis requetes-'.$dat.'.xlsx';
    header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');


    $writer = new XLSXWriter();
    $format = array('font' => 'Arial', 'font-size' => 12, 'font-style' => 'bold,italic', 'color' => '#fff', 'fill' => '#060', 'border' => 'top,bottom', 'halign' => 'center', 'widths' => [10, 15, 15, 15, 15, 25, 25, 10, 30,25, 25,20,20]);
    $format1 = array('color' => '#000', 'fill' => '#E8F3DE', 'wrap_text' => true,'halign' => 'center');
    $writer->writeSheetHeader('feuil1', array('Numéro'=>'integer', 'Région'=>'string', 'Province'=>'string', 'Commune'=>'string', 'Localité'=>'string',
        'Site'=>'string', 'Nom et prénom(s)'=>'string','Type'=>'string', 'Projet'=>'string', 'Opérateur'=>'string', 'Type d\'appui'=>'string', 'Date de début'=>'date', 'Date de fin'=>'date'), $format);
    $i = 1;
    $resultat = Bd_Requetes::ListeRequete1($requete);
    $reg=1; $pro=2; $com=3; $lo=4; $nogest=5; $pregest=6; $proj=7; $opt=8; $typgest=9; $typappui=10; $deb=11; $fi=12; $nomsit=13;
    $taille=13;
    foreach ($resultat as $tab):
        $nomReg=$tab[$reg];
        $reg=$reg+$taille;
        $nomPro=$tab[$pro];
        $pro=$pro+$taille;
        $nomCom=$tab[$com];
        $com=$com+$taille;
        $nomLoca=$tab[$lo];
        $lo=$lo+$taille;
        $nomAmen=$tab[$nogest];
        $nogest=$nogest+$taille;
        $nomCat=$tab[$pregest];
        $pregest=$pregest+$taille;
        $nomprojet=$tab[$proj];
        $proj=$proj+$taille;
        $nomOpt=$tab[$opt];
        $opt=$opt+$taille;
        $typegest=$tab[$typgest];
        $typgest=$typgest+$taille;
        $typeappui=$tab[$typappui];
        $typappui=$typappui+$taille;
        $debut=$tab[$deb];
        $deb=$deb+$taille;
        $fin=$tab[$fi];
        $fi=$fi+$taille;
        $nomdusite=$tab[$nomsit];
        $nomsit=$nomsit+$taille;
        if ($i % 2 == 1) {
            $writer->writeSheetRow('feuil1', array($i,$nomReg, $nomPro, $nomCom, $nomLoca, $nomdusite, strtoupper($nomAmen).' '.$nomCat, $typegest, $nomprojet, strtoupper($nomOpt), $typeappui, $debut, $fin), $format1);
        } else {
            $writer->writeSheetRow('feuil1', array($i,$nomReg, $nomPro, $nomCom, $nomLoca, $nomdusite, strtoupper($nomAmen).' '.$nomCat, $typegest, $nomprojet, strtoupper($nomOpt), $typeappui, $debut, $fin), $row_options = array('wrap_text' => true,'halign' => 'center'));
        }

        $i++; endforeach;

    $writer->writeToStdOut();

}?>