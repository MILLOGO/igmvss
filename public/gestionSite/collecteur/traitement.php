<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 21/07/2018
 * Time: 18:19
 */
include_once('../../../Databases/FichierBD.php');

if(isset($_GET['idcoll'])){
    $id=$_GET['idcoll'];
    $rsult="";
    $where='idcollecteur='.$id;
    if($id!=0){
        $valeur=new Bd_GestionSite();
        $rsult=$valeur->ChercherDansBD("observer_collecteur_site",$where);
        if($rsult!=0){
            echo "<input type='hidden' id='supprimer' value='$rsult'>";
        }else{
            echo "<input type='hidden' id='supprimer' value='0'>";
        }
    }


}