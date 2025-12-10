<?php

namespace App\Data;

class EcommerceTechnologiesData
{
    /**
     * Données détaillées pour les technologies Backend
     * Clés/Slugs attendus côté template/controller:
     * - symfony_7_3
     * - doctrine_orm
     * - twig
     * - symfony_security
     */
    public static function getBackendDetails(): array
    {
        return [
            'symfony_7_3' => [
                'description_detaillee' => "Symfony 7.3 est le framework PHP moderne utilisé comme socle du projet. Il fournit un routeur puissant, le systeme de services/DI, une intégration parfaite avec Twig, Doctrine, Messenger, Mailer, Security, ainsi qu'un outillage de développement riche (CLI, profiler).",
                'analogie' => "🏗️ Symfony est comme une ville clé-en-main: routes bien tracées (Routing), bâtiments modulaires (Bundles/Components), services publics efficaces (DI), et un centre de contrôle (Profiler) pour surveiller le tout.",
                'cas_usage' => [
                    'Architecture MVC, routing, contrôleurs',
                    'Formulaires et validation',
                    'Emails transactionnels et files de messages',
                    'API + pages server-rendered (Twig)'
                ],
                'exemple_code' => [
                    'language' => 'php',
                    'titre' => 'Controller + Route + Template Twig',
                    'code' => "<?php\nnamespace App\\Controller;\n\nuse Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController;\nuse Symfony\\Component\\HttpFoundation\\Response;\nuse Symfony\\Component\\Routing\\Attribute\\Route;\n\nfinal class ProductController extends AbstractController\n{\n    #[Route('/products', name: 'app_products')]\n    public function index(): Response\n    {\n        // Récupération de données (service/repository)\n        \$products = [ ['name' => 'T-shirt', 'price' => 19.99] ];\n\n        return \$this->render('product/index.html.twig', [\n            'products' => \$products\n        ]);\n    }\n}\n\n{# templates/product/index.html.twig #}\n<h1>Produits</h1>\n<ul>\n    {% for p in products %}<li>{{ p.name }} - {{ p.price }} €</li>{% endfor %}\n</ul>"
                ],
                'avantages' => [
                    '✅ Productivité élevée et écosystème mature',
                    '✅ Composants modulaires, tests et standards PSR',
                    '✅ Profiler + Web Debug Toolbar pour le debug',
                    '✅ Sécurité et performances solides'
                ],
                'inconvenients' => [
                    '⚠️ Courbe d’apprentissage pour les débutants',
                    '⚠️ Configuration initiale peut sembler verbeuse'
                ],
                'ressources' => [
                    ['label' => 'Documentation Symfony', 'url' => 'https://symfony.com/doc/current/', 'icon' => '📘'],
                    ['label' => 'Routing', 'url' => 'https://symfony.com/doc/current/routing.html', 'icon' => '🛣️'],
                    ['label' => 'Profiler', 'url' => 'https://symfony.com/doc/current/profiler.html', 'icon' => '📈']
                ]
            ],
            'doctrine_orm' => [
                'description_detaillee' => "Doctrine ORM est la couche de persistance. Elle mappe les entités PHP aux tables SQL, gère les relations, requêtes (DQL/QueryBuilder), transactions et migrations versionnées.",
                'analogie' => "🗄️ Doctrine est un traducteur entre objets et base SQL: vous parlez OO (entités), il parle SQL (tables, joints) et assure la cohérence.",
                'cas_usage' => [
                    'Entités Product/Category/Order',
                    'Repositories et requêtes optimisées',
                    'Migrations pour l’évolution du schéma',
                    'Relations et validations des données'
                ],
                'exemple_code' => [
                    'language' => 'php',
                    'titre' => 'Entité Product + Repository',
                    'code' => "<?php\nnamespace App\\Entity;\n\nuse Doctrine\\ORM\\Mapping as ORM;\n\n#[ORM\\Entity(repositoryClass: App\\Repository\\ProductRepository::class)]\nclass Product\n{\n    #[ORM\\Id]\n    #[ORM\\GeneratedValue]\n    #[ORM\\Column]\n    private ?int \$id = null;\n\n    #[ORM\\Column(length: 255)]\n    private ?string \$name = null;\n\n    #[ORM\\Column(type: 'decimal', precision: 10, scale: 2)]\n    private ?string \$price = null;\n}\n\nnamespace App\\Repository;\n\nuse App\\Entity\\Product;\nuse Doctrine\\Bundle\\DoctrineBundle\\Repository\\ServiceEntityRepository;\nuse Doctrine\\Persistence\\ManagerRegistry;\n\nclass ProductRepository extends ServiceEntityRepository\n{\n    public function __construct(ManagerRegistry \$registry)\n    { parent::__construct(\$registry, Product::class); }\n\n    public function findCheapest(int \$limit = 5): array\n    {\n        return \$this->createQueryBuilder('p')\n            ->orderBy('p.price', 'ASC')\n            ->setMaxResults(\$limit)\n            ->getQuery()\n            ->getResult();\n    }\n}"
                ],
                'avantages' => [
                    '✅ Abstraction puissante et portable',
                    '✅ Migrations versionnées et relations riches',
                    '✅ QueryBuilder/DQL pour requêtes complexes'
                ],
                'inconvenients' => [
                    '⚠️ Peut masquer certaines spécificités SQL',
                    '⚠️ Attention aux performances (N+1)'
                ],
                'ressources' => [
                    ['label' => 'Doctrine ORM', 'url' => 'https://www.doctrine-project.org/', 'icon' => '📚'],
                    ['label' => 'Migrations', 'url' => 'https://symfony.com/doc/current/doctrine.html#migrations', 'icon' => '🔄']
                ]
            ],
            'twig' => [
                'description_detaillee' => "Twig est le moteur de templates côté serveur. Il fournit un échappement automatique (sécurité), des filtres, macros, et un rendu rapide pour générer des pages HTML.",
                'analogie' => "🧵 Twig est une machine à coudre: vous assemblez données et gabarits pour produire des pages propres et solides.",
                'cas_usage' => [
                    'Layouts, composants et fragments',
                    'Échappement XSS par défaut',
                    'Macros et includes réutilisables',
                    'Rendu côté serveur SEO-friendly'
                ],
                'exemple_code' => [
                    'language' => 'twig',
                    'titre' => 'Layout + composant product-card',
                    'code' => "{# templates/base.html.twig #}\n<!DOCTYPE html>\n<html>\n<body>\n    <main>{% block body %}{% endblock %}</main>\n</body>\n</html>\n\n{# templates/product/card.html.twig #}\n<div class=\"product-card\">\n    <h3>{{ product.name }}</h3>\n    <p>{{ product.price }} €</p>\n</div>"
                ],
                'avantages' => [
                    '✅ Sécurité: échappement automatique',
                    '✅ Syntaxe claire et rapide',
                    '✅ Très bien intégré à Symfony'
                ],
                'inconvenients' => [
                    '⚠️ Moins flexible qu’un SPA pour interactions lourdes',
                    '⚠️ HTML complexe peut devenir verbeux'
                ],
                'ressources' => [
                    ['label' => 'Twig Docs', 'url' => 'https://twig.symfony.com/doc/3.x/', 'icon' => '🧠'],
                    ['label' => 'Templates Symfony', 'url' => 'https://symfony.com/doc/current/templates.html', 'icon' => '🧩']
                ]
            ],
            'symfony_security' => [
                'description_detaillee' => "Symfony Security gère l’authentification (form_login, tokens), l’autorisation (rôles/voters), le hash des mots de passe et protections CSRF/CSP.",
                'analogie' => "🔐 Comme des badges et des vigiles: identification à l’entrée, autorisations pour chaque zone, et surveillance continue.",
                'cas_usage' => [
                    'Login/Logout/Remember-me',
                    'Rôles et hiérarchies',
                    'Voters personnalisés',
                    'Rate limiting/2FA (bundles)'
                ],
                'exemple_code' => [
                    'language' => 'yaml',
                    'titre' => 'Extrait security.yaml + voter',
                    'code' => "# config/packages/security.yaml\nsecurity:\n    password_hashers:\n        App\\Entity\\User:\n            algorithm: auto\n    providers:\n        app_user_provider:\n            entity: { class: App\\Entity\\User, property: email }\n    firewalls:\n        main:\n            form_login: { login_path: app_login, check_path: app_login }\n            logout: { path: app_logout }\n    access_control:\n        - { path: ^/admin, roles: ROLE_ADMIN }"
                ],
                'avantages' => [
                    '✅ Sécurité robuste par défaut',
                    '✅ Mécanismes extensibles (voters, providers)',
                    '✅ Intégration CSRF/XSS/CSP'
                ],
                'inconvenients' => [
                    '⚠️ Configuration peut sembler complexe',
                    '⚠️ Nécessite HTTPS en production'
                ],
                'ressources' => [
                    ['label' => 'Security', 'url' => 'https://symfony.com/doc/current/security.html', 'icon' => '🔒'],
                    ['label' => 'Voters', 'url' => 'https://symfony.com/doc/current/security/voters.html', 'icon' => '🗳️']
                ]
            ],
        ];
    }

