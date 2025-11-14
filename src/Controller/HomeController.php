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
                'details' => 'Les variables, c\'est comme des boîtes avec une étiquette $ ! Tu mets ce que tu veux dedans : nombres, texte, listes... et PHP devine automatiquement le type. Il existe des variables spéciales appelées "superglobales" ($_GET, $_POST, $_SESSION) qui sont accessibles partout dans ton code. Une variable peut vivre juste dans sa fonction (locale), partout dans le code (globale avec le mot-clé global), ou garder sa valeur entre les appels (statique). C\'est la base de tout en PHP !',
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
                'details' => 'PHP a 10 types de données : simples (int, float, string, bool), complexes (array, object, callable, iterable) et spéciaux (resource, null). Normalement PHP est "cool" et devine tout... mais ça crée des bugs ! C\'est pourquoi depuis PHP 7, tu peux activer le mode strict avec declare(strict_types=1) pour forcer PHP à être rigoureux. PHP 8 ajoute des types encore plus puissants : Union Types (int|string pour accepter plusieurs types), mixed (n\'importe quoi) et never (jamais de retour). Le typage, c\'est ton filet de sécurité !',
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
                'details' => 'Les opérateurs, c\'est comme des outils dans une boîte ! Maths (+, -, *, /, %, **), comparaisons (==, ===, <, >), logique (&&, ||, !), raccourcis (+=, -=, ++, --), et les stars modernes : le ternaire (?:) pour des if courts, le ?? pour les valeurs par défaut sans erreur, le spaceship (<=>) pour trier, et le nullsafe (?->) de PHP 8 qui évite les plantages sur null. ASTUCE : utilise toujours === au lieu de == pour être précis, et ?? est ton meilleur ami pour les valeurs optionnelles !',
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
                'details' => 'Les structures de contrôle, c\'est le système de navigation de ton code ! Tu as les décisions (if/else = "si ça alors fais ci", switch/match = "selon le cas"), les boucles (for = compter, while = tant que c\'est vrai, foreach = pour chaque élément), et les contrôles (break = sortir, continue = passer au suivant, return = renvoyer). PHP 8 a apporté match, une version améliorée de switch qui est plus stricte et plus courte. C\'est avec ces outils que tu construis toute la logique de ton application !',
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
                'details' => 'Les fonctions, c\'est comme des recettes de cuisine réutilisables ! Tu leur donnes des ingrédients (paramètres), elles font leur travail, et te rendent un résultat. PHP offre plusieurs styles : classiques, anonymes (closures = fonctions dans des variables), arrow functions (fn => super courtes depuis PHP 7.4), générateurs (yield pour économiser mémoire), fonctions avec nombre variable d\'arguments (...$args), et depuis PHP 8 les paramètres nommés (plus besoin de se souvenir de l\'ordre !). Les fonctions rendent ton code clair, testable et facile à maintenir.',
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
                'details' => 'Les tableaux en PHP, c\'est comme un classeur géant qui peut tout ranger ! Tu as 3 types : indexés (0, 1, 2... automatique), associatifs (tu choisis les noms de clés), et multidimensionnels (des tableaux dans des tableaux). PHP te donne plus de 80 fonctions pour les manipuler : trier (sort, usort), chercher (in_array, array_search), filtrer/transformer (array_filter, array_map), fusionner (array_merge), découper (array_slice)... Les tableaux stockent n\'importe quoi et sont LA structure indispensable pour gérer des collections !',
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
                'details' => 'PHP a plus de 100 fonctions pour jouer avec le texte ! Coller (. et .=), chercher (strpos, str_contains en PHP 8), remplacer (str_replace, ou regex avec preg_replace), découper (substr, explode, str_split), formater (sprintf, trim, strtolower), sécuriser (htmlspecialchars contre XSS, urlencode pour URLs), mesurer (strlen, mb_strlen). ATTENTION : strlen compte les octets, pas les caractères ! Pour les accents et émojis (UTF-8), utilise toujours les fonctions mb_* (mb_strlen, mb_substr...). Et sécurise TOUJOURS avec htmlspecialchars() !',
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
                'details' => 'PHP a deux systèmes d\'alertes : les erreurs (warnings, notices, fatals = ancien système) et les exceptions (objets Exception = système moderne). Tu gères ça avec try/catch/finally (tente, attrape si problème, nettoie toujours), error_reporting() pour choisir quoi voir, set_error_handler() pour personnaliser, et throw pour déclencher une exception. PHP 8 a tout amélioré : TypeError automatiques, erreurs fatales deviennent des exceptions. Bien gérer les erreurs = app qui ne crashe pas + logs utiles pour déboguer !',
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
                'details' => 'La POO, c\'est comme construire avec des Lego ! Tu crées des modèles (classes) et tu fabriques des pièces (objets). 4 règles d\'or : encapsulation (protéger avec private/protected/public), héritage (extends pour réutiliser du code parent), polymorphisme (interfaces pour garantir des méthodes communes), abstraction (cacher la complexité). PHP moderne ajoute : propriétés/méthodes typées, constructeur promu (PHP 8 = moins de code !), readonly (PHP 8.1 = impossible à modifier), traits (copier-coller intelligent), namespaces et autoloading PSR-4. La POO = code organisé, testable et facile à maintenir !',
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
                'details' => 'PHP parle aux bases de données avec PDO (fonctionne avec MySQL, PostgreSQL, SQLite...) ou mysqli (juste MySQL). Les essentiels : connexion sécurisée, requêtes préparées (OBLIGATOIRE pour éviter les injections SQL = piratage !), transactions (tout réussit ou tout annule = cohérence), jointures (relier les tables), gestion d\'erreurs (try/catch avec PDO::ERRMODE_EXCEPTION). Les ORMs comme Doctrine te permettent de manipuler des objets au lieu d\'écrire du SQL. Migrations = versionnage de ta base. Et optimise avec index, EXPLAIN et cache !',
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
                'details' => 'PHP, c\'est une pièce dans un grand puzzle web ! Le flux : ton navigateur envoie une requête HTTP → le serveur web (Apache/Nginx) la reçoit → PHP-FPM exécute le script → génère du HTML/JSON → renvoie la réponse. La pile classique s\'appelle LAMP (Linux, Apache, MySQL, PHP), la moderne utilise Docker, Nginx, PostgreSQL et Redis pour la vitesse. PHP 8+ avec son JIT (compilation à la volée) va encore plus vite ! Comprendre ce système te permet d\'optimiser (cache, CDN) et de déboguer efficacement (logs, network tab du navigateur).',
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
