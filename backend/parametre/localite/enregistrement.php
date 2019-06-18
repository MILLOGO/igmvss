<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 17/10/2018
 * Time: 15:49
 */


include_once('../../../Databases/FichierBD.php');

if(isset($_POST["type"])){
    $type=$_POST["type"];
    if($type=='ajout') {

        $id=strip_tags($_POST['idcommune']);
        $nom=strip_tags($_POST['nomLocalite']);

        $newLocalite=new Bd_parametre();
        try {
            $newLocalite->InsererLocalite($id,$nom);
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$msg'>";

        }
    }

}else{

    $idcommune = strip_tags($_POST['idcommu']);
    $nom = strip_tags($_POST['nomLocal']);
    $idlocal = strip_tags($_POST['idlocal']);
    $Localite = new Bd_parametre();


    try {
        $Localite->ModifierLocalite($idcommune, $nom,$idlocal);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}