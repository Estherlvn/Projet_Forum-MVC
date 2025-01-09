<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class User extends Entity{

    private $id_membre;
    private $email;
    private $pseudo;
    private $mdp;
    private $registrationDate;
    private $role;

    public function __construct($data){         
        $this->hydrate($data);        
    }

    /**
     * Get the value of id_membre
     */ 
    public function getId(){
        return $this->id_membre;
    }

    /**
     * Set the value of id_membre
     *
     * @return  self
     */ 
    public function setId($id){
        $this->id_membre = $id;
        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail(){
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email){
        $this->email = $email;
        return $this;
    }

    /**
     * Get the value of pseudo
     */ 
    public function getPseudo(){
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @return  self
     */ 
    public function setPseudo($pseudo){
        $this->pseudo = $pseudo;
        return $this;
    }

    /**
     * Get the value of mdp (password)
     */ 
    public function getMdp(){
        return $this->mdp;
    }

    /**
     * Set the value of mdp (password)
     *
     * @return  self
     */ 
    public function setMdp($mdp){
        $this->mdp = $mdp;
        return $this;
    }

    /**
     * Get the value of registrationDate
     */ 
    public function getRegistrationDate(){
        return $this->registrationDate;
    }

    /**
     * Set the value of registrationDate
     *
     * @return  self
     */ 
    public function setRegistrationDate($registrationDate){
        $this->registrationDate = $registrationDate;
        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole(){
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role){
        $this->role = $role;
        return $this;
    }

    public function __toString() {
        return $this->pseudo;
    }
}