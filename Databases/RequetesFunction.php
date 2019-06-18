<?php

/**
 * Created by PhpStorm.
 * User: somda
 * Date: 17/07/2018
 * Time: 21:28
 */
class RequetesFunction
{

    public function projetOperateur($region, $province, $commune, $local, $categorie, $amenage, $projet, $operateur, $annee){

        $where='';
        $and='AND';

        if($region!=''){
            if($where!=''){
                $where=$where.' '.$and.' idregion='.$region;
            }else{
                $where=$where.' idregion='.$region;
            }
        }

        if($province!=''){
            if($where!=''){
                $where=$where.' '.$and.' idprovince='.$province;
            }else {
                $where = $where . ' idprovince=' . $province;
            }
        }

        if($commune!=''){
            if($where!=''){
                $where=$where.' '.$and.' idcommune='.$commune;
            }else {
                $where = $where . ' idcommune=' . $commune;
            }
        }

        if($local!=''){
            if($where!=''){
                $where=$where.' '.$and.' idlocalite='.$local;
            }else {
                $where = $where . ' idlocalite=' . $local;
            }
        }

        if($categorie!=''){
            if($where!=''){
                $where=$where.' '.$and.' idcategorieamenagement='.$categorie;
            }else {
                $where = $where . ' idcategorieamenagement=' . $categorie;
            }
        }

        if($amenage!=''){
            if($where!=''){
                $where=$where.' '.$and.' idamenagement='.$amenage;
            }else {
                $where = $where . ' idamenagement=' . $amenage;
            }
        }

        if($projet!=''){
            if($where!=''){
                $where=$where.' '.$and.' idprojet='.$projet;
            }else {
                $where = $where . ' idprojet=' . $projet;
            }
        }

        if($operateur!=''){
            if($where!=''){
                $where=$where.' '.$and.' idoperateur='.$operateur;
            }else {
                $where = $where . ' idoperateur=' . $operateur;
            }
        }

        if($annee!=''){
            if($where!=''){
                $where=$where." ".$and." extract(year from periodedebut)=".$annee;
            }else {
                $where = $where . " extract(year from periodedebut)=".$annee;
            }
        }

        return $where;

    }

    public function bailleurOperateurprojet($region, $province, $commune, $local, $categorie, $amenage, $projet, $operateur, $annee, $idbailleur){

        $where='';
        $and='AND';

        if($region!=''){
            if($where!=''){
                $where=$where.' '.$and.' idregion='.$region;
            }else{
                $where=$where.' idregion='.$region;
            }
        }

        if($province!=''){
            if($where!=''){
                $where=$where.' '.$and.' idprovince='.$province;
            }else {
                $where = $where . ' idprovince=' . $province;
            }
        }

        if($commune!=''){
            if($where!=''){
                $where=$where.' '.$and.' idcommune='.$commune;
            }else {
                $where = $where . ' idcommune=' . $commune;
            }
        }

        if($local!=''){
            if($where!=''){
                $where=$where.' '.$and.' idlocalite='.$local;
            }else {
                $where = $where . ' idlocalite=' . $local;
            }
        }

        if($categorie!=''){
            if($where!=''){
                $where=$where.' '.$and.' idcategorieamenagement='.$categorie;
            }else {
                $where = $where . ' idcategorieamenagement=' . $categorie;
            }
        }

        if($amenage!=''){
            if($where!=''){
                $where=$where.' '.$and.' idamenagement='.$amenage;
            }else {
                $where = $where . ' idamenagement=' . $amenage;
            }
        }

        if($projet!=''){
            if($where!=''){
                $where=$where.' '.$and.' idprojet='.$projet;
            }else {
                $where = $where . ' idprojet=' . $projet;
            }
        }

        if($operateur!=''){
            if($where!=''){
                $where=$where.' '.$and.' idoperateur='.$operateur;
            }else {
                $where = $where . ' idoperateur=' . $operateur;
            }
        }

        if($annee!=''){
            if($where!=''){
                $where=$where." ".$and." anneefinancement=".$annee;
            }else {
                $where = $where . " anneefinancement=".$annee;
            }
        }

        if($idbailleur!=''){
            if($where!=''){
                $where=$where.' '.$and.' idbailleur='.$idbailleur;
            }else {
                $where = $where . ' idbailleur=' . $idbailleur;
            }
        }


        return $where;

    }

