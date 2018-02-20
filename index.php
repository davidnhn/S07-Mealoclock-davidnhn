<?php

// On inclue l'autoload de Composer pour inclure
// automatiquement toutes les classes du projet
require(__DIR__ . '/vendor/autoload.php');

// On crée notre application
$application = new Core\Application();
// On la démarre
$application->run();
