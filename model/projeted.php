<?php


class projeted
{

    private $idProjet,$libelle,$cours,$classe,$prof,$date;


    /**
     * Utilisateur constructor.
     * @param array $array
     */
    public function __construct($array)
    {
        $this->hydrate($array);
    }
    /**
     * @param array $donnees
     * Method hydrate de la class Utilisateur

     */

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
    public function getIdProjet()
    {
        return $this->idProjet;
    }

    /**
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @return string
     */
    public function getCours()
    {
        return $this->cours;
    }

    /**
     * @return integer
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @return int
     */
    public function getProf()
    {
        return $this->prof;
    }

    /**
     * @return date
     */
    public function getDate()
    {
        return $this->date;
    }


    //SETTER

    /**
     * @param int $idProjet
     */
    public function setIdProjet($idProjet)
    {
        $this->idProjet = $idProjet;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @param string $cours
     */
    public function setCours($cours)
    {
        $this->cours = $cours;
    }

    /**
     * @param int $classe
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;
    }

    /**
     * @param int $prof
     */
    public function setProf($prof)
    {
        $this->prof = $prof;
    }

    /**
     * @param date $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
}