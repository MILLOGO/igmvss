<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 13/10/2018
 * Time: 22:16
 */


include_once('../../../Databases/FichierBD.php');

if(isset($_POST["type"])){
    $type=$_POST["type"];
    if($type=='ajout') {
        $nomGest=strip_tags($_POST['nomGest']);
        $reconnait=strip_tags(($_POST['reconnaissance']));
        $exploitat=strip_tags(($_POST['exploitation']));
        $vocation=strip_tags($_POST['vocationSit']);
        $localite=strip_tags($_POST['localite']);
        $nomSite=strip_tags($_POST['nomSite']);
        $superficie=strip_tags($_POST['superficie']);
        $typesite=strip_tags($_POST['typesite']);

        if($typesite=='longueur'){
            $typegeom='Ligne';
        }else{
            if($typesite=='superficie'){
                $typegeom='Polygone';
            }else{
                $typegeom='Point';
            }
        }

        if($superficie==''){
            $superficie=0;
        }
        $site=new Bd_GestionSite();
        $status=new Bd_parametre();


        try {
            $status->InsererStatusFoncier($reconnait,$exploitat);
            $idfoncier=$status->RecupererIdStatusFoncier();
            $site->InsererSite($nomGest,$idfoncier,$vocation,$nomSite,$superficie,$typesite,$typegeom,$localite);
            //$idsite=$site->RecupererIdSite();
            //$site->InsererSituerSiteLocalite($localite,$idsite);
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$msg'>";

        }
    }

}else{

    $nomGest=strip_tags($_POST['idgest']);
    $reconnait=strip_tags(($_POST['reconnais']));
    $exploitat=strip_tags(($_POST['exploite']));
    $vocation=strip_tags($_POST['voca']);
    $localite=strip_tags($_POST['local']);
    $nomSite=strip_tags($_POST['libelle']);
    $superficie=strip_tags($_POST['surface']);
    $idsite=strip_tags($_POST['iddusit']);
    $idstatus=strip_tags($_POST['idsta']);
    $typesite=strip_tags($_POST['typesite']);

    if($typesite=='longueur'){
        $typegeom='Ligne';
    }else{
        if($typesite=='superficie'){
            $typegeom='Polygone';
        }else{
            $typegeom='Point';
        }
    }

    $site=new Bd_GestionSite();
    $status=new Bd_parametre();

    try {
        $status->ModifierStatusSite($reconnait,$exploitat, $idstatus);
        $site->ModifierSite($nomSite,$superficie,$nomGest,$vocation,$idsite,$typesite,$typegeom,$localite);
        //$situer=new Bd_GestionSite();
        //$site->ModifierSituerSite($idsite,$localite);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}