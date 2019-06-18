<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 17/10/2018
 * Time: 21:40
 */
include_once('../../../Databases/FichierBD.php');
if(isset($_POST['idlocali'])){
    $id=$_POST['idlocali'];
    $param=new Bd_parametre();

    try {
        $param->SupprimerLocalite($id);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }
}
