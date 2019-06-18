<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 16/10/2018
 * Time: 14:52
 */


include_once('../../../Databases/FichierBD.php');

if(isset($_POST["type"])){
    $type=$_POST["type"];
    if($type=='ajout') {
        $operateur=strip_tags($_POST['operateur']);
        $projet=strip_tags($_POST['projet']);
        $site=strip_tags($_POST['site']);
        $amenge=strip_tags($_POST['amenge']);
        $datedebut=strip_tags($_POST['datedebut']);
        $datefin=strip_tags($_POST['datefin']);
        $superCible=strip_tags($_POST['superCible']);
        $typesite=strip_tags($_POST['typesite']);
       // $pfnl=strip_tags($_POST['pfnl']);
        $espece=strip_tags($_POST['espece']);
        $vegetal=strip_tags($_POST['vegetalisation']);
        $nbreE=strip_tags($_POST['nbreE']);
        $nbreV=strip_tags($_POST['nbreV']);
        $quantite=strip_tags($_POST['qte']);
        $semi=strip_tags($_POST['semi']);
        $survi=strip_tags($_POST['survi']);
        $repri=strip_tags($_POST['repris']);

        if($projet==''){
            $projet=-1;
        }

        $Amenager=new Bd_GestionAmenagement();

        try {
            $Amenager->InsererAmenager($amenge, $site, $operateur, $superCible, $datedebut, $datefin, $projet,$typesite);
            $idamenager=$Amenager->RecupererIdAmenager();
            if(!empty($vegetal)) {
                $vegetalisation=explode(',',$vegetal);
                for ($i = 0; $i < $nbreV; $i++) {
                    if ($vegetalisation[$i] != '') {
                        $Amenager->InsererAmenagerVegetation($idamenager, $vegetalisation[$i]);
                    }
                }
            }
            if(!empty($espece)) {
                $tableQuatite=explode(",",$quantite);
                $tableEspece=explode(",",$espece);
                $tblesemi=explode(",",$semi);
                $tblerepri=explode(',',$repri);
                $tblesurvi=explode(',',$survi);
                for ($j = 0; $j < $nbreE; $j++) {
                    if ($tableEspece[$j] != '' && $tableQuatite[$j] != '') {
                        if($tblesemi[$j]==''){
                            $tblesemi[$j]=0;
                        }
                        if($tblerepri[$j]==''){
                            $tblerepri[$j]=0;
                        }
                        if($tblesurvi[$j]==''){
                            $tblesurvi[$j]=0;
                        }
                        $Amenager->InsererAmenagerEspece($idamenager, $tableEspece[$j], $tableQuatite[$j],$tblesemi[$j],$tblesurvi[$j],$tblerepri[$j]);
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

    $operateur = strip_tags($_POST['operateur']);
    $projet = strip_tags($_POST['projet']);
    $site = strip_tags($_POST['site']);
    $amenge = strip_tags($_POST['amenge']);
    $datedebut = strip_tags($_POST['datedebut']);
    $datefin = strip_tags($_POST['datefin']);
    $superCible = strip_tags($_POST['superCible']);
    $typesite = strip_tags($_POST['typesite']);
    //$pfnl = strip_tags($_POST['pfnl']);
    $espece = strip_tags($_POST['espece']);
    $vegetal = strip_tags($_POST['vegetalisation']);
    $nbreE = strip_tags($_POST['nbreE']);
    $nbreV = strip_tags($_POST['nbreV']);
    $quantite = strip_tags($_POST['qte']);
    $semi = strip_tags($_POST['semi']);
    $survi = strip_tags($_POST['survi']);
    $repri = strip_tags($_POST['repris']);
    $idamenager= strip_tags($_POST['idamen']);


    $Amenager = new Bd_GestionAmenagement();
    if ($projet == '') {
        $projet = -1;
    }


    try {
        $Amenager->ModifierAmenager($amenge, $site, $operateur, $superCible, $datedebut, $datefin, $projet,$idamenager,$typesite);
        $Amenager->supprimeEspeceAmenager($idamenager);
        $Amenager->supprimeVegetalisationAmenager($idamenager);

        if (!empty($vegetal)){
            $vegetalisation = explode(',', $vegetal);
            for ($i = 0; $i < $nbreV; $i++) {
                if ($vegetalisation[$i] != '') {
                    $Amenager->InsererAmenagerVegetation($idamenager, $vegetalisation[$i]);
                }
            }
        }

        if (!empty($espece)){
            $tableQuatite = explode(",", $quantite);
            $tableEspece = explode(",", $espece);
            $tblesemi = explode(",", $semi);
            $tblerepri = explode(',', $repri);
            $tblesurvi = explode(',', $survi);
            for ($j = 0; $j < $nbreE; $j++) {
                if ($tableEspece[$j] != '' && $tableQuatite[$j] != '') {
                    if ($tblesemi[$j] == '') {
                        $tblesemi[$j] = 0;
                    }
                    if ($tblerepri[$j] == '') {
                        $tblerepri[$j] = 0;
                    }
                    if ($tblesurvi[$j] == '') {
                        $tblesurvi[$j] = 0;
                    }
                    $Amenager->InsererAmenagerEspece($idamenager, $tableEspece[$j], $tableQuatite[$j], $tblesemi[$j], $tblesurvi[$j], $tblerepri[$j]);
                }
            }
        }
        echo "<input type='hidden' id='echec' value=''>";
    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo "<input type='hidden' id='echec' value='$msg'>";

    }

}