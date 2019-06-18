<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 20/07/2018
 * Time: 18:55
 */

include_once('../../../Databases/FichierBD.php');

if(isset($_GET['idbai'])){
    $idB=$_GET['idbai'];

        $gestionProjetActeur=new Bd_GestionProjetActeur();

        try {
            $gestionProjetActeur->supprimerBailleur($idB);
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$msg'>";

        }
}