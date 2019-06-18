<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 15/07/2018
 * Time: 13:54
 */

include_once('../../../Databases/FichierBD.php');


if(isset($_GET['idregion'])){
    $idregion=$_GET['idregion'];
    if($idregion!='') {
        $province = Bd_parametre::ListeProvinceParRegion($idregion);
        $cle = 1;
        $nom = 3;
        if (!empty($province)) {
            echo "<option value=''>Sélectionner la province</option>";
            foreach ($province as $prov):
                $id = $prov[$cle];
                $cle = $cle + 3;
                $nomProvince = $prov[$nom];
                $nom = $nom + 3;
                echo "<option value='$id'>$nomProvince</option>";
            endforeach;
        } else {
            echo "<option value=''>Aucune province trouvée pour cette région</option>";
        }
    }else{
        echo "<option value=''>Aucune province trouvée pour cette région</option>";
    }
}

if(isset($_GET['idprovince'])){
    $idprovince=$_GET['idprovince'];
    if($idprovince!='') {
        $commune = Bd_parametre::ListeCommuneParProvince($idprovince);
        $cle = 1;
        $nom = 3;
        if (!empty($commune)) {
            echo "<option value=''>Sélectionner la commune</option>";
            foreach ($commune as $com):
                $id = $com[$cle];
                $cle = $cle + 7;
                $nomCommune = $com[$nom];
                $nom = $nom + 7;
                echo "<option value='$id'>$nomCommune</option>";
            endforeach;
        } else {
            echo "<option value=''>Aucune commune trouvée pour cette province</option>";
        }
    }else{
        echo "<option value=''>Aucune commune trouvée pour cette province</option>";
    }

}

if(isset($_GET['idcommune'])) {
    $idcommune = $_GET['idcommune'];
    if($idcommune!='') {
        $localite = Bd_parametre::ListeLocaliteParCommune($idcommune);
        $cle = 1;
        $nom = 3;
        if (!empty($localite)) {
            echo "<option value=''>Sélectionner la localité</option>";
            foreach ($localite as $loc):
                $id = $loc[$cle];
                $cle = $cle + 3;
                $nomLocalite = $loc[$nom];
                $nom = $nom + 3;
                echo "<option value='$id'>$nomLocalite</option>";
            endforeach;
        } else {
            echo "<option value=''>Aucune localité trouvée pour cette commune</option>";
        }
    }else{
        echo "<option value=''>Aucune localité trouvée pour cette commune</option>";
    }
}




if(isset($_GET['idcategorie'])) {
    $idcat = $_GET['idcategorie'];
    if($idcat!='') {
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
            ?>
            <option value="">Aucun aménagement trouvé</option>
            <?php
        }

    } ?>
    <option value="">Aucun aménagement trouvé</option>
    <?php
}
