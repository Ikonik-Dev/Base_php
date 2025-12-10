<?php

namespace App\Data;

class SymfonyArchitectureData
{
    public static function getDetails(): array
    {
        return [
            'kernel' => [
                'description_detaillee' => "Le Kernel est le coeur de l'application Symfony: il initialise les bundles, construit le conteneur de services, charge la configuration et orchestre le cycle de vie de la requête (HttpKernel).",
                'analogie' => "🧠 Le Kernel est le cerveau: il réveille les organes (bundles), prépare l'énergie (services), et coordonne les actions à chaque stimulus (requête).",
                'cas_usage' => [
                    'Configuration de l’environnement et des bundles',
                    'Enregistrement des routes et des extensions',
                    'Chargement des fichiers de config',
                    'Gestion du cycle requête/réponse'
                ],
                'exemple_code' => [
                    'language' => 'php',
                    'titre' => 'Kernel basique (Symfony 6/7)',
                    'code' => "<?php\nnamespace App;\n\nuse Symfony\\Bundle\\FrameworkBundle\\Kernel\\MicroKernelTrait;\nuse Symfony\\Component\\HttpKernel\\Kernel as BaseKernel;\nuse Symfony\\Component\\DependencyInjection\\Loader\\Configurator\\ContainerConfigurator;\nuse Symfony\\Component\\Routing\\Loader\\Configurator\\RoutingConfigurator;\n\nclass Kernel extends BaseKernel\n{\n    use MicroKernelTrait;\n\n    protected function configureContainer(ContainerConfigurator \$container): void\n    {\n        \$container->import('../config/{packages}/*.yaml');\n        \$container->import('../config/{services}.yaml');\n    }\n\n    protected function configureRoutes(RoutingConfigurator \$routes): void\n    {\n        \$routes->import('../config/{routes}.yaml');\n    }\n}"
                ],
                'avantages' => [
                    '✅ Centralise le bootstrap de l’application',
                    '✅ Gestion multi-environnements',
                    '✅ Extensible via MicroKernelTrait'
                ],
                'inconvenients' => [
                    '⚠️ Peu fréquent à modifier pour débutants',
                    '⚠️ Peut sembler magique au départ'
                ],
                'ressources' => [
                    ['label' => 'HttpKernel', 'url' => 'https://symfony.com/doc/current/components/http_kernel.html', 'icon' => '🧠'],
                    ['label' => 'Kernel/MicroKernel', 'url' => 'https://symfony.com/doc/current/configuration/micro_kernel_trait.html', 'icon' => '⚙️']
                ]
            ],
            'service_container' => [
                'description_detaillee' => "Le Service Container (DI) centralise la création et la configuration des services. Il permet l’autowiring, l’injection des dépendances et la modularité du code.",
                'analogie' => "📦 Un entrepôt organisé: on y déclare les outils (services), et Symfony vous les livre automatiquement là où il faut.",
                'cas_usage' => [
                    'Déclaration de services applicatifs',
                    'Autowiring des dépendances',
                    'Paramètres et tags pour comportements avancés',
                    'Scopes, public/privé, lazy services'
                ],
                'exemple_code' => [
                    'language' => 'yaml',
                    'titre' => 'services.yaml + autowiring',
                    'code' => "# config/services.yaml\nservices:\n    _defaults:\n        autowire: true\n        autoconfigure: true\n        public: false\n\n    App\\Service\\PricingService: ~\n\n# Utilisation dans un controller\n# public function __construct(private PricingService \$pricing) {}"
                ],
                'avantages' => [
                    '✅ Découplage et testabilité',
                    '✅ Productivité via autowire/autoconfigure',
                    '✅ Extensible (tags, compiler passes)'
                ],
                'inconvenients' => [
                    '⚠️ Compréhension nécessaire des concepts DI',
                    '⚠️ Debug parfois délicat pour services privés'
                ],
                'ressources' => [
                    ['label' => 'Service Container', 'url' => 'https://symfony.com/doc/current/service_container.html', 'icon' => '📦'],
                    ['label' => 'Dependency Injection', 'url' => 'https://symfony.com/doc/current/components/dependency_injection.html', 'icon' => '💉']
                ]
            ],
            'event_dispatcher' => [
                'description_detaillee' => "L’Event Dispatcher implémente un système Observer: vos composants peuvent émettre des événements, et des listeners/subscribers y réagissent sans couplage.",
                'analogie' => "📻 Une radio: l’émetteur diffuse des signaux (événements), et les auditeurs (listeners) réagissent sans dépendre les uns des autres.",
                'cas_usage' => [
                    'Envoyer un email après un enregistrement',
                    'Audit/logging des actions',
                    'Mise à jour d’autres systèmes (stock, cache)',
                    'Architecture extensible par plugins'
                ],
                'exemple_code' => [
                    'language' => 'php',
                    'titre' => 'Événement + Listener avec attribut',
                    'code' => "<?php\nnamespace App\\Event;\nuse Symfony\\Contracts\\EventDispatcher\\Event;\nclass UserRegisteredEvent extends Event { public function __construct(public readonly int \$userId) {} }\n\nnamespace App\\EventListener;\nuse App\\Event\\UserRegisteredEvent;\nuse Symfony\\Component\\EventDispatcher\\Attribute\\AsEventListener;\n#[AsEventListener(event: UserRegisteredEvent::class)]\nclass SendWelcomeEmailListener {\n    public function __invoke(UserRegisteredEvent \$event): void { /* send email */ }\n}"
                ],
                'avantages' => [
                    '✅ Découplage et extensibilité',
                    '✅ Priorités et ordre d’exécution',
                    '✅ Testable et configurable'
                ],
                'inconvenients' => [
                    '⚠️ Flux d’exécution moins explicite',
                    '⚠️ Trop d’événements nuit à la lisibilité'
                ],
                'ressources' => [
                    ['label' => 'Event Dispatcher', 'url' => 'https://symfony.com/doc/current/components/event_dispatcher.html', 'icon' => '📡'],
                    ['label' => 'Events Reference', 'url' => 'https://symfony.com/doc/current/reference/events.html', 'icon' => '📋']
                ]
            ],
        ];
    }
}
