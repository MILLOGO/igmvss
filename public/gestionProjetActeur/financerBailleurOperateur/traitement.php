<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 17/10/2018
 * Time: 22:32
 */


include_once('../../../Databases/FichierBD.php');


if(isset($_POST['idfina'])){
    $idB=$_POST['idfina'];
    $gestionProjetActeur=new Bd_GestionProjetActeur();
    try {
        $gestionProjetActeur->supprimerFinancementOperateur($idB);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}