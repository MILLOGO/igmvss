<?php

/**
 * Created by PhpStorm.
 * User: somda
 * Date: 29/06/2018
 * Time: 00:30
 */
class Bd_parametre
{

    public function __construct(){

    }


    //partie facteur de production
    public function InsererFacteur($nomfacteur){

        $databse=new Bd_class();
        $reque="INSERT INTO facteurproduction(nomfacteurproduction)
                VALUES (:nomfacteur) ";
        $donne=array(
            'nomfacteur'=>$nomfacteur,
        );

        $databse->set_Enregistrer($reque,$donne);
    }

    public function ModifierFacteur($nomfacteur,$id){
        $databse=new Bd_class();
        $reque="UPDATE facteurproduction SET nomfacteurproduction= :nomfacteur WHERE idfacteurproduction=$id";
        $donne=array(
            'nomfacteur'=>$nomfacteur,
        );
        $databse->set_Enregistrer($reque,$donne);
    }


    public static function listerFacteur(){

        $database=new Bd_class();
        $requet="SELECT * FROM facteurproduction ORDER BY idfacteurproduction DESC";
        $database->set_requete($requet);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function listerFacteurParId($id){

        $database=new Bd_class();
        $requet="SELECT * FROM facteurproduction WHERE idfacteurproduction=$id";
        $database->set_requete($requet);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public function CompterFacteur(){
        $database=new Bd_class();
        $requet="SELECT * FROM facteurproduction";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $nbligne=$resultat->rowCount();
        $database->Close();
        return $nbligne;
    }

    public function supprimeFacteur($id){
        $database=new Bd_class();
        $requete="DELETE FROM facteurproduction WHERE idfacteurproduction=$id";
        $database->set_requete($requete);
        $database->Close();
    }
    //fin facteur de production


    //partie region
    public function InsererRegion($nomregion){
        $databse=new Bd_class();
        $reque="INSERT INTO region(nomregion) VALUES (:nomregion) ";

        $donne=array(
            'nomregion'=>$nomregion
        );

        $databse->set_Enregistrer($reque,$donne);
    }

    public function RecupererNomRegion($id){
        $database=new Bd_class();
        $requet="SELECT * FROM vueregion WHERE idregion=$id";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $ligne=$resultat->fetch(PDO::FETCH_OBJ);
        $nomregion=$ligne->nomregion;
        $database->Close();
        return $nomregion;
    }


    public static function ListeRegion(){
        $database=new Bd_class();
        $requete="SELECT * FROM vueregion ORDER BY idregion DESC ";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListeRegionParId($idregion){
        $database=new Bd_class();
        $requete="SELECT * FROM vueregion WHERE idregion=$idregion";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public function modifierRegion($id,$nomregion){
        $database=new Bd_class();
        $req="UPDATE region SET nomregion= :nomregion WHERE idregion=$id";
        $donne=array(
            'nomregion'=>$nomregion,
        );
        $database->set_Enregistrer($req,$donne);
    }

    public function supprimerRegion($id){
        $database=new Bd_class();
        $requete="DELETE FROM region WHERE idregion=$id";
        $database->set_requete($requete);
        $database->Close();
    }



    //partie de gestion des province
    public function InsererProvince($idregion,$nomprovince){
        $databse=new Bd_class();
        $reque="INSERT INTO province(idregion,nomprovince)VALUES (:idregion,:nomprovince) ";

        $donne=array(
            'idregion'=>$idregion,
            'nomprovince'=>$nomprovince
        );

        $databse->set_Enregistrer($reque,$donne);
    }

    public function ModifierProvince($id,$idregion,$nomprovince){
        $database=new Bd_class();
        $requete="UPDATE province SET nomprovince= :nomprov, idregion= :idregio WHERE idprovince=$id";
        $data=array(
            'nomprov'=>$nomprovince,
            'idregio'=>$idregion
        );
        $database->set_Enregistrer($requete,$data);
    }

    public static function ListeProvince(){
        $database=new Bd_class();
        $requete="SELECT * FROM vueprovince ORDER BY idprovince DESC";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListeProvinceParId($id){
        $database=new Bd_class();
        $requete="SELECT * FROM vueprovince WHERE idprovince=$id";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListeProvinceParRegion($id){
        $database=new Bd_class();
        $requete="SELECT * FROM vueprovince WHERE idregion=$id";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public function RecupererNomProvince($id){
        $database=new Bd_class();
        $requet="SELECT * FROM vueprovince WHERE idprovince=$id";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $ligne=$resultat->fetch(PDO::FETCH_OBJ);
        $nomprovince=$ligne->nomprovince;
        $database->Close();
        return $nomprovince;
    }

    public function RecupererIdRegion($id){
        $database=new Bd_class();
        $requet="SELECT * FROM vueprovince WHERE idprovince=$id";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $ligne=$resultat->fetch(PDO::FETCH_OBJ);
        $nomprovince=$ligne->idregion;
        $database->Close();
        return $nomprovince;
    }

    public function RecupererIdProvince($id){
        $database=new Bd_class();
        $requet="SELECT * FROM vuecommune WHERE idcommune=$id";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $ligne=$resultat->fetch(PDO::FETCH_OBJ);
        $nomprovince=$ligne->idprovince;
        $database->Close();
        return $nomprovince;
    }

    public function SupprimerProvince($id){
        $database= new Bd_class();
        $req="DELETE FROM province WHERE idprovince=$id";
        $database->set_requete($req);
    }


//partie de gestion des commune
    public function InsererCommune($idprovince,$nomcommune,$nbreh,$nbrefemme,$totalpopulation,$nbremenage){
        $databse=new Bd_class();
        $reque="INSERT INTO commune(idprovince,nomcommune,nbrehomme,nbrefemme,totalpopulation,nbremenage)
                VALUES (:idprovince,:nomcommune,:nbrehomme,:nbrefemme,:totalpopulation,:nbremenage) ";
        $donne=array(
            'idprovince'=>$idprovince,
            'nomcommune'=>$nomcommune,
            'nbrehomme'=>$nbreh,
            'nbrefemme'=>$nbrefemme,
            'totalpopulation'=>$totalpopulation,
            'nbremenage'=>$nbremenage
        );

        $databse->set_Enregistrer($reque,$donne);
    }


    public function ModifierCommune($idprovince,$nomcommune,$nbreh,$nbrefemme,$totalpopulation,$nbremenage,$id){
        $databse=new Bd_class();
        $reque="UPDATE commune SET idprovince= :idprovince,nomcommune= :nomcommune,nbrehomme= :nbrehomme,nbrefemme= :nbrefemme,
                totalpopulation= :totalpopulation,nbremenage= :nbremenage WHERE idcommune=$id";
        $donne=array(
            'idprovince'=>$idprovince,
            'nomcommune'=>$nomcommune,
            'nbrehomme'=>$nbreh,
            'nbrefemme'=>$nbrefemme,
            'totalpopulation'=>$totalpopulation,
            'nbremenage'=>$nbremenage
        );

        $databse->set_Enregistrer($reque,$donne);
    }


    public static function ListeCommune(){
        $database=new Bd_class();
        $requete="SELECT * FROM vuecommune ORDER BY idcommune DESC";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListeCommuneParId($id){
        $database=new Bd_class();
        $requete="SELECT * FROM vuecommune WHERE idcommune=$id";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public function SupprimerCommune($id){
        $database= new Bd_class();
        $req="DELETE FROM commune WHERE idcommune=$id";
        $database->set_requete($req);
    }

    public static function ListeCommuneParProvince($id){
        $database=new Bd_class();
        $requete="SELECT * FROM vuecommune WHERE idprovince=$id";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }


    public function RecupererNomCommune($id){
        $database=new Bd_class();
        $requet="SELECT * FROM vuecommune WHERE idcommune=$id";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $ligne=$resultat->fetch(PDO::FETCH_OBJ);
        $nom=$ligne->nomcommune;
        $database->Close();
        return $nom;
    }

    //partie de gestion des type d'appui

    public function InsererTypeappui($typeappui){
        $databse=new Bd_class();
        $reque="INSERT INTO appui(typeappui)
                VALUES (:typeappui) ";

        $donne=array(
            'typeappui'=>$typeappui,
        );

        $databse->set_Enregistrer($reque,$donne);
    }

    public function ModifierTypeappui($typeappui, $id){
        $databse=new Bd_class();
        $reque="UPDATE appui SET typeappui= :typeappui WHERE idappui=$id";
        $donne=array(
            'typeappui'=>$typeappui,
        );

        $databse->set_Enregistrer($reque,$donne);
    }

    public static function ListeTypeappui(){
        $database=new Bd_class();
        $requete="SELECT * FROM appui ORDER BY idappui DESC";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListeTypeappuiParId($id){
        $database=new Bd_class();
        $requete="SELECT * FROM appui WHERE idappui=$id";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public function supprimeTypeAppui($id){
        $database=new Bd_class();
        $requete="DELETE FROM appui WHERE idappui=$id";
        $database->set_requete($requete);
        $database->Close();
    }

    //partie de la gestion des espèces

    public function InsererEspece($nomespece,$description){
        $databse=new Bd_class();
        $reque="INSERT INTO espece(nomespece,descriptionespece)
                VALUES (:nomespece,:description) ";

        $donne=array(
            'nomespece'=>$nomespece,
            'description'=>$description,
        );

        $databse->set_Enregistrer($reque,$donne);
    }

    public function ModifierEspece($nomespece,$description,$id){
        $databse=new Bd_class();
        $reque="UPDATE espece SET nomespece= :nomespece, descriptionespece= :description WHERE idespece=$id";

        $donne=array(
            'nomespece'=>$nomespece,
            'description'=>$description,
        );

        $databse->set_Enregistrer($reque,$donne);
    }

    public function RecupererNomEspece($id){
        $database=new Bd_class();
        $requet="SELECT * FROM espece WHERE idespece=$id";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $ligne=$resultat->fetch(PDO::FETCH_OBJ);
        $nom=$ligne->nomespece;
        $database->Close();
        return $nom;
    }

    public function RecupererNomVegetal($id){
        $database=new Bd_class();
        $requet="SELECT * FROM vegetalisation WHERE idvegetalisation=$id";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $ligne=$resultat->fetch(PDO::FETCH_OBJ);
        $nom=$ligne->typevegetalisation;
        $database->Close();
        return $nom;
    }

    public static function ListeEspece(){
        $database=new Bd_class();
        $requete="SELECT * FROM espece ORDER BY idespece DESC ";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListeEspeceParId($id){
        $database=new Bd_class();
        $requete="SELECT * FROM espece WHERE idespece=$id";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public function supprimeEspece($id){
        $database=new Bd_class();
        $requete="DELETE FROM espece WHERE idespece=$id";
        $database->set_requete($requete);
        $database->Close();
    }


    //status foncier

    public function InsererStatusFoncier($reconnaissance,$exploitation){
        $database=new Bd_class();
        $requet="INSERT INTO statutfoncier (typereconnaissance,typeexploitation) VALUES (:reconnaissance,:exploitation)";
        $valeur=array(
            'reconnaissance'=>$reconnaissance,
            'exploitation'=>$exploitation
        );
        $database->set_Enregistrer($requet,$valeur);
    }

    public function ModifierStatusSite($reconnaissance, $expliotation, $idstatus){
        $base =new Bd_class();
        $req="UPDATE statutfoncier SET typereconnaissance= :typereconnaissance, typeexploitation= :typeexploitation WHERE idstatutfoncier=$idstatus";
        $data=array(
            "typereconnaissance"=>$reconnaissance,
            "typeexploitation"=>$expliotation
        );

        $base->set_Enregistrer($req,$data);
    }

    public static function ListeStatusFoncier(){
        $database=new Bd_class();
        $requete="SELECT * FROM statutfoncier ORDER BY idstatusfocier DESC";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public function RecupererIdStatusFoncier(){
        $database=new Bd_class();
        $requet="SELECT * FROM statutfoncier ORDER BY idstatutfoncier DESC limit 1";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $nbligne=$resultat->rowCount();
        $idmax=0;
        if($nbligne==1){
            $ligne=$resultat->fetch(PDO::FETCH_OBJ);
            $idmax=$ligne->idstatutfoncier;
        }

        $database->Close();
        return $idmax;
    }


    //categorie d'amenagement
    public function InsererCatAm($nomCatAm){
        $database=new Bd_class();
        $requet="INSERT INTO categorieamenagement(nomcategorieamenagement) VALUES (:nomcat)";
        $valeur=array(
            "nomcat"=>$nomCatAm
        );

        $database->set_Enregistrer($requet,$valeur);
    }

    public function ModifierCatAm($nomCatAm,$id){
        $database=new Bd_class();
        $requet="UPDATE categorieamenagement SET nomcategorieamenagement= :nomcat WHERE idcategorieamenagement=$id";
        $valeur=array(
            "nomcat"=>$nomCatAm
        );

        $database->set_Enregistrer($requet,$valeur);
    }

    public static function ListeCatAmenagement(){
        $database=new Bd_class();
        $requete="SELECT * FROM categorieamenagement ORDER BY idcategorieamenagement DESC";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListeCatAmenagementParId($id){
        $database=new Bd_class();
        $requete="SELECT * FROM categorieamenagement WHERE idcategorieamenagement=$id";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public function supprimerCatAmenagement($id){
        $database=new Bd_class();
        $requete="DELETE FROM categorieamenagement WHERE idcategorieamenagement=$id";
        $database->set_requete($requete);
        $database->Close();
    }

    //////////////////////////////////////////////////////sous categorie

    public static function ListeSousCatAmenagement(){
        $database=new Bd_class();
        $requete="SELECT * FROM souscategorie ORDER BY idsouscategorie DESC";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    //Amenagement
    public function InsererAmenagement($idcat,$nomAm,$sousCat,$info){
        $database=new Bd_class();
        $requete="INSERT INTO amenagement(idcategorieamenagement,nomamenagement,souscategorieamenagement,infosspec) VALUES
                  (:idcat, :nomAm, :sousCat,:infos)";
        $valeur=array(
            "idcat"=>$idcat,
            "nomAm"=>$nomAm,
            "sousCat"=>$sousCat,
            "infos"=>$info
        );

        $database->set_Enregistrer($requete,$valeur);
    }

    public function ModifierAmenagement($idcat,$nomAm,$sousCat,$info, $id){
        $database=new Bd_class();
        $requete="UPDATE amenagement SET idcategorieamenagement= :idcat,nomamenagement= :nomAm,souscategorieamenagement= :sousCat,
                infosspec= :infos WHERE idamenagement=$id";
        $valeur=array(
            "idcat"=>$idcat,
            "nomAm"=>$nomAm,
            "sousCat"=>$sousCat,
            "infos"=>$info
        );
        $database->set_Enregistrer($requete,$valeur);
    }

    public static function ListeAmenagement(){
        $database=new Bd_class();
        $requete="SELECT * FROM amenagement ORDER BY idamenagement DESC";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListeAmenagemenParId($id){
        $database=new Bd_class();
        $requete="SELECT * FROM amenagement WHERE idamenagement=$id";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public function supprimeAmenagement($id){
        $database=new Bd_class();
        $requete="DELETE FROM amenagement WHERE idamenagement=$id";
        $database->set_requete($requete);
        $database->Close();
    }


    public static function ListeAmenagementParCategorie($id){
        $database=new Bd_class();
        $requete="SELECT * FROM amenagement WHERE idcategorieamenagement=$id";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }
/////////////////////////////////////////////////////////////////////////////////////////

    public function VerifierSiAmenagementInfos($id){
        $database=new Bd_class();
        $requete="SELECT * FROM amenagement WHERE idamenagement=$id";
        $database->set_requete($requete);
        $resultat=$database->get_resultat();
        $nbligne=$resultat->rowCount();
        $valeur=0;
        if($nbligne==1){
            $ligne=$resultat->fetch(PDO::FETCH_OBJ);
            $valeur=$ligne->infosspec;
        }
        $database->Close();
        return $valeur;
    }


    public function RecupererNomCategorie($id){
        $database=new Bd_class();
        $requet="SELECT * FROM categorieamenagement WHERE idcategorieamenagement=$id";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $ligne=$resultat->fetch(PDO::FETCH_OBJ);
        $nom=$ligne->nomcategorieamenagement;
        $database->Close();
        return $nom;
    }


    //vegetalisation

    public function InsererVegetalisation($typevege,$description){
        $database=new Bd_class();
        $req="INSERT INTO vegetalisation(typevegetalisation,descriptionvegetalisation) VALUES
              (:typevege, :description)";
        $valeur=array(
            "typevege"=>$typevege,
            "description"=>$description
        );
        $database->set_Enregistrer($req,$valeur);
    }


    public function ModifierVegetalisation($typevege,$description,$id){
        $database=new Bd_class();
        $req="UPDATE vegetalisation SET typevegetalisation= :typevege,descriptionvegetalisation= :description WHERE idvegetalisation=$id";
        $valeur=array(
            "typevege"=>$typevege,
            "description"=>$description
        );

        $database->set_Enregistrer($req,$valeur);
    }


    public static function ListeVegetalisation(){
        $database=new Bd_class();
        $requete="SELECT * FROM vegetalisation ORDER BY idvegetalisation DESC";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }


    public static function ListeVegetalisationParId($id){
        $database=new Bd_class();
        $requete="SELECT * FROM vegetalisation WHERE idvegetalisation=$id";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }


    public function SupprimerVegetalisation($id){
        $database=new Bd_class();
        $req="DELETE FROM vegetalisation WHERE idvegetalisation=$id";
        $database->set_requete($req);
        $database->Close();
    }


    //localité
    public function InsererLocalite($idcom,$nomloca){
        $database=new Bd_class();
        $req="INSERT INTO localite(idcommune,nomlocalite) VALUES
              (:idcommune, :nomlocalite)";
        $valeur=array(
            "idcommune"=>$idcom,
            "nomlocalite"=>$nomloca
        );

        $database->set_Enregistrer($req,$valeur);
    }

    public function ModifierLocalite($idcom,$nomloca,$idloc){
        $database=new Bd_class();
        $req="UPDATE localite SET idcommune= :idcommune, nomlocalite= :nomlocalite WHERE idlocalite=$idloc";
        $valeur=array(
            "idcommune"=>$idcom,
            "nomlocalite"=>$nomloca
        );

        $database->set_Enregistrer($req,$valeur);
    }

    public function SupprimerLocalite($id){
        $database=new Bd_class();
        $req="DELETE FROM localite WHERE idlocalite=$id";
        $database->set_requete($req);
        $database->Close();
    }

    public static function ListeLocalite(){
        $database=new Bd_class();
        $requete="SELECT * FROM vuelocalite ORDER BY idlocalite DESC";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListeLocaliteParCommune($id){
        $database=new Bd_class();
        $requete="SELECT * FROM vuelocalite WHERE idcommune=$id";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListeLocaliteParId($id){
        $database=new Bd_class();
        $requete="SELECT * FROM vuelocalite WHERE idlocalite=$id";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }


    //categorie de vocation
    public function InsererCatVo($nomCatVo){
        $database=new Bd_class();
        $requet="INSERT INTO categorievocation(nomcategorievocation) VALUES (:nomcat)";
        $valeur=array(
            "nomcat"=>$nomCatVo
        );

        $database->set_Enregistrer($requet,$valeur);
    }

    public function ModifierCatVo($nomCatVo,$id){
        $database=new Bd_class();
        $requet="UPDATE categorievocation SET nomcategorievocation= :nomcat WHERE idcategorievocation=$id";
        $valeur=array(
            "nomcat"=>$nomCatVo
        );

        $database->set_Enregistrer($requet,$valeur);
    }

    public static function ListeCatVocation(){
        $database=new Bd_class();
        $requete="SELECT * FROM categorievocation ORDER BY idcategorievocation DESC ";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListeCatVocationParId($id){
        $database=new Bd_class();
        $requete="SELECT * FROM categorievocation WHERE idcategorievocation=$id";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public function SupprimerCatVocation($id){
        $database=new Bd_class();
        $req="DELETE FROM categorievocation WHERE idcategorievocation=$id";
        $database->set_requete($req);
        $database->Close();
    }

    public function RecupererNomCategorieVocation($id){
        $database=new Bd_class();
        $requet="SELECT * FROM categorievocation WHERE idcategorievocation=$id";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $ligne=$resultat->fetch(PDO::FETCH_OBJ);
        $nom=$ligne->nomcategorievocation;
        $database->Close();
        return $nom;
    }



    //vocation
    public function InsererVocation($idcat,$nomvca){
        $database=new Bd_class();
        $req="INSERT INTO vocation(idcategorievocation,nomvocation) VALUES
              (:idcategorievocation, :nomvocation)";
        $valeur=array(
            "idcategorievocation"=>$idcat,
            "nomvocation"=>$nomvca
        );

        $database->set_Enregistrer($req,$valeur);
    }

    public function ModifierVocation($idcat,$nomvca, $id){
        $database=new Bd_class();
        $req="UPDATE vocation SET idcategorievocation= :idcategorievocation,nomvocation=  :nomvocation WHERE idvocation=$id";
        $valeur=array(
            "idcategorievocation"=>$idcat,
            "nomvocation"=>$nomvca
        );

        $database->set_Enregistrer($req,$valeur);
    }

    public static function ListeVocation(){
        $database=new Bd_class();
        $requete="SELECT * FROM vocation ORDER BY idvocation DESC";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }


    public static function ListeVocationParId($id){
        $database=new Bd_class();
        $requete="SELECT * FROM vocation WHERE idvocation=$id";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListeVocationParCategorie($id){
        $database=new Bd_class();
        $requete="SELECT * FROM vocation WHERE idcategorievocation=$id";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public function SupprimerVocation($id){
        $database=new Bd_class();
        $req="DELETE FROM vocation WHERE idvocation=$id";
        $database->set_requete($req);
        $database->Close();
    }


    //liste exploitaion
    public static function ListeExploitation(){
        $database=new Bd_class();
        $requete="SELECT * FROM exploitation ORDER BY idexploitation DESC";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }


    public static function ListeExploitationParId($id){
        $database=new Bd_class();
        $requete="SELECT * FROM exploitation WHERE idexploitation=$id";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public function InsererExploitation($libelle){
        $databse=new Bd_class();
        $reque="INSERT INTO exploitation(libelle) VALUES (:libelle) ";

        $donne=array(
            'libelle'=>$libelle
        );

        $databse->set_Enregistrer($reque,$donne);
    }

    public function ModifierExploitation($libelle,$id){
        $databse=new Bd_class();
        $reque="UPDATE exploitation SET libelle= :libelle WHERE idexploitation=$id";

        $donne=array(
            'libelle'=>$libelle
        );

        $databse->set_Enregistrer($reque,$donne);
    }

    public function supprimerExploitation($id){
        $database=new Bd_class();
        $requete="DELETE FROM exploitation WHERE idexploitation=$id";
        $database->set_requete($requete);
        $database->Close();
    }




    //liste reconnaissance légale
    public static function ListeReconnaissance(){
        $database=new Bd_class();
        $requete="SELECT * FROM reconnaissance ORDER BY idreconnaissance DESC ";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListeReconnaissanceParId($id){
        $database=new Bd_class();
        $requete="SELECT * FROM reconnaissance WHERE idreconnaissance=$id";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public function InsererReconnait($libelle){
        $databse=new Bd_class();
        $reque="INSERT INTO reconnaissance(libelle) VALUES (:libelle) ";

        $donne=array(
            'libelle'=>$libelle
        );

        $databse->set_Enregistrer($reque,$donne);
    }

    public function ModifierReconnait($libelle,$id){
        $databse=new Bd_class();
        $reque="UPDATE reconnaissance SET libelle= :libelle WHERE idreconnaissance=$id";

        $donne=array(
            'libelle'=>$libelle
        );

        $databse->set_Enregistrer($reque,$donne);
    }

    public function supprimerReconnaissance($id){
        $database=new Bd_class();
        $requete="DELETE FROM reconnaissance WHERE idreconnaissance=$id";
        $database->set_requete($requete);
        $database->Close();
    }


    public static function listerTypeCollectif(){

        $database=new Bd_class();
        $requet="SELECT * FROM typecollectif";
        $database->set_requete($requet);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }


    public static function ListeSousCategorie(){
        $database=new Bd_class();
        $requete="SELECT * FROM souscategorie ORDER BY idsouscategorie DESC ";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListeSousCategorieParId($id){
        $database=new Bd_class();
        $requete="SELECT * FROM souscategorie WHERE idsouscategorie=$id";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public function InsererSousCategorie($libelle){
        $databse=new Bd_class();
        $reque="INSERT INTO souscategorie(libelle) VALUES (:libelle) ";

        $donne=array(
            'libelle'=>$libelle
        );

        $databse->set_Enregistrer($reque,$donne);
    }

    public function ModifierSousCategorie($libelle,$id){
        $databse=new Bd_class();
        $reque="UPDATE souscategorie SET libelle= :libelle WHERE idsouscategorie=$id";

        $donne=array(
            'libelle'=>$libelle
        );

        $databse->set_Enregistrer($reque,$donne);
    }

    public function supprimerSousCategorie($id){
        $database=new Bd_class();
        $requete="DELETE FROM souscategorie WHERE idsouscategorie=$id";
        $database->set_requete($requete);
        $database->Close();
    }


    public function ChercherDansBD($from,$where)
    {
        $database = new Bd_class();
        $requet = "SELECT * FROM $from WHERE $where limit 1";
        $database->set_requete($requet);
        $resultat = $database->get_resultat();
        $nbligne = $resultat->rowCount();
        $database->Close();
        return $nbligne;
    }



//gestion des types du collectif

    public function InsererTypeCollectif($libelle){
        $database=new Bd_class();
        $requet="INSERT INTO typecollectif(libelle) VALUES (:libelle)";
        $valeur=array(
            "libelle"=>$libelle
        );

        $database->set_Enregistrer($requet,$valeur);
    }

    public function ModifierTypeCollectif($libelle,$id){
        $database=new Bd_class();
        $requet="UPDATE typecollectif SET libelle= :libelle WHERE idtype=$id";
        $valeur=array(
            "libelle"=>$libelle
        );

        $database->set_Enregistrer($requet,$valeur);
    }

    public static function ListeTypeCollectif(){
        $database=new Bd_class();
        $requete="SELECT * FROM typecollectif ORDER BY idtype DESC";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListeTypeCollectifParId($id){
        $database=new Bd_class();
        $requete="SELECT * FROM typecollectif WHERE idtype=$id";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public function supprimerTypeCollectif($id){
        $database=new Bd_class();
        $requete="DELETE FROM typecollectif WHERE idtype=$id";
        $database->set_requete($requete);
        $database->Close();
    }


    public function RecupererLibelleTypecollectif($id){
        $database=new Bd_class();
        $requet="SELECT * FROM typecollectif WHERE idtype=$id";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $ligne=$resultat->fetch(PDO::FETCH_OBJ);
        $nomregion=$ligne->libelle;
        $database->Close();
        return $nomregion;
    }


}