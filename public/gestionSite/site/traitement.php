<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 08/07/2018
 * Time: 09:51
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
        echo "<option value=''></option>";
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
        echo "<option value=''></option>";
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

if(isset($_GET['type'])){
    $type=$_GET['type'];
    $gestion=[];
    if($type=='individuel'){
        $gestion=Bd_GestionSite::GestionnaireIndividuel();
        echo "<option></option>";
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
        $gestion=Bd_GestionSite::GestionnaireCollectif();
        echo "<option></option>";
        if(!empty($gestion)){
            $cle=1;
            $nom=7;
            //$pre=3;
            foreach($gestion as $gest):
                $id=$gest[$cle];
                $cle=$cle+10;
                $nomget=$gest[$nom];
                $nom=$nom+10;

                echo"<option value='$id'>$nomget</option>";
            endforeach;
        }else {
            echo "<option>Aucun gestionnaire collectif trouvé</option>";
        }
    }

}

if(isset($_GET['idcategorie'])){
    $idcat=$_GET['idcategorie'];
    $vocation=Bd_parametre::ListeVocationParCategorie($idcat);
    echo "<option value=''></option>";
    if(!empty($vocation)){
        $cle=1;
        $nomVoc=3;

        foreach($vocation AS $voc):
            $id=$voc[$cle];
            $cle=$cle+3;
            $vocat=$voc[$nomVoc];
            $nomVoc=$nomVoc+3;
            echo"<option value='$id'>$vocat</option>";
        endforeach;
    }else{
        echo "<option>Aucune vocation trouvée</option>";
    }
}

if(isset($_GET['idgest']) && $_GET['typegest']){
    $typegestion=$_GET['typegest'];
    $idgestionnaire=$_GET['idgest'];
    if($idgestionnaire!="") {
        if ($typegestion == 'individuel') {
            $detailInd = Bd_GestionSite::GestionnaireIndividuelParId($idgestionnaire);
            $ty = 2;
            $no = 3;
            $pre = 4;
            $num = 5;
            $mail = 6;

            foreach ($detailInd as $detail):
                $typ = $detail[$ty];
                $ty = $ty + 10;
                $nomges = $detail[$no];
                $no = $no + 10;
                $pren = $detail[$pre];
                $pre = $pre + 10;
                $nume = $detail[$num];
                $num = $num + 10;
                $email = $detail[$mail];
                $mail = $mail + 10;

                echo "<p><span style='color: #006600'>type du gestionnaire:</span> $typ <br><span style='color: #006600'>Nom et Prénom du gestionnaire:
                   </span><span class='maj'>$nomges</span> $pren <br> <span style='color: #006600'>Numéro:</span> $nume<br>
                   <span style='color: #006600'>Adresse email:</span> $email</p>";
            endforeach;
        } else {
            $detailInd = Bd_GestionSite::GestionnaireCollectifParId($idgestionnaire);
            $ty = 2;
            $no = 3;
            $pre = 4;
            $num = 5;
            $mail = 6;
            $noC = 7;

            foreach ($detailInd as $detail):
                $typ = $detail[$ty];
                $ty = $ty + 10;
                $nomges = $detail[$no];
                $no = $no + 10;
                $pren = $detail[$pre];
                $pre = $pre + 10;
                $nume = $detail[$num];
                $num = $num + 10;
                $email = $detail[$mail];
                $mail = $mail + 10;
                $nomcolect = $detail[$noC];
                $noc = $noC + 10;

                echo "<p><span style='color: #006600'>type du gestionnaire:</span> $typ  <br><span style='color: #006600'>Nom du collectif:</span> $nomcolect<br><span style='color: #006600'>Nom et Prénom du contact:
                   </span><span class='maj'>$nomges</span> $pren <br> <span style='color: #006600'>Numéro:</span> $nume<br>
                   <span style='color: #006600'>Adresse email:</span> $email</p>";
            endforeach;
        }
    }
}

//verification avant suppression

if(isset($_GET['idsit'])){
    $id=$_GET['idsit'];
    $rsult="";
    $where='idsite='.$id;
    if($id!=0){
        $valeur=new Bd_GestionSite();
        $rsult=$valeur->ChercherDansBD("correspondre_site_geomorphologie",$where);
        if($rsult!=0){
            echo "<input type='hidden' id='supprimerSite' value='$rsult'>";
        }else{
            $rsult=$valeur->ChercherDansBD("observer_collecteur_site",$where);
            if($rsult!=0){
                echo "<input type='hidden' id='supprimerSite' value='$rsult'>";
            }else{
                $rsult=$valeur->ChercherDansBD("amenager",$where);
                if($rsult!=0){
                    echo "<input type='hidden' id='supprimerSite' value='$rsult'>";
                }else{
                    $rsult=$valeur->ChercherDansBD("correspondre_site_typesol",$where);
                    if($rsult!=0){
                        echo "<input type='hidden' id='supprimerSite' value='$rsult'>";
                    }else{
                        echo "<input type='hidden' id='supprimerSite' value='0'>";
                    }
                }
            }
        }
    }
}