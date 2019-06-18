<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 22/07/2018
 * Time: 19:46
 */


include_once('../../../Databases/FichierBD.php');

if(isset($_GET['idregion'])){
    $idregion=$_GET['idregion'];
    $province=Bd_parametre::ListeProvinceParRegion($idregion);
    $cle=1;
    $nom=3;
    if(!empty($province)){
        echo "<option></option>";
        foreach($province as $prov):
            $id=$prov[$cle];
            $cle=$cle+3;
            $nomProvince=$prov[$nom];
            $nom=$nom+3;
            echo "<option value='$id'>$nomProvince</option>";
        endforeach;
    }else{
        echo "<option>Aucune province trouvée pour cette région</option>";
    }
}

if(isset($_GET['idprovince'])){
    $idprovince=$_GET['idprovince'];
    $commune=Bd_parametre::ListeCommuneParProvince($idprovince);
    $cle=1;
    $nom=3;
    if(!empty($commune)){
        echo "<option></option>";
        foreach($commune as $com):
            $id=$com[$cle];
            $cle=$cle+7;
            $nomCommune=$com[$nom];
            $nom=$nom+7;
            //echo "<option value='$id'>$nomCommune</option>";
            echo "<option value='$id' id='commun$id'>$nomCommune</option>";
        endforeach;
    }else{
        echo "<option>Aucune commune trouvée pour cette province</option>";
    }

}


//verification avant suppression


if(isset($_GET['idprojet'])){
    $id=$_GET['idprojet'];
    $rsult="";
    $where='idprojet='.$id;
    if($id!=0){
        $valeur=new Bd_GestionSite();
        $rsult=$valeur->ChercherDansBD("amenager",$where);
        if($rsult!=0){
            echo "<input type='hidden' id='supprimerProjet' value='$rsult'>";
        }else/*{
            $rsult=$valeur->ChercherDansBD("financer_bailleur_projet",$where);
            if($rsult!=0){
                echo "<input type='hidden' id='supprimerProjet' value='$rsult'>";
            }else*/{
                $rsult=$valeur->ChercherDansBD("financer_bailleur_operateur",$where);
                if($rsult!=0){
                    echo "<input type='hidden' id='supprimerProjet' value='$rsult'>";
                }else{
                    $rsult=$valeur->ChercherDansBD("recevoir_appui_gest_op",$where);
                    if($rsult!=0){
                        echo "<input type='hidden' id='supprimerProjet' value='$rsult'>";
                    }else{
                        echo "<input type='hidden' id='supprimerProjet' value='0'>";
                    }
                }
            }
        }
   // }


}
/*
if(isset($_POST['idprojet'])){
    $idB=$_POST['idprojet'];
    $gestion=new Bd_GestionProjetActeur();
    try {

        $gestion->SupprimerExecuterProjetCommune($idB);
        $gestion->SupprimerFinancerBailleurProjet($idB);
        $gestion->SupprimerExecuterProjetOperateur($idB);
        $gestion->SupprimerProjet($idB);
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}
*/
