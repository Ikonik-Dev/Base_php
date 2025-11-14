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
                'description' => 'Le web fonctionne selon un modèle client-serveur où les navigateurs (clients) envoient des requêtes aux serveurs web qui renvoient des réponses.',
                'details' => [
                    'Client (Navigateur)' => 'Initie les requêtes HTTP, affiche le HTML/CSS/JS, gère l\'interface utilisateur',
                    'Serveur Web' => 'Traite les requêtes, exécute PHP, accède aux bases de données, renvoie les réponses',
                    'Communication HTTP' => 'Protocole de communication standardisé entre client et serveur'
                ]
            ],
            'pile_lamp_lemp' => [
                'label' => 'Pile LAMP/LEMP',
                'description' => 'LAMP (Linux, Apache, MySQL, PHP) et LEMP (Linux, Nginx, MySQL, PHP) sont les piles technologiques standard pour le développement web.',
                'details' => [
                    'Linux' => 'Système d\'exploitation serveur, stable et sécurisé',
                    'Apache/Nginx' => 'Serveur web qui gère les requêtes HTTP',
                    'MySQL' => 'Base de données relationnelle pour stocker les données',
                    'PHP' => 'Langage de programmation côté serveur pour la logique métier'
                ]
            ],
            'cycle_requete_reponse' => [
                'label' => 'Cycle Requête-Réponse HTTP',
                'description' => 'Chaque interaction web suit un cycle : requête HTTP du client, traitement serveur, génération de la réponse, renvoi au client.',
                'details' => [
                    '1. Requête HTTP' => 'GET/POST/PUT/DELETE avec headers, paramètres et body',
                    '2. Routage' => 'Le serveur web dirige vers le bon script PHP',
                    '3. Traitement PHP' => 'Exécution du code, accès BDD, logique métier',
                    '4. Réponse HTTP' => 'HTML/JSON/XML avec status code et headers'
                ]
            ],
            'role_de_php' => [
                'label' => 'Rôle de PHP dans l\'écosystème',
                'description' => 'PHP est le moteur côté serveur qui génère du contenu dynamique, traite les formulaires, gère les sessions et interagit avec les bases de données.',
                'details' => [
                    'Génération dynamique' => 'Création de HTML personnalisé selon l\'utilisateur et les données',
                    'Traitement de formulaires' => 'Validation, sanitisation et traitement des données utilisateur',
                    'Gestion de session' => 'Authentification, panier, préférences utilisateur',
                    'Interface BDD' => 'CRUD operations, requêtes complexes, gestion des transactions'
                ]
            ],
            'protocoles_et_standards' => [
                'label' => 'Protocoles et Standards Web',
                'description' => 'Le web repose sur des protocoles standardisés qui permettent l\'interopérabilité entre tous les systèmes.',
                'details' => [
                    'HTTP/HTTPS' => 'Protocole de communication web, sécurisé avec SSL/TLS',
                    'DNS' => 'Résolution des noms de domaine en adresses IP',
                    'TCP/IP' => 'Protocoles de transport et réseau sous-jacents',
                    'Standards W3C' => 'HTML, CSS, spécifications web communes'
                ]
            ],
            'environnements_deploiement' => [
                'label' => 'Environnements de Déploiement',
                'description' => 'De la machine de développement à la production, comprendre les différents environnements et leurs spécificités.',
                'details' => [
                    'Développement local' => 'XAMPP, WAMP, Laragon pour tester localement',
                    'Staging/Test' => 'Environnement de pré-production pour validation',
                    'Production' => 'Serveur live avec optimisations performances et sécurité',
                    'Cloud/VPS' => 'AWS, DigitalOcean, hébergement scalable'
                ]
            ],
            'optimisation_performance' => [
                'label' => 'Optimisation et Performance',
                'description' => 'Techniques pour optimiser les performances de l\'infrastructure web et améliorer l\'expérience utilisateur.',
                'details' => [
                    'Cache serveur' => 'OPcache PHP, cache de requêtes MySQL, Redis/Memcached',
                    'CDN' => 'Distribution de contenu géographique pour réduire la latence',
                    'Load Balancing' => 'Répartition de charge sur plusieurs serveurs',
                    'Optimisation BDD' => 'Index, requêtes optimisées, partitioning'
                ]
            ],
            'securite_infrastructure' => [
                'label' => 'Sécurité de l\'Infrastructure',
                'description' => 'Principes et pratiques de sécurité pour protéger l\'infrastructure web contre les menaces.',
                'details' => [
                    'HTTPS obligatoire' => 'Chiffrement des communications client-serveur',
                    'Firewall' => 'Filtrage du trafic réseau, protection contre les intrusions',
                    'Mise à jour système' => 'Patches de sécurité OS, serveur web, PHP, BDD',
                    'Monitoring' => 'Surveillance logs, détection d\'anomalies, alertes'
                ]
            ]
        ];

        $tools = [
            'serveurs_web' => [
                'Apache' => 'Serveur web modulaire, .htaccess, très configurable',
                'Nginx' => 'Performant, idéal pour sites à fort trafic, proxy reverse',
                'IIS' => 'Serveur web Microsoft pour environnements Windows'
            ],
            'bases_de_donnees' => [
                'MySQL' => 'Base de données relationnelle la plus populaire avec PHP',
                'PostgreSQL' => 'BDD avancée avec fonctionnalités entreprise',
                'SQLite' => 'Base de données légère, idéale pour développement'
            ],
            'outils_developpement' => [
                'XAMPP/WAMP' => 'Piles de développement local tout-en-un',
                'Docker' => 'Conteneurisation pour environnements reproductibles',
                'Composer' => 'Gestionnaire de dépendances PHP'
            ]
        ];

        return $this->render('infrastructure/index.html.twig', [
            'concepts' => $concepts,
            'tools' => $tools,
            'pageTitle' => 'Infrastructure Web & PHP'
        ]);
    }
}
