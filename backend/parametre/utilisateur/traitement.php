<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 29/07/2018
 * Time: 10:36
 */
include_once('../../../Databases/FichierBD.php');
if(isset($_GET['pass'])){
    $cryp=md5($_GET['pass']);

    echo "<input type='hidden' id='crypt' value='$cryp'/>";
}

if(isset($_GET['login'])){
    $login=$_GET['login'];
    $user=new Bd_user("","","","","","","","","");
    $etat=$user->VerifierLogin($login);

    echo "<input type='hidden' id='log' value='$etat'/>";
}

if(isset($_GET['logi']) &&isset($_GET['id']) ){
    $login=$_GET['logi'];
    $id=$_GET['id'];
    $user=new Bd_user("","","","","","","","","");
    $etat=$user->VerifierLoginPourMod($login,$id);
    echo "<input type='hidden' id='logmod' value='$etat'/>";
}