<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 13/10/2018
 * Time: 10:12
 */


include_once('../../../Databases/FichierBD.php');

if(isset($_POST["type"])){
    $type=$_POST["type"];
    if($type=='ajout') {
        $collecteu = strip_tags($_POST['collecteur']);
        $siteCollect=strip_tags($_POST['site']);
        $datecollect=strip_tags($_POST['datecollect']);
        $numeroFiche=strip_tags($_POST['numFiche']);

        $gestionSite= new Bd_GestionSite();

        try {
            $gestionSite->InsererCollection($collecteu,$siteCollect,$datecollect,$numeroFiche);
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$msg'>";

        }
    }

}else{
    $collecteu = strip_tags($_POST['collecteur']);
    $siteCollect=strip_tags($_POST['site']);
    $datecollect=strip_tags($_POST['datecollect']);
    $numeroFiche=strip_tags($_POST['numFiche']);
    $identi=strip_tags($_POST['idcollectionsite']);

    $gestionSite= new Bd_GestionSite();



    try {
        $gestionSite->ModifierCollection($collecteu,$siteCollect,$datecollect,$numeroFiche,$identi);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}