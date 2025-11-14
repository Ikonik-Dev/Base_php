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

        // Données complètes sur les fonctions PHP : déclaration, paramètres, types, portée, anonymes, fléchées, générateurs et fonctionnalités modernes PHP 7/8
        $dataFonctionsPHP = [
            'declaration_fonctions' => [
                'description' => 'Déclaration de fonctions avec le mot-clé function, nommage et bonnes pratiques de nomenclature.',
                'example' => 'function saluer($nom) {\n    return "Bonjour " . $nom;\n}\n\nfunction calculerAge($dateNaissance) {\n    $aujourd\'hui = new DateTime();\n    $naissance = new DateTime($dateNaissance);\n    return $aujourd\'hui->diff($naissance)->y;\n}',
                'details' => 'Les fonctions en PHP se déclarent avec le mot-clé function suivi du nom, parenthèses avec paramètres optionnels, et accolades pour le corps. Syntaxe : function nomFonction($param1, $param2) { code }. Nommage : camelCase ou snake_case, descriptif de l\'action (calculer, obtenir, traiter). Fonctions retournent valeur via return ou null implicite si absent. Portée : définies au niveau global ou dans namespace, accessibles partout après déclaration. Hoisting partiel : déclaration traitée avant exécution. Pas de surcharge : nom unique par fonction (pas deux fonctions même nom paramètres différents). Fonctions natives PHP nombreuses (array_map, strlen, etc.), éviter redéfinition. Documentation : PHPDoc recommandé (@param, @return, @throws).',
                'useCases' => [
                    'Réutilisation code : function calculerTVA($prix) pour éviter répétition logique',
                    'Abstraction : function envoyerEmail($destinataire, $sujet, $message) masque complexité',
                    'Organisation : function validerFormulaire(), function sauvegarderDonnees() structure claire',
                    'Tests unitaires : fonctions isolées testables : assertEquals(expected, maFonction(input))',
                    'APIs : function traiterRequeteAPI() centralise logique endpoints',
                    'Helpers : function formatDate($date), function slugify($texte) utilitaires projet'
                ],
                'warnings' => [
                    'Noms ambigus : function process() trop vague, préférer function processUserData()',
                    'Fonctions trop longues : > 50 lignes signe refactoring nécessaire',
                    'Effets de bord cachés : fonction modifie variables globales, fichiers sans indication claire',
                    'Return multiple types : fonction retourne int ou false complique utilisation'
                ],
                'bestPractices' => [
                    'Nommage : verbe + nom : getUserById(), calculateTotal(), isValidEmail()',
                    'Responsabilité unique : une fonction = une tâche, pas mélanger logique métier et affichage',
                    'Typage strict : declare(strict_types=1) + types paramètres/retour PHP 7+',
                    'Documentation : PHPDoc pour fonctions publiques/complexes',
                    'Taille limitée : max 20-30 lignes idéalement, extraire sous-fonctions si plus'
                ],
                'resources' => [
                    ['title' => 'Fonctions utilisateur', 'url' => 'https://www.php.net/manual/fr/functions.user-defined.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-parametres_arguments', 'label' => 'Paramètres & Arguments'],
                    ['id' => 'modal-valeurs_retour', 'label' => 'Valeurs de retour'],
                    ['id' => 'modal-portee_variables', 'label' => 'Portée des variables']
                ]
            ],
            'parametres_arguments' => [
                'description' => 'Gestion des paramètres : obligatoires, optionnels, valeurs par défaut, nombre variable d\'arguments.',
                'example' => 'function info($nom, $age = 25, $ville = "Paris") {\n    return "$nom, $age ans, habite $ville";\n}\n\n// Appels\necho info("John"); // Valeurs par défaut\necho info("Marie", 30); // Age personnalisé\necho info("Paul", 35, "Lyon"); // Tous personnalisés',
                'details' => 'Les paramètres définissent données attendues par fonction. Déclarés entre parenthèses : function nom($param1, $param2). Paramètres obligatoires avant optionnels. Valeurs par défaut : $param = valeur (null, scalaire, array depuis PHP 5.6, objets via new). Arguments passés par position ou nom (PHP 8+). Nombre illimité théorique mais lisibilité limite à 3-5. Passage par valeur (copie) par défaut, par référence avec & : function increment(&$var). Paramètres variadic : ...$args collecte arguments restants en array. Type hints obligent type : function add(int $a, int $b). Valeur par défaut doit être constante pas variable. Ordre : obligatoires, optionnels, variadic en dernier.',
                'useCases' => [
                    'Configuration flexible : function creerProduit($nom, $prix, $options = []) options variables',
                    'Valeurs par défaut : function paginer($page = 1, $limit = 10) évite répétition valeurs communes',
                    'API publique : function rechercher($terme, $filtres = null, $tri = "pertinence") usage simple ou avancé',
                    'Builders : function genererHTML($contenu, $classe = "", $id = null) personnalisation progressive',
                    'Overloading simulé : valeurs défaut simulent plusieurs signatures fonction',
                    'Callbacks : function traiter($data, callable $transformer = null) transformation optionnelle'
                ],
                'warnings' => [
                    'Trop paramètres : > 5 paramètres signe design problématique, utiliser objet ou array',
                    'Ordre paramètres : obligatoires après optionnels génère erreur syntaxe',
                    'Valeurs mutables : $param = [] puis modifier impacte tous appels sans argument',
                    'Type hints stricts : declare(strict_types=1) + types empêche jonglage automatique'
                ],
                'bestPractices' => [
                    'Limiter nombre : max 3-4 paramètres, au-delà regrouper en objet/array',
                    'Nommage descriptif : $emailAddress pas $e, $isActive pas $flag',
                    'Optionnels sensés : valeurs défaut logiques, pas magic numbers arbitraires',
                    'Documentation : @param type $nom description pour chaque paramètre',
                    'Objets config : function creerUser(UserConfig $config) meilleur que 10 paramètres'
                ],
                'resources' => [
                    ['title' => 'Arguments fonctions', 'url' => 'https://www.php.net/manual/fr/functions.arguments.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-parametres_variables', 'label' => 'Arguments variables'],
                    ['id' => 'modal-types_parametres_php7', 'label' => 'Types de paramètres'],
                    ['id' => 'modal-named_arguments_php8', 'label' => 'Arguments nommés PHP 8']
                ]
            ],
            'parametres_variables' => [
                'description' => 'Fonctions avec nombre variable d\'arguments : func_get_args(), func_num_args() et syntaxe ... (splat operator).',
                'example' => '// Ancienne méthode\nfunction sommeAncienne() {\n    $args = func_get_args();\n    return array_sum($args);\n}\n\n// Méthode moderne (PHP 5.6+)\nfunction somme(...$nombres) {\n    return array_sum($nombres);\n}\n\necho somme(1, 2, 3, 4, 5); // 15',
                'details' => 'Les paramètres variables permettent fonctions acceptant nombre arguments indéterminé. Ancienne méthode : func_get_args() retourne array tous arguments, func_num_args() compte, func_get_arg(n) récupère spécifique. Moderne (PHP 5.6+) : syntaxe ... (splat/spread) collecte arguments restants : function nom(...$args). ... doit être dernier paramètre. Type hints possibles : function sum(int ...$nombres). Unpacking : passer array comme arguments individuels : fonction(...$array). Combinable avec paramètres normaux : function log($niveau, ...$messages). Performance : ... légèrement meilleur que func_get_args(). Lecture seule : modification $args n\'affecte pas arguments originaux.',
                'useCases' => [
                    'Fonctions mathématiques : function moyenne(...$valeurs) nombre arguments inconnu',
                    'Logging : function log($niveau, ...$messages) messages multiples flexibles',
                    'Builders : function construireURL($base, ...$segments) chemins dynamiques',
                    'Array helpers : function fusionner(...$arrays) merge nombre arrays variable',
                    'Validation : function validerChamps(...$champs) vérifie liste champs variable',
                    'SQL : function query($sql, ...$params) requêtes paramétrées flexible'
                ],
                'warnings' => [
                    'Type hints : int ...$args force tous arguments même type, vérifier besoin',
                    'Performance : unpacking gros arrays coûteux, considérer passer array direct',
                    'Lisibilité : si logic complexe, array nommé plus clair que ...$args',
                    'Ordre paramètres : ... toujours en dernier, pas après paramètres normaux'
                ],
                'bestPractices' => [
                    'Préférer ... à func_get_args() : plus moderne, lisible, performant',
                    'Typage : ajouter type hint si tous arguments même type attendu',
                    'Documentation : @param type ...$args description indique nombre variable',
                    'Validation : vérifier count($args) si minimum/maximum requis',
                    'Nommage : ...$items, ...$values descriptif pas juste ...$args générique'
                ],
                'resources' => [
                    ['title' => 'Arguments variables', 'url' => 'https://www.php.net/manual/fr/functions.arguments.php#functions.variable-arg-list', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-parametres_arguments', 'label' => 'Paramètres & Arguments'],
                    ['id' => 'modal-types_parametres_php7', 'label' => 'Types de paramètres'],
                    ['id' => 'modal-fonctions_callback', 'label' => 'Fonctions callback']
                ]
            ],
            'types_parametres_php7' => [
                'description' => 'Déclaration de types pour paramètres (PHP 7+) : scalaires, classes, interfaces, nullable avec ?.',
                'example' => 'function additionner(int $a, int $b): int {\n    return $a + $b;\n}\n\nfunction traiterUtilisateur(?User $user, string $action = "view"): bool {\n    if ($user === null) {\n        return false;\n    }\n    // Traitement...\n    return true;\n}',
                'details' => 'PHP 7 introduit type hints scalaires et retour. Types scalaires : int, float (alias double), string, bool. Types composés : array, callable (fonction), iterable (array|Traversable), object (toute classe). Classes/interfaces utilisables : function process(User $user). Nullable (PHP 7.1) : ?Type accepte null : function get(?int $id). Mode coercitif par défaut : convertit automatiquement types compatibles "123" devient int 123. Mode strict : declare(strict_types=1) en début fichier, force correspondance exacte, erreur TypeError sinon. Par fichier pas global. Void return type : function log(): void pas valeur retour. Self/parent/static utilisables en return type.',
                'useCases' => [
                    'APIs robustes : function creerUser(string $email, int $age): User contrat clair',
                    'Prévention erreurs : types empêchent passage données incorrectes compilation',
                    'Refactoring : types facilitent modifications, IDE détecte incompatibilités',
                    'Documentation vivante : signature révèle types sans lire PHPDoc',
                    'Performance : moteur optimise opérations types connus (JIT PHP 8)',
                    'Interopérabilité : bibliothèques modernes exigent types stricts'
                ],
                'warnings' => [
                    'strict_types portée fichier : chaque fichier doit déclarer, pas hérité includes',
                    'Coercion risquée : "abc" converti 0 en mode coercitif, erreurs silencieuses',
                    'Mixed legacy : mélanger code typé/non-typé complexifie maintenance',
                    'Performance minime : overhead validation type négligeable sauf boucles critiques'
                ],
                'bestPractices' => [
                    'Toujours declare(strict_types=1) : évite conversions surprises, bugs subtils',
                    'Typer tout nouveau code : paramètres ET retour, pas exceptions sauf mixed',
                    'Nullable explicite : ?Type clair sur acceptation null, pas mixed',
                    'Exceptions typées : function parse(): User throws ParseException documentation',
                    'Classes sur arrays : function get(): UserCollection meilleur que array'
                ],
                'resources' => [
                    ['title' => 'Type declarations PHP 7', 'url' => 'https://www.php.net/manual/fr/language.types.declarations.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-types_union_php8', 'label' => 'Types union PHP 8'],
                    ['id' => 'modal-valeurs_retour', 'label' => 'Valeurs de retour'],
                    ['id' => 'modal-parametres_arguments', 'label' => 'Paramètres & Arguments']
                ]
            ],
            'types_union_php8' => [
                'description' => 'Types union (PHP 8.0+) et types intersection pour paramètres et valeurs de retour plus flexibles.',
                'example' => '// Types union (PHP 8.0+)\nfunction traiter(string|int|float $valeur): string {\n    return (string) $valeur;\n}\n\n// Types intersection (PHP 8.1+)\nfunction processEntity(Countable&Traversable $data): void {\n    // $data doit implémenter les deux interfaces\n}\n\n// Mixed type\nfunction flexible(mixed $anything): mixed {\n    return $anything;\n}',
                'details' => 'PHP 8.0 ajoute types union : Type1|Type2|Type3 accepte plusieurs types. Remplace @param int|string PHPDoc par vraie vérification runtime. Combinable avec nullable : int|string|null ou ?int|string. Mixed type : accepte toute valeur (équivalent aucun type). False pseudo-type : bool|false distinction false spécifique. Static return : return static pour fluent interface chaînage. Never (PHP 8.1) : fonction termine jamais (exit/exception). Intersection types (8.1) : Type1&Type2 objet implémente TOUS types : Countable&Iterator. Ordre indifférent : int|string = string|int. Redondance interdite : int|int erreur. Null toujours explicite : mixed|null invalide (mixed inclut déjà).',
                'useCases' => [
                    'Polymorphisme : function getId(): int|string IDs entiers ou UUID strings',
                    'Input flexible : function parse(string|array $config) accepte formats multiples',
                    'Return précis : function find(): User|null indique absence possible vs false',
                    'Fluent interfaces : function setName(string $name): static chaînage méthodes',
                    'Helpers génériques : function first(array $items): mixed élément type inconnu',
                    'Contraintes fortes : function log(Stringable&JsonSerializable $obj) deux interfaces'
                ],
                'warnings' => [
                    'Union large : int|string|bool|array trop permissif, perd bénéfices types',
                    'Mixed équivalent no-type : éviter mixed sauf vraiment générique, perd sécurité',
                    'Never méconnu : utilisateurs débutants ignorent existence, documenter',
                    'Intersection rare : Type1&Type2 cas usage limité, peut indiquer design flou'
                ],
                'bestPractices' => [
                    'Union minimal : limiter à 2-3 types, au-delà revoir design',
                    'Null explicite : int|null plus clair que ?int|string ambiguïté',
                    'Static fluent : return static pas self pour héritage correct',
                    'Documentation : union complexes méritent @return commentaire exemples',
                    'Éviter mixed : utiliser union précis int|string|bool meilleur que mixed'
                ],
                'resources' => [
                    ['title' => 'Union types PHP 8', 'url' => 'https://www.php.net/manual/fr/language.types.declarations.php#language.types.declarations.union', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-types_parametres_php7', 'label' => 'Types paramètres PHP 7'],
                    ['id' => 'modal-valeurs_retour', 'label' => 'Valeurs de retour'],
                    ['id' => 'modal-attributes_php8', 'label' => 'Attributs PHP 8']
                ]
            ],
            'valeurs_retour' => [
                'description' => 'Gestion des valeurs de retour : return simple, multiple, types de retour déclarés, void.',
                'example' => 'function diviser(float $a, float $b): float {\n    if ($b === 0.0) {\n        throw new DivisionByZeroError("Division par zéro");\n    }\n    return $a / $b;\n}\n\nfunction logger(string $message): void {\n    file_put_contents("log.txt", $message . PHP_EOL, FILE_APPEND);\n    // Pas de return\n}',
                'details' => 'Return termine fonction et retourne valeur optionnelle. Sans return ou return; retourne null implicite. Types retour (PHP 7+) : : Type après parenthèses déclare type retourné. Void (PHP 7.1) : fonction sans valeur utile. Never (PHP 8.1) : fonction termine jamais normalement (exit, exception, boucle infinie). Multiple return possibles mais un seul exécuté. Return tableau pour valeurs multiples : return [$a, $b]. List() ou [] destructure : [$x, $y] = fonction(). Retour anticipé (early return) améliore lisibilité : vérifier conditions invalides début. Générateurs avec yield retournent Iterator pas valeur directe.',
                'useCases' => [
                    'Calculs : function calculer(): float retourne résultat opération',
                    'Recherche : function trouver(): ?User null si non trouvé, objet sinon',
                    'Actions : function sauvegarder(): bool succès/échec opération',
                    'Multiples valeurs : function getCoords(): array return [$lat, $lng]',
                    'Fluent : function setName(string $n): self return $this chaînage',
                    'Side-effects : function log(): void fonction sans résultat utile'
                ],
                'warnings' => [
                    'Return oublié : fonction avec type retour non-void doit toujours return valeur',
                    'Type incorrect : return "abc" dans function get(): int génère TypeError strict mode',
                    'Multiple returns : trop chemins return complexifie tests, limiter branches',
                    'Null implicite : fonction sans return retourne null, peut surprendre appelant'
                ],
                'bestPractices' => [
                    'Déclarer type : toujours spécifier : Type sauf void ou générateurs',
                    'Early return : vérifier erreurs début, éviter if/else profondément imbriqués',
                    'Null explicite : ?Type indique null possible, pas surprendre utilisateur',
                    'Une responsabilité : si return types différents selon branches, signe fonction fait trop',
                    'Documentation : @return complexe (unions, arrays) mérite commentaire structure'
                ],
                'resources' => [
                    ['title' => 'Return values', 'url' => 'https://www.php.net/manual/fr/functions.returning-values.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-types_parametres_php7', 'label' => 'Types paramètres PHP 7'],
                    ['id' => 'modal-types_union_php8', 'label' => 'Types union PHP 8'],
                    ['id' => 'modal-generateurs_yield', 'label' => 'Générateurs yield']
                ]
            ],
            'portee_variables' => [
                'description' => 'Portée des variables : locales, globales, static, closures et mot-clé use pour capturer des variables.',
                'example' => '$compteur = 0; // Variable globale\n\nfunction incrementer() {\n    global $compteur;\n    $compteur++;\n}\n\nfunction compteurStatique() {\n    static $compteur = 0;\n    return ++$compteur;\n}\n\necho compteurStatique(); // 1\necho compteurStatique(); // 2',
                'details' => 'Portée définit où variable accessible. Locale : créée dans fonction, meurt fin fonction. Globale : hors fonctions, accessible via global $var ou $GLOBALS[\'var\']. Static : variable locale persiste entre appels fonction : static $count = 0. Superglobales : $_GET, $_POST, $_SESSION accessibles partout sans global. Closures : fonctions anonymes, accès variables externes via use ($var). Use par valeur copie, use (&$var) par référence modifie originale. Paramètres toujours locaux. Variables static initialisées une seule fois, première exécution. Global déconseillé POO, préférer injection dépendances.',
                'useCases' => [
                    'Compteurs : static $count fonction garde état entre appels',
                    'Cache : static $cache = [] mémoïsation résultats coûteux',
                    'Closures : use ($config) accès configuration depuis callback',
                    'Singletons : static $instance = null pattern singleton simple',
                    'Accumulateurs : static $total suivi cumul sans variable globale',
                    'Tests : global pour accès fixtures, mieux dependency injection'
                ],
                'warnings' => [
                    'Global couplage : dépendances cachées, tests difficiles, éviter en production',
                    'Static mutations : variables static = état global, threading problèmes',
                    'Use par valeur : modification $var closure pas impact externe, référence &$var si besoin',
                    'Superglobales injection : $_GET/$_POST risques sécurité, valider/assainir'
                ],
                'bestPractices' => [
                    'Éviter global : passer paramètres ou injecter dépendances, testable et clair',
                    'Static parcimonieux : seulement vrais cas usage (cache, compteurs), pas état complexe',
                    'Use explicite : closures déclarent dépendances externes visibles signature',
                    'Immutabilité : préférer use ($var) copie que use (&$var) référence mutable',
                    'Injection : function process(Config $config) meilleur que global $config'
                ],
                'resources' => [
                    ['title' => 'Variable scope', 'url' => 'https://www.php.net/manual/fr/language.variables.scope.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-fonctions_anonymes', 'label' => 'Fonctions anonymes'],
                    ['id' => 'modal-declaration_fonctions', 'label' => 'Déclaration fonctions'],
                    ['id' => 'modal-fonctions_callback', 'label' => 'Fonctions callback']
                ]
            ],
            'fonctions_anonymes' => [
                'description' => 'Fonctions anonymes (closures) avec use pour capturer des variables de portée externe.',
                'example' => '$multiplicateur = 3;\n\n$multiplier = function($nombre) use ($multiplicateur) {\n    return $nombre * $multiplicateur;\n};\n\necho $multiplier(5); // 15\n\n// Capture par référence\n$compteur = 0;\n$incrementer = function() use (&$compteur) {\n    $compteur++;\n};\n\n$incrementer();\necho $compteur; // 1',
                'details' => 'Fonctions anonymes (closures) sont fonctions sans nom, stockées variables. Syntaxe : $var = function($param) { code }. Appel : $var($arg). Use capture variables externes : function() use ($x, $y). Capture par valeur (copie) défaut, par référence avec & : use (&$count). Closures = objets Closure, passables callbacks. Bindage : $closure->bindTo($objet) change $this. Static : static function() empêche bindage $this. Types paramètres/retour supportés. Callable type hint accepte closures. Alternative PHP 7.4+ : fonctions fléchées fn() plus concises.',
                'useCases' => [
                    'Callbacks : array_map(function($x) { return $x * 2; }, $array) transformations',
                    'Event handlers : $emitter->on("save", function($data) use ($logger) {...})',
                    'Factory patterns : function creerValidator($rules) { return function($data) use ($rules) {...} }',
                    'Scope isolation : (function() { $temp = ...; })() évite pollution globale',
                    'Lazy evaluation : $compute = function() { return expensiveOp(); } différé',
                    'Middleware : array_reduce($middlewares, fn($carry, $mw) => $mw($carry), $request)'
                ],
                'warnings' => [
                    'Use par valeur : modification variable use pas visible externe, & si besoin',
                    'Capture implicite : oubli use génère undefined variable, contrairement arrow functions',
                    'Memory : closures gardent références variables capturées, leaks possibles',
                    'Performance : création closure coûteuse boucle serrée, définir dehors si possible'
                ],
                'bestPractices' => [
                    'Use minimal : capturer seulement variables nécessaires, pas contexte entier',
                    'Typage : ajouter type hints paramètres/retour comme fonctions normales',
                    'Arrow functions : préférer fn() PHP 7.4+ si une seule expression',
                    'Nommage : stocker closures complexes variables nommées descriptives',
                    'Immutabilité : préférer use ($var) copie que use (&$var) mutations'
                ],
                'resources' => [
                    ['title' => 'Anonymous functions', 'url' => 'https://www.php.net/manual/fr/functions.anonymous.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-fonctions_flechees_php74', 'label' => 'Fonctions fléchées PHP 7.4'],
                    ['id' => 'modal-portee_variables', 'label' => 'Portée variables'],
                    ['id' => 'modal-fonctions_callback', 'label' => 'Fonctions callback']
                ]
            ],
            'fonctions_flechees_php74' => [
                'description' => 'Fonctions fléchées (PHP 7.4+) : syntaxe courte avec fn, capture automatique des variables, une seule expression.',
                'example' => '$nombres = [1, 2, 3, 4, 5];\n$multiplicateur = 2;\n\n// Fonction fléchée (PHP 7.4+)\n$doubles = array_map(fn($n) => $n * $multiplicateur, $nombres);\n\n// Équivalent avec fonction anonyme\n$doubles2 = array_map(function($n) use ($multiplicateur) {\n    return $n * $multiplicateur;\n}, $nombres);',
                'details' => 'Fonctions fléchées (arrow functions) PHP 7.4+ syntaxe concise : fn($param) => expression. Une seule expression retournée implicitement, pas accolades ni return. Capture automatique variables scope parent par valeur, pas use nécessaire. Pas capture référence possible. Types paramètres/retour supportés : fn(int $x): int => $x * 2. Callable comme closures classiques. Idéales callbacks simples : array_map, array_filter. Multi-lignes impossible, utiliser function() classique. $this accessible méthodes classes. Static keyword supporté : static fn() empêche bind $this.',
                'useCases' => [
                    'Array operations : array_map(fn($x) => $x * 2, $data) transformations simples',
                    'Filtering : array_filter($users, fn($u) => $u->age >= 18) prédicats courts',
                    'Sorting : usort($items, fn($a, $b) => $a->price <=> $b->price) comparateurs',
                    'Optionals : $result ?? fn() => defaultValue() valeurs défaut calculées',
                    'Pipelines : array_reduce($fns, fn($v, $f) => $f($v), $input) compositions',
                    'Event mapping : array_map(fn($e) => new DTO($e), $events) conversions'
                ],
                'warnings' => [
                    'Une expression : pas if/else multi-lignes, utiliser ternaire ou function() classique',
                    'Capture valeur : variables capturées par valeur, modifications pas visibles externe',
                    'Debuggage : pas nom fonction stack traces, difficile identifier erreurs',
                    'Compatibilité : PHP 7.4+ requis, vérifier version déploiement'
                ],
                'bestPractices' => [
                    'Callbacks simples : préférer fn() à function() use si une seule expression',
                    'Lisibilité : si expression longue/complexe, function() classique plus claire',
                    'Typage : ajouter types même syntaxe courte : fn(int $x): int améliore contrat',
                    'Composition : chaîner fn() pipelines fonctionnelles élégantes',
                    'Performance : fn() légèrement plus performant que function() use overhead réduit'
                ],
                'resources' => [
                    ['title' => 'Arrow functions PHP 7.4', 'url' => 'https://www.php.net/manual/fr/functions.arrow.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-fonctions_anonymes', 'label' => 'Fonctions anonymes'],
                    ['id' => 'modal-fonctions_callback', 'label' => 'Fonctions callback'],
                    ['id' => 'modal-portee_variables', 'label' => 'Portée variables']
                ]
            ],
            'fonctions_callback' => [
                'description' => 'Utilisation de fonctions comme callbacks : callable, array_map, array_filter, usort avec fonctions personnalisées.',
                'example' => '$personnes = [\n    ["nom" => "Alice", "age" => 30],\n    ["nom" => "Bob", "age" => 25],\n    ["nom" => "Charlie", "age" => 35]\n];\n\n// Trier par âge\nusort($personnes, fn($a, $b) => $a["age"] <=> $b["age"]);\n\n// Filtrer les majeurs\n$majeurs = array_filter($personnes, fn($p) => $p["age"] >= 18);',
                'details' => 'Callback = fonction passée argument autre fonction. Type hint callable accepte : string nom fonction "strlen", array [$obj, "methode"] ou ["Classe", "statique"], Closure, objets __invoke(). Fonctions natives : array_map(callable, array), array_filter(array, callable), usort(array, callable), array_reduce. Validation : is_callable($var) vérifie validité. call_user_func($callback, ...$args) invoque. PHP 8.1 : first-class callable syntax fonction(...) obtient référence. Callbacks permettent injection comportement, inversion contrôle, programmation fonctionnelle.',
                'useCases' => [
                    'Transformations : array_map(fn($x) => strtoupper($x), $names) modifier éléments',
                    'Filtrage : array_filter($data, fn($item) => $item->isValid()) sélection',
                    'Tri personnalisé : usort($products, fn($a, $b) => $a->price <=> $b->price)',
                    'Event handlers : $dispatcher->on("user.created", $sendEmailCallback)',
                    'Middleware : $pipeline->pipe($authenticateCallback)->pipe($logCallback)',
                    'Strategy pattern : $processor->setValidator($customValidatorCallback) injection'
                ],
                'warnings' => [
                    'Performance : callbacks boucles serrées overhead appels, inline si critique',
                    'Debuggage : stack traces complexes callbacks anonymes, nommer si possible',
                    'Sécurité : call_user_func avec input utilisateur = risque exécution arbitraire',
                    'Type safety : callable accepte tout, vérifier signature attendue documentation'
                ],
                'bestPractices' => [
                    'Type hint callable : function process(callable $transformer) contrat explicite',
                    'Nommer callbacks : $validateEmail = fn($e) => filter_var($e, FILTER_VALIDATE_EMAIL)',
                    'Composition : chaîner callbacks array_reduce pipelines fonctionnelles',
                    'Validation : is_callable() avant call_user_func évite erreurs runtime',
                    'First-class PHP 8.1 : $cb = strlen(...) plus élégant que "strlen"'
                ],
                'resources' => [
                    ['title' => 'Callbacks / Callables', 'url' => 'https://www.php.net/manual/fr/language.types.callable.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-fonctions_anonymes', 'label' => 'Fonctions anonymes'],
                    ['id' => 'modal-fonctions_flechees_php74', 'label' => 'Fonctions fléchées'],
                    ['id' => 'modal-first_class_callable_php81', 'label' => 'First-class callable PHP 8.1']
                ]
            ],
            'generateurs_yield' => [
                'description' => 'Générateurs avec yield : fonctions qui retournent un Iterator, économie mémoire, yield from (PHP 7.0+).',
                'example' => 'function compterJusque($max) {\n    for ($i = 1; $i <= $max; $i++) {\n        yield $i;\n    }\n}\n\nfunction fibonacci($n) {\n    $a = 0; $b = 1;\n    for ($i = 0; $i < $n; $i++) {\n        yield $a;\n        [$a, $b] = [$b, $a + $b];\n    }\n}\n\n// yield from (PHP 7.0+)\nfunction compterEtDoubler($max) {\n    yield from compterJusque($max);\n    yield from array_map(fn($x) => $x * 2, range(1, $max));\n}',
                'details' => 'Générateurs produisent valeurs à la demande via yield, pas return. Retournent Generator implémente Iterator. Exécution pause à yield, reprend foreach ou ->next(). Économie mémoire énorme : génère valeurs une par une pas array complet. Yield $valeur ou yield $cle => $valeur. Send($valeur) envoie données dans générateur. Yield from (PHP 7.0+) délègue autre générateur/iterable. Return dans générateur = valeur finale via ->getReturn(). État conservé entre yields. Lazy evaluation : calcul différé jusqu\'à besoin. Infini possible : while(true) yield.',
                'useCases' => [
                    'Gros fichiers : function lireLignes($file) { yield fgets($handle); } ligne par ligne',
                    'Séquences infinies : function nombres() { $i=0; while(true) yield $i++; }',
                    'Pagination : function fetchPage($page) { yield from apiCall($page); } pages API',
                    'Stream processing : yield chaque élément traité pas accumuler tout',
                    'Range custom : function range($start, $end, $step) { yield ... } flexible',
                    'Arbres : function traverser($node) { yield $node; yield from $node->children; }'
                ],
                'warnings' => [
                    'Reset impossible : Generator pas rewindable, relancer fonction si retry nécessaire',
                    'État fragile : send() mutations complexes, préférer yield simples',
                    'Performance : overhead iteration, pas toujours meilleur que array petites données',
                    'Debuggage : exécution différée complique breakpoints, valeurs inconnues avant yield'
                ],
                'bestPractices' => [
                    'Gros datasets : toujours yield fichiers/requêtes volumineuses éviter OOM',
                    'Type hints : function gen(): Generator indique retour générateur',
                    'Yield from : déléguer sous-générateurs évite boucles manuelles',
                    'Documentation : @return Generator<int, User> précise types clé/valeur',
                    'Cleanup : try/finally dans générateurs assure fermeture ressources'
                ],
                'resources' => [
                    ['title' => 'Generators', 'url' => 'https://www.php.net/manual/fr/language.generators.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-valeurs_retour', 'label' => 'Valeurs de retour'],
                    ['id' => 'modal-fonctions_anonymes', 'label' => 'Fonctions anonymes'],
                    ['id' => 'modal-recursivite', 'label' => 'Récursivité']
                ]
            ],
            'recursivite' => [
                'description' => 'Fonctions récursives : appel de la fonction par elle-même, cas de base, optimisation tail recursion.',
                'example' => 'function factorielle($n) {\n    if ($n <= 1) {\n        return 1; // Cas de base\n    }\n    return $n * factorielle($n - 1);\n}\n\nfunction fibonacciRec($n) {\n    if ($n <= 1) return $n;\n    return fibonacciRec($n - 1) + fibonacciRec($n - 2);\n}\n\necho factorielle(5); // 120',
                'details' => 'Récursivité : fonction s\'appelle elle-même. Nécessite cas de base (condition arrêt) sinon boucle infinie. Cas récursif décompose problème sous-problèmes plus petits. Stack overflow si récursion trop profonde (limite ~100-1000 appels PHP). Tail recursion : appel récursif dernière opération, PHP optimise pas (contrairement autres langages). Alternative itérative souvent plus performante PHP. Mémoïsation améliore performance : cache résultats évite recalculs. Récursion mutuelle : fonction A appelle B qui appelle A.',
                'useCases' => [
                    'Structures arborescentes : parcourir DOM, JSON, systèmes fichiers récursivement',
                    'Algorithmes divide-and-conquer : quicksort, mergesort décomposition récursive',
                    'Mathématiques : factorielle, fibonacci, calculs combinatoires naturellement récursifs',
                    'Backtracking : recherche chemins, permutations, sudoku solver',
                    'Parser : analyseurs syntaxiques expressions imbriquées',
                    'Graphes : parcours profondeur DFS (depth-first search) récursif'
                ],
                'warnings' => [
                    'Stack overflow : récursion profonde épuise mémoire, préférer itératif si > 100 niveaux',
                    'Performance : appels fonction coûteux PHP, boucles itératives souvent meilleures',
                    'Fibonacci naïf : complexité exponentielle sans mémoïsation, éviter',
                    'Debuggage : stack traces longs récursion, difficile suivre état'
                ],
                'bestPractices' => [
                    'Toujours cas base : vérifier condition arrêt claire sinon infinite loop',
                    'Limite profondeur : if ($depth > 100) throw exception protection stack overflow',
                    'Mémoïsation : static $cache = [] stocker résultats sous-problèmes répétés',
                    'Itératif préférable : si facile convertir boucle, meilleure performance PHP',
                    'Tests unitaires : cas base, cas récursif, limites tester exhaustivement'
                ],
                'resources' => [
                    ['title' => 'Recursion concept', 'url' => 'https://en.wikipedia.org/wiki/Recursion_(computer_science)', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-declaration_fonctions', 'label' => 'Déclaration fonctions'],
                    ['id' => 'modal-valeurs_retour', 'label' => 'Valeurs de retour'],
                    ['id' => 'modal-generateurs_yield', 'label' => 'Générateurs yield']
                ]
            ],
            'fonctions_variables' => [
                'description' => 'Fonctions variables : appeler une fonction via une variable contenant son nom, vérification avec is_callable().',
                'example' => 'function saluer($nom) {\n    return "Bonjour " . $nom;\n}\n\n$fonction = "saluer";\nif (is_callable($fonction)) {\n    echo $fonction("Marie"); // "Bonjour Marie"\n}\n\n// Avec méthodes\n$obj = new DateTime();\n$methode = "format";\necho $obj->$methode("Y-m-d");',
                'details' => 'Fonction variable : stocker nom fonction string variable puis appeler : $var = "strlen"; $var("test"). Syntaxe : $fonctionVariable(...$args). Méthodes : $obj->$methodeVariable(). Statiques : Classe::$methodeVariable() ou $classe::methode(). Namespaces : $func = "\\Namespace\\fonction". Validation cruciale : is_callable($var) avant appel évite erreurs. Callable accepte : string nom, array [$obj, "methode"], Closure. Variable variables : $$var attention confusion. Use case : dispatch dynamique, routing, commande pattern.',
                'useCases' => [
                    'Routing : $action = $_GET["action"]; if(is_callable($action)) $action() dispatch',
                    'Command pattern : $commands[$name]() exécuter commandes enregistrées',
                    'Factory : $type = "create" . $entity; $factory->$type() méthodes dynamiques',
                    'Helpers : $formatter = "format" . $type; $formatter($data) dispatch formatters',
                    'Testing : $method = "test" . $name; $this->$method() tests dynamiques',
                    'Plugins : $hook = $pluginPrefix . $action; $hook() système hooks extensible'
                ],
                'warnings' => [
                    'Sécurité critique : jamais input utilisateur direct sans whitelist, RCE possible',
                    'Typage perdu : IDE/PHPStan détectent pas appels dynamiques, erreurs runtime',
                    'Debuggage dur : stack traces peu clairs, difficile tracer origine appels',
                    'Performance : appels dynamiques légèrement plus lents que statiques'
                ],
                'bestPractices' => [
                    'Whitelist stricte : $allowed = ["action1", "action2"]; if(in_array($func, $allowed))',
                    'Toujours is_callable : vérifier avant appel évite erreurs fatales',
                    'Documentation : @var callable $function commenter type attendu',
                    'Alternatives : match/switch souvent plus clair que dispatch dynamique',
                    'Éviter si possible : appels statiques $obj->methode() plus sûrs, maintenables'
                ],
                'resources' => [
                    ['title' => 'Variable functions', 'url' => 'https://www.php.net/manual/fr/functions.variable-functions.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-fonctions_callback', 'label' => 'Fonctions callback'],
                    ['id' => 'modal-fonctions_anonymes', 'label' => 'Fonctions anonymes'],
                    ['id' => 'modal-declaration_fonctions', 'label' => 'Déclaration fonctions']
                ]
            ],
            'attributes_php8' => [
                'description' => 'Attributs PHP 8.0+ : métadonnées pour fonctions, classes et propriétés avec la syntaxe #[Attribute].',
                'example' => '#[Attribute]\nclass Deprecated {\n    public function __construct(public string $message = "") {}\n}\n\n#[Deprecated("Utilisez nouvelleMethode() à la place")]\nfunction ancienneMethode() {\n    // Code déprécié\n}\n\n// Lecture des attributs\n$reflection = new ReflectionFunction("ancienneMethode");\n$attributes = $reflection->getAttributes(Deprecated::class);',
                'details' => 'Attributs PHP 8 remplacent annotations PHPDoc par métadonnées structurées. Syntaxe : #[AttributeName] ou #[AttributeName($arg1, $arg2)]. Applicables : classes, méthodes, fonctions, propriétés, paramètres, constantes. Créer attribut : class avec #[Attribute] et constantes TARGET_CLASS, TARGET_METHOD, etc. Lecture : Reflection API ->getAttributes(). Multiples : #[Attr1] #[Attr2] ou #[Attr1, Attr2]. Arguments nommés supportés. Pas exécution automatique : framework/lib lit et agit. Use cases : routing, validation, serialization, caching, ORM.',
                'useCases' => [
                    'Routing : #[Route("/users", methods: ["GET"])] définir routes controllers',
                    'Validation : #[Assert\\NotBlank] #[Assert\\Email] règles propriétés',
                    'Serialization : #[SerializedName("user_name")] mapping JSON/DTO',
                    'ORM : #[Entity] #[Column(type: "string")] mapping base données',
                    'Cache : #[Cacheable(ttl: 3600)] marquer méthodes cachables',
                    'Security : #[IsGranted("ROLE_ADMIN")] contrôle accès déclaratif'
                ],
                'warnings' => [
                    'PHP 8.0+ requis : vérifier compatibilité projet avant utiliser',
                    'Runtime overhead : lecture Reflection coûteuse, cacher métadonnées',
                    'Pas magique : attributs ne font rien seuls, framework doit interpréter',
                    'BC breaks : migration annotations @Doctrine vers attributs nécessite refactoring'
                ],
                'bestPractices' => [
                    'Target spécifique : #[Attribute(Attribute::TARGET_METHOD)] restreindre usage',
                    'Repeatable : Attribute::IS_REPEATABLE autoriser multiples mêmes attributs',
                    'Typage arguments : constructeur attribut avec types stricts validation',
                    'Cache metadata : ReflectionClass->getAttributes() stocker évite répéter',
                    'Documentation : attributs remplacent @annotations mais commenter complexes'
                ],
                'resources' => [
                    ['title' => 'Attributes PHP 8', 'url' => 'https://www.php.net/manual/fr/language.attributes.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-types_union_php8', 'label' => 'Types union PHP 8'],
                    ['id' => 'modal-named_arguments_php8', 'label' => 'Arguments nommés PHP 8'],
                    ['id' => 'modal-declaration_fonctions', 'label' => 'Déclaration fonctions']
                ]
            ],
            'named_arguments_php8' => [
                'description' => 'Arguments nommés (PHP 8.0+) : passer des arguments par nom plutôt que par position, améliore la lisibilité.',
                'example' => 'function creerUtilisateur($nom, $age, $email, $actif = true) {\n    return compact("nom", "age", "email", "actif");\n}\n\n// Arguments positionnels classiques\n$user1 = creerUtilisateur("John", 25, "john@example.com");\n\n// Arguments nommés (PHP 8.0+)\n$user2 = creerUtilisateur(\n    nom: "Marie",\n    email: "marie@example.com", \n    age: 30,\n    actif: false\n);',
                'details' => 'Arguments nommés PHP 8 : passer arguments via nom paramètre : param: valeur. Ordre indifférent : age: 30, nom: "Test" valide. Mixable avec positionnels : func($pos1, $pos2, named: $val) positionnels AVANT nommés. Skip optionnels : passer seulement arguments nécessaires. Clarté : func(enabled: true, timeout: 30) vs func(true, 30) auto-documenté. Unpacking : ...$array décompresse arguments nommés si clés = noms paramètres. Incompatible func_get_args() ordre. BC safe : appels positionnels fonctionnent toujours.',
                'useCases' => [
                    'Paramètres optionnels : setOptions(cache: true, timeout: 30) skip inutiles',
                    'Lisibilité : createUser(name: $name, email: $email, active: true) auto-doc',
                    'Refactoring : ajouter paramètre milieu sans casser appels existants',
                    'Config : buildQuery(select: ["*"], where: $cond, limit: 10) type config',
                    'Boolean flags : process(async: true, validate: false) clair vs true, false',
                    'Overloading : simuler surcharge fonction via arguments optionnels nommés'
                ],
                'warnings' => [
                    'Ordre positionnels : nommés APRÈS positionnels, sinon erreur syntaxe',
                    'Renommage params : changer nom paramètre = breaking change appels nommés',
                    'Variadic : ...$args perd noms clés numériques, utiliser array si besoin',
                    'Performance minime : overhead résolution noms négligeable sauf micro-benchmarks'
                ],
                'bestPractices' => [
                    'Flags booléens : toujours nommer enabled: true vs position ambiguë',
                    'Paramètres multiples : > 3 params utiliser nommés améliore lisibilité',
                    'APIs publiques : considérer noms params stable API, documenter si changement',
                    'Mix judicieux : positionnels obligatoires, nommés optionnels équilibre lisibilité',
                    'Unpacking : array_merge(...$arrays) équivalent splatting positionnel'
                ],
                'resources' => [
                    ['title' => 'Named arguments PHP 8', 'url' => 'https://www.php.net/manual/fr/functions.arguments.php#functions.named-arguments', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-parametres_arguments', 'label' => 'Paramètres & Arguments'],
                    ['id' => 'modal-types_union_php8', 'label' => 'Types union PHP 8'],
                    ['id' => 'modal-attributes_php8', 'label' => 'Attributs PHP 8']
                ]
            ],
            'first_class_callable_php81' => [
                'description' => 'First-class callable syntax (PHP 8.1+) : obtenir une référence callable avec la syntaxe ... plus élégante.',
                'example' => 'function multiplier($a, $b) {\n    return $a * $b;\n}\n\nclass Calculator {\n    public function add($a, $b) {\n        return $a + $b;\n    }\n}\n\n// PHP 8.1+ First-class callable\n$fn = multiplier(...);\n$result = $fn(3, 4); // 12\n\n$calc = new Calculator();\n$addFn = $calc->add(...);\n$sum = $addFn(5, 3); // 8',
                'details' => 'First-class callable syntax PHP 8.1 : obtenir Closure depuis callable via .... Syntaxe : fonction(...), $obj->methode(...), Classe::statique(...). Remplace ["Classe", "methode"] et Closure::fromCallable() verbeux. Résultat = Closure réutilisable, passable callbacks. Scope binding : méthodes gardent $this lié objet. Statiques : Classe::methode(...) valide. Fonctions : strlen(...) équivalent "strlen" mais typé. Performance identique approches anciennes. Lisibilité : array_map($obj->format(...), $data) vs array_map([$obj, "format"], $data).',
                'useCases' => [
                    'Callbacks : array_map(strtoupper(...), $items) référence fonction élégante',
                    'Méthodes : $users->map($user->getName(...)) extraire données objets',
                    'Partiel application : $add5 = fn($x) => add($x, 5) currying manuel',
                    'Event handlers : $emitter->on("save", $logger->log(...)) méthodes callbacks',
                    'Composition : $pipeline = [$validate(...), $transform(...), $save(...)]',
                    'Dependency injection : $container->set("formatter", $formatter->format(...))'
                ],
                'warnings' => [
                    'PHP 8.1+ requis : syntaxe invalide versions antérieures, vérifier min version',
                    'Closure binding : méthodes privées via ... gardent accès private, attention encapsulation',
                    'Performance identique : pas optimisation vs anciennes méthodes, juste syntaxe',
                    'Confusion variadic : ne PAS confondre fonction(...) callable avec ...$args spread'
                ],
                'bestPractices' => [
                    'Préférer ... : remplacer ["class", "method"] par Classe::method(...) moderne',
                    'Type hints : Closure retourné typé, IDE autocomplétion meilleure',
                    'Lisibilité : $callable = $obj->process(...); array_map($callable, $data) nommer',
                    'Composition : chaîner callables $pipeline->pipe($step1(...))->pipe($step2(...))',
                    'Migration : refactor anciens array callables progressivement vers ...'
                ],
                'resources' => [
                    ['title' => 'First-class callable PHP 8.1', 'url' => 'https://www.php.net/manual/fr/functions.first_class_callable_syntax.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-fonctions_callback', 'label' => 'Fonctions callback'],
                    ['id' => 'modal-fonctions_anonymes', 'label' => 'Fonctions anonymes'],
                    ['id' => 'modal-fonctions_variables', 'label' => 'Fonctions variables']
                ]
            ],
            'comparaison_php_javascript' => [
                'description' => 'Comparaison des fonctions PHP vs JavaScript : points communs, différences clés, syntaxes et fonctionnalités spécifiques.',
                'example' => '// PHP\nfunction calculer($a, $b) {\n    return $a + $b;\n}\n$fn = fn($x) => $x * 2;\n\n// JavaScript\nfunction calculer(a, b) {\n    return a + b;\n}\nconst fn = x => x * 2;\n\n// Closures\n// PHP: use keyword\n$multiplier = function($x) use ($factor) { return $x * $factor; };\n// JS: automatic capture\nconst multiplier = (x) => x * factor;',
                'details' => 'PHP et JavaScript partagent beaucoup de concepts pour les fonctions. Mais ils ont aussi des différences importantes.

**Ce qui est pareil :**
Une fonction c\'est un bloc de code qu\'on peut réutiliser. Dans les deux langages on peut : donner des paramètres à la fonction, retourner un résultat avec return, créer des fonctions anonymes (sans nom), et utiliser des fonctions fléchées courtes.

**Les différences de base :**
En PHP, on écrit toujours $ devant les variables ($nom, $age). En JavaScript, pas besoin de $. En PHP, on met TOUJOURS un point-virgule ; à la fin des lignes. En JavaScript, c\'est optionnel. En PHP, le mot "function" est obligatoire pour déclarer une fonction. En JavaScript, on peut aussi écrire "const maFonction = ..." pour créer une fonction.

**Le typage (définir le type des données) :**
PHP permet de dire "ce paramètre doit être un nombre" ou "cette fonction retourne du texte". Exemple : function calculer(int $nombre): string. JavaScript de base ne le fait pas (mais TypeScript ajoute cette possibilité).

**Les closures (fonctions qui utilisent des variables extérieures) :**
En PHP, il faut explicitement dire quelles variables on veut utiliser avec le mot "use". Exemple : function() use ($x). En JavaScript, c\'est automatique, la fonction peut directement utiliser les variables autour d\'elle.

**L\'ordre de déclaration :**
En PHP, vous devez déclarer une fonction avant de l\'appeler (sauf les fonctions normales). En JavaScript, les fonctions déclarées avec "function" peuvent être utilisées avant leur déclaration (ça s\'appelle le "hoisting").

**Le mot $this :**
En PHP, $this représente toujours l\'objet actuel dans une classe. En JavaScript, "this" change selon comment la fonction est appelée, ce qui peut créer des bugs si on ne fait pas attention.

**La programmation asynchrone :**
JavaScript peut naturellement gérer plusieurs tâches en même temps avec async/await. PHP est synchrone par défaut (il fait une chose à la fois), il faut des bibliothèques spéciales pour faire de l\'asynchrone.',
                'useCases' => [
                    'Migration code : comprendre équivalences PHP ↔ JS pour full-stack development',
                    'APIs : harmoniser logique métier backend PHP et validation frontend JavaScript',
                    'Closures : use($var) PHP = capture auto JS, adapter patterns fonctionnels',
                    'Callbacks : array_map PHP = Array.map JS, syntaxes différentes logique identique',
                    'Arrow functions : fn() PHP 7.4 inspiré => JS, moderniser code',
                    'Typage : strict_types PHP vs TypeScript JS, stratégies validation données'
                ],
                'warnings' => [
                    'This binding : comportement radicalement différent, source bugs cross-language',
                    'Hoisting : JS hoist functions, PHP non, ordre déclarations important PHP',
                    'Typage faible : PHP et JS jonglage types, strict_types PHP vs TypeScript recommandés',
                    'Async : PHP synchrone par défaut, JS asynchrone, architectures incompatibles directes'
                ],
                'bestPractices' => [
                    'Documentation : commenter différences implémentation PHP/JS même logique métier',
                    'Conventions : unifier nommage fonctions côté serveur/client (camelCase ou snake_case)',
                    'Validation : doubler validation côté serveur PHP ET client JS, jamais confiance unique',
                    'Types : utiliser strict_types PHP + TypeScript JS environnements professionnels',
                    'Patterns : adapter design patterns (Strategy, Observer) idiomes chaque langage'
                ],
                'resources' => [
                    ['title' => 'PHP Functions', 'url' => 'https://www.php.net/manual/fr/language.functions.php', 'icon' => '📖'],
                    ['title' => 'MDN JavaScript Functions', 'url' => 'https://developer.mozilla.org/fr/docs/Web/JavaScript/Guide/Functions', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-fonctions_anonymes', 'label' => 'Fonctions anonymes'],
                    ['id' => 'modal-fonctions_flechees_php74', 'label' => 'Fonctions fléchées PHP 7.4'],
                    ['id' => 'modal-fonctions_callback', 'label' => 'Fonctions callback']
                ]
            ],
        ];
        return $this->render('fonction_php/index.html.twig', [
            'data' => $dataFonctionsPHP,
        ]);
    }
}
