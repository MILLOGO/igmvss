<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 13/10/2018
 * Time: 08:27
 */


include_once('../../../Databases/FichierBD.php');

if(isset($_POST["type"])){
    $type=$_POST["type"];
    if($type=='ajout') {
        $nomColect=strip_tags($_POST['nomCollect']);
        $prenomcolect=strip_tags(($_POST['prenomCollect']));
        $fonction=strip_tags($_POST['fctCollect']);
        $num=strip_tags($_POST['telCollect']);
        $email=strip_tags($_POST['mail']);

        $collecteur=new Bd_GestionSite();

        try {
            $collecteur->InsererCollecteur($nomColect,$prenomcolect,$fonction,$num,$email);
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$msg'>";

        }
    }

}else{
    $nomColect=strip_tags($_POST['nomColl']);
    $prenomcolect=strip_tags(($_POST['prenomColl']));
    $fonction=strip_tags($_POST['fctColl']);
    $num=strip_tags($_POST['telColl']);
    $email=strip_tags($_POST['email']);
    $id=strip_tags($_POST['idcollect']);

    $collecteur=new Bd_GestionSite();

    try {
        $collecteur->ModifierCollecteur($nomColect,$prenomcolect,$fonction,$num,$email,$id);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}