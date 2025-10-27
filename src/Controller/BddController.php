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
            ],
            'pdo_introduction' => [
                'description' => 'PDO (PHP Data Objects) est l\'extension recommandée pour interagir avec les bases de données. Elle offre une interface unifiée pour différents SGBD (MySQL, PostgreSQL, SQLite, etc.).',
                'example' => '// Configuration PDO avec options de sécurité\n$options = [\n    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,\n    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,\n    PDO::ATTR_EMULATE_PREPARES => false\n];\n\n$pdo = new PDO($dsn, $username, $password, $options);',
            ],
            'requetes_select' => [
                'description' => 'SELECT permet de récupérer des données. On utilise les méthodes query() pour les requêtes simples et prepare() + execute() pour les requêtes avec paramètres.',
                'example' => '// Requête simple\n$stmt = $pdo->query("SELECT * FROM users");\n$users = $stmt->fetchAll();\n\n// Requête avec paramètres (sécurisée)\n$stmt = $pdo->prepare("SELECT * FROM users WHERE age > ? AND city = ?");\n$stmt->execute([18, "Paris"]);\n$users = $stmt->fetchAll();',
            ],
            'requetes_preparees' => [
                'description' => 'Les requêtes préparées protègent contre les injections SQL en séparant le code SQL des données utilisateur. Elles sont essentielles pour la sécurité.',
                'example' => '// Requête préparée avec placeholders nommés\n$sql = "SELECT * FROM users WHERE email = :email AND active = :status";\n$stmt = $pdo->prepare($sql);\n$stmt->execute([\n    ":email" => $userEmail,\n    ":status" => 1\n]);\n$user = $stmt->fetch();',
            ],
            'insertion_donnees' => [
                'description' => 'INSERT permet d\'ajouter de nouvelles données dans une table. On utilise toujours des requêtes préparées pour sécuriser les insertions.',
                'example' => '// Insertion sécurisée avec requête préparée\n$sql = "INSERT INTO users (nom, email, age, created_at) VALUES (?, ?, ?, NOW())";\n$stmt = $pdo->prepare($sql);\n$stmt->execute(["Jean Dupont", "jean@email.com", 30]);\n\n// Récupérer l\'ID de l\'enregistrement créé\n$userId = $pdo->lastInsertId();\necho "Utilisateur créé avec l\'ID : " . $userId;',
            ],
            'mise_a_jour_donnees' => [
                'description' => 'UPDATE modifie des données existantes. Il est crucial d\'utiliser une clause WHERE pour éviter de modifier toute la table par accident.',
                'example' => '// Mise à jour sécurisée\n$sql = "UPDATE users SET nom = ?, email = ?, updated_at = NOW() WHERE id = ?";\n$stmt = $pdo->prepare($sql);\n$stmt->execute(["Jean Martin", "jean.martin@email.com", $userId]);\n\n// Vérifier le nombre de lignes affectées\necho $stmt->rowCount() . " ligne(s) mise(s) à jour";',
            ],
            'suppression_donnees' => [
                'description' => 'DELETE supprime des données. Attention à toujours utiliser une clause WHERE spécifique pour éviter de vider toute la table.',
                'example' => '// Suppression sécurisée\n$sql = "DELETE FROM users WHERE id = ? AND active = 0";\n$stmt = $pdo->prepare($sql);\n$stmt->execute([$userId]);\n\nif ($stmt->rowCount() > 0) {\n    echo "Utilisateur supprimé avec succès";\n} else {\n    echo "Aucun utilisateur supprimé";\n}',
            ],
            'transactions' => [
                'description' => 'Les transactions garantissent l\'intégrité des données en groupant plusieurs opérations. Si une échoue, toutes sont annulées (rollback).',
                'example' => 'try {\n    $pdo->beginTransaction();\n    \n    // Opération 1 : Débiter le compte A\n    $stmt1 = $pdo->prepare("UPDATE comptes SET solde = solde - ? WHERE id = ?");\n    $stmt1->execute([100, $compteA]);\n    \n    // Opération 2 : Créditer le compte B\n    $stmt2 = $pdo->prepare("UPDATE comptes SET solde = solde + ? WHERE id = ?");\n    $stmt2->execute([100, $compteB]);\n    \n    $pdo->commit(); // Valider les changements\n    echo "Virement réussi";\n} catch (Exception $e) {\n    $pdo->rollback(); // Annuler en cas d\'erreur\n    echo "Erreur : " . $e->getMessage();\n}',
            ],
            'jointures' => [
                'description' => 'Les jointures permettent de récupérer des données de plusieurs tables liées. INNER JOIN, LEFT JOIN, RIGHT JOIN ont des comportements différents.',
                'example' => '// INNER JOIN : récupère seulement les données présentes dans les deux tables\n$sql = "SELECT u.nom, u.email, p.titre \n        FROM users u \n        INNER JOIN posts p ON u.id = p.user_id \n        WHERE u.active = 1";\n\n// LEFT JOIN : récupère tous les users, même sans posts\n$sql = "SELECT u.nom, COUNT(p.id) as nb_posts \n        FROM users u \n        LEFT JOIN posts p ON u.id = p.user_id \n        GROUP BY u.id";',
            ],
            'gestion_erreurs' => [
                'description' => 'La gestion d\'erreurs avec PDO utilise les exceptions. On configure PDO::ERRMODE_EXCEPTION pour capturer automatiquement les erreurs.',
                'example' => 'try {\n    $pdo = new PDO($dsn, $username, $password, [\n        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION\n    ]);\n    \n    $stmt = $pdo->prepare("SELECT * FROM table_inexistante");\n    $stmt->execute();\n} catch (PDOException $e) {\n    // Erreur spécifique à PDO\n    error_log("Erreur PDO : " . $e->getMessage());\n    echo "Erreur de base de données";\n} catch (Exception $e) {\n    // Autres erreurs\n    error_log("Erreur générale : " . $e->getMessage());\n    echo "Erreur système";\n}',
            ],
            'orm_doctrine' => [
                'description' => 'Doctrine ORM est un mappeur objet-relationnel qui permet de manipuler la base de données via des objets PHP plutôt que du SQL brut.',
                'example' => '// Avec Doctrine ORM (dans Symfony)\n// 1. Récupération d\'entités\n$users = $entityManager->getRepository(User::class)->findAll();\n\n// 2. Création d\'une nouvelle entité\n$user = new User();\n$user->setNom("Jean Dupont");\n$user->setEmail("jean@email.com");\n\n$entityManager->persist($user);\n$entityManager->flush(); // Sauvegarde en BDD\n\n// 3. Requête avec QueryBuilder\n$users = $entityManager->createQueryBuilder()\n    ->select(\'u\')\n    ->from(User::class, \'u\')\n    ->where(\'u.age > :age\')\n    ->setParameter(\'age\', 18)\n    ->getQuery()\n    ->getResult();',
            ],
            'migrations' => [
                'description' => 'Les migrations permettent de versionner et d\'appliquer des changements de structure de base de données de manière contrôlée et réversible.',
                'example' => '// Migration Doctrine (Symfony)\n// Créer une migration\n// php bin/console make:migration\n\n// Fichier de migration généré\npublic function up(Schema $schema): void\n{\n    $this->addSql(\'CREATE TABLE user (\n        id INT AUTO_INCREMENT NOT NULL,\n        nom VARCHAR(255) NOT NULL,\n        email VARCHAR(255) NOT NULL,\n        created_at DATETIME NOT NULL,\n        PRIMARY KEY(id)\n    )\');\n}\n\npublic function down(Schema $schema): void\n{\n    $this->addSql(\'DROP TABLE user\');\n}\n\n// Appliquer les migrations\n// php bin/console doctrine:migrations:migrate',
            ],
            'optimisation_requetes' => [
                'description' => 'L\'optimisation des requêtes améliore les performances : utilisation d\'index, limitation des résultats, éviter N+1 queries, utilisation du cache.',
                'example' => '// Optimisations courantes\n\n// 1. Utiliser LIMIT pour paginer\n$sql = "SELECT * FROM posts ORDER BY created_at DESC LIMIT 10 OFFSET 20";\n\n// 2. Utiliser des index (en SQL)\n// CREATE INDEX idx_user_email ON users(email);\n// CREATE INDEX idx_post_date ON posts(created_at);\n\n// 3. Éviter N+1 queries avec des jointures\n$sql = "SELECT u.*, p.titre \n        FROM users u \n        LEFT JOIN posts p ON u.id = p.user_id";\n\n// 4. Utiliser des requêtes préparées réutilisables\n$stmt = $pdo->prepare("SELECT * FROM users WHERE city = ?");\nforeach ($cities as $city) {\n    $stmt->execute([$city]);\n    $users = $stmt->fetchAll();\n    // Traitement...\n}',
            ],
            'securite_bdd' => [
                'description' => 'La sécurité des bases de données passe par les requêtes préparées, la validation des données, les privilèges limités et le chiffrement des mots de passe.',
                'example' => '// Bonnes pratiques de sécurité\n\n// 1. TOUJOURS utiliser des requêtes préparées\n$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");\n$stmt->execute([$_POST[\'email\']]);\n\n// 2. Valider et nettoyer les données\n$email = filter_var($_POST[\'email\'], FILTER_VALIDATE_EMAIL);\nif (!$email) {\n    throw new InvalidArgumentException("Email invalide");\n}\n\n// 3. Hasher les mots de passe\n$hashedPassword = password_hash($_POST[\'password\'], PASSWORD_DEFAULT);\n$stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");\n$stmt->execute([$email, $hashedPassword]);\n\n// 4. Vérifier les mots de passe\nif (password_verify($_POST[\'password\'], $user[\'password\'])) {\n    echo "Connexion réussie";\n}',
            ],
        ];

        return $this->render('bdd/index.html.twig', [
            'data' => $dataBDD,
        ]);
    }
}
