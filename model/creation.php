<?php


class creation
{
    private $user, $event, $creation;



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
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return int
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @return bool
     */
    public function getCreation()
    {
        return $this->creation;
    }

    // SETTER

    /**
     * @param int $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @param int $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @param bool $creation
     */
    public function setCreation($creation)
    {
        $this->creation = $creation;
    }

}