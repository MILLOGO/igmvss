<?php

/**
 * Created by PhpStorm.
 * User: somda
 * Date: 10/07/2018
 * Time: 15:47
 */
class Bd_GestionAmenagement
{
    public function __construct(){}

    public function RecupererValeurInfosSpec($id){
        $database=new Bd_class();
        $requet="SELECT * FROM amenagement WHERE idamenagement=$id";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $nbligne=$resultat->rowCount();
        $idmax=0;
        if($nbligne==1){
            $ligne=$resultat->fetch(PDO::FETCH_OBJ);
            $idmax=$ligne->infosspec;
        }

        $database->Close();
        return $idmax;
    }

    public function RecupererSuperficie($id){
        $database=new Bd_class();
        $requet="SELECT * FROM site WHERE idsite=$id";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $nbligne=$resultat->rowCount();
        $idmax=0;
        if($nbligne==1){
            $ligne=$resultat->fetch(PDO::FETCH_OBJ);
            $idmax=$ligne->superficiesite;
        }

        $database->Close();
        return $idmax;
    }

    public function RecupererTypeSite($id){
        $database=new Bd_class();
        $requet="SELECT * FROM site WHERE idsite=$id";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $nbligne=$resultat->rowCount();
        $idmax=0;
        if($nbligne==1){
            $ligne=$resultat->fetch(PDO::FETCH_OBJ);
            $idmax=$ligne->typemesuresite;
        }
        $database->Close();
        return $idmax;
    }

    public function RecupererIdAmenager(){
        $database=new Bd_class();
        $requet="SELECT * FROM amenager ORDER BY idamenager DESC limit 1";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $nbligne=$resultat->rowCount();
        $idmax=0;
        if($nbligne==1){
            $ligne=$resultat->fetch(PDO::FETCH_OBJ);
            $idmax=$ligne->idamenager;
        }

        $database->Close();
        return $idmax;
    }

    public function InsererAmenager($idamenagement,$idsite,$idoperateur,$superficieciblee,$periodedebut,$periodefin,$idprojet, $typesite){
        $database=new Bd_class();
        $requete="INSERT INTO amenager(idamenagement,idsite,idoperateur,superficieciblee,periodedebut,periodefin,idprojet, typemesuresite)
                  VALUES (:idamenagement,:idsite,:idoperateur,:superficieciblee,:periodedebut,:periodefin,:idprojet, :typemesuresite)";
        $valeur=array(
            "idamenagement"=>$idamenagement,
            "idsite"=>$idsite,
            "idoperateur"=>$idoperateur,
            "superficieciblee"=>$superficieciblee,
            "periodedebut"=>$periodedebut,
            "periodefin"=>$periodefin,
            "idprojet"=>$idprojet,
            "typemesuresite"=>$typesite
        );

        $database->set_Enregistrer($requete,$valeur);
    }

    public function ModifierAmenager($idamenagement,$idsite,$idoperateur,$superficieciblee,$periodedebut,$periodefin,$idprojet, $id, $typesite){
        $database=new Bd_class();
        $requete="UPDATE amenager SET idamenagement= :idamenagement,idsite= :idsite,idoperateur= :idoperateur,
                  superficieciblee= :superficieciblee,periodedebut= :periodedebut,periodefin= :periodefin,idprojet= :idprojet, typemesuresite= :typemesuresite
                  WHERE idamenager=$id";
        $valeur=array(
            "idamenagement"=>$idamenagement,
            "idsite"=>$idsite,
            "idoperateur"=>$idoperateur,
            "superficieciblee"=>$superficieciblee,
            "periodedebut"=>$periodedebut,
            "periodefin"=>$periodefin,
            "idprojet"=>$idprojet,
            "typemesuresite"=>$typesite
        );

        $database->set_Enregistrer($requete,$valeur);
    }

   /* public function InsererAmenagerSansProjet($idamenagement,$idsite,$idoperateur,$superficieciblee,$periodedebut,$periodefin){
        $database=new Bd_class();
        $requete="INSERT INTO amenager(idamenagement,idsite,idoperateur,superficieciblee,periodedebut,periodefin)
                  VALUES (:idamenagement,:idsite,:idoperateur,:superficieciblee,:periodedebut,:periodefin)";
        $valeur=array(
            "idamenagement"=>$idamenagement,
            "idsite"=>$idsite,
            "idoperateur"=>$idoperateur,
            "superficieciblee"=>$superficieciblee,
            "periodedebut"=>$periodedebut,
            "periodefin"=>$periodefin
        );

        $database->set_Enregistrer($requete,$valeur);
    }*/


