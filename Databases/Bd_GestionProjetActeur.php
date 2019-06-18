<?php

/**
 * Created by PhpStorm.
 * User: somda
 * Date: 02/07/2018
 * Time: 18:25
 */
class Bd_GestionProjetActeur
{

    public  function  __construct(){

    }

    //gestion des bailleurs
//fonction pour inserer un nouveau bailleur dans la base de données
    public function InsererBailleur($nombailleur,$nomcontactbailleur,$prenomcontactbailleur,$numcontactbailleur,$emailcontactbailleur,$descriptionbailleur){
        $database=new Bd_class();
        $req="INSERT INTO bailleur(nombailleur, nomcontactbailleur, prenomcontactbailleur, numcontactbailleur, emailcontactbailleur, descriptionbailleur)
              VALUES (:nombailleur,:nomcontactbailleur,:prenomcontactbailleur,:numcontactbailleur,:emailcontactbailleur,:descriptionbailleur)";
        $data=array(
            'nombailleur'=>$nombailleur,
            'nomcontactbailleur'=>$nomcontactbailleur,
            'prenomcontactbailleur'=>$prenomcontactbailleur,
            'numcontactbailleur'=>$numcontactbailleur,
            'emailcontactbailleur'=>$emailcontactbailleur,
            'descriptionbailleur'=>$descriptionbailleur
        );
        $database->set_Enregistrer($req,$data);
    }

