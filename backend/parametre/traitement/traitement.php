<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 23/07/2018
 * Time: 01:37
 */

include_once('../../../DataBases/FichierBD.php');

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
