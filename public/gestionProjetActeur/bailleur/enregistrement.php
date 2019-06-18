<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 12/10/2018
 * Time: 09:36
 */

include_once('../../../Databases/FichierBD.php');

if(isset($_POST["type"])){
    $type=$_POST["type"];
    if($type=='ajout') {
        $nomb = strip_tags($_POST['nomB']);
        $nomcontact = strip_tags($_POST['nomC']);
        $prenomcontact = strip_tags($_POST['prenom']);
        $email = strip_tags($_POST['mail']);
        $numero = strip_tags($_POST['num']);
        $description = strip_tags($_POST['nomDes']);
        $bailleur = new Bd_GestionProjetActeur();

        try {
            $bailleur->InsererBailleur($nomb, $nomcontact, $prenomcontact, $numero, $email, $description);
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $bailleur = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$bailleur'>";

        }
    }

}else{
    $nomb = strip_tags($_POST['nomB']);
    $nomcontact = strip_tags($_POST['nomC']);
    $prenomcontact = strip_tags($_POST['prenom']);
    $email = strip_tags($_POST['mail']);
    $numero = strip_tags($_POST['num']);
    $description = strip_tags($_POST['nomDes']);
    $idbailModif=strip_tags($_POST['idbail']);
    $bailleur = new Bd_GestionProjetActeur();

    try {
        $bailleur->modifierBailleur($nomb, $nomcontact, $prenomcontact, $numero, $email, $description,$idbailModif);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $bailleur = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$bailleur'>";

    }

}