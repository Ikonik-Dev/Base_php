<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProjetPOOController extends AbstractController
{
    #[Route('/projet-poo', name: 'app_projet_poo')]
    public function index(): Response
    {
        // Structure pédagogique sur 2,5 jours pour novices
        $progression = [
            'jour1' => [
                'label' => 'Niveau 1 - Les Fondations',
                'duration' => '4h',
                'objectives' => [
                    'Comprendre ce qu\'est un objet dans la vraie vie',
                    'Créer sa première classe simple',
                    'Instancier des objets',
                    'Utiliser les propriétés et méthodes de base'
                ],
                'analogies' => [
                    'classe' => 'Moule à gâteau (définit la forme)',
                    'objet' => 'Gâteau créé avec le moule (instance unique)',
                    'propriete' => 'Ingrédients du gâteau (couleur, goût, taille)',
                    'methode' => 'Actions qu\'on peut faire (couper, manger, décorer)'
                ],
                'concepts' => ['classes', 'objets', 'propriétés', 'méthodes', 'constructeur']
            ],
            'jour2' => [
                'label' => 'Niveau 2 - L\'Organisation',
                'duration' => '7h',
                'objectives' => [
                    'Maîtriser l\'encapsulation (public/private/protected)',
                    'Comprendre l\'héritage avec des exemples concrets',
                    'Créer une hiérarchie de classes',
                    'Utiliser les getters et setters'
                ],
                'analogies' => [
                    'encapsulation' => 'Coffre-fort (protéger les données importantes)',
                    'heritage' => 'DNA familial (enfant hérite des parents)',
                    'protected' => 'Secret de famille (accessible aux descendants)',
                    'private' => 'Journal intime (personne d\'autre ne peut lire)'
                ],
                'concepts' => ['encapsulation', 'héritage', 'visibilité', 'parent/enfant', 'override']
            ],
            'jour3' => [
                'label' => 'Niveau 3 - La Maîtrise',
                'duration' => '7h',
                'objectives' => [
                    'Découvrir le polymorphisme',
                    'Utiliser les classes abstraites',
                    'Comprendre les interfaces',
                    'Finaliser le projet de commerce'
                ],
                'analogies' => [
                    'polymorphisme' => 'Télécommande universelle (même bouton, actions différentes)',
                    'abstraction' => 'Plan architectural (définit la structure, pas les détails)',
                    'interface' => 'Contrat de travail (obligations à respecter)',
                    'implementation' => 'Façon personnelle de respecter le contrat'
                ],
                'concepts' => ['polymorphisme', 'abstraction', 'interfaces', 'final', 'static']
            ]
        ];

        // Classes du projet : Commerce de Jeux Vidéo
        $classes_projet = [
            // JOUR 1 - Classes de base
            'Produit' => [
                'jour' => 1,
                'description' => 'Classe mère représentant tout produit du magasin',
                'proprietes' => ['nom', 'prix', 'stock', 'description'],
                'methodes' => ['afficherInfos()', 'verifierStock()', 'calculerPrix()'],
                'analogie' => 'Comme une étiquette de produit avec toutes les infos de base'
            ],
            'JeuVideo' => [
                'jour' => 1,
                'description' => 'Produit spécialisé dans les jeux vidéo',
                'proprietes' => ['plateforme', 'genre', 'ageMinimum', 'editeur'],
                'methodes' => ['jouer()', 'installerJeu()', 'verifierAge()'],
                'analogie' => 'Comme un jeu avec sa boîte et ses spécificités'
            ],

            // JOUR 2 - Héritage et encapsulation
            'Utilisateur' => [
                'jour' => 2,
                'description' => 'Représente un utilisateur du site',
                'proprietes' => ['nom', 'email', 'age', 'motDePasse (private)'],
                'methodes' => ['seConnecter()', 'modifierProfil()', 'getAge()'],
                'analogie' => 'Comme un compte client avec des infos personnelles protégées'
            ],
            'Client' => [
                'jour' => 2,
                'description' => 'Utilisateur qui peut acheter (hérite d\'Utilisateur)',
                'proprietes' => ['adresse', 'carteCredit', 'historiqueAchats'],
                'methodes' => ['ajouterAuPanier()', 'payer()', 'consulterHistorique()'],
                'analogie' => 'Client du magasin avec ses moyens de paiement'
            ],
            'Administrateur' => [
                'jour' => 2,
                'description' => 'Utilisateur avec privilèges admin (hérite d\'Utilisateur)',
                'proprietes' => ['niveau', 'permissions'],
                'methodes' => ['ajouterProduit()', 'supprimerUtilisateur()', 'modifierStock()'],
                'analogie' => 'Gérant du magasin avec accès aux commandes'
            ],

            // JOUR 3 - Polymorphisme et abstraction
            'Panier' => [
                'jour' => 3,
                'description' => 'Gère les achats en cours',
                'proprietes' => ['produits[]', 'total', 'dateCreation'],
                'methodes' => ['ajouter()', 'retirer()', 'calculerTotal()', 'vider()'],
                'analogie' => 'Caddie de supermarché virtuel'
            ],
            'PaymentInterface' => [
                'jour' => 3,
                'description' => 'Interface pour tous les moyens de paiement',
                'proprietes' => [], // Interface n'a pas de propriétés mais structure cohérente
                'methodes' => ['payer()', 'verifierSolde()', 'confirmerTransaction()'],
                'analogie' => 'Contrat que doit respecter tout moyen de paiement'
            ],
            'MagasinManager' => [
                'jour' => 3,
                'description' => 'Classe principale qui gère tout le commerce',
                'proprietes' => ['produits[]', 'utilisateurs[]', 'commandes[]'],
                'methodes' => ['rechercher()', 'gererStock()', 'genererRapport()'],
                'analogie' => 'Système de gestion du magasin complet'
            ]
        ];

        // Exercices progressifs
        $exercices = [
            'jour1' => [
                [
                    'titre' => 'Créer votre premier jeu',
                    'consigne' => 'Créez une classe JeuVideo avec nom, prix et plateforme. Instanciez "Call of Duty" à 60€ sur PS5.',
                    'difficulte' => 'Facile',
                    'temps' => '30min',
                    'competences' => ['Classe de base', 'Constructeur', 'Propriétés']
                ],
                [
                    'titre' => 'Le stock du magasin',
                    'consigne' => 'Ajoutez une méthode pour vérifier si le jeu est en stock. Si stock < 1, afficher "Rupture".',
                    'difficulte' => 'Facile',
                    'temps' => '20min',
                    'competences' => ['Méthodes', 'Conditions']
                ],
                [
                    'titre' => 'Catalogue de jeux',
                    'consigne' => 'Créez 5 jeux différents et affichez leurs informations complètes.',
                    'difficulte' => 'Moyen',
                    'temps' => '45min',
                    'competences' => ['Instances multiples', 'Boucles']
                ]
            ],
            'jour2' => [
                [
                    'titre' => 'Protection des données',
                    'consigne' => 'Rendez les propriétés privées et créez des getters/setters. Le prix ne peut être négatif.',
                    'difficulte' => 'Moyen',
                    'temps' => '1h',
                    'competences' => ['Encapsulation', 'Validation']
                ],
                [
                    'titre' => 'Hiérarchie client',
                    'consigne' => 'Créez Utilisateur (parent) et Client/Admin (enfants). Chaque type a ses spécificités.',
                    'difficulte' => 'Moyen',
                    'temps' => '1h30',
                    'competences' => ['Héritage', 'Spécialisation']
                ],
                [
                    'titre' => 'Gestion des âges',
                    'consigne' => 'Vérifiez que le client a l\'âge requis avant d\'acheter un jeu (PEGI).',
                    'difficulte' => 'Difficile',
                    'temps' => '1h',
                    'competences' => ['Logique métier', 'Validation']
                ]
            ],
            'jour3' => [
                [
                    'titre' => 'Panier polymorphe',
                    'consigne' => 'Le panier accepte tous types de produits (jeux, accessoires) et calcule le total.',
                    'difficulte' => 'Difficile',
                    'temps' => '2h',
                    'competences' => ['Polymorphisme', 'Collections']
                ],
                [
                    'titre' => 'Système de paiement',
                    'consigne' => 'Implémentez PaymentInterface avec CarteCredit et PayPal (méthodes différentes).',
                    'difficulte' => 'Difficile',
                    'temps' => '1h30',
                    'competences' => ['Interfaces', 'Implémentation']
                ],
                [
                    'titre' => 'Magasin complet',
                    'consigne' => 'Assemblez tout : utilisateurs, produits, paniers, paiements dans un système cohérent.',
                    'difficulte' => 'Expert',
                    'temps' => '2h30',
                    'competences' => ['Architecture', 'Intégration']
                ]
            ]
        ];

        // Conseils pédagogiques pour formateurs
        $conseils_formateur = [
            'approche' => [
                'Commencer par des analogies concrètes avant le code',
                'Laisser les stagiaires expérimenter et faire des erreurs',
                'Encourager les questions, même "bêtes"',
                'Faire des pauses régulières avec récapitulatifs',
                'Utiliser le pair programming pour l\'entraide'
            ],
            'outils' => [
                'Tableau blanc pour dessiner les concepts',
                'Code en direct avec explication ligne par ligne',
                'Exercices graduels avec correction collective',
                'Projet fil rouge pour donner du sens',
                'Tests unitaires simples pour valider'
            ],
            'difficulties_communes' => [
                'Confusion objet/classe => Insister sur moule/gâteau',
                'Visibilité des propriétés => Analogie coffre-fort/journal',
                'Héritage mal compris => DNA familial très parlant',
                'Polymorphisme abstrait => Télécommande universelle',
                'Syntaxe $this-> => "Moi-même" dans la classe'
            ]
        ];

        return $this->render('projet_poo/index.html.twig', [
            'progression' => $progression,
            'classes_projet' => $classes_projet,
            'exercices' => $exercices,
            'conseils_formateur' => $conseils_formateur,
            'pageTitle' => 'Projet POO Progressif - Commerce Jeux Vidéo'
        ]);
    }
}
