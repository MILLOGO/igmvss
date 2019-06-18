<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 21/07/2018
 * Time: 18:36
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
    $taille=7;
    if (!empty($site)) {
        echo "<option></option>";
        foreach ($site as $loc):
            $id = $loc[$cle];
            $cle = $cle + $taille;
            $nomsite = $loc[$nom];
            $nom = $nom + $taille;
            echo "<option value='$id'>$nomsite</option>";
        endforeach;
    } else {
        echo "<option>Aucun site trouvé dans cette localité</option>";
    }
}

