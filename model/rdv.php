<?php


class rdv
{
    private $idRdv, $professeur, $parent, $libelle, $horaire, $compterendu;



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
    public function getIdRdv()
    {
        return $this->idRdv;
    }


    /**
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }


    /**
     * @return int
     */
    public function getParent()
    {
        return $this->parent;
    }


    /**
     * @return int
     */
    public function getProfesseur()
    {
        return $this->professeur;
    }


    /**
     * @return datetime
     */
    public function getHoraire()
    {
        return $this->horaire;
    }

    /**
     * @return text
     */
    public function getCompterendu()
    {
        return $this->compterendu;
    }


    // SETTER

    /**
     * @param int $idRdv
     */
    public function setIdRdv($idRdv)
    {
        $this->idRdv = $idRdv;
    }

    /**
     * @param int $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }


    /**
     * @param int $professeur
     */
    public function setProfesseur($professeur)
    {
        $this->professeur = $professeur;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @param datetime $horaire
     */
    public function setHoraire($horaire)
    {
        $this->horaire = $horaire;
    }

    /**
     * @param text $compterendu
     */
    public function setCompterendu($compterendu)
    {
        $this->compterendu = $compterendu;
    }

}