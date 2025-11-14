<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IntroMVCController extends AbstractController
{
    #[Route('/intro-mvc', name: 'app_intro_mvc')]
    public function index(): Response
    {
        // Introduction à l'exercice MVC
        $presentation = [
            'title' => 'Introduction Pratique au MVC avec Symfony',
            'description' => 'Exercice pratique pour comprendre le pattern MVC en créant une mini-boutique étape par étape.',
            'niveau' => 'Débutant/Intermédiaire',
            'duree_estimee' => '3-4 heures',
            'objectif' => 'Maîtriser les concepts MVC à travers un projet concret et simple'
        ];

        // Étapes de l'exercice pratique
        $etapes_exercice = [
            [
                'numero' => 1,
                'titre' => 'Création de l\'Entité Product (MODEL)',
                'description' => 'Modéliser les données produit avec Doctrine',
                'duree' => '30min',
                'niveau' => 'Facile',
                'composant_mvc' => 'Model',
                'objectifs' => [
                    'Créer l\'entité Product avec ses propriétés',
                    'Comprendre les annotations Doctrine',
                    'Générer et exécuter la migration',
                    'Tester l\'entité avec des données basiques'
                ],
                'code_exemple' => [
                    'fichier' => 'src/Entity/Product.php',
                    'contenu' => '<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    private string $name;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private float $price;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $description = null;

    // Getters et setters...
}'
                ],
                'commandes' => [
                    'php bin/console make:entity Product',
                    'php bin/console make:migration',
                    'php bin/console doctrine:migrations:migrate'
                ]
            ],
            [
                'numero' => 2,
                'titre' => 'Création des Fixtures (DONNÉES)',
                'description' => 'Alimenter la base avec des données de test',
                'duree' => '20min',
                'niveau' => 'Facile',
                'composant_mvc' => 'Data',
                'objectifs' => [
                    'Installer le bundle DoctrineFixtures',
                    'Créer des données de test réalistes',
                    'Charger les fixtures en base',
                    'Vérifier les données créées'
                ],
                'code_exemple' => [
                    'fichier' => 'src/DataFixtures/ProductFixtures.php',
                    'contenu' => '<?php
namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $products = [
            ["Laptop HP", 899.99, "Ordinateur portable performant"],
            ["Souris Gaming", 45.50, "Souris haute précision"],
            ["Clavier Mécanique", 129.00, "Clavier gaming RGB"],
        ];

        foreach ($products as [$name, $price, $desc]) {
            $product = new Product();
            $product->setName($name)
                   ->setPrice($price)
                   ->setDescription($desc);
            $manager->persist($product);
        }
        $manager->flush();
    }
}'
                ],
                'commandes' => [
                    'composer require --dev orm-fixtures',
                    'php bin/console make:fixtures ProductFixtures',
                    'php bin/console doctrine:fixtures:load'
                ]
            ],
            [
                'numero' => 3,
                'titre' => 'Création du Repository (MODEL)',
                'description' => 'Logique d\'accès aux données',
                'duree' => '25min',
                'niveau' => 'Facile',
                'composant_mvc' => 'Model',
                'objectifs' => [
                    'Comprendre le rôle du Repository',
                    'Créer des méthodes de recherche personnalisées',
                    'Implémenter la pagination',
                    'Tester les requêtes'
                ],
                'code_exemple' => [
                    'fichier' => 'src/Repository/ProductRepository.php',
                    'contenu' => '<?php
namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class ProductRepository extends ServiceEntityRepository
{
    public function findExpensiveProducts(float $minPrice): array
    {
        return $this->createQueryBuilder("p")
            ->andWhere("p.price >= :price")
            ->setParameter("price", $minPrice)
            ->orderBy("p.price", "DESC")
            ->getQuery()
            ->getResult();
    }

    public function findBySearchTerm(string $term): array
    {
        return $this->createQueryBuilder("p")
            ->andWhere("p.name LIKE :term OR p.description LIKE :term")
            ->setParameter("term", "%{$term}%")
            ->getQuery()
            ->getResult();
    }
}'
                ],
                'commandes' => [
                    'php bin/console make:repository Product'
                ]
            ],
            [
                'numero' => 4,
                'titre' => 'Création du Contrôleur (CONTROLLER)',
                'description' => 'Logique de traitement des requêtes',
                'duree' => '35min',
                'niveau' => 'Moyen',
                'composant_mvc' => 'Controller',
                'objectifs' => [
                    'Créer le contrôleur ShopController',
                    'Implémenter les actions (liste, détail)',
                    'Gérer les paramètres de route',
                    'Passer les données aux vues'
                ],
                'code_exemple' => [
                    'fichier' => 'src/Controller/ShopController.php',
                    'contenu' => '<?php
namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/shop")]
class ShopController extends AbstractController
{
    #[Route("/", name: "shop_index")]
    public function index(ProductRepository $repository): Response
    {
        $products = $repository->findAll();
        
        return $this->render("shop/index.html.twig", [
            "products" => $products
        ]);
    }

    #[Route("/product/{id}", name: "shop_product_show")]
    public function show(Product $product): Response
    {
        return $this->render("shop/show.html.twig", [
            "product" => $product
        ]);
    }
}'
                ],
                'commandes' => [
                    'php bin/console make:controller ShopController'
                ]
            ],
            [
                'numero' => 5,
                'titre' => 'Création des Templates (VIEW)',
                'description' => 'Interface utilisateur avec Twig',
                'duree' => '40min',
                'niveau' => 'Moyen',
                'composant_mvc' => 'View',
                'objectifs' => [
                    'Créer les templates Twig',
                    'Afficher les données dynamiques',
                    'Gérer les liens et la navigation',
                    'Styliser l\'interface'
                ],
                'code_exemple' => [
                    'fichier' => 'templates/shop/index.html.twig',
                    'contenu' => '{% extends "base.html.twig" %}

{% block title %}Ma Boutique{% endblock %}

{% block body %}
<div class="container">
    <h1>Nos Produits</h1>
    
    <div class="products-grid">
        {% for product in products %}
            <div class="product-card">
                <h3>{{ product.name }}</h3>
                <p class="price">{{ product.price }}€</p>
                <p>{{ product.description }}</p>
                <a href="{{ path("shop_product_show", {id: product.id}) }}" 
                   class="btn btn-primary">Voir détails</a>
            </div>
        {% endfor %}
    </div>
</div>
{% endblock %}'
                ],
                'commandes' => [
                    'mkdir templates/shop',
                    'touch templates/shop/index.html.twig',
                    'touch templates/shop/show.html.twig'
                ]
            ],
            [
                'numero' => 6,
                'titre' => 'Test et Validation (ENSEMBLE)',
                'description' => 'Vérifier le fonctionnement du MVC',
                'duree' => '30min',
                'niveau' => 'Facile',
                'composant_mvc' => 'All',
                'objectifs' => [
                    'Tester l\'application complète',
                    'Vérifier le flux de données MVC',
                    'Débugger les éventuels problèmes',
                    'Comprendre l\'interaction des composants'
                ],
                'code_exemple' => [
                    'fichier' => 'Tests de navigation',
                    'contenu' => '// URLs à tester :
// http://localhost:8000/shop (liste des produits)
// http://localhost:8000/shop/product/1 (détail produit)

// Flux MVC :
// 1. Route → Controller (réception requête)
// 2. Controller → Repository → Entity (récupération données)
// 3. Controller → Template (rendu vue)
// 4. Template → Navigateur (affichage final)'
                ],
                'commandes' => [
                    'symfony server:start',
                    'php bin/console debug:router | grep shop',
                    'php bin/console doctrine:query:sql "SELECT * FROM product"'
                ]
            ]
        ];

        // Concepts MVC expliqués simplement
        $concepts_mvc = [
            'model' => [
                'title' => 'MODEL - La Donnée',
                'description' => 'Gère les données et la logique métier',
                'role' => 'Représente et manipule les informations',
                'composants' => [
                    'Entity' => 'Structure des données (Product.php)',
                    'Repository' => 'Accès aux données (ProductRepository.php)',
                    'Doctrine' => 'ORM pour la base de données'
                ],
                'responsabilites' => [
                    'Définir la structure des données',
                    'Valider les données',
                    'Interagir avec la base de données',
                    'Contenir la logique métier'
                ]
            ],
            'view' => [
                'title' => 'VIEW - L\'Affichage',
                'description' => 'Présente les données à l\'utilisateur',
                'role' => 'Interface utilisateur et présentation',
                'composants' => [
                    'Templates Twig' => 'Fichiers .html.twig',
                    'CSS' => 'Stylisation de l\'interface',
                    'JavaScript' => 'Interactions côté client'
                ],
                'responsabilites' => [
                    'Afficher les données',
                    'Collecter les entrées utilisateur',
                    'Présenter une interface intuitive',
                    'Être responsive et accessible'
                ]
            ],
            'controller' => [
                'title' => 'CONTROLLER - La Logique',
                'description' => 'Fait le lien entre Model et View',
                'role' => 'Chef d\'orchestre de l\'application',
                'composants' => [
                    'Controllers' => 'Classes avec méthodes d\'action',
                    'Routes' => 'Mapping URL → méthode',
                    'Services' => 'Logique métier complexe'
                ],
                'responsabilites' => [
                    'Recevoir les requêtes HTTP',
                    'Appeler les services nécessaires',
                    'Préparer les données pour la vue',
                    'Retourner la réponse HTTP'
                ]
            ]
        ];

        // Avantages du pattern MVC
        $avantages_mvc = [
            'separation' => [
                'titre' => 'Séparation des Préoccupations',
                'description' => 'Chaque composant a une responsabilité unique et bien définie',
                'exemple' => 'Le Repository s\'occupe uniquement des données, le Controller de la logique, la Vue de l\'affichage'
            ],
            'maintenabilite' => [
                'titre' => 'Maintenabilité',
                'description' => 'Modifier une partie n\'affecte pas les autres',
                'exemple' => 'Changer le design (View) n\'impacte pas la logique métier (Model)'
            ],
            'testabilite' => [
                'titre' => 'Testabilité',
                'description' => 'Chaque composant peut être testé indépendamment',
                'exemple' => 'Tests unitaires du Repository, tests d\'intégration du Controller'
            ],
            'reutilisabilite' => [
                'titre' => 'Réutilisabilité',
                'description' => 'Les composants peuvent être réutilisés dans d\'autres contextes',
                'exemple' => 'Un Repository peut servir à plusieurs Controllers différents'
            ]
        ];

        return $this->render('intro_mvc/index.html.twig', [
            'pageTitle' => 'Intro MVC',
            'presentation' => $presentation,
            'etapes_exercice' => $etapes_exercice,
            'concepts_mvc' => $concepts_mvc,
            'avantages_mvc' => $avantages_mvc
        ]);
    }
}
