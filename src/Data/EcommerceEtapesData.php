<?php

namespace App\Data;

class EcommerceEtapesData
{
    /**
     * Donnees detaillees pour les modales des etapes.
     * On surcharge uniquement les etapes qui ont besoin d'un complement.
     */
    public static function getModalDetails(): array
    {
        return [
            // Etape 1 - Fondations du Projet
            1 => [
                'description_detaillee' => "Cette premiere etape pose les fondations de votre application e-commerce. Vous allez creer un nouveau projet Symfony, le configurer correctement, et mettre en place l'architecture de base qui servira de socle pour toutes les fonctionnalites futures.",
                'commandes' => [
                    [
                        'titre' => 'Creation du projet',
                        'code' => 'symfony new mon-ecommerce --version="7.3.*" --webapp',
                        'explication' => 'Cree un nouveau projet Symfony 7.3 avec toutes les dependances web (Twig, Asset Mapper, etc.)'
                    ],
                    [
                        'titre' => 'Installation des dependances',
                        'code' => "composer require symfony/orm-pack\ncomposer require --dev symfony/maker-bundle",
                        'explication' => 'Installe Doctrine ORM pour la base de donnees et MakerBundle pour generer du code'
                    ],
                    [
                        'titre' => 'Configuration de la base de donnees',
                        'code' => "# Dans .env.local\nDATABASE_URL=\"mysql://user:password@127.0.0.1:3306/ecommerce_db?serverVersion=8.0\"",
                        'explication' => 'Configure la connexion a votre base de donnees MySQL'
                    ],
                    [
                        'titre' => 'Creation de la base de donnees',
                        'code' => 'php bin/console doctrine:database:create',
                        'explication' => 'Cree physiquement la base de donnees'
                    ],
                ],
                'fichiers_a_creer' => [
                    [
                        'path' => 'templates/base.html.twig',
                        'description' => 'Template de base pour toutes les pages',
                        'language' => 'twig',
                        'code' => "<!DOCTYPE html>\n<html lang=\"fr\">\n<head>\n    <meta charset=\"UTF-8\">\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n    <title>{% block title %}Boutique E-commerce{% endblock %}</title>\n    {% block stylesheets %}{% endblock %}\n</head>\n<body>\n    <nav class=\"navbar\">\n        <div class=\"container\">\n            <a href=\"{{ path('app_home') }}\" class=\"navbar-brand\">Ma Boutique</a>\n            <ul class=\"navbar-nav\">\n                <li><a href=\"{{ path('app_products') }}\">Produits</a></li>\n                <li><a href=\"{{ path('cart_index') }}\">Panier</a></li>\n            </ul>\n        </div>\n    </nav>\n\n    <main class=\"container\">\n        {% for message in app.flashes('success') %}\n            <div class=\"alert alert-success\">{{ message }}</div>\n        {% endfor %}\n        {% for message in app.flashes('warning') %}\n            <div class=\"alert alert-warning\">{{ message }}</div>\n        {% endfor %}\n\n        {% block body %}{% endblock %}\n    </main>\n\n    <footer class=\"footer\">\n        <div class=\"container\">\n            <p>&copy; {{ 'now'|date('Y') }} Ma Boutique - Tutoriel Symfony</p>\n        </div>\n    </footer>\n\n    {% block javascripts %}{% endblock %}\n</body>\n</html>"
                    ],
                    [
                        'path' => 'src/Controller/HomeController.php',
                        'description' => 'Controleur de la page d\'accueil',
                        'code' => "<?php\nnamespace App\\Controller;\n\nuse Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController;\nuse Symfony\\Component\\HttpFoundation\\Response;\nuse Symfony\\Component\\Routing\\Attribute\\Route;\n\nclass HomeController extends AbstractController\n{\n    #[Route('/', name: 'app_home')]\n    public function index(): Response\n    {\n        return \$this->render('home/index.html.twig', [\n            'title' => 'Bienvenue sur notre boutique',\n        ]);\n    }\n}\n"
                    ],
                    [
                        'path' => 'templates/home/index.html.twig',
                        'description' => 'Page d\'accueil de la boutique',
                        'language' => 'twig',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}Accueil - {{ parent() }}{% endblock %}\n\n{% block body %}\n<div class=\"hero\">\n    <h1>{{ title }}</h1>\n    <p>Decouvrez notre selection de produits</p>\n    <a href=\"{{ path('app_products') }}\" class=\"btn btn-primary btn-large\">\n        Voir les produits\n    </a>\n</div>\n{% endblock %}"
                    ],
                ],
                'checklist' => [
                    'Le serveur Symfony demarre correctement (symfony serve)',
                    'Vous pouvez acceder a https://127.0.0.1:8000',
                    'La base de donnees est creee et accessible',
                    'Le template de base s\'affiche sans erreur',
                    'La page d\'accueil fonctionne'
                ],
                'pieges_communs' => [
                    'Oublier de demarrer MySQL/MariaDB avant de creer la base',
                    'Erreur de connexion : verifier les identifiants dans .env.local',
                    'Port 8000 deja utilise : utiliser symfony serve -d ou changer le port',
                    'Ne pas versionner .env.local (il contient vos secrets)'
                ],
                'ressources' => [
                    ['label' => 'Installation Symfony', 'url' => 'https://symfony.com/doc/current/setup.html', 'icon' => '📖'],
                    ['label' => 'Doctrine Setup', 'url' => 'https://symfony.com/doc/current/doctrine.html', 'icon' => '🗄️'],
                    ['label' => 'Twig', 'url' => 'https://twig.symfony.com/doc/3.x/', 'icon' => '🎨']
                ]
            ],

            // Etape 2 - Modelisation des Donnees
            2 => [
                'description_detaillee' => "La modelisation des donnees est cruciale pour un e-commerce. Vous allez creer les entites qui representent vos produits et categories, puis definir comment elles interagissent entre elles. L'entite User sera creee plus tard lors de l'etape Authentification.",
                'commandes' => [
                    [
                        'titre' => 'Creation de l\'entite Product',
                        'code' => 'php bin/console make:entity Product',
                        'explication' => 'Lance l\'assistant interactif pour creer l\'entite Product avec ses proprietes'
                    ],
                    [
                        'titre' => 'Creation de l\'entite Category',
                        'code' => 'php bin/console make:entity Category',
                        'explication' => 'Cree l\'entite Category pour organiser vos produits'
                    ],
                    [
                        'titre' => 'Generation de la migration',
                        'code' => 'php bin/console make:migration',
                        'explication' => 'Genere le fichier de migration base sur vos entites'
                    ],
                    [
                        'titre' => 'Execution de la migration',
                        'code' => 'php bin/console doctrine:migrations:migrate',
                        'explication' => 'Applique les modifications a la base de donnees'
                    ],
                    [
                        'titre' => 'Charger des donnees de test (fixtures)',
                        'code' => "composer require --dev orm-fixtures\nphp bin/console make:fixtures ProductFixtures\nphp bin/console doctrine:fixtures:load",
                        'explication' => 'Installe le bundle fixtures et charge des donnees de test'
                    ],
                ],
                'fichiers_a_creer' => [
                    [
                        'path' => 'src/Entity/Product.php',
                        'description' => 'Entite representant un produit',
                        'code' => "<?php\nnamespace App\\Entity;\n\nuse App\\Repository\\ProductRepository;\nuse Doctrine\\DBAL\\Types\\Types;\nuse Doctrine\\ORM\\Mapping as ORM;\nuse Symfony\\Component\\Validator\\Constraints as Assert;\n\n#[ORM\\Entity(repositoryClass: ProductRepository::class)]\nclass Product\n{\n    #[ORM\\Id]\n    #[ORM\\GeneratedValue]\n    #[ORM\\Column]\n    private ?int \$id = null;\n\n    #[ORM\\Column(length: 255)]\n    #[Assert\\NotBlank(message: 'Le nom du produit est obligatoire')]\n    #[Assert\\Length(min: 3, max: 255)]\n    private ?string \$name = null;\n\n    #[ORM\\Column(type: Types::TEXT, nullable: true)]\n    private ?string \$description = null;\n\n    #[ORM\\Column(type: Types::DECIMAL, precision: 10, scale: 2)]\n    #[Assert\\NotBlank]\n    #[Assert\\Positive(message: 'Le prix doit etre positif')]\n    private ?string \$price = null;\n\n    #[ORM\\Column]\n    #[Assert\\PositiveOrZero(message: 'Le stock ne peut pas etre negatif')]\n    private int \$stock = 0;\n\n    #[ORM\\Column(length: 255, nullable: true)]\n    private ?string \$image = null;\n\n    #[ORM\\ManyToOne(inversedBy: 'products')]\n    private ?Category \$category = null;\n\n    #[ORM\\Column]\n    private ?\\DateTimeImmutable \$createdAt = null;\n\n    public function __construct()\n    {\n        \$this->createdAt = new \\DateTimeImmutable();\n    }\n\n    public function getId(): ?int { return \$this->id; }\n    public function getName(): ?string { return \$this->name; }\n    public function setName(string \$name): static { \$this->name = \$name; return \$this; }\n    public function getDescription(): ?string { return \$this->description; }\n    public function setDescription(?string \$description): static { \$this->description = \$description; return \$this; }\n    public function getPrice(): ?string { return \$this->price; }\n    public function setPrice(string \$price): static { \$this->price = \$price; return \$this; }\n    public function getStock(): int { return \$this->stock; }\n    public function setStock(int \$stock): static { \$this->stock = \$stock; return \$this; }\n    public function getImage(): ?string { return \$this->image; }\n    public function setImage(?string \$image): static { \$this->image = \$image; return \$this; }\n    public function getCategory(): ?Category { return \$this->category; }\n    public function setCategory(?Category \$category): static { \$this->category = \$category; return \$this; }\n    public function getCreatedAt(): ?\\DateTimeImmutable { return \$this->createdAt; }\n}\n"
                    ],
                    [
                        'path' => 'src/Entity/Category.php',
                        'description' => 'Entite representant une categorie',
                        'code' => "<?php\nnamespace App\\Entity;\n\nuse App\\Repository\\CategoryRepository;\nuse Doctrine\\Common\\Collections\\ArrayCollection;\nuse Doctrine\\Common\\Collections\\Collection;\nuse Doctrine\\ORM\\Mapping as ORM;\nuse Symfony\\Component\\Validator\\Constraints as Assert;\n\n#[ORM\\Entity(repositoryClass: CategoryRepository::class)]\nclass Category\n{\n    #[ORM\\Id]\n    #[ORM\\GeneratedValue]\n    #[ORM\\Column]\n    private ?int \$id = null;\n\n    #[ORM\\Column(length: 100)]\n    #[Assert\\NotBlank]\n    private ?string \$name = null;\n\n    #[ORM\\Column(length: 100, unique: true)]\n    private ?string \$slug = null;\n\n    #[ORM\\OneToMany(targetEntity: Product::class, mappedBy: 'category')]\n    private Collection \$products;\n\n    public function __construct()\n    {\n        \$this->products = new ArrayCollection();\n    }\n\n    public function getId(): ?int { return \$this->id; }\n    public function getName(): ?string { return \$this->name; }\n    public function setName(string \$name): static { \$this->name = \$name; return \$this; }\n    public function getSlug(): ?string { return \$this->slug; }\n    public function setSlug(string \$slug): static { \$this->slug = \$slug; return \$this; }\n    public function getProducts(): Collection { return \$this->products; }\n    public function addProduct(Product \$product): static\n    {\n        if (!\$this->products->contains(\$product)) {\n            \$this->products->add(\$product);\n            \$product->setCategory(\$this);\n        }\n        return \$this;\n    }\n}\n"
                    ],
                    [
                        'path' => 'src/DataFixtures/ProductFixtures.php',
                        'description' => 'Fixtures pour charger des donnees de test',
                        'code' => "<?php\nnamespace App\\DataFixtures;\n\nuse App\\Entity\\Category;\nuse App\\Entity\\Product;\nuse Doctrine\\Bundle\\FixturesBundle\\Fixture;\nuse Doctrine\\Persistence\\ObjectManager;\n\nclass ProductFixtures extends Fixture\n{\n    public function load(ObjectManager \$manager): void\n    {\n        // Categories\n        \$categories = ['Electronique', 'Vetements', 'Maison', 'Sport'];\n        \$categoryEntities = [];\n\n        foreach (\$categories as \$catName) {\n            \$category = new Category();\n            \$category->setName(\$catName);\n            \$category->setSlug(strtolower(\$catName));\n            \$manager->persist(\$category);\n            \$categoryEntities[] = \$category;\n        }\n\n        // Produits\n        \$products = [\n            ['name' => 'Smartphone Pro', 'price' => '699.99', 'stock' => 50],\n            ['name' => 'T-shirt Coton Bio', 'price' => '29.99', 'stock' => 100],\n            ['name' => 'Lampe LED Design', 'price' => '49.99', 'stock' => 30],\n            ['name' => 'Ballon Football', 'price' => '24.99', 'stock' => 75],\n            ['name' => 'Casque Audio', 'price' => '149.99', 'stock' => 25],\n            ['name' => 'Jean Slim', 'price' => '59.99', 'stock' => 60],\n        ];\n\n        foreach (\$products as \$i => \$data) {\n            \$product = new Product();\n            \$product->setName(\$data['name']);\n            \$product->setDescription('Description du produit ' . \$data['name']);\n            \$product->setPrice(\$data['price']);\n            \$product->setStock(\$data['stock']);\n            \$product->setCategory(\$categoryEntities[\$i % count(\$categoryEntities)]);\n            \$manager->persist(\$product);\n        }\n\n        \$manager->flush();\n    }\n}\n"
                    ],
                ],
                'checklist' => [
                    'Les entites Product et Category sont creees',
                    'Les relations ManyToOne et OneToMany sont correctement definies',
                    'La migration s\'execute sans erreur',
                    'Les tables apparaissent dans votre base de donnees',
                    'Les fixtures chargent des donnees de test',
                    'Les contraintes de validation sont en place'
                ],
                'pieges_communs' => [
                    'Oublier de definir le inversedBy et mappedBy pour les relations',
                    'Type decimal pour le prix : utiliser "decimal" pas "float" (precision)',
                    'Ne pas oublier nullable: false pour les champs obligatoires',
                    'Oublier de creer le Repository associe a chaque entite',
                    'Ne pas regenerer les getters/setters apres modification'
                ],
                'ressources' => [
                    ['label' => 'Doctrine Entities', 'url' => 'https://symfony.com/doc/current/doctrine.html#creating-an-entity-class', 'icon' => '🗂️'],
                    ['label' => 'Relations Doctrine', 'url' => 'https://symfony.com/doc/current/doctrine/associations.html', 'icon' => '🔗'],
                    ['label' => 'Fixtures', 'url' => 'https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html', 'icon' => '🧪'],
                    ['label' => 'Validation', 'url' => 'https://symfony.com/doc/current/validation.html', 'icon' => '✅']
                ]
            ],

            // Etape 3 - Catalogue Produits (pagination)
            3 => [
                'description_detaillee' => "Creez l'interface publique avec pagination, filtres et pages de detail pour vos produits. Chaque produit dispose d'une fiche complete avec bouton d'ajout au panier.",
                'commandes' => [
                    [
                        'titre' => 'Creation du controleur',
                        'code' => 'php bin/console make:controller ProductController',
                        'explication' => "Genere le controleur pour l'affichage des produits"
                    ],
                    [
                        'titre' => 'Installation du bundle de pagination',
                        'code' => 'composer require knplabs/knp-paginator-bundle',
                        'explication' => 'Installe KnpPaginator pour gerer la pagination automatiquement'
                    ],
                    [
                        'titre' => "Verifier l'activation du bundle",
                        'code' => "# Verifiez que le bundle est bien active dans config/bundles.php\n# Cette ligne doit etre presente :\nKnp\\\\Bundle\\\\PaginatorBundle\\\\KnpPaginatorBundle::class => ['all' => true],",
                        'explication' => "Activation auto a l'installation ; cette verification evite les surprises"
                    ],
                    [
                        'titre' => 'Configuration du paginator (optionnel)',
                        'code' => "# Creez config/packages/knp_paginator.yaml si besoin de personnaliser\nknp_paginator:\n    page_range: 5                       # Nombre de pages affichees\n    default_options:\n        page_name: page                 # Nom du parametre GET\n        sort_field_name: sort\n        sort_direction_name: direction\n    template:\n        pagination: '@KnpPaginator/Pagination/sliding.html.twig'",
                        'explication' => 'Configuration optionnelle, les valeurs par defaut fonctionnent deja bien'
                    ],
                ],
                'fichiers_a_creer' => [
                    [
                        'path' => 'src/Controller/ProductController.php',
                        'description' => 'Controleur complet : liste paginee + page detail',
                        'code' => "<?php\nnamespace App\\Controller;\n\nuse App\\Entity\\Product;\nuse App\\Repository\\ProductRepository;\nuse Knp\\Component\\Pager\\PaginatorInterface;\nuse Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController;\nuse Symfony\\Component\\HttpFoundation\\Request;\nuse Symfony\\Component\\HttpFoundation\\Response;\nuse Symfony\\Component\\Routing\\Attribute\\Route;\n\nclass ProductController extends AbstractController\n{\n    #[Route('/products', name: 'app_products')]\n    public function index(\n        ProductRepository \$productRepository,\n        PaginatorInterface \$paginator,\n        Request \$request\n    ): Response {\n        \$query = \$productRepository->createQueryBuilder('p')\n            ->orderBy('p.name', 'ASC')\n            ->getQuery();\n\n        \$pagination = \$paginator->paginate(\n            \$query,\n            \$request->query->getInt('page', 1),\n            12 // Produits par page\n        );\n\n        return \$this->render('product/index.html.twig', [\n            'products' => \$pagination,\n        ]);\n    }\n\n    #[Route('/products/{id}', name: 'app_product_show', requirements: ['id' => '\\d+'])]\n    public function show(Product \$product): Response\n    {\n        return \$this->render('product/show.html.twig', [\n            'product' => \$product,\n        ]);\n    }\n\n    #[Route('/products/category/{slug}', name: 'app_products_by_category')]\n    public function byCategory(\n        string \$slug,\n        ProductRepository \$productRepository,\n        PaginatorInterface \$paginator,\n        Request \$request\n    ): Response {\n        \$query = \$productRepository->createQueryBuilder('p')\n            ->join('p.category', 'c')\n            ->where('c.slug = :slug')\n            ->setParameter('slug', \$slug)\n            ->orderBy('p.name', 'ASC')\n            ->getQuery();\n\n        \$pagination = \$paginator->paginate(\n            \$query,\n            \$request->query->getInt('page', 1),\n            12\n        );\n\n        return \$this->render('product/index.html.twig', [\n            'products' => \$pagination,\n            'category_slug' => \$slug,\n        ]);\n    }\n}\n"
                    ],
                    [
                        'path' => 'templates/product/index.html.twig',
                        'description' => 'Liste des produits avec grille et pagination',
                        'language' => 'twig',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}Nos Produits{% endblock %}\n\n{% block body %}\n<div class='container'>\n    <h1>Catalogue des produits</h1>\n\n    <p class='products-count'>{{ products.getTotalItemCount }} produits disponibles</p>\n\n    <div class='products-grid'>\n        {% for product in products %}\n            <article class='product-card'>\n                <div class='product-card__image'>\n                    {% if product.image %}\n                        <img src='/uploads/products/{{ product.image }}' alt='{{ product.name }}'>\n                    {% else %}\n                        <div class='placeholder-image'>📷</div>\n                    {% endif %}\n                </div>\n                <div class='product-card__body'>\n                    <h3 class='product-card__title'>{{ product.name }}</h3>\n                    <p class='product-card__description'>{{ product.description|slice(0, 80) }}...</p>\n                    <p class='product-card__price'>{{ product.price|number_format(2, ',', ' ') }} EUR</p>\n                    <p class='product-card__stock'>\n                        {% if product.stock > 0 %}\n                            <span class='stock-ok'>En stock ({{ product.stock }})</span>\n                        {% else %}\n                            <span class='stock-out'>Rupture de stock</span>\n                        {% endif %}\n                    </p>\n                </div>\n                <div class='product-card__actions'>\n                    <a href='{{ path('app_product_show', {id: product.id}) }}' class='btn btn--secondary'>Voir</a>\n                    {% if product.stock > 0 %}\n                        <a href='{{ path('cart_add', {id: product.id}) }}' class='btn btn-primary'>Ajouter</a>\n                    {% endif %}\n                </div>\n            </article>\n        {% else %}\n            <p class='no-products'>Aucun produit disponible pour le moment.</p>\n        {% endfor %}\n    </div>\n\n    <div class='pagination-wrapper'>\n        {{ knp_pagination_render(products) }}\n    </div>\n</div>\n{% endblock %}\n"
                    ],
                    [
                        'path' => 'templates/product/show.html.twig',
                        'description' => 'Page detail produit avec ajout au panier',
                        'language' => 'twig',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}{{ product.name }} - Ma Boutique{% endblock %}\n\n{% block body %}\n<div class='container product-detail'>\n    <nav class='breadcrumb'>\n        <a href='{{ path('app_home') }}'>Accueil</a> &raquo;\n        <a href='{{ path('app_products') }}'>Produits</a> &raquo;\n        {% if product.category %}\n            <a href='{{ path('app_products_by_category', {slug: product.category.slug}) }}'>\n                {{ product.category.name }}\n            </a> &raquo;\n        {% endif %}\n        <span>{{ product.name }}</span>\n    </nav>\n\n    <div class='product-detail__grid'>\n        <div class='product-detail__image'>\n            {% if product.image %}\n                <img src='/uploads/products/{{ product.image }}' alt='{{ product.name }}' class='main-image'>\n            {% else %}\n                <div class='placeholder-image placeholder-image--large'>📷 Image non disponible</div>\n            {% endif %}\n        </div>\n\n        <div class='product-detail__info'>\n            <h1 class='product-detail__title'>{{ product.name }}</h1>\n\n            {% if product.category %}\n                <p class='product-detail__category'>\n                    Categorie : <a href='{{ path('app_products_by_category', {slug: product.category.slug}) }}'>\n                        {{ product.category.name }}\n                    </a>\n                </p>\n            {% endif %}\n\n            <p class='product-detail__price'>{{ product.price|number_format(2, ',', ' ') }} EUR</p>\n\n            <div class='product-detail__stock'>\n                {% if product.stock > 10 %}\n                    <span class='badge badge--success'>En stock</span>\n                {% elseif product.stock > 0 %}\n                    <span class='badge badge--warning'>Plus que {{ product.stock }} en stock !</span>\n                {% else %}\n                    <span class='badge badge--danger'>Rupture de stock</span>\n                {% endif %}\n            </div>\n\n            <div class='product-detail__description'>\n                <h3>Description</h3>\n                <p>{{ product.description|nl2br }}</p>\n            </div>\n\n            {% if product.stock > 0 %}\n                <form action='{{ path('cart_add', {id: product.id}) }}' method='get' class='add-to-cart-form'>\n                    <div class='quantity-selector'>\n                        <label for='qty'>Quantite :</label>\n                        <input type='number' name='qty' id='qty' value='1' min='1' max='{{ product.stock }}' class='input-qty'>\n                    </div>\n                    <button type='submit' class='btn btn-primary btn-large'>\n                        🛒 Ajouter au panier\n                    </button>\n                </form>\n            {% else %}\n                <div class='out-of-stock-notice'>\n                    <p>Ce produit est actuellement indisponible.</p>\n                    <button class='btn btn--secondary' disabled>Indisponible</button>\n                </div>\n            {% endif %}\n        </div>\n    </div>\n\n    <div class='back-link'>\n        <a href='{{ path('app_products') }}' class='btn btn--secondary'>&larr; Retour au catalogue</a>\n    </div>\n</div>\n{% endblock %}\n"
                    ],
                ],
                'checklist' => [
                    "La liste des produits s'affiche correctement avec pagination",
                    'La page detail affiche toutes les informations du produit',
                    'Le bouton Ajouter au panier est visible si stock > 0',
                    'Le selecteur de quantite respecte le stock disponible',
                    'Le fil d\'Ariane (breadcrumb) fonctionne',
                    'Le filtre par categorie fonctionne',
                    'Les images s\'affichent (ou placeholder si absentes)'
                ],
                'pieges_communs' => [
                    'Oublier d\'injecter Request pour lire le parametre page',
                    'Ne pas configurer correctement le bundle Paginator',
                    'Route show sans requirement : conflit avec /products/category',
                    'Oublier de verifier le stock avant d\'afficher le bouton Ajouter',
                    'Problemes d\'affichage : verifier les chemins des assets/images'
                ],
                'ressources' => [
                    ['label' => 'Controllers Symfony', 'url' => 'https://symfony.com/doc/current/controller.html', 'icon' => '🎮'],
                    ['label' => 'Twig Templates', 'url' => 'https://twig.symfony.com/', 'icon' => '🎨'],
                    ['label' => 'KnpPaginator', 'url' => 'https://github.com/KnpLabs/KnpPaginatorBundle', 'icon' => '📄'],
                    ['label' => 'ParamConverter', 'url' => 'https://symfony.com/doc/current/doctrine.html#fetching-objects-automatically', 'icon' => '🔄']
                ],
            ],

            // Etape 4 - Systeme de Panier (session uniquement)
            4 => [
                'description_detaillee' => "Implementez un panier en session : ajout/suppression de produits, gestion des quantites, calcul des totaux. Le panier reste en memoire session — les entites Order/OrderItem seront creees a l'etape 6 (Processus de Commande).",
                'commandes' => [
                    [
                        'titre' => 'Service CartSessionStorage',
                        'code' => 'php bin/console make:service CartSessionStorage',
                        'explication' => 'Stocke le panier en session (RequestStack) et hydrate les produits via ProductRepository.'
                    ],
                    [
                        'titre' => 'Service CartManager',
                        'code' => 'php bin/console make:service CartManager',
                        'explication' => "Orchestre l'ajout/suppression et le calcul des totaux en s'appuyant sur CartSessionStorage."
                    ],
                    [
                        'titre' => 'Controleur CartController',
                        'code' => 'php bin/console make:controller CartController',
                        'explication' => "Expose les routes d'affichage/ajout/suppression en injectant CartManager."
                    ],
                ],
                'fichiers_a_creer' => [
                    [
                        'path' => 'src/Service/CartSessionStorage.php',
                        'description' => 'Stockage du panier en session avec gestion complete',
                        'code' => "<?php\nnamespace App\\Service;\n\nuse App\\Repository\\ProductRepository;\nuse Symfony\\Component\\HttpFoundation\\RequestStack;\n\nclass CartSessionStorage\n{\n    private const CART_KEY = 'cart';\n\n    public function __construct(\n        private RequestStack \\\$requestStack,\n        private ProductRepository \\\$productRepository\n    ) {}\n\n    public function getCart(): array\n    {\n        return \\\$this->requestStack->getSession()->get(self::CART_KEY, []);\n    }\n\n    public function saveCart(array \\\$cart): void\n    {\n        \\\$this->requestStack->getSession()->set(self::CART_KEY, \\\$cart);\n    }\n\n    public function addItem(int \\\$productId, int \\\$quantity = 1): void\n    {\n        \\\$cart = \\\$this->getCart();\n        \\\$cart[\\\$productId] = (\\\$cart[\\\$productId] ?? 0) + \\\$quantity;\n        \\\$this->saveCart(\\\$cart);\n    }\n\n    public function setItemQuantity(int \\\$productId, int \\\$quantity): void\n    {\n        \\\$cart = \\\$this->getCart();\n        if (\\\$quantity <= 0) {\n            unset(\\\$cart[\\\$productId]);\n        } else {\n            \\\$cart[\\\$productId] = \\\$quantity;\n        }\n        \\\$this->saveCart(\\\$cart);\n    }\n\n    public function removeItem(int \\\$productId): void\n    {\n        \\\$cart = \\\$this->getCart();\n        unset(\\\$cart[\\\$productId]);\n        \\\$this->saveCart(\\\$cart);\n    }\n\n    public function clear(): void\n    {\n        \\\$this->saveCart([]);\n    }\n\n    public function hydrateProducts(): array\n    {\n        \\\$cart = \\\$this->getCart();\n        if (empty(\\\$cart)) {\n            return [[], []];\n        }\n        \\\$products = \\\$this->productRepository->findBy(['id' => array_keys(\\\$cart)]);\n        return [\\\$cart, \\\$products];\n    }\n}\n"
                    ],
                    [
                        'path' => 'src/Service/CartManager.php',
                        'description' => 'Orchestrateur metier du panier avec gestion quantites',
                        'code' => "<?php\nnamespace App\\Service;\n\nuse App\\Entity\\Product;\n\nclass CartManager\n{\n    public function __construct(\n        private CartSessionStorage \\\$storage\n    ) {}\n\n    public function add(Product \\\$product, int \\\$quantity = 1): void\n    {\n        \\\$this->storage->addItem(\\\$product->getId(), \\\$quantity);\n    }\n\n    public function updateQuantity(int \\\$productId, int \\\$quantity): void\n    {\n        \\\$this->storage->setItemQuantity(\\\$productId, \\\$quantity);\n    }\n\n    public function remove(int \\\$productId): void\n    {\n        \\\$this->storage->removeItem(\\\$productId);\n    }\n\n    public function clear(): void\n    {\n        \\\$this->storage->clear();\n    }\n\n    public function getCartLines(): array\n    {\n        [\\\$rawCart, \\\$products] = \\\$this->storage->hydrateProducts();\n        \\\$lines = [];\n        foreach (\\\$products as \\\$product) {\n            \\\$qty = \\\$rawCart[\\\$product->getId()] ?? 0;\n            \\\$lines[] = [\n                'product' => \\\$product,\n                'quantity' => \\\$qty,\n                'line_total' => (float) \\\$product->getPrice() * \\\$qty,\n            ];\n        }\n        return \\\$lines;\n    }\n\n    public function getTotal(): float\n    {\n        return array_sum(array_column(\\\$this->getCartLines(), 'line_total'));\n    }\n\n    public function getItemCount(): int\n    {\n        return array_sum(\\\$this->storage->getCart());\n    }\n\n    public function isEmpty(): bool\n    {\n        return empty(\\\$this->storage->getCart());\n    }\n}\n"
                    ],
                    [
                        'path' => 'src/Controller/CartController.php',
                        'description' => 'Controleur du panier avec validation stock',
                        'code' => "<?php\nnamespace App\\Controller;\n\nuse App\\Entity\\Product;\nuse App\\Service\\CartManager;\nuse Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController;\nuse Symfony\\Component\\HttpFoundation\\Request;\nuse Symfony\\Component\\HttpFoundation\\Response;\nuse Symfony\\Component\\Routing\\Attribute\\Route;\n\n#[Route('/cart')]\nclass CartController extends AbstractController\n{\n    public function __construct(private CartManager \\\$cartManager) {}\n\n    #[Route('', name: 'cart_index')]\n    public function index(): Response\n    {\n        return \\\$this->render('cart/index.html.twig', [\n            'lines' => \\\$this->cartManager->getCartLines(),\n            'total' => \\\$this->cartManager->getTotal(),\n        ]);\n    }\n\n    #[Route('/add/{id}', name: 'cart_add', methods: ['POST', 'GET'])]\n    public function add(Product \\\$product, Request \\\$request): Response\n    {\n        \\\$qty = max(1, (int) \\\$request->get('qty', 1));\n\n        // Validation du stock disponible\n        if (\\\$product->getStock() < 1) {\n            \\\$this->addFlash('warning', 'Ce produit est en rupture de stock.');\n            return \\\$this->redirectToRoute('app_product_show', ['id' => \\\$product->getId()]);\n        }\n\n        if (\\\$qty > \\\$product->getStock()) {\n            \\\$this->addFlash('warning', 'Stock insuffisant. Maximum disponible : ' . \\\$product->getStock());\n            \\\$qty = \\\$product->getStock();\n        }\n\n        \\\$this->cartManager->add(\\\$product, \\\$qty);\n        \\\$this->addFlash('success', \\\$product->getName() . ' ajoute au panier');\n        return \\\$this->redirectToRoute('cart_index');\n    }\n\n    #[Route('/update/{id}', name: 'cart_update', methods: ['POST'])]\n    public function update(int \\\$id, Request \\\$request): Response\n    {\n        \\\$qty = max(1, (int) \\\$request->request->get('qty', 1));\n        \\\$this->cartManager->updateQuantity(\\\$id, \\\$qty);\n        return \\\$this->redirectToRoute('cart_index');\n    }\n\n    #[Route('/remove/{id}', name: 'cart_remove', methods: ['POST', 'GET'])]\n    public function remove(int \\\$id): Response\n    {\n        \\\$this->cartManager->remove(\\\$id);\n        \\\$this->addFlash('success', 'Produit retire du panier');\n        return \\\$this->redirectToRoute('cart_index');\n    }\n}\n"
                    ],
                    [
                        'path' => 'templates/cart/index.html.twig',
                        'description' => 'Vue Twig du panier avec modification quantites',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}Mon panier{% endblock %}\n\n{% block body %}\n<div class='container'>\n    <h1>🛒 Mon panier</h1>\n\n    {% for message in app.flashes('success') %}\n        <div class='alert alert-success'>{{ message }}</div>\n    {% endfor %}\n    {% for message in app.flashes('warning') %}\n        <div class='alert alert-warning'>{{ message }}</div>\n    {% endfor %}\n\n    {% if lines is empty %}\n        <div class='empty-cart'>\n            <p>Votre panier est vide.</p>\n            <a href='{{ path('app_products') }}' class='btn btn-primary'>Voir les produits</a>\n        </div>\n    {% else %}\n        <table class='cart-table'>\n            <thead>\n                <tr>\n                    <th>Produit</th>\n                    <th>Prix unitaire</th>\n                    <th>Quantite</th>\n                    <th>Total ligne</th>\n                    <th>Actions</th>\n                </tr>\n            </thead>\n            <tbody>\n                {% for line in lines %}\n                <tr>\n                    <td>\n                        <a href='{{ path('app_product_show', {id: line.product.id}) }}'>\n                            {{ line.product.name }}\n                        </a>\n                    </td>\n                    <td>{{ line.product.price|number_format(2, ',', ' ') }} EUR</td>\n                    <td>\n                        <form action='{{ path('cart_update', {id: line.product.id}) }}' method='post' class='qty-form'>\n                            <input type='number' name='qty' value='{{ line.quantity }}' min='1' max='{{ line.product.stock }}' class='input-qty'>\n                            <button type='submit' class='btn btn-sm'>Maj</button>\n                        </form>\n                    </td>\n                    <td class='line-total'>{{ line.line_total|number_format(2, ',', ' ') }} EUR</td>\n                    <td>\n                        <a href='{{ path('cart_remove', {id: line.product.id}) }}' class='btn btn--danger btn-sm' onclick='return confirm(\"Retirer ce produit ?\")'>\n                            Retirer\n                        </a>\n                    </td>\n                </tr>\n                {% endfor %}\n            </tbody>\n        </table>\n\n        <div class='cart-footer'>\n            <div class='cart-total'>\n                <strong>Total : {{ total|number_format(2, ',', ' ') }} EUR</strong>\n            </div>\n            <div class='cart-actions'>\n                <a href='{{ path('app_products') }}' class='btn btn--secondary'>Continuer les achats</a>\n                <a href='{{ path('checkout_address') }}' class='btn btn-primary btn-large'>Passer commande</a>\n            </div>\n        </div>\n    {% endif %}\n</div>\n{% endblock %}\n"
                    ],
                ],
                'checklist' => [
                    'CartSessionStorage persiste le panier en session',
                    'CartManager calcule quantites et total',
                    'Methode clear() pour vider le panier',
                    "Routes add/remove/index fonctionnelles",
                    'Vue Twig affiche lignes, prix unitaire et total',
                    'Bouton "Passer commande" redirige vers checkout (etape 6)'
                ],
                'pieges_communs' => [
                    'Ne stocker en session que les IDs produits (pas les entites)',
                    'Verifier le stock/existence du produit avant ajout',
                    'Valider les quantites envoyees (> 0)',
                    'Ne PAS creer Order/OrderItem ici — ce sera fait a l\'etape 6'
                ],
                'ressources' => [
                    ['label' => 'Sessions Symfony', 'url' => 'https://symfony.com/doc/current/session.html', 'icon' => '🔐'],
                    ['label' => 'Services', 'url' => 'https://symfony.com/doc/current/service_container.html', 'icon' => '⚙️'],
                ],
            ],

            // Etape 5 - Authentification (commandes modernisees)
            5 => [
                'description_detaillee' => "Mettez en place l'inscription, la connexion et la gestion de profil avec le systeme de securite Symfony. L'entite User stocke les informations utilisateur, le firewall protege les routes, et les formulaires gerent l'authentification.",
                'commandes' => [
                    [
                        'titre' => "Creation de l'entite User",
                        'code' => 'php bin/console make:user',
                        'explication' => 'Genere User (email + password). Choisissez email comme identifiant unique.'
                    ],
                    [
                        'titre' => 'Creation du systeme de connexion',
                        'code' => 'php bin/console make:security:form-login',
                        'explication' => 'Genere controleur + template de login et configure le firewall.'
                    ],
                    [
                        'titre' => "Creation du formulaire d'inscription",
                        'code' => 'php bin/console make:registration-form',
                        'explication' => "Formulaire d'inscription avec hashage automatique du mot de passe."
                    ],
                    [
                        'titre' => 'Migration User',
                        'code' => "php bin/console make:migration\nphp bin/console doctrine:migrations:migrate",
                        'explication' => 'Cree la table users dans la base de donnees'
                    ],
                    [
                        'titre' => 'Creer un utilisateur admin (optionnel)',
                        'code' => "php bin/console security:hash-password\n# Puis inserez manuellement ou via fixture",
                        'explication' => 'Hashe un mot de passe pour creer un admin en base'
                    ],
                ],
                'fichiers_a_creer' => [
                    [
                        'path' => 'src/Entity/User.php',
                        'description' => 'Entite User avec roles et email unique',
                        'code' => "<?php\nnamespace App\\Entity;\n\nuse App\\Repository\\UserRepository;\nuse Doctrine\\ORM\\Mapping as ORM;\nuse Symfony\\Bridge\\Doctrine\\Validator\\Constraints\\UniqueEntity;\nuse Symfony\\Component\\Security\\Core\\User\\PasswordAuthenticatedUserInterface;\nuse Symfony\\Component\\Security\\Core\\User\\UserInterface;\nuse Symfony\\Component\\Validator\\Constraints as Assert;\n\n#[ORM\\Entity(repositoryClass: UserRepository::class)]\n#[ORM\\Table(name: '`user`')]\n#[UniqueEntity(fields: ['email'], message: 'Cet email est deja utilise')]\nclass User implements UserInterface, PasswordAuthenticatedUserInterface\n{\n    #[ORM\\Id]\n    #[ORM\\GeneratedValue]\n    #[ORM\\Column]\n    private ?int \$id = null;\n\n    #[ORM\\Column(length: 180, unique: true)]\n    #[Assert\\NotBlank]\n    #[Assert\\Email]\n    private ?string \$email = null;\n\n    #[ORM\\Column]\n    private array \$roles = [];\n\n    #[ORM\\Column]\n    private ?string \$password = null;\n\n    #[ORM\\Column(length: 100, nullable: true)]\n    private ?string \$firstName = null;\n\n    #[ORM\\Column(length: 100, nullable: true)]\n    private ?string \$lastName = null;\n\n    #[ORM\\Column]\n    private ?\\DateTimeImmutable \$createdAt = null;\n\n    public function __construct()\n    {\n        \$this->createdAt = new \\DateTimeImmutable();\n    }\n\n    public function getId(): ?int { return \$this->id; }\n    public function getEmail(): ?string { return \$this->email; }\n    public function setEmail(string \$email): static { \$this->email = \$email; return \$this; }\n    public function getUserIdentifier(): string { return (string) \$this->email; }\n    public function getRoles(): array\n    {\n        \$roles = \$this->roles;\n        \$roles[] = 'ROLE_USER';\n        return array_unique(\$roles);\n    }\n    public function setRoles(array \$roles): static { \$this->roles = \$roles; return \$this; }\n    public function getPassword(): ?string { return \$this->password; }\n    public function setPassword(string \$password): static { \$this->password = \$password; return \$this; }\n    public function eraseCredentials(): void {}\n    public function getFirstName(): ?string { return \$this->firstName; }\n    public function setFirstName(?string \$firstName): static { \$this->firstName = \$firstName; return \$this; }\n    public function getLastName(): ?string { return \$this->lastName; }\n    public function setLastName(?string \$lastName): static { \$this->lastName = \$lastName; return \$this; }\n    public function getFullName(): string { return trim(\$this->firstName . ' ' . \$this->lastName) ?: \$this->email; }\n}\n"
                    ],
                    [
                        'path' => 'config/packages/security.yaml',
                        'description' => 'Configuration complete du firewall et access control',
                        'language' => 'yaml',
                        'code' => "security:\n    # Algorithme de hashage des mots de passe\n    password_hashers:\n        Symfony\\Component\\Security\\Core\\User\\PasswordAuthenticatedUserInterface: 'auto'\n\n    # Provider : ou trouver les utilisateurs\n    providers:\n        app_user_provider:\n            entity:\n                class: App\\Entity\\User\n                property: email\n\n    firewalls:\n        dev:\n            pattern: ^/(_(profiler|wdt)|css|images|js)/\n            security: false\n        main:\n            lazy: true\n            provider: app_user_provider\n            form_login:\n                login_path: app_login\n                check_path: app_login\n                default_target_path: app_home\n                enable_csrf: true\n            logout:\n                path: app_logout\n                target: app_home\n            remember_me:\n                secret: '%kernel.secret%'\n                lifetime: 604800  # 1 semaine\n                path: /\n\n    # Controle d'acces par route\n    access_control:\n        - { path: ^/admin, roles: ROLE_ADMIN }\n        - { path: ^/checkout, roles: ROLE_USER }\n        - { path: ^/profile, roles: ROLE_USER }\n        # Tout le reste est public"
                    ],
                    [
                        'path' => 'src/Controller/SecurityController.php',
                        'description' => 'Controleur de connexion/deconnexion',
                        'code' => "<?php\nnamespace App\\Controller;\n\nuse Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController;\nuse Symfony\\Component\\HttpFoundation\\Response;\nuse Symfony\\Component\\Routing\\Attribute\\Route;\nuse Symfony\\Component\\Security\\Http\\Authentication\\AuthenticationUtils;\n\nclass SecurityController extends AbstractController\n{\n    #[Route('/login', name: 'app_login')]\n    public function login(AuthenticationUtils \$authenticationUtils): Response\n    {\n        // Rediriger si deja connecte\n        if (\$this->getUser()) {\n            return \$this->redirectToRoute('app_home');\n        }\n\n        // Recuperer l'erreur de connexion s'il y en a une\n        \$error = \$authenticationUtils->getLastAuthenticationError();\n        // Dernier nom d'utilisateur saisi\n        \$lastUsername = \$authenticationUtils->getLastUsername();\n\n        return \$this->render('security/login.html.twig', [\n            'last_username' => \$lastUsername,\n            'error' => \$error,\n        ]);\n    }\n\n    #[Route('/logout', name: 'app_logout')]\n    public function logout(): void\n    {\n        // Cette methode peut rester vide\n        // Elle sera interceptee par le firewall\n        throw new \\LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');\n    }\n}\n"
                    ],
                    [
                        'path' => 'src/Controller/RegistrationController.php',
                        'description' => 'Controleur d\'inscription',
                        'code' => "<?php\nnamespace App\\Controller;\n\nuse App\\Entity\\User;\nuse App\\Form\\RegistrationFormType;\nuse Doctrine\\ORM\\EntityManagerInterface;\nuse Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController;\nuse Symfony\\Bundle\\SecurityBundle\\Security;\nuse Symfony\\Component\\HttpFoundation\\Request;\nuse Symfony\\Component\\HttpFoundation\\Response;\nuse Symfony\\Component\\PasswordHasher\\Hasher\\UserPasswordHasherInterface;\nuse Symfony\\Component\\Routing\\Attribute\\Route;\n\nclass RegistrationController extends AbstractController\n{\n    #[Route('/register', name: 'app_register')]\n    public function register(\n        Request \$request,\n        UserPasswordHasherInterface \$userPasswordHasher,\n        Security \$security,\n        EntityManagerInterface \$entityManager\n    ): Response {\n        if (\$this->getUser()) {\n            return \$this->redirectToRoute('app_home');\n        }\n\n        \$user = new User();\n        \$form = \$this->createForm(RegistrationFormType::class, \$user);\n        \$form->handleRequest(\$request);\n\n        if (\$form->isSubmitted() && \$form->isValid()) {\n            // Hasher le mot de passe\n            \$user->setPassword(\n                \$userPasswordHasher->hashPassword(\n                    \$user,\n                    \$form->get('plainPassword')->getData()\n                )\n            );\n\n            \$entityManager->persist(\$user);\n            \$entityManager->flush();\n\n            // Connexion automatique apres inscription\n            return \$security->login(\$user, 'form_login', 'main');\n        }\n\n        return \$this->render('registration/register.html.twig', [\n            'registrationForm' => \$form,\n        ]);\n    }\n}\n"
                    ],
                    [
                        'path' => 'src/Form/RegistrationFormType.php',
                        'description' => 'Formulaire d\'inscription avec validation',
                        'code' => "<?php\nnamespace App\\Form;\n\nuse App\\Entity\\User;\nuse Symfony\\Component\\Form\\AbstractType;\nuse Symfony\\Component\\Form\\Extension\\Core\\Type\\CheckboxType;\nuse Symfony\\Component\\Form\\Extension\\Core\\Type\\EmailType;\nuse Symfony\\Component\\Form\\Extension\\Core\\Type\\PasswordType;\nuse Symfony\\Component\\Form\\Extension\\Core\\Type\\RepeatedType;\nuse Symfony\\Component\\Form\\Extension\\Core\\Type\\TextType;\nuse Symfony\\Component\\Form\\FormBuilderInterface;\nuse Symfony\\Component\\OptionsResolver\\OptionsResolver;\nuse Symfony\\Component\\Validator\\Constraints\\IsTrue;\nuse Symfony\\Component\\Validator\\Constraints\\Length;\nuse Symfony\\Component\\Validator\\Constraints\\NotBlank;\n\nclass RegistrationFormType extends AbstractType\n{\n    public function buildForm(FormBuilderInterface \$builder, array \$options): void\n    {\n        \$builder\n            ->add('email', EmailType::class, [\n                'label' => 'Adresse email',\n                'attr' => ['placeholder' => 'votre@email.com']\n            ])\n            ->add('firstName', TextType::class, [\n                'label' => 'Prenom',\n                'required' => false\n            ])\n            ->add('lastName', TextType::class, [\n                'label' => 'Nom',\n                'required' => false\n            ])\n            ->add('plainPassword', RepeatedType::class, [\n                'type' => PasswordType::class,\n                'mapped' => false,\n                'first_options' => [\n                    'label' => 'Mot de passe',\n                    'attr' => ['autocomplete' => 'new-password']\n                ],\n                'second_options' => [\n                    'label' => 'Confirmer le mot de passe'\n                ],\n                'invalid_message' => 'Les mots de passe ne correspondent pas.',\n                'constraints' => [\n                    new NotBlank(['message' => 'Veuillez saisir un mot de passe']),\n                    new Length([\n                        'min' => 8,\n                        'minMessage' => 'Le mot de passe doit contenir au moins {{ limit }} caracteres',\n                        'max' => 4096,\n                    ]),\n                ],\n            ])\n            ->add('agreeTerms', CheckboxType::class, [\n                'label' => 'J\\'accepte les conditions d\\'utilisation',\n                'mapped' => false,\n                'constraints' => [\n                    new IsTrue(['message' => 'Vous devez accepter les conditions.']),\n                ],\n            ]);\n    }\n\n    public function configureOptions(OptionsResolver \$resolver): void\n    {\n        \$resolver->setDefaults(['data_class' => User::class]);\n    }\n}\n"
                    ],
                    [
                        'path' => 'templates/security/login.html.twig',
                        'description' => 'Page de connexion',
                        'language' => 'twig',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}Connexion{% endblock %}\n\n{% block body %}\n<div class='container auth-page'>\n    <div class='auth-card'>\n        <h1>Connexion</h1>\n\n        {% if error %}\n            <div class='alert alert-danger'>\n                {{ error.messageKey|trans(error.messageData, 'security') }}\n            </div>\n        {% endif %}\n\n        <form method='post' class='auth-form'>\n            <div class='form-group'>\n                <label for='username'>Email</label>\n                <input type='email' id='username' name='_username' \n                       value='{{ last_username }}' required autofocus\n                       class='form-control' placeholder='votre@email.com'>\n            </div>\n\n            <div class='form-group'>\n                <label for='password'>Mot de passe</label>\n                <input type='password' id='password' name='_password' \n                       required class='form-control'>\n            </div>\n\n            <div class='form-group form-check'>\n                <input type='checkbox' id='_remember_me' name='_remember_me' class='form-check-input'>\n                <label for='_remember_me' class='form-check-label'>Se souvenir de moi</label>\n            </div>\n\n            <input type='hidden' name='_csrf_token' value='{{ csrf_token('authenticate') }}'>\n\n            <button type='submit' class='btn btn-primary btn-block'>Se connecter</button>\n        </form>\n\n        <div class='auth-links'>\n            <p>Pas encore de compte ? <a href='{{ path('app_register') }}'>Creer un compte</a></p>\n        </div>\n    </div>\n</div>\n{% endblock %}\n"
                    ],
                    [
                        'path' => 'templates/registration/register.html.twig',
                        'description' => 'Page d\'inscription',
                        'language' => 'twig',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}Inscription{% endblock %}\n\n{% block body %}\n<div class='container auth-page'>\n    <div class='auth-card'>\n        <h1>Creer un compte</h1>\n\n        {{ form_start(registrationForm, {'attr': {'class': 'auth-form'}}) }}\n            {{ form_row(registrationForm.email) }}\n            \n            <div class='form-row'>\n                {{ form_row(registrationForm.firstName) }}\n                {{ form_row(registrationForm.lastName) }}\n            </div>\n            \n            {{ form_row(registrationForm.plainPassword.first) }}\n            {{ form_row(registrationForm.plainPassword.second) }}\n            \n            {{ form_row(registrationForm.agreeTerms) }}\n\n            <button type='submit' class='btn btn-primary btn-block'>S'inscrire</button>\n        {{ form_end(registrationForm) }}\n\n        <div class='auth-links'>\n            <p>Deja un compte ? <a href='{{ path('app_login') }}'>Se connecter</a></p>\n        </div>\n    </div>\n</div>\n{% endblock %}\n"
                    ],
                    [
                        'path' => 'src/Repository/OrderRepository.php',
                        'description' => 'Repository Order basique (enrichi a l\'etape 6)',
                        'code' => "<?php\nnamespace App\\Repository;\n\nuse App\\Entity\\Order;\nuse App\\Entity\\User;\nuse Doctrine\\Bundle\\DoctrineBundle\\Repository\\ServiceEntityRepository;\nuse Doctrine\\Persistence\\ManagerRegistry;\n\n/**\n * @extends ServiceEntityRepository<Order>\n * Version basique - sera enrichi a l'etape 6\n */\nclass OrderRepository extends ServiceEntityRepository\n{\n    public function __construct(ManagerRegistry \\\$registry)\n    {\n        parent::__construct(\\\$registry, Order::class);\n    }\n\n    /**\n     * Recupere les commandes d'un utilisateur (hors panier).\n     * @return Order[]\n     */\n    public function findByUser(User \\\$user): array\n    {\n        return \\\$this->createQueryBuilder('o')\n            ->where('o.user = :user')\n            ->andWhere('o.status != :cart')\n            ->setParameter('user', \\\$user)\n            ->setParameter('cart', 'cart')\n            ->orderBy('o.createdAt', 'DESC')\n            ->getQuery()\n            ->getResult();\n    }\n}\n"
                    ],
                    [
                        'path' => 'src/Controller/ProfileController.php',
                        'description' => 'Controleur du profil utilisateur',
                        'code' => "<?php\nnamespace App\\Controller;\n\nuse App\\Repository\\OrderRepository;\nuse Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController;\nuse Symfony\\Component\\HttpFoundation\\Response;\nuse Symfony\\Component\\Routing\\Attribute\\Route;\nuse Symfony\\Component\\Security\\Http\\Attribute\\IsGranted;\n\n#[Route('/profile')]\n#[IsGranted('ROLE_USER')]\nclass ProfileController extends AbstractController\n{\n    #[Route('', name: 'app_profile')]\n    public function index(OrderRepository \\\$orderRepo): Response\n    {\n        \\\$user = \\\$this->getUser();\n        \\\$orders = \\\$orderRepo->findByUser(\\\$user);\n\n        return \\\$this->render('profile/index.html.twig', [\n            'user' => \\\$user,\n            'orders' => \\\$orders,\n        ]);\n    }\n}\n"
                    ],
                    [
                        'path' => 'templates/profile/index.html.twig',
                        'description' => 'Page profil avec historique commandes',
                        'language' => 'twig',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}Mon profil{% endblock %}\n\n{% block body %}\n<div class='container profile-page'>\n    <h1>Mon profil</h1>\n\n    <section class='profile-info'>\n        <h2>👤 Informations personnelles</h2>\n        <dl class='info-grid'>\n            <dt>Email</dt>\n            <dd>{{ user.email }}</dd>\n            \n            <dt>Nom</dt>\n            <dd>{{ user.fullName }}</dd>\n            \n            <dt>Membre depuis</dt>\n            <dd>{{ user.createdAt|date('d/m/Y') }}</dd>\n        </dl>\n    </section>\n\n    <section class='profile-orders'>\n        <h2>📦 Mes commandes</h2>\n        \n        {% if orders is empty %}\n            <p class='no-orders'>Vous n'avez pas encore passe de commande.</p>\n            <a href='{{ path('app_products') }}' class='btn btn-primary'>Voir les produits</a>\n        {% else %}\n            <table class='orders-table'>\n                <thead>\n                    <tr>\n                        <th>#</th>\n                        <th>Date</th>\n                        <th>Articles</th>\n                        <th>Total</th>\n                        <th>Statut</th>\n                    </tr>\n                </thead>\n                <tbody>\n                {% for order in orders %}\n                    <tr>\n                        <td>{{ order.id }}</td>\n                        <td>{{ order.createdAt|date('d/m/Y H:i') }}</td>\n                        <td>{{ order.items|length }} article(s)</td>\n                        <td>{{ order.total|number_format(2, ',', ' ') }} EUR</td>\n                        <td>\n                            <span class='badge badge--{{ order.status }}'>\n                                {% if order.status == 'pending' %}En attente\n                                {% elseif order.status == 'paid' %}Payee\n                                {% elseif order.status == 'shipped' %}Expediee\n                                {% elseif order.status == 'delivered' %}Livree\n                                {% else %}{{ order.status }}\n                                {% endif %}\n                            </span>\n                        </td>\n                    </tr>\n                {% endfor %}\n                </tbody>\n            </table>\n        {% endif %}\n    </section>\n\n    <nav class='profile-actions'>\n        <a href='{{ path('app_logout') }}' class='btn btn--secondary'>Se deconnecter</a>\n    </nav>\n</div>\n{% endblock %}\n"
                    ],
                ],
                'checklist' => [
                    'L\'entite User est creee avec email unique',
                    'Le formulaire de connexion fonctionne',
                    'Le formulaire d\'inscription fonctionne avec hashage',
                    'La connexion automatique apres inscription fonctionne',
                    'Le remember_me garde la session active',
                    'La deconnexion redirige vers l\'accueil',
                    'Les routes /checkout et /profile sont protegees (ROLE_USER)',
                    'Les routes /admin sont protegees (ROLE_ADMIN)',
                    'Les erreurs de connexion s\'affichent correctement'
                ],
                'pieges_communs' => [
                    'Oublier d\'implementer UserInterface ET PasswordAuthenticatedUserInterface',
                    'Ne pas configurer le provider dans security.yaml',
                    'Oublier enable_csrf dans form_login (securite !)',
                    'logout path sans la route correspondante = erreur',
                    'Table "user" reservee SQL → utiliser #[ORM\\Table(name: "`user`")]',
                    'Oublier eraseCredentials() dans User (interface oblige)'
                ],
                'ressources' => [
                    ['label' => 'Security Symfony', 'url' => 'https://symfony.com/doc/current/security.html', 'icon' => '🔐'],
                    ['label' => 'Form Login', 'url' => 'https://symfony.com/doc/current/security/form_login_setup.html', 'icon' => '📝'],
                    ['label' => 'Registration', 'url' => 'https://symfony.com/doc/current/security/registration_form.html', 'icon' => '👤'],
                    ['label' => 'Access Control', 'url' => 'https://symfony.com/doc/current/security/access_control.html', 'icon' => '🚧']
                ]
            ],

            // Etape 6 - Processus de Commande (workflow complet)
            6 => [
                'description_detaillee' => "Implementez le processus de commande complet : formulaire d'adresse de livraison, recapitulatif, validation des donnees avec contraintes Symfony, et confirmation. Le workflow suit les etapes : Panier → Adresse → Recapitulatif → Confirmation.",
                'commandes' => [
                    [
                        'titre' => 'Creer l\'entite Order (si pas deja fait)',
                        'code' => 'php bin/console make:entity Order',
                        'explication' => 'Entite principale de commande. Ajoutez : status, total, createdAt, user (ManyToOne), address fields.'
                    ],
                    [
                        'titre' => 'Creer l\'entite OrderItem',
                        'code' => 'php bin/console make:entity OrderItem',
                        'explication' => 'Ligne de commande : product (ManyToOne), quantity, unitPrice, order (ManyToOne).'
                    ],
                    [
                        'titre' => 'Creer le formulaire CheckoutAddressType',
                        'code' => 'php bin/console make:form CheckoutAddressType',
                        'explication' => 'Formulaire pour saisir l\'adresse de livraison avec validation.'
                    ],
                    [
                        'titre' => 'Creer le controleur Checkout',
                        'code' => 'php bin/console make:controller CheckoutController',
                        'explication' => 'Controleur multi-etapes pour le processus de commande.'
                    ],
                    [
                        'titre' => 'Migrations',
                        'code' => "php bin/console make:migration\nphp bin/console doctrine:migrations:migrate",
                        'explication' => 'Applique les tables Order et OrderItem.'
                    ],
                ],
                'fichiers_a_creer' => [
                    [
                        'path' => 'src/Repository/OrderRepository.php',
                        'description' => 'Repository Order ENRICHI (remplace la version etape 5)',
                        'code' => "<?php\nnamespace App\\Repository;\n\nuse App\\Entity\\Order;\nuse App\\Entity\\User;\nuse Doctrine\\Bundle\\DoctrineBundle\\Repository\\ServiceEntityRepository;\nuse Doctrine\\Persistence\\ManagerRegistry;\n\n/**\n * @extends ServiceEntityRepository<Order>\n */\nclass OrderRepository extends ServiceEntityRepository\n{\n    public function __construct(ManagerRegistry \\\$registry)\n    {\n        parent::__construct(\\\$registry, Order::class);\n    }\n\n    /**\n     * Recupere les commandes d'un utilisateur.\n     * @return Order[]\n     */\n    public function findByUser(User \\\$user): array\n    {\n        return \\\$this->createQueryBuilder('o')\n            ->where('o.user = :user')\n            ->andWhere('o.status != :cart')\n            ->setParameter('user', \\\$user)\n            ->setParameter('cart', Order::STATUS_CART)\n            ->orderBy('o.createdAt', 'DESC')\n            ->getQuery()\n            ->getResult();\n    }\n\n    /**\n     * Compte les commandes par statut.\n     */\n    public function countByStatus(string \\\$status): int\n    {\n        return (int) \\\$this->createQueryBuilder('o')\n            ->select('COUNT(o.id)')\n            ->where('o.status = :status')\n            ->setParameter('status', \\\$status)\n            ->getQuery()\n            ->getSingleScalarResult();\n    }\n\n    /**\n     * Calcule le chiffre d'affaires total.\n     */\n    public function getTotalRevenue(): float\n    {\n        \\\$result = \\\$this->createQueryBuilder('o')\n            ->select('SUM(o.total)')\n            ->where('o.status IN (:statuses)')\n            ->setParameter('statuses', [Order::STATUS_PAID, Order::STATUS_SHIPPED, Order::STATUS_DELIVERED])\n            ->getQuery()\n            ->getSingleScalarResult();\n        return (float) (\\\$result ?? 0);\n    }\n\n    /**\n     * Recupere les commandes recentes.\n     * @return Order[]\n     */\n    public function findRecent(int \\\$limit = 10): array\n    {\n        return \\\$this->createQueryBuilder('o')\n            ->where('o.status != :cart')\n            ->setParameter('cart', Order::STATUS_CART)\n            ->orderBy('o.createdAt', 'DESC')\n            ->setMaxResults(\\\$limit)\n            ->getQuery()\n            ->getResult();\n    }\n\n    /**\n     * Statistiques par periode (mois en cours).\n     */\n    public function getMonthlyStats(): array\n    {\n        \\\$start = new \\\\DateTimeImmutable('first day of this month midnight');\n        \\\$end = new \\\\DateTimeImmutable('last day of this month 23:59:59');\n\n        \\\$orders = \\\$this->createQueryBuilder('o')\n            ->where('o.createdAt BETWEEN :start AND :end')\n            ->andWhere('o.status != :cart')\n            ->setParameter('start', \\\$start)\n            ->setParameter('end', \\\$end)\n            ->setParameter('cart', Order::STATUS_CART)\n            ->getQuery()\n            ->getResult();\n\n        \\\$total = array_sum(array_map(fn(\\\$o) => (float) \\\$o->getTotal(), \\\$orders));\n\n        return [\n            'count' => count(\\\$orders),\n            'revenue' => \\\$total,\n            'average' => count(\\\$orders) > 0 ? \\\$total / count(\\\$orders) : 0,\n        ];\n    }\n}\n"
                    ],
                    [
                        'path' => 'src/Entity/Order.php',
                        'description' => 'Entite Order avec statuts et relations',
                        'code' => "<?php\nnamespace App\\Entity;\n\nuse App\\Repository\\OrderRepository;\nuse Doctrine\\Common\\Collections\\ArrayCollection;\nuse Doctrine\\Common\\Collections\\Collection;\nuse Doctrine\\ORM\\Mapping as ORM;\nuse Symfony\\Component\\Validator\\Constraints as Assert;\n\n#[ORM\\Entity(repositoryClass: OrderRepository::class)]\n#[ORM\\Table(name: '`order`')]\nclass Order\n{\n    public const STATUS_CART = 'cart';\n    public const STATUS_PENDING = 'pending';\n    public const STATUS_PAID = 'paid';\n    public const STATUS_SHIPPED = 'shipped';\n    public const STATUS_DELIVERED = 'delivered';\n\n    #[ORM\\Id]\n    #[ORM\\GeneratedValue]\n    #[ORM\\Column]\n    private ?int \\\$id = null;\n\n    #[ORM\\Column(length: 32)]\n    private string \\\$status = self::STATUS_CART;\n\n    #[ORM\\Column(type: 'decimal', precision: 10, scale: 2)]\n    private string \\\$total = '0.00';\n\n    #[ORM\\Column]\n    private ?\\DateTimeImmutable \\\$createdAt = null;\n\n    #[ORM\\ManyToOne(targetEntity: User::class)]\n    private ?User \\\$user = null;\n\n    // Champs adresse de livraison\n    #[ORM\\Column(length: 255)]\n    #[Assert\\NotBlank(message: 'Veuillez saisir votre nom')]\n    private ?string \\\$shippingName = null;\n\n    #[ORM\\Column(length: 255)]\n    #[Assert\\NotBlank(message: 'Adresse requise')]\n    private ?string \\\$shippingAddress = null;\n\n    #[ORM\\Column(length: 10)]\n    #[Assert\\NotBlank]\n    #[Assert\\Regex(pattern: '/^[0-9]{5}\\\$/', message: 'Code postal invalide')]\n    private ?string \\\$shippingPostalCode = null;\n\n    #[ORM\\Column(length: 100)]\n    #[Assert\\NotBlank]\n    private ?string \\\$shippingCity = null;\n\n    #[ORM\\OneToMany(targetEntity: OrderItem::class, mappedBy: 'order', cascade: ['persist', 'remove'], orphanRemoval: true)]\n    private Collection \\\$items;\n\n    public function __construct()\n    {\n        \\\$this->items = new ArrayCollection();\n        \\\$this->createdAt = new \\DateTimeImmutable();\n    }\n\n    // Getters/Setters...\n    public function getId(): ?int { return \\\$this->id; }\n    public function getStatus(): string { return \\\$this->status; }\n    public function setStatus(string \\\$status): static { \\\$this->status = \\\$status; return \\\$this; }\n    public function getTotal(): string { return \\\$this->total; }\n    public function setTotal(string \\\$total): static { \\\$this->total = \\\$total; return \\\$this; }\n    public function getItems(): Collection { return \\\$this->items; }\n    public function addItem(OrderItem \\\$item): static { \\\$this->items->add(\\\$item); \\\$item->setOrder(\\\$this); return \\\$this; }\n    public function getShippingName(): ?string { return \\\$this->shippingName; }\n    public function setShippingName(?string \\\$v): static { \\\$this->shippingName = \\\$v; return \\\$this; }\n    public function getShippingAddress(): ?string { return \\\$this->shippingAddress; }\n    public function setShippingAddress(?string \\\$v): static { \\\$this->shippingAddress = \\\$v; return \\\$this; }\n    public function getShippingPostalCode(): ?string { return \\\$this->shippingPostalCode; }\n    public function setShippingPostalCode(?string \\\$v): static { \\\$this->shippingPostalCode = \\\$v; return \\\$this; }\n    public function getShippingCity(): ?string { return \\\$this->shippingCity; }\n    public function setShippingCity(?string \\\$v): static { \\\$this->shippingCity = \\\$v; return \\\$this; }\n    public function getUser(): ?User { return \\\$this->user; }\n    public function setUser(?User \\\$user): static { \\\$this->user = \\\$user; return \\\$this; }\n    public function getCreatedAt(): ?\\DateTimeImmutable { return \\\$this->createdAt; }\n}\n"
                    ],
                    [
                        'path' => 'src/Entity/OrderItem.php',
                        'description' => 'Entite ligne de commande',
                        'code' => "<?php\nnamespace App\\Entity;\n\nuse Doctrine\\ORM\\Mapping as ORM;\n\n#[ORM\\Entity]\nclass OrderItem\n{\n    #[ORM\\Id]\n    #[ORM\\GeneratedValue]\n    #[ORM\\Column]\n    private ?int \\\$id = null;\n\n    #[ORM\\ManyToOne(targetEntity: Order::class, inversedBy: 'items')]\n    #[ORM\\JoinColumn(nullable: false)]\n    private ?Order \\\$order = null;\n\n    #[ORM\\ManyToOne(targetEntity: Product::class)]\n    #[ORM\\JoinColumn(nullable: false)]\n    private ?Product \\\$product = null;\n\n    #[ORM\\Column]\n    private int \\\$quantity = 1;\n\n    #[ORM\\Column(type: 'decimal', precision: 10, scale: 2)]\n    private string \\\$unitPrice = '0.00';\n\n    public function getId(): ?int { return \\\$this->id; }\n    public function getOrder(): ?Order { return \\\$this->order; }\n    public function setOrder(?Order \\\$order): static { \\\$this->order = \\\$order; return \\\$this; }\n    public function getProduct(): ?Product { return \\\$this->product; }\n    public function setProduct(?Product \\\$product): static { \\\$this->product = \\\$product; return \\\$this; }\n    public function getQuantity(): int { return \\\$this->quantity; }\n    public function setQuantity(int \\\$q): static { \\\$this->quantity = \\\$q; return \\\$this; }\n    public function getUnitPrice(): string { return \\\$this->unitPrice; }\n    public function setUnitPrice(string \\\$p): static { \\\$this->unitPrice = \\\$p; return \\\$this; }\n    public function getLineTotal(): float { return (float) \\\$this->unitPrice * \\\$this->quantity; }\n}\n"
                    ],
                    [
                        'path' => 'src/Form/CheckoutAddressType.php',
                        'description' => 'Formulaire adresse avec validation',
                        'code' => "<?php\nnamespace App\\Form;\n\nuse App\\Entity\\Order;\nuse Symfony\\Component\\Form\\AbstractType;\nuse Symfony\\Component\\Form\\Extension\\Core\\Type\\TextType;\nuse Symfony\\Component\\Form\\FormBuilderInterface;\nuse Symfony\\Component\\OptionsResolver\\OptionsResolver;\n\nclass CheckoutAddressType extends AbstractType\n{\n    public function buildForm(FormBuilderInterface \\\$builder, array \\\$options): void\n    {\n        \\\$builder\n            ->add('shippingName', TextType::class, [\n                'label' => 'Nom complet',\n                'attr' => ['placeholder' => 'Jean Dupont']\n            ])\n            ->add('shippingAddress', TextType::class, [\n                'label' => 'Adresse',\n                'attr' => ['placeholder' => '123 rue de Paris']\n            ])\n            ->add('shippingPostalCode', TextType::class, [\n                'label' => 'Code postal',\n                'attr' => ['placeholder' => '75001']\n            ])\n            ->add('shippingCity', TextType::class, [\n                'label' => 'Ville',\n                'attr' => ['placeholder' => 'Paris']\n            ]);\n    }\n\n    public function configureOptions(OptionsResolver \\\$resolver): void\n    {\n        \\\$resolver->setDefaults([\n            'data_class' => Order::class,\n        ]);\n    }\n}\n"
                    ],
                    [
                        'path' => 'src/Controller/CheckoutController.php',
                        'description' => 'Controleur checkout multi-etapes',
                        'code' => "<?php\nnamespace App\\Controller;\n\nuse App\\Entity\\Order;\nuse App\\Entity\\OrderItem;\nuse App\\Form\\CheckoutAddressType;\nuse App\\Service\\CartManager;\nuse Doctrine\\ORM\\EntityManagerInterface;\nuse Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController;\nuse Symfony\\Component\\HttpFoundation\\Request;\nuse Symfony\\Component\\HttpFoundation\\Response;\nuse Symfony\\Component\\Routing\\Attribute\\Route;\n\n#[Route('/checkout')]\nclass CheckoutController extends AbstractController\n{\n    public function __construct(\n        private CartManager \\\$cartManager,\n        private EntityManagerInterface \\\$em\n    ) {}\n\n    // Etape 1: Formulaire adresse\n    #[Route('', name: 'checkout_address')]\n    public function address(Request \\\$request): Response\n    {\n        \\\$lines = \\\$this->cartManager->getCartLines();\n        if (empty(\\\$lines)) {\n            \\\$this->addFlash('warning', 'Votre panier est vide.');\n            return \\\$this->redirectToRoute('cart_index');\n        }\n\n        \\\$order = new Order();\n        \\\$form = \\\$this->createForm(CheckoutAddressType::class, \\\$order);\n        \\\$form->handleRequest(\\\$request);\n\n        if (\\\$form->isSubmitted() && \\\$form->isValid()) {\n            // Stocker l'ordre en session pour l'etape suivante\n            \\\$request->getSession()->set('checkout_order', \\\$order);\n            return \\\$this->redirectToRoute('checkout_summary');\n        }\n\n        return \\\$this->render('checkout/address.html.twig', [\n            'form' => \\\$form,\n            'lines' => \\\$lines,\n            'total' => \\\$this->cartManager->getTotal(),\n        ]);\n    }\n\n    // Etape 2: Recapitulatif avant confirmation\n    #[Route('summary', name: 'checkout_summary')]\n    public function summary(Request \\\$request): Response\n    {\n        \\\$order = \\\$request->getSession()->get('checkout_order');\n        if (!\\\$order instanceof Order) {\n            return \\\$this->redirectToRoute('checkout_address');\n        }\n\n        return \\\$this->render('checkout/summary.html.twig', [\n            'order' => \\\$order,\n            'lines' => \\\$this->cartManager->getCartLines(),\n            'total' => \\\$this->cartManager->getTotal(),\n        ]);\n    }\n\n    // Etape 3: Confirmation et enregistrement\n    #[Route('confirm', name: 'checkout_confirm', methods: ['POST'])]\n    public function confirm(Request \\\$request): Response\n    {\n        \\\$order = \\\$request->getSession()->get('checkout_order');\n        if (!\\\$order instanceof Order) {\n            return \\\$this->redirectToRoute('checkout_address');\n        }\n\n        // Remplir les lignes de commande et decrementer le stock\n        foreach (\\\$this->cartManager->getCartLines() as \\\$line) {\n            \\\$product = \\\$line['product'];\n            \\\$qty = \\\$line['quantity'];\n\n            // Verifier et decrementer le stock\n            if (\\\$product->getStock() < \\\$qty) {\n                \\\$this->addFlash('warning', 'Stock insuffisant pour ' . \\\$product->getName());\n                return \\\$this->redirectToRoute('cart_index');\n            }\n            \\\$product->setStock(\\\$product->getStock() - \\\$qty);\n\n            \\\$item = new OrderItem();\n            \\\$item->setProduct(\\\$product);\n            \\\$item->setQuantity(\\\$qty);\n            \\\$item->setUnitPrice((string) \\\$product->getPrice());\n            \\\$order->addItem(\\\$item);\n        }\n\n        \\\$order->setTotal((string) \\\$this->cartManager->getTotal());\n        \\\$order->setStatus(Order::STATUS_PENDING);\n        \\\$order->setUser(\\\$this->getUser());\n\n        \\\$this->em->persist(\\\$order);\n        \\\$this->em->flush();\n\n        // Vider le panier et la session checkout\n        \\\$this->cartManager->clear();\n        \\\$request->getSession()->remove('checkout_order');\n\n        \\\$this->addFlash('success', 'Commande #' . \\\$order->getId() . ' confirmee !');\n        return \\\$this->redirectToRoute('checkout_success', ['id' => \\\$order->getId()]);\n    }\n\n    #[Route('success/{id}', name: 'checkout_success')]\n    public function success(Order \\\$order): Response\n    {\n        return \\\$this->render('checkout/success.html.twig', ['order' => \\\$order]);\n    }\n}\n"
                    ],
                    [
                        'path' => 'templates/checkout/address.html.twig',
                        'description' => 'Vue formulaire adresse',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}Adresse de livraison{% endblock %}\n\n{% block body %}\n<div class='container checkout-page'>\n    <h1>Etape 1 : Adresse de livraison</h1>\n\n    <div class='checkout-grid'>\n        <div class='checkout-form'>\n            {{ form_start(form) }}\n                {{ form_row(form.shippingName) }}\n                {{ form_row(form.shippingAddress) }}\n                {{ form_row(form.shippingPostalCode) }}\n                {{ form_row(form.shippingCity) }}\n                <button type='submit' class='btn btn-primary'>Continuer</button>\n            {{ form_end(form) }}\n        </div>\n\n        <aside class='checkout-summary'>\n            <h3>Votre panier</h3>\n            <ul>\n            {% for line in lines %}\n                <li>{{ line.product.name }} x{{ line.quantity }} - {{ line.line_total }} EUR</li>\n            {% endfor %}\n            </ul>\n            <p class='total'><strong>Total: {{ total }} EUR</strong></p>\n        </aside>\n    </div>\n</div>\n{% endblock %}\n"
                    ],
                    [
                        'path' => 'templates/checkout/summary.html.twig',
                        'description' => 'Vue recapitulatif avec prix formates',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}Recapitulatif de commande{% endblock %}\n\n{% block body %}\n<div class='container checkout-page'>\n    <h1>Etape 2 : Recapitulatif</h1>\n\n    <div class='checkout-grid'>\n        <section class='order-address'>\n            <h3>🚚 Adresse de livraison</h3>\n            <address>\n                <strong>{{ order.shippingName }}</strong><br>\n                {{ order.shippingAddress }}<br>\n                {{ order.shippingPostalCode }} {{ order.shippingCity }}\n            </address>\n            <a href='{{ path('checkout_address') }}' class='btn btn--secondary btn-sm'>Modifier</a>\n        </section>\n\n        <section class='order-items'>\n            <h3>📦 Articles ({{ lines|length }})</h3>\n            <table class='cart-table'>\n                <thead>\n                    <tr><th>Produit</th><th>Prix unit.</th><th>Qte</th><th>Total</th></tr>\n                </thead>\n                <tbody>\n                {% for line in lines %}\n                    <tr>\n                        <td>{{ line.product.name }}</td>\n                        <td>{{ line.product.price|number_format(2, ',', ' ') }} EUR</td>\n                        <td>{{ line.quantity }}</td>\n                        <td>{{ line.line_total|number_format(2, ',', ' ') }} EUR</td>\n                    </tr>\n                {% endfor %}\n                </tbody>\n                <tfoot>\n                    <tr class='total-row'>\n                        <th colspan='3'>Total commande</th>\n                        <th>{{ total|number_format(2, ',', ' ') }} EUR</th>\n                    </tr>\n                </tfoot>\n            </table>\n        </section>\n    </div>\n\n    <form method='post' action='{{ path('checkout_confirm') }}' class='confirm-form'>\n        <p class='confirm-notice'>En cliquant sur Confirmer, vous acceptez nos conditions de vente.</p>\n        <button type='submit' class='btn btn-primary btn-large'>\n            ✅ Confirmer la commande\n        </button>\n    </form>\n\n    <a href='{{ path('cart_index') }}' class='btn btn--secondary'>&larr; Retour au panier</a>\n</div>\n{% endblock %}\n"
                    ],
                    [
                        'path' => 'templates/checkout/success.html.twig',
                        'description' => 'Vue confirmation de commande',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}Commande confirmee{% endblock %}\n\n{% block body %}\n<div class='container checkout-success'>\n    <h1>Merci pour votre commande !</h1>\n    <p>Votre commande <strong>#{{ order.id }}</strong> a ete enregistree.</p>\n    <p>Statut : <span class='badge'>{{ order.status }}</span></p>\n    <a href='{{ path('app_products') }}' class='btn btn-primary'>Continuer vos achats</a>\n</div>\n{% endblock %}\n"
                    ],
                ],
                'checklist' => [
                    'Entites Order et OrderItem creees avec relations',
                    'Formulaire CheckoutAddressType avec contraintes de validation',
                    'Workflow : Adresse → Recapitulatif → Confirmation',
                    'Les erreurs de validation s\'affichent sur le formulaire',
                    'La commande est persistee en base avec status PENDING',
                    'Le stock des produits est decremente a la confirmation',
                    'Le panier est vide apres confirmation',
                    'Page de succes affiche le numero de commande'
                ],
                'pieges_communs' => [
                    'Table "order" est un mot reserve SQL → utiliser #[ORM\\Table(name: "`order`")]',
                    'Ne pas oublier cascade: ["persist"] sur la relation items',
                    'Valider les contraintes cote entite ET cote formulaire',
                    'Stocker l\'ordre en session entre les etapes (pas en base tant que non confirme)',
                    'Verifier que le panier n\'est pas vide avant de demarrer le checkout'
                ],
                'ressources' => [
                    ['label' => 'Forms Symfony', 'url' => 'https://symfony.com/doc/current/forms.html', 'icon' => '📝'],
                    ['label' => 'Validation', 'url' => 'https://symfony.com/doc/current/validation.html', 'icon' => '✅'],
                    ['label' => 'Sessions', 'url' => 'https://symfony.com/doc/current/session.html', 'icon' => '🔐']
                ]
            ],

            // Etape 7 - Interface d'Administration
            7 => [
                'description_detaillee' => "Creez un back-office complet pour gerer les produits, les commandes et visualiser les statistiques de votre boutique. Le dashboard affiche les KPIs essentiels, les produits en stock faible, et les dernieres commandes.",
                'commandes' => [
                    [
                        'titre' => 'Creer le controleur Admin Dashboard',
                        'code' => 'php bin/console make:controller Admin/DashboardController',
                        'explication' => 'Controleur principal du back-office avec statistiques'
                    ],
                    [
                        'titre' => 'Creer le CRUD Produits',
                        'code' => 'php bin/console make:crud Product --route-prefix=admin/product',
                        'explication' => 'Genere automatiquement les vues et actions CRUD pour les produits'
                    ],
                    [
                        'titre' => 'Creer le controleur de gestion des commandes',
                        'code' => 'php bin/console make:controller Admin/OrderController',
                        'explication' => 'Controleur pour lister et gerer les commandes'
                    ],
                    [
                        'titre' => 'Creer le formulaire ProductType',
                        'code' => 'php bin/console make:form ProductType Product',
                        'explication' => 'Formulaire pour creer/editer les produits'
                    ],
                ],
                'fichiers_a_creer' => [
                    [
                        'path' => 'src/Repository/ProductRepository.php',
                        'description' => 'Repository avec methode countLowStock()',
                        'code' => "<?php\nnamespace App\\Repository;\n\nuse App\\Entity\\Product;\nuse Doctrine\\Bundle\\DoctrineBundle\\Repository\\ServiceEntityRepository;\nuse Doctrine\\Persistence\\ManagerRegistry;\n\n/**\n * @extends ServiceEntityRepository<Product>\n */\nclass ProductRepository extends ServiceEntityRepository\n{\n    public function __construct(ManagerRegistry \$registry)\n    {\n        parent::__construct(\$registry, Product::class);\n    }\n\n    /**\n     * Compte les produits dont le stock est inferieur ou egal au seuil.\n     */\n    public function countLowStock(int \$threshold = 5): int\n    {\n        return (int) \$this->createQueryBuilder('p')\n            ->select('COUNT(p.id)')\n            ->where('p.stock <= :threshold')\n            ->setParameter('threshold', \$threshold)\n            ->getQuery()\n            ->getSingleScalarResult();\n    }\n\n    /**\n     * Recupere les produits en stock faible.\n     * @return Product[]\n     */\n    public function findLowStock(int \$threshold = 5): array\n    {\n        return \$this->createQueryBuilder('p')\n            ->where('p.stock <= :threshold')\n            ->setParameter('threshold', \$threshold)\n            ->orderBy('p.stock', 'ASC')\n            ->getQuery()\n            ->getResult();\n    }\n\n    /**\n     * Recherche de produits par nom ou description.\n     * @return Product[]\n     */\n    public function search(string \$query): array\n    {\n        return \$this->createQueryBuilder('p')\n            ->where('p.name LIKE :query')\n            ->orWhere('p.description LIKE :query')\n            ->setParameter('query', '%' . \$query . '%')\n            ->orderBy('p.name', 'ASC')\n            ->getQuery()\n            ->getResult();\n    }\n}\n"
                    ],
                    [
                        'path' => 'src/Controller/Admin/DashboardController.php',
                        'description' => 'Dashboard admin avec statistiques',
                        'code' => "<?php\nnamespace App\\Controller\\Admin;\n\nuse App\\Repository\\OrderRepository;\nuse App\\Repository\\ProductRepository;\nuse Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController;\nuse Symfony\\Component\\HttpFoundation\\Response;\nuse Symfony\\Component\\Routing\\Attribute\\Route;\nuse Symfony\\Component\\Security\\Http\\Attribute\\IsGranted;\n\n#[Route('/admin')]\n#[IsGranted('ROLE_ADMIN')]\nclass DashboardController extends AbstractController\n{\n    #[Route('', name: 'admin_dashboard')]\n    public function index(\n        OrderRepository \$orderRepo,\n        ProductRepository \$productRepo\n    ): Response {\n        return \$this->render('admin/dashboard.html.twig', [\n            'totalOrders' => \$orderRepo->count([]),\n            'pendingOrders' => \$orderRepo->count(['status' => 'pending']),\n            'totalProducts' => \$productRepo->count([]),\n            'lowStockProducts' => \$productRepo->countLowStock(5),\n            'lowStockList' => \$productRepo->findLowStock(5),\n            'recentOrders' => \$orderRepo->findBy([], ['createdAt' => 'DESC'], 5),\n        ]);\n    }\n}\n"
                    ],
                    [
                        'path' => 'src/Controller/Admin/ProductController.php',
                        'description' => 'CRUD complet des produits',
                        'code' => "<?php\nnamespace App\\Controller\\Admin;\n\nuse App\\Entity\\Product;\nuse App\\Form\\ProductType;\nuse App\\Repository\\ProductRepository;\nuse Doctrine\\ORM\\EntityManagerInterface;\nuse Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController;\nuse Symfony\\Component\\HttpFoundation\\Request;\nuse Symfony\\Component\\HttpFoundation\\Response;\nuse Symfony\\Component\\Routing\\Attribute\\Route;\nuse Symfony\\Component\\Security\\Http\\Attribute\\IsGranted;\n\n#[Route('/admin/product')]\n#[IsGranted('ROLE_ADMIN')]\nclass ProductController extends AbstractController\n{\n    #[Route('', name: 'admin_product_index')]\n    public function index(ProductRepository \$repo, Request \$request): Response\n    {\n        \$search = \$request->query->get('q', '');\n        \$products = \$search ? \$repo->search(\$search) : \$repo->findAll();\n\n        return \$this->render('admin/product/index.html.twig', [\n            'products' => \$products,\n            'search' => \$search,\n        ]);\n    }\n\n    #[Route('/new', name: 'admin_product_new')]\n    public function new(Request \$request, EntityManagerInterface \$em): Response\n    {\n        \$product = new Product();\n        \$form = \$this->createForm(ProductType::class, \$product);\n        \$form->handleRequest(\$request);\n\n        if (\$form->isSubmitted() && \$form->isValid()) {\n            \$em->persist(\$product);\n            \$em->flush();\n            \$this->addFlash('success', 'Produit cree avec succes');\n            return \$this->redirectToRoute('admin_product_index');\n        }\n\n        return \$this->render('admin/product/new.html.twig', [\n            'form' => \$form,\n        ]);\n    }\n\n    #[Route('/{id}/edit', name: 'admin_product_edit')]\n    public function edit(Product \$product, Request \$request, EntityManagerInterface \$em): Response\n    {\n        \$form = \$this->createForm(ProductType::class, \$product);\n        \$form->handleRequest(\$request);\n\n        if (\$form->isSubmitted() && \$form->isValid()) {\n            \$em->flush();\n            \$this->addFlash('success', 'Produit modifie');\n            return \$this->redirectToRoute('admin_product_index');\n        }\n\n        return \$this->render('admin/product/edit.html.twig', [\n            'product' => \$product,\n            'form' => \$form,\n        ]);\n    }\n\n    #[Route('/{id}/delete', name: 'admin_product_delete', methods: ['POST'])]\n    public function delete(Product \$product, Request \$request, EntityManagerInterface \$em): Response\n    {\n        if (\$this->isCsrfTokenValid('delete' . \$product->getId(), \$request->request->get('_token'))) {\n            \$em->remove(\$product);\n            \$em->flush();\n            \$this->addFlash('success', 'Produit supprime');\n        }\n        return \$this->redirectToRoute('admin_product_index');\n    }\n}\n"
                    ],
                    [
                        'path' => 'src/Controller/Admin/OrderController.php',
                        'description' => 'Gestion des commandes',
                        'code' => "<?php\nnamespace App\\Controller\\Admin;\n\nuse App\\Entity\\Order;\nuse App\\Repository\\OrderRepository;\nuse Doctrine\\ORM\\EntityManagerInterface;\nuse Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController;\nuse Symfony\\Component\\HttpFoundation\\Request;\nuse Symfony\\Component\\HttpFoundation\\Response;\nuse Symfony\\Component\\Routing\\Attribute\\Route;\nuse Symfony\\Component\\Security\\Http\\Attribute\\IsGranted;\n\n#[Route('/admin/order')]\n#[IsGranted('ROLE_ADMIN')]\nclass OrderController extends AbstractController\n{\n    #[Route('', name: 'admin_order_index')]\n    public function index(OrderRepository \$repo, Request \$request): Response\n    {\n        \$status = \$request->query->get('status');\n        \$criteria = \$status ? ['status' => \$status] : [];\n\n        return \$this->render('admin/order/index.html.twig', [\n            'orders' => \$repo->findBy(\$criteria, ['createdAt' => 'DESC']),\n            'currentStatus' => \$status,\n            'statuses' => [\n                Order::STATUS_PENDING => 'En attente',\n                Order::STATUS_PAID => 'Payee',\n                Order::STATUS_SHIPPED => 'Expediee',\n                Order::STATUS_DELIVERED => 'Livree',\n            ],\n        ]);\n    }\n\n    #[Route('/{id}', name: 'admin_order_show', requirements: ['id' => '\\d+'])]\n    public function show(Order \$order): Response\n    {\n        return \$this->render('admin/order/show.html.twig', [\n            'order' => \$order,\n            'statuses' => [\n                Order::STATUS_PENDING => 'En attente',\n                Order::STATUS_PAID => 'Payee',\n                Order::STATUS_SHIPPED => 'Expediee',\n                Order::STATUS_DELIVERED => 'Livree',\n            ],\n        ]);\n    }\n\n    #[Route('/{id}/status', name: 'admin_order_status', methods: ['POST'])]\n    public function updateStatus(Order \$order, Request \$request, EntityManagerInterface \$em): Response\n    {\n        \$newStatus = \$request->request->get('status');\n        \$validStatuses = [Order::STATUS_PENDING, Order::STATUS_PAID, Order::STATUS_SHIPPED, Order::STATUS_DELIVERED];\n\n        if (in_array(\$newStatus, \$validStatuses, true)) {\n            \$order->setStatus(\$newStatus);\n            \$em->flush();\n            \$this->addFlash('success', 'Statut mis a jour : ' . \$newStatus);\n        } else {\n            \$this->addFlash('error', 'Statut invalide');\n        }\n\n        return \$this->redirectToRoute('admin_order_show', ['id' => \$order->getId()]);\n    }\n}\n"
                    ],
                    [
                        'path' => 'src/Form/ProductType.php',
                        'description' => 'Formulaire produit pour admin',
                        'code' => "<?php\nnamespace App\\Form;\n\nuse App\\Entity\\Category;\nuse App\\Entity\\Product;\nuse Symfony\\Bridge\\Doctrine\\Form\\Type\\EntityType;\nuse Symfony\\Component\\Form\\AbstractType;\nuse Symfony\\Component\\Form\\Extension\\Core\\Type\\IntegerType;\nuse Symfony\\Component\\Form\\Extension\\Core\\Type\\MoneyType;\nuse Symfony\\Component\\Form\\Extension\\Core\\Type\\TextareaType;\nuse Symfony\\Component\\Form\\Extension\\Core\\Type\\TextType;\nuse Symfony\\Component\\Form\\FormBuilderInterface;\nuse Symfony\\Component\\OptionsResolver\\OptionsResolver;\n\nclass ProductType extends AbstractType\n{\n    public function buildForm(FormBuilderInterface \$builder, array \$options): void\n    {\n        \$builder\n            ->add('name', TextType::class, [\n                'label' => 'Nom du produit',\n                'attr' => ['placeholder' => 'Ex: Smartphone Pro']\n            ])\n            ->add('description', TextareaType::class, [\n                'label' => 'Description',\n                'required' => false,\n                'attr' => ['rows' => 4]\n            ])\n            ->add('price', MoneyType::class, [\n                'label' => 'Prix',\n                'currency' => 'EUR',\n                'divisor' => 1\n            ])\n            ->add('stock', IntegerType::class, [\n                'label' => 'Stock disponible',\n                'attr' => ['min' => 0]\n            ])\n            ->add('category', EntityType::class, [\n                'class' => Category::class,\n                'choice_label' => 'name',\n                'label' => 'Categorie',\n                'placeholder' => 'Choisir une categorie',\n                'required' => false\n            ]);\n    }\n\n    public function configureOptions(OptionsResolver \$resolver): void\n    {\n        \$resolver->setDefaults(['data_class' => Product::class]);\n    }\n}\n"
                    ],
                    [
                        'path' => 'templates/admin/dashboard.html.twig',
                        'description' => 'Vue dashboard admin avec stats et alertes',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}Administration - Dashboard{% endblock %}\n\n{% block body %}\n<div class='admin-dashboard'>\n    <h1>Tableau de bord</h1>\n\n    <div class='stats-grid'>\n        <div class='stat-card'>\n            <span class='stat-icon'>📦</span>\n            <span class='stat-value'>{{ totalOrders }}</span>\n            <span class='stat-label'>Commandes totales</span>\n        </div>\n        <div class='stat-card stat-card--warning'>\n            <span class='stat-icon'>⏳</span>\n            <span class='stat-value'>{{ pendingOrders }}</span>\n            <span class='stat-label'>En attente</span>\n        </div>\n        <div class='stat-card'>\n            <span class='stat-icon'>🛍️</span>\n            <span class='stat-value'>{{ totalProducts }}</span>\n            <span class='stat-label'>Produits</span>\n        </div>\n        <div class='stat-card stat-card--danger'>\n            <span class='stat-icon'>⚠️</span>\n            <span class='stat-value'>{{ lowStockProducts }}</span>\n            <span class='stat-label'>Stock faible</span>\n        </div>\n    </div>\n\n    {% if lowStockList is not empty %}\n    <section class='alert-section'>\n        <h2>⚠️ Alertes Stock</h2>\n        <ul class='low-stock-list'>\n            {% for product in lowStockList %}\n                <li>\n                    <strong>{{ product.name }}</strong> - \n                    <span class='stock-badge stock-badge--low'>{{ product.stock }} restant(s)</span>\n                    <a href='{{ path('admin_product_edit', {id: product.id}) }}' class='btn btn-sm'>Modifier</a>\n                </li>\n            {% endfor %}\n        </ul>\n    </section>\n    {% endif %}\n\n    <section class='recent-orders'>\n        <h2>Dernieres commandes</h2>\n        <table class='admin-table'>\n            <thead>\n                <tr>\n                    <th>#</th>\n                    <th>Date</th>\n                    <th>Client</th>\n                    <th>Total</th>\n                    <th>Statut</th>\n                    <th>Actions</th>\n                </tr>\n            </thead>\n            <tbody>\n            {% for order in recentOrders %}\n                <tr>\n                    <td>{{ order.id }}</td>\n                    <td>{{ order.createdAt|date('d/m/Y H:i') }}</td>\n                    <td>{{ order.user ? order.user.email : 'Invite' }}</td>\n                    <td>{{ order.total|number_format(2, ',', ' ') }} EUR</td>\n                    <td><span class='badge badge--{{ order.status }}'>{{ order.status }}</span></td>\n                    <td><a href='{{ path('admin_order_show', {id: order.id}) }}' class='btn btn-sm'>Voir</a></td>\n                </tr>\n            {% else %}\n                <tr><td colspan='6'>Aucune commande</td></tr>\n            {% endfor %}\n            </tbody>\n        </table>\n    </section>\n\n    <nav class='admin-nav'>\n        <a href='{{ path('admin_product_index') }}' class='btn btn-primary'>Gerer les produits</a>\n        <a href='{{ path('admin_order_index') }}' class='btn btn--secondary'>Toutes les commandes</a>\n    </nav>\n</div>\n{% endblock %}\n"
                    ],
                    [
                        'path' => 'templates/admin/product/index.html.twig',
                        'description' => 'Liste des produits avec recherche',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}Admin - Produits{% endblock %}\n\n{% block body %}\n<div class='admin-products'>\n    <div class='page-header'>\n        <h1>Gestion des produits</h1>\n        <a href='{{ path('admin_product_new') }}' class='btn btn-primary'>+ Nouveau produit</a>\n    </div>\n\n    <form method='get' class='search-form'>\n        <input type='text' name='q' value='{{ search }}' placeholder='Rechercher un produit...' class='form-control'>\n        <button type='submit' class='btn'>Rechercher</button>\n        {% if search %}<a href='{{ path('admin_product_index') }}' class='btn btn--secondary'>Effacer</a>{% endif %}\n    </form>\n\n    {% for message in app.flashes('success') %}\n        <div class='alert alert-success'>{{ message }}</div>\n    {% endfor %}\n\n    <table class='admin-table'>\n        <thead>\n            <tr>\n                <th>ID</th>\n                <th>Nom</th>\n                <th>Prix</th>\n                <th>Stock</th>\n                <th>Categorie</th>\n                <th>Actions</th>\n            </tr>\n        </thead>\n        <tbody>\n        {% for product in products %}\n            <tr class='{{ product.stock <= 5 ? 'row--warning' : '' }}'>\n                <td>{{ product.id }}</td>\n                <td>{{ product.name }}</td>\n                <td>{{ product.price|number_format(2, ',', ' ') }} EUR</td>\n                <td>\n                    {% if product.stock == 0 %}\n                        <span class='badge badge--danger'>Rupture</span>\n                    {% elseif product.stock <= 5 %}\n                        <span class='badge badge--warning'>{{ product.stock }}</span>\n                    {% else %}\n                        <span class='badge badge--success'>{{ product.stock }}</span>\n                    {% endif %}\n                </td>\n                <td>{{ product.category ? product.category.name : '-' }}</td>\n                <td class='actions'>\n                    <a href='{{ path('admin_product_edit', {id: product.id}) }}' class='btn btn-sm'>Modifier</a>\n                    <form action='{{ path('admin_product_delete', {id: product.id}) }}' method='post' style='display:inline' onsubmit='return confirm(\"Supprimer ce produit ?\")'>\n                        <input type='hidden' name='_token' value='{{ csrf_token('delete' ~ product.id) }}'>\n                        <button type='submit' class='btn btn-sm btn--danger'>Supprimer</button>\n                    </form>\n                </td>\n            </tr>\n        {% else %}\n            <tr><td colspan='6'>Aucun produit trouve.</td></tr>\n        {% endfor %}\n        </tbody>\n    </table>\n\n    <a href='{{ path('admin_dashboard') }}' class='btn btn--secondary'>&larr; Retour au dashboard</a>\n</div>\n{% endblock %}\n"
                    ],
                    [
                        'path' => 'templates/admin/product/edit.html.twig',
                        'description' => 'Formulaire edition produit avec image',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}Admin - Modifier {{ product.name }}{% endblock %}\n\n{% block body %}\n<div class='admin-form'>\n    <h1>Modifier : {{ product.name }}</h1>\n\n    {{ form_start(form, {'attr': {'class': 'product-form', 'enctype': 'multipart/form-data'}}) }}\n        {{ form_row(form.name) }}\n        {{ form_row(form.description) }}\n        \n        <div class='form-row'>\n            {{ form_row(form.price) }}\n            {{ form_row(form.stock) }}\n        </div>\n        \n        {{ form_row(form.category) }}\n\n        <div class='form-group image-upload'>\n            {% if product.image %}\n                <div class='current-image'>\n                    <label>Image actuelle :</label>\n                    <img src='/uploads/products/{{ product.image }}' alt='{{ product.name }}' class='preview-image'>\n                </div>\n            {% endif %}\n            {{ form_row(form.imageFile) }}\n        </div>\n\n        <div class='form-actions'>\n            <button type='submit' class='btn btn-primary'>Enregistrer</button>\n            <a href='{{ path('admin_product_index') }}' class='btn btn--secondary'>Annuler</a>\n        </div>\n    {{ form_end(form) }}\n</div>\n{% endblock %}\n"
                    ],
                    [
                        'path' => 'templates/admin/product/new.html.twig',
                        'description' => 'Formulaire creation produit avec image',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}Admin - Nouveau produit{% endblock %}\n\n{% block body %}\n<div class='admin-form'>\n    <h1>Creer un produit</h1>\n\n    {{ form_start(form, {'attr': {'class': 'product-form', 'enctype': 'multipart/form-data'}}) }}\n        {{ form_row(form.name) }}\n        {{ form_row(form.description) }}\n        \n        <div class='form-row'>\n            {{ form_row(form.price) }}\n            {{ form_row(form.stock) }}\n        </div>\n        \n        {{ form_row(form.category) }}\n        {{ form_row(form.imageFile) }}\n\n        <div class='form-actions'>\n            <button type='submit' class='btn btn-primary'>Creer</button>\n            <a href='{{ path('admin_product_index') }}' class='btn btn--secondary'>Annuler</a>\n        </div>\n    {{ form_end(form) }}\n</div>\n{% endblock %}\n"
                    ],
                    [
                        'path' => 'templates/admin/order/index.html.twig',
                        'description' => 'Liste des commandes avec filtres',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}Admin - Commandes{% endblock %}\n\n{% block body %}\n<div class='admin-orders'>\n    <h1>Gestion des commandes</h1>\n\n    <nav class='status-filters'>\n        <a href='{{ path('admin_order_index') }}' class='btn {{ currentStatus is null ? 'btn-primary' : 'btn--secondary' }}'>Toutes</a>\n        {% for key, label in statuses %}\n            <a href='{{ path('admin_order_index', {status: key}) }}' class='btn {{ currentStatus == key ? 'btn-primary' : 'btn--secondary' }}'>\n                {{ label }}\n            </a>\n        {% endfor %}\n    </nav>\n\n    {% for message in app.flashes('success') %}\n        <div class='alert alert-success'>{{ message }}</div>\n    {% endfor %}\n\n    <table class='admin-table'>\n        <thead>\n            <tr>\n                <th>#</th>\n                <th>Date</th>\n                <th>Client</th>\n                <th>Adresse</th>\n                <th>Total</th>\n                <th>Statut</th>\n                <th>Actions</th>\n            </tr>\n        </thead>\n        <tbody>\n        {% for order in orders %}\n            <tr>\n                <td>{{ order.id }}</td>\n                <td>{{ order.createdAt|date('d/m/Y H:i') }}</td>\n                <td>{{ order.user ? order.user.email : 'Invite' }}</td>\n                <td>{{ order.shippingCity }}</td>\n                <td>{{ order.total|number_format(2, ',', ' ') }} EUR</td>\n                <td><span class='badge badge--{{ order.status }}'>{{ statuses[order.status]|default(order.status) }}</span></td>\n                <td><a href='{{ path('admin_order_show', {id: order.id}) }}' class='btn btn-sm'>Details</a></td>\n            </tr>\n        {% else %}\n            <tr><td colspan='7'>Aucune commande.</td></tr>\n        {% endfor %}\n        </tbody>\n    </table>\n\n    <a href='{{ path('admin_dashboard') }}' class='btn btn--secondary'>&larr; Retour au dashboard</a>\n</div>\n{% endblock %}\n"
                    ],
                    [
                        'path' => 'templates/admin/order/show.html.twig',
                        'description' => 'Detail commande avec changement statut',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}Admin - Commande #{{ order.id }}{% endblock %}\n\n{% block body %}\n<div class='admin-order-detail'>\n    <h1>Commande #{{ order.id }}</h1>\n\n    {% for message in app.flashes('success') %}\n        <div class='alert alert-success'>{{ message }}</div>\n    {% endfor %}\n    {% for message in app.flashes('error') %}\n        <div class='alert alert-danger'>{{ message }}</div>\n    {% endfor %}\n\n    <div class='order-grid'>\n        <section class='order-info'>\n            <h2>Informations</h2>\n            <dl>\n                <dt>Date</dt>\n                <dd>{{ order.createdAt|date('d/m/Y a H:i') }}</dd>\n                \n                <dt>Client</dt>\n                <dd>{{ order.user ? order.user.email : 'Invite' }}</dd>\n                \n                <dt>Statut actuel</dt>\n                <dd><span class='badge badge--{{ order.status }}'>{{ statuses[order.status]|default(order.status) }}</span></dd>\n            </dl>\n\n            <form action='{{ path('admin_order_status', {id: order.id}) }}' method='post' class='status-form'>\n                <label for='status'>Changer le statut :</label>\n                <select name='status' id='status' class='form-control'>\n                    {% for key, label in statuses %}\n                        <option value='{{ key }}' {{ order.status == key ? 'selected' : '' }}>{{ label }}</option>\n                    {% endfor %}\n                </select>\n                <button type='submit' class='btn btn-primary'>Mettre a jour</button>\n            </form>\n        </section>\n\n        <section class='shipping-info'>\n            <h2>Adresse de livraison</h2>\n            <address>\n                <strong>{{ order.shippingName }}</strong><br>\n                {{ order.shippingAddress }}<br>\n                {{ order.shippingPostalCode }} {{ order.shippingCity }}\n            </address>\n        </section>\n    </div>\n\n    <section class='order-items'>\n        <h2>Articles commandes</h2>\n        <table class='admin-table'>\n            <thead>\n                <tr>\n                    <th>Produit</th>\n                    <th>Prix unitaire</th>\n                    <th>Quantite</th>\n                    <th>Total ligne</th>\n                </tr>\n            </thead>\n            <tbody>\n            {% for item in order.items %}\n                <tr>\n                    <td>{{ item.product.name }}</td>\n                    <td>{{ item.unitPrice|number_format(2, ',', ' ') }} EUR</td>\n                    <td>{{ item.quantity }}</td>\n                    <td>{{ item.lineTotal|number_format(2, ',', ' ') }} EUR</td>\n                </tr>\n            {% endfor %}\n            </tbody>\n            <tfoot>\n                <tr>\n                    <th colspan='3'>Total commande</th>\n                    <th>{{ order.total|number_format(2, ',', ' ') }} EUR</th>\n                </tr>\n            </tfoot>\n        </table>\n    </section>\n\n    <nav class='order-actions'>\n        <a href='{{ path('admin_order_index') }}' class='btn btn--secondary'>&larr; Retour aux commandes</a>\n    </nav>\n</div>\n{% endblock %}\n"
                    ],
                ],
                'checklist' => [
                    'Route /admin protegee par ROLE_ADMIN',
                    'Dashboard affiche les statistiques cles (KPIs)',
                    'Methode countLowStock() dans ProductRepository',
                    'Alerte visuelle pour les produits en stock faible',
                    'CRUD produits complet (list, new, edit, delete)',
                    'Upload d\'images avec validation (type, taille)',
                    'Suppression des anciennes images lors de la MAJ',
                    'Protection CSRF sur les formulaires de suppression',
                    'Liste des commandes avec filtres par statut',
                    'Detail commande avec changement de statut',
                    'Messages flash pour feedback utilisateur',
                    'Navigation claire entre les sections admin'
                ],
                'pieges_communs' => [
                    'Oublier #[IsGranted] sur chaque controleur admin',
                    'Ne pas verifier les permissions avant suppression',
                    'Utiliser des requetes non optimisees (N+1) sur les listes',
                    'Oublier la pagination sur les longues listes',
                    'Ne pas proteger les formulaires contre CSRF',
                    'Oublier de valider les statuts avant mise a jour'
                ],
                'ressources' => [
                    ['label' => 'Security Voters', 'url' => 'https://symfony.com/doc/current/security/voters.html', 'icon' => '🔒'],
                    ['label' => 'CRUD Generator', 'url' => 'https://symfony.com/bundles/SymfonyMakerBundle/current/index.html', 'icon' => '⚙️'],
                    ['label' => 'EasyAdmin (alternative)', 'url' => 'https://symfony.com/bundles/EasyAdminBundle/current/index.html', 'icon' => '🎛️'],
                    ['label' => 'Doctrine QueryBuilder', 'url' => 'https://www.doctrine-project.org/projects/doctrine-orm/en/current/reference/query-builder.html', 'icon' => '🗄️']
                ]
            ],

            // Etape 8 - Fonctionnalites Avancees
            8 => [
                'description_detaillee' => "Ajoutez les fonctionnalites professionnelles : upload d'images produits, envoi d'emails transactionnels (confirmation, statut), mise en cache des donnees frequentes, tests unitaires et fonctionnels, puis preparezle deploiement en production.",
                'commandes' => [
                    [
                        'titre' => 'Installer le composant Mailer',
                        'code' => 'composer require symfony/mailer',
                        'explication' => 'Pour envoyer des emails de confirmation de commande'
                    ],
                    [
                        'titre' => 'Configurer le DSN Mailer',
                        'code' => "# Dans .env.local\nMAILER_DSN=smtp://localhost:1025\n# Utilisez Mailhog (docker) ou Mailtrap en dev",
                        'explication' => 'Utilisez Mailhog ou Mailtrap en developpement pour tester les emails sans risque'
                    ],
                    [
                        'titre' => 'Creer le dossier uploads',
                        'code' => 'mkdir -p public/uploads/products',
                        'explication' => 'Dossier pour stocker les images uploadees'
                    ],
                    [
                        'titre' => 'Lancer les tests',
                        'code' => 'php bin/phpunit',
                        'explication' => 'Execute la suite de tests PHPUnit'
                    ],
                    [
                        'titre' => 'Preparer pour la production',
                        'code' => "composer install --no-dev --optimize-autoloader\nAPP_ENV=prod php bin/console cache:clear\nphp bin/console asset-map:compile",
                        'explication' => 'Commandes pour optimiser l\'application en production'
                    ],
                ],
                'fichiers_a_creer' => [
                    [
                        'path' => 'config/services.yaml (extrait)',
                        'description' => 'Configuration du service ImageUploader',
                        'code' => "# config/services.yaml\nparameters:\n    app.uploads_directory: '%kernel.project_dir%/public/uploads/products'\n    app.sender_email: 'noreply@maboutique.fr'\n\nservices:\n    _defaults:\n        autowire: true\n        autoconfigure: true\n\n    App\\:\n        resource: '../src/'\n        exclude:\n            - '../src/DependencyInjection/'\n            - '../src/Entity/'\n            - '../src/Kernel.php'\n\n    # Service d'upload d'images\n    App\\Service\\ImageUploader:\n        arguments:\n            \$targetDirectory: '%app.uploads_directory%'\n\n    # Service d'envoi d'emails\n    App\\Service\\OrderMailer:\n        arguments:\n            \$senderEmail: '%app.sender_email%'\n"
                    ],
                    [
                        'path' => 'src/Service/ImageUploader.php',
                        'description' => 'Service d\'upload d\'images avec validation',
                        'code' => "<?php\nnamespace App\\Service;\n\nuse Symfony\\Component\\HttpFoundation\\File\\Exception\\FileException;\nuse Symfony\\Component\\HttpFoundation\\File\\UploadedFile;\nuse Symfony\\Component\\String\\Slugger\\SluggerInterface;\n\nclass ImageUploader\n{\n    private const ALLOWED_MIMES = ['image/jpeg', 'image/png', 'image/webp'];\n    private const MAX_SIZE = 2 * 1024 * 1024; // 2 Mo\n\n    public function __construct(\n        private string \$targetDirectory,\n        private SluggerInterface \$slugger\n    ) {}\n\n    /**\n     * Upload un fichier image avec validation.\n     * @throws \\InvalidArgumentException Si le fichier n'est pas valide\n     * @throws FileException Si l'upload echoue\n     */\n    public function upload(UploadedFile \$file): string\n    {\n        // Validation du type MIME\n        if (!in_array(\$file->getMimeType(), self::ALLOWED_MIMES, true)) {\n            throw new \\InvalidArgumentException(\n                'Type de fichier non autorise. Formats acceptes : JPG, PNG, WebP'\n            );\n        }\n\n        // Validation de la taille\n        if (\$file->getSize() > self::MAX_SIZE) {\n            throw new \\InvalidArgumentException(\n                'Fichier trop volumineux. Taille max : 2 Mo'\n            );\n        }\n\n        \$originalFilename = pathinfo(\$file->getClientOriginalName(), PATHINFO_FILENAME);\n        \$safeFilename = \$this->slugger->slug(\$originalFilename);\n        \$fileName = \$safeFilename . '-' . uniqid() . '.' . \$file->guessExtension();\n\n        \$file->move(\$this->targetDirectory, \$fileName);\n\n        return \$fileName;\n    }\n\n    /**\n     * Supprime une image existante.\n     */\n    public function remove(string \$filename): bool\n    {\n        \$filepath = \$this->targetDirectory . '/' . \$filename;\n        if (file_exists(\$filepath)) {\n            return unlink(\$filepath);\n        }\n        return false;\n    }\n\n    public function getTargetDirectory(): string\n    {\n        return \$this->targetDirectory;\n    }\n}\n"
                    ],
                    [
                        'path' => 'src/Service/OrderMailer.php',
                        'description' => 'Service d\'envoi d\'emails transactionnels',
                        'code' => "<?php\nnamespace App\\Service;\n\nuse App\\Entity\\Order;\nuse Symfony\\Bridge\\Twig\\Mime\\TemplatedEmail;\nuse Symfony\\Component\\Mailer\\MailerInterface;\nuse Symfony\\Component\\Mime\\Address;\nuse Psr\\Log\\LoggerInterface;\n\nclass OrderMailer\n{\n    public function __construct(\n        private MailerInterface \$mailer,\n        private string \$senderEmail,\n        private ?LoggerInterface \$logger = null\n    ) {}\n\n    /**\n     * Envoie un email de confirmation de commande.\n     */\n    public function sendConfirmation(Order \$order): void\n    {\n        if (!\$order->getUser()) {\n            \$this->logger?->warning('Impossible d\\'envoyer l\\'email : pas d\\'utilisateur sur la commande #' . \$order->getId());\n            return;\n        }\n\n        \$email = (new TemplatedEmail())\n            ->from(new Address(\$this->senderEmail, 'Ma Boutique'))\n            ->to(\$order->getUser()->getEmail())\n            ->subject('Confirmation de commande #' . \$order->getId())\n            ->htmlTemplate('emails/order_confirmation.html.twig')\n            ->context([\n                'order' => \$order,\n                'user' => \$order->getUser(),\n            ]);\n\n        \$this->mailer->send(\$email);\n        \$this->logger?->info('Email de confirmation envoye pour la commande #' . \$order->getId());\n    }\n\n    /**\n     * Envoie un email de mise a jour du statut.\n     */\n    public function sendStatusUpdate(Order \$order): void\n    {\n        if (!\$order->getUser()) {\n            return;\n        }\n\n        \$statusLabels = [\n            Order::STATUS_PAID => 'Payee',\n            Order::STATUS_SHIPPED => 'Expediee',\n            Order::STATUS_DELIVERED => 'Livree',\n        ];\n\n        \$email = (new TemplatedEmail())\n            ->from(new Address(\$this->senderEmail, 'Ma Boutique'))\n            ->to(\$order->getUser()->getEmail())\n            ->subject('Commande #' . \$order->getId() . ' - ' . (\$statusLabels[\$order->getStatus()] ?? \$order->getStatus()))\n            ->htmlTemplate('emails/order_status.html.twig')\n            ->context([\n                'order' => \$order,\n                'user' => \$order->getUser(),\n                'statusLabel' => \$statusLabels[\$order->getStatus()] ?? \$order->getStatus(),\n            ]);\n\n        \$this->mailer->send(\$email);\n    }\n}\n"
                    ],
                    [
                        'path' => 'templates/emails/order_confirmation.html.twig',
                        'description' => 'Template email de confirmation',
                        'code' => "<!DOCTYPE html>\n<html lang='fr'>\n<head>\n    <meta charset='UTF-8'>\n    <meta name='viewport' content='width=device-width, initial-scale=1.0'>\n    <title>Confirmation de commande</title>\n    <style>\n        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }\n        .container { max-width: 600px; margin: 0 auto; padding: 20px; }\n        .header { background: linear-gradient(135deg, #007bff, #0056b3); color: white; padding: 30px; text-align: center; border-radius: 8px 8px 0 0; }\n        .header h1 { margin: 0; font-size: 24px; }\n        .content { padding: 30px; background: #fff; border: 1px solid #e0e0e0; }\n        .order-number { background: #f8f9fa; padding: 15px; border-radius: 5px; text-align: center; margin: 20px 0; }\n        .order-number strong { font-size: 1.4em; color: #007bff; }\n        .order-table { width: 100%; border-collapse: collapse; margin: 20px 0; }\n        .order-table th { background: #f8f9fa; padding: 12px; text-align: left; border-bottom: 2px solid #007bff; }\n        .order-table td { padding: 12px; border-bottom: 1px solid #e0e0e0; }\n        .total-row { font-weight: bold; font-size: 1.1em; background: #f8f9fa; }\n        .address-box { background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0; }\n        .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }\n        .btn { display: inline-block; padding: 12px 24px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; }\n    </style>\n</head>\n<body>\n    <div class='container'>\n        <div class='header'>\n            <h1>✅ Commande confirmee !</h1>\n        </div>\n        <div class='content'>\n            <p>Bonjour <strong>{{ order.shippingName }}</strong>,</p>\n            <p>Merci pour votre commande ! Nous l'avons bien recue et elle est en cours de traitement.</p>\n\n            <div class='order-number'>\n                Commande <strong>#{{ order.id }}</strong><br>\n                <small>{{ order.createdAt|date('d/m/Y a H:i') }}</small>\n            </div>\n\n            <h3>📦 Recapitulatif</h3>\n            <table class='order-table'>\n                <thead>\n                    <tr><th>Produit</th><th>Qte</th><th>Prix</th></tr>\n                </thead>\n                <tbody>\n                {% for item in order.items %}\n                    <tr>\n                        <td>{{ item.product.name }}</td>\n                        <td>{{ item.quantity }}</td>\n                        <td>{{ item.lineTotal|number_format(2, ',', ' ') }} EUR</td>\n                    </tr>\n                {% endfor %}\n                    <tr class='total-row'>\n                        <td colspan='2'>Total</td>\n                        <td>{{ order.total|number_format(2, ',', ' ') }} EUR</td>\n                    </tr>\n                </tbody>\n            </table>\n\n            <h3>🚚 Adresse de livraison</h3>\n            <div class='address-box'>\n                <strong>{{ order.shippingName }}</strong><br>\n                {{ order.shippingAddress }}<br>\n                {{ order.shippingPostalCode }} {{ order.shippingCity }}\n            </div>\n\n            <p>Vous recevrez un email des que votre commande sera expediee.</p>\n        </div>\n        <div class='footer'>\n            <p>Ma Boutique - Tutoriel Symfony E-commerce</p>\n            <p>Cet email a ete envoye automatiquement, merci de ne pas y repondre.</p>\n        </div>\n    </div>\n</body>\n</html>\n"
                    ],
                    [
                        'path' => 'templates/emails/order_status.html.twig',
                        'description' => 'Template email mise a jour statut',
                        'code' => "<!DOCTYPE html>\n<html lang='fr'>\n<head>\n    <meta charset='UTF-8'>\n    <meta name='viewport' content='width=device-width, initial-scale=1.0'>\n    <title>Mise a jour de votre commande</title>\n    <style>\n        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }\n        .container { max-width: 600px; margin: 0 auto; padding: 20px; }\n        .header { padding: 30px; text-align: center; border-radius: 8px 8px 0 0; }\n        .header.paid { background: linear-gradient(135deg, #28a745, #1e7e34); color: white; }\n        .header.shipped { background: linear-gradient(135deg, #17a2b8, #117a8b); color: white; }\n        .header.delivered { background: linear-gradient(135deg, #6f42c1, #5a32a3); color: white; }\n        .header h1 { margin: 0; font-size: 24px; }\n        .content { padding: 30px; background: #fff; border: 1px solid #e0e0e0; }\n        .status-badge { display: inline-block; padding: 10px 20px; border-radius: 25px; font-weight: bold; font-size: 1.1em; margin: 15px 0; }\n        .status-badge.paid { background: #d4edda; color: #155724; }\n        .status-badge.shipped { background: #d1ecf1; color: #0c5460; }\n        .status-badge.delivered { background: #e2d9f3; color: #5a32a3; }\n        .timeline { margin: 30px 0; padding-left: 30px; border-left: 3px solid #e0e0e0; }\n        .timeline-item { position: relative; padding: 10px 0; }\n        .timeline-item::before { content: ''; position: absolute; left: -36px; top: 12px; width: 12px; height: 12px; border-radius: 50%; background: #e0e0e0; }\n        .timeline-item.active::before { background: #007bff; }\n        .timeline-item.completed::before { background: #28a745; }\n        .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }\n    </style>\n</head>\n<body>\n    <div class='container'>\n        <div class='header {{ order.status }}'>\n            <h1>\n                {% if order.status == 'paid' %}💳 Paiement recu{% endif %}\n                {% if order.status == 'shipped' %}🚚 Commande expediee{% endif %}\n                {% if order.status == 'delivered' %}✅ Commande livree{% endif %}\n            </h1>\n        </div>\n        <div class='content'>\n            <p>Bonjour <strong>{{ order.shippingName }}</strong>,</p>\n\n            <p>Votre commande <strong>#{{ order.id }}</strong> a change de statut :</p>\n\n            <p style='text-align: center;'>\n                <span class='status-badge {{ order.status }}'>{{ statusLabel }}</span>\n            </p>\n\n            {% if order.status == 'shipped' %}\n            <p>🎉 Bonne nouvelle ! Votre colis est en route vers :</p>\n            <p style='background: #f8f9fa; padding: 15px; border-radius: 5px;'>\n                {{ order.shippingAddress }}<br>\n                {{ order.shippingPostalCode }} {{ order.shippingCity }}\n            </p>\n            {% endif %}\n\n            {% if order.status == 'delivered' %}\n            <p>🎉 Votre commande a ete livree ! Nous esperons que vous etes satisfait.</p>\n            <p>N'hesitez pas a nous contacter si vous avez des questions.</p>\n            {% endif %}\n\n            <h3>Suivi de votre commande</h3>\n            <div class='timeline'>\n                <div class='timeline-item completed'>Commande confirmee</div>\n                <div class='timeline-item {{ order.status in ['paid', 'shipped', 'delivered'] ? 'completed' : '' }}'>Paiement recu</div>\n                <div class='timeline-item {{ order.status in ['shipped', 'delivered'] ? 'completed' : '' }}'>Expedition</div>\n                <div class='timeline-item {{ order.status == 'delivered' ? 'completed' : '' }}'>Livraison</div>\n            </div>\n        </div>\n        <div class='footer'>\n            <p>Ma Boutique - Tutoriel Symfony E-commerce</p>\n        </div>\n    </div>\n</body>\n</html>\n"
                    ],
                    [
                        'path' => 'tests/Service/CartManagerTest.php',
                        'description' => 'Tests unitaires du panier',
                        'code' => "<?php\nnamespace App\\Tests\\Service;\n\nuse App\\Entity\\Product;\nuse App\\Service\\CartManager;\nuse App\\Service\\CartSessionStorage;\nuse PHPUnit\\Framework\\TestCase;\n\nclass CartManagerTest extends TestCase\n{\n    private CartManager \$cartManager;\n    private CartSessionStorage \$storage;\n\n    protected function setUp(): void\n    {\n        \$this->storage = \$this->createMock(CartSessionStorage::class);\n        \$this->cartManager = new CartManager(\$this->storage);\n    }\n\n    public function testAddProductToCart(): void\n    {\n        \$product = new Product();\n        // Simuler un ID via reflection\n        \$reflection = new \\ReflectionClass(\$product);\n        \$property = \$reflection->getProperty('id');\n        \$property->setValue(\$product, 1);\n\n        \$this->storage->expects(\$this->once())\n            ->method('addItem')\n            ->with(1, 2);\n\n        \$this->cartManager->add(\$product, 2);\n    }\n\n    public function testRemoveFromCart(): void\n    {\n        \$this->storage->expects(\$this->once())\n            ->method('removeItem')\n            ->with(123);\n\n        \$this->cartManager->remove(123);\n    }\n\n    public function testClearCart(): void\n    {\n        \$this->storage->expects(\$this->once())\n            ->method('clear');\n\n        \$this->cartManager->clear();\n    }\n\n    public function testIsEmptyReturnsTrueForEmptyCart(): void\n    {\n        \$this->storage->expects(\$this->once())\n            ->method('getCart')\n            ->willReturn([]);\n\n        \$this->assertTrue(\$this->cartManager->isEmpty());\n    }\n\n    public function testIsEmptyReturnsFalseForNonEmptyCart(): void\n    {\n        \$this->storage->expects(\$this->once())\n            ->method('getCart')\n            ->willReturn([1 => 2]);\n\n        \$this->assertFalse(\$this->cartManager->isEmpty());\n    }\n}\n"
                    ],
                    [
                        'path' => 'tests/Controller/CheckoutControllerTest.php',
                        'description' => 'Tests fonctionnels du checkout',
                        'code' => "<?php\nnamespace App\\Tests\\Controller;\n\nuse App\\Entity\\User;\nuse Symfony\\Bundle\\FrameworkBundle\\Test\\WebTestCase;\nuse Symfony\\Component\\HttpFoundation\\Response;\n\nclass CheckoutControllerTest extends WebTestCase\n{\n    public function testCheckoutRequiresAuthentication(): void\n    {\n        \$client = static::createClient();\n        \$client->request('GET', '/checkout');\n\n        // Doit rediriger vers login\n        \$this->assertResponseRedirects();\n        \$this->assertStringContainsString('login', \$client->getResponse()->headers->get('Location'));\n    }\n\n    public function testCheckoutWithEmptyCartRedirectsToCart(): void\n    {\n        \$client = static::createClient();\n\n        // Simuler un utilisateur connecte\n        \$userRepository = static::getContainer()->get('doctrine')->getRepository(User::class);\n        \$testUser = \$userRepository->findOneBy(['email' => 'test@example.com']);\n\n        if (\$testUser) {\n            \$client->loginUser(\$testUser);\n            \$client->request('GET', '/checkout');\n\n            // Avec panier vide, doit rediriger vers le panier\n            \$this->assertResponseRedirects('/cart');\n        } else {\n            \$this->markTestSkipped('Utilisateur de test non trouve. Creez un utilisateur test@example.com');\n        }\n    }\n\n    public function testCartPageIsAccessible(): void\n    {\n        \$client = static::createClient();\n        \$client->request('GET', '/cart');\n\n        \$this->assertResponseIsSuccessful();\n        \$this->assertSelectorExists('h1');\n    }\n\n    public function testProductsPageShowsPagination(): void\n    {\n        \$client = static::createClient();\n        \$crawler = \$client->request('GET', '/products');\n\n        \$this->assertResponseIsSuccessful();\n        // Verifie que la page contient des produits ou un message \"aucun produit\"\n        \$this->assertTrue(\n            \$crawler->filter('.product-card')->count() > 0 ||\n            \$crawler->filter('.no-products')->count() > 0\n        );\n    }\n}\n"
                    ],
                    [
                        'path' => 'tests/Service/ImageUploaderTest.php',
                        'description' => 'Tests unitaires upload images',
                        'code' => "<?php\nnamespace App\\Tests\\Service;\n\nuse App\\Service\\ImageUploader;\nuse PHPUnit\\Framework\\TestCase;\nuse Symfony\\Component\\HttpFoundation\\File\\UploadedFile;\nuse Symfony\\Component\\String\\Slugger\\AsciiSlugger;\n\nclass ImageUploaderTest extends TestCase\n{\n    private string \$targetDirectory;\n    private ImageUploader \$uploader;\n\n    protected function setUp(): void\n    {\n        \$this->targetDirectory = sys_get_temp_dir() . '/test_uploads';\n        if (!is_dir(\$this->targetDirectory)) {\n            mkdir(\$this->targetDirectory, 0777, true);\n        }\n        \$this->uploader = new ImageUploader(\$this->targetDirectory, new AsciiSlugger());\n    }\n\n    protected function tearDown(): void\n    {\n        // Nettoyer les fichiers de test\n        array_map('unlink', glob(\$this->targetDirectory . '/*'));\n        rmdir(\$this->targetDirectory);\n    }\n\n    public function testGetTargetDirectory(): void\n    {\n        \$this->assertEquals(\$this->targetDirectory, \$this->uploader->getTargetDirectory());\n    }\n\n    public function testUploadRejectsInvalidMimeType(): void\n    {\n        // Creer un fichier texte temporaire\n        \$tempFile = tempnam(sys_get_temp_dir(), 'test');\n        file_put_contents(\$tempFile, 'not an image');\n\n        \$file = new UploadedFile(\n            \$tempFile,\n            'test.txt',\n            'text/plain',\n            null,\n            true\n        );\n\n        \$this->expectException(\\InvalidArgumentException::class);\n        \$this->expectExceptionMessage('Type de fichier non autorise');\n\n        \$this->uploader->upload(\$file);\n    }\n\n    public function testRemoveNonExistentFileReturnsFalse(): void\n    {\n        \$this->assertFalse(\$this->uploader->remove('non_existent_file.jpg'));\n    }\n}\n"
                    ],
                    [
                        'path' => 'config/packages/cache.yaml',
                        'description' => 'Configuration du cache applicatif',
                        'code' => "framework:\n    cache:\n        # Pools de cache personnalises\n        pools:\n            # Cache pour les produits (catalogue)\n            product.cache:\n                adapter: cache.adapter.filesystem\n                default_lifetime: 3600  # 1 heure\n\n            # Cache pour les statistiques dashboard\n            stats.cache:\n                adapter: cache.adapter.filesystem\n                default_lifetime: 300   # 5 minutes\n\n# Configuration production avec Redis\nwhen@prod:\n    framework:\n        cache:\n            pools:\n                product.cache:\n                    adapter: cache.adapter.redis\n                    provider: 'redis://localhost:6379'\n                stats.cache:\n                    adapter: cache.adapter.redis\n                    provider: 'redis://localhost:6379'\n"
                    ],
                    [
                        'path' => '.env.prod.local.example',
                        'description' => 'Exemple de configuration production',
                        'code' => "# Copier ce fichier en .env.prod.local et adapter les valeurs\n# NE JAMAIS COMMITER .env.prod.local !\n\nAPP_ENV=prod\nAPP_SECRET=CHANGEZ_CETTE_CLE_SECRETE_EN_PROD\n\n# Base de donnees\nDATABASE_URL=\"mysql://user:password@localhost:3306/maboutique_prod?serverVersion=8.0\"\n\n# Mailer (exemple avec SMTP)\nMAILER_DSN=smtp://user:pass@smtp.example.com:587\n\n# Redis (si utilise)\n# REDIS_URL=redis://localhost:6379\n"
                    ],
                ],
                'checklist' => [
                    'Service ImageUploader avec validation MIME et taille',
                    'Methode remove() pour supprimer les anciennes images',
                    'OrderMailer envoie confirmation et mises a jour statut',
                    'Templates emails responsives et professionnels',
                    'Configuration services.yaml avec parametres',
                    'Cache configure pour produits et statistiques',
                    'Tests unitaires pour CartManager et ImageUploader',
                    'Tests fonctionnels pour le workflow checkout',
                    'Variables d\'environnement securisees (.env.local)',
                    'Exemple de configuration production fourni'
                ],
                'pieges_communs' => [
                    'Oublier de valider le type MIME des fichiers uploades',
                    'Ne pas configurer de timeout pour les envois d\'email',
                    'Cache trop long sur des donnees qui changent souvent',
                    'Ne pas mocker les services externes dans les tests',
                    'Exposer des variables sensibles dans le code',
                    'Oublier les migrations en production',
                    'Ne pas tester les emails en developpement (Mailhog)'
                ],
                'ressources' => [
                    ['label' => 'File Upload', 'url' => 'https://symfony.com/doc/current/controller/upload_file.html', 'icon' => '📤'],
                    ['label' => 'Mailer', 'url' => 'https://symfony.com/doc/current/mailer.html', 'icon' => '📧'],
                    ['label' => 'Cache', 'url' => 'https://symfony.com/doc/current/cache.html', 'icon' => '⚡'],
                    ['label' => 'Testing', 'url' => 'https://symfony.com/doc/current/testing.html', 'icon' => '🧪'],
                    ['label' => 'Deployment', 'url' => 'https://symfony.com/doc/current/deployment.html', 'icon' => '🚀'],
                    ['label' => 'Environment Variables', 'url' => 'https://symfony.com/doc/current/configuration.html#configuration-based-on-environment-variables', 'icon' => '🔐']
                ]
            ],

            // Etape 9 - Integration Paiement (Stripe)
            9 => [
                'description_detaillee' => "Integrez un systeme de paiement securise avec Stripe. Cette etape couvre la creation d'une session de paiement, la gestion des webhooks pour confirmer les transactions, et la mise a jour automatique du statut des commandes. Mode test inclus pour le developpement.",
                'commandes' => [
                    [
                        'titre' => 'Installer le SDK Stripe',
                        'code' => 'composer require stripe/stripe-php',
                        'explication' => 'SDK officiel Stripe pour PHP, facilite l\'integration API.'
                    ],
                    [
                        'titre' => 'Configurer les cles API',
                        'code' => "# .env.local\nSTRIPE_SECRET_KEY=sk_test_...\nSTRIPE_PUBLIC_KEY=pk_test_...\nSTRIPE_WEBHOOK_SECRET=whsec_...",
                        'explication' => 'Cles de test Stripe (dashboard.stripe.com). Ne jamais commiter les vraies cles !'
                    ],
                    [
                        'titre' => 'Creer le controleur de paiement',
                        'code' => 'php bin/console make:controller PaymentController',
                        'explication' => 'Gere la creation de session Stripe et les redirections.'
                    ],
                    [
                        'titre' => 'Tester avec Stripe CLI (local)',
                        'code' => "stripe listen --forward-to localhost:8000/webhook/stripe\n# Puis dans un autre terminal :\nstripe trigger checkout.session.completed",
                        'explication' => 'Stripe CLI permet de tester les webhooks en local.'
                    ],
                ],
                'fichiers_a_creer' => [
                    [
                        'path' => 'config/packages/stripe.yaml',
                        'description' => 'Configuration Stripe avec parametres',
                        'language' => 'yaml',
                        'code' => "parameters:\n    stripe_secret_key: '%env(STRIPE_SECRET_KEY)%'\n    stripe_public_key: '%env(STRIPE_PUBLIC_KEY)%'\n    stripe_webhook_secret: '%env(STRIPE_WEBHOOK_SECRET)%'"
                    ],
                    [
                        'path' => 'config/routes/webhook.yaml',
                        'description' => 'Route webhook avec desactivation CSRF',
                        'language' => 'yaml',
                        'code' => "# Les webhooks externes ne peuvent pas envoyer de token CSRF\n# On les exclut du firewall stateless\nwebhook_stripe:\n    path: /webhook/stripe\n    controller: App\\Controller\\WebhookController::stripeWebhook\n    methods: POST"
                    ],
                    [
                        'path' => 'config/packages/security.yaml (ajout)',
                        'description' => 'Ajouter le firewall webhook AVANT main',
                        'language' => 'yaml',
                        'code' => "# Dans config/packages/security.yaml, ajouter ce firewall AVANT 'main':\nfirewalls:\n    # Firewall pour webhooks externes (pas de CSRF, pas de session)\n    webhook:\n        pattern: ^/webhook/\n        stateless: true\n        security: false\n    # ... puis le firewall main existant"
                    ],
                    [
                        'path' => 'src/Service/StripePaymentService.php',
                        'description' => 'Service de paiement Stripe',
                        'code' => "<?php\nnamespace App\\Service;\n\nuse App\\Entity\\Order;\nuse Stripe\\Checkout\\Session;\nuse Stripe\\Stripe;\nuse Stripe\\Webhook;\nuse Symfony\\Component\\DependencyInjection\\Attribute\\Autowire;\nuse Symfony\\Component\\Routing\\Generator\\UrlGeneratorInterface;\n\nclass StripePaymentService\n{\n    public function __construct(\n        #[Autowire('%stripe_secret_key%')] private string \\\$secretKey,\n        #[Autowire('%stripe_webhook_secret%')] private string \\\$webhookSecret,\n        private UrlGeneratorInterface \\\$urlGenerator\n    ) {\n        Stripe::setApiKey(\\\$this->secretKey);\n    }\n\n    /**\n     * Cree une session de paiement Stripe Checkout.\n     */\n    public function createCheckoutSession(Order \\\$order): Session\n    {\n        \\\$lineItems = [];\n        foreach (\\\$order->getItems() as \\\$item) {\n            \\\$lineItems[] = [\n                'price_data' => [\n                    'currency' => 'eur',\n                    'product_data' => [\n                        'name' => \\\$item->getProduct()->getName(),\n                        'description' => substr(\\\$item->getProduct()->getDescription() ?? '', 0, 100),\n                    ],\n                    'unit_amount' => (int) ((float) \\\$item->getUnitPrice() * 100), // Stripe attend des centimes\n                ],\n                'quantity' => \\\$item->getQuantity(),\n            ];\n        }\n\n        return Session::create([\n            'payment_method_types' => ['card'],\n            'line_items' => \\\$lineItems,\n            'mode' => 'payment',\n            'success_url' => \\\$this->urlGenerator->generate(\n                'payment_success',\n                ['id' => \\\$order->getId()],\n                UrlGeneratorInterface::ABSOLUTE_URL\n            ),\n            'cancel_url' => \\\$this->urlGenerator->generate(\n                'payment_cancel',\n                ['id' => \\\$order->getId()],\n                UrlGeneratorInterface::ABSOLUTE_URL\n            ),\n            'metadata' => [\n                'order_id' => \\\$order->getId(),\n            ],\n            'customer_email' => \\\$order->getUser()?->getEmail(),\n        ]);\n    }\n\n    /**\n     * Verifie et decode un webhook Stripe.\n     */\n    public function handleWebhook(string \\\$payload, string \\\$signature): ?array\n    {\n        try {\n            \\\$event = Webhook::constructEvent(\\\$payload, \\\$signature, \\\$this->webhookSecret);\n            return [\n                'type' => \\\$event->type,\n                'data' => \\\$event->data->object,\n            ];\n        } catch (\\\\Exception \\\$e) {\n            return null;\n        }\n    }\n}\n"
                    ],
                    [
                        'path' => 'src/Controller/PaymentController.php',
                        'description' => 'Controleur de paiement avec Stripe Checkout',
                        'code' => "<?php\nnamespace App\\Controller;\n\nuse App\\Entity\\Order;\nuse App\\Service\\StripePaymentService;\nuse Doctrine\\ORM\\EntityManagerInterface;\nuse Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController;\nuse Symfony\\Component\\DependencyInjection\\Attribute\\Autowire;\nuse Symfony\\Component\\HttpFoundation\\Request;\nuse Symfony\\Component\\HttpFoundation\\Response;\nuse Symfony\\Component\\Routing\\Attribute\\Route;\n\nclass PaymentController extends AbstractController\n{\n    public function __construct(\n        private StripePaymentService \\\$stripeService,\n        private EntityManagerInterface \\\$em,\n        #[Autowire('%stripe_public_key%')] private string \\\$stripePublicKey\n    ) {}\n\n    /**\n     * Redirige vers Stripe Checkout.\n     */\n    #[Route('/payment/{id}', name: 'payment_checkout', requirements: ['id' => '\\\\d+'])]\n    public function checkout(Order \\\$order): Response\n    {\n        // Verifier que la commande appartient a l'utilisateur\n        if (\\\$order->getUser() !== \\\$this->getUser()) {\n            throw \\\$this->createAccessDeniedException();\n        }\n\n        // Verifier que la commande est en attente de paiement\n        if (\\\$order->getStatus() !== Order::STATUS_PENDING) {\n            \\\$this->addFlash('warning', 'Cette commande ne peut pas etre payee.');\n            return \\\$this->redirectToRoute('app_profile');\n        }\n\n        \\\$session = \\\$this->stripeService->createCheckoutSession(\\\$order);\n\n        return \\\$this->redirect(\\\$session->url);\n    }\n\n    /**\n     * Page de succes apres paiement.\n     */\n    #[Route('/payment/{id}/success', name: 'payment_success')]\n    public function success(Order \\\$order): Response\n    {\n        // Le statut sera mis a jour par le webhook, mais on affiche une confirmation\n        return \\\$this->render('payment/success.html.twig', [\n            'order' => \\\$order,\n        ]);\n    }\n\n    /**\n     * Page d'annulation de paiement.\n     */\n    #[Route('/payment/{id}/cancel', name: 'payment_cancel')]\n    public function cancel(Order \\\$order): Response\n    {\n        \\\$this->addFlash('info', 'Paiement annule. Vous pouvez reessayer.');\n        return \\\$this->render('payment/cancel.html.twig', [\n            'order' => \\\$order,\n        ]);\n    }\n}\n"
                    ],
                    [
                        'path' => 'src/Controller/WebhookController.php',
                        'description' => 'Controleur webhook pour Stripe',
                        'code' => "<?php\nnamespace App\\Controller;\n\nuse App\\Entity\\Order;\nuse App\\Repository\\OrderRepository;\nuse App\\Service\\StripePaymentService;\nuse Doctrine\\ORM\\EntityManagerInterface;\nuse Psr\\Log\\LoggerInterface;\nuse Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController;\nuse Symfony\\Component\\HttpFoundation\\Request;\nuse Symfony\\Component\\HttpFoundation\\Response;\nuse Symfony\\Component\\Routing\\Attribute\\Route;\n\nclass WebhookController extends AbstractController\n{\n    public function __construct(\n        private StripePaymentService \\\$stripeService,\n        private OrderRepository \\\$orderRepo,\n        private EntityManagerInterface \\\$em,\n        private LoggerInterface \\\$logger\n    ) {}\n\n    #[Route('/webhook/stripe', name: 'webhook_stripe', methods: ['POST'])]\n    public function stripeWebhook(Request \\\$request): Response\n    {\n        \\\$payload = \\\$request->getContent();\n        \\\$signature = \\\$request->headers->get('Stripe-Signature', '');\n\n        \\\$event = \\\$this->stripeService->handleWebhook(\\\$payload, \\\$signature);\n\n        if (\\\$event === null) {\n            \\\$this->logger->error('Webhook Stripe invalide');\n            return new Response('Invalid signature', 400);\n        }\n\n        \\\$this->logger->info('Webhook Stripe recu', ['type' => \\\$event['type']]);\n\n        switch (\\\$event['type']) {\n            case 'checkout.session.completed':\n                \\\$this->handleCheckoutCompleted(\\\$event['data']);\n                break;\n\n            case 'payment_intent.payment_failed':\n                \\\$this->handlePaymentFailed(\\\$event['data']);\n                break;\n        }\n\n        return new Response('OK', 200);\n    }\n\n    private function handleCheckoutCompleted(object \\\$session): void\n    {\n        \\\$orderId = \\\$session->metadata->order_id ?? null;\n        if (!\\\$orderId) {\n            return;\n        }\n\n        \\\$order = \\\$this->orderRepo->find(\\\$orderId);\n        if (\\\$order && \\\$order->getStatus() === Order::STATUS_PENDING) {\n            \\\$order->setStatus(Order::STATUS_PAID);\n            \\\$this->em->flush();\n            \\\$this->logger->info('Commande payee', ['order_id' => \\\$orderId]);\n        }\n    }\n\n    private function handlePaymentFailed(object \\\$paymentIntent): void\n    {\n        \\\$this->logger->warning('Paiement echoue', [\n            'payment_intent' => \\\$paymentIntent->id ?? 'unknown'\n        ]);\n    }\n}\n"
                    ],
                    [
                        'path' => 'templates/payment/success.html.twig',
                        'description' => 'Page de succes paiement',
                        'language' => 'twig',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}Paiement reussi{% endblock %}\n\n{% block body %}\n<div class='container payment-result payment-success'>\n    <div class='result-card'>\n        <div class='result-icon'>✅</div>\n        <h1>Paiement reussi !</h1>\n        <p>Merci pour votre achat. Votre commande <strong>#{{ order.id }}</strong> est confirmee.</p>\n        \n        <div class='order-summary'>\n            <h3>Recapitulatif</h3>\n            <dl>\n                <dt>Montant paye</dt>\n                <dd>{{ order.total|number_format(2, ',', ' ') }} EUR</dd>\n                \n                <dt>Livraison</dt>\n                <dd>{{ order.shippingCity }}</dd>\n                \n                <dt>Statut</dt>\n                <dd><span class='badge badge--paid'>Payee</span></dd>\n            </dl>\n        </div>\n\n        <p class='confirmation-notice'>\n            Un email de confirmation vous a ete envoye a <strong>{{ order.user.email }}</strong>\n        </p>\n\n        <nav class='result-actions'>\n            <a href='{{ path('app_profile') }}' class='btn btn-primary'>Voir mes commandes</a>\n            <a href='{{ path('app_products') }}' class='btn btn--secondary'>Continuer mes achats</a>\n        </nav>\n    </div>\n</div>\n{% endblock %}\n"
                    ],
                    [
                        'path' => 'templates/payment/cancel.html.twig',
                        'description' => 'Page d\'annulation paiement',
                        'language' => 'twig',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}Paiement annule{% endblock %}\n\n{% block body %}\n<div class='container payment-result payment-cancel'>\n    <div class='result-card'>\n        <div class='result-icon'>❌</div>\n        <h1>Paiement annule</h1>\n        <p>Votre paiement n'a pas ete effectue. Votre commande <strong>#{{ order.id }}</strong> est toujours en attente.</p>\n        \n        <div class='cancel-options'>\n            <h3>Que souhaitez-vous faire ?</h3>\n            <ul>\n                <li>Reessayer le paiement</li>\n                <li>Modifier votre panier</li>\n                <li>Utiliser un autre moyen de paiement</li>\n            </ul>\n        </div>\n\n        <nav class='result-actions'>\n            <a href='{{ path('payment_checkout', {id: order.id}) }}' class='btn btn-primary'>Reessayer le paiement</a>\n            <a href='{{ path('cart_index') }}' class='btn btn--secondary'>Retour au panier</a>\n        </nav>\n    </div>\n</div>\n{% endblock %}\n"
                    ],
                    [
                        'path' => 'templates/checkout/success.html.twig',
                        'description' => 'Vue confirmation avec bouton payer (mise a jour)',
                        'language' => 'twig',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}Commande confirmee{% endblock %}\n\n{% block body %}\n<div class='container checkout-success'>\n    <div class='success-card'>\n        <div class='success-icon'>🎉</div>\n        <h1>Commande enregistree !</h1>\n        <p>Votre commande <strong>#{{ order.id }}</strong> a ete enregistree avec succes.</p>\n        \n        <div class='order-details'>\n            <dl>\n                <dt>Total</dt>\n                <dd>{{ order.total|number_format(2, ',', ' ') }} EUR</dd>\n                <dt>Statut</dt>\n                <dd><span class='badge badge--pending'>En attente de paiement</span></dd>\n            </dl>\n        </div>\n\n        <div class='payment-cta'>\n            <p>Finalisez votre achat en procedant au paiement securise.</p>\n            <a href='{{ path('payment_checkout', {id: order.id}) }}' class='btn btn-primary btn-large'>\n                💳 Payer {{ order.total|number_format(2, ',', ' ') }} EUR\n            </a>\n        </div>\n\n        <p class='payment-notice'>\n            <small>Paiement securise par Stripe. Vos donnees bancaires ne sont jamais stockees sur notre serveur.</small>\n        </p>\n    </div>\n</div>\n{% endblock %}\n"
                    ],
                    [
                        'path' => 'assets/styles/payment.css',
                        'description' => 'Styles pour les pages de paiement',
                        'language' => 'css',
                        'code' => "/* Pages de resultat paiement */\n.payment-result {\n    min-height: 60vh;\n    display: flex;\n    align-items: center;\n    justify-content: center;\n    padding: 2rem;\n}\n\n.result-card {\n    background: var(--color-surface);\n    border-radius: 1rem;\n    padding: 3rem;\n    max-width: 500px;\n    text-align: center;\n    box-shadow: 0 4px 20px rgba(0,0,0,0.1);\n}\n\n.result-icon {\n    font-size: 4rem;\n    margin-bottom: 1rem;\n}\n\n.payment-success .result-card {\n    border-top: 4px solid var(--color-success);\n}\n\n.payment-cancel .result-card {\n    border-top: 4px solid var(--color-warning);\n}\n\n.order-summary,\n.cancel-options {\n    background: var(--color-background);\n    border-radius: 0.5rem;\n    padding: 1.5rem;\n    margin: 1.5rem 0;\n    text-align: left;\n}\n\n.order-summary dl {\n    display: grid;\n    grid-template-columns: 1fr 1fr;\n    gap: 0.5rem;\n}\n\n.confirmation-notice {\n    color: var(--color-muted);\n    font-size: 0.9rem;\n    margin: 1rem 0;\n}\n\n.result-actions {\n    display: flex;\n    gap: 1rem;\n    justify-content: center;\n    flex-wrap: wrap;\n    margin-top: 2rem;\n}\n\n/* Success page checkout */\n.checkout-success .success-card {\n    background: var(--color-surface);\n    border-radius: 1rem;\n    padding: 2rem;\n    max-width: 500px;\n    margin: 0 auto;\n    text-align: center;\n}\n\n.success-icon {\n    font-size: 3rem;\n    margin-bottom: 1rem;\n}\n\n.payment-cta {\n    background: linear-gradient(135deg, var(--color-primary-light), var(--color-primary));\n    color: white;\n    border-radius: 0.5rem;\n    padding: 1.5rem;\n    margin: 1.5rem 0;\n}\n\n.payment-cta .btn {\n    margin-top: 1rem;\n}\n\n.payment-notice {\n    color: var(--color-muted);\n}\n"
                    ],
                ],
                'checklist' => [
                    'SDK Stripe installe (composer require stripe/stripe-php)',
                    'Cles API configurees dans .env.local (JAMAIS commiter)',
                    'Service StripePaymentService cree et fonctionnel',
                    'Session Checkout Stripe cree avec line_items',
                    'Pages succes et annulation affichees correctement',
                    'Firewall webhook configure (stateless, security: false)',
                    'Webhook /webhook/stripe configure et accessible',
                    'Signature webhook verifiee (securite)',
                    'Statut commande mis a jour automatiquement apres paiement',
                    'Logs des evenements webhook',
                    'Test en mode Stripe Test (cartes de test)'
                ],
                'pieges_communs' => [
                    'Oublier de multiplier par 100 (Stripe attend des centimes)',
                    'Ne pas verifier la signature du webhook = faille de securite',
                    'Webhook non accessible en local sans Stripe CLI ou tunnel',
                    'Commiter les cles API dans le code (DANGER !)',
                    'Ne pas gerer les cas d\'echec de paiement',
                    'Oublier d\'exclure /webhook/stripe du firewall CSRF',
                    'Ne pas logger les evenements webhook pour debug'
                ],
                'ressources' => [
                    ['label' => 'Stripe Checkout', 'url' => 'https://stripe.com/docs/checkout/quickstart', 'icon' => '💳'],
                    ['label' => 'Stripe PHP SDK', 'url' => 'https://stripe.com/docs/api?lang=php', 'icon' => '🐘'],
                    ['label' => 'Webhooks Stripe', 'url' => 'https://stripe.com/docs/webhooks', 'icon' => '🔔'],
                    ['label' => 'Stripe CLI', 'url' => 'https://stripe.com/docs/stripe-cli', 'icon' => '⌨️'],
                    ['label' => 'Cartes de test', 'url' => 'https://stripe.com/docs/testing#cards', 'icon' => '🧪'],
                    ['label' => 'Securite Webhook', 'url' => 'https://stripe.com/docs/webhooks/signatures', 'icon' => '🔐']
                ]
            ],
        ];
    }
}
