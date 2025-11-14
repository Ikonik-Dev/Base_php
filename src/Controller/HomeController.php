<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // tableaux associatif de données des grandes notion de cours php avec granularité fine
        $data = [
            'variables' => [
                'description' => 'Les variables en PHP sont utilisées pour stocker des données. Elles sont déclarées avec le signe $ suivi du nom de la variable.',
                'example' => '$maVariable = "Bonjour";',
                'details' => 'Les variables PHP commencent par $ et stockent toutes sortes de données (nombres, textes, tableaux, objets). Elles sont créées automatiquement dès l\'assignation et leur type peut changer dynamiquement. PHP propose aussi des superglobales ($_GET, $_POST, $_SESSION) accessibles partout dans le code. Les variables peuvent être locales (dans une fonction), globales (partout avec le mot-clé global) ou statiques (conservent leur valeur entre appels).',
                'useCases' => [
                    'Stocker des données utilisateur provenant de formulaires ($_POST, $_GET)',
                    'Gérer les sessions utilisateur avec $_SESSION (connexion, panier)',
                    'Manipuler des résultats de requêtes bases de données',
                    'Créer des compteurs ou accumulations avec variables statiques',
                    'Passer des informations entre différentes parties du code',
                    'Configurer l\'application avec variables d\'environnement ($_ENV)',
                ],
                'warnings' => [
                    'Ne jamais faire confiance aux superglobales sans validation (injection SQL, XSS)',
                    'Attention à la portée des variables : local vs global (utiliser global avec précaution)',
                    'Les variables non initialisées génèrent des avertissements en PHP 8+',
                    'Variables dynamiques ($$var) rendent le code difficile à maintenir et déboguer',
                ],
                'bestPractices' => [
                    'Utiliser des noms explicites et cohérents (camelCase ou snake_case)',
                    'Valider et filtrer les superglobales (filter_var, filter_input)',
                    'Initialiser les variables avant utilisation pour éviter les erreurs',
                    'Préférer les paramètres de fonctions aux variables globales',
                    'Documenter les variables complexes avec des commentaires PHPDoc',
                ],
                'resources' => [
                    ['label' => 'Doc PHP - Variables', 'url' => 'https://www.php.net/manual/fr/language.variables.php'],
                    ['label' => 'Doc PHP - Superglobales', 'url' => 'https://www.php.net/manual/fr/language.variables.superglobals.php'],
                ],
                'relatedTopics' => [
                    ['label' => 'Types de Données', 'id' => 'modal-types_de_donnees'],
                    ['label' => 'Fonctions', 'id' => 'modal-fonctions'],
                    ['label' => 'POO', 'id' => 'modal-programmation_orientee_objet'],
                ],
            ],
            'types_de_donnees' => [
                'description' => 'PHP supporte plusieurs types de données, y compris les entiers, les flottants, les chaînes de caractères, les tableaux, les objets, et les types spéciaux comme NULL.',
                'example' => '$monEntier = 42; $maChaine = "Hello World";',
                'details' => 'PHP est un langage à typage dynamique avec 10 types principaux : scalaires (int, float, string, bool), composés (array, object, callable, iterable), spéciaux (resource, null). Depuis PHP 7+, le typage strict peut être activé avec declare(strict_types=1). PHP 8 introduit les Union Types (int|string), le type mixed et never. Le typage aide à détecter les erreurs tôt et améliore la maintenabilité du code.',
                'useCases' => [
                    'Typer les paramètres et retours de fonctions pour éviter les erreurs',
                    'Utiliser les types scalaires pour les calculs (int, float) et textes (string)',
                    'Manipuler des collections avec array et iterable pour les boucles',
                    'Créer des objets typés pour modéliser des entités métier',
                    'Utiliser nullable types (?int) pour valeurs optionnelles',
                    'Employer Union Types (int|float) pour accepter plusieurs types',
                ],
                'warnings' => [
                    'Le mode non-strict fait des conversions automatiques dangereuses ("10" + 5 = 15)',
                    'Les comparaisons non strictes (==) peuvent donner des résultats surprenants',
                    'L\'absence de typage rend le code difficile à maintenir et déboguer',
                    'Les erreurs de type ne sont détectées qu\'à l\'exécution sans typage strict',
                ],
                'bestPractices' => [
                    'Activer le mode strict avec declare(strict_types=1) en début de fichier',
                    'Toujours typer les paramètres et retours de fonctions/méthodes',
                    'Utiliser === au lieu de == pour comparaisons strictes',
                    'Préférer les types natifs PHP aux types dans les commentaires PHPDoc',
                    'Documenter les types complexes avec PHPDoc (@param array<int, User>)',
                ],
                'resources' => [
                    ['label' => 'Doc PHP - Types', 'url' => 'https://www.php.net/manual/fr/language.types.php'],
                    ['label' => 'PHP 8 - Union Types', 'url' => 'https://www.php.net/manual/fr/language.types.declarations.php#language.types.declarations.union'],
                ],
                'relatedTopics' => [
                    ['label' => 'Variables', 'id' => 'modal-variables'],
                    ['label' => 'Fonctions', 'id' => 'modal-fonctions'],
                    ['label' => 'POO', 'id' => 'modal-programmation_orientee_objet'],
                ],
            ],
            'operateurs' => [
                'description' => 'Les opérateurs en PHP sont utilisés pour effectuer des opérations sur des variables et des valeurs. Ils incluent les opérateurs arithmétiques, de comparaison, logiques, et plus encore.',
                'example' => '$somme = $a + $b; $estEgal = ($a == $b);',
                'details' => 'PHP propose de nombreux opérateurs : arithmétiques (+, -, *, /, %, **), comparaison (==, ===, !=, !==, <, >, <=, >=), logiques (&&, ||, !, and, or, xor), affectation (=, +=, -=, .=), incrémentation (++, --), ternaire (?:), null coalescing (??), spaceship (<=>), et opérateur de fusion null (??=). PHP 8 ajoute le nullsafe operator (?->) pour éviter les erreurs sur objets null.',
                'useCases' => [
                    'Effectuer des calculs mathématiques avec opérateurs arithmétiques',
                    'Comparer des valeurs avec === (strict) plutôt que == (faible)',
                    'Combiner des conditions avec opérateurs logiques (&&, ||)',
                    'Affecter des valeurs par défaut avec ?? (null coalescing)',
                    'Simplifier les conditions avec l\'opérateur ternaire (?:)',
                    'Trier des tableaux avec spaceship operator (<=>)',
                ],
                'warnings' => [
                    'Toujours utiliser === au lieu de == pour éviter conversions inattendues',
                    'L\'opérateur @ supprime les erreurs mais ne les résout pas (à éviter)',
                    'Attention à la priorité des opérateurs (utiliser des parenthèses)',
                    'Les opérateurs logiques && et || ont des priorités différentes de and/or',
                ],
                'bestPractices' => [
                    'Préférer === pour toutes les comparaisons (typage strict)',
                    'Utiliser ?? pour valeurs par défaut au lieu de isset() ternaire',
                    'Employer le nullsafe operator (?->) avec chaînages d\'objets',
                    'Ajouter des parenthèses pour clarifier les expressions complexes',
                    'Éviter l\'opérateur @ : gérer proprement les erreurs avec try-catch',
                ],
                'resources' => [
                    ['label' => 'Doc PHP - Opérateurs', 'url' => 'https://www.php.net/manual/fr/language.operators.php'],
                    ['label' => 'PHP 8 - Nullsafe Operator', 'url' => 'https://www.php.net/manual/fr/language.oop5.basic.php#language.oop5.basic.nullsafe'],
                ],
                'relatedTopics' => [
                    ['label' => 'Variables', 'id' => 'modal-variables'],
                    ['label' => 'Structures de Contrôle', 'id' => 'modal-structures_de_controle'],
                    ['label' => 'Types de Données', 'id' => 'modal-types_de_donnees'],
                ],
            ],
            'structures_de_controle' => [
                'description' => 'Les structures de contrôle en PHP permettent de contrôler le flux d\'exécution du code. Cela inclut les instructions conditionnelles (if, else, switch) et les boucles (for, while, foreach).',
                'example' => 'if ($a > $b) { echo "A est plus grand que B"; }',
                'details' => 'Les structures de contrôle dirigent l\'exécution du code : conditionnelles (if/elseif/else pour décisions, switch/match pour sélections multiples), boucles (for compteur, while condition, do-while au moins une fois, foreach collections), instructions de contrôle (break sortie, continue suivant, return valeur). PHP 8 introduit match (switch amélioré avec expressions et comparaisons strictes). Ces structures sont essentielles pour créer une logique métier complexe.',
                'useCases' => [
                    'Valider des données utilisateur avec if/else (formulaires, authentification)',
                    'Parcourir des tableaux avec foreach pour traiter chaque élément',
                    'Gérer des états multiples avec switch ou match (statuts, rôles)',
                    'Créer des boucles conditionnelles avec while (lecture de fichiers)',
                    'Optimiser avec break/continue dans boucles (recherche, filtrage)',
                    'Utiliser match pour mapping valeurs (plus lisible que switch)',
                ],
                'warnings' => [
                    'Les boucles infinies (while(true) sans break) bloquent le serveur',
                    'switch nécessite break sinon continue vers les cas suivants (fall-through)',
                    'foreach modifie le pointeur interne du tableau (attention références)',
                    'Conditions complexes imbriquées deviennent illisibles (refactorer)',
                ],
                'bestPractices' => [
                    'Préférer match à switch pour code plus concis et sûr (PHP 8+)',
                    'Utiliser foreach plutôt que for pour parcourir des tableaux',
                    'Limiter l\'imbrication à 2-3 niveaux (extraire en fonctions)',
                    'Valider les entrées avec if/else tôt (early return pattern)',
                    'Toujours prévoir un cas default dans switch/match',
                ],
                'resources' => [
                    ['label' => 'Doc PHP - Structures de contrôle', 'url' => 'https://www.php.net/manual/fr/language.control-structures.php'],
                    ['label' => 'PHP 8 - Match Expression', 'url' => 'https://www.php.net/manual/fr/control-structures.match.php'],
                ],
                'relatedTopics' => [
                    ['label' => 'Opérateurs', 'id' => 'modal-operateurs'],
                    ['label' => 'Fonctions', 'id' => 'modal-fonctions'],
                    ['label' => 'Tableaux', 'id' => 'modal-tableaux'],
                ],
            ],
            'fonctions' => [
                'description' => 'Les fonctions en PHP sont des blocs de code réutilisables qui effectuent une tâche spécifique. Elles peuvent accepter des paramètres et retourner des valeurs.',
                'example' => 'function addition($a, $b) { return $a + $b; }',
                'details' => 'Les fonctions structurent le code en blocs réutilisables avec des paramètres typés et valeurs de retour. PHP supporte : fonctions classiques, fonctions anonymes (closures), arrow functions (PHP 7.4), générateurs (yield), fonctions variadiques (...$args), paramètres nommés (PHP 8), typage strict des paramètres/retours, valeurs par défaut. Les fonctions améliorent la lisibilité, testabilité et maintenabilité du code.',
                'useCases' => [
                    'Encapsuler la logique métier réutilisable (calculs, validations)',
                    'Créer des callbacks avec fonctions anonymes (array_map, usort)',
                    'Simplifier les closures courtes avec arrow functions (fn)',
                    'Générer des séquences avec yield (économiser mémoire)',
                    'Accepter nombre variable d\'arguments avec ...$args',
                    'Améliorer lisibilité avec paramètres nommés (PHP 8)',
                ],
                'warnings' => [
                    'Fonctions sans typage sont sources d\'erreurs (activer strict_types)',
                    'Les fonctions trop longues (>50 lignes) deviennent difficiles à maintenir',
                    'Attention aux effets de bord (modifier variables globales/références)',
                    'Les closures capturent variables par valeur (use) : attention aux références',
                ],
                'bestPractices' => [
                    'Toujours typer paramètres et retours (activer declare(strict_types=1))',
                    'Une fonction = une responsabilité (principe SOLID)',
                    'Préférer arrow functions pour callbacks simples (plus lisible)',
                    'Documenter avec PHPDoc (@param, @return, @throws)',
                    'Limiter à 3-4 paramètres (sinon créer objet ou tableau)',
                ],
                'resources' => [
                    ['label' => 'Doc PHP - Fonctions', 'url' => 'https://www.php.net/manual/fr/language.functions.php'],
                    ['label' => 'PHP 8 - Named Arguments', 'url' => 'https://www.php.net/manual/fr/functions.arguments.php#functions.named-arguments'],
                ],
                'relatedTopics' => [
                    ['label' => 'Variables', 'id' => 'modal-variables'],
                    ['label' => 'Types de Données', 'id' => 'modal-types_de_donnees'],
                    ['label' => 'POO', 'id' => 'modal-programmation_orientee_objet'],
                ],
            ],
            'tableaux' => [
                'description' => 'Les tableaux en PHP sont des structures de données qui peuvent contenir plusieurs valeurs. Ils peuvent être indexés numériquement ou associatifs (avec des clés personnalisées).',
                'example' => '$monTableau = array("pomme", "banane", "cerise");',
                'details' => 'Les tableaux PHP sont des structures polyvalentes : indexés (clés numériques 0, 1, 2...), associatifs (clés personnalisées), multidimensionnels (tableaux de tableaux). PHP offre 80+ fonctions pour les manipuler : tri (sort, usort), recherche (in_array, array_search), filtrage (array_filter, array_map), fusion (array_merge), extraction (array_slice). Les tableaux peuvent stocker tous types de données et sont essentiels pour gérer des collections.',
                'useCases' => [
                    'Stocker des collections d\'objets métier (utilisateurs, produits)',
                    'Gérer des configurations avec tableaux associatifs (paramètres)',
                    'Traiter des résultats de requêtes bases de données',
                    'Transformer des données avec array_map, array_filter, array_reduce',
                    'Trier des collections avec usort et fonctions de comparaison',
                    'Créer des structures JSON pour APIs (json_encode sur tableaux)',
                ],
                'warnings' => [
                    'Les tableaux PHP consomment beaucoup de mémoire (16x plus qu\'en C)',
                    'Les clés numériques ne sont pas forcément consécutives (attention aux trous)',
                    'array_merge réindexe les tableaux numériques (utiliser + pour préserver)',
                    'Attention à la référence dans foreach : &$value modifie tableau original',
                ],
                'bestPractices' => [
                    'Préférer la syntaxe courte [] à array() (plus lisible)',
                    'Typer avec PHPDoc pour tableaux complexes (@var array<int, User>)',
                    'Utiliser array_key_exists() plutôt que isset() pour tester clés',
                    'Éviter les tableaux trop profonds (>3 niveaux) : créer des classes',
                    'Privilégier les fonctions natives (array_map) aux boucles manuelles',
                ],
                'resources' => [
                    ['label' => 'Doc PHP - Tableaux', 'url' => 'https://www.php.net/manual/fr/language.types.array.php'],
                    ['label' => 'Fonctions tableaux', 'url' => 'https://www.php.net/manual/fr/ref.array.php'],
                ],
                'relatedTopics' => [
                    ['label' => 'Structures de Contrôle', 'id' => 'modal-structures_de_controle'],
                    ['label' => 'Fonctions', 'id' => 'modal-fonctions'],
                    ['label' => 'Variables', 'id' => 'modal-variables'],
                ],
            ],
            'manipulation_de_chaines' => [
                'description' => 'PHP offre de nombreuses fonctions pour manipuler les chaînes de caractères, comme la concaténation, la recherche, le remplacement, et la modification de la casse.',
                'example' => '$chaine = "Bonjour"; $chaine .= " le monde!";',
                'details' => 'PHP propose 100+ fonctions pour manipuler les chaînes : concaténation (. et .=), recherche (strpos, str_contains), remplacement (str_replace, preg_replace), extraction (substr, explode, str_split), formatage (sprintf, trim, strtolower), encodage (htmlspecialchars, urlencode), longueur (strlen, mb_strlen). Attention à l\'encodage UTF-8 : utiliser les fonctions mb_* pour caractères multi-octets.',
                'useCases' => [
                    'Valider et nettoyer les entrées utilisateur (trim, strip_tags)',
                    'Formater des textes pour affichage (ucfirst, wordwrap)',
                    'Sécuriser contre XSS avec htmlspecialchars/htmlentities',
                    'Parser des URLs et données avec explode, parse_url',
                    'Rechercher/remplacer du texte avec str_replace ou regex (preg_replace)',
                    'Gérer du texte multilingue avec fonctions mb_* (UTF-8)',
                ],
                'warnings' => [
                    'Ne jamais afficher entrées utilisateur sans htmlspecialchars (faille XSS)',
                    'strlen() compte les octets, pas les caractères (utiliser mb_strlen pour UTF-8)',
                    'Les regex (preg_*) sont puissantes mais complexes et lentes',
                    'Attention aux encodages : toujours travailler en UTF-8',
                ],
                'bestPractices' => [
                    'Toujours échapper les sorties HTML avec htmlspecialchars()',
                    'Utiliser les fonctions mb_* pour chaînes UTF-8 (caractères accentués)',
                    'Préférer str_contains/str_starts_with (PHP 8) à strpos !== false',
                    'Valider avec filter_var plutôt que regex maison (emails, URLs)',
                    'Utiliser des fonctions natives plutôt que manipulations manuelles',
                ],
                'resources' => [
                    ['label' => 'Doc PHP - Chaînes', 'url' => 'https://www.php.net/manual/fr/ref.strings.php'],
                    ['label' => 'PHP 8 - str_contains', 'url' => 'https://www.php.net/manual/fr/function.str-contains.php'],
                ],
                'relatedTopics' => [
                    ['label' => 'Variables', 'id' => 'modal-variables'],
                    ['label' => 'Gestion des Erreurs', 'id' => 'modal-gestion_des_erreurs'],
                    ['label' => 'Fonctions', 'id' => 'modal-fonctions'],
                ],
            ],
            'gestion_des_erreurs' => [
                'description' => 'La gestion des erreurs en PHP peut être effectuée à l\'aide de fonctions intégrées comme try-catch, error_reporting, et set_error_handler pour capturer et gérer les erreurs de manière appropriée.',
                'example' => 'try { // code qui peut générer une exception } catch (Exception $e) { echo "Erreur : " . $e->getMessage(); }',
                'details' => 'PHP distingue erreurs (warnings, notices, fatals) et exceptions (objets Exception). Mécanismes : try/catch/finally pour exceptions, error_reporting() pour niveau d\'erreurs, set_error_handler() pour gestionnaire personnalisé, throw pour lancer exceptions. PHP 8 améliore avec TypeError automatique, exceptions sur erreurs fatales. Une bonne gestion évite crashs, sécurise l\'app et facilite le débogage avec logs structurés.',
                'useCases' => [
                    'Capturer erreurs de connexion BDD avec try/catch sur PDO',
                    'Valider données utilisateur et lever exceptions personnalisées',
                    'Logger les erreurs dans fichiers avec error_log() ou Monolog',
                    'Afficher messages user-friendly sans exposer détails techniques',
                    'Gérer les erreurs fatales avec register_shutdown_function()',
                    'Tester le code avec PHPUnit et vérifier exceptions attendues',
                ],
                'warnings' => [
                    'Ne jamais afficher erreurs brutes en production (expose chemins, versions)',
                    'Les catch génériques (catch Exception) cachent les erreurs spécifiques',
                    'L\'opérateur @ masque erreurs sans les résoudre (à bannir)',
                    'Ne pas capturer Throwable sauf cas très spécifiques (erreurs fatales)',
                ],
                'bestPractices' => [
                    'Toujours désactiver display_errors en production (log_errors uniquement)',
                    'Créer des exceptions métier personnalisées (UserNotFoundException)',
                    'Logger avec contexte (message, stack trace, données utilisateur)',
                    'Utiliser finally pour nettoyer ressources (fermer fichiers, connexions)',
                    'Capturer exceptions spécifiques plutôt que Exception générique',
                ],
                'resources' => [
                    ['label' => 'Doc PHP - Exceptions', 'url' => 'https://www.php.net/manual/fr/language.exceptions.php'],
                    ['label' => 'Doc PHP - Errors', 'url' => 'https://www.php.net/manual/fr/book.errorfunc.php'],
                ],
                'relatedTopics' => [
                    ['label' => 'Fonctions', 'id' => 'modal-fonctions'],
                    ['label' => 'POO', 'id' => 'modal-programmation_orientee_objet'],
                    ['label' => 'Bases de Données', 'id' => 'modal-interaction_avec_les_bases_de_donnees'],
                ],
            ],
            'programmation_orientee_objet' => [
                'description' => 'La POO en PHP permet d\'organiser le code en classes et objets. Maîtrisez l\'encapsulation, l\'héritage, le polymorphisme et l\'abstraction pour créer des applications robustes et maintenables.',
                'example' => 'class Voiture { private $marque; public function __construct($marque) { $this->marque = $marque; } public function demarrer() { return "La " . $this->marque . " démarre"; } }',
                'details' => 'La POO structure le code en classes (modèles) et objets (instances) avec 4 piliers : encapsulation (private/protected/public), héritage (extends, parent::), polymorphisme (interfaces, classes abstraites), abstraction (cacher complexité). PHP supporte : propriétés/méthodes typées, constructeur promu (PHP 8), readonly (PHP 8.1), traits (réutilisation), namespaces, autoloading PSR-4. La POO améliore maintenabilité, testabilité et réutilisabilité du code.',
                'useCases' => [
                    'Modéliser entités métier (User, Product, Order) avec propriétés/méthodes',
                    'Créer architecture MVC avec séparation contrôleurs/modèles/vues',
                    'Implémenter design patterns (Repository, Factory, Strategy)',
                    'Utiliser l\'injection de dépendances pour découplage et tests',
                    'Gérer polymorphisme avec interfaces (PaymentInterface)',
                    'Structurer code avec namespaces et autoloading PSR-4',
                ],
                'warnings' => [
                    'Éviter l\'héritage profond (>3 niveaux) : préférer composition',
                    'Ne pas abuser des classes statiques (difficiles à tester)',
                    'Les constructeurs avec trop de paramètres deviennent complexes',
                    'Attention aux références circulaires entre objets (memory leaks)',
                ],
                'bestPractices' => [
                    'Respecter les principes SOLID (Single Responsibility, Open/Closed...)',
                    'Toujours typer propriétés et paramètres (activer strict_types)',
                    'Utiliser readonly pour propriétés immutables (PHP 8.1+)',
                    'Préférer composition à héritage (favoriser interfaces)',
                    'Documenter avec PHPDoc et utiliser PHPStan/Psalm pour analyse statique',
                ],
                'resources' => [
                    ['label' => 'Doc PHP - POO', 'url' => 'https://www.php.net/manual/fr/language.oop5.php'],
                    ['label' => 'PHP 8 - Constructor Promotion', 'url' => 'https://www.php.net/manual/fr/language.oop5.decon.php#language.oop5.decon.constructor.promotion'],
                ],
                'relatedTopics' => [
                    ['label' => 'Fonctions', 'id' => 'modal-fonctions'],
                    ['label' => 'Types de Données', 'id' => 'modal-types_de_donnees'],
                    ['label' => 'Gestion des Erreurs', 'id' => 'modal-gestion_des_erreurs'],
                ],
            ],
            'interaction_avec_les_bases_de_donnees' => [
                'description' => 'Apprenez à interagir avec les bases de données en PHP : connexions PDO sécurisées, requêtes préparées, transactions, jointures, ORM Doctrine, migrations et optimisation des performances.',
                'example' => '$pdo = new PDO("mysql:host=localhost;dbname=boutique", "user", "password"); $stmt = $pdo->prepare("SELECT * FROM produits WHERE prix > ?"); $stmt->execute([100]);',
                'details' => 'PHP interagit avec bases de données via PDO (abstraction multi-SGBD) ou mysqli (spécifique MySQL). Concepts clés : connexion sécurisée, requêtes préparées (protection injections SQL), transactions (cohérence données), jointures (relations entre tables), gestion erreurs (try/catch PDO::ERRMODE_EXCEPTION). ORMs comme Doctrine abstraient SQL avec objets, migrations gèrent schéma, optimisations améliorent performances (index, EXPLAIN, cache).',
                'useCases' => [
                    'Connecter app à MySQL/PostgreSQL avec PDO et gestion erreurs',
                    'Sécuriser requêtes avec statements préparés (prévenir SQL injection)',
                    'Gérer transactions pour opérations atomiques (commande + paiement)',
                    'Utiliser Doctrine ORM pour mapper objets PHP vers tables SQL',
                    'Créer/modifier schéma avec migrations versionées',
                    'Optimiser performances avec index, lazy loading, cache requêtes',
                ],
                'warnings' => [
                    'Ne jamais concaténer variables utilisateur dans SQL (injection SQL)',
                    'Toujours utiliser requêtes préparées pour données externes',
                    'Les transactions non committées bloquent les tables (deadlocks)',
                    'N+1 queries avec ORMs ralentissent l\'app (utiliser eager loading)',
                ],
                'bestPractices' => [
                    'Toujours utiliser PDO avec PDO::ERRMODE_EXCEPTION activé',
                    'Paramétrer requêtes avec bindParam/bindValue (typage sécurisé)',
                    'Wrapper PDO dans une classe Repository pour abstraction',
                    'Utiliser migrations pour versioner schéma (jamais modifier BDD manuellement)',
                    'Logger requêtes lentes et optimiser avec EXPLAIN (index manquants)',
                ],
                'resources' => [
                    ['label' => 'Doc PHP - PDO', 'url' => 'https://www.php.net/manual/fr/book.pdo.php'],
                    ['label' => 'Doctrine ORM', 'url' => 'https://www.doctrine-project.org/projects/orm.html'],
                ],
                'relatedTopics' => [
                    ['label' => 'POO', 'id' => 'modal-programmation_orientee_objet'],
                    ['label' => 'Gestion des Erreurs', 'id' => 'modal-gestion_des_erreurs'],
                    ['label' => 'Tableaux', 'id' => 'modal-tableaux'],
                ],
            ],
            'infrastructure_web' => [
                'description' => 'Comprenez l\'écosystème web et la place de PHP : architecture client-serveur, pile LAMP/LEMP, cycle HTTP, rôle de PHP dans l\'infrastructure moderne et interactions avec les autres technologies.',
                'example' => 'Client (Navigateur) → Requête HTTP → Serveur (Apache/Nginx + PHP) → Base de données (MySQL) → Réponse HTTP → Client',
                'details' => 'PHP s\'insère dans architecture web : client (navigateur) envoie requête HTTP → serveur web (Apache/Nginx) → module PHP-FPM exécute script → génère HTML/JSON → retourne réponse. Pile classique LAMP (Linux, Apache, MySQL, PHP) ou moderne (Docker, Nginx, PostgreSQL, Redis cache). PHP 8+ avec JIT améliore performances. Comprendre ce flux aide à optimiser (cache, CDN) et déboguer (logs serveur, network tab).',
                'useCases' => [
                    'Déployer app PHP sur serveur Linux avec Nginx + PHP-FPM',
                    'Configurer virtual hosts Apache pour multi-sites',
                    'Utiliser Docker pour environnement reproductible (dev = prod)',
                    'Mettre en place cache avec Redis/Memcached (sessions, requêtes)',
                    'Optimiser avec CDN pour assets statiques (images, CSS, JS)',
                    'Monitorer performances avec logs (access.log, error.log, PHP-FPM)',
                ],
                'warnings' => [
                    'Ne jamais exposer php.ini en production (display_errors=Off)',
                    'Limiter permissions fichiers/dossiers (éviter 777, préférer 644/755)',
                    'Configurer limits PHP (max_execution_time, memory_limit) pour éviter abus',
                    'Attention aux configurations par défaut non sécurisées (allow_url_fopen)',
                ],
                'bestPractices' => [
                    'Utiliser HTTPS partout (certificat Let\'s Encrypt gratuit)',
                    'Séparer environnements (dev, staging, prod) avec configs différentes',
                    'Versionner infrastructure avec Docker Compose ou Kubernetes',
                    'Monitorer avec outils APM (New Relic, Datadog, Blackfire)',
                    'Automatiser déploiement avec CI/CD (GitHub Actions, GitLab CI)',
                ],
                'resources' => [
                    ['label' => 'PHP-FPM Configuration', 'url' => 'https://www.php.net/manual/fr/install.fpm.php'],
                    ['label' => 'Docker PHP Official', 'url' => 'https://hub.docker.com/_/php'],
                ],
                'relatedTopics' => [
                    ['label' => 'Gestion des Erreurs', 'id' => 'modal-gestion_des_erreurs'],
                    ['label' => 'Bases de Données', 'id' => 'modal-interaction_avec_les_bases_de_donnees'],
                    ['label' => 'POO', 'id' => 'modal-programmation_orientee_objet'],
                ],
            ],
        ];
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'data' => $data,
        ]);
    }
}
