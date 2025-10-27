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
            ],
            'classes_et_objets' => [
                'description' => 'Une classe est un modèle ou un plan pour créer des objets. Un objet est une instance d\'une classe, contenant des données (propriétés) et des comportements (méthodes).',
                'example' => 'class Voiture {\n    public $marque;\n    public $couleur;\n    \n    public function demarrer() {\n        return "La voiture démarre";\n    }\n}\n\n$maVoiture = new Voiture();\n$maVoiture->marque = "Toyota";\necho $maVoiture->demarrer();',
            ],
            'proprietes_et_methodes' => [
                'description' => 'Les propriétés sont des variables appartenant à une classe. Les méthodes sont des fonctions définies dans une classe qui peuvent agir sur les propriétés de l\'objet.',
                'example' => 'class Personne {\n    public $nom;\n    public $age;\n    \n    public function sePresenter() {\n        return "Je suis " . $this->nom . ", j\'ai " . $this->age . " ans";\n    }\n    \n    public function vieillir() {\n        $this->age++;\n    }\n}',
            ],
            'visibilite_encapsulation' => [
                'description' => 'La visibilité contrôle l\'accès aux propriétés et méthodes. Public : accessible partout, Private : accessible uniquement dans la classe, Protected : accessible dans la classe et ses héritiers.',
                'example' => 'class CompteBancaire {\n    public $titulaire;        // Accessible partout\n    private $solde;           // Accessible uniquement dans cette classe\n    protected $numeroCompte;  // Accessible dans cette classe et ses enfants\n    \n    public function deposer($montant) {\n        $this->solde += $montant; // OK, on est dans la classe\n    }\n}',
            ],
            'constructeur_destructeur' => [
                'description' => 'Le constructeur (__construct) est appelé automatiquement lors de la création d\'un objet. Le destructeur (__destruct) est appelé lors de la destruction de l\'objet.',
                'example' => 'class Utilisateur {\n    private $nom;\n    private $email;\n    \n    public function __construct($nom, $email) {\n        $this->nom = $nom;\n        $this->email = $email;\n        echo "Utilisateur créé: $nom";\n    }\n    \n    public function __destruct() {\n        echo "Utilisateur supprimé: " . $this->nom;\n    }\n}',
            ],
            'heritage' => [
                'description' => 'L\'héritage permet à une classe enfant d\'hériter des propriétés et méthodes d\'une classe parent avec le mot-clé "extends". Cela favorise la réutilisabilité du code.',
                'example' => 'class Animal {\n    protected $nom;\n    \n    public function manger() {\n        return $this->nom . " mange";\n    }\n}\n\nclass Chien extends Animal {\n    public function aboyer() {\n        return $this->nom . " aboie: Woof!";\n    }\n}\n\n$monChien = new Chien();\n$monChien->nom = "Rex";',
            ],
            'abstraction' => [
                'description' => 'Les classes abstraites ne peuvent pas être instanciées directement. Elles servent de modèle pour d\'autres classes. Les méthodes abstraites doivent être implémentées par les classes enfants.',
                'example' => 'abstract class Forme {\n    protected $couleur;\n    \n    abstract public function calculerAire();\n    \n    public function definirCouleur($couleur) {\n        $this->couleur = $couleur;\n    }\n}\n\nclass Cercle extends Forme {\n    private $rayon;\n    \n    public function calculerAire() {\n        return pi() * $this->rayon * $this->rayon;\n    }\n}',
            ],
            'interfaces' => [
                'description' => 'Une interface définit un contrat que les classes doivent respecter. Elle spécifie quelles méthodes une classe doit implémenter, sans fournir l\'implémentation.',
                'example' => 'interface Drawable {\n    public function draw();\n    public function setColor($color);\n}\n\nclass Rectangle implements Drawable {\n    public function draw() {\n        return "Dessine un rectangle";\n    }\n    \n    public function setColor($color) {\n        // Implémentation de la couleur\n    }\n}',
            ],
            'polymorphisme' => [
                'description' => 'Le polymorphisme permet à des objets de types différents de répondre à la même interface de manière différente. Une même méthode peut avoir des comportements différents selon la classe.',
                'example' => 'interface Vehicule {\n    public function demarrer();\n}\n\nclass Voiture implements Vehicule {\n    public function demarrer() { return "Tourne la clé"; }\n}\n\nclass Moto implements Vehicule {\n    public function demarrer() { return "Appuie sur le bouton"; }\n}\n\n// Même méthode, comportements différents',
            ],
            'proprietes_methodes_statiques' => [
                'description' => 'Les propriétés et méthodes statiques appartiennent à la classe plutôt qu\'à une instance. Elles sont accessibles sans créer d\'objet, avec l\'opérateur ::',
                'example' => 'class Mathutils {\n    public static $pi = 3.14159;\n    \n    public static function aire_cercle($rayon) {\n        return self::$pi * $rayon * $rayon;\n    }\n}\n\n// Utilisation sans instanciation\necho Mathutils::$pi;\necho Mathutils::aire_cercle(5);',
            ],
            'traits' => [
                'description' => 'Les traits permettent de réutiliser du code dans plusieurs classes. C\'est une façon d\'inclure des méthodes dans plusieurs classes sans utiliser l\'héritage.',
                'example' => 'trait Timestampable {\n    public $created_at;\n    public $updated_at;\n    \n    public function touch() {\n        $this->updated_at = date("Y-m-d H:i:s");\n    }\n}\n\nclass Article {\n    use Timestampable;\n    public $titre;\n}\n\nclass Commentaire {\n    use Timestampable;\n    public $contenu;\n}',
            ],
            'namespaces' => [
                'description' => 'Les espaces de noms (namespaces) permettent d\'organiser le code et d\'éviter les conflits de noms entre classes. Ils créent des "dossiers virtuels" pour les classes.',
                'example' => 'namespace App\\Model;\n\nclass User {\n    // Code de la classe\n}\n\n// Dans un autre fichier:\nuse App\\Model\\User;\n\n$user = new User();\n\n// Ou sans use:\n$user = new \\App\\Model\\User();',
            ],
            'exceptions_poo' => [
                'description' => 'La gestion d\'erreurs en POO utilise les exceptions. On peut créer des exceptions personnalisées en héritant de la classe Exception de base.',
                'example' => 'class AgeInvalideException extends Exception {\n    public function __construct($age) {\n        parent::__construct("Âge invalide: $age");\n    }\n}\n\nclass Personne {\n    public function setAge($age) {\n        if ($age < 0) {\n            throw new AgeInvalideException($age);\n        }\n        $this->age = $age;\n    }\n}',
            ],
        ];

        return $this->render('poo/index.html.twig', [
            'data' => $dataPOO,
        ]);
    }
}
