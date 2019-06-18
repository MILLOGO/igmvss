<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 17/10/2018
 * Time: 14:42
 */


include_once('../../../Databases/FichierBD.php');

if(isset($_POST["type"])){
    $type=$_POST["type"];
    if($type=='ajout') {

        $nom=strip_tags($_POST['nom']);
        $description=$_POST['description'];

        $newfacteur=new Bd_parametre();

        try {
            $newfacteur->InsererEspece($nom,$description);
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$msg'>";

        }
    }

}else{

    $nom = strip_tags($_POST['nomM']);
    $id = $_POST['idele'];
    $description = $_POST['descriptionM'];

    $newfacteur = new Bd_parametre();

    try {
        $newfacteur->ModifierEspece($nom, $description, $id);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}