<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 05/07/2018
 * Time: 15:06
 */
include_once('../../../Databases/FichierBD.php');

if(isset($_GET['type'])) {

    $motclef=$_GET['type'];
    $tableau = Bd_GestionSite::ListerGestionnaireEnFct($motclef);
    $cle = 1;
    $no = 3;
    $pre = 4;
    $nomstructure=11;
    if (!empty($tableau)) {
       echo "<option>Selectionner le gestionnaire </option>";
        if ($motclef == 'individuel') {
            foreach ($tableau as $tab):
                $id = $tab[$cle];
                $cle = $cle + 14;
                $nom = $tab[$no];
                $no = $no + 14;
                $prenom = $tab[$pre];
                $pre = $pre + 14;

                echo "<option value='$id'> " . $nom . " " . $prenom . "</option>";


                ?>

            <?php endforeach;
        }else{
            foreach ($tableau as $tab):
                $id = $tab[$cle];
                $cle = $cle + 14;
                $nom = $tab[$nomstructure];
                $nomstructure = $nomstructure + 14;
                //$prenom = $tab[$pre];
                //$pre = $pre + 14;

                echo "<option value='$id'> ".$nom. "</option>";


                ?>

            <?php endforeach;
        }
    }else{
        echo "<option> Aucun gestionnaire trouvé </option>";
    }
}


    if(isset($_GET['idgest']) && $_GET['typegest']) {
        $typegestion = $_GET['typegest'];
        $idgestionnaire = $_GET['idgest'];
        if ($idgestionnaire != '') {
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

?>

