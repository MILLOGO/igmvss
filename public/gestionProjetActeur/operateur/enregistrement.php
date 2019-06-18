<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 12/10/2018
 * Time: 21:12
 */


include_once('../../../Databases/FichierBD.php');

if(isset($_POST["type"])){
    $type=$_POST["type"];
    if($type=='ajout') {
        $nom=strip_tags($_POST['nomOpt']);
        $nomcop=strip_tags($_POST['nomCOpt']);
        $prenomcop=strip_tags($_POST['prenomOpt']);
        $numcop=strip_tags($_POST['numOpt']);
        $emailcop=strip_tags($_POST['mail']);
        $fonctcop=strip_tags($_POST['fctOpt']);
        $siteinterop=strip_tags($_POST['siteInt']);

        $operateur=new Bd_GestionProjetActeur();

        try {
            $operateur->InsererOperateur($nom,$nomcop,$prenomcop,$numcop,$emailcop,$fonctcop,$siteinterop);
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$msg'>";

        }
    }

}else{
    $nom = strip_tags($_POST['nomOpt']);
    $nomcop = strip_tags($_POST['nomCOpt']);
    $prenomcop = strip_tags($_POST['prenomOpt']);
    $numcop = strip_tags($_POST['numOpt']);
    $emailcop = strip_tags($_POST['mail']);
    $fonctcop = strip_tags($_POST['fctOpt']);
    $siteinterop = strip_tags($_POST['siteInt']);
    $idop=strip_tags($_POST['idoperat']);
    $operateur = new Bd_GestionProjetActeur();


    try {
        $operateur->ModifierOperateur($nom, $nomcop, $prenomcop, $numcop, $emailcop, $fonctcop, $siteinterop,$idop);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}