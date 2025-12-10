<?php

namespace App\Data;

class SymfonyEcosystemData
{
    public static function getBundlesDetails(): array
    {
        return [
            'FrameworkBundle' => [
                'description_detaillee' => "Bundle coeur: services de base (routing, controller, templating, events) et intégration du framework.",
                'analogie' => "🧩 Une ossature: il relie et supporte tous les autres modules.",
                'cas_usage' => [
                    'Configurer le noyau de l\'app',
                    'Définir les routes et les contrôleurs',
                    'Activer des fonctionnalités via configuration'
                ],
                'exemple_code' => [
                    'language' => 'yaml',
                    'titre' => 'Activer des features FrameworkBundle',
                    'code' => "# config/packages/framework.yaml\nframework:\n    secret: '%env(APP_SECRET)%'\n    router:\n        utf8: true\n    session:\n        handler_id: null\n        cookie_secure: auto\n"
                ],
                'avantages' => [
                    '✅ Base solide et testée',
                    '✅ Intégration fluide des composants',
                ],
                'inconvenients' => [
                    '⚠️ Configuration multiple à gérer',
                ],
                'ressources' => [
                    ['label' => 'FrameworkBundle', 'url' => 'https://symfony.com/doc/current/reference/configuration/framework.html', 'icon' => '🧩']
                ]
            ],
            'SecurityBundle' => [
                'description_detaillee' => "Gestion complète de l\'authentification, autorisation, encodage des mots de passe et firewall.",
                'analogie' => "🔒 Un vigile et une grille d\'accès: contrôle qui entre et ce qu\'il peut faire.",
                'cas_usage' => [
                    'Login form et authenticator',
                    'Rôles et voters',
                    'Firewalls et access control'
                ],
                'exemple_code' => [
                    'language' => 'yaml',
                    'titre' => 'Extrait security.yaml',
                    'code' => "security:\n    password_hashers:\n        Symfony\\Component\\Security\\Core\\User\\PasswordAuthenticatedUserInterface: 'auto'\n    providers:\n        app_user_provider:\n            entity:\n                class: App\\Entity\\User\n                property: email\n    firewalls:\n        main:\n            lazy: true\n            provider: app_user_provider\n            form_login: ~\n            logout: ~\n    access_control:\n        - { path: ^/admin, roles: ROLE_ADMIN }\n"
                ],
                'avantages' => [
                    '✅ Très complet et flexible',
                    '✅ Intégration avec authenticator moderne',
                ],
                'inconvenients' => [
                    '⚠️ Courbe d\'apprentissage',
                ],
                'ressources' => [
                    ['label' => 'Security', 'url' => 'https://symfony.com/doc/current/security.html', 'icon' => '🔒']
                ]
            ],
            'TwigBundle' => [
                'description_detaillee' => "Intégration de Twig: moteur de templates sécurisé, héritage, filtres et fonctions.",
                'analogie' => "🎨 Un atelier de design: mise en page et rendu des vues.",
                'cas_usage' => [
                    'Rendu de templates',
                    'Filtres et fonctions custom',
                    'Héritage de layouts'
                ],
                'exemple_code' => [
                    'language' => 'twig',
                    'titre' => 'Template Twig',
                    'code' => "{% extends 'base.html.twig' %}\n{% block body %}\n  <h1>{{ title }}</h1>\n{% endblock %}"
                ],
                'avantages' => [
                    '✅ Syntaxe claire et sûre',
                ],
                'inconvenients' => [
                    '⚠️ Besoin d\'apprendre la syntaxe',
                ],
                'ressources' => [
                    ['label' => 'Twig', 'url' => 'https://twig.symfony.com/doc/3.x/', 'icon' => '🎨']
                ]
            ],
            'DoctrineBundle' => [
                'description_detaillee' => "Intégration Doctrine ORM: entités, repositories, migrations et relations.",
                'analogie' => "🗃️ Un archiviste: organise et retrouve les données.",
                'cas_usage' => [
                    'CRUD sur entités',
                    'Requêtes via DQL/QueryBuilder',
                    'Migrations de schéma'
                ],
                'exemple_code' => [
                    'language' => 'php',
                    'titre' => 'Repository + QueryBuilder',
                    'code' => "<?php\n\$qb = \$repo->createQueryBuilder('p')->where('p.active = 1')->getQuery()->getResult();"
                ],
                'avantages' => [
                    '✅ Puissant et riche',
                ],
                'inconvenients' => [
                    '⚠️ Performance à surveiller',
                ],
                'ressources' => [
                    ['label' => 'DoctrineBundle', 'url' => 'https://symfony.com/doc/current/doctrine.html', 'icon' => '🗃️']
                ]
            ],
            'MonologBundle' => [
                'description_detaillee' => "Logging avancé: handlers, processors, canaux et niveaux de logs.",
                'analogie' => "📓 Un journal intelligent: trace et catégorise les événements.",
                'cas_usage' => [
                    'Logs applicatifs',
                    'Handlers (stream, rotating, slack)',
                    'Contextes et processors'
                ],
                'exemple_code' => [
                    'language' => 'php',
                    'titre' => 'Logger usage',
                    'code' => "<?php\n\$logger->info('Action réussie', ['user' => 123]);"
                ],
                'avantages' => [
                    '✅ Observabilité accrue',
                ],
                'inconvenients' => [
                    '⚠️ Configuration multi-environnements',
                ],
                'ressources' => [
                    ['label' => 'MonologBundle', 'url' => 'https://symfony.com/doc/current/logging.html', 'icon' => '🪵']
                ]
            ],
        ];
    }

