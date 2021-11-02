<?php


class messages
{

    private $idMessage, $userExp, $userDest, $message, $date;


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
     * @return mixed
     */
    public function getIdMessage()
    {
        return $this->idMessage;
    }

    /**
     * @return mixed
     */
    public function getUserExp()
    {
        return $this->userExp;
    }

    /**
     * @return mixed
     */
    public function getUserDest()
    {
        return $this->userDest;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }


    // SETTER

    /**
     * @param mixed $idMessage
     */
    public function setIdMessage($idMessage)
    {
        $this->idMessage = $idMessage;
    }

    /**
     * @param mixed $userExp
     */
    public function setUserExp($userExp)
    {
        $this->userExp = $userExp;
    }

    /**
     * @param mixed $userDest
     */
    public function setUserDest($userDest)
    {
        $this->userDest = $userDest;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }



}