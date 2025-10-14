<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VariablesController extends AbstractController
{
    #[Route('/variables', name: 'app_variables')]
    public function index(): Response
    {
        // Données complètes sur les variables PHP : syntaxe, règles de nommage, portée, affectation et bonnes pratiques
        $dataVariablesPHP = [
            'declaration' => [
                'description' => 'En PHP, une variable commence toujours par le symbole $ suivi du nom. Aucune déclaration préalable n\'est nécessaire.',
                'example' => '$maVariable = "Bonjour";\n$nombre = 42;\n$estVrai = true;',
            ],
            'regles_nommage' => [
                'description' => 'Nom de variable : lettre/underscore en premier, puis lettres/chiffres/underscores. Sensible à la casse.',
                'example' => '$nom_valide = "OK";\n$_aussi_valide = "OK";\n$var2 = "OK";\n// $2var = "ERREUR";',
            ],
            'affectation' => [
                'description' => 'L\'affectation se fait avec l\'opérateur =. Une variable peut être réassignée à tout moment.',
                'example' => '$message = "Bonjour";\n$message = "Au revoir"; // Réaffectation\n$copie = $message; // Copie de valeur',
            ],
            'portee_locale' => [
                'description' => 'Les variables déclarées dans une fonction ont une portée locale (accessible uniquement dans cette fonction).',
                'example' => 'function test() {\n    $locale = "Je suis locale";\n    echo $locale; // OK\n}\n// echo $locale; // ERREUR',
            ],
            'portee_globale' => [
                'description' => 'Les variables déclarées hors des fonctions sont globales. Utilisez "global" pour y accéder dans une fonction.',
                'example' => '$globale = "Je suis globale";\nfunction afficher() {\n    global $globale;\n    echo $globale;\n}',
            ],
            'variables_superglobales' => [
                'description' => 'PHP fournit des variables superglobales automatiquement disponibles partout ($_GET, $_POST, $_SESSION, etc.).',
                'example' => 'echo $_SERVER[\'PHP_VERSION\'];\n// $_GET, $_POST, $_SESSION\n// $_COOKIE, $_FILES, $GLOBALS',
            ],
            'bonnes_pratiques' => [
                'description' => 'Utilisez des noms explicites, respectez les conventions (camelCase ou snake_case), initialisez vos variables.',
                'example' => '$nomUtilisateur = "John"; // camelCase\n$nom_utilisateur = "John"; // snake_case\n$age = 0; // Initialisation',
            ],
        ];

        // Données complètes sur les variables superglobales PHP comme $_GET, $_POST, $_SESSION, $_COOKIE, $_FILES, $GLOBALS : syntaxe, règles de nommage, portée, affectation et bonnes pratiques
        $dataVariablesGlobalesPHP = [
            '$_GET' => [
                'description' => 'Contient les données envoyées via l\'URL (méthode GET). Utilisé pour récupérer les paramètres de requête.',
                'example' => 'URL: example.com?page=2\nAccès: $page = $_GET[\'page\'];',
            ],
            '$_POST' => [
                'description' => 'Contient les données envoyées via un formulaire HTML (méthode POST). Utilisé pour récupérer les données de formulaire.',
                'example' => '<form method="POST">\n  <input name="username">\n</form>\nAccès: $username = $_POST[\'username\'];',
            ],
            '$_SESSION' => [
                'description' => 'Utilisée pour stocker des informations persistantes entre les pages. Nécessite session_start() au début du script.',
                'example' => 'session_start();\n$_SESSION[\'user_id\'] = 123;\n// Récupération\n$userId = $_SESSION[\'user_id\'];',
            ],
            '$_COOKIE' => [
                'description' => 'Contient les cookies envoyés par le navigateur. Utilisé pour stocker des informations côté client.',
                'example' => 'setcookie("theme", "dark", time() + 3600);\n// Récupération\n$theme = $_COOKIE[\'theme\'];',
            ],
            '$_FILES' => [          
                'description' => 'Contient les fichiers téléchargés via un formulaire HTML. Utilisé pour gérer les uploads de fichiers.',
                'example' => '<form method="POST" enctype="multipart/form-data">\n  <input type="file" name="monFichier">\n</form>\n// Accès\n$fichier = $_FILES[\'monFichier\'];',
            ],
            '$GLOBALS' => [
                'description' => 'Tableau associatif contenant toutes les variables globales. Permet d\'accéder à une variable globale depuis n\'importe où.',
                'example' => '$a = 5;\nfunction test() {\n    echo $GLOBALS[\'a\']; // Accès à la variable globale $a\n}',
            ],
        ];

        return $this->render('variables/index.html.twig', [
            'data' => $dataVariablesPHP,
            'dataGlobales' => $dataVariablesGlobalesPHP,
        ]);
    }
}
