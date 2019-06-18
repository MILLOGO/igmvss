<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 22/07/2018
 * Time: 13:59
 */

include_once('../../../Databases/FichierBD.php');
//verification avant suppression

if(isset($_GET['idgestionnaire'])){
    $id=$_GET['idgestionnaire'];
    $rsult="";
    $where='idgestionnaire='.$id;
    if($id!=0){
        $valeur=new Bd_GestionSite();
        $rsult=$valeur->ChercherDansBD("recevoir_appui_gest_op",$where);
        if($rsult!=0){
            echo "<input type='hidden' id='supprimerGest' value='$rsult'>";
        }else{
            $rsult=$valeur->ChercherDansBD("revenuannuel",$where);
            if($rsult!=0){
                echo "<input type='hidden' id='supprimerGest' value='$rsult'>";
            }else{
                $rsult=$valeur->ChercherDansBD("site",$where);
                if($rsult!=0){
                    echo "<input type='hidden' id='supprimerGest' value='$rsult'>";
                }else{
                        echo "<input type='hidden' id='supprimerGest' value='0'>";
                    }
                }
            }
    }

}