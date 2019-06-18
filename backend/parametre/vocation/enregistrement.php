<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 17/10/2018
 * Time: 19:28
 */

include_once('../../../Databases/FichierBD.php');

if(isset($_POST["type"])){
    $type=$_POST["type"];
    if($type=='ajout') {

        $idcat=strip_tags($_POST['idCategorie']);
        $nomAm=strip_tags($_POST['nomVoca']);

        $paramet=new Bd_parametre();

        try {
            $paramet->InsererVocation($idcat,$nomAm);
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$msg'>";

        }
    }

}else{

    $idcat =strip_tags($_POST['idCategorie']);
    $nomAm =strip_tags($_POST['nomVoca']);
    $id =strip_tags($_POST['idele']);

    $paramet = new Bd_parametre();

    try {
        $paramet->ModifierVocation($idcat, $nomAm,$id);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}