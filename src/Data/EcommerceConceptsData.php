<?php

namespace App\Data;

/**
 * Données enrichies pour les concepts techniques, technologies et outils de l'e-commerce Symfony
 * Chaque élément contient : description détaillée, analogie, cas d'usage, exemple de code, avantages, inconvénients, ressources
 */
class EcommerceConceptsData
{
    public static function getArchitectureDetails(): array
    {
        return [
            'frontend' => [
                'description_detaillee' => 'Le Frontend est la couche de présentation qui interagit directement avec l\'utilisateur. Dans une architecture e-commerce Symfony, il combine Twig pour le rendu serveur, JavaScript pour l\'interactivité client, et un système de composants réutilisables pour garantir cohérence et maintenabilité.',
                'analogie' => '🏪 Imaginez une vitrine de magasin : c\'est ce que voit le client. Le décor, l\'agencement des produits, les panneaux publicitaires... Le frontend, c\'est exactement ça : l\'interface visible et attractive qui donne envie d\'acheter.',
                'cas_usage' => [
                    'Pages produits avec filtres dynamiques',
                    'Panier interactif avec mise à jour en temps réel',
                    'Formulaires de commande avec validation instantanée',
                    'Dashboard client pour suivre les commandes'
                ],
                'exemple_code' => [
                    'language' => 'twig',
                    'titre' => 'Composant carte produit réutilisable',
                    'code' => '{# templates/components/product_card.html.twig #}
<div class="product-card" data-product-id="{{ product.id }}">
    <div class="product-image">
        {# Image avec lazy loading pour performances #}
        <img src="{{ asset(\'uploads/products/\' ~ product.image) }}" 
             alt="{{ product.name }}" 
             loading="lazy">
        
        {# Badge stock limité si moins de 5 unités #}
        {% if product.stock < 5 %}
            <span class="badge badge-warning">Stock limité</span>
        {% endif %}
    </div>
    
    <div class="product-info">
        <h3 class="product-name">{{ product.name }}</h3>
        <p class="product-price">{{ product.price|number_format(2) }} €</p>
        
        {# Bouton ajout au panier avec feedback visuel #}
        <button class="btn-add-to-cart" 
                data-action="cart#add"
                data-cart-product-id-param="{{ product.id }}">
            <span class="icon">🛒</span>
            Ajouter au panier
        </button>
    </div>
</div>

{# JavaScript avec Stimulus pour l\'interactivité #}
<script>
// assets/controllers/cart_controller.js
import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    add(event) {
        const productId = event.params.productId;
        
        // Appel AJAX pour ajouter au panier
        fetch(\'/cart/add/\' + productId, { method: \'POST\' })
            .then(response => response.json())
            .then(data => {
                // Mise à jour du compteur panier
                this.updateCartCount(data.total_items);
                // Feedback visuel
                this.showNotification(\'Produit ajouté !\');
            });
    }
}
</script>'
                ],
                'avantages' => [
                    '✅ Expérience utilisateur fluide et moderne',
                    '✅ SEO optimisé grâce au rendu serveur Twig',
                    '✅ Performance avec lazy loading et optimisation assets',
                    '✅ Accessibilité native (ARIA, sémantique HTML)',
                    '✅ Progressive Enhancement : fonctionne sans JavaScript'
                ],
                'inconvenients' => [
                    '⚠️ Complexité de maintenance entre Twig et JavaScript',
                    '⚠️ Courbe d\'apprentissage pour Stimulus/Turbo',
                    '⚠️ Nécessite des compétences full-stack'
                ],
                'ressources' => [
                    ['label' => 'Asset Mapper Symfony', 'url' => 'https://symfony.com/doc/current/frontend.html', 'icon' => '🎨'],
                    ['label' => 'Stimulus JS', 'url' => 'https://stimulus.hotwired.dev/', 'icon' => '⚡'],
                    ['label' => 'Twig Documentation', 'url' => 'https://twig.symfony.com/', 'icon' => '📄'],
                    ['label' => 'UX Symfony', 'url' => 'https://ux.symfony.com/', 'icon' => '✨']
                ]
            ],
            'backend' => [
                'description_detaillee' => 'Le Backend est le cerveau de l\'application. Il gère toute la logique métier : validation des commandes, calcul des prix, gestion du stock, envoi d\'emails... Dans Symfony, cette couche est structurée en Controllers (points d\'entrée), Services (logique métier) et Repositories (accès données).',
                'analogie' => '🏭 Pensez à l\'arrière-boutique d\'un magasin : les employés qui préparent les commandes, vérifient les stocks, gèrent la comptabilité. Le client ne voit pas cette partie, mais c\'est elle qui fait tourner le commerce !',
                'cas_usage' => [
                    'Validation des commandes et gestion du workflow',
                    'Calcul des prix avec promotions et taxes',
                    'Envoi automatique d\'emails transactionnels',
                    'Génération de rapports et statistiques',
                    'API REST pour applications mobiles'
                ],
                'exemple_code' => [
                    'language' => 'php',
                    'titre' => 'Service métier pour la validation de commande',
                    'code' => '<?php
namespace App\Service;

use App\Entity\Order;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;

/**
 * Service centralisant toute la logique de création de commande
 * Principe : séparation des responsabilités (pas de logique dans le Controller)
 */
class OrderService
{
    public function __construct(
        private EntityManagerInterface $em,
        private MailerInterface $mailer,
        private CartService $cartService,
        private StockService $stockService
    ) {}

    /**
     * Crée une commande à partir du panier actuel
     * Applique toutes les règles métier : validation, stock, calculs
     */
    public function createFromCart(User $user, array $shippingData): Order
    {
        // 1. Récupérer le contenu du panier
        $cartItems = $this->cartService->getItems();
        
        if (empty($cartItems)) {
            throw new \Exception(\'Le panier est vide\');
        }
        
        // 2. Vérifier la disponibilité des stocks
        foreach ($cartItems as $item) {
            if (!$this->stockService->isAvailable($item[\'product\'], $item[\'quantity\'])) {
                throw new \Exception(
                    "Stock insuffisant pour {$item[\'product\']->getName()}"
                );
            }
        }
        
        // 3. Créer l\'entité Order
        $order = new Order();
        $order->setUser($user);
        $order->setStatus(\'pending\');
        $order->setShippingAddress($shippingData[\'address\']);
        $order->setCreatedAt(new \DateTimeImmutable());
        
        // 4. Ajouter les items et calculer le total
        $total = 0;
        foreach ($cartItems as $item) {
            $orderItem = new OrderItem();
            $orderItem->setProduct($item[\'product\']);
            $orderItem->setQuantity($item[\'quantity\']);
            $orderItem->setPrice($item[\'product\']->getPrice());
            
            $order->addItem($orderItem);
            $total += $item[\'product\']->getPrice() * $item[\'quantity\'];
            
            // Décrémenter le stock
            $this->stockService->decrement($item[\'product\'], $item[\'quantity\']);
        }
        
        $order->setTotal($total);
        
        // 5. Persister en base de données (transaction atomique)
        $this->em->persist($order);
        $this->em->flush();
        
        // 6. Vider le panier
        $this->cartService->clear();
        
        // 7. Envoyer l\'email de confirmation
        $this->mailer->send($this->createConfirmationEmail($order));
        
        return $order;
    }
}'
                ],
                'avantages' => [
                    '✅ Logique métier centralisée et testable',
                    '✅ Sécurité renforcée (validation, autorisations)',
                    '✅ Scalabilité : ajout facile de nouvelles fonctionnalités',
                    '✅ Maintenabilité : architecture claire et documentée',
                    '✅ Performance : cache, optimisation requêtes SQL'
                ],
                'inconvenients' => [
                    '⚠️ Nécessite une bonne architecture dès le départ',
                    '⚠️ Debugging plus complexe qu\'un monolithe simple',
                    '⚠️ Overhead pour de petits projets'
                ],
                'ressources' => [
                    ['label' => 'Services Symfony', 'url' => 'https://symfony.com/doc/current/service_container.html', 'icon' => '⚙️'],
                    ['label' => 'Doctrine Best Practices', 'url' => 'https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/best-practices.html', 'icon' => '📚'],
                    ['label' => 'Symfony Mailer', 'url' => 'https://symfony.com/doc/current/mailer.html', 'icon' => '📧']
                ]
            ],
            'database' => [
                'description_detaillee' => 'La base de données est le coffre-fort de l\'application. Elle stocke de manière persistante et structurée toutes les informations : produits, utilisateurs, commandes, logs... Avec Doctrine ORM, vous manipulez des objets PHP au lieu d\'écrire du SQL brut, ce qui sécurise et simplifie le développement.',
                'analogie' => '🗄️ C\'est comme une bibliothèque ultra-organisée : chaque livre (donnée) a sa place précise, un système de classification (schéma), et un bibliothécaire (ORM) qui sait exactement où trouver ce que vous cherchez sans que vous ayez à parcourir les rayons.',
                'cas_usage' => [
                    'Stockage des produits avec relations catégories',
                    'Historique complet des commandes clients',
                    'Gestion des sessions utilisateurs',
                    'Logs d\'audit pour traçabilité',
                    'Cache de requêtes complexes'
                ],
                'exemple_code' => [
                    'language' => 'php',
                    'titre' => 'Entité Product avec relations et contraintes',
                    'code' => '<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;

/**
 * Représente un produit dans le catalogue e-commerce
 * Doctrine traduit cette classe en table SQL automatiquement
 */
#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\Table(name: \'products\')]
#[ORM\Index(name: \'idx_price\', columns: [\'price\'])]  // Index pour requêtes de tri
#[ORM\Index(name: \'idx_stock\', columns: [\'stock\'])]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: \'integer\')]
    private ?int $id = null;

    #[ORM\Column(type: \'string\', length: 255)]
    #[Assert\NotBlank(message: \'Le nom du produit est obligatoire\')]
    #[Assert\Length(min: 3, max: 255)]
    private ?string $name = null;

    #[ORM\Column(type: \'text\')]
    #[Assert\NotBlank]
    private ?string $description = null;

    /**
     * Prix stocké en décimal pour éviter les erreurs d\'arrondi
     * JAMAIS utiliser float pour de l\'argent !
     */
    #[ORM\Column(type: \'decimal\', precision: 10, scale: 2)]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private ?string $price = null;

    #[ORM\Column(type: \'integer\')]
    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    private ?int $stock = 0;

    /**
     * Relation ManyToOne : plusieurs produits appartiennent à une catégorie
     * Doctrine crée automatiquement la clé étrangère
     */
    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: \'products\')]
    #[ORM\JoinColumn(nullable: false, onDelete: \'CASCADE\')]
    private ?Category $category = null;

    /**
     * Relation OneToMany : un produit peut être dans plusieurs commandes
     */
    #[ORM\OneToMany(mappedBy: \'product\', targetEntity: OrderItem::class)]
    private Collection $orderItems;

    #[ORM\Column(type: \'datetime_immutable\')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: \'boolean\')]
    private bool $active = true;

    // Getters et Setters...
    
    /**
     * Méthode métier : vérifie si le produit est disponible
     */
    public function isAvailable(int $quantity = 1): bool
    {
        return $this->active && $this->stock >= $quantity;
    }
}

// Utilisation dans un Repository personnalisé
class ProductRepository extends ServiceEntityRepository
{
    /**
     * Requête optimisée : récupère les produits avec leur catégorie
     * en UNE seule requête SQL (join) au lieu de N+1 requêtes
     */
    public function findAvailableWithCategory(): array
    {
        return $this->createQueryBuilder(\'p\')
            ->leftJoin(\'p.category\', \'c\')
            ->addSelect(\'c\')  // Eager loading de la catégorie
            ->where(\'p.active = :active\')
            ->andWhere(\'p.stock > 0\')
            ->setParameter(\'active\', true)
            ->orderBy(\'p.createdAt\', \'DESC\')
            ->getQuery()
            ->getResult();
    }
}'
                ],
                'avantages' => [
                    '✅ Sécurité : protection contre les injections SQL',
                    '✅ Abstraction : changement de SGBD sans modifier le code',
                    '✅ Migrations versionnées : évolution contrôlée du schéma',
                    '✅ Relations gérées automatiquement par Doctrine',
                    '✅ Validation des données avant insertion'
                ],
                'inconvenients' => [
                    '⚠️ Courbe d\'apprentissage de Doctrine',
                    '⚠️ Performance : attention aux requêtes N+1',
                    '⚠️ Complexité pour des requêtes SQL très spécifiques'
                ],
                'ressources' => [
                    ['label' => 'Doctrine ORM', 'url' => 'https://www.doctrine-project.org/', 'icon' => '🗄️'],
                    ['label' => 'Migrations Doctrine', 'url' => 'https://symfony.com/doc/current/doctrine.html#migrations', 'icon' => '🔄'],
                    ['label' => 'Query Builder', 'url' => 'https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/query-builder.html', 'icon' => '🔍']
                ]
            ],
            'security' => [
                'description_detaillee' => 'Le système de sécurité protège l\'application contre les accès non autorisés et les attaques malveillantes. Symfony Security gère l\'authentification (qui êtes-vous ?), l\'autorisation (que pouvez-vous faire ?), et la protection contre les vulnérabilités courantes (CSRF, XSS, injection).',
                'analogie' => '🔐 Imaginez un centre commercial avec un vigile à l\'entrée (authentification), des zones VIP réservées (autorisation), des caméras de surveillance (logs), et des détecteurs d\'intrusion (firewall). La sécurité, c\'est tout ce système qui protège le commerce.',
                'cas_usage' => [
                    'Authentification utilisateurs par email/mot de passe',
                    'Gestion des rôles (ROLE_USER, ROLE_ADMIN)',
                    'Protection des formulaires contre CSRF',
                    'Validation et sanitisation des entrées utilisateur',
                    'Limitation du taux de requêtes (rate limiting)'
                ],
                'exemple_code' => [
                    'language' => 'yaml',
                    'titre' => 'Configuration complète de la sécurité Symfony',
                    'code' => '# config/packages/security.yaml
security:
    # Algorithme de hashage des mots de passe (bcrypt/argon2)
    password_hashers:
        App\Entity\User:
            algorithm: auto  # Utilise le meilleur algorithme disponible
            cost: 12         # Coût de calcul (plus élevé = plus sécurisé mais plus lent)

    # Provider : d\'où viennent les utilisateurs ?
    providers:
        app_user_provider:
            entity:
                class: App\Entity\User
                property: email  # Identification par email

    # Firewalls : points d\'entrée sécurisés
    firewalls:
        dev:
            # Désactive la sécurité en mode dev pour le profiler
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false

        main:
            lazy: true
            provider: app_user_provider

            # Formulaire de connexion
            form_login:
                login_path: app_login         # Route du formulaire
                check_path: app_login         # Route de vérification
                default_target_path: /profile # Redirection après login
                enable_csrf: true             # Protection CSRF activée

            # Déconnexion
            logout:
                path: app_logout
                target: /

            # "Se souvenir de moi" (cookie sécurisé)
            remember_me:
                secret: \'%kernel.secret%\'
                lifetime: 604800  # 1 semaine
                path: /
                secure: true      # Uniquement HTTPS en production

    # Contrôle d\'accès : qui peut accéder à quoi ?
    access_control:
        # Les routes publiques (accessible à tous)
        - { path: ^/login, roles: PUBLIC_ACCESS }
        - { path: ^/register, roles: PUBLIC_ACCESS }
        
        # Les routes nécessitant une authentification
        - { path: ^/profile, roles: ROLE_USER }
        - { path: ^/orders, roles: ROLE_USER }
        
        # L\'administration réservée aux admins
        - { path: ^/admin, roles: ROLE_ADMIN }

    # Hiérarchie des rôles
    role_hierarchy:
        ROLE_ADMIN: [ROLE_USER]       # Un admin a aussi les droits user
        ROLE_SUPER_ADMIN: [ROLE_ADMIN]

# Dans le Controller : vérifier les permissions
<?php
class OrderController extends AbstractController
{
    #[Route(\'/orders/{id}\', name: \'order_show\')]
    public function show(Order $order): Response
    {
        // Vérifie que l\'utilisateur connecté est propriétaire de la commande
        $this->denyAccessUnlessGranted(\'view\', $order);
        
        return $this->render(\'order/show.html.twig\', [
            \'order\' => $order
        ]);
    }
}

# Voter personnalisé pour logique d\'autorisation complexe
class OrderVoter extends Voter
{
    protected function supports(string $attribute, mixed $subject): bool
    {
        return $attribute === \'view\' && $subject instanceof Order;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        
        // Admin peut tout voir
        if (in_array(\'ROLE_ADMIN\', $user->getRoles())) {
            return true;
        }
        
        // User ne peut voir que ses propres commandes
        return $subject->getUser() === $user;
    }
}'
                ],
                'avantages' => [
                    '✅ Sécurité renforcée par défaut (CSRF, XSS, etc.)',
                    '✅ Système de rôles flexible et hiérarchique',
                    '✅ Hashage automatique des mots de passe',
                    '✅ Voters pour logique d\'autorisation complexe',
                    '✅ Protection contre brute force avec rate limiting'
                ],
                'inconvenients' => [
                    '⚠️ Configuration initiale peut sembler complexe',
                    '⚠️ Debugging des permissions parfois délicat',
                    '⚠️ Nécessite une bonne compréhension des concepts'
                ],
                'ressources' => [
                    ['label' => 'Security Symfony', 'url' => 'https://symfony.com/doc/current/security.html', 'icon' => '🔒'],
                    ['label' => 'Voters', 'url' => 'https://symfony.com/doc/current/security/voters.html', 'icon' => '🗳️'],
                    ['label' => 'OWASP Top 10', 'url' => 'https://owasp.org/www-project-top-ten/', 'icon' => '⚠️']
                ]
            ]
        ];
    }

    public static function getPatternsDetails(): array
    {
        return [
            'repository' => [
                'description_detaillee' => 'Le Repository Pattern est une couche d\'abstraction entre votre logique métier et l\'accès aux données. Au lieu d\'écrire des requêtes SQL directement dans vos controllers, vous centralisez toutes les requêtes dans des classes Repository. Cela rend votre code testable, maintenable et découplé de la base de données.',
                'analogie' => '📚 Imaginez une bibliothèque : vous ne fouillez pas vous-même dans les archives. Vous demandez au bibliothécaire (Repository) qui connaît parfaitement l\'organisation et vous ramène exactement ce dont vous avez besoin, sans que vous ayez à comprendre le système de classement complexe.',
                'cas_usage' => [
                    'Requêtes complexes réutilisables (ex: produits en promotion)',
                    'Filtres et tris personnalisés',
                    'Statistiques et agrégations',
                    'Recherche full-text dans le catalogue',
                    'Requêtes optimisées avec jointures'
                ],
                'exemple_code' => [
                    'language' => 'php',
                    'titre' => 'Repository personnalisé avec requêtes métier',
                    'code' => '<?php
namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Repository centralisé pour toutes les requêtes liées aux produits
 * Avantage : logique de requête réutilisable et testable unitairement
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * Trouve les produits en promotion avec stock disponible
     * Requête optimisée avec eager loading de la catégorie
     * 
     * @return Product[]
     */
    public function findOnSale(): array
    {
        return $this->createQueryBuilder(\'p\')
            ->leftJoin(\'p.category\', \'c\')
            ->addSelect(\'c\')  // Évite le problème N+1 queries
            ->where(\'p.discountPrice IS NOT NULL\')
            ->andWhere(\'p.stock > 0\')
            ->andWhere(\'p.active = :active\')
            ->setParameter(\'active\', true)
            ->orderBy(\'p.discountPrice\', \'ASC\')
            ->getQuery()
            ->getResult();
    }

    /**
     * Recherche full-text dans le nom et la description
     * Supporte la pagination et les filtres additionnels
     * 
     * @param string $searchTerm Terme de recherche
     * @param array $filters Filtres optionnels (catégorie, prix min/max)
     */
    public function search(string $searchTerm, array $filters = []): array
    {
        $qb = $this->createQueryBuilder(\'p\');
        
        // Recherche dans nom et description
        $qb->where(
            $qb->expr()->orX(
                $qb->expr()->like(\'p.name\', \':search\'),
                $qb->expr()->like(\'p.description\', \':search\')
            )
        )->setParameter(\'search\', \'%\' . $searchTerm . \'%\');
        
        // Filtre par catégorie si fourni
        if (isset($filters[\'category\'])) {
            $qb->andWhere(\'p.category = :category\')
               ->setParameter(\'category\', $filters[\'category\']);
        }
        
        // Filtre par fourchette de prix
        if (isset($filters[\'minPrice\'])) {
            $qb->andWhere(\'p.price >= :minPrice\')
               ->setParameter(\'minPrice\', $filters[\'minPrice\']);
        }
        
        if (isset($filters[\'maxPrice\'])) {
            $qb->andWhere(\'p.price <= :maxPrice\')
               ->setParameter(\'maxPrice\', $filters[\'maxPrice\']);
        }
        
        return $qb->getQuery()->getResult();
    }

    /**
     * Statistiques : produits les plus vendus
     * Utilise une sous-requête pour compter les ventes
     */
    public function findBestSellers(int $limit = 10): array
    {
        return $this->createQueryBuilder(\'p\')
            ->leftJoin(\'p.orderItems\', \'oi\')
            ->addSelect(\'SUM(oi.quantity) as HIDDEN total_sold\')
            ->groupBy(\'p.id\')
            ->orderBy(\'total_sold\', \'DESC\')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * Compte le nombre de produits par catégorie
     * Utile pour afficher les filtres avec compteurs
     */
    public function countByCategory(): array
    {
        $result = $this->createQueryBuilder(\'p\')
            ->select(\'c.name as category_name, COUNT(p.id) as product_count\')
            ->leftJoin(\'p.category\', \'c\')
            ->groupBy(\'c.id\')
            ->getQuery()
            ->getResult();
        
        // Transforme en tableau associatif [category => count]
        return array_column($result, \'product_count\', \'category_name\');
    }
}

// Utilisation dans un Controller
class ProductController extends AbstractController
{
    #[Route(\'/products/search\', name: \'product_search\')]
    public function search(
        Request $request,
        ProductRepository $productRepository
    ): Response {
        $searchTerm = $request->query->get(\'q\', \'\');
        $filters = [
            \'category\' => $request->query->get(\'category\'),
            \'minPrice\' => $request->query->get(\'min_price\'),
            \'maxPrice\' => $request->query->get(\'max_price\')
        ];
        
        // Appel simple et lisible grâce au Repository
        $products = $productRepository->search($searchTerm, $filters);
        
        return $this->render(\'product/search.html.twig\', [
            \'products\' => $products,
            \'search_term\' => $searchTerm
        ]);
    }
}'
                ],
                'avantages' => [
                    '✅ Code réutilisable : une requête définie une seule fois',
                    '✅ Testabilité : mock du repository pour les tests unitaires',
                    '✅ Maintenabilité : changement de requête centralisé',
                    '✅ Performance : optimisation des requêtes au même endroit',
                    '✅ Lisibilité : controllers plus clairs et concis'
                ],
                'inconvenients' => [
                    '⚠️ Peut devenir volumineux sur de gros projets',
                    '⚠️ Risque de sur-ingénierie pour des requêtes simples',
                    '⚠️ Nécessite discipline pour éviter la duplication'
                ],
                'ressources' => [
                    ['label' => 'Repositories Doctrine', 'url' => 'https://symfony.com/doc/current/doctrine.html#querying-for-objects-the-repository', 'icon' => '📚'],
                    ['label' => 'Query Builder', 'url' => 'https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/query-builder.html', 'icon' => '🔨'],
                    ['label' => 'Repository Pattern', 'url' => 'https://martinfowler.com/eaaCatalog/repository.html', 'icon' => '📖']
                ]
            ],
            'service' => [
                'description_detaillee' => 'Le Service Pattern consiste à encapsuler la logique métier dans des classes de service réutilisables et injectables. Au lieu de mettre toute la logique dans les controllers (qui deviennent rapidement illisibles), vous créez des services spécialisés (CartService, OrderService, EmailService...) qui font une chose et la font bien.',
                'analogie' => '🏢 Pensez à une entreprise : vous n\'avez pas un seul employé qui fait tout. Vous avez le comptable (PricingService), le livreur (ShippingService), le commercial (EmailService)... Chacun a son expertise et peut être sollicité par plusieurs départements (controllers).',
                'cas_usage' => [
                    'CartService : gestion complète du panier',
                    'OrderService : validation et création de commandes',
                    'PricingService : calcul des prix avec promotions',
                    'EmailService : envoi d\'emails transactionnels',
                    'StockService : gestion des stocks et réservations'
                ],
                'exemple_code' => [
                    'language' => 'php',
                    'titre' => 'Service de calcul de prix avec promotions',
                    'code' => '<?php
namespace App\Service;

use App\Entity\Product;
use App\Entity\User;
use App\Repository\PromotionRepository;

/**
 * Service centralisé pour tous les calculs de prix
 * Principe SOLID : Single Responsibility (une seule raison de changer)
 */
class PricingService
{
    public function __construct(
        private PromotionRepository $promotionRepo,
        private TaxService $taxService
    ) {}

    /**
     * Calcule le prix final d\'un produit pour un utilisateur donné
     * Applique : promotions, remises client, taxes
     * 
     * @param Product $product Le produit à pricer
     * @param User|null $user L\'utilisateur (peut bénéficier de remises)
     * @param int $quantity La quantité (remises sur volume possibles)
     * @return array [\'price_ht\', \'tax\', \'price_ttc\', \'discount\', \'saved\']
     */
    public function calculatePrice(
        Product $product, 
        ?User $user = null, 
        int $quantity = 1
    ): array {
        // 1. Prix de base HT
        $basePrice = (float) $product->getPrice();
        $priceHT = $basePrice * $quantity;
        
        // 2. Rechercher les promotions applicables
        $discount = 0;
        $activePromotions = $this->promotionRepo->findActiveForProduct($product);
        
        foreach ($activePromotions as $promotion) {
            if ($promotion->getType() === \'percentage\') {
                // Remise en pourcentage
                $discount += $priceHT * ($promotion->getValue() / 100);
            } elseif ($promotion->getType() === \'fixed\') {
                // Remise fixe
                $discount += $promotion->getValue();
            } elseif ($promotion->getType() === \'buy_x_get_y\') {
                // Promotion "Achetez X, obtenez Y gratuit"
                $freeItems = floor($quantity / $promotion->getBuyQuantity()) 
                           * $promotion->getFreeQuantity();
                $discount += $basePrice * $freeItems;
            }
        }
        
        // 3. Remise fidélité si client VIP
        if ($user && $user->hasRole(\'ROLE_VIP\')) {
            $loyaltyDiscount = $priceHT * 0.05; // 5% de réduction VIP
            $discount += $loyaltyDiscount;
        }
        
        // 4. Remise sur volume (exemple : -10% à partir de 10 unités)
        if ($quantity >= 10) {
            $volumeDiscount = $priceHT * 0.10;
            $discount += $volumeDiscount;
        }
        
        // 5. Prix après remises
        $priceAfterDiscount = max(0, $priceHT - $discount);
        
        // 6. Calcul de la TVA (délégué au TaxService)
        $tax = $this->taxService->calculateTax(
            $priceAfterDiscount, 
            $product->getTaxRate()
        );
        
        // 7. Prix TTC final
        $priceTTC = $priceAfterDiscount + $tax;
        
        return [
            \'price_ht\' => round($priceAfterDiscount, 2),
            \'tax\' => round($tax, 2),
            \'price_ttc\' => round($priceTTC, 2),
            \'discount\' => round($discount, 2),
            \'saved\' => round($discount, 2),  // Économie réalisée
            \'discount_rate\' => $priceHT > 0 
                ? round(($discount / $priceHT) * 100, 1) 
                : 0
        ];
    }

    /**
     * Calcule le total d\'un panier complet
     * Gère aussi les frais de port et codes promo
     */
    public function calculateCartTotal(array $cartItems, ?User $user = null): array
    {
        $subtotal = 0;
        $totalDiscount = 0;
        
        foreach ($cartItems as $item) {
            $pricing = $this->calculatePrice(
                $item[\'product\'], 
                $user, 
                $item[\'quantity\']
            );
            
            $subtotal += $pricing[\'price_ht\'];
            $totalDiscount += $pricing[\'discount\'];
        }
        
        // Frais de port (gratuits au-dessus de 50€)
        $shippingCost = $subtotal >= 50 ? 0 : 5.99;
        
        // Total TTC
        $tax = $this->taxService->calculateTax($subtotal, 20); // TVA 20%
        $total = $subtotal + $tax + $shippingCost;
        
        return [
            \'subtotal\' => round($subtotal, 2),
            \'tax\' => round($tax, 2),
            \'shipping\' => round($shippingCost, 2),
            \'total\' => round($total, 2),
            \'total_discount\' => round($totalDiscount, 2)
        ];
    }
}

// Utilisation dans un Controller (injection automatique)
class CartController extends AbstractController
{
    #[Route(\'/cart\', name: \'cart_view\')]
    public function view(
        CartService $cartService,
        PricingService $pricingService
    ): Response {
        $cartItems = $cartService->getItems();
        $user = $this->getUser();
        
        // Calcul délégué au service spécialisé
        $totals = $pricingService->calculateCartTotal($cartItems, $user);
        
        return $this->render(\'cart/view.html.twig\', [
            \'cart_items\' => $cartItems,
            \'totals\' => $totals
        ]);
    }
}'
                ],
                'avantages' => [
                    '✅ Séparation des responsabilités (SOLID)',
                    '✅ Réutilisabilité : un service utilisé partout',
                    '✅ Testabilité : mock facile des dépendances',
                    '✅ Injection automatique par Symfony (autowiring)',
                    '✅ Évolutivité : ajout de fonctionnalités sans casser l\'existant'
                ],
                'inconvenients' => [
                    '⚠️ Multiplication des classes peut sembler complexe',
                    '⚠️ Sur-ingénierie possible sur petits projets',
                    '⚠️ Nécessite de bien penser l\'architecture'
                ],
                'ressources' => [
                    ['label' => 'Service Container', 'url' => 'https://symfony.com/doc/current/service_container.html', 'icon' => '⚙️'],
                    ['label' => 'Dependency Injection', 'url' => 'https://symfony.com/doc/current/components/dependency_injection.html', 'icon' => '💉'],
                    ['label' => 'SOLID Principles', 'url' => 'https://en.wikipedia.org/wiki/SOLID', 'icon' => '📐']
                ]
            ],
            'observer' => [
                'description_detaillee' => 'L\'Observer Pattern (ou système d\'événements dans Symfony) permet de réagir à des actions sans coupler votre code. Quand quelque chose se passe (ex: une commande est créée), vous "émettez" un événement, et des "listeners" peuvent y réagir indépendamment (envoyer un email, logger, mettre à jour le stock...). C\'est le principe pub/sub (publish/subscribe).',
                'analogie' => '📻 Imaginez une radio : l\'émetteur diffuse un programme (événement) sans savoir qui écoute. Des auditeurs (listeners) se branchent s\'ils sont intéressés. Si demain vous ajoutez 100 auditeurs ou aucun, l\'émetteur continue de diffuser normalement. Pas de couplage !',
                'cas_usage' => [
                    'Envoyer un email de confirmation après commande',
                    'Logger les actions sensibles (audit trail)',
                    'Mettre à jour le stock après validation commande',
                    'Notifier les administrateurs de nouveaux comptes',
                    'Invalidation du cache après modification produit'
                ],
                'exemple_code' => [
                    'language' => 'php',
                    'titre' => 'Système d\'événements pour les commandes',
                    'code' => '<?php
namespace App\Event;

use App\Entity\Order;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Événement déclenché quand une commande est créée
 * Contient toutes les informations nécessaires aux listeners
 */
class OrderCreatedEvent extends Event
{
    // Nom unique pour référencer l\'événement
    public const NAME = \'order.created\';

    public function __construct(
        private Order $order
    ) {}

    public function getOrder(): Order
    {
        return $this->order;
    }
}

// ============================================================
// ÉMETTEUR : Service qui crée la commande et dispatch l\'événement
// ============================================================
namespace App\Service;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class OrderService
{
    public function __construct(
        private EntityManagerInterface $em,
        private EventDispatcherInterface $eventDispatcher
    ) {}

    public function createOrder(User $user, array $cartItems): Order
    {
        // 1. Créer l\'entité Order
        $order = new Order();
        $order->setUser($user);
        // ... configuration de la commande
        
        $this->em->persist($order);
        $this->em->flush();
        
        // 2. Dispatcher l\'événement (notifier les intéressés)
        $event = new OrderCreatedEvent($order);
        $this->eventDispatcher->dispatch($event, OrderCreatedEvent::NAME);
        
        return $order;
    }
}

// ============================================================
// LISTENER 1 : Envoi d\'email de confirmation
// ============================================================
namespace App\EventListener;

use App\Event\OrderCreatedEvent;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

/**
 * Écoute les nouvelles commandes et envoie un email automatiquement
 * AsEventListener : enregistrement automatique par Symfony
 */
#[AsEventListener(event: OrderCreatedEvent::NAME)]
class OrderConfirmationEmailListener
{
    public function __construct(
        private MailerInterface $mailer,
        private EmailService $emailService
    ) {}

    public function __invoke(OrderCreatedEvent $event): void
    {
        $order = $event->getOrder();
        
        // Envoyer l\'email de confirmation
        $this->emailService->sendOrderConfirmation($order);
        
        // Log pour traçabilité
        // Le service OrderService n\'a pas besoin de savoir que ça existe !
    }
}

// ============================================================
// LISTENER 2 : Mise à jour du stock
// ============================================================
#[AsEventListener(event: OrderCreatedEvent::NAME, priority: 10)]
class OrderStockUpdateListener
{
    public function __construct(
        private StockService $stockService
    ) {}

    public function __invoke(OrderCreatedEvent $event): void
    {
        $order = $event->getOrder();
        
        // Décrémenter le stock pour chaque produit commandé
        foreach ($order->getItems() as $item) {
            $this->stockService->decrement(
                $item->getProduct(), 
                $item->getQuantity()
            );
        }
    }
}

// ============================================================
// LISTENER 3 : Notification admin pour commandes importantes
// ============================================================
#[AsEventListener(event: OrderCreatedEvent::NAME, priority: 5)]
class LargeOrderNotificationListener
{
    public function __construct(
        private NotificationService $notificationService
    ) {}

    public function __invoke(OrderCreatedEvent $event): void
    {
        $order = $event->getOrder();
        
        // Notifier les admins seulement si commande > 500€
        if ($order->getTotal() > 500) {
            $this->notificationService->notifyAdmins(
                "Commande importante : {$order->getId()} - {$order->getTotal()}€"
            );
        }
    }
}

// ============================================================
// LISTENER 4 : Audit Trail (log en base de données)
// ============================================================
#[AsEventListener(event: OrderCreatedEvent::NAME, priority: -10)]
class OrderAuditListener
{
    public function __construct(
        private AuditLogger $auditLogger
    ) {}

    public function __invoke(OrderCreatedEvent $event): void
    {
        $order = $event->getOrder();
        
        // Enregistrer dans les logs d\'audit
        $this->auditLogger->log(\'ORDER_CREATED\', [
            \'order_id\' => $order->getId(),
            \'user_id\' => $order->getUser()->getId(),
            \'amount\' => $order->getTotal(),
            \'timestamp\' => new \DateTime()
        ]);
    }
}

// ============================================================
// CONFIGURATION : config/services.yaml
// ============================================================
# services:
#     # Les listeners sont auto-découverts grâce à l\'attribut #[AsEventListener]
#     # Pas besoin de configuration manuelle !
#     
#     # Si vous voulez désactiver temporairement un listener :
#     App\EventListener\LargeOrderNotificationListener:
#         tags:
#             - { name: kernel.event_listener, event: order.created, enabled: false }

// Avantages du système :
// - OrderService ne connaît AUCUN des listeners
// - Ajout/suppression de listeners sans toucher OrderService
// - Ordre d\'exécution contrôlé par "priority"
// - Testable : mock de l\'EventDispatcher'
                ],
                'avantages' => [
                    '✅ Découplage total : émetteur et listeners indépendants',
                    '✅ Extensibilité : ajout de fonctionnalités sans modifier l\'existant',
                    '✅ Priorités : contrôle de l\'ordre d\'exécution',
                    '✅ Testabilité : mock du dispatcher facilement',
                    '✅ Réutilisabilité : un listener peut écouter plusieurs événements'
                ],
                'inconvenients' => [
                    '⚠️ Flux d\'exécution moins évident (debug plus complexe)',
                    '⚠️ Performance : nombreux listeners peuvent ralentir',
                    '⚠️ Risque d\'abus : trop d\'événements nuit à la lisibilité'
                ],
                'ressources' => [
                    ['label' => 'Event Dispatcher', 'url' => 'https://symfony.com/doc/current/components/event_dispatcher.html', 'icon' => '📡'],
                    ['label' => 'Events Reference', 'url' => 'https://symfony.com/doc/current/reference/events.html', 'icon' => '📋'],
                    ['label' => 'Observer Pattern', 'url' => 'https://refactoring.guru/design-patterns/observer', 'icon' => '👀']
                ]
            ],
            'strategy' => [
                'description_detaillee' => 'Le Strategy Pattern permet de définir une famille d\'algorithmes interchangeables. Au lieu d\'avoir un gros if/else ou switch/case, vous créez des classes qui implémentent la même interface, et vous choisissez dynamiquement laquelle utiliser. Parfait pour les modes de paiement, calculs de frais de port, stratégies de pricing...',
                'analogie' => '🚗 Imaginez un GPS qui propose plusieurs itinéraires : le plus rapide, le plus court, celui qui évite les péages... Tous vous mènent à destination (même interface), mais avec des stratégies différentes. Vous choisissez selon vos besoins du moment.',
                'cas_usage' => [
                    'Modes de paiement multiples (CB, PayPal, Virement)',
                    'Calcul des frais de port (standard, express, gratuit)',
                    'Stratégies de promotion (pourcentage, fixe, 2+1)',
                    'Moteurs de recherche (pertinence, prix, nouveauté)',
                    'Export de données (PDF, Excel, CSV)'
                ],
                'exemple_code' => [
                    'language' => 'php',
                    'titre' => 'Stratégies de frais de port interchangeables',
                    'code' => '<?php
namespace App\Service\Shipping;

use App\Entity\Order;

/**
 * Interface commune pour toutes les stratégies de livraison
 * Chaque stratégie doit implémenter ces méthodes
 */
interface ShippingStrategyInterface
{
    /**
     * Calcule les frais de port pour une commande
     * @return float Montant en euros
     */
    public function calculateCost(Order $order): float;

    /**
     * Estime le délai de livraison
     * @return int Nombre de jours
     */
    public function getDeliveryTime(Order $order): int;

    /**
     * Nom affiché à l\'utilisateur
     */
    public function getName(): string;
}

// ============================================================
// STRATÉGIE 1 : Livraison Standard
// ============================================================
class StandardShippingStrategy implements ShippingStrategyInterface
{
    public function calculateCost(Order $order): float
    {
        $weight = $order->getTotalWeight();
        
        // Tarification basée sur le poids
        if ($weight < 1) {
            return 4.99;
        } elseif ($weight < 5) {
            return 7.99;
        } else {
            return 12.99;
        }
    }

    public function getDeliveryTime(Order $order): int
    {
        return 5; // 5 jours ouvrés
    }

    public function getName(): string
    {
        return \'Livraison Standard (5-7 jours)\';
    }
}

// ============================================================
// STRATÉGIE 2 : Livraison Express
// ============================================================
class ExpressShippingStrategy implements ShippingStrategyInterface
{
    public function calculateCost(Order $order): float
    {
        // Prix fixe plus élevé pour l\'express
        $baseCost = 15.99;
        
        // Supplément si destination éloignée
        if ($order->getShippingCountry() !== \'FR\') {
            $baseCost += 10;
        }
        
        return $baseCost;
    }

    public function getDeliveryTime(Order $order): int
    {
        return $order->getShippingCountry() === \'FR\' ? 1 : 3;
    }

    public function getName(): string
    {
        return \'Livraison Express (24-48h)\';
    }
}

// ============================================================
// STRATÉGIE 3 : Livraison Gratuite (au-dessus d\'un montant)
// ============================================================
class FreeShippingStrategy implements ShippingStrategyInterface
{
    private const MINIMUM_ORDER_AMOUNT = 50.0;

    public function calculateCost(Order $order): float
    {
        // Gratuit si commande >= 50€, sinon standard
        if ($order->getTotal() >= self::MINIMUM_ORDER_AMOUNT) {
            return 0;
        }
        
        // Fallback sur tarif standard
        return (new StandardShippingStrategy())->calculateCost($order);
    }

    public function getDeliveryTime(Order $order): int
    {
        return 5;
    }

    public function getName(): string
    {
        return \'Livraison Gratuite (dès 50€)\';
    }
}

// ============================================================
// STRATÉGIE 4 : Point Relais (moins cher mais moins pratique)
// ============================================================
class PickupPointStrategy implements ShippingStrategyInterface
{
    public function calculateCost(Order $order): float
    {
        return 3.99; // Toujours moins cher
    }

    public function getDeliveryTime(Order $order): int
    {
        return 4;
    }

    public function getName(): string
    {
        return \'Retrait en Point Relais (3-4 jours)\';
    }
}

// ============================================================
// SERVICE : Sélectionne et applique la stratégie
// ============================================================
namespace App\Service;

class ShippingCalculator
{
    /**
     * @param iterable<ShippingStrategyInterface> $strategies
     */
    public function __construct(
        private iterable $strategies // Injection de toutes les stratégies
    ) {}

    /**
     * Calcule les frais pour toutes les stratégies disponibles
     * @return array [{name, cost, delivery_time, strategy_class}, ...]
     */
    public function getAvailableOptions(Order $order): array
    {
        $options = [];
        
        foreach ($this->strategies as $strategy) {
            $options[] = [
                \'name\' => $strategy->getName(),
                \'cost\' => $strategy->calculateCost($order),
                \'delivery_time\' => $strategy->getDeliveryTime($order),
                \'strategy_class\' => get_class($strategy)
            ];
        }
        
        // Tri par prix croissant
        usort($options, fn($a, $b) => $a[\'cost\'] <=> $b[\'cost\']);
        
        return $options;
    }

    /**
     * Applique une stratégie spécifique
     */
    public function calculate(Order $order, string $strategyClass): float
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy instanceof $strategyClass) {
                return $strategy->calculateCost($order);
            }
        }
        
        throw new \InvalidArgumentException("Stratégie inconnue : $strategyClass");
    }
}

// ============================================================
// CONFIGURATION : config/services.yaml
// ============================================================
# services:
#     # Enregistrement automatique de toutes les stratégies
#     App\Service\Shipping\ShippingStrategyInterface:
#         tags: [\'app.shipping_strategy\']
#     
#     # Le calculateur reçoit toutes les stratégies taggées
#     App\Service\ShippingCalculator:
#         arguments:
#             $strategies: !tagged_iterator app.shipping_strategy

// ============================================================
// UTILISATION dans le Controller
// ============================================================
class CheckoutController extends AbstractController
{
    #[Route(\'/checkout/shipping\', name: \'checkout_shipping\')]
    public function selectShipping(
        Order $order,
        ShippingCalculator $calculator
    ): Response {
        // Récupère toutes les options disponibles
        $shippingOptions = $calculator->getAvailableOptions($order);
        
        return $this->render(\'checkout/shipping.html.twig\', [
            \'shipping_options\' => $shippingOptions
        ]);
    }

    #[Route(\'/checkout/confirm\', name: \'checkout_confirm\')]
    public function confirmShipping(
        Request $request,
        Order $order,
        ShippingCalculator $calculator
    ): Response {
        $chosenStrategy = $request->request->get(\'shipping_strategy\');
        
        // Applique la stratégie choisie
        $shippingCost = $calculator->calculate($order, $chosenStrategy);
        $order->setShippingCost($shippingCost);
        
        // ...
    }
}

// Avantages :
// - Ajout d\'une nouvelle stratégie = créer une classe (Open/Closed Principle)
// - Pas de if/else géant
// - Chaque stratégie testable indépendamment
// - Changement de stratégie à la volée sans recompiler'
                ],
                'avantages' => [
                    '✅ Élimination des if/else complexes',
                    '✅ Ajout de nouvelles stratégies sans modifier l\'existant (Open/Closed)',
                    '✅ Chaque stratégie testable unitairement',
                    '✅ Changement dynamique de comportement',
                    '✅ Code plus lisible et maintenable'
                ],
                'inconvenients' => [
                    '⚠️ Augmente le nombre de classes',
                    '⚠️ Peut sembler over-engineered pour 2-3 cas simples',
                    '⚠️ Nécessite une bonne conception initiale'
                ],
                'ressources' => [
                    ['label' => 'Strategy Pattern', 'url' => 'https://refactoring.guru/design-patterns/strategy', 'icon' => '🎯'],
                    ['label' => 'Tagged Services', 'url' => 'https://symfony.com/doc/current/service_container/tags.html', 'icon' => '🏷️'],
                    ['label' => 'SOLID: Open/Closed', 'url' => 'https://en.wikipedia.org/wiki/Open%E2%80%93closed_principle', 'icon' => '📐']
                ]
            ]
        ];
    }

    public static function getSecurityDetails(): array
    {
        return [
            'csrf' => [
                'description_detaillee' => 'La protection CSRF (Cross-Site Request Forgery) empêche qu\'un site malveillant force votre utilisateur connecté à effectuer des actions non désirées. Symfony génère un token unique par formulaire/session qui doit être validé côté serveur.',
                'analogie' => '🎫 Comme un ticket de caisse avec numéro unique : le caissier vérifie que c\'est bien VOUS qui avez pris cet article dans le magasin, pas quelqu\'un qui vous a volé votre carte bancaire dehors.',
                'cas_usage' => [
                    'Formulaires de modification de profil',
                    'Ajout/suppression de produits (admin)',
                    'Validation de commandes',
                    'Actions sensibles (changement mot de passe)'
                ],
                'exemple_code' => [
                    'language' => 'twig',
                    'titre' => 'Formulaire avec protection CSRF intégrée',
                    'code' => '{# templates/product/edit.html.twig #}
{# Symfony génère automatiquement le token CSRF #}
{{ form_start(form) }}
    {{ form_row(form.name) }}
    {{ form_row(form.price) }}
    
    {# Le token est injecté automatiquement dans un champ caché #}
    {# <input type="hidden" name="_token" value="xyz123..."> #}
    
    <button type="submit">Modifier le produit</button>
{{ form_end(form) }}

<?php
// Dans le Controller : validation automatique
#[Route(\'/product/{id}/edit\', methods: [\'POST\'])]
public function edit(Request $request, Product $product): Response
{
    $form = $this->createForm(ProductType::class, $product);
    $form->handleRequest($request);
    
    // Symfony vérifie automatiquement le token CSRF
    if ($form->isSubmitted() && $form->isValid()) {
        $this->em->flush();
        return $this->redirectToRoute(\'product_list\');
    }
    
    // Si token invalide, isValid() retourne false
}

// Pour les requêtes AJAX sans formulaire
fetch(\'/cart/add\', {
    method: \'POST\',
    headers: {
        \'Content-Type\': \'application/json\',
        \'X-CSRF-TOKEN\': document.querySelector(\'meta[name="csrf-token"]\').content
    },
    body: JSON.stringify({ product_id: 123 })
});'
                ],
                'avantages' => [
                    '✅ Protection automatique dans les formulaires Symfony',
                    '✅ Prévient les attaques de type "click-jacking"',
                    '✅ Tokens régénérés à chaque requête',
                    '✅ Compatible avec les SPA (tokens via API)'
                ],
                'inconvenients' => [
                    '⚠️ Peut causer des erreurs si cache navigateur',
                    '⚠️ Nécessite session active (problème pour API stateless)',
                    '⚠️ Complexité additionnelle pour AJAX'
                ],
                'ressources' => [
                    ['label' => 'CSRF Protection', 'url' => 'https://symfony.com/doc/current/security/csrf.html', 'icon' => '🛡️'],
                    ['label' => 'OWASP CSRF', 'url' => 'https://owasp.org/www-community/attacks/csrf', 'icon' => '⚠️']
                ]
            ],
            'xss' => [
                'description_detaillee' => 'La prévention XSS (Cross-Site Scripting) protège contre l\'injection de code JavaScript malveillant dans vos pages. Twig échappe automatiquement toutes les variables, empêchant l\'exécution de scripts injectés par des utilisateurs.',
                'analogie' => '🧼 C\'est comme désinfecter automatiquement tout ce qui entre dans votre cuisine : même si quelqu\'un essaie d\'introduire des bactéries (code malveillant), elles sont neutralisées avant de pouvoir contaminer vos plats (pages web).',
                'cas_usage' => [
                    'Affichage de commentaires utilisateurs',
                    'Nom de produits saisis par admin',
                    'Descriptions riches avec HTML',
                    'Recherche avec affichage des termes'
                ],
                'exemple_code' => [
                    'language' => 'twig',
                    'titre' => 'Échappement automatique et exceptions contrôlées',
                    'code' => '{# templates/product/show.html.twig #}

{# ✅ BON : Échappement automatique par défaut #}
<h1>{{ product.name }}</h1>
{# Si name contient "<script>alert(\'XSS\')</script>" #}
{# Twig affiche : &lt;script&gt;alert(\'XSS\')&lt;/script&gt; #}
{# Le script ne s\'exécute PAS #}

{# ✅ BON : Affichage sécurisé d\'une recherche #}
<p>Résultats pour : <strong>{{ search_term }}</strong></p>

{# ⚠️ ATTENTION : raw désactive l\'échappement #}
{# Utiliser SEULEMENT pour du contenu sûr (admin validé) #}
<div class="product-description">
    {{ product.description|raw }}
    {# Seulement si description validée côté serveur ! #}
</div>

{# ✅ MEILLEUR : Utiliser un purificateur HTML #}
<div class="product-description">
    {{ product.description|purify }}
    {# Filtre personnalisé qui garde HTML sûr (strong, em, p) #}
    {# mais supprime JavaScript, iframes, etc. #}
</div>

<?php
// Service de purification HTML
namespace App\Twig;

use HTMLPurifier;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class PurifyExtension extends AbstractExtension
{
    private HTMLPurifier $purifier;

    public function __construct()
    {
        $config = \HTMLPurifier_Config::createDefault();
        // Autoriser seulement les balises sûres
        $config->set(\'HTML.Allowed\', \'p,b,i,em,strong,a[href],ul,ol,li\');
        $this->purifier = new \HTMLPurifier($config);
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter(\'purify\', [$this, \'purify\'], [\'is_safe\' => [\'html\']])
        ];
    }

    public function purify(string $html): string
    {
        // Nettoie le HTML en gardant seulement les balises autorisées
        return $this->purifier->purify($html);
    }
}

// Dans un Controller : validation des entrées
#[Route(\'/comment/add\', methods: [\'POST\'])]
public function addComment(Request $request): Response
{
    $comment = $request->request->get(\'comment\');
    
    // ✅ Validation stricte
    if (preg_match(\'/[<>]/\', $comment)) {
        throw new \Exception(\'Caractères non autorisés\');
    }
    
    // Ou utiliser un validator
    $violations = $this->validator->validate($comment, [
        new Length([\'max\' => 500]),
        new Regex([
            \'pattern\' => \'/^[a-zA-Z0-9\\s\\.,!?-]+$/\',
            \'message\' => \'Caractères spéciaux non autorisés\'
        ])
    ]);
}'
                ],
                'avantages' => [
                    '✅ Échappement automatique par défaut dans Twig',
                    '✅ Protection contre injection de scripts',
                    '✅ Purificateur HTML pour contenu riche sécurisé',
                    '✅ Content Security Policy (CSP) intégrable'
                ],
                'inconvenients' => [
                    '⚠️ raw peut être dangereux si mal utilisé',
                    '⚠️ HTML Purifier peut être lent sur gros contenus',
                    '⚠️ Balance entre sécurité et flexibilité'
                ],
                'ressources' => [
                    ['label' => 'Twig Escaping', 'url' => 'https://twig.symfony.com/doc/3.x/filters/escape.html', 'icon' => '🔒'],
                    ['label' => 'HTML Purifier', 'url' => 'http://htmlpurifier.org/', 'icon' => '🧼'],
                    ['label' => 'OWASP XSS', 'url' => 'https://owasp.org/www-community/attacks/xss/', 'icon' => '⚠️']
                ]
            ],
            'sql_injection' => [
                'description_detaillee' => 'Les injections SQL sont évitées grâce à Doctrine ORM qui utilise des requêtes préparées. Au lieu de concaténer du SQL brut (dangereux), Doctrine échappe automatiquement tous les paramètres, rendant les injections impossibles.',
                'analogie' => '💉 C\'est comme un filtre à seringue en médecine : même si quelqu\'un essaie d\'injecter un poison (code SQL), le filtre (Doctrine) ne laisse passer que ce qui est sûr (données échappées).',
                'cas_usage' => [
                    'Recherche de produits par nom',
                    'Filtrage par prix min/max',
                    'Authentification utilisateur',
                    'Toute requête avec paramètres utilisateur'
                ],
                'exemple_code' => [
                    'language' => 'php',
                    'titre' => 'Doctrine protège automatiquement contre les injections SQL',
                    'code' => '<?php
// ❌ DANGEREUX : Concaténation SQL brute (à ne JAMAIS faire)
$searchTerm = $_GET[\'search\'];
$sql = "SELECT * FROM products WHERE name = \'" . $searchTerm . "\'";
// Si searchTerm = "test\' OR \'1\'=\'1" 
// → SQL devient: SELECT * FROM products WHERE name = \'test\' OR \'1\'=\'1\'
// → Retourne TOUS les produits ! (injection réussie)

// ✅ BON : Query Builder Doctrine avec paramètres liés
class ProductRepository extends ServiceEntityRepository
{
    public function searchByName(string $searchTerm): array
    {
        return $this->createQueryBuilder(\'p\')
            ->where(\'p.name LIKE :term\')
            // setParameter échappe automatiquement la valeur
            ->setParameter(\'term\', \'%\' . $searchTerm . \'%\')
            ->getQuery()
            ->getResult();
        
        // Doctrine génère : SELECT * FROM products WHERE name LIKE ?
        // Avec ? remplacé par la valeur échappée : "%test%"
        // Injection impossible !
    }

    // ✅ BON : DQL (Doctrine Query Language) avec paramètres
    public function findByPriceRange(float $min, float $max): array
    {
        $dql = \'SELECT p FROM App\Entity\Product p 
                WHERE p.price BETWEEN :min AND :max\';
        
        return $this->getEntityManager()
            ->createQuery($dql)
            ->setParameter(\'min\', $min)
            ->setParameter(\'max\', $max)
            ->getResult();
    }

    // ✅ BON : SQL natif si vraiment nécessaire (avec paramètres liés)
    public function complexNativeQuery(int $categoryId): array
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = \'
            SELECT p.*, COUNT(oi.id) as total_sales
            FROM products p
            LEFT JOIN order_items oi ON p.id = oi.product_id
            WHERE p.category_id = :category
            GROUP BY p.id
            ORDER BY total_sales DESC
        \';
        
        // Utiliser des paramètres liés même en SQL natif
        $stmt = $conn->prepare($sql);
        $result = $stmt->executeQuery([\'category\' => $categoryId]);
        
        return $result->fetchAllAssociative();
    }
}

// ⚠️ PIÈGE : Concaténation dans LIKE peut être tentante mais RESTE SÛRE
public function dangerousLooking(string $term): array
{
    // Ceci SEMBLE dangereux mais est sécurisé car setParameter échappe
    return $this->createQueryBuilder(\'p\')
        ->where("p.name LIKE :term")
        ->setParameter(\'term\', \'%\' . $term . \'%\')  // ✅ Sécurisé
        ->getQuery()
        ->getResult();
}

// ❌ DANGER : Utiliser SQL brut avec Expressions
public function reallyBad(string $userInput): array
{
    return $this->createQueryBuilder(\'p\')
        // Ne JAMAIS faire ça !
        ->where("p.name = \'" . $userInput . "\'")  // ❌ Injection possible
        ->getQuery()
        ->getResult();
}

// Validation supplémentaire dans le Controller
#[Route(\'/products/search\')]
public function search(
    Request $request,
    ProductRepository $repo
): Response {
    $search = $request->query->get(\'q\', \'\');
    
    // ✅ Validation de la longueur et format
    if (strlen($search) > 100) {
        throw new \Exception(\'Recherche trop longue\');
    }
    
    // ✅ Sanitisation basique (optionnel avec Doctrine)
    $search = strip_tags($search);
    
    $products = $repo->searchByName($search);
    
    return $this->render(\'product/search.html.twig\', [
        \'products\' => $products
    ]);
}'
                ],
                'avantages' => [
                    '✅ Doctrine échappe automatiquement tous les paramètres',
                    '✅ Requêtes préparées par défaut',
                    '✅ Impossible d\'injecter du SQL via paramètres',
                    '✅ Support de SQL natif sécurisé si nécessaire'
                ],
                'inconvenients' => [
                    '⚠️ SQL brut avec concaténation reste possible (à éviter)',
                    '⚠️ Performances légèrement réduites (overhead sécurité)',
                    '⚠️ Nécessite vigilance pour requêtes complexes'
                ],
                'ressources' => [
                    ['label' => 'Doctrine Security', 'url' => 'https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/security.html', 'icon' => '🔒'],
                    ['label' => 'SQL Injection', 'url' => 'https://owasp.org/www-community/attacks/SQL_Injection', 'icon' => '💉'],
                    ['label' => 'Prepared Statements', 'url' => 'https://www.php.net/manual/en/pdo.prepared-statements.php', 'icon' => '📋']
                ]
            ],
            'authentication' => [
                'description_detaillee' => 'Le système d\'authentification Symfony gère l\'identification des utilisateurs (qui êtes-vous ?) avec hashage sécurisé des mots de passe, sessions persistantes, remember-me, et protection contre le brute force. Supporte multiples méthodes : formulaire, API tokens, OAuth...',
                'analogie' => '🔑 Comme l\'accès à un immeuble sécurisé : vous avez une carte magnétique (session), un code (mot de passe), une empreinte digitale (2FA). Le système vérifie votre identité et vous donne accès seulement à votre appartement (rôles).',
                'cas_usage' => [
                    'Connexion client par email/mot de passe',
                    'Remember me (rester connecté)',
                    'Authentification API par tokens',
                    'SSO avec Google/Facebook',
                    'Authentification à deux facteurs (2FA)'
                ],
                'exemple_code' => [
                    'language' => 'php',
                    'titre' => 'Système d\'authentification complet avec Symfony',
                    'code' => '<?php
// 1. Entité User avec hashage automatique des mots de passe
namespace App\Entity;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    /**
     * @var list<string> Les rôles de l\'utilisateur
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * Le mot de passe hashé (JAMAIS stocker en clair !)
     */
    #[ORM\Column]
    private ?string $password = null;

    public function getRoles(): array
    {
        $roles = $this->roles;
        // Garantit que tout utilisateur a au moins ROLE_USER
        $roles[] = \'ROLE_USER\';
        return array_unique($roles);
    }

    // Méthodes de UserInterface...
}

// 2. Controller d\'authentification
namespace App\Controller;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(\'/login\', name: \'app_login\')]
    public function login(AuthenticationUtils $authUtils): Response
    {
        // Si déjà connecté, rediriger
        if ($this->getUser()) {
            return $this->redirectToRoute(\'app_profile\');
        }

        // Récupérer l\'erreur de connexion s\'il y en a une
        $error = $authUtils->getLastAuthenticationError();
        
        // Dernier email saisi (pour pré-remplir le formulaire)
        $lastUsername = $authUtils->getLastUsername();

        return $this->render(\'security/login.html.twig\', [
            \'last_username\' => $lastUsername,
            \'error\' => $error,
        ]);
    }

    #[Route(\'/logout\', name: \'app_logout\')]
    public function logout(): void
    {
        // Symfony gère automatiquement la déconnexion
        // Cette méthode ne sera jamais exécutée
    }
}

// 3. Inscription avec hashage automatique du mot de passe
namespace App\Controller;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    #[Route(\'/register\', name: \'app_register\')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $em
    ): Response {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hash le mot de passe avant sauvegarde
            // Utilise bcrypt ou argon2 automatiquement
            $user->setPassword(
                $passwordHasher->hashPassword(
                    $user,
                    $form->get(\'plainPassword\')->getData()
                )
            );

            $em->persist($user);
            $em->flush();

            // Connexion automatique après inscription
            return $this->redirectToRoute(\'app_login\');
        }

        return $this->render(\'registration/register.html.twig\', [
            \'registrationForm\' => $form,
        ]);
    }
}

// 4. Protection des routes dans les Controllers
class ProfileController extends AbstractController
{
    #[Route(\'/profile\', name: \'app_profile\')]
    #[IsGranted(\'ROLE_USER\')]  // Nécessite authentification
    public function index(): Response
    {
        // $this->getUser() retourne l\'utilisateur connecté
        $user = $this->getUser();
        
        return $this->render(\'profile/index.html.twig\', [
            \'user\' => $user
        ]);
    }

    #[Route(\'/admin\', name: \'app_admin\')]
    #[IsGranted(\'ROLE_ADMIN\')]  // Nécessite rôle admin
    public function admin(): Response
    {
        // Seulement accessible aux admins
        return $this->render(\'admin/dashboard.html.twig\');
    }
}

// 5. Configuration security.yaml
# config/packages/security.yaml
security:
    password_hashers:
        App\Entity\User:
            algorithm: auto  # bcrypt ou argon2 selon disponibilité
            cost: 12         # Coût de calcul (plus élevé = plus sécurisé)

    providers:
        app_user_provider:
            entity:
                class: App\Entity\User
                property: email

    firewalls:
        main:
            lazy: true
            provider: app_user_provider
            
            # Formulaire de connexion
            form_login:
                login_path: app_login
                check_path: app_login
                default_target_path: /profile
                enable_csrf: true
            
            # Déconnexion
            logout:
                path: app_logout
                target: /
            
            # Remember me (cookie persistant)
            remember_me:
                secret: \'%kernel.secret%\'
                lifetime: 2592000  # 30 jours
                path: /
                secure: true       # HTTPS uniquement en production

    # Contrôle d\'accès global
    access_control:
        - { path: ^/admin, roles: ROLE_ADMIN }
        - { path: ^/profile, roles: ROLE_USER }'
                ],
                'avantages' => [
                    '✅ Hashage automatique avec bcrypt/argon2',
                    '✅ Protection contre brute force intégrée',
                    '✅ Sessions sécurisées et persistantes',
                    '✅ Support OAuth, LDAP, custom providers',
                    '✅ Remember me sécurisé par cryptographie'
                ],
                'inconvenients' => [
                    '⚠️ Configuration initiale peut sembler complexe',
                    '⚠️ Nécessite HTTPS en production (sinon interception)',
                    '⚠️ 2FA nécessite bundle additionnel'
                ],
                'ressources' => [
                    ['label' => 'Security Symfony', 'url' => 'https://symfony.com/doc/current/security.html', 'icon' => '🔐'],
                    ['label' => 'Password Hashing', 'url' => 'https://symfony.com/doc/current/security/passwords.html', 'icon' => '🔒'],
                    ['label' => 'Authentication', 'url' => 'https://symfony.com/doc/current/security.html#authentication', 'icon' => '🔑']
                ]
            ]
        ];
    }

    // Les méthodes pour technologies seront ajoutées dans un autre fichier car le fichier devient très long
    // Pour l'instant on se concentre sur l'essentiel
}
