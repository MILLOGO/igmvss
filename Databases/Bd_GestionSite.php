<?php

/**
 * Created by PhpStorm.
 * User: somda
 * Date: 04/07/2018
 * Time: 11:42
 */
class Bd_GestionSite
{

    public function __construct(){

    }
    //collecteur
    public function InsererCollecteur($nomcollecteur,$prenomcollecteur,$fonctioncollecteur,$numcollecteur,$emailcollecteur){
        $database=new Bd_class();
        $req="INSERT INTO collecteur(nomcollecteur,prenomcollecteur,fonctioncollecteur,numcollecteur, emailcollecteur) VALUES(:nomcollecteur,:prenomcollecteur,:fonctioncollecteur,:numcollecteur,:emailcollecteur)";
        $data=array(
            'nomcollecteur'=>$nomcollecteur,
            'prenomcollecteur'=>$prenomcollecteur,
            'fonctioncollecteur'=>$fonctioncollecteur,
            'numcollecteur'=>$numcollecteur,
            'emailcollecteur'=>$emailcollecteur
        );
        $database->set_Enregistrer($req,$data);
    }

    public function ModifierCollecteur($nomcollecteur,$prenomcollecteur,$fonctioncollecteur,$numcollecteur,$emailcollecteur, $id){
        $database=new Bd_class();
        $req="UPDATE collecteur SET nomcollecteur= :nom, prenomcollecteur= :prenom, fonctioncollecteur= :fonction, numcollecteur= :num, emailcollecteur= :email WHERE idcollecteur=$id";
        $data=array(
            'nom'=>$nomcollecteur,
            'prenom'=>$prenomcollecteur,
            'fonction'=>$fonctioncollecteur,
            'num'=>$numcollecteur,
            'email'=>$emailcollecteur
        );
        $database->set_Enregistrer($req,$data);
    }

