<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 13/10/2018
 * Time: 21:40
 */


include_once('../../../Databases/FichierBD.php');

if(isset($_POST["type"])){
    $type=$_POST["type"];
    if($type=='ajout') {
        $idgest=strip_tags($_POST['idgest']);
        $anne=strip_tags($_POST['anne']);
        $montant=strip_tags($_POST['montantR']);
        $gestion=new Bd_GestionSite();

        try {
            $gestion->InsererRevenuAnnuel($idgest,$montant,$anne);
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$msg'>";

        }
    }

}else{
    $idgest=strip_tags($_POST['idgest']);
    $anne=strip_tags($_POST['anne']);
    $montant=strip_tags($_POST['montantR']);
    $id=strip_tags($_POST['id']);
    $gestion=new Bd_GestionSite();

    try {
        $gestion->ModifierRevenuAnnuel($idgest,$montant,$anne,$id);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}