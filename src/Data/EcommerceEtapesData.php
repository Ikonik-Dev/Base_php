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
            // Etape 3 - Catalogue Produits (pagination)
            3 => [
                'description_detaillee' => "Creez l'interface publique avec pagination, filtres et pages de detail pour vos produits.",
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
                        'description' => 'Controleur pour lister les produits avec pagination',
                        'code' => "<?php\nnamespace App\Controller;\n\nuse App\Repository\ProductRepository;\nuse Knp\Component\Pager\PaginatorInterface;\nuse Symfony\Bundle\FrameworkBundle\Controller\AbstractController;\nuse Symfony\Component\HttpFoundation\Request;\nuse Symfony\Component\HttpFoundation\Response;\nuse Symfony\Component\Routing\Attribute\Route;\n\nclass ProductController extends AbstractController\n{\n    #[Route('/products', name: 'app_products')]\n    public function index(\n        ProductRepository \$productRepository,\n        PaginatorInterface \$paginator,\n        Request \$request\n    ): Response {\n        \$query = \$productRepository->createQueryBuilder('p')\n            ->orderBy('p.name', 'ASC')\n            ->getQuery();\n\n        \$pagination = \$paginator->paginate(\n            \$query,\n            \$request->query->getInt('page', 1),\n            12\n        );\n\n        return \$this->render('product/index.html.twig', [\n            'products' => \$pagination,\n        ]);\n    }\n}\n"
                    ],
                    [
                        'path' => 'templates/product/index.html.twig',
                        'description' => 'Template pour afficher la liste des produits avec pagination',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}Nos Produits{% endblock %}\n\n{% block body %}\n<div class='container'>\n    <h1>Catalogue des produits</h1>\n\n    <p>{{ products.getTotalItemCount }} produits disponibles</p>\n\n    <div class='products-grid'>\n        {% for product in products %}\n            <div class='product-card'>\n                <h3>{{ product.name }}</h3>\n                <p>{{ product.description|slice(0, 100) }}...</p>\n                <p class='price'>{{ product.price }} EUR</p>\n                <p>Stock : {{ product.stock }}</p>\n                <a href='{{ path('app_product_show', {id: product.id}) }}' class='btn'>\n                    Voir le produit\n                </a>\n            </div>\n        {% else %}\n            <p>Aucun produit disponible pour le moment.</p>\n        {% endfor %}\n    </div>\n\n    <div class='pagination-wrapper'>\n        {{ knp_pagination_render(products) }}\n    </div>\n</div>\n{% endblock %}\n"
                    ],
                ],
                'checklist' => [
                    "La liste des produits s'affiche correctement",
                    'La pagination fonctionne',
                    "La page detail affiche toutes les informations",
                    "Les images s'affichent (meme en placeholder)"
                ],
                'pieges_communs' => [
                    "Oublier d'injecter Request pour lire le parametre page",
                    "Ne pas configurer correctement le bundle Paginator",
                    "Problemes d'affichage : verifier les chemins des assets"
                ],
                'ressources' => [
                    ['label' => 'Controllers Symfony', 'url' => 'https://symfony.com/doc/current/controller.html', 'icon' => ''],
                    ['label' => 'Twig Templates', 'url' => 'https://twig.symfony.com/', 'icon' => '']
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
                        'description' => 'Stockage du panier en session + hydratation produits',
                        'code' => "<?php\nnamespace App\\Service;\n\nuse App\\Repository\\ProductRepository;\nuse Symfony\\Component\\HttpFoundation\\RequestStack;\n\nclass CartSessionStorage\n{\n    private const CART_KEY = 'cart';\n\n    public function __construct(\n        private RequestStack \\\$requestStack,\n        private ProductRepository \\\$productRepository\n    ) {}\n\n    public function getCart(): array\n    {\n        return \\\$this->requestStack->getSession()->get(self::CART_KEY, []);\n    }\n\n    public function saveCart(array \\\$cart): void\n    {\n        \\\$this->requestStack->getSession()->set(self::CART_KEY, \\\$cart);\n    }\n\n    public function addItem(int \\\$productId, int \\\$quantity = 1): void\n    {\n        \\\$cart = \\\$this->getCart();\n        \\\$cart[\\\$productId] = (\\\$cart[\\\$productId] ?? 0) + \\\$quantity;\n        \\\$this->saveCart(\\\$cart);\n    }\n\n    public function removeItem(int \\\$productId): void\n    {\n        \\\$cart = \\\$this->getCart();\n        unset(\\\$cart[\\\$productId]);\n        \\\$this->saveCart(\\\$cart);\n    }\n\n    public function clear(): void\n    {\n        \\\$this->saveCart([]);\n    }\n\n    public function hydrateProducts(): array\n    {\n        \\\$cart = \\\$this->getCart();\n        if (empty(\\\$cart)) {\n            return [[], []];\n        }\n        \\\$products = \\\$this->productRepository->findBy(['id' => array_keys(\\\$cart)]);\n        return [\\\$cart, \\\$products];\n    }\n}\n"
                    ],
                    [
                        'path' => 'src/Service/CartManager.php',
                        'description' => 'Orchestrateur metier du panier',
                        'code' => "<?php\nnamespace App\\Service;\n\nuse App\\Entity\\Product;\n\nclass CartManager\n{\n    public function __construct(\n        private CartSessionStorage \\\$storage\n    ) {}\n\n    public function add(Product \\\$product, int \\\$quantity = 1): void\n    {\n        \\\$this->storage->addItem(\\\$product->getId(), \\\$quantity);\n    }\n\n    public function remove(int \\\$productId): void\n    {\n        \\\$this->storage->removeItem(\\\$productId);\n    }\n\n    public function clear(): void\n    {\n        \\\$this->storage->clear();\n    }\n\n    public function getCartLines(): array\n    {\n        [\\\$rawCart, \\\$products] = \\\$this->storage->hydrateProducts();\n        \\\$lines = [];\n        foreach (\\\$products as \\\$product) {\n            \\\$qty = \\\$rawCart[\\\$product->getId()] ?? 0;\n            \\\$lines[] = [\n                'product' => \\\$product,\n                'quantity' => \\\$qty,\n                'line_total' => \\\$product->getPrice() * \\\$qty,\n            ];\n        }\n        return \\\$lines;\n    }\n\n    public function getTotal(): float\n    {\n        return array_sum(array_column(\\\$this->getCartLines(), 'line_total'));\n    }\n\n    public function isEmpty(): bool\n    {\n        return empty(\\\$this->storage->getCart());\n    }\n}\n"
                    ],
                    [
                        'path' => 'src/Controller/CartController.php',
                        'description' => 'Controleur du panier (routes + vues)',
                        'code' => "<?php\nnamespace App\\Controller;\n\nuse App\\Entity\\Product;\nuse App\\Service\\CartManager;\nuse Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController;\nuse Symfony\\Component\\HttpFoundation\\Request;\nuse Symfony\\Component\\HttpFoundation\\Response;\nuse Symfony\\Component\\Routing\\Attribute\\Route;\n\n#[Route('/cart')]\nclass CartController extends AbstractController\n{\n    public function __construct(private CartManager \\\$cartManager) {}\n\n    #[Route('', name: 'cart_index')]\n    public function index(): Response\n    {\n        return \\\$this->render('cart/index.html.twig', [\n            'lines' => \\\$this->cartManager->getCartLines(),\n            'total' => \\\$this->cartManager->getTotal(),\n        ]);\n    }\n\n    #[Route('add/{id}', name: 'cart_add', methods: ['POST', 'GET'])]\n    public function add(Product \\\$product, Request \\\$request): Response\n    {\n        \\\$qty = (int) \\\$request->get('qty', 1);\n        \\\$this->cartManager->add(\\\$product, \\\$qty);\n        \\\$this->addFlash('success', \\\$product->getName() . ' ajoute au panier');\n        return \\\$this->redirectToRoute('cart_index');\n    }\n\n    #[Route('remove/{id}', name: 'cart_remove', methods: ['POST', 'GET'])]\n    public function remove(int \\\$id): Response\n    {\n        \\\$this->cartManager->remove(\\\$id);\n        return \\\$this->redirectToRoute('cart_index');\n    }\n}\n"
                    ],
                    [
                        'path' => 'templates/cart/index.html.twig',
                        'description' => 'Vue Twig du panier',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}Mon panier{% endblock %}\n\n{% block body %}\n<div class='container'>\n    <h1>Panier</h1>\n\n    {% for message in app.flashes('success') %}\n        <div class='alert alert-success'>{{ message }}</div>\n    {% endfor %}\n\n    {% if lines is empty %}\n        <p>Votre panier est vide.</p>\n        <a href='{{ path('app_products') }}' class='btn btn-primary'>Voir les produits</a>\n    {% else %}\n        <table class='cart-table'>\n            <thead>\n                <tr>\n                    <th>Produit</th>\n                    <th>Prix unitaire</th>\n                    <th>Quantite</th>\n                    <th>Total ligne</th>\n                    <th></th>\n                </tr>\n            </thead>\n            <tbody>\n                {% for line in lines %}\n                <tr>\n                    <td>{{ line.product.name }}</td>\n                    <td>{{ line.product.price|number_format(2, ',', ' ') }} EUR</td>\n                    <td>{{ line.quantity }}</td>\n                    <td>{{ line.line_total|number_format(2, ',', ' ') }} EUR</td>\n                    <td>\n                        <a href='{{ path('cart_remove', {id: line.product.id}) }}' class='btn btn--secondary btn-sm'>Retirer</a>\n                    </td>\n                </tr>\n                {% endfor %}\n            </tbody>\n        </table>\n\n        <div class='cart-footer'>\n            <div class='cart-total'><strong>Total : {{ total|number_format(2, ',', ' ') }} EUR</strong></div>\n            <a href='{{ path('checkout_address') }}' class='btn btn-primary btn-large'>Passer commande</a>\n        </div>\n    {% endif %}\n</div>\n{% endblock %}\n"
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
                'description_detaillee' => "Mettez en place l'inscription, la connexion et la gestion de profil avec les commandes actuelles.",
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
                ],
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
                        'path' => 'src/Entity/Order.php',
                        'description' => 'Entite Order avec statuts et relations',
                        'code' => "<?php\nnamespace App\\Entity;\n\nuse App\\Repository\\OrderRepository;\nuse Doctrine\\Common\\Collections\\ArrayCollection;\nuse Doctrine\\Common\\Collections\\Collection;\nuse Doctrine\\ORM\\Mapping as ORM;\nuse Symfony\\Component\\Validator\\Constraints as Assert;\n\n#[ORM\\Entity(repositoryClass: OrderRepository::class)]\n#[ORM\\Table(name: '`order`')]\nclass Order\n{\n    public const STATUS_CART = 'cart';\n    public const STATUS_PENDING = 'pending';\n    public const STATUS_PAID = 'paid';\n    public const STATUS_SHIPPED = 'shipped';\n\n    #[ORM\\Id]\n    #[ORM\\GeneratedValue]\n    #[ORM\\Column]\n    private ?int \\\$id = null;\n\n    #[ORM\\Column(length: 32)]\n    private string \\\$status = self::STATUS_CART;\n\n    #[ORM\\Column(type: 'decimal', precision: 10, scale: 2)]\n    private string \\\$total = '0.00';\n\n    #[ORM\\Column]\n    private ?\\DateTimeImmutable \\\$createdAt = null;\n\n    #[ORM\\ManyToOne(targetEntity: User::class)]\n    private ?User \\\$user = null;\n\n    // Champs adresse de livraison\n    #[ORM\\Column(length: 255)]\n    #[Assert\\NotBlank(message: 'Veuillez saisir votre nom')]\n    private ?string \\\$shippingName = null;\n\n    #[ORM\\Column(length: 255)]\n    #[Assert\\NotBlank(message: 'Adresse requise')]\n    private ?string \\\$shippingAddress = null;\n\n    #[ORM\\Column(length: 10)]\n    #[Assert\\NotBlank]\n    #[Assert\\Regex(pattern: '/^[0-9]{5}\\\$/', message: 'Code postal invalide')]\n    private ?string \\\$shippingPostalCode = null;\n\n    #[ORM\\Column(length: 100)]\n    #[Assert\\NotBlank]\n    private ?string \\\$shippingCity = null;\n\n    #[ORM\\OneToMany(targetEntity: OrderItem::class, mappedBy: 'order', cascade: ['persist', 'remove'], orphanRemoval: true)]\n    private Collection \\\$items;\n\n    public function __construct()\n    {\n        \\\$this->items = new ArrayCollection();\n        \\\$this->createdAt = new \\DateTimeImmutable();\n    }\n\n    // Getters/Setters...\n    public function getId(): ?int { return \\\$this->id; }\n    public function getStatus(): string { return \\\$this->status; }\n    public function setStatus(string \\\$status): static { \\\$this->status = \\\$status; return \\\$this; }\n    public function getTotal(): string { return \\\$this->total; }\n    public function setTotal(string \\\$total): static { \\\$this->total = \\\$total; return \\\$this; }\n    public function getItems(): Collection { return \\\$this->items; }\n    public function addItem(OrderItem \\\$item): static { \\\$this->items->add(\\\$item); \\\$item->setOrder(\\\$this); return \\\$this; }\n    public function getShippingName(): ?string { return \\\$this->shippingName; }\n    public function setShippingName(?string \\\$v): static { \\\$this->shippingName = \\\$v; return \\\$this; }\n    public function getShippingAddress(): ?string { return \\\$this->shippingAddress; }\n    public function setShippingAddress(?string \\\$v): static { \\\$this->shippingAddress = \\\$v; return \\\$this; }\n    public function getShippingPostalCode(): ?string { return \\\$this->shippingPostalCode; }\n    public function setShippingPostalCode(?string \\\$v): static { \\\$this->shippingPostalCode = \\\$v; return \\\$this; }\n    public function getShippingCity(): ?string { return \\\$this->shippingCity; }\n    public function setShippingCity(?string \\\$v): static { \\\$this->shippingCity = \\\$v; return \\\$this; }\n    public function getUser(): ?User { return \\\$this->user; }\n    public function setUser(?User \\\$user): static { \\\$this->user = \\\$user; return \\\$this; }\n    public function getCreatedAt(): ?\\DateTimeImmutable { return \\\$this->createdAt; }\n}\n"
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
                        'code' => "<?php\nnamespace App\\Controller;\n\nuse App\\Entity\\Order;\nuse App\\Entity\\OrderItem;\nuse App\\Form\\CheckoutAddressType;\nuse App\\Service\\CartManager;\nuse Doctrine\\ORM\\EntityManagerInterface;\nuse Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController;\nuse Symfony\\Component\\HttpFoundation\\Request;\nuse Symfony\\Component\\HttpFoundation\\Response;\nuse Symfony\\Component\\Routing\\Attribute\\Route;\n\n#[Route('/checkout')]\nclass CheckoutController extends AbstractController\n{\n    public function __construct(\n        private CartManager \\\$cartManager,\n        private EntityManagerInterface \\\$em\n    ) {}\n\n    // Etape 1: Formulaire adresse\n    #[Route('', name: 'checkout_address')]\n    public function address(Request \\\$request): Response\n    {\n        \\\$lines = \\\$this->cartManager->getCartLines();\n        if (empty(\\\$lines)) {\n            \\\$this->addFlash('warning', 'Votre panier est vide.');\n            return \\\$this->redirectToRoute('cart_index');\n        }\n\n        \\\$order = new Order();\n        \\\$form = \\\$this->createForm(CheckoutAddressType::class, \\\$order);\n        \\\$form->handleRequest(\\\$request);\n\n        if (\\\$form->isSubmitted() && \\\$form->isValid()) {\n            // Stocker l'ordre en session pour l'etape suivante\n            \\\$request->getSession()->set('checkout_order', \\\$order);\n            return \\\$this->redirectToRoute('checkout_summary');\n        }\n\n        return \\\$this->render('checkout/address.html.twig', [\n            'form' => \\\$form,\n            'lines' => \\\$lines,\n            'total' => \\\$this->cartManager->getTotal(),\n        ]);\n    }\n\n    // Etape 2: Recapitulatif avant confirmation\n    #[Route('summary', name: 'checkout_summary')]\n    public function summary(Request \\\$request): Response\n    {\n        \\\$order = \\\$request->getSession()->get('checkout_order');\n        if (!\\\$order instanceof Order) {\n            return \\\$this->redirectToRoute('checkout_address');\n        }\n\n        return \\\$this->render('checkout/summary.html.twig', [\n            'order' => \\\$order,\n            'lines' => \\\$this->cartManager->getCartLines(),\n            'total' => \\\$this->cartManager->getTotal(),\n        ]);\n    }\n\n    // Etape 3: Confirmation et enregistrement\n    #[Route('confirm', name: 'checkout_confirm', methods: ['POST'])]\n    public function confirm(Request \\\$request): Response\n    {\n        \\\$order = \\\$request->getSession()->get('checkout_order');\n        if (!\\\$order instanceof Order) {\n            return \\\$this->redirectToRoute('checkout_address');\n        }\n\n        // Remplir les lignes de commande\n        foreach (\\\$this->cartManager->getCartLines() as \\\$line) {\n            \\\$item = new OrderItem();\n            \\\$item->setProduct(\\\$line['product']);\n            \\\$item->setQuantity(\\\$line['quantity']);\n            \\\$item->setUnitPrice((string) \\\$line['product']->getPrice());\n            \\\$order->addItem(\\\$item);\n        }\n\n        \\\$order->setTotal((string) \\\$this->cartManager->getTotal());\n        \\\$order->setStatus(Order::STATUS_PENDING);\n        \\\$order->setUser(\\\$this->getUser());\n\n        \\\$this->em->persist(\\\$order);\n        \\\$this->em->flush();\n\n        // Vider le panier et la session checkout\n        \\\$request->getSession()->remove('checkout_order');\n        // TODO: vider le panier via CartManager\n\n        \\\$this->addFlash('success', 'Commande #' . \\\$order->getId() . ' confirmee !');\n        return \\\$this->redirectToRoute('checkout_success', ['id' => \\\$order->getId()]);\n    }\n\n    #[Route('success/{id}', name: 'checkout_success')]\n    public function success(Order \\\$order): Response\n    {\n        return \\\$this->render('checkout/success.html.twig', ['order' => \\\$order]);\n    }\n}\n"
                    ],
                    [
                        'path' => 'templates/checkout/address.html.twig',
                        'description' => 'Vue formulaire adresse',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}Adresse de livraison{% endblock %}\n\n{% block body %}\n<div class='container checkout-page'>\n    <h1>Etape 1 : Adresse de livraison</h1>\n\n    <div class='checkout-grid'>\n        <div class='checkout-form'>\n            {{ form_start(form) }}\n                {{ form_row(form.shippingName) }}\n                {{ form_row(form.shippingAddress) }}\n                {{ form_row(form.shippingPostalCode) }}\n                {{ form_row(form.shippingCity) }}\n                <button type='submit' class='btn btn-primary'>Continuer</button>\n            {{ form_end(form) }}\n        </div>\n\n        <aside class='checkout-summary'>\n            <h3>Votre panier</h3>\n            <ul>\n            {% for line in lines %}\n                <li>{{ line.product.name }} x{{ line.quantity }} - {{ line.line_total }} EUR</li>\n            {% endfor %}\n            </ul>\n            <p class='total'><strong>Total: {{ total }} EUR</strong></p>\n        </aside>\n    </div>\n</div>\n{% endblock %}\n"
                    ],
                    [
                        'path' => 'templates/checkout/summary.html.twig',
                        'description' => 'Vue recapitulatif avant confirmation',
                        'code' => "{% extends 'base.html.twig' %}\n\n{% block title %}Recapitulatif de commande{% endblock %}\n\n{% block body %}\n<div class='container checkout-page'>\n    <h1>Etape 2 : Recapitulatif</h1>\n\n    <section class='order-address'>\n        <h3>Adresse de livraison</h3>\n        <p>{{ order.shippingName }}<br>\n           {{ order.shippingAddress }}<br>\n           {{ order.shippingPostalCode }} {{ order.shippingCity }}</p>\n        <a href='{{ path('checkout_address') }}' class='btn btn--secondary'>Modifier</a>\n    </section>\n\n    <section class='order-items'>\n        <h3>Articles</h3>\n        <table class='cart-table'>\n            <thead><tr><th>Produit</th><th>Qte</th><th>Prix</th></tr></thead>\n            <tbody>\n            {% for line in lines %}\n                <tr>\n                    <td>{{ line.product.name }}</td>\n                    <td>{{ line.quantity }}</td>\n                    <td>{{ line.line_total }} EUR</td>\n                </tr>\n            {% endfor %}\n            </tbody>\n        </table>\n        <p class='total'><strong>Total: {{ total }} EUR</strong></p>\n    </section>\n\n    <form method='post' action='{{ path('checkout_confirm') }}'>\n        <button type='submit' class='btn btn-primary btn-large'>Confirmer la commande</button>\n    </form>\n</div>\n{% endblock %}\n"
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
        ];
    }
}
