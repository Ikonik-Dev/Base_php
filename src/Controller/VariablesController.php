<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VariablesController extends AbstractController
{
    #[Route('/variables', name: 'app_variables')]
    public function index(): Response
    {
        // Données complètes sur les variables PHP : syntaxe, règles de nommage, portée, affectation et bonnes pratiques
        $dataVariablesPHP = [
            'declaration' => [
                'description' => 'En PHP, une variable commence toujours par le symbole $ suivi du nom. Aucune déclaration préalable n\'est nécessaire.',
                'example' => '$maVariable = "Bonjour";\n$nombre = 42;\n$estVrai = true;',
                'details' => 'En PHP, c\'est super simple : vous créez une variable en écrivant $ puis son nom, et hop ! Pas besoin d\'annoncer "je vais créer une variable de type texte" comme dans d\'autres langages. PHP devine automatiquement le type selon ce que vous mettez dedans : du texte, un nombre, vrai/faux... Le $ est obligatoire, c\'est comme ça que PHP reconnaît "ah, c\'est une variable !". Ça la distingue des constantes (sans $) et des mots réservés du langage.',
                'useCases' => [
                    'Stocker temporairement des résultats de calculs',
                    'Conserver des données utilisateur pendant l\'exécution du script',
                    'Manipuler des valeurs avant de les envoyer à une base de données',
                    'Créer des variables de configuration locales'
                ],
                'warnings' => [
                    'Le nom de variable est sensible à la casse : $nom et $Nom sont deux variables différentes',
                    'Ne pas confondre variables ($var) et constantes (CONST ou define())',
                    'L\'utilisation de variables non initialisées génère un Warning en PHP 8+',
                    'Éviter les noms de variables trop courts ($a, $b) sauf dans les boucles'
                ],
                'bestPractices' => [
                    'Toujours initialiser vos variables avec une valeur par défaut',
                    'Utiliser des noms descriptifs qui expliquent le contenu',
                    'Respecter une convention de nommage cohérente dans tout le projet',
                    'Commenter les variables dont le rôle n\'est pas évident',
                    'Éviter les variables inutilisées (dead code)'
                ],
                'resources' => [
                    ['label' => 'Documentation PHP - Variables', 'url' => 'https://www.php.net/manual/fr/language.variables.php', 'icon' => '📖'],
                    ['label' => 'PHP The Right Way', 'url' => 'https://phptherightway.com', 'icon' => '🎓']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-regles_nommage', 'label' => 'Règles de nommage'],
                    ['id' => 'modal-affectation', 'label' => 'Affectation']
                ]
            ],
            'regles_nommage' => [
                'description' => 'Nom de variable : lettre/underscore en premier, puis lettres/chiffres/underscores. Sensible à la casse.',
                'example' => '$nom_valide = "OK";\n$_aussi_valide = "OK";\n$var2 = "OK";\n// $2var = "ERREUR";',
                'details' => 'Pour nommer une variable : commencez TOUJOURS par une lettre (a-z) ou un underscore _, puis vous pouvez mélanger lettres, chiffres et underscores comme vous voulez. JAMAIS commencer par un chiffre ($2var = ERREUR) ! Important : PHP fait la différence entre majuscules et minuscules, donc $nom et $Nom sont deux variables complètement différentes. Pas d\'espaces, pas d\'accents, pas de caractères bizarres (@, #, -, etc.). Gardez ça simple et lisible !',
                'useCases' => [
                    'camelCase pour variables locales : $userName, $totalPrice',
                    'snake_case dans bases de données : $user_name, $total_price',
                    '_prefixe pour variables "privées" par convention : $_internalData',
                    'UPPERCASE pour constantes : define("MAX_SIZE", 100)'
                ],
                'warnings' => [
                    'Ne jamais commencer par un chiffre : $1var est invalide',
                    '$nom et $Nom sont deux variables distinctes',
                    'Éviter les caractères accentués même si techniquement possibles',
                    'Ne pas utiliser les mots réservés PHP comme noms de variables'
                ],
                'bestPractices' => [
                    'Choisir une convention (camelCase OU snake_case) et s\'y tenir',
                    'Utiliser des noms anglais pour la cohérence internationale',
                    'Éviter les abréviations cryptiques : $usr → $user',
                    'Les noms doivent être auto-documentants'
                ],
                'resources' => [
                    ['label' => 'PHP Manual - Variables Basics', 'url' => 'https://www.php.net/manual/fr/language.variables.basics.php', 'icon' => '📖'],
                    ['label' => 'PSR-1 Coding Standards', 'url' => 'https://www.php-fig.org/psr/psr-1/', 'icon' => '📐']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-declaration', 'label' => 'Déclaration'],
                    ['id' => 'modal-bonnes_pratiques', 'label' => 'Bonnes pratiques']
                ]
            ],
            'affectation' => [
                'description' => 'L\'affectation se fait avec l\'opérateur =. Une variable peut être réassignée à tout moment.',
                'example' => '$message = "Bonjour";\n$message = "Au revoir"; // Réaffectation\n$copie = $message; // Copie de valeur',
                'details' => 'Affecter une valeur, c\'est mettre quelque chose dans votre boîte-variable avec le signe =. Vous pouvez changer son contenu autant de fois que vous voulez ! Pour les valeurs simples (texte, nombres), PHP fait une copie. Pour les objets, il donne l\'adresse (comme prêter vs photocopier). Super pratique : vous pouvez faire des affectations en chaîne : $a = $b = $c = 0 donne 0 à tout le monde d\'un coup ! Attention à ne pas confondre = (mettre dedans) avec == (comparer).',
                'useCases' => [
                    'Affectation simple : $x = 10',
                    'Affectation multiple : $a = $b = $c = 0',
                    'Affectation par référence : $ref = &$original',
                    'Affectation conditionnelle : $x = $condition ? $a : $b'
                ],
                'warnings' => [
                    'Ne pas confondre = (affectation) et == (comparaison)',
                    'Les objets sont passés par référence, pas par valeur',
                    'L\'affectation par référence (=&) peut créer des bugs subtils',
                    'Attention aux affectations dans les conditions : if ($x = 5) est valide mais piégeux'
                ],
                'bestPractices' => [
                    'Utiliser des affectations claires et explicites',
                    'Éviter les affectations en chaîne si elles nuisent à la lisibilité',
                    'Préférer les affectations conditionnelles avec l\'opérateur ??',
                    'Documenter les affectations par référence si nécessaires'
                ],
                'resources' => [
                    ['label' => 'PHP Operators', 'url' => 'https://www.php.net/manual/fr/language.operators.assignment.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-declaration', 'label' => 'Déclaration'],
                    ['id' => 'modal-portee_locale', 'label' => 'Portée locale']
                ]
            ],
            'portee_locale' => [
                'description' => 'Les variables déclarées dans une fonction ont une portée locale (accessible uniquement dans cette fonction).',
                'example' => 'function test() {\n    $locale = "Je suis locale";\n    echo $locale; // OK\n}\n// echo $locale; // ERREUR',
                'details' => 'Une variable locale, c\'est comme un secret qui reste dans sa pièce (la fonction) ! Vous créez $locale dans la fonction, elle vit tant que la fonction travaille, puis disparaît quand la fonction se termine. Si vous essayez de l\'utiliser en dehors, erreur : PHP dit "je ne connais pas cette variable". C\'est super pratique : ça évite que deux fonctions se marchent dessus avec des variables du même nom, et ça garde les données bien rangées chacune dans son coin.',
                'useCases' => [
                    'Variables de travail temporaires dans une fonction',
                    'Paramètres de fonction (toujours locaux)',
                    'Variables de boucle (for, foreach)',
                    'Variables de calcul intermédiaires'
                ],
                'warnings' => [
                    'Une variable locale ne peut pas accéder aux variables globales sans le mot-clé global',
                    'Deux fonctions peuvent avoir des variables locales de même nom sans conflit',
                    'Les variables statiques conservent leur valeur entre les appels',
                    'Les closures capturent les variables avec use()'
                ],
                'bestPractices' => [
                    'Privilégier les variables locales aux variables globales',
                    'Limiter la portée des variables au minimum nécessaire',
                    'Utiliser des paramètres plutôt que des variables globales',
                    'Documenter les variables statiques si utilisées'
                ],
                'resources' => [
                    ['label' => 'PHP Variable Scope', 'url' => 'https://www.php.net/manual/fr/language.variables.scope.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-portee_globale', 'label' => 'Portée globale'],
                    ['id' => 'modal-variables_superglobales', 'label' => 'Superglobales']
                ]
            ],
            'portee_globale' => [
                'description' => 'Les variables déclarées hors des fonctions sont globales. Utilisez "global" pour y accéder dans une fonction.',
                'example' => '$globale = "Je suis globale";\nfunction afficher() {\n    global $globale;\n    echo $globale;\n}',
                'details' => 'Une variable globale, c\'est l\'inverse de la locale : elle est déclarée en dehors de toute fonction et existe partout dans votre script. MAIS pour l\'utiliser dans une fonction, vous devez annoncer "global $maVariable" (comme demander la permission d\'utiliser le coffre commun). Attention : les variables globales, c\'est un peu comme laisser traîner ses affaires partout - pratique sur le moment, mais ça devient vite le bazar ! N\'importe quelle fonction peut la modifier sans prévenir. À éviter autant que possible !',
                'useCases' => [
                    'Configuration de l\'application (à éviter, utiliser des classes de config)',
                    'Connexions aux bases de données (déconseillé, utiliser DI)',
                    'Compteurs globaux (refactorer en classe)',
                    'Variables partagées entre fonctions (refactorer en POO)'
                ],
                'warnings' => [
                    'Les variables globales créent des dépendances cachées',
                    'Elles rendent le code difficile à tester unitairement',
                    'Risque de conflits de noms entre bibliothèques',
                    'Modification imprévue par des fonctions tierces'
                ],
                'bestPractices' => [
                    'Éviter autant que possible les variables globales',
                    'Préférer l\'injection de dépendances',
                    'Utiliser des classes avec propriétés plutôt que des globales',
                    'Si nécessaire, utiliser des constantes plutôt que des variables',
                    'Documenter clairement toute variable globale utilisée'
                ],
                'resources' => [
                    ['label' => 'PHP Variable Scope', 'url' => 'https://www.php.net/manual/fr/language.variables.scope.php', 'icon' => '📖'],
                    ['label' => 'Dependency Injection', 'url' => 'https://www.php-fig.org/psr/psr-11/', 'icon' => '🔧']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-portee_locale', 'label' => 'Portée locale'],
                    ['id' => 'modal-variables_superglobales', 'label' => 'Superglobales']
                ]
            ],
            'variables_superglobales' => [
                'description' => 'PHP fournit des variables superglobales automatiquement disponibles partout ($_GET, $_POST, $_SESSION, etc.).',
                'example' => 'echo $_SERVER[\'PHP_VERSION\'];\n// $_GET, $_POST, $_SESSION\n// $_COOKIE, $_FILES, $GLOBALS',
                'details' => 'Les superglobales, ce sont les VIP de PHP : des variables spéciales qui sont TOUJOURS disponibles, partout, dans toutes les fonctions, sans rien demander ! Ce sont des tableaux tout prêts que PHP remplit pour vous avec plein d\'infos utiles : $_GET (paramètres URL), $_POST (données formulaire), $_SESSION (données entre pages), $_SERVER (infos serveur), $_COOKIE (cookies), $_FILES (fichiers uploadés). C\'est votre interface principale avec le monde extérieur : navigateur, serveur, utilisateur.',
                'useCases' => [
                    '$_GET : récupérer paramètres d\'URL',
                    '$_POST : récupérer données de formulaire',
                    '$_SESSION : stocker données utilisateur entre pages',
                    '$_SERVER : informations serveur et requête',
                    '$_COOKIE : gérer les cookies',
                    '$_FILES : gérer l\'upload de fichiers'
                ],
                'warnings' => [
                    'TOUJOURS valider et filtrer les données des superglobales',
                    'Ne JAMAIS faire confiance aux données utilisateur ($_GET, $_POST)',
                    'Risque d\'injection SQL si utilisées directement dans requêtes',
                    'Risque XSS si affichées sans échappement'
                ],
                'bestPractices' => [
                    'Utiliser filter_input() pour récupérer les données',
                    'Valider toutes les entrées utilisateur',
                    'Utiliser des requêtes préparées pour les bases de données',
                    'Échapper les sorties avec htmlspecialchars()',
                    'Vérifier l\'existence des clés : $_GET[\'key\'] ?? null'
                ],
                'resources' => [
                    ['label' => 'PHP Superglobals', 'url' => 'https://www.php.net/manual/fr/language.variables.superglobals.php', 'icon' => '📖'],
                    ['label' => 'PHP Security', 'url' => 'https://www.php.net/manual/fr/security.php', 'icon' => '🔒']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-global_$_GET', 'label' => '$_GET'],
                    ['id' => 'modal-global_$_POST', 'label' => '$_POST'],
                    ['id' => 'modal-global_$_SESSION', 'label' => '$_SESSION']
                ]
            ],
            'bonnes_pratiques' => [
                'description' => 'Utilisez des noms explicites, respectez les conventions (camelCase ou snake_case), initialisez vos variables.',
                'example' => '$nomUtilisateur = "John"; // camelCase\n$nom_utilisateur = "John"; // snake_case\n$age = 0; // Initialisation',
                'details' => 'Pour écrire du bon code PHP : 1) Donnez des noms clairs à vos variables ($nombreUtilisateurs au lieu de $n). 2) Choisissez un style et gardez-le : camelCase ($monNom) OU snake_case ($mon_nom), pas un mélange ! 3) Initialisez toujours vos variables avant de les utiliser ($compteur = 0 au début). 4) Gardez vos variables locales plutôt que globales. 5) Utilisez declare(strict_types=1) pour que PHP soit strict sur les types. Ces bonnes habitudes rendent votre code plus facile à lire, à maintenir et évitent plein de bugs !',
                'useCases' => [
                    'Nommage explicite : $totalCommandes au lieu de $t',
                    'Initialisation : $compteur = 0 avant utilisation',
                    'Constantes : define(\'API_KEY\', \'...\') pour valeurs fixes',
                    'Typage : declare(strict_types=1) en début de fichier'
                ],
                'warnings' => [
                    'Éviter les noms génériques ($data, $tmp, $x)',
                    'Ne pas réutiliser une variable pour différentes données',
                    'Attention aux variables non initialisées (undefined)',
                    'Éviter les variables globales (préférer injection)'
                ],
                'bestPractices' => [
                    'camelCase : $nombreUtilisateurs (variables et méthodes)',
                    'PascalCase : $MaClasse (classes)',
                    'SNAKE_CASE_MAJUSCULE : API_KEY (constantes)',
                    'Toujours initialiser avant utilisation',
                    'Limiter la portée (variables locales privilégiées)',
                    'Typage strict : declare(strict_types=1)',
                    'Documentation : /** @var string $description */'
                ],
                'resources' => [
                    ['label' => 'PSR-12 Coding Style', 'url' => 'https://www.php-fig.org/psr/psr-12/', 'icon' => '📐'],
                    ['label' => 'Clean Code PHP', 'url' => 'https://github.com/jupeter/clean-code-php', 'icon' => '✨']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-declaration', 'label' => 'Déclaration'],
                    ['id' => 'modal-regles_nommage', 'label' => 'Règles de nommage'],
                    ['id' => 'modal-portee_locale', 'label' => 'Portée locale']
                ]
            ],
        ];

        // Données complètes sur les variables superglobales PHP comme $_GET, $_POST, $_SESSION, $_COOKIE, $_FILES, $GLOBALS : syntaxe, règles de nommage, portée, affectation et bonnes pratiques
        $dataVariablesGlobalesPHP = [
            '$_GET' => [
                'description' => 'Contient les données envoyées via l\'URL (méthode GET). Utilisé pour récupérer les paramètres de requête.',
                'example' => 'URL: example.com?page=2\nAccès: $page = $_GET[\'page\'];',
                'details' => '$_GET, c\'est le tableau magique qui récupère tout ce qui est écrit après le ? dans l\'URL ! Par exemple dans "site.com?page=2&nom=John", $_GET[\'page\'] vous donne 2, et $_GET[\'nom\'] vous donne "John". Super pratique pour la pagination, les filtres, les recherches... MAIS ATTENTION : tout est visible dans l\'URL (donc jamais de mots de passe là-dedans !) et ça vient de l\'utilisateur, donc TOUJOURS vérifier/nettoyer ces données avant de les utiliser !',
                'useCases' => [
                    'Pagination : ?page=3&limit=10',
                    'Filtres de recherche : ?category=php&sort=date',
                    'Liens de partage : ?id=123&ref=email',
                    'Actions : ?action=delete&item=5'
                ],
                'warnings' => [
                    'Données visibles dans l\'URL (pas pour données sensibles)',
                    'Limite de taille selon serveur (~2KB)',
                    'TOUJOURS valider et filtrer les valeurs',
                    'Peut être modifié par l\'utilisateur (injection)'
                ],
                'bestPractices' => [
                    'Utiliser filter_input(INPUT_GET, \'key\', FILTER_SANITIZE_...)',
                    'Vérifier l\'existence : $_GET[\'key\'] ?? null',
                    'Valider le type : filter_var($value, FILTER_VALIDATE_INT)',
                    'Ne JAMAIS utiliser directement dans SQL',
                    'Échapper avant affichage : htmlspecialchars($_GET[\'q\'])'
                ],
                'resources' => [
                    ['label' => 'PHP $_GET', 'url' => 'https://www.php.net/manual/fr/reserved.variables.get.php', 'icon' => '📖'],
                    ['label' => 'filter_input()', 'url' => 'https://www.php.net/manual/fr/function.filter-input.php', 'icon' => '🔧']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-global_$_POST', 'label' => '$_POST'],
                    ['id' => 'modal-variables_superglobales', 'label' => 'Variables superglobales'],
                    ['id' => 'modal-bonnes_pratiques', 'label' => 'Bonnes pratiques']
                ]
            ],
            '$_POST' => [
                'description' => 'Contient les données envoyées via un formulaire HTML (méthode POST). Utilisé pour récupérer les données de formulaire.',
                'example' => '<form method="POST">\n  <input name="nom">\n</form>\n$nom = $_POST[\'nom\'];',
                'details' => '$_POST, c\'est le grand frère discret de $_GET ! Quand un utilisateur remplit un formulaire et clique "Envoyer", toutes les données arrivent dans ce tableau. Différence avec GET : les données ne s\'affichent PAS dans l\'URL, elles voyagent de façon invisible. Parfait pour les mots de passe, inscriptions, connexions, commentaires... MAIS "invisible" ne veut pas dire "sécurisé" ! Il faut TOUJOURS vérifier et nettoyer ces données, et protéger vos formulaires contre les attaques (token CSRF).',
                'useCases' => [
                    'Formulaires de connexion (login, password)',
                    'Inscription utilisateur (email, nom, prénom)',
                    'Envoi de messages/commentaires',
                    'Upload de fichiers (combiné avec $_FILES)'
                ],
                'warnings' => [
                    'Données non visibles ≠ données sécurisées',
                    'TOUJOURS valider et filtrer les valeurs',
                    'Protection CSRF obligatoire pour formulaires',
                    'Limite de taille selon post_max_size (php.ini)'
                ],
                'bestPractices' => [
                    'Utiliser filter_input(INPUT_POST, \'key\', FILTER_...)',
                    'Vérifier l\'existence : $_POST[\'key\'] ?? null',
                    'Token CSRF pour chaque formulaire',
                    'Validation côté serveur (ne pas se fier au client)',
                    'Requêtes préparées pour SQL'
                ],
                'resources' => [
                    ['label' => 'PHP $_POST', 'url' => 'https://www.php.net/manual/fr/reserved.variables.post.php', 'icon' => '📖'],
                    ['label' => 'CSRF Protection', 'url' => 'https://cheatsheetseries.owasp.org/cheatsheets/Cross-Site_Request_Forgery_Prevention_Cheat_Sheet.html', 'icon' => '🔒']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-global_$_GET', 'label' => '$_GET'],
                    ['id' => 'modal-global_$_FILES', 'label' => '$_FILES'],
                    ['id' => 'modal-variables_superglobales', 'label' => 'Variables superglobales']
                ]
            ],
            '$_SESSION' => [
                'description' => 'Utilisée pour stocker des informations persistantes entre les pages. Nécessite session_start() au début du script.',
                'example' => 'session_start();\n$_SESSION[\'user_id\'] = 123;\n// Récupération\n$userId = $_SESSION[\'user_id\'];',
                'details' => '$_SESSION, c\'est la mémoire de votre site ! Elle garde des infos sur l\'utilisateur quand il navigue de page en page : "qui est connecté ?", "qu\'est-ce qu\'il a dans son panier ?", "quelle langue il préfère ?". Les données restent stockées sur le serveur (pas sur l\'ordinateur du visiteur comme les cookies). IMPORTANT : avant de l\'utiliser, vous DEVEZ écrire session_start() au tout début de votre script. Super pour l\'authentification, les paniers, les messages temporaires !',
                'useCases' => [
                    'Authentification : $_SESSION[\'user_id\'] = 123',
                    'Panier e-commerce : $_SESSION[\'cart\'] = [...]',
                    'Messages flash : $_SESSION[\'success\'] = "Enregistré"',
                    'Préférences : $_SESSION[\'lang\'] = "fr"'
                ],
                'warnings' => [
                    'Appeler session_start() AVANT tout output HTML',
                    'Ne pas stocker de données sensibles en clair',
                    'Session expiration selon session.gc_maxlifetime',
                    'Vulnérable au Session Hijacking (utiliser HTTPS)'
                ],
                'bestPractices' => [
                    'Toujours session_start() en début de script',
                    'Régénérer l\'ID après login : session_regenerate_id()',
                    'Détruire à la déconnexion : session_destroy()',
                    'Vérifier l\'existence : $_SESSION[\'key\'] ?? null',
                    'Utiliser HTTPS pour sécuriser les cookies de session'
                ],
                'resources' => [
                    ['label' => 'PHP Sessions', 'url' => 'https://www.php.net/manual/fr/book.session.php', 'icon' => '📖'],
                    ['label' => 'Session Security', 'url' => 'https://cheatsheetseries.owasp.org/cheatsheets/Session_Management_Cheat_Sheet.html', 'icon' => '🔒']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-global_$_COOKIE', 'label' => '$_COOKIE'],
                    ['id' => 'modal-variables_superglobales', 'label' => 'Variables superglobales'],
                    ['id' => 'modal-bonnes_pratiques', 'label' => 'Bonnes pratiques']
                ]
            ],
            '$_COOKIE' => [
                'description' => 'Contient les cookies envoyés par le navigateur. Utilisé pour stocker des informations côté client.',
                'example' => 'setcookie("theme", "dark", time() + 3600);\n// Récupération\n$theme = $_COOKIE[\'theme\'];',
                'details' => '$_COOKIE, ce sont les petits post-it du navigateur ! Des infos stockées sur l\'ordinateur du visiteur (pas sur votre serveur) qui reviennent à chaque visite. Vous les créez avec setcookie(), et après le navigateur les renvoie automatiquement. Parfait pour se souvenir de trucs non sensibles : "mode sombre activé", "langue française", "se souvenir de moi"... ATTENTION : comme c\'est sur l\'ordi du visiteur, il peut les lire et les modifier, donc JAMAIS de mots de passe ou infos confidentielles là-dedans ! Limite de taille : ~4KB.',
                'useCases' => [
                    'Se souvenir de moi (remember me)',
                    'Préférences d\'affichage (thème, langue)',
                    'Tracking et analytics',
                    'Panier e-commerce (session alternative)'
                ],
                'warnings' => [
                    'Stockés côté client : peuvent être lus/modifiés',
                    'Limite ~4KB par cookie',
                    'Envoyés à chaque requête (impact performance)',
                    'Ne JAMAIS stocker de données sensibles'
                ],
                'bestPractices' => [
                    'setcookie() AVANT tout output HTML',
                    'Utiliser httponly pour sécuriser : setcookie(..., httponly: true)',
                    'secure: true pour forcer HTTPS',
                    'SameSite pour protection CSRF',
                    'Vérifier l\'existence : $_COOKIE[\'key\'] ?? null'
                ],
                'resources' => [
                    ['label' => 'PHP Cookies', 'url' => 'https://www.php.net/manual/fr/features.cookies.php', 'icon' => '📖'],
                    ['label' => 'Cookie Security', 'url' => 'https://cheatsheetseries.owasp.org/cheatsheets/Session_Management_Cheat_Sheet.html#cookies', 'icon' => '🔒']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-global_$_SESSION', 'label' => '$_SESSION'],
                    ['id' => 'modal-variables_superglobales', 'label' => 'Variables superglobales'],
                    ['id' => 'modal-bonnes_pratiques', 'label' => 'Bonnes pratiques']
                ]
            ],
            '$_FILES' => [
                'description' => 'Contient les fichiers téléchargés via un formulaire HTML. Utilisé pour gérer les uploads de fichiers.',
                'example' => '<form method="POST" enctype="multipart/form-data">\n  <input type="file" name="monFichier">\n</form>\n// Accès\n$fichier = $_FILES[\'monFichier\'];',
                'details' => '$_FILES, c\'est le livreur de colis de PHP ! Quand un utilisateur upload un fichier (photo, PDF, document...), toutes les infos arrivent dans ce tableau : le nom original du fichier, son type, où PHP l\'a stocké temporairement, sa taille, et si l\'upload a marché ou échoué. Pour que ça fonctionne, votre formulaire DOIT avoir enctype="multipart/form-data". Chaque fichier uploadé est comme un paquet avec son étiquette contenant name, type, tmp_name, error, size.',
                'useCases' => [
                    'Upload avatar/photo de profil',
                    'Upload de documents (PDF, Word, etc.)',
                    'Galeries d\'images',
                    'Import de fichiers CSV/Excel'
                ],
                'warnings' => [
                    'TOUJOURS valider le type MIME côté serveur',
                    'Vérifier la taille : upload_max_filesize (php.ini)',
                    'Renommer les fichiers (éviter noms originaux)',
                    'Stocker hors du webroot si possible'
                ],
                'bestPractices' => [
                    'Vérifier $_FILES[\'file\'][\'error\'] === UPLOAD_ERR_OK',
                    'Valider l\'extension : pathinfo($name, PATHINFO_EXTENSION)',
                    'Vérifier le MIME type : mime_content_type()',
                    'Déplacer le fichier : move_uploaded_file()',
                    'Générer nom unique : uniqid() . \'_\' . $filename'
                ],
                'resources' => [
                    ['label' => 'PHP File Upload', 'url' => 'https://www.php.net/manual/fr/features.file-upload.php', 'icon' => '📖'],
                    ['label' => 'File Upload Security', 'url' => 'https://cheatsheetseries.owasp.org/cheatsheets/File_Upload_Cheat_Sheet.html', 'icon' => '🔒']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-global_$_POST', 'label' => '$_POST'],
                    ['id' => 'modal-variables_superglobales', 'label' => 'Variables superglobales'],
                    ['id' => 'modal-bonnes_pratiques', 'label' => 'Bonnes pratiques']
                ]
            ],
            '$GLOBALS' => [
                'description' => 'Tableau associatif contenant toutes les variables globales. Permet d\'accéder à une variable globale depuis n\'importe où.',
                'example' => '$a = 5;\nfunction test() {\n    echo $GLOBALS[\'a\']; // Accès à la variable globale $a\n}',
                'details' => '$GLOBALS, c\'est le grand annuaire de TOUTES vos variables globales ! Comme un coffre-fort central où PHP range toutes les variables créées en dehors des fonctions. Depuis n\'importe où (même dans une fonction), vous pouvez faire $GLOBALS[\'maVariable\'] pour y accéder sans utiliser "global". C\'est pratique MAIS... en PHP moderne, c\'est considéré comme une mauvaise pratique ! Ça rend le code difficile à comprendre et à tester. Mieux vaut passer les données explicitement en paramètres ou utiliser des objets.',
                'useCases' => [
                    'Accès à variable globale : $GLOBALS[\'config\']',
                    'Alternative au mot-clé global',
                    'Debug : voir toutes les variables globales',
                    'Partage de données entre fonctions (déconseillé)'
                ],
                'warnings' => [
                    'Pratique déconseillée en programmation moderne',
                    'Rend le code difficile à tester (dépendances cachées)',
                    'Pollution du scope global',
                    'Préférer injection de dépendances'
                ],
                'bestPractices' => [
                    'ÉVITER l\'usage de $GLOBALS en production',
                    'Utiliser injection de dépendances à la place',
                    'Passer paramètres explicitement aux fonctions',
                    'Classes et objets pour partager des données',
                    'Constantes pour valeurs fixes'
                ],
                'resources' => [
                    ['label' => 'PHP $GLOBALS', 'url' => 'https://www.php.net/manual/fr/reserved.variables.globals.php', 'icon' => '📖'],
                    ['label' => 'Dependency Injection', 'url' => 'https://symfony.com/doc/current/service_container.html', 'icon' => '💉']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-portee_globale', 'label' => 'Portée globale'],
                    ['id' => 'modal-variables_superglobales', 'label' => 'Variables superglobales'],
                    ['id' => 'modal-bonnes_pratiques', 'label' => 'Bonnes pratiques']
                ]
            ],
        ];

        return $this->render('variables/index.html.twig', [
            'data' => $dataVariablesPHP,
            'dataGlobales' => $dataVariablesGlobalesPHP,
        ]);
    }
}
