<?php

namespace App\Controller;

use App\Data\EcommerceEtapesData;
use App\Data\EcommerceConceptsData;
use App\Data\EcommerceTechnologiesData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EcommerceController extends AbstractController
{
    #[Route('/ecommerce', name: 'app_ecommerce')]
    public function index(): Response
    {
        $modalDetails = EcommerceEtapesData::getModalDetails();

        // Introduction du tutoriel e-commerce
        $presentation = [
            'label' => 'E-commerce avec Symfony - Tutoriel Progressif',
            'description' => 'Apprenez à construire un site e-commerce complet étape par étape en utilisant Symfony et ses bonnes pratiques.',
            'niveau' => 'Intermédiaire',
            'duree_estimee' => '8-12 heures',
            'prerequis' => [
                'Bases de PHP orienté objet',
                'Notions de base de données',
                'HTML/CSS',
                'Concepts Symfony de base'
            ]
        ];

        // Structure du tutoriel avec progression
        $etapes = [
            [
                'numero' => 1,
                'titre' => 'Fondations du Projet',
                'description' => 'Configuration initiale et structure MVC',
                'duree' => '1h',
                'concepts' => ['Installation Symfony', 'Configuration base', 'Architecture MVC'],
                'objectifs' => [
                    'Installer et configurer un projet Symfony',
                    'Comprendre la structure d\'un projet e-commerce',
                    'Configurer la base de données',
                    'Créer le layout de base'
                ],
                'livrables' => [
                    'Projet Symfony configuré',
                    'Base de données connectée',
                    'Template de base créé'
                ],
                'modal_details' => [
                    'description_detaillee' => 'Cette première étape pose les fondations de votre application e-commerce. Vous allez créer un nouveau projet Symfony, le configurer correctement, et mettre en place l\'architecture de base qui servira de socle pour toutes les fonctionnalités futures.',
                    'commandes' => [
                        [
                            'titre' => 'Création du projet',
                            'code' => 'symfony new mon-ecommerce --version="7.3.*" --webapp',
                            'explication' => 'Crée un nouveau projet Symfony 7.3 avec toutes les dépendances web (Twig, Asset Mapper, etc.)'
                        ],
                        [
                            'titre' => 'Installation des dépendances',
                            'code' => 'composer require symfony/orm-pack
composer require --dev symfony/maker-bundle',
                            'explication' => 'Installe Doctrine ORM pour la base de données et MakerBundle pour générer du code'
                        ],
                        [
                            'titre' => 'Configuration de la base de données',
                            'code' => '# Dans .env.local
DATABASE_URL="mysql://user:password@127.0.0.1:3306/ecommerce_db?serverVersion=8.0"',
                            'explication' => 'Configure la connexion à votre base de données MySQL'
                        ],
                        [
                            'titre' => 'Création de la base de données',
                            'code' => 'php bin/console doctrine:database:create',
                            'explication' => 'Crée physiquement la base de données'
                        ]
                    ],
                    'fichiers_a_creer' => [
                        [
                            'path' => 'templates/base.html.twig',
                            'description' => 'Template de base pour toutes les pages',
                            'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{% block title %}Boutique E-commerce{% endblock %}</title>
    {% block stylesheets %}{% endblock %}
</head>
<body>
    <nav class="navbar">
        <a href="{{ path(\'app_home\') }}">Accueil</a>
        <a href="{{ path(\'app_products\') }}">Produits</a>
    </nav>
    
    <main>
        {% block body %}{% endblock %}
    </main>
    
    {% block javascripts %}{% endblock %}
</body>
</html>'
                        ]
                    ],
                    'checklist' => [
                        'Le serveur Symfony démarre correctement (symfony serve)',
                        'Vous pouvez accéder à https://127.0.0.1:8000',
                        'La base de données est créée et accessible',
                        'Le template de base s\'affiche sans erreur'
                    ],
                    'pieges_communs' => [
                        'Oublier de démarrer MySQL/MariaDB avant de créer la base',
                        'Erreur de connexion : vérifier les identifiants dans .env',
                        'Port 8000 déjà utilisé : utiliser symfony serve -d ou changer le port'
                    ],
                    'ressources' => [
                        ['label' => 'Installation Symfony', 'url' => 'https://symfony.com/doc/current/setup.html', 'icon' => '📖'],
                        ['label' => 'Doctrine Setup', 'url' => 'https://symfony.com/doc/current/doctrine.html', 'icon' => '🗄️']
                    ]
                ]
            ],
            [
                'numero' => 2,
                'titre' => 'Modélisation des Données',
                'description' => 'Création des entités et relations',
                'duree' => '1.5h',
                'concepts' => ['Entités Doctrine', 'Relations', 'Migrations'],
                'objectifs' => [
                    'Créer les entités Product et Category',
                    'Définir les relations entre entités',
                    'Générer et exécuter les migrations',
                    'Comprendre les fixtures de données'
                ],
                'livrables' => [
                    'Entités complètes avec annotations',
                    'Base de données structurée',
                    'Données de test créées'
                ],
                'modal_details' => [
                    'description_detaillee' => 'La modélisation des données est cruciale pour un e-commerce. Vous allez créer les entités qui représentent vos produits et catégories, puis définir comment elles interagissent entre elles. L\'entité User sera créée plus tard lors de l\'étape Authentification.',
                    'commandes' => [
                        [
                            'titre' => 'Création de l\'entité Product',
                            'code' => 'php bin/console make:entity Product',
                            'explication' => 'Lance l\'assistant interactif pour créer l\'entité Product avec ses propriétés'
                        ],
                        [
                            'titre' => 'Création de l\'entité Category',
                            'code' => 'php bin/console make:entity Category',
                            'explication' => 'Crée l\'entité Category pour organiser vos produits'
                        ],
                        [
                            'titre' => 'Génération de la migration',
                            'code' => 'php bin/console make:migration',
                            'explication' => 'Génère le fichier de migration basé sur vos entités'
                        ],
                        [
                            'titre' => 'Exécution de la migration',
                            'code' => 'php bin/console doctrine:migrations:migrate',
                            'explication' => 'Applique les modifications à la base de données'
                        ]
                    ],
                    'fichiers_a_creer' => [
                        [
                            'path' => 'src/Entity/Product.php',
                            'description' => 'Entité représentant un produit',
                            'code' => '<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: "text")]
    private ?string $description = null;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private ?string $price = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\ManyToOne(inversedBy: "products")]
    private ?Category $category = null;
    
    // Getters et setters...
}'
                        ]
                    ],
                    'checklist' => [
                        'Les entités Product et Category sont créées',
                        'Les relations ManyToOne et OneToMany sont correctement définies',
                        'La migration s\'exécute sans erreur',
                        'Les tables apparaissent dans votre base de données'
                    ],
                    'pieges_communs' => [
                        'Oublier de définir le inversedBy et mappedBy pour les relations',
                        'Type decimal pour le prix : utiliser "decimal" pas "float"',
                        'Ne pas oublier nullable: false pour les champs obligatoires'
                    ],
                    'ressources' => [
                        ['label' => 'Doctrine Entities', 'url' => 'https://symfony.com/doc/current/doctrine.html#creating-an-entity-class', 'icon' => '🗂️'],
                        ['label' => 'Relations Doctrine', 'url' => 'https://symfony.com/doc/current/doctrine/associations.html', 'icon' => '🔗']
                    ]
                ]
            ],
            [
                'numero' => 3,
                'titre' => 'Catalogue Produits',
                'description' => 'Interface publique de présentation',
                'duree' => '2h',
                'concepts' => ['Repositories', 'Twig', 'Pagination'],
                'objectifs' => [
                    'Créer la page d\'accueil avec produits vedettes',
                    'Développer la liste complète des produits',
                    'Implémenter la pagination',
                    'Créer la page détail produit'
                ],
                'livrables' => [
                    'Page d\'accueil fonctionnelle',
                    'Catalogue avec pagination',
                    'Fiches produits détaillées'
                ]
            ],
            [
                'numero' => 4,
                'titre' => 'Système de Panier',
                'description' => 'Gestion du panier d\'achat',
                'duree' => '1.5h',
                'concepts' => ['Sessions', 'Services', 'EventListeners'],
                'objectifs' => [
                    'Créer un service de gestion du panier',
                    'Ajouter/supprimer des produits',
                    'Calculer les totaux automatiquement',
                    'Persister le panier en session'
                ],
                'livrables' => [
                    'Service Cart fonctionnel',
                    'Interface d\'ajout au panier',
                    'Page panier avec modification quantités'
                ]
            ],
            [
                'numero' => 5,
                'titre' => 'Authentification',
                'description' => 'Gestion des utilisateurs',
                'duree' => '1.5h',
                'concepts' => ['Security', 'Forms', 'Voter'],
                'objectifs' => [
                    'Configurer le système de sécurité',
                    'Créer les formulaires d\'inscription/connexion',
                    'Gérer les profils utilisateurs',
                    'Protéger les routes sensibles'
                ],
                'livrables' => [
                    'Système d\'authentification complet',
                    'Formulaires de connexion/inscription',
                    'Gestion des rôles utilisateurs'
                ]
            ],
            [
                'numero' => 6,
                'titre' => 'Processus de Commande',
                'description' => 'Du panier à la confirmation',
                'duree' => '2h',
                'concepts' => ['Forms complexes', 'Validation', 'Workflow'],
                'objectifs' => [
                    'Créer l\'entité Order',
                    'Développer le processus de checkout',
                    'Valider les données de commande',
                    'Gérer la confirmation et l\'historique'
                ],
                'livrables' => [
                    'Processus de commande complet',
                    'Validation des données',
                    'Historique des commandes'
                ]
            ],
            [
                'numero' => 7,
                'titre' => 'Interface d\'Administration',
                'description' => 'Back-office de gestion',
                'duree' => '2h',
                'concepts' => ['CRUD', 'Permissions', 'Dashboard'],
                'objectifs' => [
                    'Créer l\'interface d\'administration',
                    'Gérer les produits (CRUD)',
                    'Dashboard des commandes',
                    'Statistiques de base'
                ],
                'livrables' => [
                    'Interface admin complète',
                    'Gestion des produits',
                    'Dashboard avec statistiques'
                ]
            ],
            [
                'numero' => 8,
                'titre' => 'Fonctionnalités Avancées',
                'description' => 'Optimisations et déploiement',
                'duree' => '1.5h',
                'concepts' => ['Upload', 'Email', 'Cache', 'Tests'],
                'objectifs' => [
                    'Implémenter l\'upload d\'images',
                    'Configurer l\'envoi d\'emails',
                    'Optimiser les performances',
                    'Préparer le déploiement'
                ],
                'livrables' => [
                    'Upload d\'images fonctionnel',
                    'Notifications par email',
                    'Application optimisée'
                ]
            ]
        ];

        // Concepts techniques détaillés
        $concepts_techniques = [
            'architecture' => [
                'label' => 'Architecture E-commerce',
                'description' => 'Structure modulaire et évolutive',
                'composants' => [
                    'Frontend' => 'Interface utilisateur responsive',
                    'Backend' => 'API et logique métier',
                    'Database' => 'Stockage optimisé des données',
                    'Security' => 'Authentification et autorisations'
                ]
            ],
            'patterns' => [
                'label' => 'Design Patterns Utilisés',
                'description' => 'Bonnes pratiques de développement',
                'liste' => [
                    'Repository Pattern' => 'Abstraction de l\'accès aux données',
                    'Service Pattern' => 'Logique métier centralisée',
                    'Observer Pattern' => 'Événements et listeners',
                    'Strategy Pattern' => 'Flexibilité des algorithmes'
                ]
            ],
            'securite' => [
                'label' => 'Aspects Sécurité',
                'description' => 'Protection contre les vulnérabilités courantes',
                'mesures' => [
                    'CSRF Protection' => 'Protection contre les attaques CSRF',
                    'XSS Prevention' => 'Échappement automatique des données',
                    'SQL Injection' => 'Utilisation de Doctrine ORM',
                    'Authentication' => 'Système robuste d\'authentification'
                ]
            ]
        ];

        // Technologies et outils utilisés
        $technologies = [
            'backend' => [
                'Symfony 7.3' => 'Framework principal',
                'Doctrine ORM' => 'Gestion de la base de données',
                'Twig' => 'Moteur de templates',
                'Symfony Security' => 'Authentification et autorisations'
            ],
            'frontend' => [
                'Bootstrap 5' => 'Framework CSS responsive',
                'JavaScript ES6+' => 'Interactivité client',
                'Stimulus' => 'Contrôleurs JavaScript légers',
                'Asset Mapper' => 'Gestion des assets'
            ],
            'outils' => [
                'Composer' => 'Gestionnaire de dépendances PHP',
                'Symfony CLI' => 'Outils de développement',
                'PHPUnit' => 'Tests unitaires',
                'Doctrine Migrations' => 'Versioning de la base de données'
            ]
        ];

        // Fusionner les modal_details avec les étapes
        foreach ($etapes as $key => &$etape) {
            if (isset($modalDetails[$etape['numero']])) {
                $etape['modal_details'] = $modalDetails[$etape['numero']];
            }
        }

        // Récupérer les données enrichies pour les concepts
        $architectureDetails = EcommerceConceptsData::getArchitectureDetails();
        $patternsDetails = EcommerceConceptsData::getPatternsDetails();
        $securityDetails = EcommerceConceptsData::getSecurityDetails();

        // Fusionner les données enrichies avec concepts_techniques
        foreach ($concepts_techniques['architecture']['composants'] as $key => $description) {
            $slug = strtolower(str_replace(' ', '_', $key));
            if (isset($architectureDetails[$slug])) {
                $concepts_techniques['architecture']['composants_details'][$key] = $architectureDetails[$slug];
            }
        }

        foreach ($concepts_techniques['patterns']['liste'] as $key => $description) {
            $slug = strtolower(str_replace(' ', '_', str_replace(' Pattern', '', $key)));
            if (isset($patternsDetails[$slug])) {
                $concepts_techniques['patterns']['liste_details'][$key] = $patternsDetails[$slug];
            }
        }

        foreach ($concepts_techniques['securite']['mesures'] as $key => $description) {
            $slug = strtolower(str_replace(' ', '_', str_replace(' Protection', '', str_replace(' Prevention', '', $key))));
            if ($slug === 'csrf') $slug = 'csrf';
            elseif ($slug === 'xss') $slug = 'xss';
            elseif ($slug === 'sql_injection') $slug = 'sql_injection';
            elseif ($slug === 'authentication') $slug = 'authentication';

            if (isset($securityDetails[$slug])) {
                $concepts_techniques['securite']['mesures_details'][$key] = $securityDetails[$slug];
            }
        }

        // Récupérer les données enrichies pour les technologies
        $techBackendDetails = EcommerceTechnologiesData::getBackendDetails();
        $techFrontendDetails = EcommerceTechnologiesData::getFrontendDetails();
        $techOutilsDetails   = EcommerceTechnologiesData::getOutilsDetails();

        // Fusion Backend
        foreach ($technologies['backend'] as $name => $desc) {
            $slug = strtolower(str_replace([' ', '+', '.'], ['_', '', '_'], $name));
            // Normaliser quelques cas
            if ($slug === 'symfony_7_3') {
                $slug = 'symfony_7_3';
            }
            if ($slug === 'doctrine_orm') {
                $slug = 'doctrine_orm';
            }
            if ($slug === 'twig') {
                $slug = 'twig';
            }
            if ($slug === 'symfony_security') {
                $slug = 'symfony_security';
            }

            if (isset($techBackendDetails[$slug])) {
                $technologies['backend_details'][$name] = $techBackendDetails[$slug];
            }
        }

        // Fusion Frontend
        foreach ($technologies['frontend'] as $name => $desc) {
            $slug = strtolower(str_replace([' ', '+'], ['_', ''], $name));
            if ($slug === 'bootstrap_5') {
                $slug = 'bootstrap_5';
            }
            if ($slug === 'javascript_es6') {
                $slug = 'javascript_es6';
            }
            if ($slug === 'stimulus') {
                $slug = 'stimulus';
            }
            if ($slug === 'asset_mapper') {
                $slug = 'asset_mapper';
            }

            if (isset($techFrontendDetails[$slug])) {
                $technologies['frontend_details'][$name] = $techFrontendDetails[$slug];
            }
        }

        // Fusion Outils
        foreach ($technologies['outils'] as $name => $desc) {
            $slug = strtolower(str_replace([' ', '+'], ['_', ''], $name));
            if ($slug === 'composer') {
                $slug = 'composer';
            }
            if ($slug === 'symfony_cli') {
                $slug = 'symfony_cli';
            }
            if ($slug === 'phpunit') {
                $slug = 'phpunit';
            }
            if ($slug === 'doctrine_migrations') {
                $slug = 'doctrine_migrations';
            }

            if (isset($techOutilsDetails[$slug])) {
                $technologies['outils_details'][$name] = $techOutilsDetails[$slug];
            }
        }

        return $this->render('ecommerce/index.html.twig', [
            'pageTitle' => 'E-commerce Symfony',
            'presentation' => $presentation,
            'etapes' => $etapes,
            'concepts_techniques' => $concepts_techniques,
            'technologies' => $technologies
        ]);
    }
}
