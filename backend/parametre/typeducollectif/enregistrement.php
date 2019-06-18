<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 14/10/2018
 * Time: 14:28
 */


include_once('../../../Databases/FichierBD.php');

if(isset($_POST["type"])){
    $type=$_POST["type"];
    if($type=='ajout') {
        $nom=strip_tags($_POST['categorie']);
        $newCatAm=new Bd_parametre();

        try {
            $newCatAm->InsererTypeCollectif($nom);
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $bailleur = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$bailleur'>";

        }
    }

}else{
    $nom = strip_tags($_POST['categorie']);
    $id = strip_tags($_POST['idele']);
    $newCatAm = new Bd_parametre();


    try {
        $newCatAm->ModifierTypeCollectif($nom,$id);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $bailleur = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$bailleur'>";

    }

}