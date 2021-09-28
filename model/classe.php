<?php


class classe
{
private $idClasse, $libelle;


// Constructeur + hydrate

public function __construct($array)
{
    $this->hydrate($array);
}


public function hydrate($donnees)
{
    foreach($donnees as $key => $value){
        $method = 'set'.ucfirst($key);
        if(method_exists($this,$method)){
            $this->$method($value);
        }
    }
}

// GETTER

    /**
     * @return int
     */
    public function getIdClasse()
    {
        return $this->idClasse;
    }

    /**
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }


// SETTER

    /**
     * @param int $idClasse
     */
    public function setIdClasse($idClasse)
    {
        $this->idClasse = $idClasse;
    }

    /**
     * @param int $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }
}