<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TestModalsController extends AbstractController
{
    #[Route('/test-modals', name: 'app_test_modals')]
    public function index(): Response
    {
        // Données de test avec structure complète pour les modales
        $testData = [
            'exemple_variables' => [
                'description' => 'Les variables en PHP permettent de stocker des données. Elles commencent toujours par le symbole $.',
                'example' => '$nom = "Jean";\n$age = 25;',

                // Données enrichies pour la modale
                'details' => 'En PHP, les variables sont des conteneurs dynamiques qui peuvent stocker différents types de données. Elles sont déclarées avec le préfixe $ et ne nécessitent pas de déclaration de type explicite (typage dynamique). Le nom d\'une variable doit commencer par une lettre ou un underscore, suivi de lettres, chiffres ou underscores.',

                'useCases' => [
                    'Stocker des informations utilisateur (nom, email, âge)',
                    'Calculer des valeurs dynamiquement dans des formules',
                    'Transmettre des données entre différentes parties du code',
                    'Sauvegarder temporairement des résultats de requêtes'
                ],

                'warnings' => [
                    'Les variables sont sensibles à la casse : $nom et $Nom sont différentes',
                    'Toujours initialiser vos variables avant de les utiliser',
                    'Attention à la portée des variables (scope) dans les fonctions',
                    'Éviter les noms de variables trop courts ou cryptiques'
                ],

                'bestPractices' => [
                    'Utiliser des noms de variables explicites et descriptifs',
                    'Respecter la convention camelCase : $nomUtilisateur',
                    'Initialiser les variables avec des valeurs par défaut',
                    'Éviter les variables globales autant que possible',
                    'Utiliser des constantes pour les valeurs qui ne changent pas'
                ],

                'resources' => [
                    [
                        'label' => 'Documentation PHP - Variables',
                        'url' => 'https://www.php.net/manual/fr/language.variables.php',
                        'icon' => '📖'
                    ],
                    [
                        'label' => 'PHP The Right Way - Variables',
                        'url' => 'https://phptherightway.com',
                        'icon' => '🎓'
                    ]
                ],

                'relatedTopics' => [
                    ['id' => 'modal-exemple_types', 'label' => 'Types de données'],
                    ['id' => 'modal-exemple_operateurs', 'label' => 'Opérateurs d\'affectation']
                ]
            ],

            'exemple_types' => [
                'description' => 'PHP supporte plusieurs types de données : entiers, flottants, chaînes, booléens, tableaux, objets et null.',
                'example' => '$entier = 42;\n$texte = "Hello";\n$tableau = [1, 2, 3];',

                'details' => 'PHP est un langage à typage dynamique, ce qui signifie que le type d\'une variable est déterminé automatiquement lors de l\'exécution. Les types primitifs (scalaires) incluent les entiers (int), les nombres à virgule (float), les chaînes de caractères (string) et les booléens (bool). Les types composés incluent les tableaux (array) et les objets (object).',

                'useCases' => [
                    'Integer : compteurs, identifiants, âges',
                    'Float : prix, mesures, pourcentages',
                    'String : noms, messages, contenus textuels',
                    'Boolean : drapeaux, conditions, états actif/inactif',
                    'Array : listes d\'éléments, collections de données'
                ],

                'warnings' => [
                    'PHP convertit automatiquement les types (jonglage), ce qui peut causer des bugs',
                    'Comparer avec === plutôt que == pour éviter les conversions implicites',
                    'Les tableaux peuvent mélanger différents types (à éviter pour la clarté)',
                    'NULL n\'est pas égal à 0, "" ou false (bien que falsy)'
                ],

                'bestPractices' => [
                    'Utiliser les type hints en PHP 7+ : function test(int $n): string',
                    'Activer le mode strict_types pour éviter les conversions implicites',
                    'Vérifier les types avec is_int(), is_string(), etc.',
                    'Documenter les types attendus avec PHPDoc',
                    'Préférer les types scalaires précis aux types mixtes'
                ],

                'resources' => [
                    [
                        'label' => 'Documentation PHP - Types',
                        'url' => 'https://www.php.net/manual/fr/language.types.php',
                        'icon' => '📖'
                    ]
                ],

                'relatedTopics' => [
                    ['id' => 'modal-exemple_variables', 'label' => 'Variables'],
                    ['id' => 'modal-exemple_operateurs', 'label' => 'Opérateurs de comparaison']
                ]
            ],

            'exemple_operateurs' => [
                'description' => 'Les opérateurs permettent d\'effectuer des opérations sur les variables : arithmétiques, comparaison, logiques.',
                'example' => '$somme = $a + $b;\n$egal = ($a == $b);\n$et = ($a && $b);',

                'details' => 'PHP propose une large gamme d\'opérateurs pour manipuler les données. Les opérateurs arithmétiques (+, -, *, /, %, **) effectuent des calculs. Les opérateurs de comparaison (==, ===, !=, <, >, <=, >=) comparent des valeurs. Les opérateurs logiques (&&, ||, !, and, or, xor) combinent des conditions booléennes. Les opérateurs d\'affectation (=, +=, -=, etc.) modifient les variables.',

                'useCases' => [
                    'Calculs mathématiques : prix TTC = prix HT * 1.20',
                    'Conditions : if ($age >= 18 && $permis === true)',
                    'Incrémentation de compteurs : $compteur++',
                    'Concaténation de chaînes : $message = "Bonjour " . $nom',
                    'Opérations bitwise pour optimisation mémoire'
                ],

                'warnings' => [
                    'Différence entre == (égalité) et === (identité stricte)',
                    'Priorité des opérateurs : utilisez des parenthèses pour clarifier',
                    'Division par zéro génère une erreur fatale',
                    'L\'opérateur @ (suppression d\'erreur) masque les problèmes',
                    'Attention au null coalescing (??) vs ternaire (?:)'
                ],

                'bestPractices' => [
                    'Toujours utiliser === et !== pour les comparaisons',
                    'Utiliser le null coalescing : $nom = $_GET["nom"] ?? "Défaut"',
                    'Éviter les opérateurs d\'affectation combinés si moins lisibles',
                    'Préférer ++$i à $i++ en boucle (micro-optimisation)',
                    'Documenter les opérations complexes avec des commentaires'
                ],

                'resources' => [
                    [
                        'label' => 'Documentation PHP - Opérateurs',
                        'url' => 'https://www.php.net/manual/fr/language.operators.php',
                        'icon' => '📖'
                    ],
                    [
                        'label' => 'Priorité des opérateurs',
                        'url' => 'https://www.php.net/manual/fr/language.operators.precedence.php',
                        'icon' => '⚡'
                    ]
                ],

                'relatedTopics' => [
                    ['id' => 'modal-exemple_variables', 'label' => 'Variables'],
                    ['id' => 'modal-exemple_types', 'label' => 'Types de données']
                ]
            ]
        ];

        return $this->render('test-modals.html.twig', [
            'testData' => $testData,
        ]);
    }
}
