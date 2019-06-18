<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 09/07/2018
 * Time: 00:58
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
            echo "<option value='$id'>$nomCommune</option>";
        endforeach;
    }else{
        echo "<option>Aucune commune trouvée pour cette province</option>";
    }


}

if(isset($_GET['idcommune'])) {
    $idcommune = $_GET['idcommune'];
    $localite = Bd_parametre::ListeLocaliteParCommune($idcommune);
    $cle = 1;
    $nom = 3;
    if (!empty($localite)) {
        echo "<option></option>";
        foreach ($localite as $loc):
            $id = $loc[$cle];
            $cle = $cle + 3;
            $nomLocalite = $loc[$nom];
            $nom = $nom + 3;
            echo "<option value='$id'>$nomLocalite</option>";
        endforeach;
    } else {
        echo "<option>Aucune localité trouvée pour cette commune</option>";
    }
}


if(isset($_GET['idlocalite'])) {
    $idlocalite = $_GET['idlocalite'];
    $site = Bd_GestionSite::ListerSiteParLocalite($idlocalite);
    $cle = 1;
    $nom = 6;
    if (!empty($site)) {
        echo "<option></option>";
        foreach ($site as $loc):
            $id = $loc[$cle];
            $cle = $cle + 7;
            $nomsite = $loc[$nom];
            $nom = $nom + 7;
            echo "<option value='$id'>$nomsite</option>";
        endforeach;
    } else {
        echo "<option>Aucun site trouvé dans cette localité</option>";
    }
}



if(isset($_GET['idcategorie'])) {
    $idcat = $_GET['idcategorie'];
    if ($idcat != 0) {
        $amenager = Bd_parametre::ListeAmenagementParCategorie($idcat);
        echo "<option value=''>Sélectionné un amenagement</option>";
        if (!empty($amenager)) {
            $cle = 1;
            $nomAm = 3;

            foreach ($amenager AS $voc):
                $id = $voc[$cle];
                $cle = $cle + 5;
                $amen = $voc[$nomAm];
                $nomAm = $nomAm + 5;
                echo "<option value='$id'>$amen</option>";
            endforeach;
        } else {
            echo "<option value=''>Aucun aménagement trouvé</option>";
        }
    }
}


if(isset($_GET['idAm'])){
    $idam=$_GET['idAm'];
    if($idam!=0){

        $valeur=new Bd_GestionAmenagement();
        $infos=$valeur->RecupererValeurInfosSpec($idam);
        echo "<input type='hidden' id='elementSelectionne' value='$infos'>";
    }
}


if(isset($_GET['idsite'])){
    $idsite=$_GET['idsite'];
    if($idsite!=0){
        $valeur=new Bd_GestionAmenagement();
        $super=$valeur->RecupererSuperficie($idsite);
        $type=$valeur->RecupererTypeSite($idsite);
        echo "<input id='Cible' class='formulaire' name='Cible' type='hidden' value='$super'>";
        echo "<input id='type' class='formulaire' name='type' type='hidden' value='$type'>";
    }
}