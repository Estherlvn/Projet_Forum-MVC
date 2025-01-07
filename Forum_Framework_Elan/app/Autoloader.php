<?php
namespace App;

class Autoloader{

	public static function register(){
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}

	public static function autoload($class){

		//$class = Model\Managers\TopicManager (FullyQualifiedClassName)
		//namespace = Model\Managers, nom de la classe = TopicManager

		// on explose notre variable $class par \
		$parts = preg_split('#\\\#', $class);
		//$parts = ['Model', 'Managers', 'TopicManager']

		// on extrait le dernier element 
		$className = array_pop($parts);
		//$className = TopicManager

		// on créé le chemin vers la classe
		// on utilise DS car plus propre et meilleure portabilité entre les différents systèmes (windows/linux) 

		$path = strtolower(implode(DS, $parts));
		//$path = 'model/manager'
		$file = $className.'.php';
		//$file = TopicManager.php

		$filepath = BASE_DIR.$path.DS.$file;
		//$filepath = model/managers/TopicManager.php
		if(file_exists($filepath)){
			require $filepath;
		}
	}
}
