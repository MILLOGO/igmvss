<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 15/07/2018
 * Time: 13:54
 */

include_once('../../Databases/FichierBD.php');

if(isset($_GET['idbailleur'])){
    $idbailleur=$_GET['idbailleur'];
    if($idbailleur!='') {
        $req="SELECT DISTINCT idoperateur,nomoperateur FROM filtreoperateurprojetparbailleur WHERE idbailleur=$idbailleur";
        $province = Bd_Requetes::ListeRequete1($req);
        $cle = 1;
        $nom = 2;
        if (!empty($province)) {
            echo "<option value=''>Sélectionner l'opérateur</option>";
            foreach ($province as $prov):
                $id = $prov[$cle];
                $cle = $cle + 2;
                $nomProvince = $prov[$nom];
                $nom = $nom + 2;
                echo "<option value='$id'>$nomProvince</option>";
            endforeach;
        } else {
            echo "<option value=''>Aucun opérateur</option>";
        }
    }else{
        echo "<option value=''></option>";
    }
}

if(isset($_GET['idbail']) && isset($_GET['idoperateur'])){
    $idbailleur=$_GET['idbail'];
    $idoperateur=$_GET['idoperateur'];
    if($idbailleur!='') {
        $req="SELECT * FROM filtreoperateurprojetparbailleur WHERE idbailleur=$idbailleur AND idoperateur=$idoperateur";
        $province = Bd_Requetes::ListeRequete1($req);
        $cle = 7;
        $nom = 8;
        if (!empty($province)) {
            echo "<option value=''>Sélectionner le projet</option>";
            foreach ($province as $prov):
                $id = $prov[$cle];
                $cle = $cle + 8;
                $nomProvince = $prov[$nom];
                $nom = $nom + 8;
                echo "<option value='$id'>$nomProvince</option>";
            endforeach;
        } else {
            echo "<option value=''>Aucun projet</option>";
        }
    }else{
        echo "<option value=''></option>";
    }
}

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
        echo "<option value=''></option>";
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
        echo "<option value=''></option>";
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
        echo "<option value=''></option>";
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

    <?php
}

//trater les gestionnaire


if(isset($_GET['type'])){
    $type=$_GET['type'];
    $gestion=[];
    if($type==1){
        $gestion=Bd_GestionSite::GestionnaireIndividuel();
        echo "<option value=''>Sélectionné le gestionnaire </option>";
        if(!empty($gestion)){
            $cle=1;
            $nom=3;
            $pre=4;
            foreach($gestion as $gest):
                $id=$gest[$cle];
                $cle=$cle+10;
                $nomget=$gest[$nom];
                $nom=$nom+10;
                $prenom=$gest[$pre];
                $pre=$pre+10;
                echo"<option value='$id'>".$nomget." ".$prenom."</option>";
            endforeach;
        }else {
            echo "<option>Aucun gestionnaire individuel trouvé</option>";
        }
    }else{
        if($type==2) {
            $gestion = Bd_GestionSite::GestionnaireCollectif();
            echo "<option value=''>Sélectionné le gestionnaire </option>";
            if (!empty($gestion)) {
                $cle = 1;
                $nom = 7;
                foreach ($gestion as $gest):
                    $id = $gest[$cle];
                    $cle = $cle + 10;
                    $nomget = $gest[$nom];
                    $nom = $nom + 10;

                    echo "<option value='$id'>$nomget</option>";
                endforeach;
            }
            else {
                echo "<option value=''>Aucun gestionnaire collectif trouvé</option>";
            }
        }else {
            echo "<option value=''></option>";
        }
    }
}


