<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TypagesController extends AbstractController
{
    #[Route('/typages', name: 'app_typages')]
    public function index(): Response
    {

        // Données complètes sur les types de données PHP : types primitifs, types composés, types spéciaux, conversion de types, vérification de types et bonnes pratiques
        $dataTypesPHP = [
            'types_primitifs_scalaires' => [
                'description' => 'Types de base qui contiennent une seule valeur : integer, float, string, boolean.',
                'example' => '$entier = 42;\n$decimal = 3.14;\n$texte = "Hello";\n$booleen = true;',
                'details' => 'Les types scalaires sont les types de données les plus simples en PHP. Ils contiennent une seule valeur à la fois (contrairement aux arrays ou objets qui en contiennent plusieurs). PHP est faiblement typé, donc une variable peut changer de type durant son existence.',
                'useCases' => [
                    'Integer : compteurs, identifiants, âges',
                    'Float : prix, mesures scientifiques, calculs précis',
                    'String : noms, descriptions, textes',
                    'Boolean : flags, conditions, états on/off'
                ],
                'warnings' => [
                    'Les floats peuvent avoir des problèmes de précision',
                    'Comparaison de floats : utiliser epsilon au lieu de ==',
                    'Integer overflow : au-delà de PHP_INT_MAX devient float',
                    'Boolean : plusieurs valeurs sont considérées comme false (0, "", null, [])'
                ],
                'bestPractices' => [
                    'Utiliser les type hints en PHP 7+ : function add(int $a, int $b)',
                    'Activer strict_types pour éviter les conversions automatiques',
                    'Documenter le type attendu avec PHPDoc : /** @var int $count */',
                    'Utiliser is_int(), is_float(), is_string(), is_bool() pour vérifier'
                ],
                'resources' => [
                    ['title' => 'PHP Types', 'url' => 'https://www.php.net/manual/fr/language.types.php', 'icon' => '📖'],
                    ['title' => 'Type Declarations', 'url' => 'https://www.php.net/manual/fr/language.types.declarations.php', 'icon' => '🔧']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-type_integer', 'label' => 'Integer'],
                    ['id' => 'modal-type_float', 'label' => 'Float'],
                    ['id' => 'modal-type_string', 'label' => 'String'],
                    ['id' => 'modal-type_boolean', 'label' => 'Boolean']
                ]
            ],
            'type_integer' => [
                'description' => 'Nombres entiers positifs ou négatifs. Peut être décimal, hexadécimal, octal ou binaire.',
                'example' => '$decimal = 123;\n$hexa = 0x7B; // 123 en hexa\n$octal = 0173; // 123 en octal\n$binaire = 0b1111011; // 123 en binaire',
                'details' => 'Les integers sont des nombres entiers sans décimale. Taille dépend de la plateforme (32 ou 64 bits). Sur 64 bits, range de -9223372036854775808 à 9223372036854775807. Peut être exprimé en décimal, hexadécimal (0x), octal (0) ou binaire (0b).',
                'useCases' => [
                    'Compteurs et incréments : $count++',
                    'Identifiants : $userId = 12345',
                    'Index de tableaux : $array[0]',
                    'Calculs mathématiques entiers'
                ],
                'warnings' => [
                    'Overflow : dépasser PHP_INT_MAX convertit en float',
                    'Division par zéro : génère une erreur',
                    'Cast depuis string : (int)"123abc" donne 123',
                    'Notation octale : 010 = 8 en décimal (piège !)'
                ],
                'bestPractices' => [
                    'Utiliser PHP_INT_MAX pour connaître la limite',
                    'Type hint : function process(int $id)',
                    'Vérification : is_int($value)',
                    'Conversion sûre : filter_var($value, FILTER_VALIDATE_INT)'
                ],
                'resources' => [
                    ['title' => 'PHP Integers', 'url' => 'https://www.php.net/manual/fr/language.types.integer.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-type_float', 'label' => 'Float'],
                    ['id' => 'modal-conversion_types', 'label' => 'Conversion de types']
                ]
            ],
            'type_float' => [
                'description' => 'Nombres à virgule flottante (décimaux). Aussi appelés double ou real.',
                'example' => '$prix = 19.99;\n$scientifique = 1.5e3; // 1500\n$negatif = -0.75;',
                'details' => 'Les floats (ou doubles) représentent des nombres à virgule flottante. Précision limitée (~14 décimales). Supporte la notation scientifique (1.5e3 = 1500). Attention aux arrondis et comparaisons !',
                'useCases' => [
                    'Prix et montants : $price = 19.99',
                    'Calculs scientifiques : $pi = 3.14159',
                    'Pourcentages : $taxRate = 0.2',
                    'Mesures physiques : $distance = 12.5'
                ],
                'warnings' => [
                    'Ne JAMAIS comparer avec == : 0.1 + 0.2 != 0.3',
                    'Utiliser epsilon : abs($a - $b) < 0.00001',
                    'Perte de précision dans les calculs',
                    'Ne pas utiliser pour l\'argent (utiliser BCMath ou integers en centimes)'
                ],
                'bestPractices' => [
                    'Pour l\'argent : stocker en centimes (int) ou utiliser BCMath',
                    'Comparaison : function floatEquals($a, $b, $epsilon = 0.00001)',
                    'Type hint : function calculate(float $amount)',
                    'Arrondir : round($value, 2) pour 2 décimales'
                ],
                'resources' => [
                    ['title' => 'PHP Float', 'url' => 'https://www.php.net/manual/fr/language.types.float.php', 'icon' => '📖'],
                    ['title' => 'Floating Point Math', 'url' => 'https://floating-point-gui.de/', 'icon' => '⚠️']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-type_integer', 'label' => 'Integer'],
                    ['id' => 'modal-conversion_types', 'label' => 'Conversion de types']
                ]
            ],
            'type_string' => [
                'description' => 'Chaînes de caractères délimitées par des guillemets simples ou doubles.',
                'example' => '$simple = \'Hello\';\n$double = "World";\n$heredoc = <<<EOD\nTexte multiligne\nEOD;',
                'details' => 'Les strings sont des séquences de caractères. Guillemets simples : littéral. Guillemets doubles : interprète variables et séquences d\'échappement. Heredoc/Nowdoc pour textes multilignes. Taille max : 2GB sur 64 bits.',
                'useCases' => [
                    'Textes et labels : $nom = "Jean"',
                    'HTML/SQL : $html = "<div>$content</div>"',
                    'Chemins : $path = "/var/www/html"',
                    'Templates : $message = "Bonjour $prenom !"'
                ],
                'warnings' => [
                    'Échapper pour SQL : utiliser requêtes préparées',
                    'Échapper pour HTML : htmlspecialchars($text)',
                    'Concaténation lourde : préférer tableau + implode()',
                    'Encodage : toujours utiliser UTF-8'
                ],
                'bestPractices' => [
                    'Guillemets simples pour performances (pas d\'interpolation)',
                    'Guillemets doubles si variables : "Bonjour $nom"',
                    'Manipulation : mb_strlen(), mb_substr() pour UTF-8',
                    'Type hint : function greet(string $name)'
                ],
                'resources' => [
                    ['title' => 'PHP Strings', 'url' => 'https://www.php.net/manual/fr/language.types.string.php', 'icon' => '📖'],
                    ['title' => 'String Functions', 'url' => 'https://www.php.net/manual/fr/ref.strings.php', 'icon' => '🔧']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-type_array', 'label' => 'Array'],
                    ['id' => 'modal-conversion_types', 'label' => 'Conversion de types']
                ]
            ],
            'type_boolean' => [
                'description' => 'Type logique qui ne peut avoir que deux valeurs : true ou false.',
                'example' => '$vrai = true;\n$faux = false;\n// Valeurs falsy : 0, 0.0, "", "0", [], null',
                'details' => 'Le type boolean représente une valeur de vérité. Seulement deux valeurs : true et false (insensibles à la casse). Crucial pour les conditions. PHP convertit automatiquement d\'autres types en bool dans un contexte booléen.',
                'useCases' => [
                    'Conditions : if ($isValid)',
                    'Flags : $isActive = true',
                    'Résultats de comparaison : $result = ($a > $b)',
                    'Contrôle de flux : while ($continue)'
                ],
                'warnings' => [
                    'Valeurs falsy : false, 0, 0.0, "", "0", [], null',
                    'Tout le reste est truthy (même "-1", "false" string)',
                    'Comparaison stricte : === pour éviter 0 == false',
                    '"0" est falsy mais "00" est truthy !'
                ],
                'bestPractices' => [
                    'Nommage clair : $isValid, $hasPermission, $canEdit',
                    'Éviter double négation : if (!$notValid) → if ($isValid)',
                    'Type hint : function check(bool $flag)',
                    'Conversion explicite : $bool = (bool)$value'
                ],
                'resources' => [
                    ['title' => 'PHP Boolean', 'url' => 'https://www.php.net/manual/fr/language.types.boolean.php', 'icon' => '📖'],
                    ['title' => 'Type Juggling', 'url' => 'https://www.php.net/manual/fr/language.types.type-juggling.php', 'icon' => '🔄']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-juggling_types', 'label' => 'Jonglage de types'],
                    ['id' => 'modal-verification_types', 'label' => 'Vérification de types']
                ]
            ],
            'types_composes' => [
                'description' => 'Types qui peuvent contenir plusieurs valeurs : array et object.',
                'example' => '$tableau = [1, 2, 3];\n$objet = new stdClass();\n$objet->propriete = "valeur";',
                'details' => 'Les types composés peuvent stocker plusieurs valeurs. Arrays : collections ordonnées accessibles par index/clé. Objects : instances de classes avec propriétés et méthodes. Contrairement aux scalaires, ils sont passés par référence.',
                'useCases' => [
                    'Array : listes, collections, configurations',
                    'Object : modèles de données, services, entités',
                    'Array pour données simples, Object pour logique',
                    'JSON : array pour tableaux, object pour objets'
                ],
                'warnings' => [
                    'Arrays passés par valeur (copie), objects par référence',
                    'Array vide [] est falsy dans condition',
                    'Object toujours truthy même vide',
                    'Clés numériques vs string dans arrays : "1" != 1'
                ],
                'bestPractices' => [
                    'Typage : function process(array $data)',
                    'Privilégier objets typés pour structures complexes',
                    'Array pour données simples/temporaires',
                    'Vérification : is_array(), is_object()'
                ],
                'resources' => [
                    ['title' => 'PHP Types', 'url' => 'https://www.php.net/manual/fr/language.types.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-type_array', 'label' => 'Array'],
                    ['id' => 'modal-type_object', 'label' => 'Object']
                ]
            ],
            'type_array' => [
                'description' => 'Collections ordonnées de valeurs indexées par des clés numériques ou associatives.',
                'example' => '$indexe = [1, 2, 3];\n$associatif = ["nom" => "John", "age" => 30];\n$mixte = [0 => "zero", "un" => 1];',
                'details' => 'Les arrays sont des maps ordonnés : associations clé => valeur. Clés peuvent être int ou string. Syntaxe courte [] depuis PHP 5.4. Très flexibles : peuvent contenir n\'importe quel type, même d\'autres arrays (multidimensionnel).',
                'useCases' => [
                    'Listes : $fruits = ["pomme", "poire"]',
                    'Configuration : $config = ["host" => "localhost"]',
                    'Résultats BDD : $users = [...rows...]',
                    'Multidimensionnel : $matrix = [[1,2], [3,4]]'
                ],
                'warnings' => [
                    'Clés numériques réindexées par array_values()',
                    'Clé string "1" différente de int 1',
                    'Attention mémoire pour grands arrays',
                    'Modification dans boucle : utiliser foreach by reference'
                ],
                'bestPractices' => [
                    'Syntaxe courte [] au lieu de array()',
                    'Type hint : function handle(array $items)',
                    'count() pour taille, not sizeof()',
                    'in_array() avec strict === : in_array($needle, $haystack, true)'
                ],
                'resources' => [
                    ['title' => 'PHP Arrays', 'url' => 'https://www.php.net/manual/fr/language.types.array.php', 'icon' => '📖'],
                    ['title' => 'Array Functions', 'url' => 'https://www.php.net/manual/fr/ref.array.php', 'icon' => '🔧']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-types_composes', 'label' => 'Types composés'],
                    ['id' => 'modal-type_object', 'label' => 'Object']
                ]
            ],
            'type_object' => [
                'description' => 'Instances de classes contenant des propriétés et des méthodes.',
                'example' => 'class Personne {\n    public $nom = "John";\n}\n$p = new Personne();\necho $p->nom;',
                'details' => 'Les objects sont des instances de classes. Encapsulent données (propriétés) et comportements (méthodes). Passés par référence (contrairement aux arrays). Base de la POO : héritage, interfaces, traits, etc.',
                'useCases' => [
                    'Modèles : class User { public $name; }',
                    'Services : class EmailService { function send() }',
                    'DTOs : class UserDTO { public $id, $email; }',
                    'stdClass : objets génériques sans classe'
                ],
                'warnings' => [
                    'Passés par référence : modification affecte l\'original',
                    'Propriétés dynamiques découragées en PHP 8.2+',
                    'Cloner objets : $copy = clone $original',
                    'Sérialisation : attention aux ressources (BDD, fichiers)'
                ],
                'bestPractices' => [
                    'Type hint : function process(User $user)',
                    'Déclarer propriétés : public $name (pas dynamique)',
                    'Constructeur : __construct() pour initialisation',
                    'Vérification : $obj instanceof ClassName'
                ],
                'resources' => [
                    ['title' => 'PHP Objects', 'url' => 'https://www.php.net/manual/fr/language.types.object.php', 'icon' => '📖'],
                    ['title' => 'OOP Basics', 'url' => 'https://www.php.net/manual/fr/language.oop5.php', 'icon' => '🎓']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-types_composes', 'label' => 'Types composés'],
                    ['id' => 'modal-type_array', 'label' => 'Array']
                ]
            ],
            'types_speciaux' => [
                'description' => 'Types particuliers : null, resource et callable.',
                'example' => '$nul = null;\n$fichier = fopen("test.txt", "r"); // resource\n$fonction = "strlen"; // callable',
                'details' => 'Types spéciaux ayant des usages particuliers. NULL : absence de valeur. Resource : référence vers ressource externe (fichier, connexion). Callable : fonction/méthode appelable. Chacun a son contexte d\'utilisation spécifique.',
                'useCases' => [
                    'NULL : variable non initialisée ou valeur absente',
                    'Resource : fichiers, connexions BDD, sockets',
                    'Callable : callbacks, array_map, usort',
                    'Type hint nullable : function process(?int $id)'
                ],
                'warnings' => [
                    'NULL : isset() vs is_null() comportement différent',
                    'Resources : toujours fermer (fclose, mysqli_close)',
                    'Callable : vérifier avec is_callable() avant appel',
                    'NULL coalesce : $value ?? "default"'
                ],
                'bestPractices' => [
                    'Null safety : $value ?? "default"',
                    'Fermer resources dans finally ou destructeur',
                    'Type hint callable : function map(callable $fn)',
                    'Éviter null returns : utiliser exceptions ou nullables'
                ],
                'resources' => [
                    ['title' => 'PHP Special Types', 'url' => 'https://www.php.net/manual/fr/language.types.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-type_null', 'label' => 'NULL'],
                    ['id' => 'modal-type_resource', 'label' => 'Resource'],
                    ['id' => 'modal-type_callable', 'label' => 'Callable']
                ]
            ],
            'type_null' => [
                'description' => 'Représente une variable sans valeur. Seule valeur possible : null.',
                'example' => '$vide = null;\nunset($variable); // $variable devient null\n$inexistante; // null par défaut',
                'details' => 'NULL représente l\'absence de valeur. Une variable est null si : assignée à null, pas encore définie, ou unset(). Seule valeur du type NULL. Insensible à la casse (null, NULL, Null). Falsy en contexte booléen.',
                'useCases' => [
                    'Valeur par défaut : $result = null',
                    'Valeur optionnelle : function process(?string $name)',
                    'Suppression : unset($array[$key])',
                    'Vérification : if ($value === null)'
                ],
                'warnings' => [
                    'isset($var) : false si null ou undefined',
                    'is_null($var) : true seulement si null (erreur si undefined)',
                    'empty($var) : true pour null, 0, "", [] aussi',
                    'Comparaison : null == false == 0 (utiliser ===)'
                ],
                'bestPractices' => [
                    'Null coalesce : $name = $input ?? "default"',
                    'Type hint nullable : function run(?int $id)',
                    'Vérification stricte : $value === null',
                    'isset() vs is_null() : isset() pour existence'
                ],
                'resources' => [
                    ['title' => 'PHP NULL', 'url' => 'https://www.php.net/manual/fr/language.types.null.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-types_speciaux', 'label' => 'Types spéciaux'],
                    ['id' => 'modal-verification_types', 'label' => 'Vérification de types']
                ]
            ],
            'type_resource' => [
                'description' => 'Référence vers une ressource externe (fichier, connexion base de données, etc.).',
                'example' => '$fichier = fopen("data.txt", "r");\n$connexion = mysqli_connect("localhost");\nfclose($fichier);',
                'details' => 'Les resources sont des références vers des ressources externes maintenues par PHP : fichiers, connexions BDD, sockets, images GD, etc. Non sérialisables. Doivent être libérées explicitement pour éviter les fuites mémoire.',
                'useCases' => [
                    'Fichiers : $f = fopen("file.txt", "r")',
                    'Base de données : $conn = mysqli_connect(...)',
                    'cURL : $ch = curl_init()',
                    'Images : $img = imagecreatetruecolor(100, 100)'
                ],
                'warnings' => [
                    'TOUJOURS fermer les resources : fclose(), mysqli_close()',
                    'Non sérialisables : problème pour sessions/cache',
                    'Limite système : nombre max de fichiers ouverts',
                    'PHP 8+ : beaucoup deviennent des objets (resource deprecated)'
                ],
                'bestPractices' => [
                    'Fermer dans finally : try {...} finally { fclose($f); }',
                    'Vérifier : is_resource($handle)',
                    'Utiliser objets modernes : SplFileObject au lieu fopen',
                    'PDO au lieu mysqli_* pour BDD'
                ],
                'resources' => [
                    ['title' => 'PHP Resource', 'url' => 'https://www.php.net/manual/fr/language.types.resource.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-types_speciaux', 'label' => 'Types spéciaux'],
                    ['id' => 'modal-type_object', 'label' => 'Object']
                ]
            ],
            'type_callable' => [
                'description' => 'Représente quelque chose qui peut être appelé comme une fonction.',
                'example' => '$func = "strtoupper";\n$lambda = function($x) { return $x * 2; };\ncall_user_func($func, "hello");',
                'details' => 'Callable désigne tout ce qui peut être appelé : nom de fonction (string), closure, méthode (array), callable objet. Utilisé pour callbacks, array_map, usort, etc. PHP 7.4+ : arrow functions pour syntaxe courte.',
                'useCases' => [
                    'Callbacks : array_map($callable, $array)',
                    'Tri custom : usort($array, $comparator)',
                    'Event handlers : $emitter->on("event", $callback)',
                    'Stratégies : function process(callable $strategy)'
                ],
                'warnings' => [
                    'Vérifier avant appel : is_callable($callback)',
                    'String peut être fonction globale ou méthode statique',
                    'Array format : [Classe::class, "methode"] ou [$obj, "methode"]',
                    'Closures : attention à la capture de variables (use)'
                ],
                'bestPractices' => [
                    'Type hint : function map(callable $fn, array $data)',
                    'Arrow functions : fn($x) => $x * 2',
                    'Vérification : is_callable() avant call_user_func()',
                    'Closure binding : Closure::bind() pour contexte'
                ],
                'resources' => [
                    ['title' => 'PHP Callable', 'url' => 'https://www.php.net/manual/fr/language.types.callable.php', 'icon' => '📖'],
                    ['title' => 'Anonymous Functions', 'url' => 'https://www.php.net/manual/fr/functions.anonymous.php', 'icon' => '🔧']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-types_speciaux', 'label' => 'Types spéciaux'],
                    ['id' => 'modal-type_string', 'label' => 'String']
                ]
            ],
            'verification_types' => [
                'description' => 'Fonctions pour vérifier le type d\'une variable : is_int(), is_string(), gettype(), etc.',
                'example' => 'is_int(42); // true\nis_string("hello"); // true\ngettype(3.14); // "double"\nvar_dump($variable);',
                'details' => 'PHP fournit des fonctions is_*() pour vérifier les types : is_int(), is_float(), is_string(), is_bool(), is_array(), is_object(), is_null(), is_resource(), is_callable(). gettype() retourne le type sous forme de string. var_dump() pour debug détaillé.',
                'useCases' => [
                    'Validation : if (is_int($age)) {...}',
                    'Type guards : is_array($data) ? count($data) : 0',
                    'Debug : var_dump($variable)',
                    'Switch type : switch(gettype($var)) {...}'
                ],
                'warnings' => [
                    'gettype() vs is_* : gettype() plus lent',
                    'is_numeric() : true pour "123" (string numérique)',
                    'is_int() vs is_numeric() : différence importante',
                    'var_dump() : à retirer en production (debug only)'
                ],
                'bestPractices' => [
                    'Préférer type hints aux vérifications manuelles',
                    'is_*() pour validation runtime si nécessaire',
                    'assert() en dev : assert(is_int($id))',
                    'PHPStan/Psalm pour analyse statique'
                ],
                'resources' => [
                    ['title' => 'Type Functions', 'url' => 'https://www.php.net/manual/fr/ref.var.php', 'icon' => '📖'],
                    ['title' => 'Type Juggling', 'url' => 'https://www.php.net/manual/fr/language.types.type-juggling.php', 'icon' => '🔄']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-types_hints', 'label' => 'Type hints'],
                    ['id' => 'modal-conversion_types', 'label' => 'Conversion de types']
                ]
            ],
            'conversion_types' => [
                'description' => 'Conversion explicite (cast) ou implicite entre types de données.',
                'example' => '$str = (string) 123; // "123"\n$int = (int) "456"; // 456\n$bool = (bool) ""; // false',
                'details' => 'PHP permet de convertir (cast) une variable d\'un type vers un autre. Casting explicite : (int), (float), (string), (bool), (array), (object). Conversion implicite : PHP le fait automatiquement dans certains contextes (juggling).',
                'useCases' => [
                    'Forcer type : $id = (int)$_GET["id"]',
                    'String concat : $msg = "Total: " . (string)$count',
                    'Boolean test : if ((bool)$value)',
                    'Array to object : $obj = (object)["a" => 1]'
                ],
                'warnings' => [
                    '(int)"123abc" → 123 (perd "abc" silencieusement)',
                    '(bool)"0" → false mais (bool)"00" → true',
                    '(array)$scalar : crée [0 => $scalar]',
                    'Perte de données possibles : (int)3.9 → 3'
                ],
                'bestPractices' => [
                    'Préférer fonctions : intval(), floatval(), strval()',
                    'Validation : filter_var($value, FILTER_VALIDATE_INT)',
                    'Type hints au lieu de cast manuel',
                    'settype($var, "int") pour conversion in-place'
                ],
                'resources' => [
                    ['title' => 'Type Juggling', 'url' => 'https://www.php.net/manual/fr/language.types.type-juggling.php', 'icon' => '📖'],
                    ['title' => 'Filter Functions', 'url' => 'https://www.php.net/manual/fr/ref.filter.php', 'icon' => '🔧']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-juggling_types', 'label' => 'Jonglage de types'],
                    ['id' => 'modal-verification_types', 'label' => 'Vérification de types']
                ]
            ],
            'juggling_types' => [
                'description' => 'PHP convertit automatiquement les types selon le contexte (jonglage de types).',
                'example' => 'echo "5" + 3; // 8 (string devient int)\necho "10.5" * 2; // 21 (string devient float)',
                'details' => 'Le type juggling est la conversion automatique de types par PHP selon le contexte. "5" + 3 : string devient int. "hello" . 5 : int devient string. Pratique mais peut cacher des bugs. strict_types=1 le désactive partiellement.',
                'useCases' => [
                    'Calculs : "10" * 2 → 20',
                    'Concaténation : "Age: " . 25 → "Age: 25"',
                    'Comparaisons : "10" == 10 → true',
                    'Conditions : if ($count) (int vers bool)'
                ],
                'warnings' => [
                    '"10" == 10 mais "10" !== 10 (types différents)',
                    '"abc" + 5 → 5 (string non numérique = 0)',
                    'Array to string : génère erreur depuis PHP 8',
                    'Comparaisons loose : "0e0" == "0" → true (scientifique)'
                ],
                'bestPractices' => [
                    'Utiliser strict_types=1 en début de fichier',
                    'Comparaisons strictes : === et !==',
                    'Type hints pour éviter juggling inattendu',
                    'PHPStan level élevé pour détecter les problèmes'
                ],
                'resources' => [
                    ['title' => 'Type Juggling', 'url' => 'https://www.php.net/manual/fr/language.types.type-juggling.php', 'icon' => '📖'],
                    ['title' => 'Comparison Operators', 'url' => 'https://www.php.net/manual/fr/language.operators.comparison.php', 'icon' => '⚖️']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-conversion_types', 'label' => 'Conversion de types'],
                    ['id' => 'modal-types_hints', 'label' => 'Type hints']
                ]
            ],
            'types_hints' => [
                'description' => 'Déclaration de types pour les paramètres et valeurs de retour de fonctions (PHP 7+).',
                'example' => 'function additionner(int $a, int $b): int {\n    return $a + $b;\n}\ndeclare(strict_types=1);',
                'details' => 'Type hints (déclarations de types) permettent de spécifier les types attendus pour paramètres et return. PHP 7.0+ : scalaires (int, float, string, bool). PHP 7.1+ : nullable (?int), void. PHP 8.0+ : union (int|float), mixed. strict_types=1 force le mode strict.',
                'useCases' => [
                    'Paramètres : function greet(string $name)',
                    'Return type : function getAge(): int',
                    'Nullable : function find(?int $id)',
                    'Union PHP 8 : function handle(int|string $value)'
                ],
                'warnings' => [
                    'Sans strict_types : "123" accepté pour int (coercion)',
                    'Avec strict_types=1 : TypeError si type incorrect',
                    'declare(strict_types=1) par fichier (pas global)',
                    'null pas accepté sans ? : function test(?int $id)'
                ],
                'bestPractices' => [
                    'Toujours declare(strict_types=1) en ligne 2',
                    'Type hint tous les paramètres et returns',
                    'Utiliser union types (PHP 8+) au lieu de mixed',
                    'PHPDoc pour types complexes : /** @param array<string> */'
                ],
                'resources' => [
                    ['title' => 'Type Declarations', 'url' => 'https://www.php.net/manual/fr/language.types.declarations.php', 'icon' => '📖'],
                    ['title' => 'PHP 8 Union Types', 'url' => 'https://www.php.net/manual/fr/language.types.declarations.php#language.types.declarations.union', 'icon' => '🔧']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-juggling_types', 'label' => 'Jonglage de types'],
                    ['id' => 'modal-verification_types', 'label' => 'Vérification de types']
                ]
            ],
        ];
        return $this->render('typages/index.html.twig', [
            'data' => $dataTypesPHP,
        ]);
    }
}
