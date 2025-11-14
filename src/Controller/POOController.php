<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class POOController extends AbstractController
{
    #[Route('/poo', name: 'app_poo')]
    public function index(): Response
    {
        // Données complètes sur la Programmation Orientée Objet en PHP
        $dataPOO = [
            'introduction' => [
                'description' => 'La Programmation Orientée Objet (POO) est un paradigme de programmation qui organise le code en classes et objets. Elle offre une meilleure structuration, réutilisabilité et maintenance du code.',
                'example' => '// Approche procédurale vs POO\n// Procédural:\n$nom = "Jean";\nfunction direBonjour($nom) { return "Bonjour $nom"; }\n\n// POO:\nclass Personne {\n    public $nom;\n    public function direBonjour() { return "Bonjour " . $this->nom; }\n}',
                'details' => 'La POO organise le code autour d\'objets qui représentent des choses du monde réel. Au lieu d\'écrire des fonctions isolées, on crée des classes qui sont comme des plans de construction. Une classe contient des propriétés (les données, comme le nom d\'une personne) et des méthodes (les actions, comme se présenter). 

Les 4 grands principes de la POO sont : l\'encapsulation (cacher les détails internes), l\'héritage (réutiliser du code d\'une classe parent), le polymorphisme (une même action peut avoir différents comportements), et l\'abstraction (simplifier les choses complexes).

Avantages : le code est plus facile à comprendre car il reflète la réalité, plus facile à maintenir car tout est organisé, et plus facile à réutiliser. Par exemple, si vous créez une classe Utilisateur, vous pouvez la réutiliser dans plusieurs projets.

En PHP, on utilise le mot "class" pour créer une classe, "new" pour créer un objet, et "->" pour accéder aux propriétés et méthodes.',
                'useCases' => [
                    'Applications web : créer des classes User, Product, Order pour structurer le code',
                    'Frameworks : Symfony, Laravel utilisent massivement POO pour leur architecture',
                    'Réutilisabilité : classe EmailService utilisable dans plusieurs projets',
                    'Gestion complexité : grands projets mieux organisés avec classes et objets',
                    'Travail équipe : chacun travaille sur ses classes sans conflit',
                    'Tests : classes isolées plus faciles à tester unitairement'
                ],
                'warnings' => [
                    'Courbe apprentissage : POO plus complexe que procédural pour débutants',
                    'Over-engineering : ne pas créer classes pour tout, parfois fonction simple suffit',
                    'Performance : objets consomment plus mémoire que variables simples',
                    'Mauvais design : classes mal conçues rendent code plus complexe que procédural'
                ],
                'bestPractices' => [
                    'Commencer simple : une classe par concept métier (User, Product, pas Utility)',
                    'Nommage clair : classes en PascalCase (UserController, ProductService)',
                    'Responsabilité unique : une classe fait une seule chose bien',
                    'Composition over inheritance : préférer "utiliser" qu\'hériter si possible',
                    'Documentation : PHPDoc sur classes et méthodes publiques'
                ],
                'resources' => [
                    ['label' => 'POO en PHP', 'url' => 'https://www.php.net/manual/fr/language.oop5.php', 'icon' => '📖'],
                    ['label' => 'POO Grafikart', 'url' => 'https://grafikart.fr/formations/programmation-objet-php', 'icon' => '🎥']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-classes_et_objets', 'label' => 'Classes et objets'],
                    ['id' => 'modal-visibilite_encapsulation', 'label' => 'Visibilité et encapsulation'],
                    ['id' => 'modal-heritage', 'label' => 'Héritage']
                ]
            ],
            'classes_et_objets' => [
                'description' => 'Une classe est un modèle ou un plan pour créer des objets. Un objet est une instance d\'une classe, contenant des données (propriétés) et des comportements (méthodes).',
                'example' => 'class Voiture {\n    public $marque;\n    public $couleur;\n    \n    public function demarrer() {\n        return "La voiture démarre";\n    }\n}\n\n$maVoiture = new Voiture();\n$maVoiture->marque = "Toyota";\necho $maVoiture->demarrer();',
                'details' => 'Une classe est comme un moule à gâteau : elle définit la forme mais n\'est pas le gâteau lui-même. Un objet est le gâteau créé avec ce moule. On peut créer plusieurs objets (plusieurs gâteaux) à partir d\'une seule classe (un seul moule).

Pour créer une classe, on utilise le mot "class" suivi du nom. Le nom commence toujours par une majuscule. À l\'intérieur, on met des propriétés (variables) et des méthodes (fonctions).

Pour créer un objet, on utilise "new NomClasse()". Cet objet est une instance de la classe. On peut créer autant d\'instances qu\'on veut, chacune avec ses propres valeurs.

Pour accéder aux propriétés et méthodes, on utilise la flèche -> : $objet->propriete ou $objet->methode(). À l\'intérieur de la classe, on utilise $this pour parler de l\'objet lui-même.',
                'useCases' => [
                    'Entités métier : classe User pour gérer utilisateurs, Product pour produits',
                    'Services : classe EmailService pour envoyer emails, PDFGenerator pour PDFs',
                    'Collections : créer plusieurs objets similaires (liste utilisateurs)',
                    'Modélisation : représenter concepts réels en code (Commande, Facture)',
                    'Configuration : classe Config garde paramètres application',
                    'APIs : classes pour structures données JSON retournées'
                ],
                'warnings' => [
                    'Nommage : toujours majuscule début nom classe, sinon erreur convention',
                    'Oubli new : appeler classe sans new génère erreur fatale',
                    'Propriétés non initialisées : accéder propriété non définie génère notice',
                    'Confusion $this : oublier $this-> pour accéder propriétés classe génère erreur'
                ],
                'bestPractices' => [
                    'Un fichier par classe : facilite organisation et autoloading',
                    'Nommage descriptif : User pas U, ProductService pas PS',
                    'Initialiser propriétés : donner valeurs défaut ou via constructeur',
                    'Typer propriétés : depuis PHP 7.4, définir types propriétés explicitement',
                    'Documentation : commenter classe explique son rôle, responsabilité'
                ],
                'resources' => [
                    ['label' => 'Classes et objets PHP', 'url' => 'https://www.php.net/manual/fr/language.oop5.basic.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-introduction', 'label' => 'Introduction POO'],
                    ['id' => 'modal-proprietes_et_methodes', 'label' => 'Propriétés et méthodes'],
                    ['id' => 'modal-constructeur_destructeur', 'label' => 'Constructeur']
                ]
            ],
            'proprietes_et_methodes' => [
                'description' => 'Les propriétés sont des variables appartenant à une classe. Les méthodes sont des fonctions définies dans une classe qui peuvent agir sur les propriétés de l\'objet.',
                'example' => 'class Personne {\n    public $nom;\n    public $age;\n    \n    public function sePresenter() {\n        return "Je suis " . $this->nom . ", j\'ai " . $this->age . " ans";\n    }\n    \n    public function vieillir() {\n        $this->age++;\n    }\n}',
                'details' => 'Les propriétés sont les caractéristiques d\'un objet. Comme une voiture a une marque et une couleur, une classe Voiture aura des propriétés $marque et $couleur. On les déclare avec un niveau de visibilité (public, private, protected).

Les méthodes sont les actions qu\'un objet peut faire. Une voiture peut démarrer, donc la classe Voiture aura une méthode demarrer(). Les méthodes sont comme des fonctions mais à l\'intérieur d\'une classe.

$this est un mot spécial qui signifie "l\'objet actuel". Quand vous êtes dans une méthode et voulez accéder à une propriété de l\'objet, vous écrivez $this->propriete. C\'est comme dire "mon nom" au lieu de "le nom".

Depuis PHP 7.4, on peut typer les propriétés : public string $nom. Depuis PHP 8.0, on peut les déclarer directement dans le constructeur avec "public" devant : __construct(public string $nom).',
                'useCases' => [
                    'État objet : propriétés stockent données courantes (User->email, Product->price)',
                    'Comportement : méthodes manipulent état (User->activate(), Order->cancel())',
                    'Getters/Setters : méthodes accès contrôlé propriétés privées',
                    'Calculs : méthodes calculent valeurs depuis propriétés (Cart->getTotal())',
                    'Validation : méthodes vérifient données avant modification état',
                    'Transformation : méthodes retournent données format différent (User->toArray())'
                ],
                'warnings' => [
                    'Oubli $this-> : écrire $nom au lieu $this->nom cherche variable locale',
                    'Propriétés publiques : accès direct casse encapsulation, préférer méthodes',
                    'Méthodes trop longues : si > 20 lignes, diviser en sous-méthodes',
                    'Side effects : méthodes getter ne doivent pas modifier état objet'
                ],
                'bestPractices' => [
                    'Visibilité restrictive : commencer private, ouvrir si nécessaire',
                    'Typage propriétés : toujours typer depuis PHP 7.4 (public int $age)',
                    'Nommage : propriétés camelCase ($firstName), méthodes verbe (getUserName())',
                    'Getters/Setters : créer pour accès propriétés privées',
                    'Documentation : PHPDoc type et description chaque propriété/méthode'
                ],
                'resources' => [
                    ['label' => 'Propriétés PHP', 'url' => 'https://www.php.net/manual/fr/language.oop5.properties.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-classes_et_objets', 'label' => 'Classes et objets'],
                    ['id' => 'modal-visibilite_encapsulation', 'label' => 'Visibilité'],
                    ['id' => 'modal-constructeur_destructeur', 'label' => 'Constructeur']
                ]
            ],
            'visibilite_encapsulation' => [
                'description' => 'La visibilité contrôle l\'accès aux propriétés et méthodes. Public : accessible partout, Private : accessible uniquement dans la classe, Protected : accessible dans la classe et ses héritiers.',
                'example' => 'class CompteBancaire {\n    public $titulaire;        // Accessible partout\n    private $solde;           // Accessible uniquement dans cette classe\n    protected $numeroCompte;  // Accessible dans cette classe et ses enfants\n    \n    public function deposer($montant) {\n        $this->solde += $montant; // OK, on est dans la classe\n    }\n}',
                'details' => 'La visibilité définit qui peut voir et modifier les propriétés et méthodes. Il y a 3 niveaux :

**Public** : tout le monde peut y accéder, de partout dans le code. Utilisez public pour les méthodes que vous voulez utiliser de l\'extérieur (comme getSolde()).

**Private** : accessible seulement à l\'intérieur de la classe elle-même. Personne d\'autre ne peut y toucher, même pas les classes enfants. Utilisez private pour les données sensibles (comme le mot de passe) ou les détails internes.

**Protected** : accessible dans la classe ET dans les classes qui en héritent, mais pas de l\'extérieur. C\'est un entre-deux.

L\'encapsulation est le principe de cacher les détails internes. C\'est comme une voiture : vous utilisez le volant (public) mais vous ne touchez pas directement au moteur (private). Cela protège vos données et permet de changer le code interne sans casser l\'utilisation externe.',
                'useCases' => [
                    'Protection données : private $password empêche accès direct mot de passe',
                    'Validation : setter public valide avant modifier propriété private',
                    'Héritage : protected pour méthodes utilisées classes enfants pas externe',
                    'API stable : public seulement nécessaire, private peut changer sans impact',
                    'Sécurité : CompteBancaire->solde private, modification via deposer() validé',
                    'Maintenance : changer implémentation private sans casser code externe'
                ],
                'warnings' => [
                    'Tout public : ne pas mettre tout public par facilité, casse encapsulation',
                    'Accès private : essayer accéder propriété private depuis extérieur génère erreur',
                    'Protected mal compris : accessible enfants mais PAS depuis extérieur classe',
                    'Changer visibilité : passer public à private = breaking change utilisateurs'
                ],
                'bestPractices' => [
                    'Défaut private : toujours commencer private, ouvrir si vraiment nécessaire',
                    'Getters/Setters publics : accès contrôlé propriétés privées',
                    'Protected héritage : utiliser si classes enfants besoin accès',
                    'API minimale : exposer minimum méthodes public, garder détails private',
                    'Cohérence : si $nom private, créer getNom() et setNom() publics'
                ],
                'resources' => [
                    ['label' => 'Visibilité PHP', 'url' => 'https://www.php.net/manual/fr/language.oop5.visibility.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-proprietes_et_methodes', 'label' => 'Propriétés et méthodes'],
                    ['id' => 'modal-heritage', 'label' => 'Héritage'],
                    ['id' => 'modal-classes_et_objets', 'label' => 'Classes et objets']
                ]
            ],
            'constructeur_destructeur' => [
                'description' => 'Le constructeur (__construct) est appelé automatiquement lors de la création d\'un objet. Le destructeur (__destruct) est appelé lors de la destruction de l\'objet.',
                'example' => 'class Utilisateur {\n    private $nom;\n    private $email;\n    \n    public function __construct($nom, $email) {\n        $this->nom = $nom;\n        $this->email = $email;\n        echo "Utilisateur créé: $nom";\n    }\n    \n    public function __destruct() {\n        echo "Utilisateur supprimé: " . $this->nom;\n    }\n}',
                'details' => 'Le constructeur est une méthode spéciale qui s\'exécute automatiquement quand on crée un objet avec "new". Il sert à initialiser les propriétés de l\'objet. C\'est comme préparer une maison neuve : mettre les meubles, brancher l\'électricité, etc.

On écrit __construct() avec deux underscores au début. On peut lui donner des paramètres : new User($nom, $email) appelle __construct($nom, $email). C\'est très pratique pour créer des objets déjà configurés.

Le destructeur __destruct() s\'exécute quand l\'objet est détruit (fin du script ou unset($objet)). On l\'utilise rarement, sauf pour fermer des connexions ou libérer des ressources.

Depuis PHP 8.0, on peut déclarer les propriétés directement dans le constructeur : __construct(public string $nom). PHP crée automatiquement la propriété.',
                'useCases' => [
                    'Initialisation : donner valeurs initiales propriétés lors création',
                    'Validation : vérifier paramètres valides avant créer objet',
                    'Dependencies : injecter services nécessaires (new User($database))',
                    'Configuration : new DatabaseConnection($host, $user, $pass)',
                    'Destructeur : fermer connexion BDD automatiquement fin objet',
                    'Logs : enregistrer création/destruction objets importants'
                ],
                'warnings' => [
                    'Trop logique constructeur : éviter opérations lourdes, garder simple',
                    'Exceptions constructeur : si erreur, objet pas créé, peut causer bugs',
                    'Destructeur timing : ordre destruction pas garanti, éviter logique complexe',
                    'Oubli parent : si héritage, appeler parent::__construct() si nécessaire'
                ],
                'bestPractices' => [
                    'Typage paramètres : __construct(string $nom, int $age) validation auto',
                    'Property promotion PHP 8 : __construct(public string $nom) concis',
                    'Valeurs par défaut : __construct($nom, $actif = true) flexibilité',
                    'Validation basique : vérifier paramètres cohérents, throw si invalide',
                    'Éviter destructeur : rarement nécessaire, PHP gère mémoire automatiquement'
                ],
                'resources' => [
                    ['label' => 'Constructeurs PHP', 'url' => 'https://www.php.net/manual/fr/language.oop5.decon.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-classes_et_objets', 'label' => 'Classes et objets'],
                    ['id' => 'modal-proprietes_et_methodes', 'label' => 'Propriétés et méthodes'],
                    ['id' => 'modal-visibilite_encapsulation', 'label' => 'Visibilité']
                ]
            ],
            'heritage' => [
                'description' => 'L\'héritage permet à une classe enfant d\'hériter des propriétés et méthodes d\'une classe parent avec le mot-clé "extends". Cela favorise la réutilisabilité du code.',
                'example' => 'class Animal {\n    protected $nom;\n    \n    public function manger() {\n        return $this->nom . " mange";\n    }\n}\n\nclass Chien extends Animal {\n    public function aboyer() {\n        return $this->nom . " aboie: Woof!";\n    }\n}\n\n$monChien = new Chien();\n$monChien->nom = "Rex";',
                'details' => 'L\'héritage permet de créer une nouvelle classe basée sur une classe existante. La classe enfant hérite (récupère) toutes les propriétés et méthodes publiques et protected de la classe parent.

On utilise le mot "extends" : class Chien extends Animal. Cela signifie "Chien est un type d\'Animal". Le chien peut tout faire qu\'un animal peut faire, PLUS des choses spécifiques aux chiens (comme aboyer).

La classe enfant peut ajouter de nouvelles propriétés et méthodes. Elle peut aussi remplacer (override) une méthode du parent en créant une méthode avec le même nom.

Pour appeler une méthode du parent, on utilise parent::methode(). C\'est utile quand on veut étendre le comportement du parent, pas le remplacer complètement. PHP ne supporte qu\'un seul parent (pas d\'héritage multiple), mais on peut utiliser des traits pour partager du code.',
                'useCases' => [
                    'Hiérarchie entités : User -> AdminUser, Customer -> PremiumCustomer',
                    'Réutilisation code : Controller parent, HomeController extends Controller',
                    'Spécialisation : Vehicle parent, Car/Bike enfants ajoutent spécificités',
                    'Frameworks : vos classes héritent classes framework (AbstractController)',
                    'Exceptions : InvalidEmailException extends Exception personnalisées',
                    'Modèles : BaseModel parent, User/Product héritent méthodes CRUD'
                ],
                'warnings' => [
                    'Héritage profond : éviter chaînes > 3 niveaux, devient complexe maintenir',
                    'Couplage fort : enfant dépend parent, changer parent casse enfants',
                    'Composition préférable : souvent mieux "utiliser" objet qu\'hériter',
                    'Protected exposition : protected parent accessible tous enfants, attention'
                ],
                'bestPractices' => [
                    'Relation "est-un" : utiliser héritage seulement si A est vraiment un type de B',
                    'Limiter profondeur : max 2-3 niveaux héritage, sinon revoir design',
                    'Final classes : déclarer final si classe ne doit pas être héritée',
                    'Appeler parent : parent::__construct() si enfant override constructeur',
                    'Préférer composition : "utiliser" objet souvent meilleur qu\'hériter'
                ],
                'resources' => [
                    ['label' => 'Héritage PHP', 'url' => 'https://www.php.net/manual/fr/language.oop5.inheritance.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-classes_et_objets', 'label' => 'Classes et objets'],
                    ['id' => 'modal-abstraction', 'label' => 'Classes abstraites'],
                    ['id' => 'modal-polymorphisme', 'label' => 'Polymorphisme']
                ]
            ],
            'abstraction' => [
                'description' => 'Les classes abstraites ne peuvent pas être instanciées directement. Elles servent de modèle pour d\'autres classes. Les méthodes abstraites doivent être implémentées par les classes enfants.',
                'example' => 'abstract class Forme {\n    protected $couleur;\n    \n    abstract public function calculerAire();\n    \n    public function definirCouleur($couleur) {\n        $this->couleur = $couleur;\n    }\n}\n\nclass Cercle extends Forme {\n    private $rayon;\n    \n    public function calculerAire() {\n        return pi() * $this->rayon * $this->rayon;\n    }\n}',
                'details' => 'Une classe abstraite est une classe qu\'on ne peut pas utiliser directement avec "new". C\'est un modèle, un plan incomplet que les classes enfants doivent compléter. On la déclare avec le mot "abstract".

Les méthodes abstraites sont des méthodes sans code, juste la signature. C\'est comme dire "toutes les formes doivent pouvoir calculer leur aire, mais chaque forme le fait différemment". Les classes enfants DOIVENT implémenter ces méthodes.

Une classe abstraite peut avoir des méthodes normales (avec du code) ET des méthodes abstraites (sans code). Les méthodes normales sont partagées par tous les enfants. Les méthodes abstraites obligent chaque enfant à fournir sa propre implémentation.

C\'est utile quand vous avez un comportement commun mais des détails spécifiques. Par exemple, tous les véhicules démarrent, mais une voiture et une moto ne démarrent pas de la même façon.',
                'useCases' => [
                    'Classes base : Controller abstrait, PageController concret hérite',
                    'Forcer implémentation : abstract save() oblige enfants implémenter sauvegarde',
                    'Code partagé + spécifique : méthodes communes concrètes, spécifiques abstraites',
                    'Frameworks : AbstractModel force enfants implémenter validation',
                    'Patterns : Template Method pattern utilise méthodes abstraites',
                    'API contracts : définir structure sans détails implémentation'
                ],
                'warnings' => [
                    'Instanciation impossible : new ClasseAbstraite() génère erreur fatale',
                    'Oubli implémentation : enfant concret doit implémenter TOUTES méthodes abstraites',
                    'Visibilité : méthode abstraite protected/public, pas private',
                    'Confusion interface : abstraite peut avoir code, interface non'
                ],
                'bestPractices' => [
                    'Suffixe Base/Abstract : AbstractController, BaseModel clair c\'est abstrait',
                    'Méthodes communes : mettre logique partagée méthodes concrètes classe abstraite',
                    'Documentation : expliquer quelles méthodes enfants doivent implémenter pourquoi',
                    'Typage : typer paramètres/retour méthodes abstraites guide implémentation',
                    'Éviter sur-abstraction : ne pas abstraire si < 3 classes héritent'
                ],
                'resources' => [
                    ['label' => 'Classes abstraites PHP', 'url' => 'https://www.php.net/manual/fr/language.oop5.abstract.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-heritage', 'label' => 'Héritage'],
                    ['id' => 'modal-interfaces', 'label' => 'Interfaces'],
                    ['id' => 'modal-polymorphisme', 'label' => 'Polymorphisme']
                ]
            ],
            'interfaces' => [
                'description' => 'Une interface définit un contrat que les classes doivent respecter. Elle spécifie quelles méthodes une classe doit implémenter, sans fournir l\'implémentation.',
                'example' => 'interface Drawable {\n    public function draw();\n    public function setColor($color);\n}\n\nclass Rectangle implements Drawable {\n    public function draw() {\n        return "Dessine un rectangle";\n    }\n    \n    public function setColor($color) {\n        // Implémentation de la couleur\n    }\n}',
                'details' => 'Une interface est un contrat. C\'est une liste de méthodes qu\'une classe DOIT avoir, mais sans dire comment les faire. C\'est comme un mode d\'emploi : "si tu veux être Drawable (dessinable), tu dois avoir une méthode draw()".

On déclare avec "interface" et on utilise avec "implements". Une classe peut implémenter plusieurs interfaces (contrairement à l\'héritage où on ne peut avoir qu\'un seul parent). Par exemple : class User implements Jsonable, Cacheable.

Une interface ne contient QUE des signatures de méthodes, pas de code. Toutes les méthodes sont automatiquement publiques. Une interface ne peut pas avoir de propriétés (sauf des constantes).

C\'est très utile pour définir ce qu\'un objet peut faire sans imposer comment il le fait. Plusieurs classes différentes peuvent implémenter la même interface, chacune à sa façon.',
                'useCases' => [
                    'Contrats APIs : interface EmailServiceInterface, classes Gmail/Sendgrid implémentent',
                    'Polymorphisme : traiter objets différents de manière uniforme',
                    'Dépendances : function send(EmailServiceInterface $mailer) accepte toute implémentation',
                    'Standards : PSR interfaces (RequestInterface, ResponseInterface)',
                    'Testing : créer mock implémentant interface pour tests',
                    'Multiple contrats : class User implements Authenticatable, Cacheable, Notifiable'
                ],
                'warnings' => [
                    'Méthodes publiques : interface force méthodes public, pas private/protected',
                    'Pas de code : mettre code dans interface génère erreur syntaxe',
                    'Breaking changes : ajouter méthode interface casse toutes implémentations',
                    'Interfaces vides : éviter interfaces sans méthodes, inutiles'
                ],
                'bestPractices' => [
                    'Suffixe Interface : EmailServiceInterface clair c\'est interface',
                    'Petites interfaces : grouper méthodes liées, éviter interfaces énormes',
                    'Typage paramètres : function process(ProcessableInterface $item) flexibilité',
                    'Documenter comportement : PHPDoc explique contrat, ce que méthodes doivent faire',
                    'Stable API : interfaces changent rarement, réfléchir avant créer'
                ],
                'resources' => [
                    ['label' => 'Interfaces PHP', 'url' => 'https://www.php.net/manual/fr/language.oop5.interfaces.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-abstraction', 'label' => 'Classes abstraites'],
                    ['id' => 'modal-polymorphisme', 'label' => 'Polymorphisme'],
                    ['id' => 'modal-heritage', 'label' => 'Héritage']
                ]
            ],
            'polymorphisme' => [
                'description' => 'Le polymorphisme permet à des objets de types différents de répondre à la même interface de manière différente. Une même méthode peut avoir des comportements différents selon la classe.',
                'example' => 'interface Vehicule {\n    public function demarrer();\n}\n\nclass Voiture implements Vehicule {\n    public function demarrer() { return "Tourne la clé"; }\n}\n\nclass Moto implements Vehicule {\n    public function demarrer() { return "Appuie sur le bouton"; }\n}\n\n// Même méthode, comportements différents',
                'details' => 'Le polymorphisme signifie "plusieurs formes". C\'est quand des objets différents peuvent répondre au même appel de méthode, mais chacun le fait à sa façon.

Exemple simple : vous dites "démarre" à une voiture et à une moto. Les deux démarrent, mais pas de la même manière. En code, vous appelez $vehicule->demarrer() sans savoir si c\'est une voiture ou une moto, et chacun fait ce qu\'il faut.

C\'est très puissant car vous pouvez écrire du code qui fonctionne avec "n\'importe quel Vehicule" sans connaître le type exact. Vous traitez tous les véhicules de la même façon, et chacun se comporte correctement.

Le polymorphisme fonctionne avec l\'héritage (classes enfants) et les interfaces. C\'est un des piliers de la POO qui rend le code flexible et extensible.',
                'useCases' => [
                    'Traitement uniforme : boucle sur array véhicules, appel demarrer() sur chacun',
                    'Stratégies paiement : PaymentInterface, CreditCard/PayPal/Crypto implémentent',
                    'Notifications : NotifierInterface, EmailNotifier/SMSNotifier/PushNotifier',
                    'Exporters : ExporterInterface, PDFExporter/CSVExporter/JSONExporter',
                    'Logger : LoggerInterface, FileLogger/DatabaseLogger/CloudLogger',
                    'Validation : ValidatorInterface, EmailValidator/PhoneValidator différents'
                ],
                'warnings' => [
                    'Type checking : éviter if($obj instanceof Type) détruit polymorphisme',
                    'Méthodes spécifiques : appeler méthode pas dans interface casse polymorphisme',
                    'LSP violation : enfant doit pouvoir remplacer parent sans surprise',
                    'Interface trop large : méthodes inutiles certaines implémentations problématique'
                ],
                'bestPractices' => [
                    'Typage interface : function process(PaymentInterface $payment) accepte tous',
                    'Éviter instanceof : si besoin instanceof, revoir design probablement',
                    'Liskov Substitution : enfant remplace parent sans changer comportement',
                    'Interface segregation : petites interfaces spécialisées plutôt que grosse',
                    'Dependency injection : injecter interface, pas implémentation concrète'
                ],
                'resources' => [
                    ['label' => 'Polymorphisme PHP', 'url' => 'https://www.php.net/manual/fr/language.oop5.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-interfaces', 'label' => 'Interfaces'],
                    ['id' => 'modal-heritage', 'label' => 'Héritage'],
                    ['id' => 'modal-abstraction', 'label' => 'Abstraction']
                ]
            ],
            'proprietes_methodes_statiques' => [
                'description' => 'Les propriétés et méthodes statiques appartiennent à la classe plutôt qu\'à une instance. Elles sont accessibles sans créer d\'objet, avec l\'opérateur ::',
                'example' => 'class Mathutils {\n    public static $pi = 3.14159;\n    \n    public static function aire_cercle($rayon) {\n        return self::$pi * $rayon * $rayon;\n    }\n}\n\n// Utilisation sans instanciation\necho Mathutils::$pi;\necho Mathutils::aire_cercle(5);',
                'details' => 'Normalement, chaque objet a ses propres données. Mais parfois, on veut une donnée ou une fonction qui appartient à la classe elle-même, pas aux objets. C\'est le rôle de "static".

Une propriété statique est partagée par tous. Si vous changez Config::$debug, ça change pour tout le monde. Une méthode statique peut être appelée sans créer d\'objet : Math::max(5, 10).

On accède avec :: (double deux-points) au lieu de ->. À l\'intérieur de la classe, on utilise self:: pour parler de la classe elle-même. Attention : une méthode statique ne peut pas utiliser $this car elle n\'appartient pas à un objet spécifique.

C\'est utile pour les fonctions utilitaires (Math::abs()) ou les données partagées (Config::$env), mais à éviter pour les données d\'instance.',
                'useCases' => [
                    'Utilitaires : StringHelper::slugify(), ArrayHelper::flatten()',
                    'Configuration : Config::get("database.host") accès global',
                    'Compteurs : User::$count garde nombre utilisateurs créés',
                    'Factory : User::create($data) méthode création objets',
                    'Constantes : Database::HOST, Database::PORT valeurs fixes',
                    'Singleton : getInstance() retourne instance unique classe'
                ],
                'warnings' => [
                    'État global : propriétés statiques = variables globales, éviter si possible',
                    'Pas $this : méthode statique ne peut pas utiliser $this, génère erreur',
                    'Tests difficiles : static complique tests unitaires, dépendances cachées',
                    'Late static binding : self vs static comportement différent héritage'
                ],
                'bestPractices' => [
                    'Méthodes utilitaires uniquement : si pas besoin état objet, sinon instance',
                    'Éviter état statique : propriétés statiques mutables problématiques',
                    'Constantes plutôt : const PI = 3.14 mieux que static $pi',
                    'Factory methods : static create() acceptable pour construction objets',
                    'Documentation : indiquer méthode statique @static PHPDoc'
                ],
                'resources' => [
                    ['label' => 'Static PHP', 'url' => 'https://www.php.net/manual/fr/language.oop5.static.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-classes_et_objets', 'label' => 'Classes et objets'],
                    ['id' => 'modal-proprietes_et_methodes', 'label' => 'Propriétés et méthodes'],
                    ['id' => 'modal-visibilite_encapsulation', 'label' => 'Visibilité']
                ]
            ],
            'traits' => [
                'description' => 'Les traits permettent de réutiliser du code dans plusieurs classes. C\'est une façon d\'inclure des méthodes dans plusieurs classes sans utiliser l\'héritage.',
                'example' => 'trait Timestampable {\n    public $created_at;\n    public $updated_at;\n    \n    public function touch() {\n        $this->updated_at = date("Y-m-d H:i:s");\n    }\n}\n\nclass Article {\n    use Timestampable;\n    public $titre;\n}\n\nclass Commentaire {\n    use Timestampable;\n    public $contenu;\n}',
                'details' => 'Imaginez que vous voulez ajouter les mêmes fonctions à plusieurs classes différentes, mais l\'héritage ne convient pas (pas de lien logique). Les traits sont la solution.

Un trait est comme un "morceau de code" que vous pouvez copier-coller automatiquement dans vos classes. Vous écrivez une fois "trait Logger" avec une méthode log(), puis vous faites "use Logger" dans User, Article, Product... et tous auront la méthode.

Ce n\'est PAS de l\'héritage. C\'est comme si PHP copiait le code du trait directement dans votre classe. Vous pouvez utiliser plusieurs traits en même temps : use Logger, Timestampable, SoftDelete.

Les traits évitent la duplication et permettent de composer des classes avec des comportements réutilisables. Mais attention : trop de traits rend le code difficile à suivre.',
                'useCases' => [
                    'Logger : trait Logger log() pour User, Article, Order même fonction',
                    'Timestamps : trait Timestampable créé_le/modifié_le automatiques',
                    'Soft Delete : trait SoftDelete suppression logique (deleted_at)',
                    'Validation : trait Validable méthodes validation partagées',
                    'Serialization : trait JsonSerializable conversion JSON uniforme',
                    'UUID : trait HasUuid génère IDs uniques pour entités'
                ],
                'warnings' => [
                    'Conflit noms : deux traits avec même méthode, préciser avec insteadof',
                    'Complexité : trop traits = code difficile suivre, privilégier composition',
                    'Ordre résolution : trait > classe parente, comportement inattendu possible',
                    'Pas de typage : impossible typer "use trait", contrairement interfaces'
                ],
                'bestPractices' => [
                    'Comportements transversaux : traits pour fonctions orthogonales (log, timestamp)',
                    'Pas de logique métier : traits pour utilitaires, pas règles business',
                    'Documentation : commenter trait et méthodes publiques clairement',
                    'Interfaces aussi : combiner trait + interface pour contrat clair',
                    'Nommage explicite : Logger, Timestampable noms clairs comportement'
                ],
                'resources' => [
                    ['label' => 'Traits PHP', 'url' => 'https://www.php.net/manual/fr/language.oop5.traits.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-classes_et_objets', 'label' => 'Classes et objets'],
                    ['id' => 'modal-heritage', 'label' => 'Héritage'],
                    ['id' => 'modal-interfaces', 'label' => 'Interfaces']
                ]
            ],
            'namespaces' => [
                'description' => 'Les espaces de noms (namespaces) permettent d\'organiser le code et d\'éviter les conflits de noms entre classes. Ils créent des "dossiers virtuels" pour les classes.',
                'example' => 'namespace App\\Model;\n\nclass User {\n    // Code de la classe\n}\n\n// Dans un autre fichier:\nuse App\\Model\\User;\n\n$user = new User();\n\n// Ou sans use:\n$user = new \\App\\Model\\User();',
                'details' => 'Quand votre projet grandit, vous avez plein de classes. Comment éviter que deux classes s\'appellent "User" ? Les namespaces organisent vos classes comme des dossiers organisent vos fichiers.

"namespace App\\Model;" au début du fichier dit "cette classe User est dans App\\Model". Une autre "namespace App\\Controller;" peut avoir sa propre classe User sans conflit. C\'est comme avoir "photos/vacances/plage.jpg" et "photos/famille/plage.jpg".

Pour utiliser une classe, vous faites "use App\\Model\\User;" en haut du fichier, puis simplement "new User()". Ou le chemin complet : "new \\App\\Model\\User()". Le \\ au début signifie "depuis la racine".

Les namespaces rendent le code organisé et clair. Symfony utilise "App\\Controller, App\\Entity" par exemple. C\'est une bonne pratique moderne.',
                'useCases' => [
                    'Organisation : App\\Controller, App\\Model, App\\Service structure claire',
                    'Éviter conflits : deux classes User différents namespaces coexistent',
                    'Autoloading : PSR-4 charge automatiquement App\\Model\\User.php',
                    'Vendor : librairies externes leur propre namespace (Symfony\\Component\\)',
                    'Refactoring : déplacer classes en changeant namespace, pas dossiers physiques',
                    'Tests : App\\Tests namespace séparé pour tests unitaires'
                ],
                'warnings' => [
                    'Backslash : utiliser \\ pas /, namespace App\\Model pas App/Model',
                    'Case-sensitive : App\\model ≠ App\\Model, respecter casse exacte',
                    'Use global : \\DateTime besoin \\ début pour classes PHP natives',
                    'Autoload manquant : namespace ne charge pas automatiquement, besoin composer'
                ],
                'bestPractices' => [
                    'PSR-4 standard : namespace correspond arborescence dossiers (App\\Model → src/Model/)',
                    'Use statements : toujours déclarer use en haut, éviter chemins complets',
                    'Un namespace par fichier : jamais deux namespace dans même fichier',
                    'Nommage cohérent : App\\Controller\\UserController convention claire',
                    'Alias si conflit : use App\\Model\\User as ModelUser évite collision'
                ],
                'resources' => [
                    ['label' => 'Namespaces PHP', 'url' => 'https://www.php.net/manual/fr/language.namespaces.php', 'icon' => '📖'],
                    ['label' => 'PSR-4 Autoload', 'url' => 'https://www.php-fig.org/psr/psr-4/', 'icon' => '🔗']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-classes_et_objets', 'label' => 'Classes et objets'],
                    ['id' => 'modal-traits', 'label' => 'Traits'],
                    ['id' => 'modal-interfaces', 'label' => 'Interfaces']
                ]
            ],
            'exceptions_poo' => [
                'description' => 'La gestion d\'erreurs en POO utilise les exceptions. On peut créer des exceptions personnalisées en héritant de la classe Exception de base.',
                'example' => 'class AgeInvalideException extends Exception {\n    public function __construct($age) {\n        parent::__construct("Âge invalide: $age");\n    }\n}\n\nclass Personne {\n    public function setAge($age) {\n        if ($age < 0) {\n            throw new AgeInvalideException($age);\n        }\n        $this->age = $age;\n    }\n}',
                'details' => 'Les exceptions gèrent les erreurs de façon propre en POO. Au lieu de retourner false ou null quand ça plante, vous "lancez" (throw) une exception qui dit exactement ce qui ne va pas.

Vous créez vos propres exceptions en héritant de Exception : "class EmailInvalideException extends Exception". Dans votre code, si l\'email est mauvais, vous faites "throw new EmailInvalideException()". Le programme s\'arrête et cherche un try/catch qui peut gérer l\'erreur.

Celui qui utilise votre code fait "try { $user->setEmail($email); } catch (EmailInvalideException $e) { ... }" pour attraper l\'erreur et réagir. C\'est mieux que vérifier des codes d\'erreur partout.

Vous pouvez avoir plusieurs types d\'exceptions (EmailInvalideException, AgeInvalideException) et les attraper séparément. C\'est la façon moderne de gérer les erreurs.',
                'useCases' => [
                    'Validation : EmailInvalideException, AgeNegatifException erreurs métier',
                    'Base données : DatabaseException connexion échouée ou requête erreur',
                    'Fichiers : FileNotFoundException fichier introuvable lecture',
                    'API : ApiException réponse serveur erreur HTTP 500',
                    'Authentification : InvalidCredentialsException login mot passe incorrects',
                    'Business logic : InsufficientFundsException compte solde insuffisant'
                ],
                'warnings' => [
                    'Trop général : catch (Exception $e) attrape tout, masque bugs réels',
                    'Exception vide : throw new Exception() sans message inutile, mettre contexte',
                    'Flux contrôle : exceptions pour erreurs, pas logique normale (if/else)',
                    'Performance : try/catch coûteux, pas dans boucles intensives si évitable'
                ],
                'bestPractices' => [
                    'Exceptions spécifiques : créer classes exception métier parlantes',
                    'Messages clairs : "Email invalide: abc" mieux que "Erreur validation"',
                    'Hiérarchie : DatabaseException > ConnectionException, attraper niveau voulu',
                    'Finally : finally { ... } exécute toujours, fermer connexions ressources',
                    'Log exceptions : logger toutes exceptions non gérées pour debugging'
                ],
                'resources' => [
                    ['label' => 'Exceptions PHP', 'url' => 'https://www.php.net/manual/fr/language.exceptions.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-classes_et_objets', 'label' => 'Classes et objets'],
                    ['id' => 'modal-heritage', 'label' => 'Héritage'],
                    ['id' => 'modal-constructeur_destructeur', 'label' => 'Constructeur']
                ]
            ],
        ];

        return $this->render('poo/index.html.twig', [
            'data' => $dataPOO,
        ]);
    }
}
