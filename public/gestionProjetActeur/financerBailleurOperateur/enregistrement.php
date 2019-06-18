<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 13/10/2018
 * Time: 07:05
 */

include_once('../../../Databases/FichierBD.php');

if(isset($_POST["type"])){
    $type=$_POST["type"];
    if($type=='ajout') {
        $nomBailleur=strip_tags($_POST['nomBailleur']);
        $nomOpt=strip_tags(($_POST['nomOpt']));
        $nomPro=strip_tags($_POST['nomPro']);
        $montant=strip_tags($_POST['montant']);
        $dateFinance=strip_tags($_POST['annee']);

        if($nomPro==''){
            $nomPro=-1;
        }
        $gestion=new Bd_GestionProjetActeur();


        try {
            $gestion->InsererFinancementOperateur($nomOpt,$nomBailleur,$montant,$dateFinance,$nomPro);
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$msg'>";

        }
    }

}else{
    $nomBailleur=strip_tags($_POST['Bailleur']);
    $nomOpt=strip_tags(($_POST['Operateur']));
    $nomPro=strip_tags($_POST['Projet']);
    $montant=strip_tags($_POST['mont']);
    $dateFinance=strip_tags($_POST['anne']);
    $idf=strip_tags($_POST['identif']);

    if($nomPro==''){
        $nomPro=-1;
    }
    $gestion=new Bd_GestionProjetActeur();



    try {
        $gestion->ModifierFinancementOperateur($nomOpt,$nomBailleur,$montant,$dateFinance,$nomPro,$idf);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}