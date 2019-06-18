<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 17/10/2018
 * Time: 11:26
 */


include_once('../../../Databases/FichierBD.php');

if(isset($_POST["type"])){
    $type=$_POST["type"];
    if($type=='ajout') {

        $idcat=strip_tags($_POST['idCategorie']);
        $nomAm=strip_tags($_POST['nomAmena']);
        $nomSou=strip_tags($_POST['nomSousCat']);
        $info=strip_tags($_POST['infosSpe']);

        if($info!=1){
            $info=0;
        }
        $paramet=new Bd_parametre();


        try {
            $paramet->InsererAmenagement($idcat,$nomAm,$nomSou,$info);
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$msg'>";

        }
    }

}else{

    $idcat = strip_tags($_POST['idCategorie']);
    $nomAm =strip_tags($_POST['nomAmena']);
    $nomSou = strip_tags($_POST['nomSousCat']);
    $info = strip_tags($_POST['infosSpe']);
    $iden = strip_tags($_POST['idele']);
    if ($info != 1) {
        $info = 0;
    }
    $paramet = new Bd_parametre();

    try {
        $paramet->ModifierAmenagement($idcat, $nomAm, $nomSou, $info, $iden);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}