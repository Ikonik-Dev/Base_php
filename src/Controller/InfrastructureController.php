<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class InfrastructureController extends AbstractController
{
    #[Route('/infrastructure', name: 'app_infrastructure')]
    public function index(): Response
    {
        $concepts = [
            'architecture_client_serveur' => [
                'label' => 'Architecture Client-Serveur',
                'description' => 'Imaginez un restaurant : vous (le client) passez commande au serveur qui transmet à la cuisine. Le web fonctionne pareil ! Votre navigateur (Chrome, Firefox) passe des "commandes" aux serveurs web qui préparent et renvoient les pages.',
                'details' => [
                    'Client (Navigateur)' => 'Votre "fenêtre sur le web" : il demande les pages, comprend le HTML/CSS/JS et affiche le résultat. Sans lui, impossible de voir un site !',
                    'Serveur Web' => 'L\'ordinateur distant qui "héberge" le site. Il reçoit vos demandes, exécute PHP, interroge la base de données et vous renvoie la page toute prête.',
                    'Communication HTTP' => 'Le "langage" universel du web. Comme l\'anglais pour les aéroports, HTTP permet à tous les navigateurs et serveurs de se comprendre.',
                    'Adresse IP' => 'L\'adresse postale d\'un serveur sur Internet. Le DNS traduit "google.com" en adresse IP comme "142.250.74.206".'
                ],
                'analogie' => '🍽️ Restaurant : Client = Vous qui commandez, Serveur = Le personnel, HTTP = Le menu standardisé, Réponse = Votre plat servi',
                'exemple_concret' => 'Quand vous tapez www.example.com, votre navigateur envoie "GET /index.html" au serveur qui répond avec le code HTML de la page.'
            ],
            'pile_lamp_lemp' => [
                'label' => 'Pile LAMP/LEMP',
                'description' => 'Une "pile" technologique, c\'est comme les étages d\'un immeuble : chaque niveau a son rôle. LAMP/LEMP sont les fondations les plus utilisées pour faire tourner PHP sur Internet.',
                'details' => [
                    'L - Linux' => 'Le système d\'exploitation du serveur (comme Windows pour votre PC). Gratuit, ultra-stable, il fait tourner 96% des serveurs web !',
                    'A/E - Apache ou Nginx' => 'Le "réceptionniste" qui accueille toutes les requêtes web. Apache est flexible, Nginx est plus rapide pour les gros sites.',
                    'M - MySQL/MariaDB' => 'Le "classeur géant" qui stocke toutes les données : utilisateurs, articles, commandes... Tout est rangé dans des tableaux reliés entre eux.',
                    'P - PHP' => 'Le "cerveau" qui traite la logique : vérifier un mot de passe, calculer un prix, générer une page personnalisée pour chaque visiteur.'
                ],
                'analogie' => '🏢 Immeuble : Linux = Fondations, Apache/Nginx = Accueil, MySQL = Archives, PHP = Bureau qui traite les dossiers',
                'variantes' => [
                    'WAMP' => 'Version Windows (Laragon, XAMPP) - idéal pour apprendre sur votre PC',
                    'LEMP' => 'Avec Nginx (le "E" de "Engine-X") - plus performant pour les gros projets',
                    'MAMP' => 'Version Mac - pour les développeurs Apple'
                ]
            ],
            'cycle_requete_reponse' => [
                'label' => 'Cycle Requête-Réponse HTTP',
                'description' => 'Chaque clic sur un lien déclenche un "aller-retour" invisible : votre navigateur pose une question (requête), le serveur réfléchit et renvoie la réponse. Ce cycle prend quelques millisecondes !',
                'details' => [
                    '1. Requête HTTP' => 'Votre navigateur envoie un "message" : "Je veux la page /contact, je suis Chrome, j\'accepte le HTML..." C\'est comme une lettre avec l\'adresse et vos préférences.',
                    '2. Routage' => 'Le serveur web (Apache/Nginx) reçoit la lettre et décide où l\'envoyer : "Ah, /contact ? C\'est le fichier contact.php !"',
                    '3. Traitement PHP' => 'PHP se met au travail : il lit le code, interroge la base de données si besoin, et "fabrique" la page HTML finale.',
                    '4. Réponse HTTP' => 'Le serveur renvoie le résultat : "Tout va bien (code 200), voici ta page HTML !" ou "Page introuvable (404)" si l\'adresse n\'existe pas.'
                ],
                'analogie' => '📬 Courrier express : Requête = Votre lettre avec questions, Serveur = Centre de tri + Bureau qui répond, Réponse = La réponse dans votre boîte aux lettres',
                'codes_http' => [
                    '200 OK' => '✅ Tout s\'est bien passé, voici votre page',
                    '301/302' => '↪️ La page a déménagé, suivez la redirection',
                    '404 Not Found' => '❌ Cette page n\'existe pas',
                    '500 Internal Error' => '💥 Le serveur a planté (erreur PHP souvent)'
                ]
            ],
            'role_de_php' => [
                'label' => 'Rôle de PHP dans l\'écosystème',
                'description' => 'PHP est le "chef cuisinier" du web : il prend les ingrédients (données), suit la recette (votre code) et prépare un plat unique (page HTML) pour chaque visiteur. Sans PHP, les sites seraient des pages fixes identiques pour tous !',
                'details' => [
                    'Génération dynamique' => 'PHP crée des pages "sur mesure" : votre nom affiché, vos articles recommandés, votre panier... Chaque visiteur voit SA version du site.',
                    'Traitement de formulaires' => 'Quand vous envoyez un formulaire, PHP reçoit les données, vérifie qu\'elles sont valides (email correct ?), les nettoie (pas de virus !) et les traite.',
                    'Gestion de session' => 'PHP se "souvient" de vous entre les pages : vous êtes connecté, votre panier est sauvegardé... C\'est comme un bracelet d\'identification au festival.',
                    'Interface BDD' => 'PHP est le traducteur entre votre code et MySQL. Il transforme "donne-moi tous les articles" en requête SQL et vous renvoie les résultats.'
                ],
                'analogie' => '👨‍🍳 Chef cuisinier : Ingrédients = Données BDD, Recette = Votre code PHP, Plat final = Page HTML personnalisée pour chaque client',
                'sites_celebres' => [
                    'WordPress' => '43% des sites web mondiaux',
                    'Facebook' => 'Créé en PHP (maintenant avec Hack)',
                    'Wikipedia' => 'Propulsé par MediaWiki en PHP',
                    'Symfony/Laravel' => 'Frameworks PHP professionnels très utilisés'
                ]
            ],
            'protocoles_et_standards' => [
                'label' => 'Protocoles et Standards Web',
                'description' => 'Comme les normes électriques permettent de brancher n\'importe quel appareil, les protocoles web garantissent que tous les navigateurs et serveurs peuvent communiquer. Sans standards, chaque site aurait besoin d\'un navigateur différent !',
                'details' => [
                    'HTTP/HTTPS' => 'Le protocole de base du web. HTTPS ajoute un cadenas : vos données sont chiffrées (illisibles si interceptées). Obligatoire pour les paiements et mots de passe !',
                    'DNS' => 'L\'annuaire du web : il traduit "facebook.com" en adresse IP "157.240.1.35". Sans DNS, il faudrait mémoriser des chiffres pour chaque site !',
                    'TCP/IP' => 'Les "autoroutes" d\'Internet : TCP découpe vos données en petits paquets, IP les achemine vers la bonne destination, comme des colis postaux.',
                    'Standards W3C' => 'Le "Larousse" du web : définit comment écrire HTML, CSS, JavaScript pour que tous les navigateurs les comprennent pareil.'
                ],
                'analogie' => '🌍 Normes internationales : HTTP = Langue commune, DNS = Annuaire téléphonique, TCP/IP = Système postal mondial, W3C = Académie française du web',
                'evolution' => [
                    'HTTP/1.1' => 'Une requête à la fois (1997-2015)',
                    'HTTP/2' => 'Plusieurs requêtes simultanées, plus rapide',
                    'HTTP/3' => 'Encore plus rapide avec QUIC (basé sur UDP)'
                ]
            ],
            'frontend_vs_backend' => [
                'label' => 'Frontend vs Backend',
                'description' => 'Un site web a deux faces : le "Frontend" (ce que vous voyez) et le "Backend" (les coulisses). PHP travaille côté Backend, comme la cuisine d\'un restaurant, tandis que HTML/CSS/JS sont côté Frontend, comme la salle.',
                'details' => [
                    'Frontend (côté client)' => 'Tout ce qui s\'exécute dans VOTRE navigateur : HTML structure la page, CSS la décore, JavaScript la rend interactive. Visible par tous !',
                    'Backend (côté serveur)' => 'Les coulisses invisibles : PHP traite les données, MySQL les stocke, le serveur gère la sécurité. Le code reste secret sur le serveur.',
                    'API (pont entre les deux)' => 'Le "passe-plat" : le Frontend demande des données au Backend via des API. Ex: "Donne-moi la liste des produits" → JSON avec les produits.',
                    'Rendu côté serveur (SSR)' => 'PHP génère tout le HTML côté serveur et l\'envoie prêt à afficher. C\'est le mode "classique" de PHP.'
                ],
                'analogie' => '🎭 Théâtre : Frontend = La scène visible, Backend = Les coulisses, API = Les techniciens qui passent les accessoires',
                'technologies' => [
                    'Frontend' => 'HTML, CSS, JavaScript, React, Vue.js',
                    'Backend' => 'PHP, Python, Node.js, Java, Ruby',
                    'Full-stack' => 'Développeur qui maîtrise les deux côtés'
                ]
            ],
            'environnements_deploiement' => [
                'label' => 'Environnements de Déploiement',
                'description' => 'Comme un avion passe par la conception, les tests en simulateur puis les vrais vols, un site passe par plusieurs environnements avant d\'être "en ligne". Chacun a son rôle !',
                'details' => [
                    'Développement local' => 'Votre PC ! Avec Laragon/XAMPP, vous avez un mini-serveur pour coder et tester tranquillement. Les erreurs ne gênent personne.',
                    'Staging/Pré-production' => 'Un serveur de test qui ressemble à la production. On y vérifie que tout marche "en vrai" avant de publier. Les testeurs s\'y connectent.',
                    'Production' => 'Le serveur public, accessible à tous vos visiteurs. Optimisé pour la performance et la sécurité. Une erreur ici = vrais utilisateurs impactés !',
                    'CI/CD' => 'L\'automatisation : quand vous envoyez du code sur Git, des robots le testent et le déploient automatiquement. Fini les déploiements manuels à 3h du matin !'
                ],
                'analogie' => '✈️ Aviation : Local = Simulateur de vol, Staging = Vol d\'essai, Production = Vol commercial avec passagers',
                'outils_locaux' => [
                    'Laragon' => 'Simple et léger pour Windows - recommandé pour débuter',
                    'XAMPP' => 'Multi-plateforme, très populaire',
                    'Docker' => 'Environnements reproductibles en conteneurs - pro'
                ]
            ],
            'hebergement_web' => [
                'label' => 'Types d\'Hébergement Web',
                'description' => 'Où votre site va-t-il "habiter" sur Internet ? Du petit studio partagé au datacenter privé, chaque type d\'hébergement a ses avantages selon vos besoins et budget.',
                'details' => [
                    'Hébergement mutualisé' => 'Un serveur partagé avec des dizaines d\'autres sites. Pas cher (3-10€/mois), parfait pour débuter, mais performances limitées si un voisin abuse.',
                    'VPS (Serveur Privé Virtuel)' => 'Votre "appartement" virtuel sur un serveur partagé. Plus de contrôle, ressources garanties (15-50€/mois). Idéal pour sites moyens.',
                    'Serveur dédié' => 'Un serveur physique rien qu\'à vous ! Performances maximales, contrôle total (100-500€/mois). Pour gros sites ou besoins spécifiques.',
                    'Cloud (AWS, Azure, GCP)' => 'Des ressources à la demande : vous payez ce que vous consommez. Scalable à l\'infini, mais plus complexe à gérer.'
                ],
                'analogie' => '🏠 Logement : Mutualisé = Colocation, VPS = Appartement, Dédié = Maison individuelle, Cloud = Hôtel (à la carte)',
                'conseils' => [
                    'Petit blog' => 'Mutualisé suffit amplement',
                    'Site vitrine PME' => 'Mutualisé ou petit VPS',
                    'E-commerce actif' => 'VPS ou dédié recommandé',
                    'Startup tech' => 'Cloud pour la flexibilité'
                ]
            ],
            'optimisation_performance' => [
                'label' => 'Optimisation et Performance',
                'description' => 'Un site lent perd des visiteurs ! 40% des gens quittent si la page met plus de 3 secondes. Voici les techniques pour que votre site réponde à la vitesse de l\'éclair.',
                'details' => [
                    'Cache serveur' => 'Garder en mémoire les résultats déjà calculés. OPcache stocke le PHP compilé, Redis garde les données fréquentes. Comme préparer les plats populaires à l\'avance !',
                    'CDN' => 'Des copies de votre site sur des serveurs partout dans le monde. Un visiteur au Japon charge depuis Tokyo, pas depuis Paris. Résultat : 10x plus rapide !',
                    'Optimisation images' => 'Compresser les images (WebP), lazy loading (charger seulement ce qu\'on voit). Une image mal optimisée peut peser 10x plus que nécessaire.',
                    'Minification' => 'Supprimer espaces et commentaires du CSS/JS en production. Le fichier est plus petit, le téléchargement plus rapide.'
                ],
                'analogie' => '🏎️ Formule 1 : Cache = Pièces préparées d\'avance, CDN = Stands dans chaque ville, Compression = Voiture allégée',
                'metriques' => [
                    'TTFB' => 'Time To First Byte : délai avant la première réponse serveur',
                    'LCP' => 'Largest Contentful Paint : temps d\'affichage du contenu principal',
                    'FID' => 'First Input Delay : réactivité aux clics utilisateur'
                ]
            ],
            'securite_infrastructure' => [
                'label' => 'Sécurité de l\'Infrastructure',
                'description' => 'Internet est une jungle ! Des robots tentent en permanence de pirater les sites. Une bonne sécurité, c\'est comme une maison avec alarme, serrure et surveillance.',
                'details' => [
                    'HTTPS obligatoire' => 'Le cadenas dans la barre d\'adresse. Chiffre toutes les communications : même interceptées, elles sont illisibles. Gratuit avec Let\'s Encrypt !',
                    'Firewall' => 'Le vigile à l\'entrée : bloque les requêtes suspectes, limite les connexions abusives, filtre les adresses IP malveillantes connues.',
                    'Mises à jour' => 'CRUCIAL : les failles sont découvertes régulièrement. Un WordPress ou PHP non mis à jour est une porte ouverte aux hackers !',
                    'Sauvegardes' => 'Plan B si tout échoue. Sauvegardes automatiques quotidiennes, stockées ailleurs que sur le serveur. Testez régulièrement les restaurations !'
                ],
                'analogie' => '🏰 Château fort : HTTPS = Murailles, Firewall = Pont-levis, Updates = Réparation des brèches, Backup = Trésor caché ailleurs',
                'attaques_courantes' => [
                    'SQL Injection' => 'Injecter du code SQL malveillant via les formulaires',
                    'XSS' => 'Injecter du JavaScript pour voler des données',
                    'Brute Force' => 'Essayer des milliers de mots de passe',
                    'DDoS' => 'Submerger le serveur de requêtes pour le faire planter'
                ]
            ]
        ];

        $tools = [
            'serveurs_web' => [
                'Apache' => 'Le "vétéran" du web (1995). Très configurable via .htaccess, énorme documentation. Idéal pour commencer.',
                'Nginx' => 'Le "challenger" rapide. Gère mieux les fortes charges, souvent utilisé en proxy devant Apache.',
                'Caddy' => 'Le "nouveau" simple. HTTPS automatique, config minimaliste. Parfait pour les petits projets.'
            ],
            'bases_de_donnees' => [
                'MySQL' => 'La BDD la plus populaire avec PHP. Simple, performante, gratuite. Le choix par défaut.',
                'PostgreSQL' => 'Plus puissante pour les requêtes complexes. Utilisée par les grands projets.',
                'SQLite' => 'Base dans un simple fichier. Zéro installation, parfait pour prototypes et petits sites.'
            ],
            'outils_developpement' => [
                'Laragon' => 'Environnement local Windows ultra-simple. Démarre en 3 secondes, tout préconfigurée.',
                'Docker' => 'Conteneurs reproductibles. "Ça marche sur ma machine" devient "Ça marche partout".',
                'Git' => 'Versioning du code. Historique, branches, collaboration. Indispensable en équipe.',
                'Composer' => 'Gestionnaire de packages PHP. Installe les bibliothèques en une commande.'
            ],
            'monitoring_debug' => [
                'Symfony Profiler' => 'Barre de debug intégrée : requêtes SQL, temps d\'exécution, mémoire...',
                'Xdebug' => 'Débugueur PHP : points d\'arrêt, inspection des variables pas à pas.',
                'Logs serveur' => 'Fichiers error.log et access.log : l\'historique de tout ce qui se passe.'
            ]
        ];

        // Nouvelles données pour les diagrammes enrichis
        $workflows = [
            'developpement_classique' => [
                'label' => 'Workflow de développement',
                'etapes' => [
                    ['icon' => '💻', 'titre' => 'Code local', 'description' => 'Écriture du code PHP sur votre machine'],
                    ['icon' => '🧪', 'titre' => 'Tests', 'description' => 'Vérification que tout fonctionne'],
                    ['icon' => '📦', 'titre' => 'Commit Git', 'description' => 'Sauvegarde versionnée du code'],
                    ['icon' => '🚀', 'titre' => 'Déploiement', 'description' => 'Envoi sur le serveur de production']
                ]
            ]
        ];

        $comparaisons = [
            'php_vs_autres' => [
                'label' => 'PHP vs autres langages backend',
                'donnees' => [
                    'PHP' => ['facilite' => 9, 'performance' => 7, 'popularite' => 9, 'emplois' => 8],
                    'Node.js' => ['facilite' => 7, 'performance' => 8, 'popularite' => 8, 'emplois' => 9],
                    'Python' => ['facilite' => 9, 'performance' => 6, 'popularite' => 9, 'emplois' => 9],
                    'Java' => ['facilite' => 5, 'performance' => 9, 'popularite' => 7, 'emplois' => 8]
                ]
            ]
        ];

        return $this->render('infrastructure/index.html.twig', [
            'concepts' => $concepts,
            'tools' => $tools,
            'workflows' => $workflows,
            'comparaisons' => $comparaisons,
            'pageTitle' => 'Infrastructure Web & PHP'
        ]);
    }
}
