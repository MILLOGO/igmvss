<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 13/10/2018
 * Time: 11:37
 */

include_once('../../../Databases/FichierBD.php');

if(isset($_POST["typer"])){
    $type=$_POST["typer"];
    if($type=='ajout') {

        $gestion = new Bd_GestionSite();
        $id = $gestion->RecupererID();;
        $id = $id + 1;
        $typegest = $_POST['type'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $numeroges = $_POST['numero'];
        $mail = $_POST['mail'];
        $fact = $_POST['total'];
        $facteur = [];
        $facteu = $_POST['facteurs'];
        $facteur = explode(',', $facteu);

        try {

            if ($typegest == 'individuel') {
                //individuel
                $datenais = $_POST['dateNais'];
                $status = $_POST['statu'];
                $nbrepers = $_POST['nbrepers'];
                $nbrepers16 = $_POST['nbre16'];

                $gestion->InsererGestionnaire($nom, $prenom, $numeroges, $mail, $typegest, $datenais, $status, $nbrepers, $nbrepers16);

                if (!empty($facteur)) {
                    for ($i = 0; $i < $fact; $i++) {
                        $gestion->InsererFacteur($id, $facteur[$i]);
                    }
                }
            } else {
                //collectif
                $denomi = $_POST['deno'];
                $typecollec = $_POST['typecollectif'];
                $genre = $_POST['genr'];
                $nbremembre = $_POST['nbrMembre'];
                $gestion->InsererGestionnaireC($nom, $prenom, $numeroges, $mail, $typegest, $denomi, $genre, $typecollec, $nbremembre);

                if (!empty($facteur)) {
                    for ($i = 0; $i < $fact; $i++) {
                        $gestion->InsererFacteur($id, $facteur[$i]);
                    }
                }
            }
            echo "<input type='hidden' id='echec' value=''>";
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<input type='hidden' id='echec' value='$msg'>";

        }
    }

}else{

    $gestion = new Bd_GestionSite();
    // $id = $gestion->RecupererID();;
    // $id = $id + 1;
    $typegest = $_POST['type'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $numeroges = $_POST['numero'];
    $cle = $_POST['idgestionnaire'];
    $mail = $_POST['mail'];
    $fact = $_POST['total'];
    $facteur = [];
    $facteu = $_POST['facteurs'];
    $facteur = explode(',', $facteu);

    try {

        if ($typegest == 'individuel') {
            //individuel
            $datenais = $_POST['dateNais'];
            $status = $_POST['statu'];
            $nbrepers = $_POST['nbrepers'];
            $nbrepers16 = $_POST['nbre16'];
            $gestion->ModifierGestionnaireInd($nom, $prenom, $numeroges, $mail, $typegest, $datenais, $status, $nbrepers, $nbrepers16, $cle);
            $gestion->supprimerFacteurParGestionnaire($cle);
            if (!empty($facteur)) {
                for ($i = 0; $i < $fact; $i++) {
                    $gestion->InsererFacteur($cle, $facteur[$i]);
                }
            }
        } else {
            //collectif
            $denomi = $_POST['deno'];
            $typecollec = $_POST['typecollectif'];
            $genre = $_POST['genr'];
            $nbremembre = $_POST['nbrMembre'];
            $gestion->ModifierGestionnaireC($nom, $prenom, $numeroges, $mail, $typegest, $denomi, $genre, $typecollec, $nbremembre, $cle);
            $gestion->supprimerFacteurParGestionnaire($cle);
            if (!empty($facteur)) {
                for ($i = 0; $i < $fact; $i++) {
                    $gestion->InsererFacteur($cle, $facteur[$i]);
                }
            }
        }

        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}