    public static function ListerTousCollecteur(){
        $database=new Bd_class();
        $requete="SELECT * FROM collecteur ORDER BY idcollecteur DESC";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListerCollecteurParID($id){
        $database=new Bd_class();
        $requete="SELECT * FROM collecteur WHERE idcollecteur=$id";
        $database->set_requete($requete);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public function supprimerCollecteur($id){
        $database=new Bd_class();
        $requet="DELETE FROM collecteur WHERE idcollecteur=$id";
        $database->set_requete($requet);
        $database->Close();
    }

    //gestionnaire

    /*public function InsererGestionnaire($nomgestionnaire,$prenomgestionnaire,$numgestionnaire,$emailgestionnaire,$type){
        $database=new Bd_class();
        $requet="INSERT INTO gestionnaire(nomgestionnaire,prenomgestionnaire,numgestionnaire,emailgestionnaire,typegestionnaire)
                 VALUES(:nomgestionnaire,:prenomgestionnaire,:numgestionnaire,:emailgestionnaire, :typegestionnaire)";
        $donnee=array(
            'nomgestionnaire'=>$nomgestionnaire,
            'prenomgestionnaire'=>$prenomgestionnaire,
            'numgestionnaire'=>$numgestionnaire,
            'emailgestionnaire'=>$emailgestionnaire,
            'typegestionnaire'=>$type
        );

        $database->set_Enregistrer($requet,$donnee);
    }*/

    //insertion d'un gestionnaire de type individuel
    public function InsererGestionnaire($nomgestionnaire,$prenomgestionnaire,$numgestionnaire,$emailgestionnaire,$type,
                                        $datenaissance,$sexe,$nbrepers,$nbremoins){
        $database=new Bd_class();
        $requet="INSERT INTO gestionnaire(nomgestionnaire,prenomgestionnaire,numgestionnaire,emailgestionnaire,typegestionnaire,
                datenaissance,sexe,nbrepersonnemenage,nbrepersonnemoinsseizeans)
                 VALUES(:nomgestionnaire,:prenomgestionnaire,:numgestionnaire,:emailgestionnaire, :typegestionnaire,:datenaissance,:sexe,:nbrepers,:nbremoinsseize
                )";
        $donnee=array(
            'nomgestionnaire'=>$nomgestionnaire,
            'prenomgestionnaire'=>$prenomgestionnaire,
            'numgestionnaire'=>$numgestionnaire,
            'emailgestionnaire'=>$emailgestionnaire,
            'typegestionnaire'=>$type,
            'datenaissance'=>$datenaissance,
            'sexe'=>$sexe,
            'nbrepers'=>$nbrepers,
            'nbremoinsseize'=>$nbremoins
        );

        $database->set_Enregistrer($requet,$donnee);
    }

    public function ModifierGestionnaireInd($nomgestionnaire,$prenomgestionnaire,$numgestionnaire,$emailgestionnaire,$type,
                                        $datenaissance,$sexe,$nbrepers,$nbremoins, $id){
        $database=new Bd_class();
        $requet="UPDATE gestionnaire SET nomgestionnaire= :nomgestionnaire,prenomgestionnaire= :prenomgestionnaire,numgestionnaire= :numgestionnaire,
                  emailgestionnaire= :emailgestionnaire,typegestionnaire=  :typegestionnaire,datenaissance= :datenaissance,sexe= :sexe,
                  nbrepersonnemenage= :nbrepers,nbrepersonnemoinsseizeans= :nbremoinsseize WHERE idgestionnaire=$id";
        $donnee=array(
            'nomgestionnaire'=>$nomgestionnaire,
            'prenomgestionnaire'=>$prenomgestionnaire,
            'numgestionnaire'=>$numgestionnaire,
            'emailgestionnaire'=>$emailgestionnaire,
            'typegestionnaire'=>$type,
            'datenaissance'=>$datenaissance,
            'sexe'=>$sexe,
            'nbrepers'=>$nbrepers,
            'nbremoinsseize'=>$nbremoins
        );

        $database->set_Enregistrer($requet,$donnee);
    }

//insert d'un gestionnaire de type collectif
    public function InsererGestionnaireC($nomgestionnaire,$prenomgestionnaire,$numgestionnaire,$emailgestionnaire,$type,
                                        $nomcollectif,$genre,$typecollectif,$nbremembre){
        $database=new Bd_class();
        $requet="INSERT INTO gestionnaire(nomgestionnaire,prenomgestionnaire,numgestionnaire,emailgestionnaire,typegestionnaire,
                nomcollectif,genrecollectif,typecollectif,nbremembrecollectif)
                 VALUES(:nomgestionnaire,:prenomgestionnaire,:numgestionnaire,:emailgestionnaire, :typegestionnaire,
                 :nomcollectif,:genre,:typecollectif,:nombremembre)";
        $donnee=array(
            'nomgestionnaire'=>$nomgestionnaire,
            'prenomgestionnaire'=>$prenomgestionnaire,
            'numgestionnaire'=>$numgestionnaire,
            'emailgestionnaire'=>$emailgestionnaire,
            'typegestionnaire'=>$type,
            'nomcollectif'=>$nomcollectif,
            'genre'=>$genre,
            'typecollectif'=>$typecollectif,
            'nombremembre'=>$nbremembre
        );

        $database->set_Enregistrer($requet,$donnee);
    }

    public function ModifierGestionnaireC($nomgestionnaire,$prenomgestionnaire,$numgestionnaire,$emailgestionnaire,$type,
                                         $nomcollectif,$genre,$typecollectif,$nbremembre, $id){
        $database=new Bd_class();
        $requet="UPDATE gestionnaire SET nomgestionnaire= :nomgestionnaire,prenomgestionnaire= :prenomgestionnaire,numgestionnaire= :numgestionnaire,
                emailgestionnaire= :emailgestionnaire,typegestionnaire=  :typegestionnaire,nomcollectif= :nomcollectif,genrecollectif= :genre,
                typecollectif= :typecollectif,nbremembrecollectif= :nombremembre WHERE idgestionnaire=$id";
        $donnee=array(
            'nomgestionnaire'=>$nomgestionnaire,
            'prenomgestionnaire'=>$prenomgestionnaire,
            'numgestionnaire'=>$numgestionnaire,
            'emailgestionnaire'=>$emailgestionnaire,
            'typegestionnaire'=>$type,
            'nomcollectif'=>$nomcollectif,
            'genre'=>$genre,
            'typecollectif'=>$typecollectif,
            'nombremembre'=>$nbremembre
        );

        $database->set_Enregistrer($requet,$donnee);
    }


