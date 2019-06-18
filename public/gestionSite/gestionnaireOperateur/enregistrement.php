<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 16/10/2018
 * Time: 20:00
 */


include_once('../../../Databases/FichierBD.php');

if(isset($_POST["aide"])){
    $type=$_POST["aide"];
    if($type=='ajout') {
        $idgest= trim(strip_tags($_POST['idges']));
        $idop= trim(strip_tags($_POST['idopt']));
        $datedeb= trim(strip_tags($_POST['datedeb']));
        $datfin= trim(strip_tags($_POST['datefin']));
        $idappui= trim(strip_tags($_POST['idappui']));
        $nbreBenef= trim(strip_tags($_POST['nbreBeneficiaire']));
        $descripAppui=trim(strip_tags($_POST['descript']));
        $exploit=trim(strip_tags($_POST['exploit']));
        $nomPro=trim(strip_tags($_POST['nomPro']));
        if($nbreBenef==''){
            $nbreBenef=0;
        }
        $gestionnaire= new Bd_GestionSite();

        try {
            if($nomPro!='') {
                $gestionnaire->InsererGestionnaireOperateurAppuiAvecProjet($idop, $idappui, $idgest, $datedeb, $datfin, $nbreBenef, $descripAppui, $exploit,$nomPro);
            }else{
                $gestionnaire->InsererGestionnaireOperateurAppui($idop, $idappui, $idgest, $datedeb, $datfin, $nbreBenef, $descripAppui, $exploit);
            }
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$msg'>";

        }
    }

}else{
    $idgest = strip_tags($_POST['idges']);
    $idop = strip_tags($_POST['idopt']);
    $datedeb = strip_tags($_POST['datedeb']);
    $datfin = strip_tags($_POST['datefin']);
    $idappui = strip_tags($_POST['idappui']);
    $nbreBenef = strip_tags($_POST['nbreBeneficiaire']);
    $descripAppui = strip_tags($_POST['descript']);
    $exploit = strip_tags($_POST['exploit']);
    $nomPro = strip_tags($_POST['nomPro']);
    $idappuigest = strip_tags($_POST['idt']);
    if ($nbreBenef == '') {
        $nbreBenef = 0;
    }
    $gestionnaire = new Bd_GestionSite();

    try {
        if ($nomPro != '') {

            $gestionnaire->ModifierGestionnaireOperateurAppuiAvecProjet($idop, $idappui, $idgest, $datedeb, $datfin, $nbreBenef, $descripAppui, $exploit, $nomPro,$idappuigest);
        } else {
            $gestionnaire->ModifierGestionnaireOperateurAppuiSansProjet($idop, $idappui, $idgest, $datedeb, $datfin, $nbreBenef, $descripAppui, $exploit,$idappuigest);
        }
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}