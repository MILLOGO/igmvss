<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 10/08/2018
 * Time: 13:56
 */
include_once('../../../Databases/FichierBD.php');


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