    //insertion des facteurs de production du gestionnaire
    public function InsererFacteur($idgestionnaire, $idfacteur){
        $database=new Bd_class();
        $req="INSERT INTO posseder_gestionnaire_facteurproduction(idgestionnaire, idfacteurproduction) VALUES (:idges,:idfact)";
        $data=array(
            'idges'=>$idgestionnaire,
            'idfact'=>$idfacteur
        );

        $database->set_Enregistrer($req,$data);
    }

    public function supprimerFacteurParGestionnaire($id){
        $database=new Bd_class();
        $requet="DELETE FROM posseder_gestionnaire_facteurproduction WHERE idgestionnaire=$id";
        $database->set_requete($requet);
        $database->Close();
    }

    public function supprimerGestionnaire($id){
        $database=new Bd_class();
        $requet="DELETE FROM gestionnaire WHERE idgestionnaire=$id";
        $database->set_requete($requet);
        $database->Close();
    }

    public function RecupererID(){
        $database=new Bd_class();
        $requet="SELECT * FROM gestionnaire ORDER BY idgestionnaire DESC limit 1";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $nbligne=$resultat->rowCount();
        $idmax=0;
        if($nbligne==1){
            $ligne=$resultat->fetch(PDO::FETCH_OBJ);
            $idmax=$ligne->idgestionnaire;
        }

        $database->Close();
        return $idmax;
    }

    public function RecupererTypeGest($id){
        $database=new Bd_class();
        $requet="SELECT * FROM gestionnaire WHERE idgestionnaire=$id";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $nbligne=$resultat->rowCount();
        $type='';
        if($nbligne==1){
            $ligne=$resultat->fetch(PDO::FETCH_OBJ);
            $type=$ligne->typegestionnaire;
        }

        $database->Close();
        return $type;
    }

    //lister tous les gestionnaires
    public static function ListerTousGestionnaire(){
        $database=new Bd_class();
        $selct="SELECT * FROM gestionnaire ORDER BY idgestionnaire DESC";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }


