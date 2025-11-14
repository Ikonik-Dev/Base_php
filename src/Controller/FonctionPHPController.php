<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FonctionPHPController extends AbstractController
{
    #[Route('/fonctions', name: 'app_fonctions')]
    public function index(): Response
    {

        // DonnÃ©es complÃ¨tes sur les fonctions PHP : dÃ©claration, paramÃ¨tres, types, portÃ©e, anonymes, flÃ©chÃ©es, gÃ©nÃ©rateurs et fonctionnalitÃ©s modernes PHP 7/8
        $dataFonctionsPHP = [
            'declaration_fonctions' => [
                'description' => 'DÃ©claration de fonctions avec le mot-clÃ© function, nommage et bonnes pratiques de nomenclature.',
                'example' => 'function saluer($nom) {\n    return "Bonjour " . $nom;\n}\n\nfunction calculerAge($dateNaissance) {\n    $aujourd\'hui = new DateTime();\n    $naissance = new DateTime($dateNaissance);\n    return $aujourd\'hui->diff($naissance)->y;\n}',
                'details' => 'Une fonction est comme une recette de cuisine : vous lui donnez des ingrÃ©dients (paramÃ¨tres) et elle vous rend un plat (rÃ©sultat). Pour crÃ©er une fonction, Ã©crivez "function" suivi du nom et de parenthÃ¨ses. Le nom doit dÃ©crire ce que fait la fonction, comme "calculerTotal" ou "envoyerEmail". Entre les accolades {}, vous mettez les instructions Ã  exÃ©cuter. La fonction peut retourner un rÃ©sultat avec "return", sinon elle retourne automatiquement "null". Important : chaque fonction doit avoir un nom unique - vous ne pouvez pas avoir deux fonctions avec le mÃªme nom. Ã‰vitez de donner Ã  vos fonctions le mÃªme nom que les fonctions PHP existantes (comme "strlen" ou "array_map").',
                'useCases' => [
                    'RÃ©utilisation code : function calculerTVA($prix) pour Ã©viter rÃ©pÃ©tition logique',
                    'Abstraction : function envoyerEmail($destinataire, $sujet, $message) masque complexitÃ©',
                    'Organisation : function validerFormulaire(), function sauvegarderDonnees() structure claire',
                    'Tests unitaires : fonctions isolÃ©es testables : assertEquals(expected, maFonction(input))',
                    'APIs : function traiterRequeteAPI() centralise logique endpoints',
                    'Helpers : function formatDate($date), function slugify($texte) utilitaires projet'
                ],
                'warnings' => [
                    'Noms ambigus : function process() trop vague, prÃ©fÃ©rer function processUserData()',
                    'Fonctions trop longues : > 50 lignes signe refactoring nÃ©cessaire',
                    'Effets de bord cachÃ©s : fonction modifie variables globales, fichiers sans indication claire',
                    'Return multiple types : fonction retourne int ou false complique utilisation'
                ],
                'bestPractices' => [
                    'Nommage : verbe + nom : getUserById(), calculateTotal(), isValidEmail()',
                    'ResponsabilitÃ© unique : une fonction = une tÃ¢che, pas mÃ©langer logique mÃ©tier et affichage',
                    'Typage strict : declare(strict_types=1) + types paramÃ¨tres/retour PHP 7+',
                    'Documentation : PHPDoc pour fonctions publiques/complexes',
                    'Taille limitÃ©e : max 20-30 lignes idÃ©alement, extraire sous-fonctions si plus'
                ],
                'resources' => [
                    ['label' => 'Fonctions utilisateur', 'url' => 'https://www.php.net/manual/fr/functions.user-defined.php', 'icon' => 'ðŸ“–']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-parametres_arguments', 'label' => 'ParamÃ¨tres & Arguments'],
                    ['id' => 'modal-valeurs_retour', 'label' => 'Valeurs de retour'],
                    ['id' => 'modal-portee_variables', 'label' => 'PortÃ©e des variables']
                ]
            ],
            'parametres_arguments' => [
                'description' => 'Gestion des paramÃ¨tres : obligatoires, optionnels, valeurs par dÃ©faut, nombre variable d\'arguments.',
                'example' => 'function info($nom, $age = 25, $ville = "Paris") {\n    return "$nom, $age ans, habite $ville";\n}\n\n// Appels\necho info("John"); // Valeurs par dÃ©faut\necho info("Marie", 30); // Age personnalisÃ©\necho info("Paul", 35, "Lyon"); // Tous personnalisÃ©s',
                'details' => 'Les paramÃ¨tres sont les informations que vous donnez Ã  une fonction pour qu\'elle fasse son travail. Vous les mettez entre parenthÃ¨ses aprÃ¨s le nom de la fonction. Certains paramÃ¨tres sont obligatoires (vous devez les fournir), d\'autres sont optionnels (ils ont une valeur par dÃ©faut si vous ne les donnez pas). Par exemple, dans "function saluer($nom, $langue = \'fr\')", le nom est obligatoire mais la langue est optionnelle et vaut "fr" par dÃ©faut. RÃ¨gle importante : les paramÃ¨tres obligatoires doivent toujours venir avant les optionnels. Pour une fonction facile Ã  utiliser, limitez-vous Ã  3-5 paramÃ¨tres maximum. Au-delÃ , votre fonction devient compliquÃ©e.',
                'useCases' => [
                    'Configuration flexible : function creerProduit($nom, $prix, $options = []) options variables',
                    'Valeurs par dÃ©faut : function paginer($page = 1, $limit = 10) Ã©vite rÃ©pÃ©tition valeurs communes',
                    'API publique : function rechercher($terme, $filtres = null, $tri = "pertinence") usage simple ou avancÃ©',
                    'Builders : function genererHTML($contenu, $classe = "", $id = null) personnalisation progressive',
                    'Overloading simulÃ© : valeurs dÃ©faut simulent plusieurs signatures fonction',
                    'Callbacks : function traiter($data, callable $transformer = null) transformation optionnelle'
                ],
                'warnings' => [
                    'Trop paramÃ¨tres : > 5 paramÃ¨tres signe design problÃ©matique, utiliser objet ou array',
                    'Ordre paramÃ¨tres : obligatoires aprÃ¨s optionnels gÃ©nÃ¨re erreur syntaxe',
                    'Valeurs mutables : $param = [] puis modifier impacte tous appels sans argument',
                    'Type hints stricts : declare(strict_types=1) + types empÃªche jonglage automatique'
                ],
                'bestPractices' => [
                    'Limiter nombre : max 3-4 paramÃ¨tres, au-delÃ  regrouper en objet/array',
                    'Nommage descriptif : $emailAddress pas $e, $isActive pas $flag',
                    'Optionnels sensÃ©s : valeurs dÃ©faut logiques, pas magic numbers arbitraires',
                    'Documentation : @param type $nom description pour chaque paramÃ¨tre',
                    'Objets config : function creerUser(UserConfig $config) meilleur que 10 paramÃ¨tres'
                ],
                'resources' => [
                    ['label' => 'Arguments fonctions', 'url' => 'https://www.php.net/manual/fr/functions.arguments.php', 'icon' => 'ðŸ“–']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-parametres_variables', 'label' => 'Arguments variables'],
                    ['id' => 'modal-types_parametres_php7', 'label' => 'Types de paramÃ¨tres'],
                    ['id' => 'modal-named_arguments_php8', 'label' => 'Arguments nommÃ©s PHP 8']
                ]
            ],
            'parametres_variables' => [
                'description' => 'Fonctions avec nombre variable d\'arguments : func_get_args(), func_num_args() et syntaxe ... (splat operator).',
                'example' => '// Ancienne mÃ©thode\nfunction sommeAncienne() {\n    $args = func_get_args();\n    return array_sum($args);\n}\n\n// MÃ©thode moderne (PHP 5.6+)\nfunction somme(...$nombres) {\n    return array_sum($nombres);\n}\n\necho somme(1, 2, 3, 4, 5); // 15',
                'details' => 'Parfois, vous ne savez pas combien d\'arguments vous allez recevoir. Par exemple, une fonction "additionner" pourrait recevoir 2, 3, 10 nombres ou plus. Pour gÃ©rer Ã§a, utilisez les trois petits points "..." devant un paramÃ¨tre : "function additionner(...$nombres)". PHP mettra automatiquement tous les arguments reÃ§us dans un tableau $nombres. C\'est trÃ¨s pratique pour des fonctions flexibles. Par exemple, "additionner(1, 2, 3)" et "additionner(5, 10, 15, 20)" fonctionnent tous les deux. Important : le paramÃ¨tre avec "..." doit toujours Ãªtre le dernier.',
                'useCases' => [
                    'Fonctions mathÃ©matiques : function moyenne(...$valeurs) nombre arguments inconnu',
                    'Logging : function log($niveau, ...$messages) messages multiples flexibles',
                    'Builders : function construireURL($base, ...$segments) chemins dynamiques',
                    'Array helpers : function fusionner(...$arrays) merge nombre arrays variable',
                    'Validation : function validerChamps(...$champs) vÃ©rifie liste champs variable',
                    'SQL : function query($sql, ...$params) requÃªtes paramÃ©trÃ©es flexible'
                ],
                'warnings' => [
                    'Type hints : int ...$args force tous arguments mÃªme type, vÃ©rifier besoin',
                    'Performance : unpacking gros arrays coÃ»teux, considÃ©rer passer array direct',
                    'LisibilitÃ© : si logic complexe, array nommÃ© plus clair que ...$args',
                    'Ordre paramÃ¨tres : ... toujours en dernier, pas aprÃ¨s paramÃ¨tres normaux'
                ],
                'bestPractices' => [
                    'PrÃ©fÃ©rer ... Ã  func_get_args() : plus moderne, lisible, performant',
                    'Typage : ajouter type hint si tous arguments mÃªme type attendu',
                    'Documentation : @param type ...$args description indique nombre variable',
                    'Validation : vÃ©rifier count($args) si minimum/maximum requis',
                    'Nommage : ...$items, ...$values descriptif pas juste ...$args gÃ©nÃ©rique'
                ],
                'resources' => [
                    ['label' => 'Arguments variables', 'url' => 'https://www.php.net/manual/fr/functions.arguments.php#functions.variable-arg-list', 'icon' => 'ðŸ“–']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-parametres_arguments', 'label' => 'ParamÃ¨tres & Arguments'],
                    ['id' => 'modal-types_parametres_php7', 'label' => 'Types de paramÃ¨tres'],
                    ['id' => 'modal-fonctions_callback', 'label' => 'Fonctions callback']
                ]
            ],
            'types_parametres_php7' => [
                'description' => 'DÃ©claration de types pour paramÃ¨tres (PHP 7+) : scalaires, classes, interfaces, nullable avec ?.',
                'example' => 'function additionner(int $a, int $b): int {\n    return $a + $b;\n}\n\nfunction traiterUtilisateur(?User $user, string $action = "view"): bool {\n    if ($user === null) {\n        return false;\n    }\n    // Traitement...\n    return true;\n}',
                'details' => 'Depuis PHP 7, vous pouvez indiquer quel type de donnÃ©es une fonction attend et retourne. C\'est comme mettre des Ã©tiquettes sur les ingrÃ©dients et le plat final. Par exemple, "function additionner(int $a, int $b): int" dit clairement : "je veux deux nombres entiers et je retourne un nombre entier". Si quelqu\'un essaie de passer du texte au lieu d\'un nombre, PHP affichera une erreur avant que Ã§a plante. Vous pouvez utiliser int (nombres), string (texte), bool (vrai/faux), array (tableaux), ou mÃªme des noms de classes. Le point d\'interrogation "?" devant un type (comme "?int") signifie que la valeur peut aussi Ãªtre "null".',
                'useCases' => [
                    'APIs robustes : function creerUser(string $email, int $age): User contrat clair',
                    'PrÃ©vention erreurs : types empÃªchent passage donnÃ©es incorrectes compilation',
                    'Refactoring : types facilitent modifications, IDE dÃ©tecte incompatibilitÃ©s',
                    'Documentation vivante : signature rÃ©vÃ¨le types sans lire PHPDoc',
                    'Performance : moteur optimise opÃ©rations types connus (JIT PHP 8)',
                    'InteropÃ©rabilitÃ© : bibliothÃ¨ques modernes exigent types stricts'
                ],
                'warnings' => [
                    'strict_types portÃ©e fichier : chaque fichier doit dÃ©clarer, pas hÃ©ritÃ© includes',
                    'Coercion risquÃ©e : "abc" converti 0 en mode coercitif, erreurs silencieuses',
                    'Mixed legacy : mÃ©langer code typÃ©/non-typÃ© complexifie maintenance',
                    'Performance minime : overhead validation type nÃ©gligeable sauf boucles critiques'
                ],
                'bestPractices' => [
                    'Toujours declare(strict_types=1) : Ã©vite conversions surprises, bugs subtils',
                    'Typer tout nouveau code : paramÃ¨tres ET retour, pas exceptions sauf mixed',
                    'Nullable explicite : ?Type clair sur acceptation null, pas mixed',
                    'Exceptions typÃ©es : function parse(): User throws ParseException documentation',
                    'Classes sur arrays : function get(): UserCollection meilleur que array'
                ],
                'resources' => [
                    ['label' => 'Type declarations PHP 7', 'url' => 'https://www.php.net/manual/fr/language.types.declarations.php', 'icon' => 'ðŸ“–']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-types_union_php8', 'label' => 'Types union PHP 8'],
                    ['id' => 'modal-valeurs_retour', 'label' => 'Valeurs de retour'],
                    ['id' => 'modal-parametres_arguments', 'label' => 'ParamÃ¨tres & Arguments']
                ]
            ],
            'types_union_php8' => [
                'description' => 'Types union (PHP 8.0+) et types intersection pour paramÃ¨tres et valeurs de retour plus flexibles.',
                'example' => '// Types union (PHP 8.0+)\nfunction traiter(string|int|float $valeur): string {\n    return (string) $valeur;\n}\n\n// Types intersection (PHP 8.1+)\nfunction processEntity(Countable&Traversable $data): void {\n    // $data doit implÃ©menter les deux interfaces\n}\n\n// Mixed type\nfunction flexible(mixed $anything): mixed {\n    return $anything;\n}',
                'details' => 'PHP 8 vous permet de dire qu\'une fonction accepte plusieurs types diffÃ©rents grÃ¢ce au symbole "|" (pipe). Par exemple, "function traiter(int|string $valeur)" signifie "j\'accepte soit un nombre, soit du texte". C\'est trÃ¨s pratique quand votre fonction peut gÃ©rer diffÃ©rents formats. Vous pouvez combiner autant de types que nÃ©cessaire : "int|float|string" fonctionne parfaitement. Il existe aussi le type "mixed" qui dit "j\'accepte n\'importe quoi" - mais utilisez-le avec prÃ©caution car vous perdez la protection des types. Enfin, le type "never" (PHP 8.1) est spÃ©cial : il indique que la fonction ne retourne jamais (par exemple, elle plante toujours ou redirige ailleurs).',
                'useCases' => [
                    'Polymorphisme : function getId(): int|string IDs entiers ou UUID strings',
                    'Input flexible : function parse(string|array $config) accepte formats multiples',
                    'Return prÃ©cis : function find(): User|null indique absence possible vs false',
                    'Fluent interfaces : function setName(string $name): static chaÃ®nage mÃ©thodes',
                    'Helpers gÃ©nÃ©riques : function first(array $items): mixed Ã©lÃ©ment type inconnu',
                    'Contraintes fortes : function log(Stringable&JsonSerializable $obj) deux interfaces'
                ],
                'warnings' => [
                    'Union large : int|string|bool|array trop permissif, perd bÃ©nÃ©fices types',
                    'Mixed Ã©quivalent no-type : Ã©viter mixed sauf vraiment gÃ©nÃ©rique, perd sÃ©curitÃ©',
                    'Never mÃ©connu : utilisateurs dÃ©butants ignorent existence, documenter',
                    'Intersection rare : Type1&Type2 cas usage limitÃ©, peut indiquer design flou'
                ],
                'bestPractices' => [
                    'Union minimal : limiter Ã  2-3 types, au-delÃ  revoir design',
                    'Null explicite : int|null plus clair que ?int|string ambiguÃ¯tÃ©',
                    'Static fluent : return static pas self pour hÃ©ritage correct',
                    'Documentation : union complexes mÃ©ritent @return commentaire exemples',
                    'Ã‰viter mixed : utiliser union prÃ©cis int|string|bool meilleur que mixed'
                ],
                'resources' => [
                    ['label' => 'Union types PHP 8', 'url' => 'https://www.php.net/manual/fr/language.types.declarations.php#language.types.declarations.union', 'icon' => 'ðŸ“–']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-types_parametres_php7', 'label' => 'Types paramÃ¨tres PHP 7'],
                    ['id' => 'modal-valeurs_retour', 'label' => 'Valeurs de retour'],
                    ['id' => 'modal-attributes_php8', 'label' => 'Attributs PHP 8']
                ]
            ],
            'valeurs_retour' => [
                'description' => 'Gestion des valeurs de retour : return simple, multiple, types de retour dÃ©clarÃ©s, void.',
                'example' => 'function diviser(float $a, float $b): float {\n    if ($b === 0.0) {\n        throw new DivisionByZeroError("Division par zÃ©ro");\n    }\n    return $a / $b;\n}\n\nfunction logger(string $message): void {\n    file_put_contents("log.txt", $message . PHP_EOL, FILE_APPEND);\n    // Pas de return\n}',
                'details' => 'Le mot "return" arrÃªte la fonction et renvoie un rÃ©sultat. C\'est comme quand vous demandez un calcul Ã  quelqu\'un et qu\'il vous donne la rÃ©ponse. Si une fonction ne fait pas de "return", PHP retourne automatiquement "null". Vous pouvez prÃ©ciser le type de ce que votre fonction retourne en ajoutant ": Type" aprÃ¨s les parenthÃ¨ses. Par exemple, ": int" pour un nombre, ": string" pour du texte. Si votre fonction ne retourne rien d\'utile (comme Ã©crire dans un fichier), utilisez ": void". Une astuce : retournez rapidement en cas d\'erreur au dÃ©but de la fonction pour Ã©viter des conditions imbriquÃ©es compliquÃ©es.',
                'useCases' => [
                    'Calculs : function calculer(): float retourne rÃ©sultat opÃ©ration',
                    'Recherche : function trouver(): ?User null si non trouvÃ©, objet sinon',
                    'Actions : function sauvegarder(): bool succÃ¨s/Ã©chec opÃ©ration',
                    'Multiples valeurs : function getCoords(): array return [$lat, $lng]',
                    'Fluent : function setName(string $n): self return $this chaÃ®nage',
                    'Side-effects : function log(): void fonction sans rÃ©sultat utile'
                ],
                'warnings' => [
                    'Return oubliÃ© : fonction avec type retour non-void doit toujours return valeur',
                    'Type incorrect : return "abc" dans function get(): int gÃ©nÃ¨re TypeError strict mode',
                    'Multiple returns : trop chemins return complexifie tests, limiter branches',
                    'Null implicite : fonction sans return retourne null, peut surprendre appelant'
                ],
                'bestPractices' => [
                    'DÃ©clarer type : toujours spÃ©cifier : Type sauf void ou gÃ©nÃ©rateurs',
                    'Early return : vÃ©rifier erreurs dÃ©but, Ã©viter if/else profondÃ©ment imbriquÃ©s',
                    'Null explicite : ?Type indique null possible, pas surprendre utilisateur',
                    'Une responsabilitÃ© : si return types diffÃ©rents selon branches, signe fonction fait trop',
                    'Documentation : @return complexe (unions, arrays) mÃ©rite commentaire structure'
                ],
                'resources' => [
                    ['label' => 'Return values', 'url' => 'https://www.php.net/manual/fr/functions.returning-values.php', 'icon' => 'ðŸ“–']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-types_parametres_php7', 'label' => 'Types paramÃ¨tres PHP 7'],
                    ['id' => 'modal-types_union_php8', 'label' => 'Types union PHP 8'],
                    ['id' => 'modal-generateurs_yield', 'label' => 'GÃ©nÃ©rateurs yield']
                ]
            ],
            'portee_variables' => [
                'description' => 'PortÃ©e des variables : locales, globales, static, closures et mot-clÃ© use pour capturer des variables.',
                'example' => '$compteur = 0; // Variable globale\n\nfunction incrementer() {\n    global $compteur;\n    $compteur++;\n}\n\nfunction compteurStatique() {\n    static $compteur = 0;\n    return ++$compteur;\n}\n\necho compteurStatique(); // 1\necho compteurStatique(); // 2',
                'details' => 'La portÃ©e d\'une variable, c\'est l\'endroit oÃ¹ elle existe et peut Ãªtre utilisÃ©e. Imaginez une variable comme un secret : elle n\'existe que dans sa "piÃ¨ce" (la fonction). Une variable crÃ©Ã©e dans une fonction disparaÃ®t quand la fonction se termine - c\'est une variable locale. Pour utiliser une variable dÃ©finie en dehors de toutes les fonctions (une variable globale), vous devez dire "global $nom" dans la fonction. Il existe aussi les variables "static" : elles gardent leur valeur entre chaque appel de la fonction, comme un compteur qui se souvient de oÃ¹ il en Ã©tait. Conseil : Ã©vitez les variables globales, elles rendent le code difficile Ã  comprendre et Ã  tester.',
                'useCases' => [
                    'Compteurs : static $count fonction garde Ã©tat entre appels',
                    'Cache : static $cache = [] mÃ©moÃ¯sation rÃ©sultats coÃ»teux',
                    'Closures : use ($config) accÃ¨s configuration depuis callback',
                    'Singletons : static $instance = null pattern singleton simple',
                    'Accumulateurs : static $total suivi cumul sans variable globale',
                    'Tests : global pour accÃ¨s fixtures, mieux dependency injection'
                ],
                'warnings' => [
                    'Global couplage : dÃ©pendances cachÃ©es, tests difficiles, Ã©viter en production',
                    'Static mutations : variables static = Ã©tat global, threading problÃ¨mes',
                    'Use par valeur : modification $var closure pas impact externe, rÃ©fÃ©rence &$var si besoin',
                    'Superglobales injection : $_GET/$_POST risques sÃ©curitÃ©, valider/assainir'
                ],
                'bestPractices' => [
                    'Ã‰viter global : passer paramÃ¨tres ou injecter dÃ©pendances, testable et clair',
                    'Static parcimonieux : seulement vrais cas usage (cache, compteurs), pas Ã©tat complexe',
                    'Use explicite : closures dÃ©clarent dÃ©pendances externes visibles signature',
                    'ImmutabilitÃ© : prÃ©fÃ©rer use ($var) copie que use (&$var) rÃ©fÃ©rence mutable',
                    'Injection : function process(Config $config) meilleur que global $config'
                ],
                'resources' => [
                    ['label' => 'Variable scope', 'url' => 'https://www.php.net/manual/fr/language.variables.scope.php', 'icon' => 'ðŸ“–']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-fonctions_anonymes', 'label' => 'Fonctions anonymes'],
                    ['id' => 'modal-declaration_fonctions', 'label' => 'DÃ©claration fonctions'],
                    ['id' => 'modal-fonctions_callback', 'label' => 'Fonctions callback']
                ]
            ],
            'fonctions_anonymes' => [
                'description' => 'Fonctions anonymes (closures) avec use pour capturer des variables de portÃ©e externe.',
                'example' => '$multiplicateur = 3;\n\n$multiplier = function($nombre) use ($multiplicateur) {\n    return $nombre * $multiplicateur;\n};\n\necho $multiplier(5); // 15\n\n// Capture par rÃ©fÃ©rence\n$compteur = 0;\n$incrementer = function() use (&$compteur) {\n    $compteur++;\n};\n\n$incrementer();\necho $compteur; // 1',
                'details' => 'Une fonction anonyme, c\'est une fonction sans nom que vous pouvez stocker dans une variable. C\'est pratique pour crÃ©er des petites fonctions temporaires. Par exemple : "$multiplier = function($x) { return $x * 2; }". Pour utiliser des variables de l\'extÃ©rieur dans votre fonction anonyme, ajoutez "use" : "function($x) use ($multiplicateur)". Par dÃ©faut, "use" fait une copie de la variable. Si vous voulez modifier la variable originale, ajoutez "&" : "use (&$compteur)". Les fonctions anonymes sont trÃ¨s utilisÃ©es avec les fonctions comme array_map ou array_filter pour transformer des tableaux.',
                'useCases' => [
                    'Callbacks : array_map(function($x) { return $x * 2; }, $array) transformations',
                    'Event handlers : $emitter->on("save", function($data) use ($logger) {...})',
                    'Factory patterns : function creerValidator($rules) { return function($data) use ($rules) {...} }',
                    'Scope isolation : (function() { $temp = ...; })() Ã©vite pollution globale',
                    'Lazy evaluation : $compute = function() { return expensiveOp(); } diffÃ©rÃ©',
                    'Middleware : array_reduce($middlewares, fn($carry, $mw) => $mw($carry), $request)'
                ],
                'warnings' => [
                    'Use par valeur : modification variable use pas visible externe, & si besoin',
                    'Capture implicite : oubli use gÃ©nÃ¨re undefined variable, contrairement arrow functions',
                    'Memory : closures gardent rÃ©fÃ©rences variables capturÃ©es, leaks possibles',
                    'Performance : crÃ©ation closure coÃ»teuse boucle serrÃ©e, dÃ©finir dehors si possible'
                ],
                'bestPractices' => [
                    'Use minimal : capturer seulement variables nÃ©cessaires, pas contexte entier',
                    'Typage : ajouter type hints paramÃ¨tres/retour comme fonctions normales',
                    'Arrow functions : prÃ©fÃ©rer fn() PHP 7.4+ si une seule expression',
                    'Nommage : stocker closures complexes variables nommÃ©es descriptives',
                    'ImmutabilitÃ© : prÃ©fÃ©rer use ($var) copie que use (&$var) mutations'
                ],
                'resources' => [
                    ['label' => 'Anonymous functions', 'url' => 'https://www.php.net/manual/fr/functions.anonymous.php', 'icon' => 'ðŸ“–']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-fonctions_flechees_php74', 'label' => 'Fonctions flÃ©chÃ©es PHP 7.4'],
                    ['id' => 'modal-portee_variables', 'label' => 'PortÃ©e variables'],
                    ['id' => 'modal-fonctions_callback', 'label' => 'Fonctions callback']
                ]
            ],
            'fonctions_flechees_php74' => [
                'description' => 'Fonctions flÃ©chÃ©es (PHP 7.4+) : syntaxe courte avec fn, capture automatique des variables, une seule expression.',
                'example' => '$nombres = [1, 2, 3, 4, 5];\n$multiplicateur = 2;\n\n// Fonction flÃ©chÃ©e (PHP 7.4+)\n$doubles = array_map(fn($n) => $n * $multiplicateur, $nombres);\n\n// Ã‰quivalent avec fonction anonyme\n$doubles2 = array_map(function($n) use ($multiplicateur) {\n    return $n * $multiplicateur;\n}, $nombres);',
                'details' => 'Les fonctions flÃ©chÃ©es (depuis PHP 7.4) sont une version super courte des fonctions anonymes. Au lieu d\'Ã©crire "function($x) use ($y) { return $x * $y; }", vous Ã©crivez simplement "fn($x) => $x * $y". C\'est beaucoup plus rapide Ã  Ã©crire ! Le gros avantage : elles peuvent utiliser les variables de l\'extÃ©rieur automatiquement, sans avoir besoin de "use". Par contre, elles sont limitÃ©es Ã  une seule instruction simple. Si vous avez besoin de plusieurs lignes de code ou de conditions complexes, utilisez une fonction anonyme normale. Les fonctions flÃ©chÃ©es sont parfaites pour les petites transformations de tableaux.',
                'useCases' => [
                    'Array operations : array_map(fn($x) => $x * 2, $data) transformations simples',
                    'Filtering : array_filter($users, fn($u) => $u->age >= 18) prÃ©dicats courts',
                    'Sorting : usort($items, fn($a, $b) => $a->price <=> $b->price) comparateurs',
                    'Optionals : $result ?? fn() => defaultValue() valeurs dÃ©faut calculÃ©es',
                    'Pipelines : array_reduce($fns, fn($v, $f) => $f($v), $input) compositions',
                    'Event mapping : array_map(fn($e) => new DTO($e), $events) conversions'
                ],
                'warnings' => [
                    'Une expression : pas if/else multi-lignes, utiliser ternaire ou function() classique',
                    'Capture valeur : variables capturÃ©es par valeur, modifications pas visibles externe',
                    'Debuggage : pas nom fonction stack traces, difficile identifier erreurs',
                    'CompatibilitÃ© : PHP 7.4+ requis, vÃ©rifier version dÃ©ploiement'
                ],
                'bestPractices' => [
                    'Callbacks simples : prÃ©fÃ©rer fn() Ã  function() use si une seule expression',
                    'LisibilitÃ© : si expression longue/complexe, function() classique plus claire',
                    'Typage : ajouter types mÃªme syntaxe courte : fn(int $x): int amÃ©liore contrat',
                    'Composition : chaÃ®ner fn() pipelines fonctionnelles Ã©lÃ©gantes',
                    'Performance : fn() lÃ©gÃ¨rement plus performant que function() use overhead rÃ©duit'
                ],
                'resources' => [
                    ['label' => 'Arrow functions PHP 7.4', 'url' => 'https://www.php.net/manual/fr/functions.arrow.php', 'icon' => 'ðŸ“–']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-fonctions_anonymes', 'label' => 'Fonctions anonymes'],
                    ['id' => 'modal-fonctions_callback', 'label' => 'Fonctions callback'],
                    ['id' => 'modal-portee_variables', 'label' => 'PortÃ©e variables']
                ]
            ],
            'fonctions_callback' => [
                'description' => 'Utilisation de fonctions comme callbacks : callable, array_map, array_filter, usort avec fonctions personnalisÃ©es.',
                'example' => '$personnes = [\n    ["nom" => "Alice", "age" => 30],\n    ["nom" => "Bob", "age" => 25],\n    ["nom" => "Charlie", "age" => 35]\n];\n\n// Trier par Ã¢ge\nusort($personnes, fn($a, $b) => $a["age"] <=> $b["age"]);\n\n// Filtrer les majeurs\n$majeurs = array_filter($personnes, fn($p) => $p["age"] >= 18);',
                'details' => 'Un callback, c\'est une fonction que vous passez Ã  une autre fonction pour qu\'elle l\'utilise. C\'est comme donner une recette Ã  quelqu\'un pour qu\'il cuisine Ã  votre place. Par exemple, "array_map" prend une fonction et l\'applique Ã  chaque Ã©lÃ©ment d\'un tableau. Vous pouvez passer le nom d\'une fonction ("strlen"), une fonction anonyme, ou une fonction flÃ©chÃ©e comme callback. Les callbacks sont trÃ¨s pratiques pour personnaliser le comportement de fonctions gÃ©nÃ©riques. Par exemple, "array_filter" garde les Ã©lÃ©ments d\'un tableau selon votre fonction de test, "usort" trie un tableau selon votre logique de comparaison personnalisÃ©e.',
                'useCases' => [
                    'Transformations : array_map(fn($x) => strtoupper($x), $names) modifier Ã©lÃ©ments',
                    'Filtrage : array_filter($data, fn($item) => $item->isValid()) sÃ©lection',
                    'Tri personnalisÃ© : usort($products, fn($a, $b) => $a->price <=> $b->price)',
                    'Event handlers : $dispatcher->on("user.created", $sendEmailCallback)',
                    'Middleware : $pipeline->pipe($authenticateCallback)->pipe($logCallback)',
                    'Strategy pattern : $processor->setValidator($customValidatorCallback) injection'
                ],
                'warnings' => [
                    'Performance : callbacks boucles serrÃ©es overhead appels, inline si critique',
                    'Debuggage : stack traces complexes callbacks anonymes, nommer si possible',
                    'SÃ©curitÃ© : call_user_func avec input utilisateur = risque exÃ©cution arbitraire',
                    'Type safety : callable accepte tout, vÃ©rifier signature attendue documentation'
                ],
                'bestPractices' => [
                    'Type hint callable : function process(callable $transformer) contrat explicite',
                    'Nommer callbacks : $validateEmail = fn($e) => filter_var($e, FILTER_VALIDATE_EMAIL)',
                    'Composition : chaÃ®ner callbacks array_reduce pipelines fonctionnelles',
                    'Validation : is_callable() avant call_user_func Ã©vite erreurs runtime',
                    'First-class PHP 8.1 : $cb = strlen(...) plus Ã©lÃ©gant que "strlen"'
                ],
                'resources' => [
                    ['label' => 'Callbacks / Callables', 'url' => 'https://www.php.net/manual/fr/language.types.callable.php', 'icon' => 'ðŸ“–']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-fonctions_anonymes', 'label' => 'Fonctions anonymes'],
                    ['id' => 'modal-fonctions_flechees_php74', 'label' => 'Fonctions flÃ©chÃ©es'],
                    ['id' => 'modal-first_class_callable_php81', 'label' => 'First-class callable PHP 8.1']
                ]
            ],
            'generateurs_yield' => [
                'description' => 'GÃ©nÃ©rateurs avec yield : fonctions qui retournent un Iterator, Ã©conomie mÃ©moire, yield from (PHP 7.0+).',
                'example' => 'function compterJusque($max) {\n    for ($i = 1; $i <= $max; $i++) {\n        yield $i;\n    }\n}\n\nfunction fibonacci($n) {\n    $a = 0; $b = 1;\n    for ($i = 0; $i < $n; $i++) {\n        yield $a;\n        [$a, $b] = [$b, $a + $b];\n    }\n}\n\n// yield from (PHP 7.0+)\nfunction compterEtDoubler($max) {\n    yield from compterJusque($max);\n    yield from array_map(fn($x) => $x * 2, range(1, $max));\n}',
                'details' => 'Un gÃ©nÃ©rateur est une fonction spÃ©ciale qui produit des valeurs une par une au lieu de toutes en mÃªme temps. Au lieu de "return", utilisez "yield" pour donner chaque valeur. C\'est comme distribuer des cartes : vous en donnez une, attendez qu\'on la prenne, puis donnez la suivante. L\'Ã©norme avantage : Ã©conomiser la mÃ©moire. Si vous traitez un fichier de 1 million de lignes, un gÃ©nÃ©rateur traite une ligne Ã  la fois au lieu de charger tout en mÃ©moire. C\'est parfait pour les gros fichiers, les rÃ©sultats de base de donnÃ©es avec beaucoup de lignes, ou mÃªme pour crÃ©er des sÃ©quences infinies de nombres.',
                'useCases' => [
                    'Gros fichiers : function lireLignes($file) { yield fgets($handle); } ligne par ligne',
                    'SÃ©quences infinies : function nombres() { $i=0; while(true) yield $i++; }',
                    'Pagination : function fetchPage($page) { yield from apiCall($page); } pages API',
                    'Stream processing : yield chaque Ã©lÃ©ment traitÃ© pas accumuler tout',
                    'Range custom : function range($start, $end, $step) { yield ... } flexible',
                    'Arbres : function traverser($node) { yield $node; yield from $node->children; }'
                ],
                'warnings' => [
                    'Reset impossible : Generator pas rewindable, relancer fonction si retry nÃ©cessaire',
                    'Ã‰tat fragile : send() mutations complexes, prÃ©fÃ©rer yield simples',
                    'Performance : overhead iteration, pas toujours meilleur que array petites donnÃ©es',
                    'Debuggage : exÃ©cution diffÃ©rÃ©e complique breakpoints, valeurs inconnues avant yield'
                ],
                'bestPractices' => [
                    'Gros datasets : toujours yield fichiers/requÃªtes volumineuses Ã©viter OOM',
                    'Type hints : function gen(): Generator indique retour gÃ©nÃ©rateur',
                    'Yield from : dÃ©lÃ©guer sous-gÃ©nÃ©rateurs Ã©vite boucles manuelles',
                    'Documentation : @return Generator<int, User> prÃ©cise types clÃ©/valeur',
                    'Cleanup : try/finally dans gÃ©nÃ©rateurs assure fermeture ressources'
                ],
                'resources' => [
                    ['label' => 'Generators', 'url' => 'https://www.php.net/manual/fr/language.generators.php', 'icon' => 'ðŸ“–']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-valeurs_retour', 'label' => 'Valeurs de retour'],
                    ['id' => 'modal-fonctions_anonymes', 'label' => 'Fonctions anonymes'],
                    ['id' => 'modal-recursivite', 'label' => 'RÃ©cursivitÃ©']
                ]
            ],
            'recursivite' => [
                'description' => 'Fonctions rÃ©cursives : appel de la fonction par elle-mÃªme, cas de base, optimisation tail recursion.',
                'example' => 'function factorielle($n) {\n    if ($n <= 1) {\n        return 1; // Cas de base\n    }\n    return $n * factorielle($n - 1);\n}\n\nfunction fibonacciRec($n) {\n    if ($n <= 1) return $n;\n    return fibonacciRec($n - 1) + fibonacciRec($n - 2);\n}\n\necho factorielle(5); // 120',
                'details' => 'La rÃ©cursivitÃ©, c\'est quand une fonction s\'appelle elle-mÃªme. Imaginez une poupÃ©e russe : vous ouvrez une poupÃ©e, et dedans il y a une autre poupÃ©e, et encore une autre... jusqu\'Ã  la plus petite. C\'est pareil pour les fonctions rÃ©cursives. L\'Ã©lÃ©ment crucial : il faut une condition d\'arrÃªt, sinon la fonction s\'appellera Ã  l\'infini et fera planter votre programme. Par exemple, pour calculer la factorielle de 5 (5! = 5Ã—4Ã—3Ã—2Ã—1), la fonction calcule 5 Ã— factorielle(4), qui calcule 4 Ã— factorielle(3), etc., jusqu\'Ã  atteindre 1 (la condition d\'arrÃªt). Attention : en PHP, les fonctions rÃ©cursives peuvent Ãªtre lentes, utilisez-les avec modÃ©ration.',
                'useCases' => [
                    'Structures arborescentes : parcourir DOM, JSON, systÃ¨mes fichiers rÃ©cursivement',
                    'Algorithmes divide-and-conquer : quicksort, mergesort dÃ©composition rÃ©cursive',
                    'MathÃ©matiques : factorielle, fibonacci, calculs combinatoires naturellement rÃ©cursifs',
                    'Backtracking : recherche chemins, permutations, sudoku solver',
                    'Parser : analyseurs syntaxiques expressions imbriquÃ©es',
                    'Graphes : parcours profondeur DFS (depth-first search) rÃ©cursif'
                ],
                'warnings' => [
                    'Stack overflow : rÃ©cursion profonde Ã©puise mÃ©moire, prÃ©fÃ©rer itÃ©ratif si > 100 niveaux',
                    'Performance : appels fonction coÃ»teux PHP, boucles itÃ©ratives souvent meilleures',
                    'Fibonacci naÃ¯f : complexitÃ© exponentielle sans mÃ©moÃ¯sation, Ã©viter',
                    'Debuggage : stack traces longs rÃ©cursion, difficile suivre Ã©tat'
                ],
                'bestPractices' => [
                    'Toujours cas base : vÃ©rifier condition arrÃªt claire sinon infinite loop',
                    'Limite profondeur : if ($depth > 100) throw exception protection stack overflow',
                    'MÃ©moÃ¯sation : static $cache = [] stocker rÃ©sultats sous-problÃ¨mes rÃ©pÃ©tÃ©s',
                    'ItÃ©ratif prÃ©fÃ©rable : si facile convertir boucle, meilleure performance PHP',
                    'Tests unitaires : cas base, cas rÃ©cursif, limites tester exhaustivement'
                ],
                'resources' => [
                    ['label' => 'Recursion concept', 'url' => 'https://en.wikipedia.org/wiki/Recursion_(computer_science)', 'icon' => 'ðŸ“–']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-declaration_fonctions', 'label' => 'DÃ©claration fonctions'],
                    ['id' => 'modal-valeurs_retour', 'label' => 'Valeurs de retour'],
                    ['id' => 'modal-generateurs_yield', 'label' => 'GÃ©nÃ©rateurs yield']
                ]
            ],
            'fonctions_variables' => [
                'description' => 'Fonctions variables : appeler une fonction via une variable contenant son nom, vÃ©rification avec is_callable().',
                'example' => 'function saluer($nom) {\n    return "Bonjour " . $nom;\n}\n\n$fonction = "saluer";\nif (is_callable($fonction)) {\n    echo $fonction("Marie"); // "Bonjour Marie"\n}\n\n// Avec mÃ©thodes\n$obj = new DateTime();\n$methode = "format";\necho $obj->$methode("Y-m-d");',
                'details' => 'Une fonction variable, c\'est quand vous stockez le nom d\'une fonction dans une variable, puis vous appelez cette variable comme une fonction. Par exemple : "$maFonction = \'strlen\'; $maFonction(\'test\');" appelle la fonction strlen. C\'est pratique pour crÃ©er des systÃ¨mes flexibles oÃ¹ l\'action Ã  effectuer change selon le contexte. Mais attention : c\'est dangereux ! VÃ©rifiez toujours avec "is_callable()" que la fonction existe avant de l\'appeler, sinon votre programme plantera. Et JAMAIS vous ne devez laisser un utilisateur dÃ©cider quelle fonction appeler directement - ce serait une Ã©norme faille de sÃ©curitÃ©.',
                'useCases' => [
                    'Routing : $action = $_GET["action"]; if(is_callable($action)) $action() dispatch',
                    'Command pattern : $commands[$name]() exÃ©cuter commandes enregistrÃ©es',
                    'Factory : $type = "create" . $entity; $factory->$type() mÃ©thodes dynamiques',
                    'Helpers : $formatter = "format" . $type; $formatter($data) dispatch formatters',
                    'Testing : $method = "test" . $name; $this->$method() tests dynamiques',
                    'Plugins : $hook = $pluginPrefix . $action; $hook() systÃ¨me hooks extensible'
                ],
                'warnings' => [
                    'SÃ©curitÃ© critique : jamais input utilisateur direct sans whitelist, RCE possible',
                    'Typage perdu : IDE/PHPStan dÃ©tectent pas appels dynamiques, erreurs runtime',
                    'Debuggage dur : stack traces peu clairs, difficile tracer origine appels',
                    'Performance : appels dynamiques lÃ©gÃ¨rement plus lents que statiques'
                ],
                'bestPractices' => [
                    'Whitelist stricte : $allowed = ["action1", "action2"]; if(in_array($func, $allowed))',
                    'Toujours is_callable : vÃ©rifier avant appel Ã©vite erreurs fatales',
                    'Documentation : @var callable $function commenter type attendu',
                    'Alternatives : match/switch souvent plus clair que dispatch dynamique',
                    'Ã‰viter si possible : appels statiques $obj->methode() plus sÃ»rs, maintenables'
                ],
                'resources' => [
                    ['label' => 'Variable functions', 'url' => 'https://www.php.net/manual/fr/functions.variable-functions.php', 'icon' => 'ðŸ“–']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-fonctions_callback', 'label' => 'Fonctions callback'],
                    ['id' => 'modal-fonctions_anonymes', 'label' => 'Fonctions anonymes'],
                    ['id' => 'modal-declaration_fonctions', 'label' => 'DÃ©claration fonctions']
                ]
            ],
            'attributes_php8' => [
                'description' => 'Attributs PHP 8.0+ : mÃ©tadonnÃ©es pour fonctions, classes et propriÃ©tÃ©s avec la syntaxe #[Attribute].',
                'example' => '#[Attribute]\nclass Deprecated {\n    public function __construct(public string $message = "") {}\n}\n\n#[Deprecated("Utilisez nouvelleMethode() Ã  la place")]\nfunction ancienneMethode() {\n    // Code dÃ©prÃ©ciÃ©\n}\n\n// Lecture des attributs\n$reflection = new ReflectionFunction("ancienneMethode");\n$attributes = $reflection->getAttributes(Deprecated::class);',
                'details' => 'Les attributs (depuis PHP 8) sont comme des Ã©tiquettes qu\'on colle sur les fonctions, classes ou propriÃ©tÃ©s pour leur donner des informations supplÃ©mentaires. Par exemple, "#[Route(\'/users\')]" au-dessus d\'une fonction indique que cette fonction gÃ¨re l\'URL "/users". Les attributs ne font rien par eux-mÃªmes - ce sont les frameworks (comme Symfony) qui les lisent et agissent en consÃ©quence. C\'est plus propre et plus sÃ»r que les anciennes annotations dans les commentaires. Les attributs sont trÃ¨s utilisÃ©s pour le routing, la validation de donnÃ©es, ou indiquer comment sauvegarder des objets en base de donnÃ©es.',
                'useCases' => [
                    'Routing : #[Route("/users", methods: ["GET"])] dÃ©finir routes controllers',
                    'Validation : #[Assert\\NotBlank] #[Assert\\Email] rÃ¨gles propriÃ©tÃ©s',
                    'Serialization : #[SerializedName("user_name")] mapping JSON/DTO',
                    'ORM : #[Entity] #[Column(type: "string")] mapping base donnÃ©es',
                    'Cache : #[Cacheable(ttl: 3600)] marquer mÃ©thodes cachables',
                    'Security : #[IsGranted("ROLE_ADMIN")] contrÃ´le accÃ¨s dÃ©claratif'
                ],
                'warnings' => [
                    'PHP 8.0+ requis : vÃ©rifier compatibilitÃ© projet avant utiliser',
                    'Runtime overhead : lecture Reflection coÃ»teuse, cacher mÃ©tadonnÃ©es',
                    'Pas magique : attributs ne font rien seuls, framework doit interprÃ©ter',
                    'BC breaks : migration annotations @Doctrine vers attributs nÃ©cessite refactoring'
                ],
                'bestPractices' => [
                    'Target spÃ©cifique : #[Attribute(Attribute::TARGET_METHOD)] restreindre usage',
                    'Repeatable : Attribute::IS_REPEATABLE autoriser multiples mÃªmes attributs',
                    'Typage arguments : constructeur attribut avec types stricts validation',
                    'Cache metadata : ReflectionClass->getAttributes() stocker Ã©vite rÃ©pÃ©ter',
                    'Documentation : attributs remplacent @annotations mais commenter complexes'
                ],
                'resources' => [
                    ['label' => 'Attributes PHP 8', 'url' => 'https://www.php.net/manual/fr/language.attributes.php', 'icon' => 'ðŸ“–']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-types_union_php8', 'label' => 'Types union PHP 8'],
                    ['id' => 'modal-named_arguments_php8', 'label' => 'Arguments nommÃ©s PHP 8'],
                    ['id' => 'modal-declaration_fonctions', 'label' => 'DÃ©claration fonctions']
                ]
            ],
            'named_arguments_php8' => [
                'description' => 'Arguments nommÃ©s (PHP 8.0+) : passer des arguments par nom plutÃ´t que par position, amÃ©liore la lisibilitÃ©.',
                'example' => 'function creerUtilisateur($nom, $age, $email, $actif = true) {\n    return compact("nom", "age", "email", "actif");\n}\n\n// Arguments positionnels classiques\n$user1 = creerUtilisateur("John", 25, "john@example.com");\n\n// Arguments nommÃ©s (PHP 8.0+)\n$user2 = creerUtilisateur(\n    nom: "Marie",\n    email: "marie@example.com", \n    age: 30,\n    actif: false\n);',
                'details' => 'Depuis PHP 8, vous pouvez nommer vos arguments quand vous appelez une fonction. Au lieu de devoir respecter l\'ordre exact "creerUser(\'Marie\', 30, \'marie@test.com\')", vous pouvez Ã©crire "creerUser(nom: \'Marie\', email: \'marie@test.com\', age: 30)" dans n\'importe quel ordre. C\'est super pratique quand une fonction a beaucoup de paramÃ¨tres ou quand vous voulez sauter des paramÃ¨tres optionnels. Par exemple, "setOptions(cache: true, timeout: 30)" est beaucoup plus clair que "setOptions(true, 30)" - on comprend tout de suite ce que font ces valeurs. Les arguments nommÃ©s rendent votre code auto-documentÃ© et plus facile Ã  lire.',
                'useCases' => [
                    'ParamÃ¨tres optionnels : setOptions(cache: true, timeout: 30) skip inutiles',
                    'LisibilitÃ© : createUser(name: $name, email: $email, active: true) auto-doc',
                    'Refactoring : ajouter paramÃ¨tre milieu sans casser appels existants',
                    'Config : buildQuery(select: ["*"], where: $cond, limit: 10) type config',
                    'Boolean flags : process(async: true, validate: false) clair vs true, false',
                    'Overloading : simuler surcharge fonction via arguments optionnels nommÃ©s'
                ],
                'warnings' => [
                    'Ordre positionnels : nommÃ©s APRÃˆS positionnels, sinon erreur syntaxe',
                    'Renommage params : changer nom paramÃ¨tre = breaking change appels nommÃ©s',
                    'Variadic : ...$args perd noms clÃ©s numÃ©riques, utiliser array si besoin',
                    'Performance minime : overhead rÃ©solution noms nÃ©gligeable sauf micro-benchmarks'
                ],
                'bestPractices' => [
                    'Flags boolÃ©ens : toujours nommer enabled: true vs position ambiguÃ«',
                    'ParamÃ¨tres multiples : > 3 params utiliser nommÃ©s amÃ©liore lisibilitÃ©',
                    'APIs publiques : considÃ©rer noms params stable API, documenter si changement',
                    'Mix judicieux : positionnels obligatoires, nommÃ©s optionnels Ã©quilibre lisibilitÃ©',
                    'Unpacking : array_merge(...$arrays) Ã©quivalent splatting positionnel'
                ],
                'resources' => [
                    ['label' => 'Named arguments PHP 8', 'url' => 'https://www.php.net/manual/fr/functions.arguments.php#functions.named-arguments', 'icon' => 'ðŸ“–']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-parametres_arguments', 'label' => 'ParamÃ¨tres & Arguments'],
                    ['id' => 'modal-types_union_php8', 'label' => 'Types union PHP 8'],
                    ['id' => 'modal-attributes_php8', 'label' => 'Attributs PHP 8']
                ]
            ],
            'first_class_callable_php81' => [
                'description' => 'First-class callable syntax (PHP 8.1+) : obtenir une rÃ©fÃ©rence callable avec la syntaxe ... plus Ã©lÃ©gante.',
                'example' => 'function multiplier($a, $b) {\n    return $a * $b;\n}\n\nclass Calculator {\n    public function add($a, $b) {\n        return $a + $b;\n    }\n}\n\n// PHP 8.1+ First-class callable\n$fn = multiplier(...);\n$result = $fn(3, 4); // 12\n\n$calc = new Calculator();\n$addFn = $calc->add(...);\n$sum = $addFn(5, 3); // 8',
                'details' => 'PHP 8.1 introduit une syntaxe Ã©lÃ©gante pour crÃ©er des rÃ©fÃ©rences vers des fonctions : les trois petits points "...". Par exemple, au lieu d\'Ã©crire l\'ancien "array_map([\'strtoupper\'], $items)" ou le verbeux "Closure::fromCallable(\'strlen\')", vous Ã©crivez simplement "strlen(...)". C\'est plus court, plus clair, et fonctionne avec les fonctions normales, les mÃ©thodes d\'objets, et les mÃ©thodes statiques. Par exemple : "$formatter = $obj->format(...)" crÃ©e une rÃ©fÃ©rence Ã  la mÃ©thode format que vous pouvez passer et utiliser partout. C\'est juste une nouvelle faÃ§on plus propre d\'Ã©crire, le rÃ©sultat et les performances sont identiques aux anciennes mÃ©thodes.',
                'useCases' => [
                    'Callbacks : array_map(strtoupper(...), $items) rÃ©fÃ©rence fonction Ã©lÃ©gante',
                    'MÃ©thodes : $users->map($user->getName(...)) extraire donnÃ©es objets',
                    'Partiel application : $add5 = fn($x) => add($x, 5) currying manuel',
                    'Event handlers : $emitter->on("save", $logger->log(...)) mÃ©thodes callbacks',
                    'Composition : $pipeline = [$validate(...), $transform(...), $save(...)]',
                    'Dependency injection : $container->set("formatter", $formatter->format(...))'
                ],
                'warnings' => [
                    'PHP 8.1+ requis : syntaxe invalide versions antÃ©rieures, vÃ©rifier min version',
                    'Closure binding : mÃ©thodes privÃ©es via ... gardent accÃ¨s private, attention encapsulation',
                    'Performance identique : pas optimisation vs anciennes mÃ©thodes, juste syntaxe',
                    'Confusion variadic : ne PAS confondre fonction(...) callable avec ...$args spread'
                ],
                'bestPractices' => [
                    'PrÃ©fÃ©rer ... : remplacer ["class", "method"] par Classe::method(...) moderne',
                    'Type hints : Closure retournÃ© typÃ©, IDE autocomplÃ©tion meilleure',
                    'LisibilitÃ© : $callable = $obj->process(...); array_map($callable, $data) nommer',
                    'Composition : chaÃ®ner callables $pipeline->pipe($step1(...))->pipe($step2(...))',
                    'Migration : refactor anciens array callables progressivement vers ...'
                ],
                'resources' => [
                    ['label' => 'First-class callable PHP 8.1', 'url' => 'https://www.php.net/manual/fr/functions.first_class_callable_syntax.php', 'icon' => 'ðŸ“–']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-fonctions_callback', 'label' => 'Fonctions callback'],
                    ['id' => 'modal-fonctions_anonymes', 'label' => 'Fonctions anonymes'],
                    ['id' => 'modal-fonctions_variables', 'label' => 'Fonctions variables']
                ]
            ],
            'comparaison_php_javascript' => [
                'description' => 'Comparaison des fonctions PHP vs JavaScript : points communs, diffÃ©rences clÃ©s, syntaxes et fonctionnalitÃ©s spÃ©cifiques.',
                'example' => '// PHP\nfunction calculer($a, $b) {\n    return $a + $b;\n}\n$fn = fn($x) => $x * 2;\n\n// JavaScript\nfunction calculer(a, b) {\n    return a + b;\n}\nconst fn = x => x * 2;\n\n// Closures\n// PHP: use keyword\n$multiplier = function($x) use ($factor) { return $x * $factor; };\n// JS: automatic capture\nconst multiplier = (x) => x * factor;',
                'details' => 'PHP et JavaScript partagent beaucoup de concepts pour les fonctions. Mais ils ont aussi des diffÃ©rences importantes.

**Ce qui est pareil :**
Une fonction c\'est un bloc de code qu\'on peut rÃ©utiliser. Dans les deux langages on peut : donner des paramÃ¨tres Ã  la fonction, retourner un rÃ©sultat avec return, crÃ©er des fonctions anonymes (sans nom), et utiliser des fonctions flÃ©chÃ©es courtes.

**Les diffÃ©rences de base :**
En PHP, on Ã©crit toujours $ devant les variables ($nom, $age). En JavaScript, pas besoin de $. En PHP, on met TOUJOURS un point-virgule ; Ã  la fin des lignes. En JavaScript, c\'est optionnel. En PHP, le mot "function" est obligatoire pour dÃ©clarer une fonction. En JavaScript, on peut aussi Ã©crire "const maFonction = ..." pour crÃ©er une fonction.

**Le typage (dÃ©finir le type des donnÃ©es) :**
PHP permet de dire "ce paramÃ¨tre doit Ãªtre un nombre" ou "cette fonction retourne du texte". Exemple : function calculer(int $nombre): string. JavaScript de base ne le fait pas (mais TypeScript ajoute cette possibilitÃ©).

**Les closures (fonctions qui utilisent des variables extÃ©rieures) :**
En PHP, il faut explicitement dire quelles variables on veut utiliser avec le mot "use". Exemple : function() use ($x). En JavaScript, c\'est automatique, la fonction peut directement utiliser les variables autour d\'elle.

**L\'ordre de dÃ©claration :**
En PHP, vous devez dÃ©clarer une fonction avant de l\'appeler (sauf les fonctions normales). En JavaScript, les fonctions dÃ©clarÃ©es avec "function" peuvent Ãªtre utilisÃ©es avant leur dÃ©claration (Ã§a s\'appelle le "hoisting").

**Le mot $this :**
En PHP, $this reprÃ©sente toujours l\'objet actuel dans une classe. En JavaScript, "this" change selon comment la fonction est appelÃ©e, ce qui peut crÃ©er des bugs si on ne fait pas attention.

**La programmation asynchrone :**
JavaScript peut naturellement gÃ©rer plusieurs tÃ¢ches en mÃªme temps avec async/await. PHP est synchrone par dÃ©faut (il fait une chose Ã  la fois), il faut des bibliothÃ¨ques spÃ©ciales pour faire de l\'asynchrone.',
                'useCases' => [
                    'Migration code : comprendre Ã©quivalences PHP â†” JS pour full-stack development',
                    'APIs : harmoniser logique mÃ©tier backend PHP et validation frontend JavaScript',
                    'Closures : use($var) PHP = capture auto JS, adapter patterns fonctionnels',
                    'Callbacks : array_map PHP = Array.map JS, syntaxes diffÃ©rentes logique identique',
                    'Arrow functions : fn() PHP 7.4 inspirÃ© => JS, moderniser code',
                    'Typage : strict_types PHP vs TypeScript JS, stratÃ©gies validation donnÃ©es'
                ],
                'warnings' => [
                    'This binding : comportement radicalement diffÃ©rent, source bugs cross-language',
                    'Hoisting : JS hoist functions, PHP non, ordre dÃ©clarations important PHP',
                    'Typage faible : PHP et JS jonglage types, strict_types PHP vs TypeScript recommandÃ©s',
                    'Async : PHP synchrone par dÃ©faut, JS asynchrone, architectures incompatibles directes'
                ],
                'bestPractices' => [
                    'Documentation : commenter diffÃ©rences implÃ©mentation PHP/JS mÃªme logique mÃ©tier',
                    'Conventions : unifier nommage fonctions cÃ´tÃ© serveur/client (camelCase ou snake_case)',
                    'Validation : doubler validation cÃ´tÃ© serveur PHP ET client JS, jamais confiance unique',
                    'Types : utiliser strict_types PHP + TypeScript JS environnements professionnels',
                    'Patterns : adapter design patterns (Strategy, Observer) idiomes chaque langage'
                ],
                'resources' => [
                    ['label' => 'PHP Functions', 'url' => 'https://www.php.net/manual/fr/language.functions.php', 'icon' => 'ðŸ“–'],
                    ['label' => 'MDN JavaScript Functions', 'url' => 'https://developer.mozilla.org/fr/docs/Web/JavaScript/Guide/Functions', 'icon' => 'ðŸ“–']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-fonctions_anonymes', 'label' => 'Fonctions anonymes'],
                    ['id' => 'modal-fonctions_flechees_php74', 'label' => 'Fonctions flÃ©chÃ©es PHP 7.4'],
                    ['id' => 'modal-fonctions_callback', 'label' => 'Fonctions callback']
                ]
            ],
        ];
        return $this->render('fonction_php/index.html.twig', [
            'data' => $dataFonctionsPHP,
        ]);
    }
}
