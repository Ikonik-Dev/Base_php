<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class StructureControleController extends AbstractController
{
    #[Route('/structure/controle', name: 'app_structure_controle')]
    public function index(): Response
    {

        // Données complètes sur les structures de contrôle PHP : conditions, boucles, match, switch, include/require, gestion d'erreurs et structures modernes PHP 7/8
        $dataStructuresControlePHP = [
            'structures_conditionnelles' => [
                'description' => 'Structures pour exécuter du code selon des conditions : if, else, elseif, switch avec syntaxes alternatives.',
                'example' => 'if ($age >= 18) {\n    echo "Majeur";\n} elseif ($age >= 16) {\n    echo "Mineur émancipé";\n} else {\n    echo "Mineur";\n}',
                'details' => 'Les structures conditionnelles permettent d\'exécuter du code selon la véracité de conditions. PHP offre plusieurs structures : if/else/elseif pour tests booléens, switch pour comparaisons multiples, match (PHP 8+) pour pattern matching strict. Les conditions sont évaluées en contexte booléen : 0, "0", "", null, false, [] sont falsy. Deux syntaxes disponibles : accolades {} pour code PHP pur, ou syntaxe alternative (if: endif;) pour templates mixant PHP et HTML. elseif peut s\'écrire "elseif" ou "else if" (équivalents). Les conditions sont évaluées séquentiellement, la première vraie est exécutée, les autres ignorées. Imbrication possible mais attention à la lisibilité.',
                'useCases' => [
                    'Validation utilisateurs : if ($user->isAdmin()) afficher options admin',
                    'Traitement formulaires : if ($_SERVER["REQUEST_METHOD"] === "POST") traiter',
                    'Affichage conditionnel : <?php if ($connected): ?> menu utilisateur <?php endif; ?>',
                    'Logique métier : if ($stock > 0 && $price <= $budget) permettre achat',
                    'Gestion permissions : if ($user->can("edit")) afficher bouton édition',
                    'Configuration : if (APP_ENV === "dev") activer debug toolbar'
                ],
                'warnings' => [
                    'Éviter comparaisons lâches (==) pour booléens : "0" == false est true',
                    'Attention aux valeurs falsy imprévues : empty("0") retourne true',
                    'Conditions complexes illisibles : extraire dans variables nommées',
                    'Imbrications profondes (> 3 niveaux) : refactorer en fonctions'
                ],
                'bestPractices' => [
                    'Préférer early returns : if (!$valid) return; plutôt que else imbriqués',
                    'Utiliser === pour comparaisons strictes évitant jonglage de types',
                    'Extraire conditions complexes : $canEdit = $isOwner && !$isLocked;',
                    'Guard clauses en début de fonction pour valider préconditions',
                    'Match (PHP 8) pour alternatives multiples strictes et concises'
                ],
                'resources' => [
                    ['title' => 'Structures de contrôle', 'url' => 'https://www.php.net/manual/fr/language.control-structures.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-condition_if_else', 'label' => 'if/else/elseif'],
                    ['id' => 'modal-structure_switch', 'label' => 'Switch'],
                    ['id' => 'modal-expression_match_php8', 'label' => 'Match (PHP 8)']
                ]
            ],
            'condition_if_else' => [
                'description' => 'Structure conditionnelle de base avec if, else et elseif. Supporte la syntaxe alternative avec deux points.',
                'example' => '// Syntaxe classique\nif ($condition) {\n    // code\n}\n\n// Syntaxe alternative\nif ($condition):\n    // code\nendif;',
                'details' => 'La structure if/else/elseif est la base du contrôle conditionnel en PHP. Syntaxe : if (condition) { code }. La condition est évaluée en booléen : valeurs falsy (0, "", "0", null, false, []) considérées false. else exécute si condition if false. elseif teste conditions additionnelles séquentiellement. Deux syntaxes : accolades pour code PHP, ou if: endif; pour templates (mélange PHP/HTML). elseif s\'écrit aussi "else if" (2 mots, équivalent). Évaluation court-circuit : première condition vraie exécutée, reste ignoré. Imbrication possible mais favorise complexité. Utilisable dans expressions (assignation : $x = if ($a) $b else $c en PHP 8.3+).',
                'useCases' => [
                    'Validation entrées : if (empty($email)) erreur "Email requis"',
                    'Authentification : if (!$user->isLoggedIn()) redirect login',
                    'Niveaux multiples : if ($score >= 90) A elseif ($score >= 80) B else C',
                    'Templates : <?php if ($items): ?> liste <?php else: ?> vide <?php endif; ?>',
                    'Guard clauses : if ($invalid) { return error; } // puis code normal',
                    'Permissions : if ($user->hasRole("admin")) show admin panel'
                ],
                'warnings' => [
                    'Conditions imbriquées > 3 niveaux deviennent illisibles rapidement',
                    'Oublier accolades pour instructions multiples cause bugs subtils',
                    'Comparaison == vs === : if ($count == "0") vrai même si $count === 0',
                    'else if (2 mots) différent de elseif dans certains contextes rares'
                ],
                'bestPractices' => [
                    'Toujours utiliser accolades même pour 1 ligne : if ($x) { $y = 1; }',
                    'Early returns : if (!$valid) return error; puis logique normale',
                    'Conditions positives plus lisibles : if ($isValid) pas if (!$isInvalid)',
                    'Extraire conditions : $isEligible = $age >= 18 && $hasLicense;',
                    'Syntaxe alternative uniquement dans templates, accolades en logique'
                ],
                'resources' => [
                    ['title' => 'if/elseif/else', 'url' => 'https://www.php.net/manual/fr/control-structures.if.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-structures_conditionnelles', 'label' => 'Structures conditionnelles'],
                    ['id' => 'modal-operateur_ternaire_moderne', 'label' => 'Opérateur ternaire'],
                    ['id' => 'modal-structures_alternatives', 'label' => 'Syntaxes alternatives']
                ]
            ],
            'operateur_ternaire_moderne' => [
                'description' => 'Opérateurs ternaires classiques et modernes : ternaire simple, null coalescing (??) et null coalescing assignment (??=).',
                'example' => '$statut = $age >= 18 ? "majeur" : "mineur";\n$nom = $_GET[\'nom\'] ?? "Anonyme";\n$config[\'debug\'] ??= false; // PHP 7.4+',
                'details' => 'Les opérateurs ternaires offrent conditions concises retournant valeurs. Ternaire classique : condition ? siVrai : siFaux. Version courte (PHP 5.3+) : expr1 ?: expr2 (retourne expr1 si truthy, sinon expr2). Null coalescing ?? (PHP 7.0) : retourne premier opérande non-null, sans notice si variable inexistante. ??= (PHP 7.4) : assigne si variable null/inexistante. Différences cruciales : ternaire teste truthiness (0, "" sont falsy), ?? teste uniquement null. Ternaire associe à gauche en PHP (parenthéser si imbriqué). Préférer ?? pour valeurs par défaut, ternaire pour choix binaires. Lisibilité : éviter imbrications, extraire en if/else si complexe.',
                'useCases' => [
                    'Affichage conditionnel : echo $logged ? "Bienvenue" : "Connexion";',
                    'Valeurs par défaut : $limit = $_GET["limit"] ?? 10;',
                    'Initialisation paresseuse : $cache ??= loadCache(); // charge si besoin',
                    'Classes CSS : class="<?= $active ? "active" : "" ?>"',
                    'Configuration : $debug = $config["debug"] ?? false;',
                    'Fallback chaîné : $name = $user->name ?? $default->name ?? "Guest";'
                ],
                'warnings' => [
                    'Ternaires imbriqués illisibles : $x = $a ? $b ? $c : $d : $e (éviter)',
                    'Associativité gauche PHP différente autres langages : parenthéser',
                    '?? ne détecte pas "" ou 0 : $_GET["page"] ?? 1 retourne "" si page=""',
                    'Forme courte ?: risquée avec 0/"0"/false : 0 ?: 10 donne 10'
                ],
                'bestPractices' => [
                    'Préférer ?? pour valeurs nullables, ternaire pour booléens',
                    'Une ligne maximum : si complexe, utiliser if/else',
                    'Parenthéser si moindre ambiguïté : ($a ? $b : $c) ?: $d',
                    'Nommer variables : $isValid = check(); $msg = $isValid ? "OK" : "KO";',
                    '??= excellent pour initialisation : $cache ??= expensive();'
                ],
                'resources' => [
                    ['title' => 'Opérateur ternaire', 'url' => 'https://www.php.net/manual/fr/language.operators.comparison.php#language.operators.comparison.ternary', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-condition_if_else', 'label' => 'if/else/elseif'],
                    ['id' => 'modal-structures_conditionnelles', 'label' => 'Structures conditionnelles']
                ]
            ],
            'structure_switch' => [
                'description' => 'Structure switch pour comparer une variable à plusieurs valeurs. Attention aux break et au fall-through.',
                'example' => 'switch ($jour) {\n    case \'lundi\':\n    case \'mardi\':\n        echo "Début de semaine";\n        break;\n    case \'vendredi\':\n        echo "TGIF!";\n        break;\n    default:\n        echo "Autre jour";\n}',
                'details' => 'La structure switch compare une expression à plusieurs valeurs avec case. Utilise comparaison lâche (==) pas stricte (===). Syntaxe : switch (expr) { case val: code; break; default: code; }. break obligatoire pour éviter fall-through (exécution cases suivants). Fall-through volontaire possible : cases consécutifs sans break partagent code. default optionnel, exécuté si aucun case. Comparaison séquentielle : teste chaque case dans l\'ordre. Valeurs case doivent être constantes (littéraux, constantes) pas variables. Syntaxe alternative : switch(): endswitch; pour templates. Performance : switch souvent plus rapide que multiples if/elseif pour > 3 comparaisons. PHP 8 : préférer match pour strictness et retour valeur.',
                'useCases' => [
                    'États/statuts : switch ($order->status) case "pending": case "shipped"',
                    'Types MIME : switch ($ext) case "jpg": case "png": type image',
                    'Codes HTTP : switch ($code) case 200: success case 404: not found',
                    'Jours semaine : switch (date("N")) case 1: lundi case 7: dimanche',
                    'Menus navigation : switch ($page) case "home": case "about": afficher',
                    'Fall-through : case "A": case "B": case "C": traitement commun ABC'
                ],
                'warnings' => [
                    'Oublier break cause fall-through inattendu : bugs subtils',
                    'Comparaison lâche == : switch(0) case "texte" match (jonglage)',
                    'Ne peut pas utiliser expressions complexes dans case (constantes seules)',
                    'default au milieu possible mais déroutant : mettre en fin par convention'
                ],
                'bestPractices' => [
                    'Toujours mettre break sauf fall-through voulu (documenter)',
                    'default en dernier par convention même si position libre',
                    'Pour strictness, préférer match (PHP 8) ou if/elseif avec ===',
                    'Extraire logique complexe de case dans fonctions : case X: handleX();',
                    'Si > 5-7 cases, considérer pattern strategy ou tableau de callbacks'
                ],
                'resources' => [
                    ['title' => 'Switch', 'url' => 'https://www.php.net/manual/fr/control-structures.switch.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-expression_match_php8', 'label' => 'Match (PHP 8)'],
                    ['id' => 'modal-structures_conditionnelles', 'label' => 'Structures conditionnelles'],
                    ['id' => 'modal-condition_if_else', 'label' => 'if/else/elseif']
                ]
            ],
            'expression_match_php8' => [
                'description' => 'Expression match (PHP 8.0+) : alternative moderne au switch, plus stricte et qui retourne une valeur.',
                'example' => '$resultat = match($status) {\n    200, 300 => "Succès",\n    400 => "Erreur client",\n    500 => "Erreur serveur",\n    default => "Statut inconnu"\n};\n\n$type = match(true) {\n    $age < 13 => "enfant",\n    $age < 18 => "adolescent",\n    default => "adulte"\n};',
                'details' => 'L\'expression match (PHP 8.0+) est alternative moderne à switch avec différences clés. Utilise comparaison stricte (===) pas lâche. Retourne toujours une valeur (expression, pas statement). Pas de fall-through : un seul bras exécuté. Virgules pour valeurs multiples : 200, 201 => "OK". Lance UnhandledMatchError si aucun match et pas de default. Syntaxe concise : match (expr) { val => result }. Supporte match(true) pour conditions booléennes (alternative if/elseif). Pas de break nécessaire. Arms évalués paresseusement : seul le matching exécuté. Pattern matching simple : PHP 8.0 valeurs, évolutions futures possibles (destructuring). Plus sûr que switch grâce à exhaustivité obligatoire.',
                'useCases' => [
                    'HTTP codes : $msg = match($code) { 200 => "OK", 404 => "Not Found" }',
                    'Conversion types : $type = match($val) { 1, 2, 3 => "petit", ... }',
                    'Conditions booléennes : match(true) { $x > 10 => "grand", ... }',
                    'États : $next = match($state) { "pending" => "processing", ... }',
                    'Configuration : $env = match(APP_ENV) { "prod" => prodConfig(), ... }',
                    'Mapping : $icon = match($type) { "pdf" => "📄", "img" => "🖼️", ... }'
                ],
                'warnings' => [
                    'UnhandledMatchError si pas de default et aucun match (exception)',
                    'Comparaison stricte : match(0) { "0" => ... } ne match PAS',
                    'Pas de fall-through volontaire : dupliquer code ou extraire fonction',
                    'Syntaxe => obligatoire, pas de : comme switch'
                ],
                'bestPractices' => [
                    'Toujours inclure default ou garantir exhaustivité des cas',
                    'Préférer match à switch pour pattern matching et sûreté types',
                    'Extraire expressions complexes : $result = match($x) { ... }; puis utiliser',
                    'match(true) excellent pour remplacer if/elseif chains',
                    'Documenter cas intentionnellement non couverts si pas de default'
                ],
                'resources' => [
                    ['title' => 'Match Expression', 'url' => 'https://www.php.net/manual/fr/control-structures.match.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-structure_switch', 'label' => 'Switch'],
                    ['id' => 'modal-structures_conditionnelles', 'label' => 'Structures conditionnelles'],
                    ['id' => 'modal-condition_if_else', 'label' => 'if/else/elseif']
                ]
            ],
            'boucles_for' => [
                'description' => 'Boucle for classique avec initialisation, condition et incrémentation. Idéale pour un nombre d\'itérations connu.',
                'example' => 'for ($i = 0; $i < 10; $i++) {\n    echo $i . " ";\n}\n\n// Syntaxe alternative\nfor ($i = 0; $i < 10; $i++):\n    echo $i;\nendfor;',
                'details' => 'La boucle for exécute code un nombre déterminé de fois. Syntaxe : for (init; condition; increment) { code }. Trois parties : initialisation ($i=0, exécutée une fois), condition (testée chaque itération, continue si true), incrément (exécuté après chaque itération). Toutes parties optionnelles : for (;;) boucle infinie. Multiple init/increment possibles : for ($i=0, $j=10; $i<$j; $i++, $j--). Syntaxe alternative : for(): endfor; pour templates. Portée variables : $i accessible après boucle (garde dernière valeur). Performance : condition évaluée à chaque tour (extraire si coûteuse). Break/continue disponibles. Idéale quand nombre itérations connu à l\'avance.',
                'useCases' => [
                    'Itération numérique : for ($i = 0; $i < count; $i++) traiter élément i',
                    'Tableaux indexés : for ($i = 0; $i < count($arr); $i++) accès $arr[$i]',
                    'Génération séquences : for ($i = 1; $i <= 100; $i++) créer éléments',
                    'Pagination : for ($page = 1; $page <= $totalPages; $page++) lien',
                    'Coordonnées : for ($x=0; $x<width; $x++) for ($y=0; $y<height; $y++)',
                    'Comptes à rebours : for ($i = 10; $i >= 0; $i--) countdown'
                ],
                'warnings' => [
                    'Modifier compteur dans boucle cause comportements imprévisibles',
                    'Condition coûteuse réévaluée : for ($i=0; $i<strlen($s); $i++) inefficace',
                    'Boucles infinies si condition toujours vraie : for (;;) ou oubli incrément',
                    'Référence $i accessible après : for ($i=0; $i<3; $i++); echo $i; // 3'
                ],
                'bestPractices' => [
                    'Extraire condition coûteuse : $max = count($arr); for ($i=0; $i<$max; $i++)',
                    'Préférer foreach pour tableaux (plus lisible) sauf besoin index',
                    'Nommer compteurs : $i, $j, $k ou descriptifs ($row, $col)',
                    'Limite 2-3 niveaux imbrication : au-delà, extraire fonctions',
                    'Documenter boucles complexes : multi-init, conditions inhabituelles'
                ],
                'resources' => [
                    ['title' => 'Boucle for', 'url' => 'https://www.php.net/manual/fr/control-structures.for.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-boucles_while', 'label' => 'While/Do-While'],
                    ['id' => 'modal-boucles_foreach', 'label' => 'Foreach'],
                    ['id' => 'modal-controle_boucles', 'label' => 'Break/Continue']
                ]
            ],
            'boucles_while' => [
                'description' => 'Boucles while et do-while : while teste la condition avant, do-while teste après (au moins une exécution).',
                'example' => '$i = 0;\nwhile ($i < 5) {\n    echo $i++;\n}\n\n$j = 0;\ndo {\n    echo $j++;\n} while ($j < 3);',
                'details' => 'Les boucles while exécutent code tant que condition vraie. while teste AVANT itération : si condition initialement false, code jamais exécuté. do-while teste APRÈS : code exécuté au moins une fois. Syntaxe while : while (condition) { code }. Syntaxe do-while : do { code } while (condition);. Alternative : while(): endwhile; pour templates. Condition réévaluée chaque itération. Risque boucle infinie si condition jamais false. Break/continue disponibles. while plus flexible que for : nombre itérations inconnu (lecture fichier, attente événement). do-while rare mais utile pour menus (afficher puis redemander) ou validation (demander jusqu\'à valide).',
                'useCases' => [
                    'Lecture fichiers : while ($line = fgets($file)) traiter ligne',
                    'Attente conditions : while (!$ready) sleep(1); attendre',
                    'Parsing : while ($token = getNextToken()) analyser',
                    'Menus : do { afficherMenu(); $choix = lire(); } while ($choix !== "quit")',
                    'Validation : do { $input = ask(); } while (!isValid($input))',
                    'Serveurs : while (true) { $request = listen(); handle($request); }'
                ],
                'warnings' => [
                    'Boucles infinies : while (true) sans break ou condition jamais false',
                    'Modifier condition externe : while ($x < 10) mais $x jamais incrémenté',
                    'do-while oubli point-virgule final : do {} while (condition); requis',
                    'Conditions complexes difficiles à suivre : extraire en variables'
                ],
                'bestPractices' => [
                    'Garantir progression vers condition false : incrément, changement état',
                    'Limiter complexité condition : $hasMore = check(); while ($hasMore)',
                    'Préférer for si nombre itérations connu, while si inconnu',
                    'do-while : utiliser quand au moins 1 exécution toujours nécessaire',
                    'Timeout/limites sécurité : $attempts = 0; while ($trying && $attempts++ < 100)'
                ],
                'resources' => [
                    ['title' => 'While', 'url' => 'https://www.php.net/manual/fr/control-structures.while.php', 'icon' => '📖'],
                    ['title' => 'Do-While', 'url' => 'https://www.php.net/manual/fr/control-structures.do.while.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-boucles_for', 'label' => 'Boucle for'],
                    ['id' => 'modal-boucles_foreach', 'label' => 'Foreach'],
                    ['id' => 'modal-controle_boucles', 'label' => 'Break/Continue']
                ]
            ],
            'boucles_foreach' => [
                'description' => 'Boucle foreach pour parcourir tableaux et objets. Accès aux clés et valeurs, par référence possible.',
                'example' => '$fruits = ["pomme", "banane", "orange"];\n\n// Valeurs seulement\nforeach ($fruits as $fruit) {\n    echo $fruit;\n}\n\n// Clés et valeurs\nforeach ($fruits as $index => $fruit) {\n    echo "$index: $fruit";\n}\n\n// Par référence\nforeach ($fruits as &$fruit) {\n    $fruit = strtoupper($fruit);\n}',
                'details' => 'La boucle foreach parcourt tableaux et objets implémentant Iterator. Deux formes : foreach ($arr as $val) pour valeurs seules, foreach ($arr as $key => $val) pour clés et valeurs. Référence : foreach ($arr as &$val) permet modifier tableau original. Important : unset($val) après foreach par référence pour éviter effets bord. Objets : traverse propriétés publiques par défaut, ou méthodes Iterator. Syntaxe alternative : foreach(): endforeach; templates. PHP 7+ : list() dans foreach pour destructuring : foreach ($pairs as [$a, $b]). Copie interne du tableau (pointeur) : modifications pendant foreach possibles mais déconseillées. Plus lisible que for pour tableaux.',
                'useCases' => [
                    'Affichage listes : foreach ($users as $user) echo $user->name',
                    'Transformation : foreach ($items as &$item) $item = transform($item)',
                    'Génération HTML : foreach ($products as $product) render($product)',
                    'Clés associatives : foreach ($config as $key => $value) set($key, $value)',
                    'Destructuring : foreach ($coords as [$x, $y]) plot($x, $y)',
                    'Objets Iterator : foreach ($generator as $item) process($item)'
                ],
                'warnings' => [
                    'Référence non unset : $val reste référence après, modif ultérieures affectent tableau',
                    'Modifier tableau pendant foreach : comportement indéfini, éviter',
                    'Référence sur tableau temporaire : foreach (func() as &$v) interdit',
                    'Clé réutilisée : foreach ($a as $k=>$v) foreach ($b as $k=>$v) $k écrasé'
                ],
                'bestPractices' => [
                    'Toujours unset($val) après foreach par référence',
                    'Nommer variables : $user, $product, pas $x, $y génériques',
                    'Préférer array_map/filter pour transformations fonctionnelles',
                    'Référence uniquement si modification nécessaire, sinon valeurs',
                    'Clés descriptives : foreach ($data as $userId => $userData)'
                ],
                'resources' => [
                    ['title' => 'Foreach', 'url' => 'https://www.php.net/manual/fr/control-structures.foreach.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-boucles_for', 'label' => 'Boucle for'],
                    ['id' => 'modal-boucles_while', 'label' => 'While/Do-While'],
                    ['id' => 'modal-controle_boucles', 'label' => 'Break/Continue']
                ]
            ],
            'controle_boucles' => [
                'description' => 'Instructions de contrôle des boucles : break (sortir), continue (passer à l\'itération suivante), avec niveaux optionnels.',
                'example' => 'for ($i = 0; $i < 10; $i++) {\n    if ($i === 3) continue; // Passer 3\n    if ($i === 7) break;    // Arrêter à 7\n    echo $i;\n}\n\n// Avec niveaux\nfor ($i = 0; $i < 3; $i++) {\n    for ($j = 0; $j < 3; $j++) {\n        if ($j === 1) break 2; // Sortir des 2 boucles\n    }\n}',
                'details' => 'Les instructions break et continue contrôlent flux des boucles. break sort immédiatement de la boucle englobante, exécution continue après. continue passe à l\'itération suivante, ignorant code restant du corps. Niveaux optionnels : break 2 sort de 2 boucles imbriquées, continue 3 passe itération 3 niveaux au-dessus. Utilisables dans for, while, do-while, foreach, switch (break). Sans niveau : break/continue = break 1/continue 1. Niveaux > 1 rares, souvent signe code complexe nécessitant refactoring. PHP 5.4+ interdit variables comme niveaux : break $n invalide, constantes seules. Alternative goto pour sorties multi-niveaux mais déconseillé.',
                'useCases' => [
                    'Recherche : foreach ($items as $item) if (found($item)) break;',
                    'Validation : foreach ($data as $val) if (!valid($val)) continue;',
                    'Filtrage : for ($i=0; $i<$n; $i++) if (skip($i)) continue; process()',
                    'Sortie multiple : for () { for () { if (condition) break 2; } }',
                    'Switch : switch ($x) { case A: if ($special) break; doA(); break; }',
                    'Parsing : while (hasTokens()) if (isComment()) continue; parse();'
                ],
                'warnings' => [
                    'break/continue dans switch affecte switch pas boucle englobante',
                    'Niveaux > 2 illisibles : break 4 difficile à maintenir',
                    'break dans include inclus : sort du include, pas boucle appelante',
                    'continue dans switch équivaut break : sortir switch, pas itération'
                ],
                'bestPractices' => [
                    'Préférer return early dans fonctions à break/continue complexes',
                    'Limite 1-2 niveaux break/continue : au-delà, refactorer',
                    'Extraire logique : if (shouldSkip()) continue; clarifier intention',
                    'Éviter break/continue profonds : extraire en fonctions dédiées',
                    'Documenter break N où N > 1 : // sort des boucles x et y'
                ],
                'resources' => [
                    ['title' => 'Break', 'url' => 'https://www.php.net/manual/fr/control-structures.break.php', 'icon' => '📖'],
                    ['title' => 'Continue', 'url' => 'https://www.php.net/manual/fr/control-structures.continue.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-boucles_for', 'label' => 'Boucle for'],
                    ['id' => 'modal-boucles_while', 'label' => 'While/Do-While'],
                    ['id' => 'modal-boucles_foreach', 'label' => 'Foreach']
                ]
            ],
            'include_require' => [
                'description' => 'Inclusion de fichiers : include/require (erreur non fatale/fatale) et leurs variantes _once pour éviter les doublons.',
                'example' => 'include "config.php";        // Warning si échec\nrequire "database.php";     // Fatal error si échec\ninclude_once "functions.php"; // Une seule fois\nrequire_once "classes.php";   // Une seule fois + fatal',
                'details' => 'Les instructions include/require insèrent contenu d\'un fichier. Différences : include génère warning si échec (continue), require fatal error (arrêt). Variantes _once vérifient si déjà inclus (via chemin absolu), évitent doublons. Syntaxe : include "file.php" ou include("file.php") équivalents. Retourne valeur si fichier contient return. Cherche dans include_path puis dossier courant/script. Chemins relatifs, absolus, URLs (si allow_url_include). Scope : variables fichier inclus héritent scope inclusion. Performance : require_once légèrement plus lent (vérification). Modern PHP : autoloading (PSR-4) préféré aux includes manuels classes. Include utile : configuration, templates, parties réutilisables.',
                'useCases' => [
                    'Configuration : require_once __DIR__ . "/config.php"; charger une fois',
                    'Templates : include "templates/header.php"; réutiliser HTML',
                    'Fonctions : include_once "helpers.php"; utilitaires partagés',
                    'Autoloading : spl_autoload_register() remplace require classes manuels',
                    'Routing : include "routes/$page.php"; charger page dynamiquement',
                    'Fallback : @include "optional.php" or defaultConfig(); si optionnel'
                ],
                'warnings' => [
                    'Inclusion de fichiers utilisateur : faille LFI (Local File Inclusion)',
                    'Chemins relatifs fragiles : préférer __DIR__ ou chemins absolus',
                    'include_once sur même fichier noms différents : peut dupliquer',
                    'Scope variables : fichier inclus voit variables locales du scope'
                ],
                'bestPractices' => [
                    'require_once pour dépendances critiques (config, classes)',
                    'include pour templates optionnels avec fallback',
                    'Toujours utiliser chemins absolus : __DIR__ . "/relative/path.php"',
                    'Autoloading PSR-4 pour classes, include pour config/templates',
                    'Valider/sanitizer chemins avant inclusion dynamique'
                ],
                'resources' => [
                    ['title' => 'Include', 'url' => 'https://www.php.net/manual/fr/function.include.php', 'icon' => '📖'],
                    ['title' => 'Require', 'url' => 'https://www.php.net/manual/fr/function.require.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-structures_alternatives', 'label' => 'Syntaxes alternatives'],
                    ['id' => 'modal-try_catch_finally', 'label' => 'Try/Catch']
                ]
            ],
            'try_catch_finally' => [
                'description' => 'Gestion d\'exceptions avec try/catch/finally. Multiple catch possibles, finally toujours exécuté (PHP 5.5+).',
                'example' => 'try {\n    $pdo = new PDO($dsn, $user, $pass);\n    // code risqué\n} catch (PDOException $e) {\n    echo "Erreur BDD: " . $e->getMessage();\n} catch (Exception $e) {\n    echo "Erreur générale: " . $e->getMessage();\n} finally {\n    echo "Nettoyage";\n}',
                'details' => 'Le bloc try/catch/finally gère exceptions. try contient code risqué. catch intercepte exceptions type spécifique. finally (PHP 5.5+) exécuté toujours, exception ou non. Multiple catch : ordre spécifique → général (hiérarchie classes). PHP 7.1+ : catch (Ex1 | Ex2 $e) pour types multiples. catch sans variable (PHP 8.0+) : catch (Exception). finally utile pour nettoyage (fermer fichiers, connexions). Exception non catchée remonte pile jusqu\'à gestionnaire global ou fatal error. Exceptions objets héritant Throwable (PHP 7+) : Exception pour applicatif, Error pour PHP interne. Retour dans finally écrase retour try/catch.',
                'useCases' => [
                    'Base données : try { query() } catch (PDOException) logger erreur',
                    'Fichiers : try { fopen() } finally { fclose() } garantir fermeture',
                    'API externes : try { http() } catch (TimeoutException) retry',
                    'Transactions : try { begin(); process(); commit(); } catch rollback()',
                    'Validation : try { validate() } catch (ValidationException) afficher erreurs',
                    'Ressources : try { allocate() } finally { free() } libérer'
                ],
                'warnings' => [
                    'Catch générique (Exception) en premier masque exceptions spécifiques',
                    'Finally avec return écrase return try/catch : éviter',
                    'Exception non catchée : fatal error si pas gestionnaire global',
                    'Catch vide cache erreurs : toujours logger ou gérer'
                ],
                'bestPractices' => [
                    'Ordre catch : spécifique → général (PDOException avant Exception)',
                    'Finally pour nettoyage uniquement, pas logique métier',
                    'Logger exceptions : catch (Exception $e) log($e); puis throw ou handle',
                    'Exceptions spécifiques : catch types précis pas Exception générique',
                    'set_exception_handler() pour catch global non géré'
                ],
                'resources' => [
                    ['title' => 'Exceptions', 'url' => 'https://www.php.net/manual/fr/language.exceptions.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-throw_exceptions', 'label' => 'Throw/Exceptions'],
                    ['id' => 'modal-condition_if_else', 'label' => 'if/else/elseif']
                ]
            ],
            'throw_exceptions' => [
                'description' => 'Lancement d\'exceptions avec throw. Création d\'exceptions personnalisées héritant d\'Exception.',
                'example' => 'function diviser($a, $b) {\n    if ($b === 0) {\n        throw new InvalidArgumentException("Division par zéro!");\n    }\n    return $a / $b;\n}\n\nclass MonException extends Exception {\n    public function errorMessage() {\n        return "Erreur personnalisée: " . $this->getMessage();\n    }\n}',
                'details' => 'L\'instruction throw lance une exception, interrompant flux normal. Syntaxe : throw new ExceptionClass("message"). Objet doit implémenter Throwable (PHP 7+) : Exception (applicatif) ou Error (interne PHP). Exception standard : Exception, InvalidArgumentException, RuntimeException, LogicException, etc. Exceptions personnalisées héritent Exception ou sous-classes. Propriétés : $message, $code, $file, $line, $trace. Méthodes : getMessage(), getCode(), getFile(), getLine(), getTrace(), __toString(). PHP 8.0 : throw expression (assignable) : $val = $x ?? throw new Exception(). Exception remonte pile jusqu\'à catch correspondant ou fatal error.',
                'useCases' => [
                    'Validation : if (!$valid) throw new InvalidArgumentException("Invalid")',
                    'État invalide : if ($closed) throw new RuntimeException("Already closed")',
                    'Préconditions : if (!$user->can("edit")) throw new PermissionException()',
                    'Assertions : throw new AssertionError("Should not happen")',
                    'Domaine métier : throw new OrderCancelledException($orderId)',
                    'Null safety : return $value ?? throw new NotFoundException()'
                ],
                'warnings' => [
                    'Exceptions pour contrôle flux : anti-pattern, coûteux performance',
                    'Pas de finally après throw : exception remonte immédiatement',
                    'Throw dans destructeur : comportement indéfini, éviter',
                    'Messages exposant détails internes : risque sécurité'
                ],
                'bestPractices' => [
                    'Utiliser exceptions SPL appropriées : InvalidArgumentException, etc.',
                    'Exceptions métier personnalisées héritant Exception : OrderException',
                    'Messages descriptifs : "Email invalide: $email" pas juste "Invalid"',
                    'Tracer contexte : new Exception($msg, $code, $previous)',
                    'Documenter exceptions lancées : @throws dans docblocks'
                ],
                'resources' => [
                    ['title' => 'Throw', 'url' => 'https://www.php.net/manual/fr/language.exceptions.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-try_catch_finally', 'label' => 'Try/Catch'],
                    ['id' => 'modal-condition_if_else', 'label' => 'if/else/elseif']
                ]
            ],
            'goto_labels' => [
                'description' => 'Instruction goto pour sauter à un label (à éviter, nuit à la lisibilité). Utile dans de rares cas spécifiques.',
                'example' => '$i = 0;\nloop:\necho $i++;\nif ($i < 5) goto loop;\n\n// Sortie de boucles imbriquées\nfor ($i = 0; $i < 3; $i++) {\n    for ($j = 0; $j < 3; $j++) {\n        if ($condition) goto end;\n    }\n}\nend:\necho "Fin";',
                'details' => 'L\'instruction goto saute directement à un label défini. Syntaxe : label: et goto label;. Label doit être dans même fichier et contexte (pas traverser fonctions). goto saute en avant ou arrière mais pas dans/hors blocs try/catch/finally, boucles depuis extérieur. Considéré mauvaise pratique : rend code difficile à suivre, crée "spaghetti code". Utilisations légitimes rares : sortir de boucles profondément imbriquées, cleanup en C-style en PHP. Alternative préférable : fonctions, break avec niveaux, exceptions. PHP moderne déconseille goto sauf cas très spécifiques. Certains standards de code (PSR) interdisent goto.',
                'useCases' => [
                    'Sortie boucles profondes : for() { for() { if() goto end; } } end:',
                    'Cleanup unifié : error1: cleanup(); return; goto error1 depuis multiples points',
                    'State machine : state1: ... goto state2; state2: ... (mieux avec OOP)',
                    'Legacy C translation : portage code C utilisant goto massivement',
                    'Parsing complexe : goto nextToken; pour sauter états (mieux avec fonctions)',
                    'Tests extrêmes : tester comportements goto edge cases'
                ],
                'warnings' => [
                    'Illisible : flux non linéaire difficile à débugger et maintenir',
                    'Interdictions : pas dans/hors try/catch, fonctions, loops depuis extérieur',
                    'Standards : PSR et best practices déconseillent fortement',
                    'Alternatives meilleures : toujours préférer break, continue, return, exceptions'
                ],
                'bestPractices' => [
                    'ÉVITER sauf cas exceptionnel clairement documenté',
                    'Préférer break 2/3 pour sorties boucles multiples',
                    'Extraire en fonctions : return remplace goto pour sortie',
                    'Exceptions pour erreurs : throw remplace goto error',
                    'Si utilisé : documenter explicitement pourquoi nécessaire'
                ],
                'resources' => [
                    ['title' => 'Goto', 'url' => 'https://www.php.net/manual/fr/control-structures.goto.php', 'icon' => '⚠️']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-controle_boucles', 'label' => 'Break/Continue'],
                    ['id' => 'modal-try_catch_finally', 'label' => 'Try/Catch']
                ]
            ],
            'declare_directives' => [
                'description' => 'Directive declare pour modifier le comportement du script : strict_types, ticks, encoding.',
                'example' => 'declare(strict_types=1); // Types stricts\n\nfunction additionner(int $a, int $b): int {\n    return $a + $b;\n}\n\n// declare(ticks=1);\n// declare(encoding=\'UTF-8\');',
                'details' => 'La directive declare modifie comportement compilation/exécution. Syntaxe : declare(directive=value); en début de fichier ou bloc. Trois directives : strict_types (1 ou 0, mode strict types arguments/retours), ticks (entier, callback chaque N instructions bas niveau), encoding (string, encodage source). strict_types (PHP 7+) empêche jonglage automatique : additionner("2", 3) erreur si strict. Portée : fichier entier si en début, bloc si dans {}. declare() sans bloc affecte reste fichier. ticks rarement utilisé (profiling, signaux). encoding obsolète, UTF-8 standard. declare compatible namespaces : declare doit être avant/après.',
                'useCases' => [
                    'Types stricts : declare(strict_types=1); forcer sécurité types',
                    'Bibliothèques : strict_types dans librairies pour robustesse',
                    'Signaux : declare(ticks=1); pcntl_signal() gestionnaires Unix',
                    'Profiling : ticks avec register_tick_function() pour mesures',
                    'Legacy encoding : declare(encoding="ISO-8859-1"); vieux code',
                    'Tests : strict_types pour détecter erreurs types en TDD'
                ],
                'warnings' => [
                    'strict_types par fichier : doit être en PREMIÈRE instruction',
                    'ticks impact performance : callback fréquents ralentissent',
                    'encoding déprécié : PHP 7+ assume UTF-8 par défaut',
                    'strict_types non hérité : chaque fichier doit déclarer'
                ],
                'bestPractices' => [
                    'Toujours declare(strict_types=1) en première ligne fichiers modernes',
                    'Cohérence projet : tous fichiers strict_types ou aucun',
                    'ticks pour signaux seulement : register_tick_function() coûteux',
                    'UTF-8 sans BOM : encoding inutile si fichiers UTF-8 corrects',
                    'PSR-12 : strict_types dans ligne 2 (après <?php)'
                ],
                'resources' => [
                    ['title' => 'Declare', 'url' => 'https://www.php.net/manual/fr/control-structures.declare.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-structures_conditionnelles', 'label' => 'Structures conditionnelles']
                ]
            ],
            'return_yield' => [
                'description' => 'Instructions return (sortir de fonction) et yield (générateurs PHP 5.5+) pour retourner des valeurs de manière paresseuse.',
                'example' => 'function generateur() {\n    yield 1;\n    yield 2;\n    yield 3;\n}\n\nforeach (generateur() as $valeur) {\n    echo $valeur; // 1, 2, 3\n}\n\n// Yield avec clés\nfunction paires() {\n    yield \'a\' => 1;\n    yield \'b\' => 2;\n}',
                'details' => 'return termine fonction et retourne valeur. yield (PHP 5.5+) crée générateur : fonction pause et reprend, valeurs lazy. Générateur implémente Iterator : parcourable foreach. yield produit valeur, pause, reprend à next(). yield $key => $value pour clés. send() envoie valeurs au générateur. yield from (PHP 7) délègue sous-générateur. Avantages : mémoire (pas tableau complet), performance (calcul à la demande). Générateurs utiles : gros datasets, flux infinis, pipelines. return dans générateur (PHP 7+) : valeur finale via getReturn(). yield paresseux : valeur générée seulement si consommée.',
                'useCases' => [
                    'Gros fichiers : yield lignes sans charger fichier entier en mémoire',
                    'Séquences infinies : function count() { $i=0; while(true) yield $i++; }',
                    'Requêtes BDD : yield lignes une par une au lieu fetch_all()',
                    'Pipelines : function filter() { foreach ($src as $x) if ($valid) yield $x; }',
                    'Fibonacci : function fib() { yield 0; yield 1; while(true) yield $a+$b; }',
                    'Range : function range($s, $e) { for($i=$s; $i<=$e; $i++) yield $i; }'
                ],
                'warnings' => [
                    'Générateur non réutilisable : foreach 2x nécessite créer nouveau générateur',
                    'yield sans return valeur : getReturn() après itération complète seulement',
                    'send() complexe : communication bidirectionnelle avancée',
                    'État maintenu : variables générateur persistent entre yields'
                ],
                'bestPractices' => [
                    'Utiliser pour datasets volumineux évitant chargement mémoire',
                    'yield from pour composer générateurs : yield from otherGen();',
                    'Nommer clairement : function generateLines() pas process()',
                    'Documenter type yield : @return Generator|int[] items générés',
                    'Préférer array pour petits sets (< 1000), générateur pour gros'
                ],
                'resources' => [
                    ['title' => 'Générateurs', 'url' => 'https://www.php.net/manual/fr/language.generators.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-boucles_foreach', 'label' => 'Foreach'],
                    ['id' => 'modal-boucles_while', 'label' => 'While/Do-While']
                ]
            ],
            'structures_alternatives' => [
                'description' => 'Syntaxes alternatives des structures de contrôle avec deux points et mots-clés de fermeture (endif, endwhile, etc.).',
                'example' => '<?php if ($condition): ?>\n    <p>HTML mixé</p>\n<?php endif; ?>\n\n<?php foreach ($items as $item): ?>\n    <li><?= $item ?></li>\n<?php endforeach; ?>\n\n<?php while ($condition): ?>\n    <!-- contenu -->\n<?php endwhile; ?>',
                'details' => 'Les syntaxes alternatives remplacent accolades par deux-points et mots-clés fermeture. Structures concernées : if/elseif/else (endif), for (endfor), foreach (endforeach), while (endwhile), switch (endswitch). Syntaxe : structure(): ... end*;. Obligation point-virgule après end*. Utilisées principalement templates mixant PHP et HTML pour lisibilité. Comportement identique aux accolades. Imbrication possible : if(): foreach(): endforeach; endif;. PSR-1/2 recommandent accolades en logique, alternatives acceptables templates. Attention indentation : HTML entre balises PHP doit rester lisible. Alternative moderne : moteurs templates (Twig, Blade) évitent PHP direct.',
                'useCases' => [
                    'Templates : <?php if ($user): ?> <nav>menu</nav> <?php endif; ?>',
                    'Listes : <?php foreach ($items as $i): ?> <li><?=$i?></li> <?php endforeach; ?>',
                    'Conditions HTML : <?php if ($show): ?> <div>contenu</div> <?php else: ?> <p>vide</p> <?php endif; ?>',
                    'Boucles tables : <?php foreach ($rows as $r): ?> <tr>...</tr> <?php endforeach; ?>',
                    'Switch menu : <?php switch ($page): case "home": ?> ... <?php endswitch; ?>',
                    'Inclusion : <?php if (file_exists($f)): include $f; endif; ?>'
                ],
                'warnings' => [
                    'Oublier point-virgule après end* : erreur parse',
                    'Mélanger syntaxes : if() { ... endif; invalide, choisir une',
                    'Logique complexe : accolades plus lisibles hors templates',
                    'PSR : certains standards interdisent alternatives hors vues'
                ],
                'bestPractices' => [
                    'Templates uniquement : alternatives pour vues, accolades pour logique',
                    'Cohérence fichier : pas mélanger syntaxes dans même fichier',
                    'Indentation claire : aligner <?php et end* pour lisibilité',
                    'Moteurs modernes : préférer Twig/Blade pour nouveaux projets',
                    'PHP short tags : <?= $var ?> acceptable templates (PSR-1)'
                ],
                'resources' => [
                    ['title' => 'Syntaxes alternatives', 'url' => 'https://www.php.net/manual/fr/control-structures.alternative-syntax.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-condition_if_else', 'label' => 'if/else/elseif'],
                    ['id' => 'modal-boucles_foreach', 'label' => 'Foreach'],
                    ['id' => 'modal-include_require', 'label' => 'Include/Require']
                ]
            ],
        ];
        return $this->render('structure_controle/index.html.twig', [
            'data' => $dataStructuresControlePHP,
        ]);
    }
}
