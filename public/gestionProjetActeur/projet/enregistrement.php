<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 12/10/2018
 * Time: 23:23
 */

include_once('../../../Databases/FichierBD.php');

if(isset($_POST["type"])){
    $type=$_POST["type"];
    if($type=='ajout') {

            $nomb=strip_tags($_POST['nomPro']);
            $nomcontact=strip_tags($_POST['nomContPro']);
            $prenomcontact=strip_tags($_POST['prenomContPro']);
            $budGlob=$_POST['budgetGlobal'];
            $email=strip_tags($_POST['mail']);
            $numero=strip_tags($_POST['numContPro']);
            $description=strip_tags($_POST['nomDes']);
            $datde=$_POST['dateDeb'];
            $datfin=$_POST['dateFin'];
            $siteP=$_POST['siteInt'];
            $budgmv=$_POST['budgetGMV'];
            $commune=strip_tags($_POST['commune']);
            $nbreC=strip_tags($_POST['nbreC']);
            $bail=strip_tags($_POST['bailleur']);
            $motant=strip_tags($_POST['montant']);
            $anne=strip_tags($_POST['annee']);
            $nbreB=strip_tags($_POST['nbreB']);
            $techni=strip_tags($_POST['technique']);
            $finance=strip_tags($_POST['financiere']);
            $operateu=strip_tags($_POST['operateur']);
            $montOp=strip_tags($_POST['montantOp']);
            $nbrop=strip_tags($_POST['nbreOp']);
            $gestion=new Bd_GestionProjetActeur();

        try {
            $gestion->InsererProjet($nomb,$budGlob,$datde,$datfin,$nomcontact,$prenomcontact,$numero,$email,$siteP,$description,$budgmv);
            $idprojet=$gestion->RecupererIdProjet();

            $tableCommune=explode(',',$commune);
            for($i=0; $i<$nbreC; $i++){
                if($tableCommune[$i]!=''){
                    $gestion->InseresExecuterProjetCommune($tableCommune[$i],$idprojet);
                }
            }

            $tableBailleur=explode(',',$bail);
            $tableMontant=explode(',',$motant);
            $tableAnnee=explode(',',$anne);
            for($j=0; $j<$nbreB; $j++){
                if($tableBailleur[$j]!=''){
                    $gestion->InseresFinancerBailleurProjet($tableBailleur[$j],$idprojet,$tableMontant[$j],$tableAnnee[$j]);
                }
            }

            $tableOperateu=explode(',',$operateu);
            $tableMontOp=explode(',',$montOp);
            $tbleTechnique=explode(',',$techni);
            $tblefinance=explode(',',$finance);
            for($k=0; $k<$nbrop; $k++){
                if($tableOperateu[$k]!=''){
                    if($tbleTechnique[$k]==1){
                        $tbleTechnique[$k]='TRUE';
                    }else{
                        $tbleTechnique[$k]='FALSE';
                    }

                    if($tblefinance[$k]==1){
                        $tblefinance[$k]='TRUE';
                        $gestion->InsererExecuterProjetOperateur($tableOperateu[$k],$idprojet,$tbleTechnique[$k],$tblefinance[$k],$tableMontOp[$k]);
                    }else{
                        $tblefinance[$k]='FALSE';
                        $gestion->InsererExecuterProjetOperate($tableOperateu[$k],$idprojet,$tbleTechnique[$k],$tblefinance[$k]);
                    }
                }
            }

            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$msg'>";

        }
    }

}else{
    $nomb = strip_tags($_POST['nomPro']);
    $nomcontact = strip_tags($_POST['nomContPro']);
    $prenomcontact = strip_tags($_POST['prenomContPro']);
    $budGlob = strip_tags($_POST['budgetGlobal']);
    $email = strip_tags($_POST['mail']);
    $numero = strip_tags($_POST['numContPro']);
    $description = strip_tags($_POST['nomDes']);
    $datde =strip_tags($_POST['dateDeb']);
    $datfin = strip_tags($_POST['dateFin']);
    $siteP = strip_tags($_POST['siteInt']);
    $budgmv = strip_tags($_POST['budgetGMV']);
    $commune = strip_tags($_POST['commune']);
    $nbreC = strip_tags($_POST['nbreC']);
    $bail = strip_tags($_POST['bailleur']);
    $motant = strip_tags($_POST['montant']);
    $anne = strip_tags($_POST['annee']);
    $nbreB = strip_tags($_POST['nbreB']);
    $techni = strip_tags($_POST['technique']);
    $finance = strip_tags($_POST['financiere']);
    $operateu = strip_tags($_POST['operateur']);
    $montOp = strip_tags($_POST['montantOp']);
    $nbrop = strip_tags($_POST['nbreOp']);
    $idprojet = strip_tags($_POST['identif']);

    $gestion = new Bd_GestionProjetActeur();

    try {
        $gestion->ModifierProjet($nomb, $budGlob, $datde, $datfin, $nomcontact, $prenomcontact, $numero, $email, $siteP, $description, $budgmv, $idprojet);


        $tableCommune = explode(',', $commune);
        $gestion->SupprimerExecuterProjetCommune($idprojet);
        for ($i = 0; $i < $nbreC; $i++) {
            if ($tableCommune[$i] != '') {
                $gestion->InseresExecuterProjetCommune($tableCommune[$i], $idprojet);
            }
        }

        $tableBailleur = explode(',', $bail);
        $tableMontant = explode(',', $motant);
        $tableAnnee = explode(',', $anne);
        $gestion->SupprimerFinancerBailleurProjet($idprojet);
        for ($j = 0; $j < $nbreB; $j++) {
            if ($tableBailleur[$j] != '') {
                $gestion->InseresFinancerBailleurProjet($tableBailleur[$j], $idprojet, $tableMontant[$j], $tableAnnee[$j]);
            }
        }

        $tableOperateu = explode(',', $operateu);
        $tableMontOp = explode(',', $montOp);
        $tbleTechnique = explode(',', $techni);
        $tblefinance = explode(',', $finance);
        $gestion->SupprimerExecuterProjetOperateur($idprojet);
        for ($k = 0; $k < $nbrop; $k++) {
            if ($tableOperateu[$k] != '') {
                if ($tbleTechnique[$k] == 1) {
                    $tbleTechnique[$k] = 'TRUE';
                } else {
                    $tbleTechnique[$k] = 'FALSE';
                }

                if ($tblefinance[$k] == 1) {
                    $tblefinance[$k] = 'TRUE';
                    $gestion->InsererExecuterProjetOperateur($tableOperateu[$k], $idprojet, $tbleTechnique[$k], $tblefinance[$k], $tableMontOp[$k]);
                } else {
                    $tblefinance[$k] = 'FALSE';
                    $gestion->InsererExecuterProjetOperate($tableOperateu[$k], $idprojet, $tbleTechnique[$k], $tblefinance[$k]);
                }
            }
        }
        
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}