    public static function ListeTousBailleur(){
        $database=new Bd_class();
        $req="SELECT * FROM bailleur ORDER BY idbailleur DESC";
        $database->set_requete($req);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListeBailleurParId($id){
        $database=new Bd_class();
        $req="SELECT * FROM bailleur WHERE idbailleur=$id";
        $database->set_requete($req);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public function modifierBailleur($nombailleur,$nomcontactbailleur,$prenomcontactbailleur,$numcontactbailleur,$emailcontactbailleur,$descriptionbailleur,$id){

        $database=new Bd_class();
        $req="UPDATE  bailleur SET nombailleur= :nombailleur, nomcontactbailleur= :nomcontactbailleur, prenomcontactbailleur= :prenomcontactbailleur,
                    numcontactbailleur= :numcontactbailleur, emailcontactbailleur= :emailcontactbailleur, descriptionbailleur= :descriptionbailleur
                    WHERE idbailleur=$id";
        $data=array(
            'nombailleur'=>$nombailleur,
            'nomcontactbailleur'=>$nomcontactbailleur,
            'prenomcontactbailleur'=>$prenomcontactbailleur,
            'numcontactbailleur'=>$numcontactbailleur,
            'emailcontactbailleur'=>$emailcontactbailleur,
            'descriptionbailleur'=>$descriptionbailleur
        );
        $database->set_Enregistrer($req,$data);
    }

    public function supprimerBailleur($id){

        $database=new Bd_class();
        $requete="DELETE FROM bailleur WHERE idbailleur=$id";
        $database->set_requete($requete);
        $database->Close();
    }


    //Gestion des projets
    //function d'ajout d'un nouveau projet
    public function InsererProjet($nomprojet,$budjetglobalprojet,$datedebutprojet,$datefinprojet,$nomcontactprojet,$prenomcontactprojet,$numcontactprojet,$emailcontactprojet,$siteinternetprojet,$descriptionprojet,$budgetgmv){
        $database=new Bd_class();
        $requete="INSERT INTO projet(nomprojet,budgetglobal,datedebutprojet,datefinprojet,nomcontactprojet,prenomcontactprojet,numcontactprojet,emailcontactprojet,siteinternetprojet, descriptionprojet, budgetgmv)
        VALUES (:nomprojet,:budgetglobal,:datedebutprojet,:datefinprojet,:nomcontactprojet,:prenomcontactprojet,:numcontactprojet,:emailcontactprojet,:siteinternetprojet,:descriptionprojet, :budgetgmv)";
        $data=array(
            'nomprojet'=>$nomprojet,
            'budgetglobal'=>$budjetglobalprojet,
            'datedebutprojet'=>$datedebutprojet,
            'datefinprojet'=>$datefinprojet,
            'nomcontactprojet'=>$nomcontactprojet,
            'prenomcontactprojet'=>$prenomcontactprojet,
            'numcontactprojet'=>$numcontactprojet,
            'emailcontactprojet'=>$emailcontactprojet,
            'siteinternetprojet'=>$siteinternetprojet,
            'descriptionprojet'=>$descriptionprojet,
            'budgetgmv'=>$budgetgmv
        );

        $database->set_Enregistrer($requete,$data);
    }


    public function ModifierProjet($nomprojet,$budjetglobalprojet,$datedebutprojet,$datefinprojet,$nomcontactprojet,$prenomcontactprojet,
                                   $numcontactprojet,$emailcontactprojet,$siteinternetprojet,$descriptionprojet,$budgetgmv, $id){
        $database=new Bd_class();
        $requete="UPDATE projet SET nomprojet= :nomprojet,budgetglobal= :budgetglobal,datedebutprojet= :datedebutprojet,datefinprojet= :datefinprojet,
              nomcontactprojet= :nomcontactprojet,prenomcontactprojet= :prenomcontactprojet,numcontactprojet= :numcontactprojet,
              emailcontactprojet= :emailcontactprojet,siteinternetprojet= :siteinternetprojet, descriptionprojet= :descriptionprojet,
               budgetgmv= :budgetgmv WHERE idprojet=$id";
        $data=array(
            'nomprojet'=>$nomprojet,
            'budgetglobal'=>$budjetglobalprojet,
            'datedebutprojet'=>$datedebutprojet,
            'datefinprojet'=>$datefinprojet,
            'nomcontactprojet'=>$nomcontactprojet,
            'prenomcontactprojet'=>$prenomcontactprojet,
            'numcontactprojet'=>$numcontactprojet,
            'emailcontactprojet'=>$emailcontactprojet,
            'siteinternetprojet'=>$siteinternetprojet,
            'descriptionprojet'=>$descriptionprojet,
            'budgetgmv'=>$budgetgmv
        );

        $database->set_Enregistrer($requete,$data);
    }

    public function SupprimerProjet($id){
        $database=new Bd_class();
        $reqeute="DELETE FROM projet WHERE idprojet=$id";
        $database->set_requete($reqeute);
        $database->Close();
    }

    public function RecupererIdProjet(){
        $database=new Bd_class();
        $requet="SELECT * FROM projet ORDER BY idprojet DESC limit 1";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $nbligne=$resultat->rowCount();
        $idmax=0;
        if($nbligne==1){
            $ligne=$resultat->fetch(PDO::FETCH_OBJ);
            $idmax=$ligne->idprojet;
        }

        $database->Close();
        return $idmax;
    }

    public function InseresExecuterProjetCommune($idcommune,$idprojet){
        $dat=new Bd_class();
        $req="INSERT INTO executer_projet_commune (idcommune,idprojet) VALUES (:idcom, :idpro)";
        $donne=array(
            "idcom"=>$idcommune,
            "idpro"=>$idprojet
        );

        $dat->set_Enregistrer($req,$donne);
    }

    public function SupprimerExecuterProjetCommune($id){
        $database=new Bd_class();
        $reqeute="DELETE FROM executer_projet_commune WHERE idprojet=$id";
        $database->set_requete($reqeute);
        $database->Close();
    }

    public function InseresFinancerBailleurProjet($idbailleur,$idprojet,$montantfinancement,$annee){
        $dat=new Bd_class();
        $req="INSERT INTO financer_bailleur_projet(idbailleur,idprojet,montantfinancement,annee) VALUES (:idbailleur, :idpro,:montant,:annee)";
        $donne=array(
            "idbailleur"=>$idbailleur,
            "idpro"=>$idprojet,
            "montant"=>$montantfinancement,
            "annee"=>$annee
        );

        $dat->set_Enregistrer($req,$donne);
    }

    public function SupprimerFinancerBailleurProjet($id){
        $database=new Bd_class();
        $reqeute="DELETE FROM financer_bailleur_projet WHERE idprojet=$id";
        $database->set_requete($reqeute);
        $database->Close();
    }


    public function InsererExecuterProjetOperateur($idoperateur,$idprojet,$fonctiontechnique,$fonctionfinanciere,$montantfinancement){
        $dat=new Bd_class();
        $req="INSERT INTO executer_operateur_projet(idoperateur,idprojet,fonctiontechnique,fonctionfinanciere,montantfinancement) VALUES (:idoperateur, :idpro,:fonctiontechnique,:fonctionfinanciere,:montantfinancement)";
        $donne=array(
            "idoperateur"=>$idoperateur,
            "idpro"=>$idprojet,
            "fonctiontechnique"=>$fonctiontechnique,
            "fonctionfinanciere"=>$fonctionfinanciere,
            "montantfinancement"=>$montantfinancement
        );

        $dat->set_Enregistrer($req,$donne);
    }

    public function SupprimerExecuterProjetOperateur($id){
        $database=new Bd_class();
        $reqeute="DELETE FROM executer_operateur_projet WHERE idprojet=$id";
        $database->set_requete($reqeute);
        $database->Close();
    }

    public function InsererExecuterProjetOperate($idoperateur,$idprojet,$fonctiontechnique,$fonctionfinanciere){
        $dat=new Bd_class();
        $req="INSERT INTO executer_operateur_projet(idoperateur,idprojet,fonctiontechnique,fonctionfinanciere) VALUES (:idoperateur, :idpro,:fonctiontechnique,:fonctionfinanciere)";
        $donne=array(
            "idoperateur"=>$idoperateur,
            "idpro"=>$idprojet,
            "fonctiontechnique"=>$fonctiontechnique,
            "fonctionfinanciere"=>$fonctionfinanciere

        );

        $dat->set_Enregistrer($req,$donne);
    }


    //fonction pour lister tous les projets existant dans la base de données
    public static function ListerTousProjet(){
        $database=new Bd_class();
        $selct="SELECT * FROM projet ORDER BY idprojet DESC";
        $database->set_requete($selct);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public static function ListerProjetParId($id){
            $database=new Bd_class();
            $selct="SELECT * FROM projet WHERE idprojet=$id";
            $database->set_requete($selct);
            $table=$database->return_table();
            $database->Close();
            return $table;
        }

    //partie de la gestion des opérateurs
    public function InsererOperateur($nomoperateur,$nomcontactoperateur,$prenomcontactoperateur,$numcontactoperateur,$emailcontactoperateur,
                            $fonctioncontactoperateur,$siteinternetoperateur){
        $database=new Bd_class();
        $req="INSERT INTO operateur(nomoperateur,nomcontactoperateur,prenomcontactoperateur,numcontactoperateur,emailcontactoperateur,fonctioncontactoperateur,siteinternetoperateur)
              VALUES (:nomoperateur,:nomcontactoperateur,:prenomcontactoperateur,:numcontactoperateur,:emailcontactoperateur,:fonctioncontactoperateur,:siteinternetoperateur)";
        $data=array(
            'nomoperateur'=>$nomoperateur,
            'nomcontactoperateur'=>$nomcontactoperateur,
            'prenomcontactoperateur'=>$prenomcontactoperateur,
            'numcontactoperateur'=>$numcontactoperateur,
            'emailcontactoperateur'=>$emailcontactoperateur,
            'fonctioncontactoperateur'=>$fonctioncontactoperateur,
            'siteinternetoperateur'=>$siteinternetoperateur
        );
        $database->set_Enregistrer($req,$data);

    }


    public function ModifierOperateur($nomoperateur,$nomcontactoperateur,$prenomcontactoperateur,$numcontactoperateur,$emailcontactoperateur,
                                     $fonctioncontactoperateur,$siteinternetoperateur, $id){
        $database=new Bd_class();
        $req="UPDATE operateur SET nomoperateur= :nomoperateur, nomcontactoperateur= :nomcontactoperateur,prenomcontactoperateur= :prenomcontactoperateur, numcontactoperateur= :numcontactoperateur,
                      emailcontactoperateur= :emailcontactoperateur,fonctioncontactoperateur= :fonctioncontactoperateur,siteinternetoperateur= :siteinternetoperateur WHERE idoperateur=$id";
        $data=array(
            'nomoperateur'=>$nomoperateur,
            'nomcontactoperateur'=>$nomcontactoperateur,
            'prenomcontactoperateur'=>$prenomcontactoperateur,
            'numcontactoperateur'=>$numcontactoperateur,
            'emailcontactoperateur'=>$emailcontactoperateur,
            'fonctioncontactoperateur'=>$fonctioncontactoperateur,
            'siteinternetoperateur'=>$siteinternetoperateur
        );
        $database->set_Enregistrer($req,$data);

    }

    public function SupprimerOperateur($id){
        $database=new Bd_class();
        $reqeute="DELETE FROM operateur WHERE idoperateur=$id";
        $database->set_requete($reqeute);
        $database->Close();
    }

    public static function ListerTousOperateur(){
        $database=new Bd_class();
        $req="SELECT * FROM operateur ORDER BY idoperateur DESC";
        $database->set_requete($req);
        $table=$database->return_table();
        $database->Close();
        return $table;

    }


    public static function ListerOperateurParId($id){
        $database=new Bd_class();
        $req="SELECT * FROM operateur WHERE idoperateur=$id";
        $database->set_requete($req);
        $table=$database->return_table();
        $database->Close();
        return $table;

    }


    public static function ListeFinancierParIdProjet($idpro){
        $database=new Bd_class();
        $req="SELECT * FROM financier WHERE idprojet=$idpro";
        $database->set_requete($req);
        $table=$database->return_table();
        $database->Close();
        return $table;

    }

    public static function ListeCommuneParIdProjet($idpro){
        $database=new Bd_class();
        $req="SELECT * FROM executerprojetdanscommune WHERE idprojet=$idpro";
        $database->set_requete($req);
        $table=$database->return_table();
        $database->Close();
        return $table;

    }


    public static function ListeExecuterProjetOperateurParIdProjet($idpro){
        $database=new Bd_class();
        $req="SELECT * FROM excuterprojetoperateur WHERE idprojet=$idpro";
        $database->set_requete($req);
        $table=$database->return_table();
        $database->Close();
        return $table;

    }


    public static function ChercherProjetParCritere($critere){
        $database=new Bd_class();
        $req="SELECT * FROM projet WHERE UPPER(nomprojet) LIKE UPPER ('%$critere%') OR UPPER (nomcontactprojet) LIKE UPPER ('%$critere%') OR UPPER (prenomcontactprojet) LIKE UPPER ('%$critere%')";
        $database->set_requete($req);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }


    public static function ChercherOperateurParCritere($critere){
        $database=new Bd_class();
        $req="SELECT * FROM operateur WHERE UPPER(nomoperateur) LIKE UPPER ('%$critere%') OR UPPER (nomcontactoperateur) LIKE UPPER ('%$critere%') OR UPPER (prenomcontactoperateur) LIKE UPPER ('%$critere%')";
        $database->set_requete($req);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }


    public static function ChercherBailleurParCritere($critere){
        $database=new Bd_class();
        $req="SELECT * FROM bailleur WHERE UPPER(nombailleur) LIKE UPPER ('%$critere%') OR UPPER (nomcontactbailleur) LIKE UPPER ('%$critere%') OR UPPER (prenomcontactbailleur) LIKE UPPER ('%$critere%')";
        $database->set_requete($req);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

/*
    public function ChercherBailleurDansFinancerProjet($idbailleur){
        $database=new Bd_class();
        $requet="SELECT * FROM financer_bailleur_projet WHERE idbailleur=$idbailleur limit 1";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $nbligne=$resultat->rowCount();
        $id=0;
        if($nbligne==1){
            $ligne=$resultat->fetch(PDO::FETCH_OBJ);
            $id=$ligne->idbailleur;
        }

        $database->Close();
        return $id;
    }*/

    public function ChercherBailleurDansFinancerOperateur($idbailleur){
        $database=new Bd_class();
        $requet="SELECT * FROM financer_bailleur_operateur WHERE idbailleur=$idbailleur limit 1";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $nbligne=$resultat->rowCount();
        $id=0;
        if($nbligne==1){
            $ligne=$resultat->fetch(PDO::FETCH_OBJ);
            $id=$ligne->idbailleur;
        }else{
            $requet="SELECT * FROM financer_bailleur_projet WHERE idbailleur=$idbailleur limit 1";
            $database->set_requete($requet);
            $resultat=$database->get_resultat();
            $nbligne=$resultat->rowCount();
            if($nbligne==1){
                $ligne=$resultat->fetch(PDO::FETCH_OBJ);
                $id=$ligne->idbailleur;
            }
        }

        $database->Close();
        return $id;
    }


    public function ChercherOperateur($id){
        $database=new Bd_class();
        $requet="SELECT * FROM financer_bailleur_operateur WHERE idoperateur=$id limit 1";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $nbligne=$resultat->rowCount();
        $id=0;
        if($nbligne==1){
            $ligne=$resultat->fetch(PDO::FETCH_OBJ);
            $id=$ligne->idoperateur;
        }else{
            $requet="SELECT * FROM amenager WHERE idoperateur=$id limit 1";
            $database->set_requete($requet);
            $resultat=$database->get_resultat();
            $nbligne=$resultat->rowCount();
            if($nbligne==1){
                $ligne=$resultat->fetch(PDO::FETCH_OBJ);
                $id=$ligne->idoperateur;
            }else{
                $requet="SELECT * FROM financer_bailleur_operateur WHERE idoperateur=$id limit 1";
                $database->set_requete($requet);
                $resultat=$database->get_resultat();
                $nbligne=$resultat->rowCount();
                if($nbligne==1){
                    $ligne=$resultat->fetch(PDO::FETCH_OBJ);
                    $id=$ligne->idoperateur;
                }else{
                    $requet="SELECT * FROM recevoir_appui_gest_op WHERE idoperateur=$id limit 1";
                    $database->set_requete($requet);
                    $resultat=$database->get_resultat();
                    $nbligne=$resultat->rowCount();
                    if($nbligne==1){
                        $ligne=$resultat->fetch(PDO::FETCH_OBJ);
                        $id=$ligne->idoperateur;
                    }
                }
            }
        }

        $database->Close();
        return $id;
    }


    /////////////////////////////////////////////////////////

    public function InsererFinancementOperateur($idoperateur,$idbailleur,$montant,$annee,$idprojet){
        $database= new Bd_class();
        $requete="INSERT INTO financer_bailleur_operateur(idoperateur, idbailleur, montantfinancement,anneefinancement,idprojet)
                  VALUES (:idoperateur,:idbailleur,:montant,:annee,:idprojet)";
        $valeur=array(
            "idoperateur"=>$idoperateur,
            "idbailleur"=>$idbailleur,
            "montant"=>$montant,
            "annee"=>$annee,
            "idprojet"=>$idprojet
        );

        $database->set_Enregistrer($requete,$valeur);
    }


    public static function ListeFinanceOperateur(){
        $database=new Bd_class();
        $req="SELECT * FROM financerbailleuroperateur ORDER BY idbailleuroperateur DESC";
        //$req="SELECT * FROM financer ORDER BY idbailleuroperateur DESC";
        $database->set_requete($req);
        $table=$database->return_table();
        $database->Close();
        return $table;

    }

    public function RecupererNomProjet($id){
        $database=new Bd_class();
        $requet="SELECT * FROM projet WHERE idprojet=$id";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $ligne=$resultat->fetch(PDO::FETCH_OBJ);
        $nomprojet=$ligne->nomprojet;
        $database->Close();
        return $nomprojet;
    }


    public static function ListeFinanceOperateurParId($id){
        $database=new Bd_class();
        $req="SELECT * FROM financerbailleuroperateur WHERE idbailleuroperateur=$id";
        //$req="SELECT * FROM financer WHERE idbailleuroperateur=$id";
        $database->set_requete($req);
        $table=$database->return_table();
        $database->Close();
        return $table;

    }


    public function ModifierFinancementOperateur($idoperateur,$idbailleur,$montant,$annee,$idprojet, $id){
        $database= new Bd_class();
        $requete="UPDATE financer_bailleur_operateur SET idoperateur= :operateur, idbailleur= :bailleur,
                    montantfinancement= :montant, anneefinancement= :annee,idprojet= :projet WHERE idbailleuroperateur=$id";
        $valeur=array(
            "operateur"=>$idoperateur,
            "bailleur"=>$idbailleur,
            "montant"=>$montant,
            "annee"=>$annee,
            "projet"=>$idprojet
        );

        $database->set_Enregistrer($requete,$valeur);
    }


    public function supprimerFinancementOperateur($id){

        $database=new Bd_class();
        $requete="DELETE FROM financer_bailleur_operateur WHERE idbailleuroperateur=$id";
        $database->set_requete($requete);
        $database->Close();
    }


    //////////////////////////////////////////////

}