    public function RequeteAmenagement($region, $province, $commune, $local, $categorie, $amenage, $annee){

        $where='';
        $and='AND';

        if($region!=''){
            if($where!=''){
                $where=$where.' '.$and.' idregion='.$region;
            }else{
                $where=$where.' idregion='.$region;
            }
        }
        if($province!=''){
            if($where!=''){
                $where=$where.' '.$and.' idprovince='.$province;
            }else {
                $where = $where . ' idprovince=' . $province;
            }
        }
        if($commune!=''){
            if($where!=''){
                $where=$where.' '.$and.' idcommune='.$commune;
            }else {
                $where = $where . ' idcommune=' . $commune;
            }
        }
        if($local!=''){
            if($where!=''){
                $where=$where.' '.$and.' idlocalite='.$local;
            }else {
                $where = $where . ' idlocalite=' . $local;
            }
        }
        if($categorie!=''){
            if($where!=''){
                $where=$where.' '.$and.' idcategorieamenagement='.$categorie;
            }else {
                $where = $where . ' idcategorieamenagement=' . $categorie;
            }
        }
        if($amenage!=''){
            if($where!=''){
                $where=$where.' '.$and.' idamenagement='.$amenage;
            }else {
                $where = $where . ' idamenagement=' . $amenage;
            }
        }

        if($annee!=''){
            if($where!=''){
                $where=$where." ".$and." extract(year from periodedebut)=".$annee;
            }else {
                $where = $where . " extract(year from periodedebut)=".$annee;
            }
        }

        return $where;
    }

    public function ProjetMontant($bailleur, $projet){
        $where='';
        $and=' AND';
        if($bailleur!='') {
            if ($where != '') {
                $where = $where .' '.$and. ' idbailleur=' . $bailleur;
            } else {
                $where = $where . ' idbailleur=' . $bailleur;
            }
        }
        if($projet!=''){
            if($where!=''){
                $where=$where.' '.$and.' idprojet='.$projet;
            }else {
                $where = $where . ' idprojet=' . $projet;
            }
        }

        return $where;
    }

    public function OperateurMontant($bailleur, $nomOpt, $region, $province, $commune, $localite,$annee){
        $where='';
        $and=' AND';
        if($bailleur!='') {
            if ($where != '') {
                $where = $where .' '.$and. ' idbailleur=' . $bailleur;
            } else {
                $where = $where . ' idbailleur=' . $bailleur;
            }
        }
        if($nomOpt!=''){
            if($where!=''){
                $where=$where.' '.$and.' idoperateur='.$nomOpt;
            }else {
                $where = $where . ' idoperateur=' . $nomOpt;
            }
        }
        if($region!=''){
            if($where!=''){
                $where=$where.' '.$and.' idregion='.$region;
            }else {
                $where = $where . ' idregion=' . $region;
            }
        }
        if($province!=''){
            if($where!=''){
                $where=$where.' '.$and.' idprovince='.$province;
            }else {
                $where = $where . ' idprovince=' . $province;
            }
        }
        if($commune!=''){
            if($where!=''){
                $where=$where.' '.$and.' idcommune='.$commune;
            }else {
                $where = $where . ' idcommune=' . $commune;
            }
        }
        if($localite!=''){
            if($where!=''){
                $where=$where.' '.$and.' idlocalite='.$localite;
            }else {
                $where = $where . ' idlocalite=' . $localite;
            }
        }
        if($annee!=''){
            if($where!=''){
                $where=$where.' '.$and.' anneefinancement='.$annee;
            }else {
                $where = $where . ' anneefinancement=' . $annee;
            }
        }

        return $where;
    }