    public static function getComponentsDetails(): array
    {
        return [
            'HttpFoundation' => [
                'description_detaillee' => "Requêtes/Réponses HTTP, sessions, cookies et téléchargements de fichiers.",
                'analogie' => "📮 La poste: transporte et enveloppe les messages HTTP.",
                'cas_usage' => [
                    'Manipuler Request/Response',
                    'Gérer sessions/cookies',
                    'Télécharger des fichiers'
                ],
                'exemple_code' => [
                    'language' => 'php',
                    'titre' => 'Request/Response basiques',
                    'code' => "<?php\nuse Symfony\\Component\\HttpFoundation\\Request;\nuse Symfony\\Component\\HttpFoundation\\Response;\n\$request = Request::createFromGlobals();\n\$response = new Response('OK', 200);\n\$response->send();"
                ],
                'avantages' => ['✅ API claire', '✅ Indispensable'],
                'inconvenients' => [],
                'ressources' => [
                    ['label' => 'HttpFoundation', 'url' => 'https://symfony.com/doc/current/components/http_foundation.html', 'icon' => '📮']
                ]
            ],
            'Console' => [
                'description_detaillee' => "Applications CLI, commandes, I/O, styles et progress bars.",
                'analogie' => "⌨️ Une télécommande pour automatiser les tâches.",
                'cas_usage' => [
                    'Créer des commandes',
                    'Scripts d\'import/export',
                    'Outils d\'admin'
                ],
                'exemple_code' => [
                    'language' => 'php',
                    'titre' => 'Commande simple',
                    'code' => "<?php\nuse Symfony\\Component\\Console\\Command\\Command;\nclass HelloCommand extends Command { /* ... */ }"
                ],
                'avantages' => ['✅ Productivité', '✅ Outils robustes'],
                'inconvenients' => [],
                'ressources' => [
                    ['label' => 'Console', 'url' => 'https://symfony.com/doc/current/components/console.html', 'icon' => '⌨️']
                ]
            ],
            'Validator' => [
                'description_detaillee' => "Validation via contraintes (annotations/attributs), groupes et messages d\'erreur.",
                'analogie' => "✅ Un contrôle qualité: vérifie la conformité des données.",
                'cas_usage' => ['Formulaires', 'DTO', 'Entrées API'],
                'exemple_code' => [
                    'language' => 'php',
                    'titre' => 'Contraintes',
                    'code' => "<?php\nuse Symfony\\Component\\Validator\\Constraints as Assert;\nclass User { #[Assert\\NotBlank] public string \$email; }"
                ],
                'avantages' => ['✅ Sécurité des données'],
                'inconvenients' => [],
                'ressources' => [
                    ['label' => 'Validator', 'url' => 'https://symfony.com/doc/current/components/validator.html', 'icon' => '✅']
                ]
            ],
            'Form' => [
                'description_detaillee' => "Construction de formulaires, mappage de données, validations et templates.",
                'analogie' => "📝 Un assistant de saisie: structure et valide les entrées.",
                'cas_usage' => ['Back-office', 'CRUD', 'Wizard forms'],
                'exemple_code' => [
                    'language' => 'php',
                    'titre' => 'Type de formulaire',
                    'code' => "<?php\nuse Symfony\\Component\\Form\\Extension\\Core\\Type\\TextType;\n\$builder->add('name', TextType::class);"
                ],
                'avantages' => ['✅ Gain de temps'],
                'inconvenients' => ['⚠️ Verbosité'],
                'ressources' => [
                    ['label' => 'Form', 'url' => 'https://symfony.com/doc/current/forms.html', 'icon' => '📝']
                ]
            ],
            'Serializer' => [
                'description_detaillee' => "Sérialisation JSON/XML, normalizers, encoders et groupes.",
                'analogie' => "🔄 Un traducteur: convertit objets <-> formats.",
                'cas_usage' => ['APIs', 'Export/Import'],
                'exemple_code' => [
                    'language' => 'php',
                    'titre' => 'Sérialiser en JSON',
                    'code' => "<?php\n\$json = \$serializer->serialize(\$obj, 'json');"
                ],
                'avantages' => ['✅ Rapide pour APIs'],
                'inconvenients' => [],
                'ressources' => [
                    ['label' => 'Serializer', 'url' => 'https://symfony.com/doc/current/components/serializer.html', 'icon' => '🔄']
                ]
            ],
        ];
    }

