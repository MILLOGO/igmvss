<?php
/**
 * Created by PhpStorm.
 * User: somda
 * Date: 28/07/2018
 * Time: 01:08
 */

class Bd_user
{

    private $nom;
    private $prenom;
    private $numUser;
    private $identifiant;
    private $motdepasse;
    private $passCript;
    private $emailUser;
    private $fonction;
    private $service;
    private $profil;

    //constructeur
    public function __construct($nomUser, $prenomUser, $numUser, $identifiantUser,$motdepass, $email, $fonction, $service,$profil){
        $this->nom=$nomUser;
        $this->prenom=$prenomUser;
        $this->numUser=$numUser;
        $this->identifiant=$identifiantUser;
        $this->motdepasse=$motdepass;
        $this->passCript=md5($this->motdepasse);
        $this->emailUser=$email;
        $this->fonction=$fonction;
        $this->service=$service;
        $this->profil=$profil;
    }

    public function connexion(){
        $_SESSION['nom']=$this->nom;
        $_SESSION['prenom']=$this->prenom;
        $_SESSION['profil']=$this->profil;
    }

    public function InsererUser(){
        $database= new Bd_class();
        $requete="INSERT INTO users (nom, prenom, fonction, service, telephone, email, identifiant, motdepasse, profil)
          VALUES (:nom, :prenom, :fonction, :service, :telephone, :email, :identifiant, :motdepasse, :profil)";
        $valeur=array(
            "nom"=>$this->nom,
            "prenom"=>$this->prenom,
            "fonction"=>$this->fonction,
            "service"=>$this->service,
            "telephone"=>$this->numUser,
            "email"=>$this->emailUser,
            "identifiant"=>$this->identifiant,
            "motdepasse"=>$this->passCript,
            "profil"=>$this->profil
        );

        $database->set_Enregistrer($requete,$valeur);
    }

    public function ModifierUser($id){
        $database= new Bd_class();
        $requete="UPDATE users SET nom= :nom, prenom= :prenom, fonction= :fonction, service= :service, telephone= :telephone, email= :email,
                  identifiant= :identifiant, motdepasse= :motdepasse, profil= :profil WHERE iduser=$id";
        $valeur=array(
            "nom"=>$this->nom,
            "prenom"=>$this->prenom,
            "fonction"=>$this->fonction,
            "service"=>$this->service,
            "telephone"=>$this->numUser,
            "email"=>$this->emailUser,
            "identifiant"=>$this->identifiant,
            "motdepasse"=>$this->passCript,
            "profil"=>$this->profil
        );

        $database->set_Enregistrer($requete,$valeur);
    }

    public function Est_Utilisateur(){
        $database=new Bd_class();
        $requet="SELECT * FROM users WHERE identifiant='$this->identifiant' AND motdepasse='$this->passCript'";
        $database->set_requete($requet);
        $resultat=$database->get_resultat();
        $nbligne=$resultat->rowCount();
        $exist=array();
        if($nbligne==1){
            $ligne=$resultat->fetch(PDO::FETCH_OBJ);
            $exist[0]=$ligne->profil;
            $exist[1]=$ligne->nom;
            $exist[2]=$ligne->prenom;
            $exist[3]=$ligne->identifiant;

            $this->profil=$exist[0];
            $this->nom=$exist[1];
            $this->prenom=$exist[2];
        }else{

            $exist[0]=" ";
        }

        $database->Close();
        return $exist;
    }

    public static function ListerTousUser(){
        $database=new Bd_class();
        $req="SELECT * FROM users ORDER BY iduser DESC ";
        $database->set_requete($req);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }


    public static function ListerUserParId($id){
        $database=new Bd_class();
        $req="SELECT * FROM users WHERE iduser=$id ";
        $database->set_requete($req);
        $table=$database->return_table();
        $database->Close();
        return $table;
    }

    public function supprimeUser($id){
        $database=new Bd_class();
        $requete="DELETE FROM users WHERE iduser=$id";
        $database->set_requete($requete);
        $database->Close();
    }

    public function VerifierLogin($login){
        $database=new Bd_class();
        $requet = "SELECT * FROM users WHERE UPPER(identifiant)= UPPER('$login') limit 1";
        $database->set_requete($requet);
        $resultat = $database->get_resultat();
        $nbligne = $resultat->rowCount();
        $database->Close();
        return $nbligne;
    }

    public function VerifierLoginPourMod($login, $id){
        $database=new Bd_class();
        $requet = "SELECT * FROM users WHERE UPPER(identifiant)= UPPER('$login') AND iduser <> $id limit 1";
        $database->set_requete($requet);
        $resultat = $database->get_resultat();
        $nbligne = $resultat->rowCount();
        $database->Close();
        return $nbligne;
    }
}