    public function ModifierAmenagerSansProjet($idamenagement,$idsite,$idoperateur,$superficieciblee,$periodedebut,$periodefin, $id){
        $database=new Bd_class();
        $requete="UPDATE amenager SET idamenagement= :idamenagement,idsite= :idsite,idoperateur= :idoperateur,
                  superficieciblee= :superficieciblee,periodedebut= :periodedebut,periodefin= :periodefin WHERE idamenager=$id";
        $valeur=array(
            "idamenagement"=>$idamenagement,
            "idsite"=>$idsite,
            "idoperateur"=>$idoperateur,
            "superficieciblee"=>$superficieciblee,
            "periodedebut"=>$periodedebut,
            "periodefin"=>$periodefin
        );

        $database->set_Enregistrer($requete,$valeur);
    }


    public function InsererAmenagerEspece($idamenager,$idespece,$nbreplant,$quantitesemis,$tauxsurvie,$tauxreprise){
        $database=new Bd_class();
        $requete="INSERT INTO amenager_espece(idamenager,idespece,nbreplant,quantitesemis,tauxsurvie,tauxreprise)
                  VALUES (:idamenager,:idespece,:nbreplant,:quantitesemis,:tauxsurvie,:tauxreprise)";
        $valeur=array(
            "idamenager"=>$idamenager,
            "idespece"=>$idespece,
            "nbreplant"=>$nbreplant,
            "quantitesemis"=>$quantitesemis,
            "tauxsurvie"=>$tauxsurvie,
            "tauxreprise"=>$tauxreprise
        );

        $database->set_Enregistrer($requete,$valeur);
    }

    public function supprimeEspeceAmenager($id){
        $database=new Bd_class();
        $requete="DELETE FROM amenager_espece WHERE idamenager=$id";
        $database->set_requete($requete);
        $database->Close();
    }

    public function supprimeVegetalisationAmenager($id){
        $database=new Bd_class();
        $requete="DELETE FROM amenager_vegetalisation WHERE idamenager=$id";
        $database->set_requete($requete);
        $database->Close();
    }

    public function supprimeAmenager($id){
        $database=new Bd_class();
        $requete="DELETE FROM amenager WHERE idamenager=$id";
        $database->set_requete($requete);
        $database->Close();
    }


    public static function ListeAmenagerEspeceParIdAmenager($id){
        $database=new Bd_class();
        $selct="SELECT * FROM amenager_espece WHERE idamenager=$id";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }


    public static function ListeAmenagerVegetalisationParIdAmenager($id){
        $database=new Bd_class();
        $selct="SELECT * FROM amenager_vegetalisation WHERE idamenager=$id";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

   /* public function InsererAmenagerEspece($idamenager,$idespece,$nbreplant){
        $database=new Bd_class();
        $requete="INSERT INTO amenager_espece(idamenager,idespece,nbreplant)
                  VALUES (:idamenager,:idespece,:nbreplant)";
        $valeur=array(
            "idamenager"=>$idamenager,
            "idespece"=>$idespece,
            "nbreplant"=>$nbreplant,
        );

        $database->set_Enregistrer($requete,$valeur);
    }*/

    public function InsererAmenagerVegetation($idamenager,$idvegetalisation){
        $database=new Bd_class();
        $requete="INSERT INTO amenager_vegetalisation(idamenager,idvegetalisation)VALUES (:idamenager,:idvegetalisation)";
        $valeur=array(
            "idamenager"=>$idamenager,
            "idvegetalisation"=>$idvegetalisation
        );

        $database->set_Enregistrer($requete,$valeur);
    }

    public static function ListeAmenager(){
        $database=new Bd_class();
        $selct="SELECT * FROM vueamenager ORDER BY idamenager DESC ";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListeAmenagerSansProjet(){
        $database=new Bd_class();
        $selct="SELECT * FROM vueamenagersansprojet ORDER BY idamenager DESC ";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListeAmenagerParId($id){
        $database=new Bd_class();
        $selct="SELECT * FROM amenagerview WHERE idamenager=$id";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListeAmenagerSansProjetParId($id){
        $database=new Bd_class();
        $selct="SELECT * FROM amenagerviewsansprojet WHERE idamenager=$id";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function detailamenager($table,$id){
        $database=new Bd_class();
        $selct="SELECT * FROM $table WHERE idamenager=$id";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }


}