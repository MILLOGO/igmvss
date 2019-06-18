<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 14/10/2018
 * Time: 20:45
 */


include_once('../../../Databases/FichierBD.php');

if(isset($_POST["type"])){
    $type=$_POST["type"];
    if($type=='ajout') {
        $nom=trim(strip_tags($_POST['nom']));
        $prenom=trim(strip_tags($_POST['prenom']));
        $service=trim(strip_tags($_POST['service']));
        $fonction=trim(strip_tags($_POST['fonction']));
        $profil=trim(strip_tags($_POST['profil']));
        $email=trim(strip_tags($_POST['email']));
        $telep=trim(strip_tags($_POST['tele']));
        $identif=trim(strip_tags($_POST['identifiant']));
        $passwd=trim(strip_tags($_POST['passwod']));

        try {
            $user=new Bd_user($nom,$prenom,$telep,$identif,$passwd,$email,$fonction,$service,$profil);
            $user->InsererUser();
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$msg'>";

        }
    }

}else{
    $nom = trim(strip_tags($_POST['nom']));
    $prenom = trim(strip_tags($_POST['prenom']));
    $service = trim(strip_tags($_POST['service']));
    $fonction = trim(strip_tags($_POST['fonction']));
    $profil = trim(strip_tags($_POST['profil']));
    $email = trim(strip_tags($_POST['email']));
    $telep = trim(strip_tags($_POST['tele']));
    $identif = trim(strip_tags($_POST['identifiant']));
    $passwd = trim(strip_tags($_POST['passwod']));
    $id = trim(strip_tags($_POST['id']));


    try {
        $user = new Bd_user($nom, $prenom, $telep, $identif, $passwd, $email, $fonction, $service, $profil);
        $user->ModifierUser($id);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}