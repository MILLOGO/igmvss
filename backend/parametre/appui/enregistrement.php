<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 17/10/2018
 * Time: 13:42
 */


include_once('../../../Databases/FichierBD.php');

if(isset($_POST["type"])){
    $type=$_POST["type"];
    if($type=='ajout') {

        $nom=strip_tags($_POST['nom']);
        $newfacteur=new Bd_parametre();


        try {
            $newfacteur->InsererTypeappui($nom);
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$msg'>";

        }
    }

}else{

    $nom = strip_tags($_POST['nomAp']);
    $id = $_POST['idele'];
    $newfacteur = new Bd_parametre();

    try {
        $newfacteur->ModifierTypeappui($nom,$id);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}