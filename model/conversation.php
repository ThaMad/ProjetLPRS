<?php


class conversation
{

    private $idConv, $userA, $userB, $message, $date;


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
    public function getIdConv()
    {
        return $this->idConv;
    }


    /**
     * @return int
     */
    public function getUserA()
    {
        return $this->userA;
    }


    /**
     * @return int
     */
    public function getUserB()
    {
        return $this->userB;
    }

    /**
     * @return text
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return datetime
     */
    public function getDate()
    {
        return $this->date;
    }


    // SETTER

    /**
     * @param int $idConv
     */
    public function setIdConv($idConv)
    {
        $this->idConv = $idConv;
    }

    /**
     * @param int $userA
     */
    public function setUserA($userA)
    {
        $this->userA = $userA;
    }

    /**
     * @param int $userB
     */
    public function setUserB($userB)
    {
        $this->userB = $userB;
    }

    /**
     * @param text $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @param datetime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }


}