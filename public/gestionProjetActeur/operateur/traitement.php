<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 20/07/2018
 * Time: 19:40
 */


include_once('../../../Databases/FichierBD.php');


if(isset($_GET['idOp'])){
    $idOp=$_GET['idOp'];
    $gestionProjetActeur=new Bd_GestionProjetActeur();
    try {
        $gestionProjetActeur->supprimerOperateur($idOp);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }
}