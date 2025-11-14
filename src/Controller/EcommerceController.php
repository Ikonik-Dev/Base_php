<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EcommerceController extends AbstractController
{
    #[Route('/ecommerce', name: 'app_ecommerce')]
    public function index(): Response
    {
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
                ]
            ],
            [
                'numero' => 2,
                'titre' => 'Modélisation des Données',
                'description' => 'Création des entités et relations',
                'duree' => '1.5h',
                'concepts' => ['Entités Doctrine', 'Relations', 'Migrations'],
                'objectifs' => [
                    'Créer les entités Product, Category, User',
                    'Définir les relations entre entités',
                    'Générer et exécuter les migrations',
                    'Comprendre les fixtures de données'
                ],
                'livrables' => [
                    'Entités complètes avec annotations',
                    'Base de données structurée',
                    'Données de test créées'
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

        return $this->render('ecommerce/index.html.twig', [
            'pageTitle' => 'E-commerce Symfony',
            'presentation' => $presentation,
            'etapes' => $etapes,
            'concepts_techniques' => $concepts_techniques,
            'technologies' => $technologies
        ]);
    }
}
