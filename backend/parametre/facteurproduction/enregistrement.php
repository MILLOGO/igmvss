<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 17/10/2018
 * Time: 15:25
 */



include_once('../../../Databases/FichierBD.php');

if(isset($_POST["type"])){
    $type=$_POST["type"];
    if($type=='ajout') {

        $nomfac=strip_tags($_POST['nom']);

        $newfacteur=new Bd_parametre();
        try {
            $newfacteur->InsererFacteur($nomfac);
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$msg'>";

        }
    }

}else{

    $nomfac=$_POST['nomF'];
    $nomid=$_POST['identif'];
    $newfacteur=new Bd_parametre();

    try {
        $newfacteur->ModifierFacteur($nomfac,$nomid);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}