<?php

class user
{
private $idUser,$nom,$prenom,$mail,$mdp,$classe,$profil,$valide;
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
    public function getIdUser()
    {
        return $this->idUser;
    }


    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }


    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }


    /**
     * @return string
     */
    public function getClasse()
    {
        return $this->classe;
    }


    /**
     * @return string
     */
    public function getProfil()
    {
        return $this->profil;
    }


    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }


    /**
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
    }


    /**
     * @return bool
     */
    public function getValide()
    {
        return $this->valide;
    }

// SETTER

    /**
     * @param int $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }


    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }


    /**
     * @param string $classe
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;
    }


    /**
     * @param string $profil
     */
    public function setProfil($profil)
    {
        $this->profil = $profil;
    }


    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @param string $mdp
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    /**
     * @param bool $valide
     */
    public function setValide($valide)
    {
        $this->valide = $valide;
    }
}

?>