<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 17/10/2018
 * Time: 18:57
 */


include_once('../../../Databases/FichierBD.php');

if(isset($_POST["type"])){
    $type=$_POST["type"];
    if($type=='ajout') {

        $nom=strip_tags($_POST['nom']);
        $description=strip_tags($_POST['description']);

        $newfacteur=new Bd_parametre();
        try {
            $newfacteur->InsererVegetalisation($nom,$description);
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$msg'>";

        }
    }

}else{

    $nom = strip_tags($_POST['nom']);
    $id = strip_tags($_POST['idele']);
    $description = strip_tags($_POST['description']);
    $newfacteur = new Bd_parametre();

    try {
        $newfacteur->ModifierVegetalisation($nom, $description,$id);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}