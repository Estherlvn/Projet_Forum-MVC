<?php
namespace App;

abstract class Entity{

    protected function hydrate($data){

        foreach($data as $field => $value){
            // field = topic_id
            // fieldarray = ['topic','id']
            $fieldArray = explode("_", $field);

            if(isset($fieldArray[1]) && $fieldArray[1] == "id"){
                // manName = TopicManager 
                $manName = ucfirst($fieldArray[0])."Manager";
                // FQCName = Model\Managers\TopicManager;
                $FQCName = "Model\Managers\\".$manName;
                
                // man = new Model\Managers\TopicManager
                $man = new $FQCName();
                // value = Model\Managers\TopicManager->findOneById(1)
                $value = $man->findOneById($value);
            }

            // fabrication du nom du setter à appeler (ex: setName)
            $method = "set".ucfirst($fieldArray[0]);
            
            // si setName est une méthode qui existe dans l'entité (this)
            if(method_exists($this, $method)){
                // $this->setName("valeur")
                $this->$method($value);
            }
        }
    }

    public function getClass(){
        return get_class($this);
    }
}