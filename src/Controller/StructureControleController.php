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
                'details' => 'Comme un aiguillage de train : selon la condition, votre programme prend une voie ou une autre ! PHP vous offre plusieurs outils : if/else/elseif pour dire "si ça, alors fais ceci", switch pour comparer une valeur à plusieurs possibilités, et match (PHP 8+) pour faire pareil mais en plus strict. Important : PHP considère certaines valeurs comme "faux" (0, "", null, tableau vide...). Vous pouvez écrire avec des accolades {} ou avec if: endif; (plus lisible dans du HTML). La première condition vraie est exécutée, les autres sont ignorées.',
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
                    ['label' => 'Structures de contrôle', 'url' => 'https://www.php.net/manual/fr/language.control-structures.php', 'icon' => '📖']
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
                'details' => 'Le if/else est comme une question à choix : "SI cette condition est vraie, ALORS fais ça, SINON fais autre chose". Vous pouvez enchaîner avec elseif pour tester plusieurs conditions dans l\'ordre. PHP vérifie chaque condition une par une et s\'arrête à la première qui est vraie. Vous pouvez écrire avec des accolades {} (code PHP normal) ou avec if: endif; (dans des pages HTML). Attention : certaines valeurs sont considérées comme "faux" (0, texte vide "", null...). On peut aussi imbriquer des if dans des if, mais ça devient vite compliqué à lire !',
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
                    ['label' => 'if/elseif/else', 'url' => 'https://www.php.net/manual/fr/control-structures.if.php', 'icon' => '📖']
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
                'details' => 'Une version ultra-courte du if/else ! Au lieu d\'écrire plusieurs lignes, vous écrivez tout sur une ligne : condition ? siVrai : siFaux. Il y a aussi ?? pour dire "si cette variable n\'existe pas ou est vide, prends cette valeur par défaut" (super pratique !). Et même ??= pour dire "si la variable n\'a rien, mets cette valeur dedans". Différence importante : le ? regarde si c\'est vrai/faux (0 = faux), alors que ?? regarde seulement si ça existe ou pas. Attention à ne pas trop les imbriquer, ça devient illisible !',
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
                    ['label' => 'Opérateur ternaire', 'url' => 'https://www.php.net/manual/fr/language.operators.comparison.php#language.operators.comparison.ternary', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-condition_if_else', 'label' => 'if/else/elseif'],
                    ['id' => 'modal-structures_conditionnelles', 'label' => 'Structures conditionnelles']
                ]
            ],
            'structure_switch' => [
                'description' => 'Structure switch pour comparer une variable à plusieurs valeurs. Attention aux break et au fall-through.',
                'example' => 'switch ($jour) {\n    case \'lundi\':\n    case \'mardi\':\n        echo "Début de semaine";\n        break;\n    case \'vendredi\':\n        echo "TGIF!";\n        break;\n    default:\n        echo "Autre jour";\n}',
                'details' => 'Le switch est comme un grand panneau d\'aiguillage : vous testez une variable et selon sa valeur, vous allez vers le bon "case". IMPORTANT : il faut mettre "break;" sinon le code continue dans les cases suivants (effet domino pas toujours voulu !). Vous pouvez mettre plusieurs cases qui partagent le même code (comme "lundi" et "mardi" ensemble). "default:" c\'est le cas "si aucun autre cas ne correspond". Attention : switch utilise == (pas très strict), pas === ! Depuis PHP 8, il existe "match" qui est plus moderne et plus strict.',
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
                    ['label' => 'Switch', 'url' => 'https://www.php.net/manual/fr/control-structures.switch.php', 'icon' => '📖']
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
                'details' => 'Le grand frère moderne de switch, arrivé en PHP 8 ! Match est plus strict (utilise === au lieu de ==) et retourne toujours une valeur directement dans une variable. Pas besoin de break, pas d\'effet domino ! Vous pouvez mettre plusieurs valeurs avec des virgules : 200, 300 => "OK". Si aucune valeur ne correspond ET que vous n\'avez pas de "default:", PHP génère une erreur (il est strict !). Vous pouvez même l\'utiliser avec match(true) pour faire des conditions comme if/elseif, mais en version courte et élégante.',
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
                    ['label' => 'Match Expression', 'url' => 'https://www.php.net/manual/fr/control-structures.match.php', 'icon' => '📖']
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
                'details' => 'La boucle for, c\'est comme compter sur vos doigts : "je vais faire ça 10 fois". Elle a trois parties : où on commence ($i=0), jusqu\'où on va ($i < 10), et comment on avance ($i++). Vous pouvez tout laisser vide pour faire une boucle infinie : for(;;) (attention danger !). Le compteur $i reste accessible après la boucle avec sa dernière valeur. Vous pouvez utiliser break pour sortir de la boucle ou continue pour passer au tour suivant. Parfait quand vous savez d\'avance combien de fois répéter quelque chose.',
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
                    ['label' => 'Boucle for', 'url' => 'https://www.php.net/manual/fr/control-structures.for.php', 'icon' => '📖']
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
                'details' => 'While, c\'est "TANT QUE c\'est vrai, continue de faire ça". La condition est vérifiée AVANT chaque tour : si elle est fausse dès le début, le code ne s\'exécute jamais. Le do-while fait l\'inverse : il exécute le code d\'abord, PUIS vérifie la condition, donc le code s\'exécute au moins une fois. Attention danger : si votre condition reste toujours vraie, ça tourne à l\'infini ! Utilisez while quand vous ne savez pas combien de fois répéter (lire un fichier ligne par ligne, attendre quelque chose...). Le do-while est pratique pour les menus : afficher, puis redemander.',
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
                    ['label' => 'While', 'url' => 'https://www.php.net/manual/fr/control-structures.while.php', 'icon' => '📖'],
                    ['label' => 'Do-While', 'url' => 'https://www.php.net/manual/fr/control-structures.do.while.php', 'icon' => '📖']
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
                'details' => 'Foreach, c\'est LA boucle parfaite pour les tableaux ! Elle parcourt automatiquement chaque élément : "pour chaque fruit dans mon panier, fais ça". Deux versions : juste les valeurs (as $fruit), ou les clés ET valeurs (as $index => $fruit). Super pratique ! Vous pouvez même modifier le tableau en direct avec le & : foreach ($arr as &$item) - mais attention à faire unset($item) après pour éviter des surprises ! C\'est beaucoup plus lisible qu\'un for classique quand vous voulez juste parcourir un tableau.',
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
                    ['label' => 'Foreach', 'url' => 'https://www.php.net/manual/fr/control-structures.foreach.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-boucles_for', 'label' => 'Boucle for'],
                    ['id' => 'modal-boucles_while', 'label' => 'While/Do-While'],
                    ['id' => 'modal-controle_boucles', 'label' => 'Break/Continue'],
                    ['id' => 'modal-return_yield', 'label' => 'Return/Yield (générateurs)']
                ]
            ],
            'controle_boucles' => [
                'description' => 'Instructions de contrôle des boucles : break (sortir), continue (passer à l\'itération suivante), avec niveaux optionnels.',
                'example' => 'for ($i = 0; $i < 10; $i++) {\n    if ($i === 3) continue; // Passer 3\n    if ($i === 7) break;    // Arrêter à 7\n    echo $i;\n}\n\n// Avec niveaux\nfor ($i = 0; $i < 3; $i++) {\n    for ($j = 0; $j < 3; $j++) {\n        if ($j === 1) break 2; // Sortir des 2 boucles\n    }\n}',
                'details' => 'Deux commandes super pratiques dans les boucles : break = "STOP, on arrête tout de suite !" et continue = "passe au tour suivant sans finir celui-ci". Break sort complètement de la boucle, continue saute juste ce qui reste dans le tour actuel et passe au suivant. Vous pouvez même mettre un chiffre : break 2 sort de deux boucles imbriquées d\'un coup ! Mais attention, si vous en mettez trop (break 4, break 5...), ça devient illisible. À ce moment-là, c\'est mieux de faire des fonctions séparées.',
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
                    ['label' => 'Break', 'url' => 'https://www.php.net/manual/fr/control-structures.break.php', 'icon' => '📖'],
                    ['label' => 'Continue', 'url' => 'https://www.php.net/manual/fr/control-structures.continue.php', 'icon' => '📖']
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
                'details' => 'Include et require permettent de "copier-coller" le contenu d\'un autre fichier PHP dans votre code, comme assembler des briques Lego ! Différence : include c\'est "essaie, si ça marche pas tant pis on continue" (warning), require c\'est "ça DOIT marcher sinon on arrête tout" (erreur fatale). Les versions _once vérifient "on l\'a déjà inclus ? Si oui, on passe". Super utile pour configuration, morceaux de HTML réutilisables, fonctions partagées. En PHP moderne, on préfère l\'autoloading pour les classes, mais include/require reste pratique pour les templates !',
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
                    ['label' => 'Include', 'url' => 'https://www.php.net/manual/fr/function.include.php', 'icon' => '📖'],
                    ['label' => 'Require', 'url' => 'https://www.php.net/manual/fr/function.require.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-structures_alternatives', 'label' => 'Syntaxes alternatives'],
                    ['id' => 'modal-try_catch_finally', 'label' => 'Try/Catch']
                ]
            ],
            'try_catch_finally' => [
                'description' => 'Gestion d\'exceptions avec try/catch/finally. Multiple catch possibles, finally toujours exécuté (PHP 5.5+).',
                'example' => 'try {\n    $pdo = new PDO($dsn, $user, $pass);\n    // code risqué\n} catch (PDOException $e) {\n    echo "Erreur BDD: " . $e->getMessage();\n} catch (Exception $e) {\n    echo "Erreur générale: " . $e->getMessage();\n} finally {\n    echo "Nettoyage";\n}',
                'details' => 'Try/catch, c\'est comme un filet de sécurité ! Dans le bloc "try", vous mettez du code risqué (connexion base de données, lecture fichier...). Si ça plante, au lieu que tout s\'arrête, le "catch" attrape l\'erreur et vous pouvez la gérer proprement. Vous pouvez mettre plusieurs catch pour différents types d\'erreurs, du plus précis au plus général. Le "finally" (depuis PHP 5.5) s\'exécute TOUJOURS, qu\'il y ait eu erreur ou pas - super pour fermer des fichiers ou des connexions ! Si une erreur n\'est pas attrapée, elle remonte et fait planter le programme.',
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
                    ['label' => 'Exceptions', 'url' => 'https://www.php.net/manual/fr/language.exceptions.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-throw_exceptions', 'label' => 'Throw/Exceptions'],
                    ['id' => 'modal-condition_if_else', 'label' => 'if/else/elseif']
                ]
            ],
            'throw_exceptions' => [
                'description' => 'Lancement d\'exceptions avec throw. Création d\'exceptions personnalisées héritant d\'Exception.',
                'example' => 'function diviser($a, $b) {\n    if ($b === 0) {\n        throw new InvalidArgumentException("Division par zéro!");\n    }\n    return $a / $b;\n}\n\nclass MonException extends Exception {\n    public function errorMessage() {\n        return "Erreur personnalisée: " . $this->getMessage();\n    }\n}',
                'details' => 'Throw, c\'est "lancer une alerte rouge" ! Quand quelque chose ne va pas, au lieu de laisser le code continuer n\'importe comment, vous throw (lancez) une exception : "STOP ! Il y a un problème ici !". PHP a plein d\'exceptions toutes prêtes (InvalidArgumentException, RuntimeException...) mais vous pouvez créer les vôtres en héritant d\'Exception. L\'exception contient un message, un code, et plein d\'infos utiles (fichier, ligne...). Depuis PHP 8, vous pouvez même throw dans une affectation : $val = $x ?? throw new Exception(). L\'exception remonte jusqu\'à un catch ou fait tout planter.',
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
                    ['label' => 'Throw', 'url' => 'https://www.php.net/manual/fr/language.exceptions.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-try_catch_finally', 'label' => 'Try/Catch'],
                    ['id' => 'modal-condition_if_else', 'label' => 'if/else/elseif']
                ]
            ],
            'goto_labels' => [
                'description' => 'Instruction goto pour sauter à un label (à éviter, nuit à la lisibilité). Utile dans de rares cas spécifiques.',
                'example' => '$i = 0;\nloop:\necho $i++;\nif ($i < 5) goto loop;\n\n// Sortie de boucles imbriquées\nfor ($i = 0; $i < 3; $i++) {\n    for ($j = 0; $j < 3; $j++) {\n        if ($condition) goto end;\n    }\n}\nend:\necho "Fin";',
                'details' => 'Goto, c\'est le mouton noir de la famille ! Ça permet de "téléporter" l\'exécution du code vers un label (une étiquette). Vous mettez "label:" quelque part, et "goto label;" pour y sauter. Le problème : ça crée du "code spaghetti" impossible à suivre - votre code saute partout comme un kangourou fou ! C\'est considéré comme une MAUVAISE PRATIQUE. Il y a de très rares cas où c\'est utile (sortir de 5 boucles imbriquées), mais 99% du temps, utilisez plutôt des fonctions, break, ou des exceptions. Certains standards de code l\'interdisent carrément !',
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
                    ['label' => 'Goto', 'url' => 'https://www.php.net/manual/fr/control-structures.goto.php', 'icon' => '⚠️']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-controle_boucles', 'label' => 'Break/Continue'],
                    ['id' => 'modal-try_catch_finally', 'label' => 'Try/Catch']
                ]
            ],
            'declare_directives' => [
                'description' => 'Directive declare pour modifier le comportement du script : strict_types, ticks, encoding.',
                'example' => 'declare(strict_types=1); // Types stricts\n\nfunction additionner(int $a, int $b): int {\n    return $a + $b;\n}\n\n// declare(ticks=1);\n// declare(encoding=\'UTF-8\');',
                'details' => 'Declare, c\'est comme mettre des règles du jeu au début de votre fichier PHP ! La plus importante : declare(strict_types=1) qui dit "sois très strict sur les types - pas de conversion automatique !". Si vous demandez un nombre entier, PHP refusera un texte "123". Il y a aussi "ticks" (rarement utilisé, pour du profiling avancé) et "encoding" (obsolète, PHP utilise UTF-8 maintenant). Le declare doit être EN TOUTE PREMIÈRE LIGNE du fichier (ligne 2 après <?php). Important : chaque fichier doit avoir son propre declare, ce n\'est pas hérité !',
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
                    ['label' => 'Declare', 'url' => 'https://www.php.net/manual/fr/control-structures.declare.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-structures_conditionnelles', 'label' => 'Structures conditionnelles']
                ]
            ],
            'return_yield' => [
                'description' => 'Instructions return (sortir de fonction) et yield (générateurs PHP 5.5+) pour retourner des valeurs de manière paresseuse.',
                'example' => 'function generateur() {\n    yield 1;\n    yield 2;\n    yield 3;\n}\n\nforeach (generateur() as $valeur) {\n    echo $valeur; // 1, 2, 3\n}\n\n// Yield avec clés\nfunction paires() {\n    yield \'a\' => 1;\n    yield \'b\' => 2;\n}',
                'details' => 'Return, c\'est "sortir de la fonction et renvoyer une valeur". Yield (depuis PHP 5.5), c\'est un return spécial qui fait "pause" : la fonction donne une valeur, se met en pause, et reprend plus tard pour donner la suivante ! C\'est comme distribuer des cartes une par une au lieu de donner tout le paquet d\'un coup. ÉNORME avantage : économise la mémoire ! Au lieu de créer un tableau de 1 million d\'éléments, vous les générez un par un à la demande. Parfait pour lire de gros fichiers, créer des séquences infinies, ou traiter de grandes quantités de données sans saturer la mémoire.',
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
                    ['label' => 'Générateurs', 'url' => 'https://www.php.net/manual/fr/language.generators.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-boucles_foreach', 'label' => 'Foreach'],
                    ['id' => 'modal-boucles_while', 'label' => 'While/Do-While']
                ]
            ],
            'structures_alternatives' => [
                'description' => 'Syntaxes alternatives des structures de contrôle avec deux points et mots-clés de fermeture (endif, endwhile, etc.).',
                'example' => '<?php if ($condition): ?>\n    <p>HTML mixé</p>\n<?php endif; ?>\n\n<?php foreach ($items as $item): ?>\n    <li><?= $item ?></li>\n<?php endforeach; ?>\n\n<?php while ($condition): ?>\n    <!-- contenu -->\n<?php endwhile; ?>',
                'details' => 'Une autre façon d\'écrire les structures : au lieu des accolades {}, vous utilisez deux-points : et des mots de fin (endif, endforeach, endwhile...). C\'est SUPER pratique quand vous mélangez PHP et HTML dans vos templates ! Au lieu de fermer et rouvrir des balises PHP partout, vous écrivez <?php if(): ?> ... du HTML ... <?php endif; ?>. Beaucoup plus lisible ! ATTENTION : il faut le point-virgule après endif; endforeach; etc. Ça marche pour if, for, foreach, while, switch. En PHP moderne, on préfère utiliser des moteurs de templates (Twig, Blade) mais cette syntaxe reste très pratique.',
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
                    ['label' => 'Syntaxes alternatives', 'url' => 'https://www.php.net/manual/fr/control-structures.alternative-syntax.php', 'icon' => '📖']
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