    /**
     * Données détaillées pour les technologies Frontend
     * Slugs:
     * - bootstrap_5
     * - javascript_es6
     * - stimulus
     * - asset_mapper
     */
    public static function getFrontendDetails(): array
    {
        return [
            'bootstrap_5' => [
                'description_detaillee' => "Bootstrap 5 apporte une grille responsive, des composants (Navbar, Cards, Modals) et utilitaires CSS pour prototyper rapidement une UI accessible.",
                'analogie' => "🧱 Un jeu de LEGO prêt-à-monter: assemblez des briques (composants) pour créer une interface solide rapidement.",
                'cas_usage' => [
                    'Grille responsive et layout mobile-first',
                    'Composants modals/toasts/forms',
                    'Utilitaires pour spacing/couleurs',
                    'Design cohérent et rapide'
                ],
                'exemple_code' => [
                    'language' => 'html',
                    'titre' => 'Card produit avec Bootstrap',
                    'code' => "<div class=\"card\" style=\"width:18rem\">\n  <div class=\"card-body\">\n    <h5 class=\"card-title\">T-shirt</h5>\n    <p class=\"card-text\">Confortable et stylé</p>\n    <a href=\"#\" class=\"btn btn-primary\">Ajouter au panier</a>\n  </div>\n</div>"
                ],
                'avantages' => [
                    '✅ Rapide à mettre en place',
                    '✅ Composants accessibles',
                    '✅ Large communauté'
                ],
                'inconvenients' => [
                    '⚠️ Style générique si non personnalisé',
                    '⚠️ CSS parfois lourd sans purge'
                ],
                'ressources' => [
                    ['label' => 'Bootstrap Docs', 'url' => 'https://getbootstrap.com/docs/5.3/getting-started/introduction/', 'icon' => '📗']
                ]
            ],
            'javascript_es6' => [
                'description_detaillee' => "JavaScript ES6+ apporte modules, classes, async/await, et une syntaxe moderne pour écrire du code client propre et maintenable.",
                'analogie' => "⚙️ Une boîte à outils modernisée: mêmes métiers, mais des outils plus efficaces et sûrs.",
                'cas_usage' => [
                    'Interactions UI (menus, modals, AJAX)',
                    'Intégrations API fetch/JSON',
                    'Helpers utilitaires et modules réutilisables',
                    'Gestion d’état simple côté client'
                ],
                'exemple_code' => [
                    'language' => 'js',
                    'titre' => 'Module ES6 avec fetch et async/await',
                    'code' => "// assets/js/products-api.js\nexport async function loadProducts() {\n  const res = await fetch('/api/products');\n  if (!res.ok) throw new Error('Erreur API');\n  return await res.json();\n}\n\n// assets/app.js\nimport { loadProducts } from './js/products-api.js';\n\n(async () => {\n  const products = await loadProducts();\n  console.log(products);\n})();"
                ],
                'avantages' => [
                    '✅ Syntaxe moderne et lisible',
                    '✅ Modules et outillage standard',
                    '✅ Async/await pour flux réseau'
                ],
                'inconvenients' => [
                    '⚠️ Pièges du DOM et compatibilité navigateur',
                    '⚠️ Nécessite organisation pour éviter spaghetti'
                ],
                'ressources' => [
                    ['label' => 'MDN ES6', 'url' => 'https://developer.mozilla.org/en-US/docs/Web/JavaScript', 'icon' => '📙']
                ]
            ],
            'stimulus' => [
                'description_detaillee' => "Stimulus apporte de petits contrôleurs déclaratifs pour enrichir des pages server-rendered sans lourde SPA. Idéal pour interactions ciblées (modals, formulaires, menus).",
                'analogie' => "🎛️ Des micro-contrôleurs qui ajoutent juste ce qu’il faut d’interactivité, sans tout réécrire en SPA.",
                'cas_usage' => [
                    'Gestion de modals et menus',
                    'Formulaires dynamiques',
                    'Petits comportements d’interface',
                    'Intégration progressive'
                ],
                'exemple_code' => [
                    'language' => 'js',
                    'titre' => 'Stimulus controller pour modal',
                    'code' => "// assets/controllers/modal_controller.js\nimport { Controller } from '@hotwired/stimulus';\n\nexport default class extends Controller {\n  static targets = ['container'];\n\n  open() { this.containerTarget.classList.add('is-open'); }\n  close() { this.containerTarget.classList.remove('is-open'); }\n}\n\n{# templates/components/modal.html.twig #}\n<div data-controller=\"modal\" data-modal-target=\"container\" class=\"modal\">\n  <button data-action=\"click->modal#close\">Fermer</button>\n</div>"
                ],
                'avantages' => [
                    '✅ Très léger et simple',
                    '✅ Parfait pour SSR + interactions',
                    '✅ Convention over configuration'
                ],
                'inconvenients' => [
                    '⚠️ Pas adapté aux très gros frontends',
                    '⚠️ Moins d’écosystème que React/Vue'
                ],
                'ressources' => [
                    ['label' => 'Stimulus', 'url' => 'https://stimulus.hotwired.dev/', 'icon' => '⚡']
                ]
            ],
            'asset_mapper' => [
                'description_detaillee' => "Asset Mapper (Symfony) remplace Webpack Encore pour des projets modernes en mappant des modules ES natifs, gérant assets et importmap.",
                'analogie' => "🗺️ Un plan qui indique où sont les assets et comment les charger, sans usine à gaz.",
                'cas_usage' => [
                    'Chargement de modules ES et CSS',
                    'Organisation des assets sans bundler',
                    'Intégration avec importmap.php',
                    'Cache et versionnement'
                ],
                'exemple_code' => [
                    'language' => 'php',
                    'titre' => 'importmap.php + utilisation',
                    'code' => "<?php\n// importmap.php\nreturn [\n  'imports' => [\n    '@hotwired/stimulus' => 'https://ga.jspm.io/npm:@hotwired/stimulus@3.2.2/dist/stimulus.js',\n    'app' => '/assets/app.js',\n  ],\n];\n\n// templates/base.html.twig\n{{ importmap() }}\n<script type=\"module\" src=\"{{ asset('assets/app.js') }}\"></script>"
                ],
                'avantages' => [
                    '✅ Configuration minimale',
                    '✅ Exploite les modules natifs',
                    '✅ Intégré au workflow Symfony'
                ],
                'inconvenients' => [
                    '⚠️ Moins de fonctionnalités qu’un bundler complet',
                    '⚠️ Limitations sur anciens navigateurs'
                ],
                'ressources' => [
                    ['label' => 'Asset Mapper', 'url' => 'https://symfony.com/doc/current/frontend.html', 'icon' => '🗺️']
                ]
            ],
        ];
    }

