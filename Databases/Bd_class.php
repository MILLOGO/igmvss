<?php

/**
 * Created by PhpStorm.
 * User: somda
 * Date: 26/06/2018
 * Time: 01:27
 */
class Bd_class
{

    private $idconnect; // identifiant de connexion
    private $idresult; // identifiant de r?sultat d'une requette
    //private $idbase; // identifiant de selection de la data base
    private $requete;


//constructeur d'un élément de la base de données
    public function __construct(){
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $this->idconnect = new PDO('pgsql:host=localhost; dbname=bd_igmvss', 'postgres', 'IGMVSSbd2018',$pdo_options);
        if(!$this->idconnect){
            echo "<script>alert('Erreur de connexion de la base de données ');</script>\n";
        }
    }

    //fonction d'exécution d'une requete
    public function set_requete($larequete){
        $this->requete=$larequete;
        $this->idresult=$this->idconnect->query($this->requete);
        if(!$this->idresult){
            echo "<script>alert('Erreur d\'execution requete .$larequete');</script>\n";
        }
    }

    //fonction pour les données avec prepare
    public function set_Enregistrer($larequete,$data){
        $this->requete=$larequete;
        $rst=$this->idconnect->prepare($this->requete);
        $this->idresult=$rst->execute($data);
        if(!$this->idresult){
            echo "<script>alert('Erreur d\'execution requete .$larequete');</script>\n";
        }
    }

    public function set_Rechercher($larequete,$data){
        $this->requete=$larequete;
        $rst=$this->idconnect->prepare($this->requete);
        $this->idresult=$rst->execute($data);
        if(!$this->idresult){
            echo "<script>alert('Erreur d\'execution requete .$larequete');</script>\n";
        }
    }


    public function get_resultat(){
        return $this->idresult;
    }

    //retourner le resulatat d'une requete sous forme de tableau
   public function return_table(){
        $i=0;
        $j=0;
        $tableau=array();
        while($ligne=$this->idresult->fetch(PDO::FETCH_OBJ)){
            $i=$i+1;
            foreach($ligne as $valeur){
                $j=$j+1;
                $tableau[$i][$j]=$valeur;
            }
        }
        return $tableau;
    }


    public function Close(){
        $this->idresult->closeCursor();
    }
}