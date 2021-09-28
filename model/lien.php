<?php


class lien
{
    private $idLien, $parent, $eleve;



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
    public function getIdLien()
    {
        return $this->idLien;
    }


    /**
     * @return int
     */
    public function getEleve()
    {
        return $this->eleve;
    }

    /**
     * @return int
     */
    public function getParent()
    {
        return $this->parent;
    }


    // SETTER

    /**
     * @param int $idLien
     */
    public function setIdLien($idLien)
    {
        $this->idLien = $idLien;
    }

    /**
     * @param int $eleve
     */
    public function setEleve($eleve)
    {
        $this->eleve = $eleve;
    }

    /**
     * @param int $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }
}