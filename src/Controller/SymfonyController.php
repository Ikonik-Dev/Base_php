<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Data\SymfonyArchitectureData;
use App\Data\SymfonyEcosystemData;

final class SymfonyController extends AbstractController
{
    #[Route('/symfony', name: 'app_symfony')]
    public function index(): Response
    {
        // Présentation du framework Symfony
        $presentation = [
            'label' => 'Symfony - Le Framework PHP de Référence',
            'description' => 'Symfony est un framework PHP open-source qui suit les meilleures pratiques de développement web. Il fournit une architecture robuste, des composants réutilisables et une philosophie orientée développement rapide.',
            'version_actuelle' => '7.3',
            'depuis' => '2005',
            'createur' => 'Fabien Potencier (SensioLabs)',
            'philosophie' => [
                'Convention over Configuration',
                'Don\'t Repeat Yourself (DRY)',
                'Séparation des préoccupations',
                'Architecture MVC',
                'Tests automatisés'
            ]
        ];

        // Concepts fondamentaux
        $concepts_base = [
            'mvc_pattern' => [
                'label' => 'Architecture MVC (Model-View-Controller)',
                'description' => 'Symfony organise le code selon le pattern MVC pour séparer la logique métier, la présentation et le contrôle',
                'composants' => [
                    'Model' => 'Entités Doctrine - Gestion des données et logique métier',
                    'View' => 'Templates Twig - Présentation et interface utilisateur',
                    'Controller' => 'Contrôleurs Symfony - Logique de traitement des requêtes'
                ],
                'avantages' => [
                    'Code organisé et maintenable',
                    'Séparation claire des responsabilités',
                    'Réutilisabilité des composants',
                    'Tests facilités'
                ]
            ],
            'dependency_injection' => [
                'label' => 'Injection de Dépendances (DI)',
                'description' => 'Système permettant de gérer automatiquement les dépendances entre objets',
                'principe' => 'Les objets reçoivent leurs dépendances au lieu de les créer eux-mêmes',
                'avantages' => [
                    'Couplage faible entre classes',
                    'Tests unitaires facilités',
                    'Configuration centralisée',
                    'Flexibilité et extensibilité'
                ],
                'exemple_code' => '// Symfony injecte automatiquement les services
public function __construct(
    private EntityManagerInterface $entityManager,
    private LoggerInterface $logger
) {}'
            ],
            'routing' => [
                'label' => 'Système de Routage',
                'description' => 'Mécanisme qui associe les URLs aux contrôleurs et actions',
                'types' => [
                    'Annotations/Attributs' => '#[Route(\'/user/{id}\', name: \'user_show\')]',
                    'YAML' => 'Configuration dans config/routes.yaml',
                    'XML' => 'Configuration XML pour cas complexes',
                    'PHP' => 'Configuration programmatique'
                ],
                'fonctionnalites' => [
                    'Paramètres dynamiques',
                    'Contraintes sur paramètres',
                    'Génération d\'URLs',
                    'Sous-domaines et méthodes HTTP'
                ]
            ],
            'twig_templating' => [
                'label' => 'Moteur de Templates Twig',
                'description' => 'Système de templates sécurisé et expressif intégré à Symfony',
                'caracteristiques' => [
                    'Syntaxe claire et intuitive',
                    'Échappement automatique (sécurité)',
                    'Héritage de templates',
                    'Filtres et fonctions intégrées'
                ],
                'syntaxe_exemple' => [
                    '{{ variable }}' => 'Affichage de variable',
                    '{% if condition %}' => 'Structures de contrôle',
                    '{% extends "base.html.twig" %}' => 'Héritage de template',
                    '{{ name|upper }}' => 'Application de filtres'
                ]
            ]
        ];

        // Architecture Symfony de haut niveau (pour la section visuelle)
        $architecture = [
            'kernel' => [
                'nom' => 'Kernel (Noyau)',
                'role' => 'Point d\'entrée principal qui gère le cycle de vie des requêtes',
                'responsabilites' => [
                    'Chargement de la configuration',
                    'Initialisation des services',
                    'Gestion des environnements (dev, prod, test)',
                    'Coordination des composants'
                ]
            ],
            'service_container' => [
                'nom' => 'Service Container',
                'role' => 'Gestionnaire central de tous les services de l\'application',
                'fonctions' => [
                    'Injection automatique des dépendances',
                    'Configuration des services',
                    'Gestion du cycle de vie des objets',
                    'Optimisation des performances'
                ]
            ],
            'event_dispatcher' => [
                'nom' => 'Event Dispatcher',
                'role' => 'Système d\'événements pour découpler les composants',
                'utilisation' => [
                    'Hooks dans le cycle de requête',
                    'Listeners personnalisés',
                    'Modification du comportement sans modifier le code core',
                    'Intégration de bundles tiers'
                ]
            ]
        ];

        // Détails pour les modals de l'architecture (kernel, service container, event dispatcher)
        $architectureDetails = SymfonyArchitectureData::getDetails();
        // Définir l'ordre pour la navigation prev/next
        $archOrder = ['kernel', 'service_container', 'event_dispatcher'];
        $architectureModals = [];
        foreach ($archOrder as $index => $slug) {
            $detail = $architectureDetails[$slug] ?? [];
            $architectureModals[] = [
                'id' => $slug,
                'title' => $architecture[$slug]['nom'] ?? ucfirst(str_replace('_', ' ', $slug)),
                'icon' => $slug === 'kernel' ? '🔧' : ($slug === 'service_container' ? '📦' : '📡'),
                'description' => $detail['description_detaillee'] ?? null,
                'analogie' => $detail['analogie'] ?? null,
                'cas_usage' => $detail['cas_usage'] ?? [],
                'exemple_code' => $detail['exemple_code'] ?? null,
                'avantages' => $detail['avantages'] ?? [],
                'inconvenients' => $detail['inconvenients'] ?? [],
                'ressources' => $detail['ressources'] ?? [],
                'prevConcept' => $archOrder[$index - 1] ?? null,
                'nextConcept' => $archOrder[$index + 1] ?? null,
            ];
        }

        // Bundle et composants Symfony
        $ecosysteme = [
            'bundles_principaux' => [
                'FrameworkBundle' => 'Bundle principal avec les services de base',
                'SecurityBundle' => 'Gestion de l\'authentification et autorisation',
                'TwigBundle' => 'Intégration du moteur de templates Twig',
                'DoctrineBundle' => 'ORM pour la gestion de base de données',
                'MonologBundle' => 'Système de logging avancé'
            ],
            'composants_standalone' => [
                'HttpFoundation' => 'Gestion des requêtes/réponses HTTP',
                'Console' => 'Création d\'applications en ligne de commande',
                'Validator' => 'Validation de données avec annotations',
                'Form' => 'Génération et traitement de formulaires',
                'Serializer' => 'Sérialisation/désérialisation d\'objets'
            ],
            'outils_dev' => [
                'Profiler' => 'Débogage et analyse des performances',
                'Debug Toolbar' => 'Barre d\'outils de développement',
                'Maker Bundle' => 'Génération automatique de code',
                'PHPUnit Bridge' => 'Intégration des tests unitaires'
            ]
        ];

        // Construire des modals pour l'écosystème (bundles, composants, outils) avec contenu enrichi
        $ecosystemModals = [];
        $bundlesDetails = SymfonyEcosystemData::getBundlesDetails();
        $componentsDetails = SymfonyEcosystemData::getComponentsDetails();
        $toolsDetails = SymfonyEcosystemData::getToolsDetails();
        $ecoCategories = [
            'bundles' => array_keys($ecosysteme['bundles_principaux']),
            'composants' => array_keys($ecosysteme['composants_standalone']),
            'outils' => array_keys($ecosysteme['outils_dev']),
        ];
        foreach ($ecoCategories as $category => $names) {
            foreach ($names as $index => $name) {
                $slug = strtolower(str_replace([' ', '/'], ['_', '-'], $name));
                $detail = [];
                if ($category === 'bundles') {
                    $detail = $bundlesDetails[$name] ?? [];
                } elseif ($category === 'composants') {
                    $detail = $componentsDetails[$name] ?? [];
                } else {
                    $detail = $toolsDetails[$name] ?? [];
                }

                $ecosystemModals[] = [
                    'id' => $slug,
                    'title' => $name,
                    'icon' => $category === 'bundles' ? '🧩' : ($category === 'composants' ? '🧱' : '🛠️'),
                    'description' => $detail['description_detaillee'] ?? ($ecosysteme[$category === 'bundles' ? 'bundles_principaux' : ($category === 'composants' ? 'composants_standalone' : 'outils_dev')][$name] ?? ''),
                    'analogie' => $detail['analogie'] ?? null,
                    'cas_usage' => $detail['cas_usage'] ?? [],
                    'exemple_code' => $detail['exemple_code'] ?? null,
                    'avantages' => $detail['avantages'] ?? [],
                    'inconvenients' => $detail['inconvenients'] ?? [],
                    'ressources' => $detail['ressources'] ?? [],
                    'prevConcept' => $index > 0 ? strtolower(str_replace([' ', '/'], ['_', '-'], $names[$index - 1])) : null,
                    'nextConcept' => isset($names[$index + 1]) ? strtolower(str_replace([' ', '/'], ['_', '-'], $names[$index + 1])) : null,
                ];
            }
        }

        // Workflow de développement
        $workflow = [
            'creation_projet' => [
                'etape' => 'Création du projet',
                'commande' => 'composer create-project symfony/skeleton mon-projet',
                'description' => 'Installation minimale de Symfony avec composants essentiels'
            ],
            'structure_dossiers' => [
                'config/' => 'Fichiers de configuration',
                'src/' => 'Code source de l\'application',
                'templates/' => 'Templates Twig',
                'public/' => 'Point d\'entrée web et assets',
                'var/' => 'Cache et logs',
                'vendor/' => 'Dépendances Composer'
            ],
            'commandes_utiles' => [
                'php bin/console cache:clear' => 'Vider le cache',
                'php bin/console make:controller' => 'Créer un contrôleur',
                'php bin/console make:entity' => 'Créer une entité Doctrine',
                'php bin/console doctrine:migrations:migrate' => 'Appliquer les migrations',
                'php bin/console debug:router' => 'Lister les routes'
            ]
        ];

        return $this->render('symfony/index.html.twig', [
            'pageTitle' => 'Framework Symfony',
            'presentation' => $presentation,
            'concepts_base' => $concepts_base,
            'architecture' => $architecture,
            'ecosysteme' => $ecosysteme,
            'workflow' => $workflow,
            'architecture_modals' => $architectureModals,
            'ecosystem_modals' => $ecosystemModals
        ]);
    }
}