    public static function GestionnaireParId($id){
        $database=new Bd_class();
        $selct="SELECT * FROM gestionnaire WHERE idgestionnaire=$id";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function GestionnaireIndividuelParId($id){
        $database=new Bd_class();
        $selct="SELECT * FROM vuegestionnaireindividuel WHERE idgestionnaire=$id";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function GestionnaireCollectifParId($id){
        $database=new Bd_class();
        $selct="SELECT * FROM vuegestionnairecollectif WHERE idgestionnaire=$id";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function GestionnaireIndividuel(){
        $database=new Bd_class();
        $selct="SELECT * FROM vuegestionnaireindividuel WHERE idgestionnaire IN (SELECT idgestionnaire FROM site) ";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function GestionnaireCollectif(){
        $database=new Bd_class();
        $selct="SELECT * FROM vuegestionnairecollectif WHERE idgestionnaire IN (SELECT idgestionnaire FROM site)";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }


   /* public static function ListerGestionnaireEnFct($typegest){
        $database=new Bd_class();
        $selct="SELECT * FROM gestionnaire WHERE typegestionnaire='$typegest' ";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }*/

    public static function ListerGestionnaireEnFct($typegest){
        $database=new Bd_class();
        $selct="SELECT * FROM gestionnaire WHERE typegestionnaire='$typegest' AND idgestionnaire IN (SELECT idgestionnaire FROM site )";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListerGestionnaireFacteurParIdGest($id){
        $database=new Bd_class();
        $selct="SELECT * FROM facteurpargestionnaire WHERE idgestionnaire=$id";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }


    //partie gestionnaire opérateur appui
    public function InsererGestionnaireOperateurAppui($idoperateur,$idappui,$idgestionnaire,$datedebutappui,$datefinappui,$nbrebeneficiaire,$descriptionappui,$exploitationpfnl){
        $base=new Bd_class();
        $requete="INSERT INTO recevoir_appui_gest_op(idoperateur,idappui,idgestionnaire,datedebutappui,datefinappui,nbrebeneficiaire,descriptionappui,exploitationpfnl)
                  values(:idoperateur, :idappui, :idgestionnaire, :datedebutappui, :datefinappui, :nbrebeneficiaire, :descriptionappui, :exploitationpfnl)";
        $data=array(
            "idoperateur"=>$idoperateur,
            "idappui"=>$idappui,
            "idgestionnaire"=>$idgestionnaire,
            "datedebutappui"=>$datedebutappui,
            "datefinappui"=>$datefinappui,
            "nbrebeneficiaire"=>$nbrebeneficiaire,
            "descriptionappui"=>$descriptionappui,
            "exploitationpfnl"=>$exploitationpfnl
        );
        $base->set_Enregistrer($requete,$data);
    }

    public function InsererGestionnaireOperateurAppuiAvecProjet($idoperateur,$idappui,$idgestionnaire,$datedebutappui,$datefinappui,$nbrebeneficiaire,$descriptionappui,$exploitationpfnl,$idprojet){
        $base=new Bd_class();
        $requete="INSERT INTO recevoir_appui_gest_op(idoperateur,idappui,idgestionnaire,datedebutappui,datefinappui,nbrebeneficiaire,descriptionappui,exploitationpfnl, idprojet)
                  values(:idoperateur, :idappui, :idgestionnaire, :datedebutappui, :datefinappui, :nbrebeneficiaire, :descriptionappui, :exploitationpfnl,:idprojet)";
        $data=array(
            "idoperateur"=>$idoperateur,
            "idappui"=>$idappui,
            "idgestionnaire"=>$idgestionnaire,
            "datedebutappui"=>$datedebutappui,
            "datefinappui"=>$datefinappui,
            "nbrebeneficiaire"=>$nbrebeneficiaire,
            "descriptionappui"=>$descriptionappui,
            "exploitationpfnl"=>$exploitationpfnl,
            "idprojet"=>$idprojet
        );
        $base->set_Enregistrer($requete,$data);
    }

    public function ModifierGestionnaireOperateurAppuiAvecProjet($idoperateur,$idappui,$idgestionnaire,$datedebutappui,$datefinappui,
                                                                 $nbrebeneficiaire,$descriptionappui,$exploitationpfnl,$idprojet, $id){
        $base=new Bd_class();
        $requete="UPDATE recevoir_appui_gest_op SET idoperateur= :idoperateur, idappui= :idappui,idgestionnaire= :idgestionnaire,
                  datedebutappui= :datedebutappui, datefinappui= :datefinappui, nbrebeneficiaire= :nbrebeneficiaire,
                  descriptionappui= :descriptionappui, exploitationpfnl= :exploitationpfnl, idprojet= :idprojet WHERE idappuigestop=$id";
        $data=array(
            "idoperateur"=>$idoperateur,
            "idappui"=>$idappui,
            "idgestionnaire"=>$idgestionnaire,
            "datedebutappui"=>$datedebutappui,
            "datefinappui"=>$datefinappui,
            "nbrebeneficiaire"=>$nbrebeneficiaire,
            "descriptionappui"=>$descriptionappui,
            "exploitationpfnl"=>$exploitationpfnl,
            "idprojet"=>$idprojet
        );
        $base->set_Enregistrer($requete,$data);
    }

    public function ModifierGestionnaireOperateurAppuiSansProjet($idoperateur,$idappui,$idgestionnaire,$datedebutappui,$datefinappui,
                                                                 $nbrebeneficiaire,$descriptionappui,$exploitationpfnl, $id){
        $base=new Bd_class();
        $requete="UPDATE recevoir_appui_gest_op SET idoperateur= :idoperateur,idappui= :idappui,idgestionnaire= :idgestionnaire,
                  datedebutappui= :datedebutappui,datefinappui= :datefinappui,nbrebeneficiaire= :nbrebeneficiaire,
                  descriptionappui= :descriptionappui, exploitationpfnl= :exploitationpfnl WHERE idappuigestop=$id";
        $data=array(
            "idoperateur"=>$idoperateur,
            "idappui"=>$idappui,
            "idgestionnaire"=>$idgestionnaire,
            "datedebutappui"=>$datedebutappui,
            "datefinappui"=>$datefinappui,
            "nbrebeneficiaire"=>$nbrebeneficiaire,
            "descriptionappui"=>$descriptionappui,
            "exploitationpfnl"=>$exploitationpfnl
        );
        $base->set_Enregistrer($requete,$data);
    }

    public function supprimerGestionnaireOperateurAppui($id){
        $database=new Bd_class();
        $requet="DELETE FROM recevoir_appui_gest_op WHERE idappuigestop=$id";
        $database->set_requete($requet);
        $database->Close();
    }
    //gestion de site
    public function InsererSite($idgestionnaire,$idstatutfoncier,$idvocation,$nomsite,$superficiesite,$typesite, $typegeom,$idlocalite){
        $base=new Bd_class();
        $requete="INSERT INTO site(idgestionnaire,idlocalite,idstatutfoncier,idvocation,nomsite,superficiesite,typemesuresite, typegeom)
                  values(:idgestionnaire,:idlocalite, :idstatutfoncier, :idvocation, :nomsite, :superficiesite, :typemesuresite, :typegeom)";
        $data=array(
            "idgestionnaire"=>$idgestionnaire,
            "idlocalite"=>$idlocalite,
            "idstatutfoncier"=>$idstatutfoncier,
            "idvocation"=>$idvocation,
            "nomsite"=>$nomsite,
            "superficiesite"=>$superficiesite,
            "typemesuresite"=>$typesite,
            "typegeom"=>$typegeom
        );

        $base->set_Enregistrer($requete,$data);
    }


    public function ModifierSite($nomsite,$superficiesite,$idgestionnaire, $idvocation, $idsite, $typesite, $typegeom,$idlocalite){
        $base=new Bd_class();
        $requete="UPDATE site SET nomsite= :nomsit, superficiesite= :superficiesit, idgestionnaire= :idgestionnair, idlocalite= :idlocalite, idvocation= :idvocatio, typemesuresite= :typemesuresite, typegeom= :typegeom WHERE idsite=$idsite";
        $data=array(
            "nomsit"=>$nomsite,
            "superficiesit"=>$superficiesite,
            "idgestionnair"=>$idgestionnaire,
            "idlocalite"=>$idlocalite,
            "idvocatio"=>$idvocation,
            "typemesuresite"=>$typesite,
            "typegeom"=>$typegeom
        );
        $base->set_Enregistrer($requete,$data);
    }


    public static function ListeSite(){
        $database=new Bd_class();
        $selct="SELECT * FROM vuesitelocalitestatusgestionnaireplus ORDER BY idsite DESC ";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }


    public static function ListeRSite(){
        $database=new Bd_class();
        $selct="SELECT * FROM vuesite ORDER BY idsite DESC ";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListerSiteParId($id){
        $database=new Bd_class();
        $selct="SELECT * FROM vuesitelocalitestatusgestionnaireplus WHERE idsite=$id";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListerSiteParLocalite($id){
        $database=new Bd_class();
        $selct="SELECT * FROM vuesite WHERE idlocalite=$id";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }


    public function RecupererIdSite(){
        $database=new Bd_class();
        $requet="SELECT * FROM site ORDER BY idsite DESC limit 1";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $nbligne=$resultat->rowCount();
        $idmax=0;
        if($nbligne==1){
            $ligne=$resultat->fetch(PDO::FETCH_OBJ);
            $idmax=$ligne->idsite;
        }

        $database->Close();
        return $idmax;
    }

    public function InsererSituerSiteLocalite($idlocalite,$idsite){
        $database= new Bd_class();
        $requete="INSERT INTO situer_site_localite (idlocalite,idsite) VALUES (:idlocalite,:idsite)";
        $valeur=array(
            "idlocalite"=>$idlocalite,
            "idsite"=>$idsite
        );

        $database->set_Enregistrer($requete,$valeur);
    }

    public function supprimerSite($id){
        $database=new Bd_class();
        $requet="DELETE FROM site WHERE idsite=$id";
        $database->set_requete($requet);
        $database->Close();
    }

    public function supprimerSiteDansSituerSiteLocalite($id){
        $database=new Bd_class();
        $requet="DELETE FROM situer_site_localite WHERE idsite=$id";
        $database->set_requete($requet);
        $database->Close();
    }


    //revenu annuel

    public function InsererRevenuAnnuel($idgestionnaire,$montant, $annee){
        $database= new Bd_class();
        $requete="INSERT INTO revenuannuel(idgestionnaire, montantrevenuannuel, anneerevenuannuel) VALUES (:idges,:montant,:annee)";
        $valeur=array(
            "idges"=>$idgestionnaire,
            "montant"=>$montant,
            "annee"=>$annee
        );

        $database->set_Enregistrer($requete,$valeur);
    }

    public function ModifierRevenuAnnuel($idgestionnaire,$montant, $annee,$id){
        $database= new Bd_class();
        $requete="UPDATE revenuannuel SET idgestionnaire= :idges, montantrevenuannuel= :montant, anneerevenuannuel= :annee WHERE idrevenuannuel=$id";
        $valeur=array(
            "idges"=>$idgestionnaire,
            "montant"=>$montant,
            "annee"=>$annee
        );

        $database->set_Enregistrer($requete,$valeur);
    }

    public static function ListeRevenu(){
        $database=new Bd_class();
        $selct="SELECT * FROM Vuerevenuannuelgestionnaire ORDER BY idrevenuannuel DESC ";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }


    public static function ListeRevenuParId($id){
        $database=new Bd_class();
        $selct="SELECT * FROM Vuerevenuannuelgestionnaire WHERE idrevenuannuel=$id";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public function supprimerRevenu($id){
        $database=new Bd_class();
        $requet="DELETE FROM revenuannuel WHERE idrevenuannuel=$id";
        $database->set_requete($requet);
        $database->Close();
    }


    ////////////////////////////////////////////////collection site//////////////////////

    public function InsererCollection($idcollecteur,$idsite,$dateobservation,$numerofiche){
        $database= new Bd_class();
        $requete="INSERT INTO observer_collecteur_site(idcollecteur, idsite, dateobservation,numerofiche) VALUES (:idcollecteur,:idsite,:dateobservation,:numerofiche)";
        $valeur=array(
            "idcollecteur"=>$idcollecteur,
            "idsite"=>$idsite,
            "dateobservation"=>$dateobservation,
            "numerofiche"=>$numerofiche
        );

        $database->set_Enregistrer($requete,$valeur);
    }


    public function ModifierCollection($idcollecteur,$idsite,$dateobservation,$numerofiche, $id){
        $database= new Bd_class();
        $requete="UPDATE observer_collecteur_site SET idcollecteur= :idcollecteur, idsite= :idsite, dateobservation= :dateobservation,numerofiche= :numerofiche WHERE idcollecteursite=$id";
        $valeur=array(
            "idcollecteur"=>$idcollecteur,
            "idsite"=>$idsite,
            "dateobservation"=>$dateobservation,
            "numerofiche"=>$numerofiche
        );

        $database->set_Enregistrer($requete,$valeur);
    }


    public static function ListeCollection(){
        $database=new Bd_class();
        $selct="SELECT * FROM vuecollection order by idcollecteursite DESC ";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }


    public static function ObserverSite($id){
        $database=new Bd_class();
        $selct="SELECT * FROM observersite WHERE idcollecteursite=$id";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public function supprimerCollection($id){
        $database=new Bd_class();
        $requet="DELETE FROM observer_collecteur_site WHERE idcollecteursite=$id";
        $database->set_requete($requet);
        $database->Close();
    }

    /////////////////////////////////////////////////////////// Operateur gestionnaire appui

    public static function ListerOperateurGestionnaireAppui(){
        $database=new Bd_class();
        $req="SELECT * FROM vueoperateurgestionnaireappui ORDER BY idappuigestop DESC ";
        $database->set_requete($req);
        $table=$database->return_table();
        $database->Close();
        return $table;

    }

    public static function ListerOperateurGestionnaireAppuiParId($id){
        $database=new Bd_class();
        $req="SELECT * FROM appuigestop  WHERE idappuigestop=$id";
        $database->set_requete($req);
        $table=$database->return_table();
        $database->Close();
        return $table;

    }


    public static function ListeGestOpParId($id){
        $database=new Bd_class();
        $req="SELECT * FROM vueoperateurgestionnaireappui WHERE idappuigestop=$id";
        $database->set_requete($req);
        $table=$database->return_table();
        $database->Close();
        return $table;

    }

    public function RecupererNomProjet($id){
        $database=new Bd_class();
        $requet="SELECT * FROM recevoir_appui_gest_op WHERE idappuigestop=$id";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $ligne=$resultat->fetch(PDO::FETCH_OBJ);
        $idprojet=$ligne->idprojet;
        $requet2="SELECT * FROM projet WHERE idprojet=$idprojet";
        $database->set_requete($requet2);
        $resultat=$database->get_resultat();
        $ligne=$resultat->fetch(PDO::FETCH_OBJ);
        $nomprojet=$ligne->nomprojet;
        $database->Close();
        return $nomprojet;
    }

    public function RecupererNomProjetRequeteAppui($id){
        $database=new Bd_class();
        $requet2="SELECT * FROM projet WHERE idprojet=$id";
        $database->set_requete($requet2);
        $resultat=$database->get_resultat();
        $ligne=$resultat->fetch(PDO::FETCH_OBJ);
        $nomprojet=$ligne->nomprojet;
        $database->Close();
        return $nomprojet;
    }
/*
    public function RecupererNomSiteRequeteAppui($id){
        $database=new Bd_class();
        $requet2="SELECT * FROM site WHERE idgestionnaire=$id";
        $database->set_requete($requet2);
        $resultat=$database->get_resultat();
        $ligne=$resultat->fetch(PDO::FETCH_OBJ);
        $nomprojet=$ligne->nomsite;
        $database->Close();
        return $nomprojet;
    }*/
   /* public function RecupererDescription($id){
        $database=new Bd_class();
        $requet="SELECT * FROM recevoir_appui_gest_op WHERE idappuigestop=$id";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $nbligne=$resultat->rowCount();
        $descrip='';
        if($nbligne==1){
            $ligne=$resultat->fetch(PDO::FETCH_OBJ);
            $descrip=$ligne->descriptionappui;
        }

        $database->Close();
        return $descrip;
    }*/


    ////////////////////////////////

    public static function ChercherGestIndParCritere($critere){
        $database=new Bd_class();
        $req="SELECT * FROM gestionnaire WHERE UPPER(nomgestionnaire) LIKE UPPER ('%$critere%') OR UPPER (prenomgestionnaire) LIKE UPPER ('%$critere%') AND typegestionnaire='individuel'";
        $database->set_requete($req);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }


    public static function ChercherGestParCritere($critere){
        $database=new Bd_class();
        $req="SELECT * FROM gestionnaire WHERE UPPER(nomgestionnaire) LIKE UPPER ('%$critere%') OR UPPER (prenomgestionnaire) LIKE UPPER ('%$critere%')";
        $database->set_requete($req);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }



    public static function ChercherGestCollectParCritere($critere){
        $database=new Bd_class();
        $req="SELECT * FROM gestionnaire WHERE UPPER(nomgestionnaire) LIKE UPPER ('%$critere%') OR UPPER (prenomgestionnaire) LIKE UPPER ('%$critere%')
              OR UPPER (nomcollectif) LIKE UPPER ('%$critere%') AND typegestionnaire='collectif'";
        $database->set_requete($req);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }


    public function RecupererIdSituer($idlocalite,$idsite){
        $database=new Bd_class();
        $requet="SELECT * FROM situer_site_localite WHERE idlocalite=$idlocalite AND idsite=$idsite";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $nbligne=$resultat->rowCount();
        $idsituer='';
        if($nbligne==1){
            $ligne=$resultat->fetch(PDO::FETCH_OBJ);
            $idsituer=$ligne->idsitelocalite;
        }

        $database->Close();
        return $idsituer;
    }


    public function ModifierSituerSite($idsite,$idlocalite){
        $database=new Bd_class();
        $requete="UPDATE situer_site_localite SET idlocalite=$idlocalite WHERE  idsite=$idsite";
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

}