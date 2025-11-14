<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BddController extends AbstractController
{
    #[Route('/bdd', name: 'app_bdd')]
    public function index(): Response
    {
        // Données complètes sur l'interaction avec les bases de données en PHP
        $dataBDD = [
            'introduction_bdd' => [
                'description' => 'Les bases de données permettent de stocker, organiser et récupérer des informations de manière structurée. En PHP, on interagit avec elles via des extensions comme PDO ou MySQLi.',
                'example' => '// Connexion basique à une base de données MySQL\n$host = "localhost";\n$dbname = "ma_base";\n$username = "utilisateur";\n$password = "motdepasse";\n\ntry {\n    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);\n    echo "Connexion réussie !";\n} catch (PDOException $e) {\n    echo "Erreur : " . $e->getMessage();\n}',
                'details' => 'Une base de données (BDD) est comme un classeur géant organisé : des tables (comme des feuilles Excel) avec des lignes (enregistrements) et des colonnes (champs). Au lieu de stocker vos données dans des fichiers texte, vous les mettez dans une BDD qui permet de chercher, trier, filtrer super rapidement.

En PHP, vous utilisez PDO (PHP Data Objects) ou MySQLi pour parler à la base. PDO est recommandé car il fonctionne avec MySQL, PostgreSQL, SQLite... MySQLi ne marche qu\'avec MySQL uniquement.

Pour se connecter, vous donnez l\'adresse du serveur (localhost souvent), le nom de la base, un nom d\'utilisateur et un mot de passe. Si ça réussit, vous avez un objet $pdo qui vous permet d\'envoyer des requêtes SQL.

Les BDD sont essentielles pour tout site dynamique : utilisateurs, articles, commandes... tout est stocké là.',
                'useCases' => [
                    'Site web : utilisateurs, articles, commentaires stockés en MySQL',
                    'E-commerce : produits, commandes, paiements dans base relationnelle',
                    'Application mobile : données synchronisées via API + BDD serveur',
                    'CRM : clients, contacts, interactions historisées en base',
                    'Blog : posts, catégories, tags organisés avec relations',
                    'Système réservation : disponibilités, réservations temps réel en BDD'
                ],
                'warnings' => [
                    'Mots passe en clair : JAMAIS en dur dans code, utiliser variables environnement',
                    'Erreurs affichées : ne pas montrer détails connexion à utilisateur (sécurité)',
                    'Connexions multiples : créer UNE connexion par requête, pas à chaque ligne',
                    'Charset oublié : préciser charset=utf8mb4 dans DSN pour accents/emojis'
                ],
                'bestPractices' => [
                    'Variables environnement : credentials dans .env, jamais dans code versionné',
                    'Try/catch : toujours attraper PDOException pour gérer erreurs proprement',
                    'Mode erreur : PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION obligatoire',
                    'Connexion unique : pattern Singleton ou injection dépendances pour réutiliser',
                    'DSN complet : préciser host, dbname, charset, port si non standard'
                ],
                'resources' => [
                    ['title' => 'PDO PHP Manuel', 'url' => 'https://www.php.net/manual/fr/book.pdo.php', 'icon' => '📖'],
                    ['title' => 'MySQL Documentation', 'url' => 'https://dev.mysql.com/doc/', 'icon' => '🔗']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-pdo_introduction', 'label' => 'PDO Introduction'],
                    ['id' => 'modal-gestion_erreurs', 'label' => 'Gestion erreurs'],
                    ['id' => 'modal-securite_bdd', 'label' => 'Sécurité BDD']
                ]
            ],
            'pdo_introduction' => [
                'description' => 'PDO (PHP Data Objects) est l\'extension recommandée pour interagir avec les bases de données. Elle offre une interface unifiée pour différents SGBD (MySQL, PostgreSQL, SQLite, etc.).',
                'example' => '// Configuration PDO avec options de sécurité\n$options = [\n    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,\n    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,\n    PDO::ATTR_EMULATE_PREPARES => false\n];\n\n$pdo = new PDO($dsn, $username, $password, $options);',
                'details' => 'PDO est la façon moderne et sécurisée de parler aux bases de données en PHP. Son grand avantage : vous écrivez le même code pour MySQL, PostgreSQL, SQLite... Si vous changez de base plus tard, vous changez juste la connexion, pas tout votre code.

Vous créez un objet PDO avec new PDO($dsn, $user, $pass, $options). Le DSN (Data Source Name) dit quel type de base et où : "mysql:host=localhost;dbname=test;charset=utf8mb4".

Les options importantes : ERRMODE_EXCEPTION lance des exceptions en cas d\'erreur (obligatoire), FETCH_ASSOC retourne des tableaux associatifs (plus pratique), EMULATE_PREPARES à false utilise vraies requêtes préparées (plus sécurisé).

PDO protège contre les injections SQL si vous utilisez les requêtes préparées correctement.',
                'useCases' => [
                    'Connexion MySQL : new PDO("mysql:host=localhost;dbname=app", $u, $p)',
                    'SQLite fichier : new PDO("sqlite:/path/to/database.db") sans user/pass',
                    'PostgreSQL : new PDO("pgsql:host=localhost;dbname=app", $u, $p)',
                    'Options sécurité : tableau options avec ERRMODE, FETCH_MODE configs',
                    'Multi-bases : même code PDO, changer juste DSN selon environnement',
                    'Tests unitaires : SQLite en mémoire "sqlite::memory:" pour tests rapides'
                ],
                'warnings' => [
                    'Pas d\'options : sans ERRMODE_EXCEPTION, erreurs silencieuses difficiles déboguer',
                    'EMULATE_PREPARES true : émulation PHP moins sécurisée, mettre false',
                    'FETCH_BOTH défaut : retourne index ET clés, doublon mémoire inutile',
                    'Connexion persistante : ATTR_PERSISTENT peut causer problèmes transactions'
                ],
                'bestPractices' => [
                    'Toujours options : array obligatoire avec ERRMODE, FETCH_MODE, EMULATE_PREPARES',
                    'DSN complet : inclure charset=utf8mb4 pour support complet Unicode',
                    'Injection dépendances : passer $pdo en paramètre, pas créer partout',
                    'Try/catch connexion : gérer PDOException lors new PDO() création',
                    'Mode production : logger erreurs, afficher message générique utilisateur'
                ],
                'resources' => [
                    ['title' => 'PDO Options', 'url' => 'https://www.php.net/manual/fr/pdo.setattribute.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-introduction_bdd', 'label' => 'Introduction BDD'],
                    ['id' => 'modal-requetes_preparees', 'label' => 'Requêtes préparées'],
                    ['id' => 'modal-gestion_erreurs', 'label' => 'Gestion erreurs']
                ]
            ],
            'requetes_select' => [
                'description' => 'SELECT permet de récupérer des données. On utilise les méthodes query() pour les requêtes simples et prepare() + execute() pour les requêtes avec paramètres.',
                'example' => '// Requête simple\n$stmt = $pdo->query("SELECT * FROM users");\n$users = $stmt->fetchAll();\n\n// Requête avec paramètres (sécurisée)\n$stmt = $pdo->prepare("SELECT * FROM users WHERE age > ? AND city = ?");\n$stmt->execute([18, "Paris"]);\n$users = $stmt->fetchAll();',
                'details' => 'SELECT lit des données dans la base. C\'est comme faire une recherche dans un tableau géant. Vous dites quelles colonnes vous voulez, dans quelle table, avec quelles conditions.

Si la requête est fixe (pas de variables), utilisez query() : $pdo->query("SELECT * FROM users"). Si vous avez des variables ($age, $city...), utilisez TOUJOURS prepare() + execute() pour sécuriser.

Les méthodes de récupération : fetch() une ligne, fetchAll() toutes les lignes, fetchColumn() une colonne. Avec FETCH_ASSOC, vous avez des tableaux : $user["nom"], $user["email"].

Ne JAMAIS concaténer des variables dans SQL : "WHERE id = $id" est dangereux. Toujours paramètres : "WHERE id = ?" avec execute([$id]).',
                'useCases' => [
                    'Liste utilisateurs : SELECT * FROM users ORDER BY created_at DESC',
                    'Recherche : SELECT * FROM products WHERE nom LIKE ? execute(["%$search%"])',
                    'Pagination : SELECT * FROM posts LIMIT 10 OFFSET 20 pour page 3',
                    'Comptage : SELECT COUNT(*) as total FROM orders WHERE status = "paid"',
                    'Une ligne : prepare + fetch() pour récupérer un seul utilisateur',
                    'Colonnes spécifiques : SELECT id, email FROM users pas * (performance)'
                ],
                'warnings' => [
                    'SELECT * : récupère toutes colonnes, lourd si table grosse (préciser colonnes)',
                    'Pas de LIMIT : sans limite, peut retourner millions lignes, crash mémoire',
                    'Concaténation : "WHERE id = $id" injection SQL, toujours paramètres',
                    'fetch() vs fetchAll() : fetch() une ligne, fetchAll() tableau, attention confusion'
                ],
                'bestPractices' => [
                    'Colonnes explicites : SELECT id, nom, email plutôt que SELECT *',
                    'LIMIT toujours : limiter résultats pour performance, paginer si besoin',
                    'Paramètres nommés : :email plus clair que ? pour requêtes complexes',
                    'Index BDD : créer index sur colonnes WHERE/ORDER BY (côté SQL)',
                    'Fetch mode : FETCH_ASSOC évite doublons index numériques inutiles'
                ],
                'resources' => [
                    ['title' => 'PDO fetch modes', 'url' => 'https://www.php.net/manual/fr/pdostatement.fetch.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-requetes_preparees', 'label' => 'Requêtes préparées'],
                    ['id' => 'modal-jointures', 'label' => 'Jointures'],
                    ['id' => 'modal-optimisation_requetes', 'label' => 'Optimisation']
                ]
            ],
            'requetes_preparees' => [
                'description' => 'Les requêtes préparées protègent contre les injections SQL en séparant le code SQL des données utilisateur. Elles sont essentielles pour la sécurité.',
                'example' => '// Requête préparée avec placeholders nommés\n$sql = "SELECT * FROM users WHERE email = :email AND active = :status";\n$stmt = $pdo->prepare($sql);\n$stmt->execute([\n    ":email" => $userEmail,\n    ":status" => 1\n]);\n$user = $stmt->fetch();',
                'details' => 'Les requêtes préparées sont LA protection anti-injection SQL. L\'injection SQL est quand un pirate tape du SQL dans un formulaire pour pirater votre base. Sans préparation, il peut lire/supprimer tout.

Vous préparez d\'abord la requête avec des placeholders (? ou :nom), puis vous exécutez avec les valeurs. PDO sépare le SQL des données : impossible d\'injecter du code malveillant.

Deux syntaxes : positionnelle avec ? (ordre compte) ou nommée avec :email (plus clair). Nommée est mieux pour requêtes complexes car vous voyez clairement ce que chaque paramètre fait.

À chaque fois que vous avez une variable utilisateur ($email, $id...) dans SQL, c\'est requête préparée obligatoire. Pas d\'exception.',
                'useCases' => [
                    'Login : WHERE email = :email AND password = :pass sécurisé',
                    'Recherche : WHERE titre LIKE :search avec [":search" => "%$term%"]',
                    'Multiple params : WHERE age > :min AND age < :max deux paramètres',
                    'Boucle INSERT : prepare une fois, execute plusieurs fois performances',
                    'UPDATE sécurisé : SET nom = :nom WHERE id = :id paramètres obligatoires',
                    'IN clause : WHERE id IN (?, ?, ?) avec array_fill pour nombre variable'
                ],
                'warnings' => [
                    'Jamais concaténer : "WHERE id = $id" vulnérable, "WHERE id = ?" sécurisé',
                    'Mauvais : bindValue() avec type incorrect peut causer bugs subtils',
                    'LIKE précaution : mettre % dans valeur ["%$term%"], pas dans SQL',
                    'Ordre positionnelle : avec ?, ordre array execute() doit matcher exact'
                ],
                'bestPractices' => [
                    'Paramètres nommés : :email, :age plus maintenable que ? positions',
                    'Toujours préparer : dès qu\'il y a variable utilisateur, pas concaténation',
                    'Réutilisation : préparer une fois, exécuter plusieurs fois en boucle',
                    'Validation avant : filter_var(), is_int() validation PHP en plus',
                    'Types explicites : bindValue(..., PDO::PARAM_INT) si besoin typage fort'
                ],
                'resources' => [
                    ['title' => 'Prepared Statements', 'url' => 'https://www.php.net/manual/fr/pdo.prepared-statements.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-securite_bdd', 'label' => 'Sécurité BDD'],
                    ['id' => 'modal-requetes_select', 'label' => 'Requêtes SELECT'],
                    ['id' => 'modal-insertion_donnees', 'label' => 'Insertion données']
                ]
            ],
            'insertion_donnees' => [
                'description' => 'INSERT permet d\'ajouter de nouvelles données dans une table. On utilise toujours des requêtes préparées pour sécuriser les insertions.',
                'example' => '// Insertion sécurisée avec requête préparée\n$sql = "INSERT INTO users (nom, email, age, created_at) VALUES (?, ?, ?, NOW())";\n$stmt = $pdo->prepare($sql);\n$stmt->execute(["Jean Dupont", "jean@email.com", 30]);\n\n// Récupérer l\'ID de l\'enregistrement créé\n$userId = $pdo->lastInsertId();\necho "Utilisateur créé avec l\'ID : " . $userId;',
                'details' => 'INSERT ajoute une nouvelle ligne dans une table. Vous précisez les colonnes et les valeurs correspondantes. Les colonnes AUTO_INCREMENT (comme id) sont remplies automatiquement.

La syntaxe : INSERT INTO table (col1, col2) VALUES (?, ?). Utilisez toujours prepare() + execute() pour sécuriser. Ne jamais faire INSERT avec concaténation de variables.

Après l\'insertion, lastInsertId() vous donne l\'ID auto-généré de la ligne créée. Pratique pour ensuite faire d\'autres opérations avec cette nouvelle donnée.

Attention aux colonnes obligatoires (NOT NULL) : si vous oubliez une colonne requise, erreur SQL. Validez vos données PHP avant d\'insérer.',
                'useCases' => [
                    'Inscription user : INSERT INTO users (email, password, created_at) VALUES',
                    'Nouvel article : INSERT INTO posts (titre, contenu, author_id) paramètres',
                    'Commande : INSERT puis lastInsertId() pour ajouter lignes commande_items',
                    'Upload fichier : INSERT chemin, nom, taille dans table files',
                    'Log activité : INSERT INTO logs (user_id, action, ip) traçabilité',
                    'Relation many-to-many : INSERT INTO user_roles (user_id, role_id) liaison'
                ],
                'warnings' => [
                    'Doublons : si UNIQUE constraint, erreur si email existe déjà (gérer)',
                    'Colonnes oubliées : NOT NULL colonnes non fournies causent erreur SQL',
                    'lastInsertId vide : si pas AUTO_INCREMENT ou transaction échouée, retourne 0',
                    'Validation manquante : insérer données non validées peut corrompre base'
                ],
                'bestPractices' => [
                    'Valider avant : filter_var(), strlen(), is_int() validation PHP obligatoire',
                    'Hash passwords : password_hash() avant INSERT, jamais en clair',
                    'Timestamps : created_at = NOW() ou date("Y-m-d H:i:s") en PHP',
                    'Try/catch : attraper PDOException pour gérer contraintes uniques',
                    'Retour lastInsertId : toujours récupérer ID pour opérations suivantes'
                ],
                'resources' => [
                    ['title' => 'PDO lastInsertId', 'url' => 'https://www.php.net/manual/fr/pdo.lastinsertid.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-requetes_preparees', 'label' => 'Requêtes préparées'],
                    ['id' => 'modal-mise_a_jour_donnees', 'label' => 'Mise à jour'],
                    ['id' => 'modal-transactions', 'label' => 'Transactions']
                ]
            ],
            'mise_a_jour_donnees' => [
                'description' => 'UPDATE modifie des données existantes. Il est crucial d\'utiliser une clause WHERE pour éviter de modifier toute la table par accident.',
                'example' => '// Mise à jour sécurisée\n$sql = "UPDATE users SET nom = ?, email = ?, updated_at = NOW() WHERE id = ?";\n$stmt = $pdo->prepare($sql);\n$stmt->execute(["Jean Martin", "jean.martin@email.com", $userId]);\n\n// Vérifier le nombre de lignes affectées\necho $stmt->rowCount() . " ligne(s) mise(s) à jour";',
                'details' => 'UPDATE change des données déjà existantes dans une table. C\'est comme modifier une ligne dans un tableur. Vous dites quelles colonnes changer (SET col = valeur) et quelles lignes modifier (WHERE condition).

LE PIÈGE : si vous oubliez WHERE, toute la table est modifiée ! "UPDATE users SET email = ?" sans WHERE met le même email à TOUS les utilisateurs. Catastrophe.

rowCount() vous dit combien de lignes ont été modifiées. Si 0, soit l\'ID n\'existe pas, soit les valeurs sont déjà identiques (pas de changement réel).

Toujours requête préparée pour UPDATE. Les valeurs SET et WHERE sont des paramètres : SET nom = ? WHERE id = ?.',
                'useCases' => [
                    'Profil user : UPDATE users SET nom = ?, bio = ? WHERE id = :userId',
                    'Statut commande : UPDATE orders SET status = "shipped" WHERE id = ?',
                    'Compteur : UPDATE posts SET views = views + 1 WHERE id = ? incrémente',
                    'Timestamps : SET updated_at = NOW() WHERE id = ? traçabilité',
                    'Validation : UPDATE users SET email_verified = 1 WHERE token = ?',
                    'Multiple colonnes : SET col1 = ?, col2 = ?, col3 = ? plusieurs changements'
                ],
                'warnings' => [
                    'WHERE oublié : UPDATE sans WHERE modifie TOUTE la table, désastre',
                    'rowCount() 0 : peut signifier ID inexistant ou valeurs déjà identiques',
                    'Concurrence : deux UPDATE simultanés peuvent s\'écraser, voir transactions',
                    'Colonnes sensibles : password/email UPDATE besoin validation extra stricte'
                ],
                'bestPractices' => [
                    'WHERE obligatoire : toujours condition WHERE, jamais UPDATE table entière',
                    'Vérifier rowCount : contrôler si mise à jour a réussi (> 0)',
                    'updated_at : ajouter colonne timestamp pour tracer modifications',
                    'Validation stricte : vérifier données avant UPDATE comme pour INSERT',
                    'Transactions : si UPDATE multiple lié, utiliser beginTransaction()'
                ],
                'resources' => [
                    ['title' => 'PDO rowCount', 'url' => 'https://www.php.net/manual/fr/pdostatement.rowcount.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-requetes_preparees', 'label' => 'Requêtes préparées'],
                    ['id' => 'modal-insertion_donnees', 'label' => 'Insertion'],
                    ['id' => 'modal-transactions', 'label' => 'Transactions']
                ]
            ],
            'suppression_donnees' => [
                'description' => 'DELETE supprime des données. Attention à toujours utiliser une clause WHERE spécifique pour éviter de vider toute la table.',
                'example' => '// Suppression sécurisée\n$sql = "DELETE FROM users WHERE id = ? AND active = 0";\n$stmt = $pdo->prepare($sql);\n$stmt->execute([$userId]);\n\nif ($stmt->rowCount() > 0) {\n    echo "Utilisateur supprimé avec succès";\n} else {\n    echo "Aucun utilisateur supprimé";\n}',
                'details' => 'DELETE efface des lignes de la table. C\'est DÉFINITIF : pas de corbeille, pas de retour en arrière (sauf backup ou transaction). Une fois DELETE exécuté, les données sont perdues.

DANGER MAXIMUM : DELETE sans WHERE vide toute la table. "DELETE FROM users" supprime tous les utilisateurs. Catastrophe irréversible. Toujours WHERE avec condition précise.

rowCount() indique combien de lignes ont été supprimées. Si 0, soit l\'ID n\'existe pas, soit la condition WHERE n\'a matché aucune ligne.

Alternative soft delete : plutôt que DELETE, faites UPDATE avec colonne deleted_at. Vous "marquez" supprimé sans vraiment effacer. Pratique pour historique.',
                'useCases' => [
                    'Compte utilisateur : DELETE FROM users WHERE id = ? AND can_delete = 1',
                    'Nettoyer logs : DELETE FROM logs WHERE created_at < DATE_SUB(NOW(), INTERVAL 30 DAY)',
                    'Panier abandonné : DELETE FROM cart_items WHERE cart_id = ?',
                    'Session expirée : DELETE FROM sessions WHERE expires_at < NOW()',
                    'Cascade : DELETE parent supprime enfants si ON DELETE CASCADE',
                    'Soft delete préféré : UPDATE users SET deleted_at = NOW() plutôt DELETE'
                ],
                'warnings' => [
                    'WHERE oublié : DELETE sans WHERE supprime TOUTE la table, irréversible',
                    'Contraintes FK : si enfants liés, erreur si pas ON DELETE CASCADE défini',
                    'Pas de UNDO : DELETE est permanent, pas annulation (sauf transaction rollback)',
                    'rowCount 0 : peut signifier ID déjà supprimé, vérifier avant'
                ],
                'bestPractices' => [
                    'WHERE strict : condition précise id = ? AND status = "deletable"',
                    'Soft delete : colonne deleted_at NULL ou timestamp plutôt vrai DELETE',
                    'Backup avant : sauvegarder données critiques avant DELETE masse',
                    'Transactions : DELETE multiple dans transaction, rollback si erreur',
                    'Confirmation : double vérification utilisateur avant DELETE important'
                ],
                'resources' => [
                    ['title' => 'SQL DELETE', 'url' => 'https://www.w3schools.com/sql/sql_delete.asp', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-requetes_preparees', 'label' => 'Requêtes préparées'],
                    ['id' => 'modal-mise_a_jour_donnees', 'label' => 'Mise à jour'],
                    ['id' => 'modal-transactions', 'label' => 'Transactions']
                ]
            ],
            'transactions' => [
                'description' => 'Les transactions garantissent l\'intégrité des données en groupant plusieurs opérations. Si une échoue, toutes sont annulées (rollback).',
                'example' => 'try {\n    $pdo->beginTransaction();\n    \n    // Opération 1 : Débiter le compte A\n    $stmt1 = $pdo->prepare("UPDATE comptes SET solde = solde - ? WHERE id = ?");\n    $stmt1->execute([100, $compteA]);\n    \n    // Opération 2 : Créditer le compte B\n    $stmt2 = $pdo->prepare("UPDATE comptes SET solde = solde + ? WHERE id = ?");\n    $stmt2->execute([100, $compteB]);\n    \n    $pdo->commit(); // Valider les changements\n    echo "Virement réussi";\n} catch (Exception $e) {\n    $pdo->rollback(); // Annuler en cas d\'erreur\n    echo "Erreur : " . $e->getMessage();\n}',
                'details' => 'Une transaction groupe plusieurs requêtes en un bloc atomique : soit tout réussit, soit tout est annulé. C\'est la garantie que vos données restent cohérentes même si une opération plante.

Exemple classique : virement bancaire. Vous débitez compte A, créditez compte B. Si le crédit plante, le débit doit être annulé, sinon l\'argent disparaît. Transaction = sécurité.

beginTransaction() démarre, commit() valide tout, rollback() annule tout. Dans try/catch, si exception, rollback automatique. Les requêtes dans la transaction ne sont visibles qu\'après commit().

Pas de transaction = risque d\'incohérence. Utilisez pour toute opération multi-requêtes liées (commande + lignes, user + profil, etc.).',
                'useCases' => [
                    'Virement : débiter + créditer atomique, rollback si erreur',
                    'Commande : INSERT order + INSERT order_items + UPDATE stock ensemble',
                    'Inscription : INSERT user + INSERT user_profile + INSERT default_settings',
                    'Import masse : BEGIN + 1000 INSERT + COMMIT rapide et sûr',
                    'Suppression cascade : DELETE parent + DELETE enfants cohérent',
                    'Mise à jour compteurs : plusieurs UPDATE liés garantis consistants'
                ],
                'warnings' => [
                    'Oublier commit : beginTransaction() sans commit() ne sauvegarde rien',
                    'Oublier rollback : exception sans rollback laisse transaction pendante',
                    'Deadlock : deux transactions qui s\'attendent mutuellement, timeout',
                    'Transactions longues : bloquer table longtemps ralentit toute application'
                ],
                'bestPractices' => [
                    'Try/catch obligatoire : toujours rollback() dans catch en cas erreur',
                    'Courtes transactions : begin, requêtes, commit rapide, pas logique longue',
                    'Vérifications avant : valider données PHP avant beginTransaction()',
                    'Isolation level : comprendre READ COMMITTED, SERIALIZABLE selon besoin',
                    'Logs détaillés : logger opérations transaction pour debugging'
                ],
                'resources' => [
                    ['title' => 'PDO Transactions', 'url' => 'https://www.php.net/manual/fr/pdo.transactions.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-insertion_donnees', 'label' => 'Insertion'],
                    ['id' => 'modal-mise_a_jour_donnees', 'label' => 'Mise à jour'],
                    ['id' => 'modal-gestion_erreurs', 'label' => 'Gestion erreurs']
                ]
            ],
            'jointures' => [
                'description' => 'Les jointures permettent de récupérer des données de plusieurs tables liées. INNER JOIN, LEFT JOIN, RIGHT JOIN ont des comportements différents.',
                'example' => '// INNER JOIN : récupère seulement les données présentes dans les deux tables\n$sql = "SELECT u.nom, u.email, p.titre \n        FROM users u \n        INNER JOIN posts p ON u.id = p.user_id \n        WHERE u.active = 1";\n\n// LEFT JOIN : récupère tous les users, même sans posts\n$sql = "SELECT u.nom, COUNT(p.id) as nb_posts \n        FROM users u \n        LEFT JOIN posts p ON u.id = p.user_id \n        GROUP BY u.id";',
                'details' => 'Les jointures combinent des données de plusieurs tables liées par des clés. Au lieu de faire plusieurs requêtes, vous récupérez tout d\'un coup avec JOIN.

INNER JOIN : seulement les lignes qui matchent dans les deux tables. Users avec posts uniquement.
LEFT JOIN : tous de la table gauche, même si pas de match à droite. Tous les users, posts NULL si aucun.
RIGHT JOIN : inverse de LEFT, rarement utilisé.

La condition ON précise comment les tables sont liées : ON u.id = p.user_id. Utilisez des alias (u, p) pour clarifier.

Attention performance : trop de JOIN ralentit. Optimisez avec index sur colonnes de jointure.',
                'useCases' => [
                    'Posts + auteur : INNER JOIN users ON posts.user_id = users.id',
                    'Users + comptage : LEFT JOIN posts, COUNT() pour nb articles par user',
                    'Commandes + détails : JOIN order_items ON orders.id = order_items.order_id',
                    'Many-to-many : JOIN table pivot, JOIN table cible (users roles permissions)',
                    'Catégories + produits : LEFT JOIN produits COUNT groupé par catégorie',
                    'WHERE sur JOIN : AND status = "active" filtrer après jointure'
                ],
                'warnings' => [
                    'Produit cartésien : JOIN sans ON multiplie lignes exponentiellement, crash',
                    'N+1 queries : plusieurs requêtes boucle pire que un JOIN unique',
                    'NULL confusion : LEFT JOIN peut retourner NULL, vérifier IS NULL',
                    'Performance : 5+ JOIN ralentit beaucoup, repenser architecture'
                ],
                'bestPractices' => [
                    'Alias tables : u, p, c plus lisible que noms complets répétés',
                    'Index FK : créer index sur colonnes foreign key pour performance JOIN',
                    'SELECT explicite : u.nom, p.titre évite ambiguïté colonnes même nom',
                    'LEFT JOIN comptage : avec COUNT(p.id) pas COUNT(*) pour éviter 1 si NULL',
                    'Limiter JOIN : 3-4 maximum, sinon repenser schéma ou utiliser cache'
                ],
                'resources' => [
                    ['title' => 'SQL Joins', 'url' => 'https://www.w3schools.com/sql/sql_join.asp', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-requetes_select', 'label' => 'Requêtes SELECT'],
                    ['id' => 'modal-optimisation_requetes', 'label' => 'Optimisation'],
                    ['id' => 'modal-orm_doctrine', 'label' => 'ORM Doctrine']
                ]
            ],
            'gestion_erreurs' => [
                'description' => 'La gestion d\'erreurs avec PDO utilise les exceptions. On configure PDO::ERRMODE_EXCEPTION pour capturer automatiquement les erreurs.',
                'example' => 'try {\n    $pdo = new PDO($dsn, $username, $password, [\n        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION\n    ]);\n    \n    $stmt = $pdo->prepare("SELECT * FROM table_inexistante");\n    $stmt->execute();\n} catch (PDOException $e) {\n    // Erreur spécifique à PDO\n    error_log("Erreur PDO : " . $e->getMessage());\n    echo "Erreur de base de données";\n} catch (Exception $e) {\n    // Autres erreurs\n    error_log("Erreur générale : " . $e->getMessage());\n    echo "Erreur système";\n}',
                'details' => 'PDO peut gérer les erreurs de 3 façons : silent (défaut, rien), warning (message PHP), exception (recommandé). ERRMODE_EXCEPTION lance PDOException en cas d\'erreur SQL.

Avec exceptions, vous utilisez try/catch. Si requête plante (table inexistante, syntax erreur, contrainte violée), catch attrape et vous gérez proprement sans crash application.

PDOException contient getMessage() (texte erreur), getCode() (code erreur MySQL), et plus. Loggez en production, affichez message générique à l\'utilisateur (pas détails SQL).

Ne jamais montrer getMessage() à l\'utilisateur : révèle structure BDD, faille sécurité. Logger pour debug, afficher "Erreur technique" générique.',
                'useCases' => [
                    'Connexion échouée : catch PDOException si credentials invalides',
                    'Contrainte UNIQUE : catch erreur 23000 si email doublon, message clair',
                    'Table inexistante : catch erreur 42S02 migrations mal appliquées',
                    'FK violation : catch erreur 23000 si DELETE parent avec enfants',
                    'Timeout : catch erreur 2002 si serveur BDD down ou lent',
                    'Transaction rollback : catch exception, rollback, logger détails'
                ],
                'warnings' => [
                    'Afficher getMessage() : révèle structure BDD, faille sécurité production',
                    'Mode silent : sans ERRMODE_EXCEPTION, erreurs silencieuses impossibles déboguer',
                    'Catch trop large : catch (Exception) attrape tout, masque bugs autres',
                    'Pas de log : erreurs sans log impossibles diagnostiquer production'
                ],
                'bestPractices' => [
                    'ERRMODE_EXCEPTION : toujours dans options PDO, obligatoire',
                    'Catch spécifique : PDOException puis Exception hiérarchie logique',
                    'Log erreurs : error_log() avec contexte (query, params, user)',
                    'Message utilisateur : générique "Erreur technique", pas SQL détails',
                    'Codes erreur : switch getCode() pour réponses adaptées (23000 = doublon)'
                ],
                'resources' => [
                    ['title' => 'PDO Error Handling', 'url' => 'https://www.php.net/manual/fr/pdo.error-handling.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-pdo_introduction', 'label' => 'PDO Introduction'],
                    ['id' => 'modal-transactions', 'label' => 'Transactions'],
                    ['id' => 'modal-securite_bdd', 'label' => 'Sécurité BDD']
                ]
            ],
            'orm_doctrine' => [
                'description' => 'Doctrine ORM est un mappeur objet-relationnel qui permet de manipuler la base de données via des objets PHP plutôt que du SQL brut.',
                'example' => '// Avec Doctrine ORM (dans Symfony)\n// 1. Récupération d\'entités\n$users = $entityManager->getRepository(User::class)->findAll();\n\n// 2. Création d\'une nouvelle entité\n$user = new User();\n$user->setNom("Jean Dupont");\n$user->setEmail("jean@email.com");\n\n$entityManager->persist($user);\n$entityManager->flush(); // Sauvegarde en BDD\n\n// 3. Requête avec QueryBuilder\n$users = $entityManager->createQueryBuilder()\n    ->select(\'u\')\n    ->from(User::class, \'u\')\n    ->where(\'u.age > :age\')\n    ->setParameter(\'age\', 18)\n    ->getQuery()\n    ->getResult();',
                'details' => 'Un ORM (Object-Relational Mapping) transforme vos tables en classes PHP et vos lignes en objets. Au lieu d\'écrire du SQL, vous manipulez des objets : $user->setEmail(). L\'ORM génère le SQL automatiquement.

Doctrine est l\'ORM standard Symfony. Une table users devient une class User (Entity). persist() dit à Doctrine "prépare cet objet", flush() envoie tout en BDD avec les INSERT/UPDATE nécessaires.

Avantages : code plus lisible, typage fort, relations automatiques ($user->getPosts()), migrations gérées. Inconvénient : courbe apprentissage, moins performant que SQL natif optimisé.

Pour requêtes complexes, QueryBuilder ou DQL (Doctrine Query Language) remplacent SQL avec syntaxe orientée objet.',
                'useCases' => [
                    'CRUD simple : findAll(), find($id), persist(), remove() sans SQL',
                    'Relations : $user->getPosts() charge automatiquement posts liés',
                    'Requêtes complexes : QueryBuilder ->where()->orderBy()->limit() objet',
                    'Hydratation : résultats transformés automatiquement en objets typés',
                    'Changement BDD : passer MySQL à PostgreSQL transparent pour code',
                    'Validation : annotations @Assert intégrées avec entités'
                ],
                'warnings' => [
                    'N+1 queries : $user->getPosts() en boucle fait 1 query par user (lent)',
                    'Eager loading : jointures automatiques peuvent charger trop données',
                    'Performance : ORM overhead, SQL natif plus rapide requêtes complexes',
                    'Courbe apprentissage : DQL, QueryBuilder, lifecycle events à maîtriser'
                ],
                'bestPractices' => [
                    'Repositories : méthodes custom dans UserRepository, pas contrôleur',
                    'findBy() simple : findBy(["email" => $email]) plutôt QueryBuilder basique',
                    'JOIN fetch : leftJoin()->addSelect() éviter N+1 queries',
                    'SQL natif si besoin : $em->getConnection()->executeQuery() pour perf',
                    'Transactions : flush() dans try/catch, clear() si erreur'
                ],
                'resources' => [
                    ['title' => 'Doctrine ORM', 'url' => 'https://www.doctrine-project.org/projects/orm.html', 'icon' => '📖'],
                    ['title' => 'Symfony Doctrine', 'url' => 'https://symfony.com/doc/current/doctrine.html', 'icon' => '🔗']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-pdo_introduction', 'label' => 'PDO Introduction'],
                    ['id' => 'modal-migrations', 'label' => 'Migrations'],
                    ['id' => 'modal-jointures', 'label' => 'Jointures']
                ]
            ],
            'migrations' => [
                'description' => 'Les migrations permettent de versionner et d\'appliquer des changements de structure de base de données de manière contrôlée et réversible.',
                'example' => '// Migration Doctrine (Symfony)\n// Créer une migration\n// php bin/console make:migration\n\n// Fichier de migration généré\npublic function up(Schema $schema): void\n{\n    $this->addSql(\'CREATE TABLE user (\n        id INT AUTO_INCREMENT NOT NULL,\n        nom VARCHAR(255) NOT NULL,\n        email VARCHAR(255) NOT NULL,\n        created_at DATETIME NOT NULL,\n        PRIMARY KEY(id)\n    )\');\n}\n\npublic function down(Schema $schema): void\n{\n    $this->addSql(\'DROP TABLE user\');\n}\n\n// Appliquer les migrations\n// php bin/console doctrine:migrations:migrate',
                'details' => 'Les migrations versionnent votre structure de base : comme Git pour le code, mais pour les tables/colonnes. Chaque changement (ajout colonne, nouvelle table) est un fichier migration horodaté.

up() applique le changement (CREATE TABLE, ALTER TABLE ADD COLUMN...), down() l\'annule (DROP TABLE, ALTER TABLE DROP COLUMN). Vous pouvez avancer/reculer dans l\'historique de votre schéma.

Dans Symfony/Doctrine, make:migration génère automatiquement le fichier en comparant vos entités PHP avec la BDD actuelle. doctrine:migrations:migrate applique toutes les migrations pas encore faites.

Avantage énorme : toute l\'équipe partage les mêmes migrations. Déploiement = appliquer migrations, structure synchronisée automatiquement.',
                'useCases' => [
                    'Nouvelle table : make:migration génère CREATE TABLE automatique',
                    'Ajout colonne : ALTER TABLE users ADD COLUMN phone VARCHAR(20)',
                    'Changement type : ALTER TABLE users MODIFY COLUMN age SMALLINT',
                    'Index : CREATE INDEX idx_email ON users(email) pour performance',
                    'Rollback : migrate prev pour annuler dernière migration si erreur',
                    'Production : migrations appliquées automatiquement déploiement CI/CD'
                ],
                'warnings' => [
                    'down() manquant : migration pas réversible, problème si rollback nécessaire',
                    'Migration éditée : ne JAMAIS modifier migration déjà appliquée production',
                    'Données perdues : DROP COLUMN supprime données, sauvegarder avant',
                    'Ordre important : migrations appliquées ordre chronologique, dépendances'
                ],
                'bestPractices' => [
                    'Toujours down() : rendre migrations réversibles pour rollback sécurisé',
                    'Backup avant : sauvegarder BDD avant migrations importantes production',
                    'Tester local : vérifier up() ET down() environnement dev avant production',
                    'Commits atomiques : 1 migration = 1 commit Git pour traçabilité',
                    'Messages clairs : nommer fichier migration descriptif (add_user_phone_column)'
                ],
                'resources' => [
                    ['title' => 'Doctrine Migrations', 'url' => 'https://www.doctrine-project.org/projects/migrations.html', 'icon' => '📖'],
                    ['title' => 'Symfony Migrations', 'url' => 'https://symfony.com/doc/current/doctrine.html#migrations', 'icon' => '🔗']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-orm_doctrine', 'label' => 'ORM Doctrine'],
                    ['id' => 'modal-introduction_bdd', 'label' => 'Introduction BDD'],
                    ['id' => 'modal-pdo_introduction', 'label' => 'PDO']
                ]
            ],
            'optimisation_requetes' => [
                'description' => 'L\'optimisation des requêtes améliore les performances : utilisation d\'index, limitation des résultats, éviter N+1 queries, utilisation du cache.',
                'example' => '// Optimisations courantes\n\n// 1. Utiliser LIMIT pour paginer\n$sql = "SELECT * FROM posts ORDER BY created_at DESC LIMIT 10 OFFSET 20";\n\n// 2. Utiliser des index (en SQL)\n// CREATE INDEX idx_user_email ON users(email);\n// CREATE INDEX idx_post_date ON posts(created_at);\n\n// 3. Éviter N+1 queries avec des jointures\n$sql = "SELECT u.*, p.titre \n        FROM users u \n        LEFT JOIN posts p ON u.id = p.user_id";\n\n// 4. Utiliser des requêtes préparées réutilisables\n$stmt = $pdo->prepare("SELECT * FROM users WHERE city = ?");\nforeach ($cities as $city) {\n    $stmt->execute([$city]);\n    $users = $stmt->fetchAll();\n    // Traitement...\n}',
                'details' => 'Une requête lente ralentit tout votre site. L\'optimisation rend les requêtes rapides même avec millions de lignes. Plusieurs techniques existent.

Index : comme l\'index d\'un livre, permet de trouver vite. CREATE INDEX sur colonnes WHERE/ORDER BY accélère énormément. Mais trop d\'index ralentit INSERT/UPDATE.

N+1 queries : le piège classique. Vous récupérez 10 users, puis pour chacun vous faites SELECT posts. 1 + 10 = 11 requêtes. Solution : 1 seule requête avec JOIN.

LIMIT/OFFSET : paginez toujours. Ne chargez jamais 100000 lignes d\'un coup. Cache : Redis/Memcached pour requêtes répétées identiques.

EXPLAIN devant votre SELECT montre si index utilisé. Si "full table scan", c\'est lent, ajoutez index.',
                'useCases' => [
                    'Index email : CREATE INDEX idx_email ON users(email) pour WHERE email =',
                    'Pagination : LIMIT 20 OFFSET 40 plutôt que fetchAll() tout charger',
                    'COUNT rapide : SELECT COUNT(*) avec index plutôt que count(fetchAll())',
                    'Cache requêtes : Redis stocke résultats 5 min pour listes populaires',
                    'Colonnes précises : SELECT id, nom pas SELECT * économise mémoire',
                    'Batch INSERT : beginTransaction() + boucle INSERT + commit() plus rapide'
                ],
                'warnings' => [
                    'Trop index : chaque index ralentit INSERT/UPDATE, 3-5 max par table',
                    'SELECT * : charge colonnes inutiles (blob, text lourds), préciser colonnes',
                    'ORDER BY sans index : tri en mémoire très lent, créer index colonne tri',
                    'Sous-requêtes : souvent moins performantes que JOIN, préférer JOIN'
                ],
                'bestPractices' => [
                    'EXPLAIN requêtes : EXPLAIN SELECT montre plan exécution, vérifier index utilisés',
                    'Index composites : INDEX(city, age) pour WHERE city = ? AND age > ?',
                    'Pagination curseur : WHERE id > :last_id mieux que OFFSET grandes pages',
                    'Eager loading : ORM jointures explicites éviter N+1 queries',
                    'Monitoring : log slow queries (> 1s) pour identifier problèmes'
                ],
                'resources' => [
                    ['title' => 'MySQL Index', 'url' => 'https://dev.mysql.com/doc/refman/8.0/en/optimization-indexes.html', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-requetes_select', 'label' => 'Requêtes SELECT'],
                    ['id' => 'modal-jointures', 'label' => 'Jointures'],
                    ['id' => 'modal-orm_doctrine', 'label' => 'ORM Doctrine']
                ]
            ],
            'securite_bdd' => [
                'description' => 'La sécurité des bases de données passe par les requêtes préparées, la validation des données, les privilèges limités et le chiffrement des mots de passe.',
                'example' => '// Bonnes pratiques de sécurité\n\n// 1. TOUJOURS utiliser des requêtes préparées\n$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");\n$stmt->execute([$_POST[\'email\']]);\n\n// 2. Valider et nettoyer les données\n$email = filter_var($_POST[\'email\'], FILTER_VALIDATE_EMAIL);\nif (!$email) {\n    throw new InvalidArgumentException("Email invalide");\n}\n\n// 3. Hasher les mots de passe\n$hashedPassword = password_hash($_POST[\'password\'], PASSWORD_DEFAULT);\n$stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");\n$stmt->execute([$email, $hashedPassword]);\n\n// 4. Vérifier les mots de passe\nif (password_verify($_POST[\'password\'], $user[\'password\'])) {\n    echo "Connexion réussie";\n}',
                'details' => 'La sécurité BDD est CRITIQUE. Un pirate qui accède à votre base vole emails, mots de passe, données personnelles. Protection multi-niveaux obligatoire.

Règle #1 : requêtes préparées TOUJOURS. "WHERE id = $id" = injection SQL, pirate exécute ce qu\'il veut. Préparée bloque tout.

Règle #2 : hasher passwords. JAMAIS stocker en clair. password_hash() crée hash irréversible. password_verify() vérifie sans révéler le password.

Règle #3 : privilèges minimaux. Utilisateur BDD application ne doit pas avoir DROP DATABASE. Seulement SELECT/INSERT/UPDATE/DELETE tables nécessaires.

Variables environnement, SSL connexion, backup chiffré, logs audits complètent la sécurité.',
                'useCases' => [
                    'Requêtes préparées : WHERE email = ? bloque injection SQL 100%',
                    'Password hash : password_hash() avant INSERT, jamais texte clair',
                    'Validation : filter_var(), is_int() vérifier données avant requête',
                    'Privilèges : GRANT SELECT,INSERT,UPDATE sur app_db.* TO "app_user"',
                    'SSL/TLS : connexion chiffrée entre PHP et serveur MySQL distant',
                    'Backup chiffré : sauvegardes avec encryption AES-256'
                ],
                'warnings' => [
                    'Injection SQL : concaténation variables = piratage garanti, toujours préparer',
                    'Passwords clairs : stockage texte clair = catastrophe si BDD volée',
                    'Privilèges root : application avec accès DROP TABLE peut être piratée',
                    'Erreurs affichées : getMessage() révèle structure BDD, masquer production'
                ],
                'bestPractices' => [
                    'Requêtes préparées : 100% temps, aucune exception même "sûr"',
                    'password_hash() : PASSWORD_DEFAULT s\'adapte automatiquement algorithmes futurs',
                    'Variables .env : credentials jamais dans code, .env hors Git',
                    'Rate limiting : limiter tentatives connexion contre bruteforce',
                    'Audit logs : tracer qui fait quoi (INSERT/UPDATE/DELETE) avec timestamps'
                ],
                'resources' => [
                    ['title' => 'OWASP SQL Injection', 'url' => 'https://owasp.org/www-community/attacks/SQL_Injection', 'icon' => '🔗'],
                    ['title' => 'PHP password_hash', 'url' => 'https://www.php.net/manual/fr/function.password-hash.php', 'icon' => '📖']
                ],
                'relatedTopics' => [
                    ['id' => 'modal-requetes_preparees', 'label' => 'Requêtes préparées'],
                    ['id' => 'modal-pdo_introduction', 'label' => 'PDO'],
                    ['id' => 'modal-gestion_erreurs', 'label' => 'Gestion erreurs']
                ]
            ],
        ];

        return $this->render('bdd/index.html.twig', [
            'data' => $dataBDD,
        ]);
    }
}
