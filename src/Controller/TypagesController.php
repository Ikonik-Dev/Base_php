<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TypagesController extends AbstractController
{
    #[Route('/typages', name: 'app_typages')]
    public function index(): Response
    {

        // Données complètes sur les types de données PHP : types primitifs, types composés, types spéciaux, conversion de types, vérification de types et bonnes pratiques
        $dataTypesPHP = [
            'types_primitifs_scalaires' => [
                'description' => 'Types de base qui contiennent une seule valeur : integer, float, string, boolean.',
                'example' => '$entier = 42;\n$decimal = 3.14;\n$texte = "Hello";\n$booleen = true;',
            ],
            'type_integer' => [
                'description' => 'Nombres entiers positifs ou négatifs. Peut être décimal, hexadécimal, octal ou binaire.',
                'example' => '$decimal = 123;\n$hexa = 0x7B; // 123 en hexa\n$octal = 0173; // 123 en octal\n$binaire = 0b1111011; // 123 en binaire',
            ],
            'type_float' => [
                'description' => 'Nombres à virgule flottante (décimaux). Aussi appelés double ou real.',
                'example' => '$prix = 19.99;\n$scientifique = 1.5e3; // 1500\n$negatif = -0.75;',
            ],
            'type_string' => [
                'description' => 'Chaînes de caractères délimitées par des guillemets simples ou doubles.',
                'example' => '$simple = \'Hello\';\n$double = "World";\n$heredoc = <<<EOD\nTexte multiligne\nEOD;',
            ],
            'type_boolean' => [
                'description' => 'Type logique qui ne peut avoir que deux valeurs : true ou false.',
                'example' => '$vrai = true;\n$faux = false;\n// Valeurs falsy : 0, 0.0, "", "0", [], null',
            ],
            'types_composes' => [
                'description' => 'Types qui peuvent contenir plusieurs valeurs : array et object.',
                'example' => '$tableau = [1, 2, 3];\n$objet = new stdClass();\n$objet->propriete = "valeur";',
            ],
            'type_array' => [
                'description' => 'Collections ordonnées de valeurs indexées par des clés numériques ou associatives.',
                'example' => '$indexe = [1, 2, 3];\n$associatif = ["nom" => "John", "age" => 30];\n$mixte = [0 => "zero", "un" => 1];',
            ],
            'type_object' => [
                'description' => 'Instances de classes contenant des propriétés et des méthodes.',
                'example' => 'class Personne {\n    public $nom = "John";\n}\n$p = new Personne();\necho $p->nom;',
            ],
            'types_speciaux' => [
                'description' => 'Types particuliers : null, resource et callable.',
                'example' => '$nul = null;\n$fichier = fopen("test.txt", "r"); // resource\n$fonction = "strlen"; // callable',
            ],
            'type_null' => [
                'description' => 'Représente une variable sans valeur. Seule valeur possible : null.',
                'example' => '$vide = null;\nunset($variable); // $variable devient null\n$inexistante; // null par défaut',
            ],
            'type_resource' => [
                'description' => 'Référence vers une ressource externe (fichier, connexion base de données, etc.).',
                'example' => '$fichier = fopen("data.txt", "r");\n$connexion = mysql_connect("localhost");\nfclose($fichier);',
            ],
            'type_callable' => [
                'description' => 'Représente quelque chose qui peut être appelé comme une fonction.',
                'example' => '$func = "strtoupper";\n$lambda = function($x) { return $x * 2; };\ncall_user_func($func, "hello");',
            ],
            'verification_types' => [
                'description' => 'Fonctions pour vérifier le type d\'une variable : is_int(), is_string(), gettype(), etc.',
                'example' => 'is_int(42); // true\nis_string("hello"); // true\ngettype(3.14); // "double"\nvar_dump($variable);',
            ],
            'conversion_types' => [
                'description' => 'Conversion explicite (cast) ou implicite entre types de données.',
                'example' => '$str = (string) 123; // "123"\n$int = (int) "456"; // 456\n$bool = (bool) ""; // false',
            ],
            'juggling_types' => [
                'description' => 'PHP convertit automatiquement les types selon le contexte (jonglage de types).',
                'example' => 'echo "5" + 3; // 8 (string devient int)\necho "10.5" * 2; // 21 (string devient float)',
            ],
            'types_hints' => [
                'description' => 'Déclaration de types pour les paramètres et valeurs de retour de fonctions (PHP 7+).',
                'example' => 'function additionner(int $a, int $b): int {\n    return $a + $b;\n}\ndeclare(strict_types=1);',
            ],
        ];
        return $this->render('typages/index.html.twig', [
            'data' => $dataTypesPHP,
        ]);
    }
}
