<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class OperateursController extends AbstractController
{
    #[Route('/operateurs', name: 'app_operateurs')]
    public function index(): Response
    {
        // Données complètes sur les opérateurs PHP : arithmétiques, comparaison, logiques, affectation, incrémentation, bitwise, et opérateurs spéciaux avec exemples pratiques
        $dataOperateursPHP = [
            'operateurs_arithmetiques' => [
                'description' => 'Opérateurs pour effectuer des calculs mathématiques : addition, soustraction, multiplication, division, modulo, exponentiation.',
                'example' => '$a = 10; $b = 3;\n$addition = $a + $b; // 13\n$division = $a / $b; // 3.333...\n$modulo = $a % $b; // 1\n$puissance = $a ** $b; // 1000',
                'details' => 'Les opérateurs arithmétiques, c\'est les maths de base ! + pour additionner, - pour soustraire, * pour multiplier, / pour diviser, % pour avoir le reste d\'une division (super utile pour savoir si c\'est pair ou impair !), et ** pour la puissance (10 ** 2 = 100). PHP respecte l\'ordre des priorités comme à l\'école : d\'abord ** puis * / % puis + -. Attention : la division donne TOUJOURS un nombre à virgule (même 10/2 donne 5.0), et diviser par zéro fait planter le programme ! Le modulo (%) c\'est comme le reste quand vous partagez des bonbons.',
                'useCases' => [
                    'Calculs financiers avec addition, soustraction et multiplication pour prix, taxes, remises',
                    'Division pour moyennes, ratios, pourcentages (attention aux divisions par zéro)',
                    'Modulo pour alternance (pair/impair), pagination, cycles répétitifs',
                    'Exponentiation pour calculs scientifiques, croissance exponentielle, intérêts composés',
                    'Négation unaire pour inverser signes dans calculs de différences ou coordonnées',
                    'Combinaisons dans formules complexes : distance, aire, volume, conversions d\'unités'
                ],
                'warnings' => [
                    'Division par zéro génère une erreur fatale (DivisionByZeroError en PHP 8+)',
                    'Précision limitée des floats : 0.1 + 0.2 !== 0.3 (utiliser bcmath pour exactitude)',
                    'Dépassement d\'entiers convertit automatiquement en float (perte de précision possible)',
                    'Modulo avec nombres négatifs : résultat a le signe du dividende en PHP'
                ],
                'bestPractices' => [
                    'Toujours vérifier les diviseurs avant division : if ($b !== 0) { $result = $a / $b; }',
                    'Utiliser bcmath ou gmp pour calculs financiers ou nécessitant haute précision',
                    'Préférer des parenthèses explicites pour clarifier les priorités complexes',
                    'Caster en int après division si résultat entier attendu : (int)($total / $count)',
                    'Utiliser abs() pour valeurs absolues plutôt que multiplier par -1'
                ],
                'resources' => [
                    ['label' => 'Opérateurs arithmétiques PHP', 'url' => 'https://www.php.net/manual/fr/language.operators.arithmetic.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-operateurs_comparaison', 'label' => 'Opérateurs de comparaison'],
                    ['id' => 'modal-operateurs_affectation', 'label' => 'Opérateurs d\'affectation'],
                    ['id' => 'modal-precedence_operateurs', 'label' => 'Précédence des opérateurs']
                ]
            ],
            'operateurs_comparaison' => [
                'description' => 'Opérateurs pour comparer des valeurs et retourner true/false : égalité, inégalité, supérieur, inférieur.',
                'example' => '$x = 5; $y = "5";\nvar_dump($x == $y);  // true (égalité)\nvar_dump($x === $y); // false (identité)\nvar_dump($x != $y);  // false\nvar_dump($x <=> $y); // 0 (spaceship)',
                'details' => 'Comparer, c\'est vérifier "est-ce que c\'est pareil ?", "est-ce que c\'est plus grand ?". Les symboles : == (égal), === (strictement identique), != (différent), !== (strictement différent), < (plus petit), > (plus grand), <= (plus petit ou égal), >= (plus grand ou égal). LA DIFFÉRENCE IMPORTANTE : == compare les valeurs (5 == "5" est vrai), === compare valeur ET type (5 === "5" est faux). Conseil : toujours utiliser === pour éviter les surprises ! Il y a aussi <=> ("spaceship", vaisseau spatial) qui donne -1, 0 ou 1 pour trier facilement.',
                'useCases' => [
                    'Validation de formulaires : vérifier âge >= 18, longueur mot de passe > 8',
                    'Conditions if/elseif pour logique métier, contrôle d\'accès, états d\'application',
                    'Tri personnalisé avec spaceship dans usort : return $a <=> $b pour ordre croissant',
                    'Vérification stricte de types avec === pour éviter bugs de jonglage (0 == "texte")',
                    'Comparaisons de dates, timestamps, versions avec < > <= >=',
                    'Tests unitaires : assertions assertEquals vs assertSame (== vs ===)'
                ],
                'warnings' => [
                    'Éviter == pour comparer types différents : "0" == false est true, préférer ===',
                    'Comparaison de floats avec == risquée : utiliser abs($a - $b) < EPSILON',
                    'Arrays : == ignore ordre des clés, === compare tout (valeurs, clés, ordre)',
                    'Spaceship avec types mixtes peut causer comportements inattendus (comparer types identiques)'
                ],
                'bestPractices' => [
                    'Toujours utiliser === et !== par défaut, sauf besoin explicite de jonglage',
                    'Utiliser in_array avec strict=true : in_array($val, $arr, true) pour éviter surprises',
                    'Pour dates, convertir en timestamps ou DateTime avant comparaison',
                    'Documenter quand == est volontaire pour clarifier l\'intention',
                    'Spaceship excellent pour callbacks de tri : usort($arr, fn($a, $b) => $a["age"] <=> $b["age"])'
                ],
                'resources' => [
                    ['label' => 'Opérateurs de comparaison', 'url' => 'https://www.php.net/manual/fr/language.operators.comparison.php', 'icon' => '📖'],
                    ['label' => 'Tableau de comparaisons', 'url' => 'https://www.php.net/manual/fr/types.comparisons.php', 'icon' => '📊']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-operateurs_logiques', 'label' => 'Opérateurs logiques'],
                    ['id' => 'modal-operateurs_ternaire', 'label' => 'Opérateur ternaire'],
                    ['id' => 'modal-precedence_operateurs', 'label' => 'Précédence des opérateurs']
                ]
            ],
            'operateurs_logiques' => [
                'description' => 'Opérateurs pour combiner des expressions booléennes : AND, OR, NOT, XOR avec priorités différentes.',
                'example' => '$a = true; $b = false;\nvar_dump($a && $b); // false (AND)\nvar_dump($a || $b); // true (OR)\nvar_dump(!$a);      // false (NOT)\nvar_dump($a xor $b); // true (XOR)',
                'details' => 'Les opérateurs logiques, c\'est pour combiner des conditions : "Si j\'ai 18 ans ET j\'ai mon permis". Les symboles : && (ET), || (OU), ! (NON). && = les deux doivent être vrais. || = au moins un doit être vrai. ! = inverse le résultat. Important : PHP est malin et fait du "court-circuit" : si la première partie suffit à connaître le résultat, il ne calcule même pas la deuxième ! Par exemple : if ($user && $user->isAdmin()) - si $user est faux, il ne teste même pas isAdmin() (évite une erreur). Astuce : toujours utiliser && || ! plutôt que and or not.',
                'useCases' => [
                    'Conditions composées : if ($age >= 18 && $hasLicense) pour vérifications multiples',
                    'Validation formulaires : if (empty($name) || empty($email)) pour champs requis',
                    'Court-circuit pour optimisation : if (isset($user) && $user->isAdmin()) évite erreurs',
                    'Contrôle d\'accès : if ($isAdmin || ($isOwner && $canEdit)) pour permissions complexes',
                    'NOT pour inverser conditions : if (!$isExpired) plutôt que if ($isExpired === false)',
                    'XOR pour conditions mutuellement exclusives : if ($modeA xor $modeB)'
                ],
                'warnings' => [
                    'Priorité and/or vs &&/|| différente : $x = true && false vs $x = true and false',
                    'Oublier parenthèses dans conditions complexes peut changer la logique attendue',
                    'Court-circuit : $result = $func1() || $func2() ne garantit pas l\'exécution de func2',
                    'XOR rarement utilisé : peut rendre code moins lisible, préférer if explicite'
                ],
                'bestPractices' => [
                    'Toujours préférer && || ! aux mots-clés and or not pour éviter problèmes de priorité',
                    'Utiliser parenthèses pour clarifier conditions complexes : ($a && $b) || ($c && $d)',
                    'Exploiter court-circuit pour sécurité : isset($arr["key"]) && doSomething($arr["key"])',
                    'Extraire conditions complexes dans variables nommées pour lisibilité',
                    'Ordre des conditions : placer les plus rapides/fréquentes en premier pour optimisation'
                ],
                'resources' => [
                    ['label' => 'Opérateurs logiques PHP', 'url' => 'https://www.php.net/manual/fr/language.operators.logical.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-operateurs_comparaison', 'label' => 'Opérateurs de comparaison'],
                    ['id' => 'modal-operateurs_ternaire', 'label' => 'Opérateur ternaire'],
                    ['id' => 'modal-precedence_operateurs', 'label' => 'Précédence des opérateurs']
                ]
            ],
            'operateurs_affectation' => [
                'description' => 'Opérateurs pour assigner des valeurs : affectation simple et composée (+=, -=, *=, /=, %=, etc.).',
                'example' => '$x = 10;\n$x += 5;  // $x = $x + 5 = 15\n$x -= 3;  // $x = $x - 3 = 12\n$x *= 2;  // $x = $x * 2 = 24\n$x /= 4;  // $x = $x / 4 = 6',
                'details' => 'Les opérateurs d\'affectation, c\'est pour mettre une valeur dans une variable. Le basique : = met la valeur. Les versions raccourcies sont super pratiques : += pour ajouter ($x += 5 au lieu de $x = $x + 5), -= pour retirer, *= pour multiplier, /= pour diviser, .= pour ajouter du texte à la fin. C\'est plus court à écrire et un peu plus rapide ! Vous pouvez même faire des affectations en chaîne : $a = $b = $c = 0 donne zéro à tout le monde d\'un coup. Ces raccourcis sont très utilisés dans les boucles pour accumuler des totaux ou construire du texte progressivement.',
                'useCases' => [
                    'Accumulation dans boucles : $total += $value pour sommes, compteurs',
                    'Mise à jour de propriétés : $obj->score += 10 pour incréments conditionnels',
                    'Construction de chaînes : $html .= "<div>$content</div>" pour concaténation progressive',
                    'Opérations mathématiques répétées : $price *= 1.2 pour appliquer taxe ou remise',
                    'Manipulation de bits : $flags |= FLAG_ACTIVE pour activer flags',
                    'Affectation multiple : $x = $y = $z = 0 pour initialisation groupée'
                ],
                'warnings' => [
                    'Affectation dans conditions souvent involontaire : if ($x = 10) assigne, pas compare',
                    'Opérateurs composés avec types mixtes peuvent causer jonglage inattendu',
                    'Chaînes d\'affectation peu lisibles : éviter $a = $b = func() en production',
                    'Ordre d\'évaluation : $arr[$i] += ++$i comportement non défini (éviter)'
                ],
                'bestPractices' => [
                    'Préférer opérateurs composés pour clarté et performance : $x += 1 vs $x = $x + 1',
                    'Éviter affectations dans conditions : extraire en ligne séparée pour lisibilité',
                    'Utiliser opérateurs bitwise composés pour gestion de flags/permissions',
                    'Valider types avant opérations composées arithmétiques pour éviter erreurs',
                    'Documenter chaînes d\'affectation si nécessaires, mais généralement les éviter'
                ],
                'resources' => [
                    ['label' => 'Opérateurs d\'affectation', 'url' => 'https://www.php.net/manual/fr/language.operators.assignment.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-operateurs_arithmetiques', 'label' => 'Opérateurs arithmétiques'],
                    ['id' => 'modal-operateurs_concatenation', 'label' => 'Concaténation'],
                    ['id' => 'modal-operateurs_bitwise', 'label' => 'Opérateurs bitwise']
                ]
            ],
            'operateurs_incrementation' => [
                'description' => 'Opérateurs pour augmenter/diminuer une variable : pré-incrémentation, post-incrémentation, pré-décrémentation, post-décrémentation.',
                'example' => '$i = 5;\necho ++$i; // 6 (pré-incrémentation)\necho $i++; // 6 (post-incrémentation, $i devient 7)\necho --$i; // 6 (pré-décrémentation)\necho $i--; // 6 (post-décrémentation, $i devient 5)',
                'details' => 'Incrémentation (++) et décrémentation (--), c\'est ajouter ou retirer 1 rapidement ! La position compte : ++$i change d\'abord puis donne la nouvelle valeur, $i++ donne l\'ancienne valeur puis change. Exemple : $i = 5; echo ++$i; affiche 6. Mais $i = 5; echo $i++; affiche 5 (et après $i vaut 6). Super utilisé dans les boucles : for ($i = 0; $i < 10; $i++). Fun fact : ça marche aussi sur les lettres ! "a"++ devient "b", "z"++ devient "aa" (comme Excel). Préférez ++$i c\'est un poil plus rapide (mais vraiment un tout petit poil).',
                'useCases' => [
                    'Boucles for classiques : for ($i = 0; $i < 10; $i++) pour itérations',
                    'Compteurs : $counter++ pour suivre occurrences, clics, tentatives',
                    'Parcours de tableaux : while ($i < count($arr)) { process($arr[$i++]); }',
                    'Identifiants séquentiels : $id = $nextId++ pour générer IDs uniques',
                    'Pagination : $page++; $offset = $page * $limit',
                    'Chaînes alphanumériques : $ref = "A"; $ref++ génère séquences A, B, C...'
                ],
                'warnings' => [
                    'Post-incrémentation dans expressions complexes source d\'erreurs subtiles',
                    'Ne pas utiliser même variable avec ++ plusieurs fois dans une expression',
                    'Comportement chaînes surprenant : "1a"++ devient "1b", pas "2a"',
                    'Performance : post-incrémentation légèrement plus lente (négligeable sauf boucles intensives)'
                ],
                'bestPractices' => [
                    'Préférer pré-incrémentation (++$i) sauf besoin explicite de l\'ancienne valeur',
                    'Utiliser sur ligne séparée dans code complexe pour clarté : $i++; plutôt que dans expression',
                    'Pour lisibilité, préférer += 1 dans contextes non-boucle si plus clair',
                    'Éviter incrémentation de chaînes sauf besoin spécifique (comportement non intuitif)',
                    'Dans boucles for, convention $i++ acceptée même si ++$i techniquement meilleur'
                ],
                'resources' => [
                    ['label' => 'Incrémentation/Décrémentation', 'url' => 'https://www.php.net/manual/fr/language.operators.increment.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-operateurs_affectation', 'label' => 'Opérateurs d\'affectation'],
                    ['id' => 'modal-operateurs_arithmetiques', 'label' => 'Opérateurs arithmétiques'],
                    ['id' => 'modal-precedence_operateurs', 'label' => 'Précédence des opérateurs']
                ]
            ],
            'operateurs_concatenation' => [
                'description' => 'Opérateurs pour joindre des chaînes de caractères : concaténation simple (.) et avec affectation (.=).',
                'example' => '$nom = "John";\n$age = 25;\n$message = "Bonjour " . $nom; // "Bonjour John"\n$message .= ", vous avez " . $age . " ans"; // Concaténation avec affectation',
                'details' => 'La concaténation, c\'est coller du texte bout à bout ! En PHP, c\'est le point . qui fait ça (pas le +). Par exemple : "Bonjour " . "John" donne "Bonjour John". Le raccourci .= ajoute du texte à la fin : $msg .= " !" équivaut à $msg = $msg . " !". PHP est malin : si vous collez un nombre, il le transforme automatiquement en texte ("Age: " . 25 donne "Age: 25"). Super pratique pour construire des messages, du HTML, des URLs... Pour coller plein de morceaux, vous pouvez faire $a . $b . $c ou utiliser .= progressivement.',
                'useCases' => [
                    'Construction de messages : $msg = "Bonjour " . $nom . ", bienvenue !"',
                    'Génération HTML : $html .= "<li>" . htmlspecialchars($item) . "</li>"',
                    'Chemins de fichiers : $path = $dir . "/" . $filename . ".txt"',
                    'URLs dynamiques : $url = $base . "?id=" . $id . "&action=" . $action',
                    'Logs et rapports : $log .= date("Y-m-d H:i:s") . " - " . $message . PHP_EOL',
                    'Templates simples : $template = "Cher $nom, " . $content . " Cordialement"'
                ],
                'warnings' => [
                    'Concaténations répétées en boucle inefficaces : préférer array + implode',
                    'Oublier espaces : "Hello" . $name donne "HelloJohn", ajouter " " . $name',
                    'Conversion automatique peut masquer bugs : (object)[] . "test" donne erreur',
                    'Attention avec null : null . "text" devient "text" (jonglage silencieux)'
                ],
                'bestPractices' => [
                    'Pour boucles, accumuler dans array puis implode() : $html = implode("", $parts)',
                    'Utiliser interpolation si plus lisible : "$nom a $age ans" vs $nom . " a " . $age . " ans"',
                    'Échapper contenu HTML : htmlspecialchars() avant concaténation dans templates',
                    'Pour SQL, TOUJOURS utiliser requêtes préparées, jamais concaténation directe',
                    'Considérer sprintf() pour formats complexes : sprintf("%s (%d ans)", $nom, $age)'
                ],
                'resources' => [
                    ['label' => 'Opérateurs de chaînes', 'url' => 'https://www.php.net/manual/fr/language.operators.string.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-operateurs_affectation', 'label' => 'Opérateurs d\'affectation'],
                    ['id' => 'modal-operateurs_arithmetiques', 'label' => 'Opérateurs arithmétiques'],
                    ['id' => 'modal-operateurs_type', 'label' => 'Opérateurs de type']
                ]
            ],
            'operateurs_tableaux' => [
                'description' => 'Opérateurs spécifiques aux tableaux : union (+), égalité (==), identité (===), inégalité (!=, <>).',
                'example' => '$arr1 = [1, 2, 3];\n$arr2 = [4, 5, 6];\n$union = $arr1 + $arr2; // [1, 2, 3]\n$arr3 = [1, 2, 3];\nvar_dump($arr1 == $arr3); // true\nvar_dump($arr1 === $arr3); // true',
                'details' => 'Les tableaux ont leurs propres opérateurs ! Le + fusionne deux tableaux MAIS attention : si une clé existe dans les deux, c\'est la valeur du premier qui gagne (pas comme array_merge qui ajoute tout). Pour comparer : == vérifie si les tableaux ont les mêmes données (peu importe l\'ordre), === vérifie données + ordre + types identiques. C\'est pratique pour fusionner des configurations : $config = $userSettings + $defaults donne priorité aux paramètres utilisateur et complète avec les valeurs par défaut. Différent d\'array_merge qui écraserait ou ajouterait les valeurs !',
                'useCases' => [
                    'Fusion avec priorité : $config = $userConfig + $defaultConfig (user prioritaire)',
                    'Comparaison de tableaux associatifs : if ($arr1 == $arr2) sans souci d\'ordre',
                    'Vérification stricte : if ($result === $expected) pour tests unitaires',
                    'Ajout de valeurs par défaut : $options = $provided + ["timeout" => 30, "retry" => 3]',
                    'Combinaison de résultats : $all = $results1 + $results2 (clés uniques)',
                    'Détection de différences : if ($current !== $previous) pour changements'
                ],
                'warnings' => [
                    'Union (+) ne fonctionne PAS comme array_merge : $a + $b != array_merge($a, $b)',
                    'Clés numériques préservées avec + : [0 => "a"] + [0 => "b"] donne [0 => "a"]',
                    '== ignore ordre : ["a" => 1, "b" => 2] == ["b" => 2, "a" => 1] est true',
                    '=== sensible à ordre : ["a", "b"] !== ["b", "a"] même si valeurs identiques'
                ],
                'bestPractices' => [
                    'Utiliser + pour valeurs par défaut, array_merge pour vraie fusion',
                    'Préférer === dans tests pour détecter différences subtiles d\'ordre ou type',
                    'Documenter choix entre + et array_merge car comportements très différents',
                    'Pour comparer contenu sans ordre : sort() puis === sur copies',
                    'Utiliser array_diff() / array_intersect() pour comparaisons plus complexes'
                ],
                'resources' => [
                    ['label' => 'Opérateurs de tableaux', 'url' => 'https://www.php.net/manual/fr/language.operators.array.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-operateurs_comparaison', 'label' => 'Opérateurs de comparaison'],
                    ['id' => 'modal-operateurs_affectation', 'label' => 'Opérateurs d\'affectation']
                ]
            ],
            'operateurs_ternaire' => [
                'description' => 'Opérateur conditionnel ternaire pour des conditions courtes : condition ? valeur_si_vrai : valeur_si_faux.',
                'example' => '$age = 18;\n$statut = ($age >= 18) ? "majeur" : "mineur";\n// Null coalescing\n$nom = $utilisateur ?? "Anonyme";\n// Null coalescing assignment (PHP 7.4+)\n$config[\'debug\'] ??= false;',
                'details' => 'Le ternaire, c\'est le if/else en version ultra-courte ! Condition ? SiVrai : SiFaux. Par exemple : $statut = ($age >= 18) ? "majeur" : "mineur". Vous pouvez même faire plus court : $x = $y ?: "défaut" (si $y est vrai, prends $y, sinon prends "défaut"). ATTENTION : ne pas en mettre 10 les uns dans les autres, ça devient illisible ! Différence avec ?? : le ternaire regarde si c\'est vrai/faux (0 = faux), alors que ?? regarde juste si ça existe ou si c\'est null. À utiliser pour des trucs simples, sinon faites un vrai if/else.',
                'useCases' => [
                    'Affectations conditionnelles simples : $message = $success ? "OK" : "Erreur"',
                    'Valeurs par défaut : $limit = $userLimit ? $userLimit : 10',
                    'Classes CSS dynamiques : class="btn <?= $active ? "active" : "" ?>"',
                    'Paramètres de fonction : doSomething($quick ? 5 : 50, $debug ? "verbose" : "quiet")',
                    'Expressions dans templates : {{ user.isAdmin ? "Admin" : "User" }}',
                    'Construction d\'arrays : $data = ["status" => $ok ? "success" : "error"]'
                ],
                'warnings' => [
                    'Ternaires imbriqués illisibles : $x = $a ? $b ? $c : $d : $e (éviter absolument)',
                    'Associativité gauche en PHP : $a ? $b : $c ? $d : $e != ($a ? $b : ($c ? $d : $e))',
                    'Court-circuit non évident : condition peut masquer erreur dans branche non évaluée',
                    'Forme courte ?: risquée avec 0, "", "0", [] (sont falsy)'
                ],
                'bestPractices' => [
                    'Limiter à conditions simples : si logique complexe, préférer if-else complet',
                    'Toujours parenthéser ternaires imbriqués (ou mieux, ne pas imbriquer)',
                    'Utiliser ?? au lieu de ?: pour tester null spécifiquement',
                    'Extraire condition dans variable nommée si pas triviale : $canAccess = ...; $page = $canAccess ? ... : ...',
                    'Pour templates, acceptable car concis, mais if-else plus maintenable en logique métier'
                ],
                'resources' => [
                    ['label' => 'Opérateurs de comparaison (ternaire)', 'url' => 'https://www.php.net/manual/fr/language.operators.comparison.php#language.operators.comparison.ternary', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-operateurs_null_coalescing', 'label' => 'Null coalescing'],
                    ['id' => 'modal-operateurs_comparaison', 'label' => 'Opérateurs de comparaison'],
                    ['id' => 'modal-operateurs_logiques', 'label' => 'Opérateurs logiques']
                ]
            ],
            'operateurs_null_coalescing' => [
                'description' => 'Opérateurs pour gérer les valeurs null : null coalescing (??) et null coalescing assignment (??=).',
                'example' => '$nom = $_GET[\'nom\'] ?? "Défaut";\n$config = $config ?? [];\n// Assignment (PHP 7.4+)\n$settings[\'theme\'] ??= "dark";\n// Équivalent à :\n// $settings[\'theme\'] = $settings[\'theme\'] ?? "dark";',
                'details' => 'Null coalescing (??) c\'est THE super opérateur pour les valeurs par défaut ! Il dit : "si cette variable existe et n\'est pas null, prends-la, sinon prends ça". Par exemple : $nom = $_GET[\'nom\'] ?? "Anonyme". L\'énorme avantage : aucune erreur si la variable n\'existe pas ! Vous pouvez en chaîner : $x ?? $y ?? $z ?? "défaut" prend le premier qui existe. Depuis PHP 7.4, il y a même ??= : $config[\'theme\'] ??= "dark" met "dark" SEULEMENT si theme n\'existe pas encore. Différent du ternaire : ?? teste juste null, pas le vrai/faux (0 serait accepté).',
                'useCases' => [
                    'Récupération sécurisée $_GET/$_POST : $id = $_GET["id"] ?? 0 sans notice',
                    'Valeurs par défaut config : $timeout = $config["timeout"] ?? 30',
                    'Chaînage pour fallbacks : $name = $user->name ?? $default->name ?? "Guest"',
                    'Initialisation paresseuse : $cache ??= expensive_operation() (exécute si besoin)',
                    'Tableaux imbriqués : $value = $data["user"]["email"] ?? null sans erreur',
                    'Paramètres optionnels : function($opts = []) { $limit = $opts["limit"] ?? 10; }'
                ],
                'warnings' => [
                    '?? ne détecte PAS 0, "", false comme "manquant" : utiliser ?: si nécessaire',
                    'Attention avec isset() : isset($arr[0]) false si $arr[0] === null',
                    '??= ne fonctionne pas pour propriétés d\'objets inexistantes (erreur)',
                    'Performance : chaînages longs de ?? peuvent être moins optimaux que valeur unique'
                ],
                'bestPractices' => [
                    'Toujours préférer ?? à isset() + ternaire pour lisibilité',
                    'Utiliser ??= pour initialisation de propriétés, évite répétition de $obj->prop',
                    'Pour tableaux imbriqués profonds, considérer fonction helper ou bibliothèque',
                    'Combiner avec typage strict : (int)($_GET["id"] ?? 0) pour garantir type',
                    'Documenter valeurs par défaut choisies, surtout si comportement métier important'
                ],
                'resources' => [
                    ['label' => 'Null Coalescing', 'url' => 'https://www.php.net/manual/fr/migration70.new-features.php#migration70.new-features.null-coalesce-op', 'icon' => '📖'],
                    ['label' => 'Null Coalescing Assignment', 'url' => 'https://www.php.net/manual/fr/migration74.new-features.php#migration74.new-features.core.null-coalescing-assignment', 'icon' => '🆕']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-operateurs_ternaire', 'label' => 'Opérateur ternaire'],
                    ['id' => 'modal-operateurs_affectation', 'label' => 'Opérateurs d\'affectation'],
                    ['id' => 'modal-operateurs_comparaison', 'label' => 'Opérateurs de comparaison']
                ]
            ],
            'operateurs_bitwise' => [
                'description' => 'Opérateurs au niveau des bits : AND (&), OR (|), XOR (^), NOT (~), décalages (<< >>).',
                'example' => '$a = 12; // 1100 en binaire\n$b = 10; // 1010 en binaire\necho $a & $b;  // 8 (1000)\necho $a | $b;  // 14 (1110)\necho $a ^ $b;  // 6 (0110)\necho $a << 1; // 24 (décalage gauche)',
                'details' => 'Les opérateurs bitwise, c\'est pour les ninjas du code ! Ils travaillent au niveau des bits (0 et 1) dans les nombres. & (AND) met 1 si les deux bits sont 1. | (OR) met 1 si au moins un bit est 1. ^ (XOR) met 1 si exactement un est 1. ~ (NOT) inverse tous les bits. << décale à gauche (×2), >> décale à droite (÷2). Super utile pour les permissions (READ | WRITE | EXECUTE), les flags de configuration, ou optimiser des calculs ($x << 3 plus rapide que $x * 8). C\'est du niveau avancé, vous n\'en aurez pas besoin tous les jours, mais c\'est puissant pour gérer des flags et des masques !',
                'useCases' => [
                    'Gestion de permissions : $perms = READ | WRITE; if ($perms & ADMIN) {...}',
                    'Flags de configuration : $options |= FLAG_DEBUG; pour activer flag',
                    'Masques de bits : $value & 0xFF pour extraire octet de poids faible',
                    'Optimisations mathématiques : $x << 3 plus rapide que $x * 8',
                    'Cryptographie basique : $encrypted = $data ^ $key pour XOR simple',
                    'Encodage/décodage : manipulation de pixels, couleurs RGB, protocoles réseau'
                ],
                'warnings' => [
                    'Comportement dépend de l\'architecture (32-bit vs 64-bit)',
                    'Décalage de nombres négatifs : résultats dépendent de l\'implémentation',
                    'NOT (~) avec entiers signés donne résultats contre-intuitifs (complément)',
                    'Opérateurs bitwise != logiques : & != &&, | != ||, ^ != xor (pas court-circuit)'
                ],
                'bestPractices' => [
                    'Utiliser constantes nommées pour flags : const READ = 1, WRITE = 2, EXECUTE = 4',
                    'Documenter masques de bits et leur signification pour maintenabilité',
                    'Pour permissions, préférer systèmes établis (chmod Unix) plutôt que réinventer',
                    'Tester décalages avec valeurs limites pour éviter dépassements',
                    'Préférer opérateurs logiques (&&, ||) sauf besoin bitwise spécifique'
                ],
                'resources' => [
                    ['label' => 'Opérateurs bit à bit', 'url' => 'https://www.php.net/manual/fr/language.operators.bitwise.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-operateurs_logiques', 'label' => 'Opérateurs logiques'],
                    ['id' => 'modal-operateurs_affectation', 'label' => 'Opérateurs d\'affectation'],
                    ['id' => 'modal-operateurs_arithmetiques', 'label' => 'Opérateurs arithmétiques']
                ]
            ],
            'operateurs_instanceof' => [
                'description' => 'Opérateur pour vérifier si un objet est une instance d\'une classe ou implémente une interface.',
                'example' => 'class Personne {}\n$obj = new Personne();\nvar_dump($obj instanceof Personne); // true\nvar_dump($obj instanceof stdClass); // false\nvar_dump($obj instanceof Countable); // false',
                'details' => 'Instanceof, c\'est le "tu es de quelle famille ?" de la POO ! Il vérifie si un objet est une instance d\'une certaine classe : $user instanceof User. Ça marche aussi avec l\'héritage : si vous avez class Admin extends User, alors $admin instanceof User est vrai ! Pareil pour les interfaces : $obj instanceof JsonSerializable vérifie si l\'objet peut être transformé en JSON. Retourne true ou false. Depuis PHP 8, vous pouvez même mettre le nom de la classe dans une variable ! Super utile pour vérifier qu\'un objet peut faire certaines choses avant de les lui demander.',
                'useCases' => [
                    'Validation de types : if ($data instanceof Response) { $data->send(); }',
                    'Gestion polymorphique : if ($vehicle instanceof Car) { $vehicle->openTrunk(); }',
                    'Vérification d\'interfaces : if ($obj instanceof JsonSerializable) { json_encode($obj); }',
                    'Hiérarchie d\'exceptions : catch (Exception $e) if ($e instanceof CustomException)',
                    'Factory patterns : déterminer traitement selon type d\'objet retourné',
                    'Type guards en POO : s\'assurer méthodes disponibles avant appel'
                ],
                'warnings' => [
                    'instanceof false pour valeurs non-objets : vérifier is_object() d\'abord si incertain',
                    'Nom de classe sensible à la casse : Personne != personne',
                    'Avec namespaces, utiliser FQCN ou use : instanceof \App\Models\User',
                    'Ne remplace pas is_a() pour vérifier chaînes : is_a("MyClass", "ParentClass")'
                ],
                'bestPractices' => [
                    'Préférer type hints (fonction(User $user)) à instanceof quand possible',
                    'Combiner avec is_object() si variable peut ne pas être objet',
                    'Utiliser pour polymorphisme, pas pour logique métier trop couplée à types',
                    'En tests unitaires, assertInstanceOf() plus expressif que assertTrue instanceof',
                    'Considérer duck typing (méthode existe ?) plutôt que instanceof strict dans certains cas'
                ],
                'resources' => [
                    ['label' => 'Opérateur instanceof', 'url' => 'https://www.php.net/manual/fr/language.operators.type.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-operateurs_type', 'label' => 'Opérateurs de type'],
                    ['id' => 'modal-operateurs_comparaison', 'label' => 'Opérateurs de comparaison']
                ]
            ],
            'operateurs_execution' => [
                'description' => 'Opérateur d\'exécution (backticks) pour exécuter des commandes système (à éviter pour la sécurité).',
                'example' => '// ATTENTION : Risque de sécurité !\n$output = `ls -la`; // Unix/Linux\n$output = `dir`; // Windows\n// Préférer : shell_exec(), exec(), system()',
                'details' => 'Les backticks (`) exécutent des commandes système directement depuis PHP ! C\'est comme appeler le Terminal ou l\'Invite de commande... mais 🚨 DANGER ABSOLU 🚨 si tu y mets des données utilisateur ! Un pirate peut alors exécuter N\'IMPORTE QUELLE commande sur ton serveur (effacer fichiers, voler données, etc.). En pratique, c\'est presque toujours désactivé sur les hébergeurs pour cette raison. Si tu en as vraiment besoin : utilise escapeshellarg() sur TOUS les paramètres et privilégie proc_open() qui est plus sécurisé. Vraiment, cherche d\'abord une bibliothèque PHP qui fait la même chose !',
                'useCases' => [
                    'Scripts système simples : $users = `cat /etc/passwd` (développement seulement)',
                    'Intégration outils CLI : $converted = `ffmpeg -i input.mp4 output.webm 2>&1`',
                    'Diagnostics serveur : $diskSpace = `df -h` pour monitoring',
                    'Build tools : exécuter compilateurs, minifiers (jamais avec input user)',
                    'Déploiement automatisé : $gitHash = `git rev-parse HEAD`',
                    'Legacy : maintenir code ancien (remplacer par alternatives modernes)'
                ],
                'warnings' => [
                    'CRITIQUE : JAMAIS avec input utilisateur non sanitizé = faille shell injection',
                    'Disabled par défaut sur hébergements partagés pour sécurité',
                    'stderr non capturé par défaut : rediriger avec 2>&1 si nécessaire',
                    'Blocage jusqu\'à fin commande : timeout possible avec commandes longues'
                ],
                'bestPractices' => [
                    'ÉVITER ABSOLUMENT : préférer bibliothèques PHP natives quand disponibles',
                    'Si obligatoire : escapeshellarg() sur TOUS les arguments dynamiques',
                    'Utiliser proc_open() pour contrôle avancé (stdin/stdout/stderr)',
                    'Valider whitelist de commandes autorisées, jamais input brut',
                    'Logs et monitoring : tracer toutes exécutions pour audit sécurité'
                ],
                'resources' => [
                    ['label' => 'Opérateur d\'exécution', 'url' => 'https://www.php.net/manual/fr/language.operators.execution.php', 'icon' => '⚠️'],
                    ['label' => 'Sécurité - Commandes shell', 'url' => 'https://www.php.net/manual/fr/security.shell.php', 'icon' => '🔒']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-operateurs_suppression_erreur', 'label' => 'Suppression d\'erreur'],
                    ['id' => 'modal-operateurs_type', 'label' => 'Opérateurs de type']
                ]
            ],
            'operateurs_suppression_erreur' => [
                'description' => 'Opérateur de suppression d\'erreur (@) pour ignorer les erreurs (à utiliser avec parcimonie).',
                'example' => '$contenu = @file_get_contents("fichier.txt");\n// Supprime les warnings si le fichier n\'existe pas\n$connexion = @mysql_connect("localhost", "user", "pass");\n// Attention : masque les erreurs importantes !',
                'details' => 'Le @ c\'est le "mouton noir" des opérateurs ! Il cache les erreurs sous le tapis... exactement ce qu\'il ne faut PAS faire ! En plus, il ralentit ton code de 2-3 fois. Au lieu d\'utiliser @file_get_contents(), fais plutôt if (file_exists($fichier)) avant. Au lieu de @$variable, utilise isset($variable) ou le super ?? qu\'on a vu. L\'arobase masque les problèmes, et quand ton code plante, tu ne comprends rien ! Seule exception acceptable : parfois dans du vieux code legacy où tu ne peux pas refaire tout. Sinon, fuis-le comme la peste.',
                'useCases' => [
                    'Opérations fichiers optionnelles : @unlink($temp) si suppression non critique',
                    'Conversion de types : $int = @intval($maybeString) sans warning',
                    'Legacy code : compatibilité avec ancien code nécessitant @',
                    'Performances critiques : éviter overhead de vérifications (cas rares)',
                    'include optionnel : @include "optional-config.php"',
                    'Wrappers réseau : @file_get_contents($url) avec fallback'
                ],
                'warnings' => [
                    'MASQUE erreurs importantes : bugs difficiles à diagnostiquer',
                    'Impact performance notable : ralentit exécution de ~2-3x',
                    'Mauvaise pratique généralisée : indique souvent design défaillant',
                    'Ne prévient pas exceptions : pas de protection contre erreurs fatales'
                ],
                'bestPractices' => [
                    'ÉVITER : préférer vérifications préalables (file_exists, is_readable, isset)',
                    'Si utilisé : TOUJOURS vérifier retour et gérer échec : if (@operation()) else {...}',
                    'Documenter explicitement pourquoi @ nécessaire dans ce cas précis',
                    'Utiliser try-catch pour exceptions plutôt que @ pour erreurs',
                    'Refactoring : remplacer @ par gestion d\'erreur propre quand possible'
                ],
                'resources' => [
                    ['label' => 'Opérateur de contrôle d\'erreur', 'url' => 'https://www.php.net/manual/fr/language.operators.errorcontrol.php', 'icon' => '⚠️']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-operateurs_execution', 'label' => 'Opérateur d\'exécution'],
                    ['id' => 'modal-operateurs_type', 'label' => 'Opérateurs de type']
                ]
            ],
            'precedence_operateurs' => [
                'description' => 'Ordre de priorité des opérateurs : parenthèses, puis **, puis *, /, %, puis +, -, puis comparaisons, puis logiques.',
                'example' => '$result = 2 + 3 * 4; // 14 (pas 20)\n$result = (2 + 3) * 4; // 20\n$result = 2 ** 3 * 4; // 32 (2^3 = 8, puis 8*4)\n$result = true || false && false; // true (AND prioritaire)',
                'details' => 'C\'est comme en maths : la multiplication avant l\'addition ! 2 + 3 * 4 = 14 (pas 20). Les parenthèses sont toujours les plus fortes. Ordre général : ** (puissance) > * / % > + - > comparaisons (==, <, >, etc.) > && (ET) > || (OU). PIÈGE : le ternaire (? :) en PHP s\'évalue bizarrement de gauche à droite... mets TOUJOURS des parenthèses si tu en imbriques plusieurs ! Autre piège : && est plus prioritaire que and, || que or... utilise toujours && et || pour éviter les surprises. En cas de doute : mets des parenthèses, ton code sera plus clair !',
                'useCases' => [
                    'Calculs mathématiques : $total = $price * $qty + $tax comprendre ordre',
                    'Conditions complexes : $valid = $a && $b || $c && $d (parenthéser si ambigu)',
                    'Affectations conditionnelles : $x = $y = $z ?? 10 (associativité droite)',
                    'Bit manipulation : $flags = FLAG_A | FLAG_B & MASK (parenthéser)',
                    'Débogage : comprendre pourquoi expression donne résultat inattendu',
                    'Code review : identifier expressions ambiguës nécessitant parenthèses'
                ],
                'warnings' => [
                    'Ternaire associe à gauche en PHP (différent Java/C) : parenthéser impérativement',
                    'and/or vs &&/|| piège classique : $x = true && false différent de $x = true and false',
                    'Concaténation (.) même priorité que +/- : "3" + 2 . "5" peut surprendre',
                    'Associativité pas toujours intuitive : vérifier documentation si doute'
                ],
                'bestPractices' => [
                    'En cas de doute : TOUJOURS parenthéser pour clarté et maintenabilité',
                    'Préférer &&/||/! aux and/or/not pour éviter surprises de priorité',
                    'Expressions complexes : découper en variables intermédiaires nommées',
                    'Code review : signaler expressions sans parenthèses si moindre ambiguïté',
                    'Utiliser linter/formatter configuré pour forcer parenthèses sur cas ambigus'
                ],
                'resources' => [
                    ['label' => 'Précédence des opérateurs', 'url' => 'https://www.php.net/manual/fr/language.operators.precedence.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-operateurs_logiques', 'label' => 'Opérateurs logiques'],
                    ['id' => 'modal-operateurs_arithmetiques', 'label' => 'Opérateurs arithmétiques'],
                    ['id' => 'modal-operateurs_ternaire', 'label' => 'Opérateur ternaire']
                ]
            ],
            'operateurs_type' => [
                'description' => 'Opérateurs liés aux types : instanceof, cast, is_*() pour la vérification et conversion de types.',
                'example' => '$var = "123";\n$int = (int) $var; // Cast vers entier\n$bool = (bool) $var; // Cast vers booléen\nvar_dump(is_string($var)); // true\nvar_dump(is_numeric($var)); // true',
                'details' => 'Tu peux forcer la transformation d\'une variable avec les "cast" : (int)$x transforme en nombre, (string)$x en texte, (bool)$x en vrai/faux, (array)$x en tableau. ATTENTION, ça peut perdre des infos : (int)4.9 donne 4 (pas 5 !). Pour vérifier le type sans modifier, utilise les fonctions is_int(), is_string(), is_array(), is_bool(), is_numeric(), etc. Pour les objets, on a déjà vu instanceof. Astuce moderne : utilise plutôt les "type hints" dans tes fonctions (function truc(int $x): string) et ajoute declare(strict_types=1) en haut du fichier... PHP vérifiera tout automatiquement !',
                'useCases' => [
                    'Validation entrées : if (is_numeric($_GET["id"])) $id = (int)$_GET["id"]',
                    'Conversion API : $json = (array)json_decode($data) pour forcer array',
                    'Vérifications polymorphiques : instanceof pour duck typing orienté objet',
                    'Normalisation données : (string)$value pour uniformiser types en string',
                    'Type hints runtime : if (!is_callable($callback)) throw new TypeError',
                    'Sérialisation : (array)$object pour convertir objet en tableau associatif'
                ],
                'warnings' => [
                    'Cast peut perdre données : (int)4.9 donne 4, pas arrondi',
                    '(bool) valeurs falsy : 0, "0", "", [], null deviennent false',
                    'Cast (array) sur objet : résultats peuvent être inattendus avec propriétés privées',
                    '(unset) déprécié PHP 7.2+, supprimé PHP 8.0 : utiliser unset() fonction'
                ],
                'bestPractices' => [
                    'Préférer type hints natifs (function(int $x): string) au cast manuel',
                    'Utiliser fonctions dédiées : intval(), floatval(), strval() plus explicites',
                    'Valider avant cast : vérifier is_numeric() avant (int) pour éviter surprises',
                    'declare(strict_types=1) en tête de fichier pour sécurité type',
                    'Pour objets, préférer instanceof à is_object() + vérifications manuelles'
                ],
                'resources' => [
                    ['label' => 'Manipulation de types', 'url' => 'https://www.php.net/manual/fr/language.types.type-juggling.php', 'icon' => '📖'],
                    ['label' => 'Fonctions de types', 'url' => 'https://www.php.net/manual/fr/ref.var.php', 'icon' => '🔧']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-operateurs_instanceof', 'label' => 'instanceof'],
                    ['id' => 'modal-operateurs_comparaison', 'label' => 'Opérateurs de comparaison'],
                    ['id' => 'modal-operateurs_affectation', 'label' => 'Opérateurs d\'affectation']
                ]
            ],
        ];

        return $this->render('operateurs/index.html.twig', [
            'data' => $dataOperateursPHP,
        ]);
    }
}
