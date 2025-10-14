<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class StructureControleController extends AbstractController
{
    #[Route('/structure/controle', name: 'app_structure_controle')]
    public function index(): Response
    {

        // Données complètes sur les structures de contrôle PHP : conditions, boucles, match, switch, include/require, gestion d'erreurs et structures modernes PHP 7/8
        $dataStructuresControlePHP = [
            'structures_conditionnelles' => [
                'description' => 'Structures pour exécuter du code selon des conditions : if, else, elseif, switch avec syntaxes alternatives.',
                'example' => 'if ($age >= 18) {\n    echo "Majeur";\n} elseif ($age >= 16) {\n    echo "Mineur émancipé";\n} else {\n    echo "Mineur";\n}',
            ],
            'condition_if_else' => [
                'description' => 'Structure conditionnelle de base avec if, else et elseif. Supporte la syntaxe alternative avec deux points.',
                'example' => '// Syntaxe classique\nif ($condition) {\n    // code\n}\n\n// Syntaxe alternative\nif ($condition):\n    // code\nendif;',
            ],
            'operateur_ternaire_moderne' => [
                'description' => 'Opérateurs ternaires classiques et modernes : ternaire simple, null coalescing (??) et null coalescing assignment (??=).',
                'example' => '$statut = $age >= 18 ? "majeur" : "mineur";\n$nom = $_GET[\'nom\'] ?? "Anonyme";\n$config[\'debug\'] ??= false; // PHP 7.4+',
            ],
            'structure_switch' => [
                'description' => 'Structure switch pour comparer une variable à plusieurs valeurs. Attention aux break et au fall-through.',
                'example' => 'switch ($jour) {\n    case \'lundi\':\n    case \'mardi\':\n        echo "Début de semaine";\n        break;\n    case \'vendredi\':\n        echo "TGIF!";\n        break;\n    default:\n        echo "Autre jour";\n}',
            ],
            'expression_match_php8' => [
                'description' => 'Expression match (PHP 8.0+) : alternative moderne au switch, plus stricte et qui retourne une valeur.',
                'example' => '$resultat = match($status) {\n    200, 300 => "Succès",\n    400 => "Erreur client",\n    500 => "Erreur serveur",\n    default => "Statut inconnu"\n};\n\n$type = match(true) {\n    $age < 13 => "enfant",\n    $age < 18 => "adolescent",\n    default => "adulte"\n};',
            ],
            'boucles_for' => [
                'description' => 'Boucle for classique avec initialisation, condition et incrémentation. Idéale pour un nombre d\'itérations connu.',
                'example' => 'for ($i = 0; $i < 10; $i++) {\n    echo $i . " ";\n}\n\n// Syntaxe alternative\nfor ($i = 0; $i < 10; $i++):\n    echo $i;\nendfor;',
            ],
            'boucles_while' => [
                'description' => 'Boucles while et do-while : while teste la condition avant, do-while teste après (au moins une exécution).',
                'example' => '$i = 0;\nwhile ($i < 5) {\n    echo $i++;\n}\n\n$j = 0;\ndo {\n    echo $j++;\n} while ($j < 3);',
            ],
            'boucles_foreach' => [
                'description' => 'Boucle foreach pour parcourir tableaux et objets. Accès aux clés et valeurs, par référence possible.',
                'example' => '$fruits = ["pomme", "banane", "orange"];\n\n// Valeurs seulement\nforeach ($fruits as $fruit) {\n    echo $fruit;\n}\n\n// Clés et valeurs\nforeach ($fruits as $index => $fruit) {\n    echo "$index: $fruit";\n}\n\n// Par référence\nforeach ($fruits as &$fruit) {\n    $fruit = strtoupper($fruit);\n}',
            ],
            'controle_boucles' => [
                'description' => 'Instructions de contrôle des boucles : break (sortir), continue (passer à l\'itération suivante), avec niveaux optionnels.',
                'example' => 'for ($i = 0; $i < 10; $i++) {\n    if ($i === 3) continue; // Passer 3\n    if ($i === 7) break;    // Arrêter à 7\n    echo $i;\n}\n\n// Avec niveaux\nfor ($i = 0; $i < 3; $i++) {\n    for ($j = 0; $j < 3; $j++) {\n        if ($j === 1) break 2; // Sortir des 2 boucles\n    }\n}',
            ],
            'include_require' => [
                'description' => 'Inclusion de fichiers : include/require (erreur non fatale/fatale) et leurs variantes _once pour éviter les doublons.',
                'example' => 'include "config.php";        // Warning si échec\nrequire "database.php";     // Fatal error si échec\ninclude_once "functions.php"; // Une seule fois\nrequire_once "classes.php";   // Une seule fois + fatal',
            ],
            'try_catch_finally' => [
                'description' => 'Gestion d\'exceptions avec try/catch/finally. Multiple catch possibles, finally toujours exécuté (PHP 5.5+).',
                'example' => 'try {\n    $pdo = new PDO($dsn, $user, $pass);\n    // code risqué\n} catch (PDOException $e) {\n    echo "Erreur BDD: " . $e->getMessage();\n} catch (Exception $e) {\n    echo "Erreur générale: " . $e->getMessage();\n} finally {\n    echo "Nettoyage";\n}',
            ],
            'throw_exceptions' => [
                'description' => 'Lancement d\'exceptions avec throw. Création d\'exceptions personnalisées héritant d\'Exception.',
                'example' => 'function diviser($a, $b) {\n    if ($b === 0) {\n        throw new InvalidArgumentException("Division par zéro!");\n    }\n    return $a / $b;\n}\n\nclass MonException extends Exception {\n    public function errorMessage() {\n        return "Erreur personnalisée: " . $this->getMessage();\n    }\n}',
            ],
            'goto_labels' => [
                'description' => 'Instruction goto pour sauter à un label (à éviter, nuit à la lisibilité). Utile dans de rares cas spécifiques.',
                'example' => '$i = 0;\nloop:\necho $i++;\nif ($i < 5) goto loop;\n\n// Sortie de boucles imbriquées\nfor ($i = 0; $i < 3; $i++) {\n    for ($j = 0; $j < 3; $j++) {\n        if ($condition) goto end;\n    }\n}\nend:\necho "Fin";',
            ],
            'declare_directives' => [
                'description' => 'Directive declare pour modifier le comportement du script : strict_types, ticks, encoding.',
                'example' => 'declare(strict_types=1); // Types stricts\n\nfunction additionner(int $a, int $b): int {\n    return $a + $b;\n}\n\n// declare(ticks=1);\n// declare(encoding=\'UTF-8\');',
            ],
            'return_yield' => [
                'description' => 'Instructions return (sortir de fonction) et yield (générateurs PHP 5.5+) pour retourner des valeurs de manière paresseuse.',
                'example' => 'function generateur() {\n    yield 1;\n    yield 2;\n    yield 3;\n}\n\nforeach (generateur() as $valeur) {\n    echo $valeur; // 1, 2, 3\n}\n\n// Yield avec clés\nfunction paires() {\n    yield \'a\' => 1;\n    yield \'b\' => 2;\n}',
            ],
            'structures_alternatives' => [
                'description' => 'Syntaxes alternatives des structures de contrôle avec deux points et mots-clés de fermeture (endif, endwhile, etc.).',
                'example' => '<?php if ($condition): ?>\n    <p>HTML mixé</p>\n<?php endif; ?>\n\n<?php foreach ($items as $item): ?>\n    <li><?= $item ?></li>\n<?php endforeach; ?>\n\n<?php while ($condition): ?>\n    <!-- contenu -->\n<?php endwhile; ?>',
            ],
        ];
        return $this->render('structure_controle/index.html.twig', [
            'data' => $dataStructuresControlePHP,
        ]);
    }
}
