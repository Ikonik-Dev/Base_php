<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GlossaireController extends AbstractController
{
    #[Route('/glossaire', name: 'app_glossaire')]
    public function index(): Response
    {
        // Glossaire complet des termes et concepts PHP avec explications pour néophytes
        $glossaire = [
            'PHP' => [
                'definition' => 'PHP: Hypertext Preprocessor - Langage de programmation côté serveur',
                'explication' => 'Imaginez PHP comme un chef cuisinier qui travaille dans la cuisine d\'un restaurant (le serveur). Quand vous commandez un plat (page web), le chef PHP prépare votre commande en utilisant les ingrédients disponibles (données) et vous sert le plat fini (page HTML). Vous ne voyez jamais le chef travailler, seulement le résultat final !',
                'exemple' => '<?php echo "Bonjour le monde !"; ?>'
            ],
            'Variable' => [
                'definition' => 'Conteneur nommé qui stocke une valeur qui peut changer',
                'explication' => 'Une variable est comme une boîte avec une étiquette. Vous pouvez y mettre des choses (valeurs), changer le contenu, et retrouver ce que vous avez mis grâce à l\'étiquette (nom de la variable). En PHP, l\'étiquette commence toujours par le symbole $.',
                'exemple' => '$age = 25; // La boîte "age" contient le nombre 25'
            ],
            'Fonction' => [
                'definition' => 'Bloc de code réutilisable qui effectue une tâche spécifique',
                'explication' => 'Une fonction est comme une machine spécialisée dans votre atelier. Vous lui donnez des matériaux (paramètres), elle fait son travail, et vous renvoie un produit fini (valeur de retour). Une fois créée, vous pouvez l\'utiliser autant de fois que vous voulez !',
                'exemple' => 'function calculerAge($anneeNaissance) { return date("Y") - $anneeNaissance; }'
            ],
            'Classe' => [
                'definition' => 'Modèle ou plan pour créer des objets avec propriétés et méthodes',
                'explication' => 'Une classe est comme le plan d\'une maison. Le plan définit où vont les pièces, la cuisine, etc. Mais ce n\'est qu\'un plan ! Pour avoir une vraie maison, il faut construire (instancier) à partir du plan. Chaque maison construite est un "objet" unique.',
                'exemple' => 'class Voiture { public $couleur; public function demarrer() { } }'
            ],
            'Objet' => [
                'definition' => 'Instance d\'une classe, entité avec des propriétés et des méthodes',
                'explication' => 'Si la classe est le plan de la maison, l\'objet est la maison réelle construite. Vous pouvez construire plusieurs maisons (objets) avec le même plan (classe), mais chacune aura ses propres caractéristiques (couleur, jardin, etc.).',
                'exemple' => '$maVoiture = new Voiture(); $maVoiture->couleur = "rouge";'
            ],
            'Méthode' => [
                'definition' => 'Fonction définie à l\'intérieur d\'une classe',
                'explication' => 'Une méthode est comme une compétence spéciale d\'un objet. Un chien (objet) peut avoir la méthode "aboyer", une voiture peut "démarrer". C\'est ce que l\'objet sait faire.',
                'exemple' => 'public function aboyer() { return "Woof!"; }'
            ],
            'Propriété' => [
                'definition' => 'Variable appartenant à une classe ou un objet',
                'explication' => 'Les propriétés sont les caractéristiques d\'un objet, comme les traits d\'une personne. Une voiture a une couleur, une marque, un nombre de roues... Ces caractéristiques sont ses propriétés.',
                'exemple' => 'public $couleur = "bleu"; private $vitesse = 0;'
            ],
            'Héritage' => [
                'definition' => 'Mécanisme permettant à une classe d\'hériter des propriétés d\'une autre',
                'explication' => 'L\'héritage fonctionne comme dans une famille. Un enfant hérite des traits de ses parents (classe parent), mais peut aussi avoir ses propres spécificités. Un "Chien" hérite d\'Animal (manger, dormir) mais ajoute "aboyer".',
                'exemple' => 'class Chien extends Animal { public function aboyer() { } }'
            ],
            'Encapsulation' => [
                'definition' => 'Principe de masquer les détails internes d\'un objet',
                'explication' => 'L\'encapsulation, c\'est comme une télécommande. Vous appuyez sur "volume +" sans savoir comment ça marche à l\'intérieur. L\'objet cache sa complexité et ne montre que les boutons (méthodes publiques) nécessaires.',
                'exemple' => 'private $motDePasse; public function changerMotDePasse($nouveau) { }'
            ],
            'Polymorphisme' => [
                'definition' => 'Capacité d\'objets différents à répondre à la même interface',
                'explication' => 'Le polymorphisme, c\'est comme dire "démarre" à différents véhicules. Une voiture tourne la clé, une moto appuie sur un bouton, un vélo pédale... Même action, méthodes différentes selon l\'objet.',
                'exemple' => 'interface Vehicule { public function demarrer(); } // Implémenté différemment par Voiture, Moto...'
            ],
            'Interface' => [
                'definition' => 'Contrat définissant les méthodes qu\'une classe doit implémenter',
                'explication' => 'Une interface est comme un contrat de travail. Elle dit "si tu veux être un Développeur, tu DOIS savoir coder(), tester(), documenter()". Elle ne dit pas comment faire, juste ce qui doit être fait.',
                'exemple' => 'interface Drawable { public function draw(); public function setColor($color); }'
            ],
            'Namespace' => [
                'definition' => 'Espace de noms pour organiser et éviter les conflits de noms',
                'explication' => 'Un namespace est comme l\'adresse postale de votre code. Il peut y avoir plusieurs "Jean Dupont" dans le monde, mais un seul au "123 rue de la Paix, Paris". Les namespaces évitent la confusion entre classes du même nom.',
                'exemple' => 'namespace App\\Controller; use App\\Entity\\User;'
            ],
            'Autoload' => [
                'definition' => 'Mécanisme de chargement automatique des classes',
                'explication' => 'L\'autoload est comme un bibliothécaire magique. Quand vous demandez un livre (classe), il va automatiquement le chercher dans les bonnes étagères (dossiers) et vous l\'apporte. Plus besoin de dire où se trouve chaque livre !',
                'exemple' => 'require_once "vendor/autoload.php"; // Composer autoload'
            ],
            'Composer' => [
                'definition' => 'Gestionnaire de dépendances pour PHP',
                'explication' => 'Composer est comme un assistant personnel pour les développeurs. Vous lui dites "j\'ai besoin de cette bibliothèque", et il va la télécharger, l\'installer, et s\'assurer qu\'elle fonctionne bien avec le reste de votre code.',
                'exemple' => 'composer require symfony/console'
            ],
            'Framework' => [
                'definition' => 'Structure de base qui facilite le développement d\'applications',
                'explication' => 'Un framework est comme un kit de construction LEGO thématique. Au lieu de partir de zéro, vous avez déjà les pièces principales et les instructions pour construire votre château (application) plus rapidement et solidement.',
                'exemple' => 'Symfony, Laravel, CodeIgniter sont des frameworks PHP'
            ],
            'MVC' => [
                'definition' => 'Model-View-Controller : pattern d\'architecture logicielle',
                'explication' => 'MVC organise votre code comme un restaurant : le Model est la cuisine (données), la View est la salle (ce que voit le client), le Controller est le serveur (qui fait le lien entre cuisine et client).',
                'exemple' => 'Controller traite la requête → Model récupère les données → View affiche le résultat'
            ],
            'ORM' => [
                'definition' => 'Object-Relational Mapping : technique de mapping objet-base de données',
                'explication' => 'Un ORM est comme un traducteur entre vous et la base de données. Vous parlez en objets PHP, lui traduit en langage SQL pour la base de données, puis retraduit la réponse en objets PHP.',
                'exemple' => 'Doctrine ORM : $user = $userRepository->find(1);'
            ],
            'API' => [
                'definition' => 'Application Programming Interface : interface de programmation',
                'explication' => 'Une API est comme le menu d\'un restaurant. Elle vous dit ce que vous pouvez commander (fonctionnalités disponibles) et comment commander (format des requêtes), mais vous ne voyez pas la cuisine.',
                'exemple' => 'API REST : GET /api/users pour récupérer la liste des utilisateurs'
            ],
            'JSON' => [
                'definition' => 'JavaScript Object Notation : format d\'échange de données',
                'explication' => 'JSON est comme un langage universel pour échanger des informations entre applications. C\'est simple, lisible par les humains, et compris par presque tous les langages de programmation.',
                'exemple' => '{"nom": "Jean", "age": 30, "ville": "Paris"}'
            ],
            'Session' => [
                'definition' => 'Mécanisme de stockage temporaire d\'informations utilisateur',
                'explication' => 'Une session est comme un casier personnel dans un magasin. Pendant votre visite (navigation), vous pouvez y stocker vos affaires (données utilisateur). Quand vous partez, le casier se vide.',
                'exemple' => '$_SESSION["username"] = "jean"; // Stocke le nom d\'utilisateur'
            ],
            'Cookie' => [
                'definition' => 'Petit fichier stocké sur l\'ordinateur de l\'utilisateur',
                'explication' => 'Un cookie est comme un bracelet d\'entrée dans un parc d\'attraction. Il contient des infos sur vous et vos préférences. Le site web peut le lire à votre prochaine visite pour vous reconnaître.',
                'exemple' => 'setcookie("theme", "dark", time() + 3600); // Cookie thème sombre pour 1h'
            ],
        ];

        return $this->render('glossaire/index.html.twig', [
            'glossaire' => $glossaire,
        ]);
    }
}
