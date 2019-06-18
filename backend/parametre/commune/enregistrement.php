<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 17/10/2018
 * Time: 21:17
 */

include_once('../../../Databases/FichierBD.php');

if(isset($_POST["type"])){
    $type=$_POST["type"];
    if($type=='ajout') {

        $idprovince=strip_tags($_POST['nomProvince']);
        $nomcommune=strip_tags($_POST['nomCommune']);
        $nbreH=strip_tags($_POST['nombreH']);
        $nbreF=strip_tags($_POST['nombreF']);
        $nomM=strip_tags($_POST['nombreMenage']);
        $popTotal=strip_tags($_POST['popTotal']);
        $newfacteur=new Bd_parametre();

        try {
            $newfacteur->InsererCommune($idprovince,$nomcommune,$nbreH,$nbreF,$popTotal,$nomM);
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$msg'>";

        }
    }

}else{

    $idprovince=strip_tags($_POST['nomProv']);
    $nomcommune=strip_tags($_POST['nomComm']);
    $nbreH=strip_tags($_POST['nombH']);
    $nbreF=strip_tags($_POST['nombF']);
    $nomM=strip_tags($_POST['nombreMena']);
    $popTotal=strip_tags($_POST['popTo']);
    $idcommune=strip_tags($_POST['cle']);
    $newfacteur=new Bd_parametre();

    try {
        $newfacteur->ModifierCommune($idprovince,$nomcommune,$nbreH,$nbreF,$popTotal,$nomM,$idcommune);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}