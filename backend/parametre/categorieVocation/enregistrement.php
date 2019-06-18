<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 17/10/2018
 * Time: 14:29
 */

include_once('../../../Databases/FichierBD.php');

if(isset($_POST["type"])){
    $type=$_POST["type"];
    if($type=='ajout') {

        $nom=strip_tags($_POST['categorie']);
        $newCatAm=new Bd_parametre();

        try {
            $newCatAm->InsererCatVo($nom);
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$msg'>";

        }
    }

}else{

    $nom = strip_tags($_POST['categorie']);
    $id = $_POST['idele'];
    $newCatAm = new Bd_parametre();


    try {
        $newCatAm->ModifierCatVo($nom,$id);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}