    public function ProjetZoneGeographique($region,$province,$commune,$terminer,$encours){
        $where='';
        $and='AND';
        $date=date('Y-m-d');

        if($region!=''){
            if($where!=''){
                $where=$where.' '.$and.' idregion='.$region;
            }else{
                $where=$where.' idregion='.$region;
            }
        }

        if($province!=''){
            if($where!=''){
                $where=$where.' '.$and.' idprovince='.$province;
            }else {
                $where = $where . ' idprovince=' . $province;
            }
        }
        if($commune!=''){
            if($where!=''){
                $where=$where.' '.$and.' idcommune='.$commune;
            }else {
                $where = $where . ' idcommune=' . $commune;
            }
        }

        if($terminer!=''){
            if($where!=''){
                $where=$where." ".$and." datefinprojet <='".$date."'";
            }else {
                $where = $where ." datefinprojet <='".$date."'";
            }
        }

        if($encours!=''){
            if($where!=''){
                $where=$where." ".$and." datefinprojet >='".$date."' AND datedebutprojet <= '".$date."'";
            }else {
                $where = $where ." datefinprojet >='".$date."' AND datedebutprojet <= '".$date."'";
            }
        }

        return $where;
    }

    public function RevenuGestionnaire($gestionnaire,$annee, $type){
        $where='';
        $and='AND';

        if($gestionnaire!=''){
            if($where!=''){
                $where=$where.' '.$and.' idgestionnaire='.$gestionnaire;
            }else{
                $where=$where.' idgestionnaire='.$gestionnaire;
            }
        }

        if($annee!=''){
            if($where!=''){
                $where=$where.' '.$and.' anneerevenuannuel='.$annee;
            }else{
                $where=$where.' anneerevenuannuel='.$annee;
            }
        }

        if($type!=''){
            if($type==1){
                $typ='individuel';
            }else{
                $typ='collectif';
            }

            if($where!=''){
                $where=$where." ".$and." typegestionnaire='".$typ."'";
            }else{
                $where=$where." typegestionnaire='".$typ."'";
            }
        }

        return $where;
    }

    public function RequeteVocation($region, $province, $commune, $local, $categorie, $vocation){

        $where='';
        $and='AND';

        if($region!=''){
            if($where!=''){
                $where=$where.' '.$and.' idregion='.$region;
            }else{
                $where=$where.' idregion='.$region;
            }
        }
        if($province!=''){
            if($where!=''){
                $where=$where.' '.$and.' idprovince='.$province;
            }else {
                $where = $where . ' idprovince=' . $province;
            }
        }
        if($commune!=''){
            if($where!=''){
                $where=$where.' '.$and.' idcommune='.$commune;
            }else {
                $where = $where . ' idcommune=' . $commune;
            }
        }
        if($local!=''){
            if($where!=''){
                $where=$where.' '.$and.' idlocalite='.$local;
            }else {
                $where = $where . ' idlocalite=' . $local;
            }
        }
        if($categorie!=''){
            if($where!=''){
                $where=$where.' '.$and.' idcategorievocation='.$categorie;
            }else {
                $where = $where . ' idcategorievocation=' . $categorie;
            }
        }
        if($vocation!=''){
            if($where!=''){
                $where=$where.' '.$and.' idvocation='.$vocation;
            }else {
                $where = $where . ' idvocation=' . $vocation;
            }
        }
        return $where;
    }

    public function requeteAppuis($region, $province, $commune, $local,$gestionnaire, $type,$projet, $operateur,$debut,$fin){
        $where='';
        $and='AND';

        if($region!=''){
            if($where!=''){
                $where=$where.' '.$and.' idregion='.$region;
            }else{
                $where=$where.' idregion='.$region;
            }
        }
        if($province!=''){
            if($where!=''){
                $where=$where.' '.$and.' idprovince='.$province;
            }else {
                $where = $where . ' idprovince=' . $province;
            }
        }
        if($commune!=''){
            if($where!=''){
                $where=$where.' '.$and.' idcommune='.$commune;
            }else {
                $where = $where . ' idcommune=' . $commune;
            }
        }
        if($local!=''){
            if($where!=''){
                $where=$where.' '.$and.' idlocalite='.$local;
            }else {
                $where = $where . ' idlocalite=' . $local;
            }
        }

        if($gestionnaire!=''){
            if($where!=''){
                $where=$where.' '.$and.' idgestionnaire='.$gestionnaire;
            }else{
                $where=$where.' idgestionnaire='.$gestionnaire;
            }
        }

        if($type!=''){
            if($type==1){
                $typ='individuel';
            }else{
                $typ='collectif';
            }

            if($where!=''){
                $where=$where." ".$and." typegestionnaire='".$typ."'";
            }else{
                $where=$where." typegestionnaire='".$typ."'";
            }
        }

        if($projet!=''){
            if($where!=''){
                $where=$where.' '.$and.' idprojet='.$projet;
            }else {
                $where = $where . ' idprojet=' . $projet;
            }
        }

        if($operateur!=''){
            if($where!=''){
                $where=$where.' '.$and.' idoperateur='.$operateur;
            }else {
                $where = $where . ' idoperateur=' . $operateur;
            }
        }

        if($debut!=''){
            if($where!=''){
                $where=$where." ".$and." datedebutappui >='".$debut."'";
            }else {
                $where = $where ." datedebutappui >='".$debut."'";
            }
        }

        if($fin!=''){
            if($where!=''){
                $where=$where." ".$and." datefinappui <= '".$fin."'";
            }else {
                $where = $where ." datefinappui <= '".$fin."'";
            }
        }

        /*if($debut!='' && $fin!=''){

        }*/

        return $where;
    }

