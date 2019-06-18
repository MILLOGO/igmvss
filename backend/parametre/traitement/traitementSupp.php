<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 23/07/2018
 * Time: 00:02
 */
include_once('../../../DataBases/FichierBD.php');


//verification avant suppression

if(isset($_GET['id']) && isset($_GET['table']) && isset($_GET['attr'])) {
    $id = $_GET['id'];
    $table = $_GET['table'];
    $attrib=$_GET['attr'];
    $rsult = "";
    $where = $attrib.'='. $id;
    if ($id != 0) {
        $valeur = new Bd_parametre();
        $rsult = $valeur->ChercherDansBD($table, $where);
        if ($rsult != 0) {
            echo "<input type='hidden' id='supprimer' value='$rsult'>";
        } else {
            echo "<input type='hidden' id='supprimer' value='0'>";
        }
    }
}


if(isset($_GET['idcaract']) && isset($_GET['table']) && isset($_GET['attr'])) {
    $id = $_GET['idcaract'];
    $table = $_GET['table'];
    $attrib=$_GET['attr'];
    $rsult = "";
    $where = $attrib."='". $id."'";
    if ($id != "") {
        $valeur = new Bd_parametre();
        $rsult = $valeur->ChercherDansBD($table, $where);
        if ($rsult != 0) {
            echo "<input type='hidden' id='supprimer' value='$rsult'>";
        } else {
            echo "<input type='hidden' id='supprimer' value='0'>";
        }
    }
}