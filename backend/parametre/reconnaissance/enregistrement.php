<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 17/10/2018
 * Time: 18:17
 */


include_once('../../../Databases/FichierBD.php');

if(isset($_POST["type"])){
    $type=$_POST["type"];
    if($type=='ajout') {

        $nom=strip_tags($_POST['nom']);
        $newfacteur=new Bd_parametre();

        try {
            $newfacteur->InsererReconnait($nom);
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$msg'>";

        }
    }

}else{

    $id=strip_tags($_POST['idregi']);
    $nom=strip_tags($_POST['nom']);

    $parametre= new Bd_parametre();

    try {
        $parametre->ModifierReconnait($nom,$id);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}