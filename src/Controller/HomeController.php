<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // tableaux associatif de données des grandes notion de cours php avec granularité fine
        $data = [
            'variables' => [
                'description' => 'Les variables en PHP sont utilisées pour stocker des données. Elles sont déclarées avec le signe $ suivi du nom de la variable.',
                'example' => '$maVariable = "Bonjour";',
            ],
            'types_de_donnees' => [
                'description' => 'PHP supporte plusieurs types de données, y compris les entiers, les flottants, les chaînes de caractères, les tableaux, les objets, et les types spéciaux comme NULL.',
                'example' => '$monEntier = 42; $maChaine = "Hello World";',
            ],
            'operateurs' => [
                'description' => 'Les opérateurs en PHP sont utilisés pour effectuer des opérations sur des variables et des valeurs. Ils incluent les opérateurs arithmétiques, de comparaison, logiques, et plus encore.',
                'example' => '$somme = $a + $b; $estEgal = ($a == $b);',
            ],
            'structures_de_controle' => [
                'description' => 'Les structures de contrôle en PHP permettent de contrôler le flux d\'exécution du code. Cela inclut les instructions conditionnelles (if, else, switch) et les boucles (for, while, foreach).',
                'example' => 'if ($a > $b) { echo "A est plus grand que B"; }',
            ],
            'fonctions' => [
                'description' => 'Les fonctions en PHP sont des blocs de code réutilisables qui effectuent une tâche spécifique. Elles peuvent accepter des paramètres et retourner des valeurs.',
                'example' => 'function addition($a, $b) { return $a + $b; }',
            ],
            'tableaux' => [
                'description' => 'Les tableaux en PHP sont des structures de données qui peuvent contenir plusieurs valeurs. Ils peuvent être indexés numériquement ou associatifs (avec des clés personnalisées).',
                'example' => '$monTableau = array("pomme", "banane", "cerise");',
            ],
            'manipulation_de_chaines' => [
                'description' => 'PHP offre de nombreuses fonctions pour manipuler les chaînes de caractères, comme la concaténation, la recherche, le remplacement, et la modification de la casse.',
                'example' => '$chaine = "Bonjour"; $chaine .= " le monde!";',
            ],
            'gestion_des_erreurs' => [
                'description' => 'La gestion des erreurs en PHP peut être effectuée à l\'aide de fonctions intégrées comme try-catch, error_reporting, et set_error_handler pour capturer et gérer les erreurs de manière appropriée.',
                'example' => 'try { // code qui peut générer une exception } catch (Exception $e) { echo "Erreur : " . $e->getMessage(); }',
            ],
            'programmation_orientee_objet' => [
                'description' => 'PHP supporte la programmation orientée objet (POO), permettant la création de classes, d\'objets, l\'héritage, et l\'encapsulation.',
                'example' => 'class Voiture { public $couleur; function demarrer() { echo "La voiture démarre"; } }',
            ],
            'interaction_avec_les_bases_de_donnees' => [
                'description' => 'PHP peut interagir avec des bases de données comme MySQL, PostgreSQL, et SQLite en utilisant des extensions comme PDO ou MySQLi pour exécuter des requêtes SQL.',
                'example' => '$pdo = new PDO("mysql:host=localhost;dbname=testdb", "user", "password");',
            ],
        ];
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'data' => $data,
        ]);
    }
}
