<?php

namespace App\Data;

class EcommerceEtapesData
{
    public static function getModalDetails(): array
    {
        return [
            // Étape 3 - Catalogue Produits
            3 => [
                'description_detaillee' => 'Créez l\'interface publique qui permet aux visiteurs de parcourir vos produits. Vous implémenterez la pagination, les filtres et les pages de détail.',
                'commandes' => [
                    [
                        'titre' => 'Création du contrôleur',
                        'code' => 'php bin/console make:controller ProductController',
                        'explication' => 'Génère le contrôleur pour gérer l\'affichage des produits'
                    ],
                    [
                        'titre' => 'Installation de Paginator',
                        'code' => 'composer require knplabs/knp-paginator-bundle',
                        'explication' => 'Ajoute la pagination automatique pour vos listes'
                    ]
                ],
                'fichiers_a_creer' => [
                    [
                        'path' => 'src/Controller/ProductController.php',
                        'description' => 'Contrôleur pour gérer les produits',
                        'code' => '<?php
namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Knp\Component\Pager\PaginatorInterface;

class ProductController extends AbstractController
{
    #[Route(\'/products\', name: \'app_products\')]
    public function index(
        ProductRepository $productRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $query = $productRepository->createQueryBuilder(\'p\')
            ->orderBy(\'p.name\', \'ASC\')
            ->getQuery();
        
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt(\'page\', 1),
            12
        );
        
        return $this->render(\'product/index.html.twig\', [
            \'products\' => $pagination,
        ]);
    }
}'
                    ]
                ],
                'checklist' => [
                    'La liste des produits s\'affiche correctement',
                    'La pagination fonctionne',
                    'La page détail affiche toutes les informations',
                    'Les images s\'affichent (même en placeholder)'
                ],
                'pieges_communs' => [
                    'Oublier d\'injecter Request dans la méthode pour la pagination',
                    'Ne pas configurer correctement le bundle Paginator',
                    'Problèmes d\'affichage : vérifier les chemins des assets'
                ],
                'ressources' => [
                    ['label' => 'Controllers Symfony', 'url' => 'https://symfony.com/doc/current/controller.html', 'icon' => '🎮'],
                    ['label' => 'Twig Templates', 'url' => 'https://twig.symfony.com/', 'icon' => '🎨']
                ]
            ],

            // Étape 4 - Système de Panier
            4 => [
                'description_detaillee' => 'Implémentez un panier d\'achat robuste qui utilise les sessions Symfony. Les utilisateurs pourront ajouter, modifier et supprimer des articles.',
                'commandes' => [
                    [
                        'titre' => 'Création du service Cart',
                        'code' => 'php bin/console make:service CartService',
                        'explication' => 'Crée un service pour gérer la logique du panier'
                    ]
                ],
                'fichiers_a_creer' => [
                    [
                        'path' => 'src/Service/CartService.php',
                        'description' => 'Service de gestion du panier',
                        'code' => '<?php
namespace App\Service;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService
{
    private const CART_KEY = \'cart\';
    
    public function __construct(private RequestStack $requestStack)
    {
    }
    
    public function add(Product $product, int $quantity = 1): void
    {
        $cart = $this->get();
        $id = $product->getId();
        
        if (isset($cart[$id])) {
            $cart[$id][\'quantity\'] += $quantity;
        } else {
            $cart[$id] = [
                \'product\' => $product,
                \'quantity\' => $quantity
            ];
        }
        
        $this->save($cart);
    }
    
    public function getTotal(): float
    {
        $total = 0;
        foreach ($this->get() as $item) {
            $total += $item[\'product\']->getPrice() * $item[\'quantity\'];
        }
        return $total;
    }
    
    // ... autres méthodes
}'
                    ]
                ],
                'checklist' => [
                    'Ajouter un produit au panier fonctionne',
                    'Le panier persiste après rechargement de page',
                    'Le total se calcule correctement',
                    'La quantité peut être modifiée'
                ],
                'pieges_communs' => [
                    'Stocker des objets Doctrine en session (sérialisation)',
                    'Ne pas gérer le cas où le produit n\'existe plus',
                    'Oublier de vérifier le stock disponible'
                ],
                'ressources' => [
                    ['label' => 'Sessions Symfony', 'url' => 'https://symfony.com/doc/current/session.html', 'icon' => '💾'],
                    ['label' => 'Services', 'url' => 'https://symfony.com/doc/current/service_container.html', 'icon' => '⚙️']
                ]
            ],

            // Étape 5 - Authentification
            5 => [
                'description_detaillee' => 'Mettez en place un système d\'authentification complet avec inscription, connexion et gestion des profils utilisateurs.',
                'commandes' => [
                    [
                        'titre' => 'Création du système d\'authentification',
                        'code' => 'php bin/console make:user
php bin/console make:auth
php bin/console make:registration-form',
                        'explication' => 'Génère toute la structure pour l\'authentification'
                    ],
                    [
                        'titre' => 'Migration User',
                        'code' => 'php bin/console make:migration
php bin/console doctrine:migrations:migrate',
                        'explication' => 'Crée la table users dans la base de données'
                    ]
                ],
                'fichiers_a_creer' => [
                    [
                        'path' => 'config/packages/security.yaml',
                        'description' => 'Configuration de la sécurité',
                        'code' => 'security:
    password_hashers:
        App\Entity\User:
            algorithm: auto

    providers:
        app_user_provider:
            entity:
                class: App\Entity\User
                property: email

    firewalls:
        main:
            lazy: true
            provider: app_user_provider
            form_login:
                login_path: app_login
                check_path: app_login
            logout:
                path: app_logout
                
    access_control:
        - { path: ^/admin, roles: ROLE_ADMIN }
        - { path: ^/profile, roles: ROLE_USER }'
                    ]
                ],
                'checklist' => [
                    'L\'inscription crée un nouvel utilisateur',
                    'La connexion fonctionne',
                    'La déconnexion redirige correctement',
                    'Les mots de passe sont hashés'
                ],
                'pieges_communs' => [
                    'Firewall mal configuré : vérifier l\'ordre dans security.yaml',
                    'Oublier remember_me pour garder la session',
                    'Ne pas rediriger après login (default_target_path)'
                ],
                'ressources' => [
                    ['label' => 'Security Symfony', 'url' => 'https://symfony.com/doc/current/security.html', 'icon' => '🔐'],
                    ['label' => 'Authentication', 'url' => 'https://symfony.com/doc/current/security/form_login_setup.html', 'icon' => '👤']
                ]
            ],

            // Étape 6 - Processus de Commande
            6 => [
                'description_detaillee' => 'Transformez le panier en commande persistée. Gérez les adresses de livraison, la validation des données et la confirmation.',
                'commandes' => [
                    [
                        'titre' => 'Création entité Order',
                        'code' => 'php bin/console make:entity Order
php bin/console make:entity OrderItem',
                        'explication' => 'Crée les entités pour gérer les commandes'
                    ],
                    [
                        'titre' => 'Création formulaire commande',
                        'code' => 'php bin/console make:form OrderType',
                        'explication' => 'Génère le formulaire de passation de commande'
                    ]
                ],
                'fichiers_a_creer' => [
                    [
                        'path' => 'src/Entity/Order.php',
                        'description' => 'Entité commande',
                        'code' => '<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: \'order\', targetEntity: OrderItem::class, cascade: [\'persist\'])]
    private Collection $items;

    #[ORM\Column(type: \'decimal\', precision: 10, scale: 2)]
    private ?string $total = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 50)]
    private ?string $status = \'pending\';
    
    // ... getters/setters
}'
                    ]
                ],
                'checklist' => [
                    'La commande est créée avec tous les items',
                    'Le total est correct',
                    'L\'utilisateur reçoit un email de confirmation',
                    'Le panier est vidé après la commande'
                ],
                'pieges_communs' => [
                    'Ne pas utiliser cascade: [\'persist\'] sur les OrderItems',
                    'Oublier de vérifier le stock avant validation',
                    'Transaction incomplète : utiliser EntityManager->flush()'
                ],
                'ressources' => [
                    ['label' => 'Forms Symfony', 'url' => 'https://symfony.com/doc/current/forms.html', 'icon' => '📝'],
                    ['label' => 'Validation', 'url' => 'https://symfony.com/doc/current/validation.html', 'icon' => '✅']
                ]
            ],

            // Étape 7 - Interface Administration
            7 => [
                'description_detaillee' => 'Créez une interface d\'administration complète pour gérer les produits, les commandes et visualiser les statistiques de vente.',
                'commandes' => [
                    [
                        'titre' => 'Installation EasyAdmin',
                        'code' => 'composer require easyadmin',
                        'explication' => 'Installe le bundle EasyAdmin pour créer rapidement une interface admin'
                    ],
                    [
                        'titre' => 'Création dashboard admin',
                        'code' => 'php bin/console make:admin:dashboard',
                        'explication' => 'Génère le tableau de bord d\'administration'
                    ],
                    [
                        'titre' => 'Création CRUD',
                        'code' => 'php bin/console make:admin:crud',
                        'explication' => 'Crée les contrôleurs CRUD pour vos entités'
                    ]
                ],
                'fichiers_a_creer' => [
                    [
                        'path' => 'src/Controller/Admin/DashboardController.php',
                        'description' => 'Dashboard administrateur',
                        'code' => '<?php
namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use App\Entity\Product;
use App\Entity\Order;

class DashboardController extends AbstractDashboardController
{
    #[Route(\'/admin\', name: \'admin\')]
    public function index(): Response
    {
        return $this->render(\'admin/dashboard.html.twig\', [
            \'products_count\' => $this->productRepository->count([]),
            \'orders_count\' => $this->orderRepository->count([]),
            \'total_revenue\' => $this->calculateRevenue(),
        ]);
    }
    
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle(\'E-commerce Admin\');
    }
    
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard(\'Dashboard\', \'fa fa-home\');
        yield MenuItem::linkToCrud(\'Products\', \'fa fa-box\', Product::class);
        yield MenuItem::linkToCrud(\'Orders\', \'fa fa-shopping-cart\', Order::class);
    }
}'
                    ]
                ],
                'checklist' => [
                    'L\'accès /admin nécessite ROLE_ADMIN',
                    'Les produits peuvent être ajoutés/modifiés/supprimés',
                    'Les commandes sont listées avec filtres',
                    'Les statistiques s\'affichent correctement'
                ],
                'pieges_communs' => [
                    'Ne pas restreindre l\'accès avec access_control',
                    'Images non uploadées : configurer VichUploader',
                    'Pagination trop lente : ajouter des index en base'
                ],
                'ressources' => [
                    ['label' => 'EasyAdmin', 'url' => 'https://symfony.com/bundles/EasyAdminBundle/current/index.html', 'icon' => '⚡'],
                    ['label' => 'Security Voters', 'url' => 'https://symfony.com/doc/current/security/voters.html', 'icon' => '🗳️']
                ]
            ],

            // Étape 8 - Fonctionnalités Avancées
            8 => [
                'description_detaillee' => 'Ajoutez les touches finales : upload d\'images, emails transactionnels, cache pour les performances et tests pour garantir la qualité.',
                'commandes' => [
                    [
                        'titre' => 'Installation VichUploader',
                        'code' => 'composer require vich/uploader-bundle',
                        'explication' => 'Gère l\'upload et le stockage des images produits'
                    ],
                    [
                        'titre' => 'Configuration Mailer',
                        'code' => 'composer require symfony/mailer
# Dans .env
MAILER_DSN=smtp://localhost:1025',
                        'explication' => 'Configure l\'envoi d\'emails'
                    ],
                    [
                        'titre' => 'Installation du cache',
                        'code' => 'composer require symfony/cache',
                        'explication' => 'Active le système de cache Symfony'
                    ]
                ],
                'fichiers_a_creer' => [
                    [
                        'path' => 'src/Service/EmailService.php',
                        'description' => 'Service d\'envoi d\'emails',
                        'code' => '<?php
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class EmailService
{
    public function __construct(
        private MailerInterface $mailer,
        private Environment $twig
    ) {}
    
    public function sendOrderConfirmation(Order $order): void
    {
        $email = (new Email())
            ->from(\'shop@example.com\')
            ->to($order->getUser()->getEmail())
            ->subject(\'Confirmation de commande #\' . $order->getId())
            ->html(
                $this->twig->render(\'emails/order_confirmation.html.twig\', [
                    \'order\' => $order
                ])
            );
        
        $this->mailer->send($email);
    }
}'
                    ]
                ],
                'checklist' => [
                    'Les images s\'uploadent et s\'affichent',
                    'Les emails sont envoyés correctement',
                    'Le cache améliore les performances',
                    'Les tests passent avec succès'
                ],
                'pieges_communs' => [
                    'Images trop lourdes : ajouter validation de taille',
                    'Emails bloqués : tester avec Mailtrap ou MailHog',
                    'Cache non invalidé : configurer correctement les tags'
                ],
                'ressources' => [
                    ['label' => 'VichUploader', 'url' => 'https://github.com/dustin10/VichUploaderBundle', 'icon' => '📤'],
                    ['label' => 'Symfony Mailer', 'url' => 'https://symfony.com/doc/current/mailer.html', 'icon' => '📧'],
                    ['label' => 'Testing', 'url' => 'https://symfony.com/doc/current/testing.html', 'icon' => '🧪']
                ]
            ],
        ];
    }
}
