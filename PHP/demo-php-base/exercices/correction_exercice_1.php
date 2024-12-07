<?php

function afficherMessage($message) {
    echo $message . "\n";
}

function demanderChoix($prompt, $choixValides) {
    $choix = strtolower(readline($prompt));
    while (!in_array($choix, $choixValides)) {
        $choix = strtolower(readline("Choix non valide. Essayez à nouveau: "));
    }
    return $choix;
}

$inventaire = [];
$creaturesRencontrees = 0;

afficherMessage("Vous vous trouvez à l'orée d'une forêt ancienne, réputée pour cacher le trésor du sorcier Aldaron.");

do {
    $entrer = demanderChoix("Osez-vous pénétrer dans la forêt ? (oui/non): ", ['oui', 'non']);

    if ($entrer === 'non') {
        afficherMessage("Vous décidez de rester à l'écart de la forêt. Peut-être une autre fois.");
        break;
    }

    afficherMessage("Vous vous enfoncez dans la forêt et sentez l'air changer...");
    $chemin = demanderChoix("Deux chemins s'offrent à vous. Prenez-vous le chemin de gauche ou de droite ? (gauche/droite): ", ['gauche', 'droite']);

    if ($chemin === 'gauche') {
        afficherMessage("Vous prenez le chemin de gauche et trouvez une clé dorée scintillante par terre.");
        $inventaire[] = "clé dorée";
    } else {
        afficherMessage("En prenant le chemin de droite, vous vous retrouvez face à un petit dragon endormi.");
        $creaturesRencontrees++;
    }

    $action = demanderChoix("Voulez-vous continuer à explorer (continuer) ou tenter de trouver le trésor maintenant (trésor) ?", ['continuer', 'trésor']);

    if ($action === 'trésor') {
        if (in_array("clé dorée", $inventaire) && $creaturesRencontrees === 0) {
            afficherMessage("Vous trouvez une porte verrouillée, mais la clé dorée l'ouvre. Derrière, le trésor d'Aldaron ! Félicitations !");
        } else {
            afficherMessage("Vous trouvez la porte du trésor mais ne pouvez l'ouvrir. Il semblerait qu'il vous manque quelque chose...");
        }
        break;
    }

    afficherMessage("Vous continuez votre exploration mais la nuit tombe... C'est la fin de l'aventure pour aujourd'hui.");

    $rejouer = demanderChoix("Voulez-vous tenter l'aventure à nouveau ? (oui/non): ", ['oui', 'non']);
} while ($rejouer === 'oui');

afficherMessage("Merci d'avoir joué à notre aventure textuelle. À bientôt !");
