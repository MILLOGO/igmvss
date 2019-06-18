<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 16/10/2018
 * Time: 22:36
 */


include_once('../../../Databases/FichierBD.php');

if(isset($_POST["type"])){
    $type=$_POST["type"];
    if($type=='ajout') {

        $id=strip_tags($_POST['idregion']);
        $nom=strip_tags($_POST['nomProv']);

        $newprovince=new Bd_parametre();

        try {
            $newprovince->InsererProvince($id,$nom);
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$msg'>";

        }
    }

}else{

    $regionid=strip_tags($_POST['idregion']);
    $province=strip_tags($_POST['nomProv']);
    $provinceid=strip_tags($_POST['idprovince']);

    $parametre=new Bd_parametre();


    try {
        $parametre->ModifierProvince($provinceid,$regionid,$province);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}