    public function requeteAppuis2($gestionnaire, $type,$projet, $operateur,$debut,$fin,$typeappui){
        $where='';
        $and='AND';

        if($gestionnaire!=''){
            if($where!=''){
                $where=$where.' '.$and.' idgestionnaire='.$gestionnaire;
            }else{
                $where=$where.' idgestionnaire='.$gestionnaire;
            }
        }

        if($type!=''){
            if($type==1){
                $typ='individuel';
            }else{
                $typ='collectif';
            }

            if($where!=''){
                $where=$where." ".$and." typegestionnaire='".$typ."'";
            }else{
                $where=$where." typegestionnaire='".$typ."'";
            }
        }

        if($projet!=''){
            if($where!=''){
                $where=$where.' '.$and.' idprojet='.$projet;
            }else {
                $where = $where . ' idprojet=' . $projet;
            }
        }

        if($operateur!=''){
            if($where!=''){
                $where=$where.' '.$and.' idoperateur='.$operateur;
            }else {
                $where = $where . ' idoperateur=' . $operateur;
            }
        }

        if($debut!=''){
            if($where!=''){
                $where=$where." ".$and." datedebutappui >='".$debut."'";
            }else {
                $where = $where ." datedebutappui >='".$debut."'";
            }
        }

        if($fin!=''){
            if($where!=''){
                $where=$where." ".$and." datefinappui <= '".$fin."'";
            }else {
                $where = $where ." datefinappui <= '".$fin."'";
            }
        }

        if($typeappui!=''){
            if($where!=''){
                $where=$where.' '.$and.' idappui='.$typeappui;
            }else{
                $where=$where.' idappui='.$typeappui;
            }
        }

        return $where;
    }

    public function EspeceVegetalisation($region, $province, $commune, $local, $espece, $vegetalisation){

        $where='';
        $and='AND';

        if($region!=''){
            if($where!=''){
                $where=$where.' '.$and.' idregion='.$region;
            }else{
                $where=$where.' idregion='.$region;
            }
        }
        if($province!=''){
            if($where!=''){
                $where=$where.' '.$and.' idprovince='.$province;
            }else {
                $where = $where . ' idprovince=' . $province;
            }
        }
        if($commune!=''){
            if($where!=''){
                $where=$where.' '.$and.' idcommune='.$commune;
            }else {
                $where = $where . ' idcommune=' . $commune;
            }
        }
        if($local!=''){
            if($where!=''){
                $where=$where.' '.$and.' idlocalite='.$local;
            }else {
                $where = $where . ' idlocalite=' . $local;
            }
        }
        if($espece!=''){
            if($where!=''){
                $where=$where.' '.$and.' idespece='.$espece;
            }else {
                $where = $where . ' idespece=' . $espece;
            }
        }
        if($vegetalisation!=''){
            if($where!=''){
                $where=$where.' '.$and.' idvegetalisation='.$vegetalisation;
            }else {
                $where = $where . ' idvegetalisation=' . $vegetalisation;
            }
        }
        return $where;
    }
}