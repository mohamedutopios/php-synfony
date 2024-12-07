<?php
require 'vendor/autoload.php';

use Administrateur\DemoComposer\File;
function menu()
{
    echo "1. Lire un fichier \n";
    echo "2. Ecrire  dans un fichier \n";
    echo "3. Supprimer un fichier \n";
    echo "0. Quitter \n";
}

function getFile() {
    $path = readline("Merci de saisir le chemin du fichier : ");
    return new File($path);
}

echo "Gestion des fichiers en console\n";

$file = getFile();

do {


    menu();

    
    $choix = readline("Merci de saisir votre choix : ");
    switch ($choix) {
        case '1':
            try {
                echo $file->read(). "\n";
            }catch(Exception $e) {
                echo $e->getMessage() . '\n';
            }
            break;
        case '2':
            $content = readline("Merci de saisir le contenu");
            try {
                echo $file->write($content). "\n";
            }catch(Exception $e) {
                echo $e->getMessage() . '\n';
            }
            break;
        case '3':
            try {
                echo $file->delete(). "\n";
            }catch(Exception $e) {
                echo $e->getMessage() . '\n';
            }
            break;
        case '0':
            break;
    }
} while ($choix != '0');