    public static function getToolsDetails(): array
    {
        return [
            'Profiler' => [
                'description_detaillee' => "Analyse des performances, requêtes, événements, logs et configuration.",
                'analogie' => "🔍 Une loupe: inspecte le fonctionnement interne.",
                'cas_usage' => ['Debug', 'Optimisation', 'Audit'],
                'exemple_code' => null,
                'avantages' => ['✅ Visibilité'],
                'inconvenients' => ['⚠️ À désactiver en prod'],
                'ressources' => [
                    ['label' => 'Profiler', 'url' => 'https://symfony.com/doc/current/profiler.html', 'icon' => '🔍']
                ]
            ],
            'Debug Toolbar' => [
                'description_detaillee' => "Barre d\'outils de debug: infos rapides (routes, temps, mémoire, logs).",
                'analogie' => "🧰 Une trousse d\'outils visible: diagnostics immédiats.",
                'cas_usage' => ['Inspection rapide', 'Navigation debug'],
                'exemple_code' => null,
                'avantages' => ['✅ Pratique en dev', '✅ Retour immédiat sur performances et erreurs'],
                'inconvenients' => ['⚠️ À ne pas activer en production', '⚠️ Peut masquer des problèmes si trop utilisé'],
                'ressources' => [
                    ['label' => 'Web Profiler & Toolbar', 'url' => 'https://symfony.com/doc/current/profiler.html#the-web-debug-toolbar', 'icon' => '🧰']
                ]
            ],
            'Maker Bundle' => [
                'description_detaillee' => "Générateur de code: contrôleurs, entités, formulaires, tests.",
                'analogie' => "⚙️ Un assistant: crée les bases pour aller plus vite.",
                'cas_usage' => ['Bootstrap de features', 'Prototypage'],
                'exemple_code' => [
                    'language' => 'bash',
                    'titre' => 'make:controller',
                    'code' => "php bin/console make:controller"
                ],
                'avantages' => ['✅ Gain de temps'],
                'inconvenients' => ['⚠️ Code généré à relire'],
                'ressources' => [
                    ['label' => 'Maker Bundle', 'url' => 'https://symfony.com/doc/current/bundles/SymfonyMakerBundle/index.html', 'icon' => '⚙️']
                ]
            ],
            'PHPUnit Bridge' => [
                'description_detaillee' => "Intégration tests unitaires, compatibilité versions et outils de couverture.",
                'analogie' => "🧪 Un labo de tests: vérifie la qualité du code.",
                'cas_usage' => ['Tests unitaires', 'CI'],
                'exemple_code' => [
                    'language' => 'bash',
                    'titre' => 'Exécuter tests',
                    'code' => "php bin/phpunit"
                ],
                'avantages' => ['✅ Qualité assurée'],
                'inconvenients' => [],
                'ressources' => [
                    ['label' => 'PHPUnit Bridge', 'url' => 'https://symfony.com/doc/current/components/phpunit_bridge.html', 'icon' => '🧪']
                ]
            ],
        ];
    }
}
