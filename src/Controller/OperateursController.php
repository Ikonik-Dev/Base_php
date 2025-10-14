<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class OperateursController extends AbstractController
{
    #[Route('/operateurs', name: 'app_operateurs')]
    public function index(): Response
    {
// Données complètes sur les opérateurs PHP : arithmétiques, comparaison, logiques, affectation, incrémentation, bitwise, et opérateurs spéciaux avec exemples pratiques
$dataOperateursPHP = [
    'operateurs_arithmetiques' => [
        'description' => 'Opérateurs pour effectuer des calculs mathématiques : addition, soustraction, multiplication, division, modulo, exponentiation.',
        'example' => '$a = 10; $b = 3;\n$addition = $a + $b; // 13\n$division = $a / $b; // 3.333...\n$modulo = $a % $b; // 1\n$puissance = $a ** $b; // 1000',
    ],
    'operateurs_comparaison' => [
        'description' => 'Opérateurs pour comparer des valeurs et retourner true/false : égalité, inégalité, supérieur, inférieur.',
        'example' => '$x = 5; $y = "5";\nvar_dump($x == $y);  // true (égalité)\nvar_dump($x === $y); // false (identité)\nvar_dump($x != $y);  // false\nvar_dump($x <=> $y); // 0 (spaceship)',
    ],
    'operateurs_logiques' => [
        'description' => 'Opérateurs pour combiner des expressions booléennes : AND, OR, NOT, XOR avec priorités différentes.',
        'example' => '$a = true; $b = false;\nvar_dump($a && $b); // false (AND)\nvar_dump($a || $b); // true (OR)\nvar_dump(!$a);      // false (NOT)\nvar_dump($a xor $b); // true (XOR)',
    ],
    'operateurs_affectation' => [
        'description' => 'Opérateurs pour assigner des valeurs : affectation simple et composée (+=, -=, *=, /=, %=, etc.).',
        'example' => '$x = 10;\n$x += 5;  // $x = $x + 5 = 15\n$x -= 3;  // $x = $x - 3 = 12\n$x *= 2;  // $x = $x * 2 = 24\n$x /= 4;  // $x = $x / 4 = 6',
    ],
    'operateurs_incrementation' => [
        'description' => 'Opérateurs pour augmenter/diminuer une variable : pré-incrémentation, post-incrémentation, pré-décrémentation, post-décrémentation.',
        'example' => '$i = 5;\necho ++$i; // 6 (pré-incrémentation)\necho $i++; // 6 (post-incrémentation, $i devient 7)\necho --$i; // 6 (pré-décrémentation)\necho $i--; // 6 (post-décrémentation, $i devient 5)',
    ],
    'operateurs_concatenation' => [
        'description' => 'Opérateurs pour joindre des chaînes de caractères : concaténation simple (.) et avec affectation (.=).',
        'example' => '$nom = "John";\n$age = 25;\n$message = "Bonjour " . $nom; // "Bonjour John"\n$message .= ", vous avez " . $age . " ans"; // Concaténation avec affectation',
    ],
    'operateurs_tableaux' => [
        'description' => 'Opérateurs spécifiques aux tableaux : union (+), égalité (==), identité (===), inégalité (!=, <>).',
        'example' => '$arr1 = [1, 2, 3];\n$arr2 = [4, 5, 6];\n$union = $arr1 + $arr2; // [1, 2, 3]\n$arr3 = [1, 2, 3];\nvar_dump($arr1 == $arr3); // true\nvar_dump($arr1 === $arr3); // true',
    ],
    'operateurs_ternaire' => [
        'description' => 'Opérateur conditionnel ternaire pour des conditions courtes : condition ? valeur_si_vrai : valeur_si_faux.',
        'example' => '$age = 18;\n$statut = ($age >= 18) ? "majeur" : "mineur";\n// Null coalescing\n$nom = $utilisateur ?? "Anonyme";\n// Null coalescing assignment (PHP 7.4+)\n$config[\'debug\'] ??= false;',
    ],
    'operateurs_null_coalescing' => [
        'description' => 'Opérateurs pour gérer les valeurs null : null coalescing (??) et null coalescing assignment (??=).',
        'example' => '$nom = $_GET[\'nom\'] ?? "Défaut";\n$config = $config ?? [];\n// Assignment (PHP 7.4+)\n$settings[\'theme\'] ??= "dark";\n// Équivalent à :\n// $settings[\'theme\'] = $settings[\'theme\'] ?? "dark";',
    ],
    'operateurs_bitwise' => [
        'description' => 'Opérateurs au niveau des bits : AND (&), OR (|), XOR (^), NOT (~), décalages (<< >>).',
        'example' => '$a = 12; // 1100 en binaire\n$b = 10; // 1010 en binaire\necho $a & $b;  // 8 (1000)\necho $a | $b;  // 14 (1110)\necho $a ^ $b;  // 6 (0110)\necho $a << 1; // 24 (décalage gauche)',
    ],
    'operateurs_instanceof' => [
        'description' => 'Opérateur pour vérifier si un objet est une instance d\'une classe ou implémente une interface.',
        'example' => 'class Personne {}\n$obj = new Personne();\nvar_dump($obj instanceof Personne); // true\nvar_dump($obj instanceof stdClass); // false\nvar_dump($obj instanceof Countable); // false',
    ],
    'operateurs_execution' => [
        'description' => 'Opérateur d\'exécution (backticks) pour exécuter des commandes système (à éviter pour la sécurité).',
        'example' => '// ATTENTION : Risque de sécurité !\n$output = `ls -la`; // Unix/Linux\n$output = `dir`; // Windows\n// Préférer : shell_exec(), exec(), system()',
    ],
    'operateurs_suppression_erreur' => [
        'description' => 'Opérateur de suppression d\'erreur (@) pour ignorer les erreurs (à utiliser avec parcimonie).',
        'example' => '$contenu = @file_get_contents("fichier.txt");\n// Supprime les warnings si le fichier n\'existe pas\n$connexion = @mysql_connect("localhost", "user", "pass");\n// Attention : masque les erreurs importantes !',
    ],
    'precedence_operateurs' => [
        'description' => 'Ordre de priorité des opérateurs : parenthèses, puis **, puis *, /, %, puis +, -, puis comparaisons, puis logiques.',
        'example' => '$result = 2 + 3 * 4; // 14 (pas 20)\n$result = (2 + 3) * 4; // 20\n$result = 2 ** 3 * 4; // 32 (2^3 = 8, puis 8*4)\n$result = true || false && false; // true (AND prioritaire)',
    ],
    'operateurs_type' => [
        'description' => 'Opérateurs liés aux types : instanceof, cast, is_*() pour la vérification et conversion de types.',
        'example' => '$var = "123";\n$int = (int) $var; // Cast vers entier\n$bool = (bool) $var; // Cast vers booléen\nvar_dump(is_string($var)); // true\nvar_dump(is_numeric($var)); // true',
    ],
];

        return $this->render('operateurs/index.html.twig', [
            'data' => $dataOperateursPHP,
        ]);
    }
}