    /**
     * Données détaillées pour les outils de développement
     * Slugs:
     * - composer
     * - symfony_cli
     * - phpunit
     * - doctrine_migrations
     */
    public static function getOutilsDetails(): array
    {
        return [
            'composer' => [
                'description_detaillee' => "Composer gère les dépendances PHP (packages/bundles), l’autoloading PSR-4 et les scripts. Indispensable pour installer et mettre à jour l’écosystème.",
                'analogie' => "📦 Un gestionnaire de colis: vous demandez des librairies, il les livre et les organise proprement.",
                'cas_usage' => [
                    'Installation de bundles et libs',
                    'Mises à jour versionnées',
                    'Autoloading et scripts',
                    'Gestion des contraintes (semver)'
                ],
                'exemple_code' => [
                    'language' => 'bash',
                    'titre' => 'Commandes Composer usuelles',
                    'code' => "composer require symfony/orm-pack\ncomposer require --dev symfony/maker-bundle\ncomposer update\ncomposer dump-autoload"
                ],
                'avantages' => [
                    '✅ Standard de facto PHP',
                    '✅ Résolution des dépendances fiable',
                    '✅ Scripts et autoload PSR-4'
                ],
                'inconvenients' => [
                    '⚠️ Conflits de versions possibles',
                    '⚠️ Nécessite compréhension semver'
                ],
                'ressources' => [
                    ['label' => 'Composer', 'url' => 'https://getcomposer.org/', 'icon' => '🎁']
                ]
            ],
            'symfony_cli' => [
                'description_detaillee' => "Symfony CLI aide au développement: création de projet, serveur local HTTPS, déploiement, et intégration profiler.",
                'analogie' => "🛠️ Un couteau suisse pour démarrer, servir et diagnostiquer votre app.",
                'cas_usage' => [
                    'Création de projet',
                    'Serveur local HTTPS',
                    'Profiling et debug',
                    'Login à SymfonyCloud'
                ],
                'exemple_code' => [
                    'language' => 'bash',
                    'titre' => 'Commandes Symfony CLI',
                    'code' => "symfony new mon-ecommerce --version=\"7.3.*\" --webapp\nsymfony serve -d\nsymfony open:local"
                ],
                'avantages' => [
                    '✅ Très pratique au quotidien',
                    '✅ HTTPS et intégrations automatiques',
                    '✅ Compatible Windows/macOS/Linux'
                ],
                'inconvenients' => [
                    '⚠️ Certaines fonctions liées à SymfonyCloud',
                    '⚠️ Ajoute une dépendance outil'
                ],
                'ressources' => [
                    ['label' => 'Symfony CLI', 'url' => 'https://symfony.com/download', 'icon' => '🔧']
                ]
            ],
            'phpunit' => [
                'description_detaillee' => "PHPUnit est le framework de tests unitaires pour PHP. Il permet d’écrire des tests isolés, mocks/stubs, et rapports de couverture.",
                'analogie' => "🧪 Un laboratoire pour vérifier la qualité de vos briques logicielles.",
                'cas_usage' => [
                    'Tests de services et repositories',
                    'Tests fonctionnels avec KernelTestCase',
                    'CI/CD avec rapport de couverture',
                    'TDD et refactoring sécurisé'
                ],
                'exemple_code' => [
                    'language' => 'php',
                    'titre' => 'Test unitaire d’un service',
                    'code' => "<?php\nuse PHPUnit\\Framework\\TestCase;\nuse App\\Service\\PricingService;\n\nfinal class PricingServiceTest extends TestCase\n{\n    public function testCalculate(): void\n    {\n        \$service = new PricingService(/* mocks */);\n        \$result = \$service->calculatePrice(/* ... */);\n        \$this->assertArrayHasKey('price_ttc', \$result);\n    }\n}"
                ],
                'avantages' => [
                    '✅ Fiabilité et confiance',
                    '✅ Aide au refactoring',
                    '✅ Intégration CI/CD'
                ],
                'inconvenients' => [
                    '⚠️ Temps initial d’écriture des tests',
                    '⚠️ Maintenance de la suite de tests'
                ],
                'ressources' => [
                    ['label' => 'PHPUnit', 'url' => 'https://phpunit.de/', 'icon' => '🧪']
                ]
            ],
            'doctrine_migrations' => [
                'description_detaillee' => "Doctrine Migrations versionne les évolutions du schéma de base de données. Chaque changement est consigné et rejouable, facilitant déploiements et rollback.",
                'analogie' => "🔄 Un journal de bord des transformations de la base, que l’on peut rejouer à volonté.",
                'cas_usage' => [
                    'Création/modification de tables et colonnes',
                    'Déploiements synchronisés entre environnements',
                    'Rollback en cas de problème',
                    'Historisation des changements'
                ],
                'exemple_code' => [
                    'language' => 'bash',
                    'titre' => 'Commandes Migrations',
                    'code' => "php bin/console make:migration\nphp bin/console doctrine:migrations:migrate\nphp bin/console doctrine:migrations:status"
                ],
                'avantages' => [
                    '✅ Traçabilité et sécurité des déploiements',
                    '✅ Collaboration facilitée',
                    '✅ Automatisation possible en CI'
                ],
                'inconvenients' => [
                    '⚠️ Conflits à résoudre en équipe',
                    '⚠️ Opérations de data migrations délicates'
                ],
                'ressources' => [
                    ['label' => 'Doctrine Migrations', 'url' => 'https://www.doctrine-project.org/projects/doctrine-migrations/en/latest/', 'icon' => '📜']
                ]
            ],
        ];
    }
}
