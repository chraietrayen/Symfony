<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
if ($form->isSubmitted()) {
    dump($form->getErrors()); // Affiche les erreurs du formulaire
    dump($livre); // Affiche l'objet livre
    die();
}
