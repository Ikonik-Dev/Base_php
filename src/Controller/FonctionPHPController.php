<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FonctionPHPController extends AbstractController
{
    #[Route('/fonction/p/h/p', name: 'app_fonction_p_h_p')]
    public function index(): Response
    {

        // Données complètes sur les fonctions PHP : déclaration, paramètres, types, portée, anonymes, fléchées, générateurs et fonctionnalités modernes PHP 7/8
        $dataFonctionsPHP = [
            'declaration_fonctions' => [
                'description' => 'Déclaration de fonctions avec le mot-clé function, nommage et bonnes pratiques de nomenclature.',
                'example' => 'function saluer($nom) {\n    return "Bonjour " . $nom;\n}\n\nfunction calculerAge($dateNaissance) {\n    $aujourd\'hui = new DateTime();\n    $naissance = new DateTime($dateNaissance);\n    return $aujourd\'hui->diff($naissance)->y;\n}',
            ],
            'parametres_arguments' => [
                'description' => 'Gestion des paramètres : obligatoires, optionnels, valeurs par défaut, nombre variable d\'arguments.',
                'example' => 'function info($nom, $age = 25, $ville = "Paris") {\n    return "$nom, $age ans, habite $ville";\n}\n\n// Appels\necho info("John"); // Valeurs par défaut\necho info("Marie", 30); // Age personnalisé\necho info("Paul", 35, "Lyon"); // Tous personnalisés',
            ],
            'parametres_variables' => [
                'description' => 'Fonctions avec nombre variable d\'arguments : func_get_args(), func_num_args() et syntaxe ... (splat operator).',
                'example' => '// Ancienne méthode\nfunction sommeAncienne() {\n    $args = func_get_args();\n    return array_sum($args);\n}\n\n// Méthode moderne (PHP 5.6+)\nfunction somme(...$nombres) {\n    return array_sum($nombres);\n}\n\necho somme(1, 2, 3, 4, 5); // 15',
            ],
            'types_parametres_php7' => [
                'description' => 'Déclaration de types pour paramètres (PHP 7+) : scalaires, classes, interfaces, nullable avec ?.',
                'example' => 'function additionner(int $a, int $b): int {\n    return $a + $b;\n}\n\nfunction traiterUtilisateur(?User $user, string $action = "view"): bool {\n    if ($user === null) {\n        return false;\n    }\n    // Traitement...\n    return true;\n}',
            ],
            'types_union_php8' => [
                'description' => 'Types union (PHP 8.0+) et types intersection pour paramètres et valeurs de retour plus flexibles.',
                'example' => '// Types union (PHP 8.0+)\nfunction traiter(string|int|float $valeur): string {\n    return (string) $valeur;\n}\n\n// Types intersection (PHP 8.1+)\nfunction processEntity(Countable&Traversable $data): void {\n    // $data doit implémenter les deux interfaces\n}\n\n// Mixed type\nfunction flexible(mixed $anything): mixed {\n    return $anything;\n}',
            ],
            'valeurs_retour' => [
                'description' => 'Gestion des valeurs de retour : return simple, multiple, types de retour déclarés, void.',
                'example' => 'function diviser(float $a, float $b): float {\n    if ($b === 0.0) {\n        throw new DivisionByZeroError("Division par zéro");\n    }\n    return $a / $b;\n}\n\nfunction logger(string $message): void {\n    file_put_contents("log.txt", $message . PHP_EOL, FILE_APPEND);\n    // Pas de return\n}',
            ],
            'portee_variables' => [
                'description' => 'Portée des variables : locales, globales, static, closures et mot-clé use pour capturer des variables.',
                'example' => '$compteur = 0; // Variable globale\n\nfunction incrementer() {\n    global $compteur;\n    $compteur++;\n}\n\nfunction compteurStatique() {\n    static $compteur = 0;\n    return ++$compteur;\n}\n\necho compteurStatique(); // 1\necho compteurStatique(); // 2',
            ],
            'fonctions_anonymes' => [
                'description' => 'Fonctions anonymes (closures) avec use pour capturer des variables de portée externe.',
                'example' => '$multiplicateur = 3;\n\n$multiplier = function($nombre) use ($multiplicateur) {\n    return $nombre * $multiplicateur;\n};\n\necho $multiplier(5); // 15\n\n// Capture par référence\n$compteur = 0;\n$incrementer = function() use (&$compteur) {\n    $compteur++;\n};\n\n$incrementer();\necho $compteur; // 1',
            ],
            'fonctions_flechees_php74' => [
                'description' => 'Fonctions fléchées (PHP 7.4+) : syntaxe courte avec fn, capture automatique des variables, une seule expression.',
                'example' => '$nombres = [1, 2, 3, 4, 5];\n$multiplicateur = 2;\n\n// Fonction fléchée (PHP 7.4+)\n$doubles = array_map(fn($n) => $n * $multiplicateur, $nombres);\n\n// Équivalent avec fonction anonyme\n$doubles2 = array_map(function($n) use ($multiplicateur) {\n    return $n * $multiplicateur;\n}, $nombres);',
            ],
            'fonctions_callback' => [
                'description' => 'Utilisation de fonctions comme callbacks : callable, array_map, array_filter, usort avec fonctions personnalisées.',
                'example' => '$personnes = [\n    ["nom" => "Alice", "age" => 30],\n    ["nom" => "Bob", "age" => 25],\n    ["nom" => "Charlie", "age" => 35]\n];\n\n// Trier par âge\nusort($personnes, fn($a, $b) => $a["age"] <=> $b["age"]);\n\n// Filtrer les majeurs\n$majeurs = array_filter($personnes, fn($p) => $p["age"] >= 18);',
            ],
            'generateurs_yield' => [
                'description' => 'Générateurs avec yield : fonctions qui retournent un Iterator, économie mémoire, yield from (PHP 7.0+).',
                'example' => 'function compterJusque($max) {\n    for ($i = 1; $i <= $max; $i++) {\n        yield $i;\n    }\n}\n\nfunction fibonacci($n) {\n    $a = 0; $b = 1;\n    for ($i = 0; $i < $n; $i++) {\n        yield $a;\n        [$a, $b] = [$b, $a + $b];\n    }\n}\n\n// yield from (PHP 7.0+)\nfunction compterEtDoubler($max) {\n    yield from compterJusque($max);\n    yield from array_map(fn($x) => $x * 2, range(1, $max));\n}',
            ],
            'recursivite' => [
                'description' => 'Fonctions récursives : appel de la fonction par elle-même, cas de base, optimisation tail recursion.',
                'example' => 'function factorielle($n) {\n    if ($n <= 1) {\n        return 1; // Cas de base\n    }\n    return $n * factorielle($n - 1);\n}\n\nfunction fibonacciRec($n) {\n    if ($n <= 1) return $n;\n    return fibonacciRec($n - 1) + fibonacciRec($n - 2);\n}\n\necho factorielle(5); // 120',
            ],
            'fonctions_variables' => [
                'description' => 'Fonctions variables : appeler une fonction via une variable contenant son nom, vérification avec is_callable().',
                'example' => 'function saluer($nom) {\n    return "Bonjour " . $nom;\n}\n\n$fonction = "saluer";\nif (is_callable($fonction)) {\n    echo $fonction("Marie"); // "Bonjour Marie"\n}\n\n// Avec méthodes\n$obj = new DateTime();\n$methode = "format";\necho $obj->$methode("Y-m-d");',
            ],
            'attributes_php8' => [
                'description' => 'Attributs PHP 8.0+ : métadonnées pour fonctions, classes et propriétés avec la syntaxe #[Attribute].',
                'example' => '#[Attribute]\nclass Deprecated {\n    public function __construct(public string $message = "") {}\n}\n\n#[Deprecated("Utilisez nouvelleMethode() à la place")]\nfunction ancienneMethode() {\n    // Code déprécié\n}\n\n// Lecture des attributs\n$reflection = new ReflectionFunction("ancienneMethode");\n$attributes = $reflection->getAttributes(Deprecated::class);',
            ],
            'named_arguments_php8' => [
                'description' => 'Arguments nommés (PHP 8.0+) : passer des arguments par nom plutôt que par position, améliore la lisibilité.',
                'example' => 'function creerUtilisateur($nom, $age, $email, $actif = true) {\n    return compact("nom", "age", "email", "actif");\n}\n\n// Arguments positionnels classiques\n$user1 = creerUtilisateur("John", 25, "john@example.com");\n\n// Arguments nommés (PHP 8.0+)\n$user2 = creerUtilisateur(\n    nom: "Marie",\n    email: "marie@example.com", \n    age: 30,\n    actif: false\n);',
            ],
            'first_class_callable_php81' => [
                'description' => 'First-class callable syntax (PHP 8.1+) : obtenir une référence callable avec la syntaxe ... plus élégante.',
                'example' => 'function multiplier($a, $b) {\n    return $a * $b;\n}\n\nclass Calculator {\n    public function add($a, $b) {\n        return $a + $b;\n    }\n}\n\n// PHP 8.1+ First-class callable\n$fn = multiplier(...);\n$result = $fn(3, 4); // 12\n\n$calc = new Calculator();\n$addFn = $calc->add(...);\n$sum = $addFn(5, 3); // 8',
            ],
        ];
        return $this->render('fonction_php/index.html.twig', [
            'data' => $dataFonctionsPHP,
        ]);
    }
}
