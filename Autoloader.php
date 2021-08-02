<?php

namespace App;

class Autoloader
{
    static function register()
    {
        spl_autoload_register([
            __CLASS__,
            'autoload'
        ]);
    }

    //Cette méthode sera appelée à chaque fois que l'on utilise le mot clé use (ex : use Model\Utilisateur)
    //ou lorsque on créer un obbjet avec le mot clé new suivi d'un nom de namespace (ex : new Model\Utilisateur())

    //le but de cette méthode est d'inclure le fichier correspondant à la classe
    //exemple : via l'instruction "use Model\Utilisateur;"
    //cette instruction sera appelée :
    //require_once(./Model/Utilisateur.php)
    static function autoload($class_name)
    {
        // On récupère dans $class la totalité du namespace de la classe concernée (App\Model\Utilisateur)
        // On retire App\ et on obtient : "Model\Utilisateur"
        $class_name = str_replace(__NAMESPACE__ . '\\', '', $class_name);

        // On remplace les \ par des /
        $class = str_replace('\\', '/', $class_name);

        //note : __DIR__ contient l'arboresnce du fichier Autoloader.php
        $fichier = __DIR__ . '/' . $class_name . '.php';
        // On vérifie si le fichier existe
        if (file_exists($fichier)) {
            require_once $fichier;
        }
    }
}