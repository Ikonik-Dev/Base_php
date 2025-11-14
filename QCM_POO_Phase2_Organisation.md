# QCM - POO PHP : Phase 2 "Organisation niveau 2"

**Formation :** Projet POO - Commerce de Jeux Vidéo  
**Phase :** 2 - L'Organisation (Jour 2)  
**Durée estimée :** 25-30 minutes  
**Questions :** 18 questions  
**Barème :** 25 points (certaines questions valent plus)

---

## 📋 Consignes

-   Cochez la ou les bonnes réponses pour chaque question
-   Certaines questions peuvent avoir plusieurs bonnes réponses
-   Lisez attentivement les exemples de code
-   Basez-vous sur les concepts vus en Phase 2 : encapsulation, héritage, visibilité

---

## 🎯 Questions

### 1. Qu'est-ce que l'encapsulation en POO ? _(1 point)_

-   [ ] A) Le fait de créer plusieurs objets identiques
-   [ ] B) La protection des données en contrôlant l'accès aux propriétés
-   [ ] C) L'héritage entre classes parent et enfant
-   [ ] D) La création d'interfaces

### 2. Quelle analogie a été utilisée pour expliquer l'encapsulation ? _(1 point)_

-   [ ] A) Un coffre-fort qui protège les données importantes
-   [ ] B) Un moule à gâteau
-   [ ] C) Un livre ouvert
-   [ ] D) Une voiture qui roule

### 3. Quels sont les trois niveaux de visibilité en PHP ? _(2 points)_

_Plusieurs réponses possibles_

-   [ ] A) public
-   [ ] B) private
-   [ ] C) protected
-   [ ] D) global
-   [ ] E) static
-   [ ] F) final

### 4. Que signifie une propriété `private` ? _(1 point)_

-   [ ] A) Elle est accessible depuis n'importe où
-   [ ] B) Elle est accessible uniquement dans la classe qui la définit
-   [ ] C) Elle est accessible dans la classe et ses enfants
-   [ ] D) Elle est accessible dans toutes les classes du projet

### 5. Quelle analogie correspond à `protected` ? _(1 point)_

-   [ ] A) Journal intime (personne d'autre ne peut lire)
-   [ ] B) Secret de famille (accessible aux descendants)
-   [ ] C) Livre public (tout le monde peut lire)
-   [ ] D) Coffre-fort bancaire

### 6. Analysez ce code. Que va-t-il se passer ? _(2 points)_

```php
class Utilisateur {
    private $motDePasse;

    public function __construct($mdp) {
        $this->motDePasse = $mdp;
    }
}

$user = new Utilisateur("secret123");
echo $user->motDePasse; // Cette ligne
```

-   [ ] A) Affiche "secret123"
-   [ ] B) Génère une erreur car motDePasse est private
-   [ ] C) Affiche une chaîne vide
-   [ ] D) Affiche "private"

### 7. Qu'est-ce qu'un getter ? _(1 point)_

-   [ ] A) Une méthode pour modifier une propriété privée
-   [ ] B) Une méthode pour récupérer la valeur d'une propriété privée
-   [ ] C) Une propriété publique
-   [ ] D) Un constructeur spécial

### 8. Qu'est-ce qu'un setter ? _(1 point)_

-   [ ] A) Une méthode pour récupérer une propriété
-   [ ] B) Une méthode pour modifier une propriété privée
-   [ ] C) Un destructeur
-   [ ] D) Une propriété statique

### 9. Complétez ce getter correctement : _(2 points)_

```php
class Utilisateur {
    private $age;

    // Votre code ici
    public function ______() {
        return _________;
    }
}
```

-   [ ] A) `getAge()` et `return $this->age;`
-   [ ] B) `setAge()` et `return $age;`
-   [ ] C) `age()` et `return $this->age;`
-   [ ] D) `getAge()` et `return $age;`

### 10. Qu'est-ce que l'héritage en POO ? _(1 point)_

-   [ ] A) Le fait qu'une classe enfant récupère les propriétés et méthodes de sa classe parent
-   [ ] B) La protection des données avec private
-   [ ] C) La création de plusieurs objets
-   [ ] D) L'utilisation d'interfaces

### 11. Quelle analogie a été utilisée pour l'héritage ? _(1 point)_

-   [ ] A) Coffre-fort
-   [ ] B) DNA familial (enfant hérite des parents)
-   [ ] C) Télécommande universelle
-   [ ] D) Plan architectural

### 12. Comment déclare-t-on qu'une classe hérite d'une autre ? _(1 point)_

-   [ ] A) `class Enfant inherit Parent {}`
-   [ ] B) `class Enfant extends Parent {}`
-   [ ] C) `class Enfant : Parent {}`
-   [ ] D) `class Enfant from Parent {}`

### 13. Analysez cette hiérarchie. Qu'est-ce qui est correct ? _(2 points)_

```php
class Utilisateur {
    protected $nom;
    protected $email;

    public function seConnecter() {
        return "Connexion de " . $this->nom;
    }
}

class Client extends Utilisateur {
    private $adresse;

    public function acheter() {
        return $this->nom . " effectue un achat";
    }
}
```

-   [ ] A) Client peut accéder à $nom car il est protected
-   [ ] B) Client ne peut pas accéder à $nom car il est dans une autre classe
-   [ ] C) Client hérite de la méthode seConnecter()
-   [ ] D) Client doit redéfinir toutes les méthodes d'Utilisateur

### 14. Que signifie "override" ou "redéfinition" ? _(2 points)_

-   [ ] A) Créer une nouvelle classe
-   [ ] B) Modifier le comportement d'une méthode héritée dans la classe enfant
-   [ ] C) Supprimer une méthode de la classe parent
-   [ ] D) Rendre une méthode privée

### 15. Dans quel ordre sont appelés les constructeurs ? _(2 points)_

```php
class Utilisateur {
    public function __construct() {
        echo "Constructeur Utilisateur ";
    }
}

class Client extends Utilisateur {
    public function __construct() {
        parent::__construct();
        echo "Constructeur Client ";
    }
}

$client = new Client();
```

-   [ ] A) "Constructeur Client Constructeur Utilisateur"
-   [ ] B) "Constructeur Utilisateur Constructeur Client"
-   [ ] C) Seulement "Constructeur Client"
-   [ ] D) Erreur de syntaxe

### 16. À quoi sert `parent::` ? _(1 point)_

-   [ ] A) À créer un objet parent
-   [ ] B) À appeler une méthode de la classe parent
-   [ ] C) À vérifier si une classe a un parent
-   [ ] D) À supprimer l'héritage

### 17. Quelle est la différence principale entre ces deux classes ? _(3 points)_

```php
// Version A
class Produit {
    public $prix;

    public function setPrix($nouveauPrix) {
        $this->prix = $nouveauPrix;
    }
}

// Version B
class Produit {
    private $prix;

    public function setPrix($nouveauPrix) {
        if ($nouveauPrix > 0) {
            $this->prix = $nouveauPrix;
        }
    }
}
```

-   [ ] A) Version A permet de valider les données, version B non
-   [ ] B) Version B encapsule mieux et permet la validation
-   [ ] C) Version A est plus sécurisée
-   [ ] D) Il n'y a pas de différence fonctionnelle

### 18. Parmi ces concepts, lesquels appartiennent à la Phase 2 ? _(3 points)_

_Plusieurs réponses possibles_

-   [ ] A) Encapsulation (private/protected/public)
-   [ ] B) Héritage (extends)
-   [ ] C) Getters et setters
-   [ ] D) Polymorphisme
-   [ ] E) Interfaces
-   [ ] F) Classes abstraites
-   [ ] G) Redéfinition de méthodes (override)

---

## 🔑 Correction

### Réponses correctes :

1. **B** - La protection des données en contrôlant l'accès aux propriétés
2. **A** - Un coffre-fort qui protège les données importantes
3. **A, B, C** - public, private, protected
4. **B** - Elle est accessible uniquement dans la classe qui la définit
5. **B** - Secret de famille (accessible aux descendants)
6. **B** - Génère une erreur car motDePasse est private
7. **B** - Une méthode pour récupérer la valeur d'une propriété privée
8. **B** - Une méthode pour modifier une propriété privée
9. **A** - `getAge()` et `return $this->age;`
10. **A** - Le fait qu'une classe enfant récupère les propriétés et méthodes de sa classe parent
11. **B** - DNA familial (enfant hérite des parents)
12. **B** - `class Enfant extends Parent {}`
13. **A, C** - Client peut accéder à $nom car il est protected ET hérite de seConnecter()
14. **B** - Modifier le comportement d'une méthode héritée dans la classe enfant
15. **B** - "Constructeur Utilisateur Constructeur Client"
16. **B** - À appeler une méthode de la classe parent
17. **B** - Version B encapsule mieux et permet la validation
18. **A, B, C, G** - Encapsulation, Héritage, Getters/setters, Redéfinition

---

## 📊 Barème de notation

-   **23-25 points** : Excellent ! Maîtrise parfaite de l'organisation POO
-   **20-22 points** : Très bien, concepts bien assimilés
-   **16-19 points** : Bien, quelques révisions sur l'encapsulation ou l'héritage
-   **12-15 points** : Moyen, revoir les concepts de visibilité
-   **< 12 points** : Insuffisant, reprendre la Phase 2 entièrement

---

## 💡 Points clés à retenir

Si vous avez eu des difficultés, relisez ces concepts :

### 🔒 **Encapsulation**

-   **public** : accessible partout
-   **private** : accessible uniquement dans la classe (journal intime)
-   **protected** : accessible dans la classe et ses enfants (secret de famille)
-   **Getters/Setters** : méthodes pour accéder aux propriétés privées

### 👨‍👩‍👧‍👦 **Héritage**

-   **extends** : mot-clé pour hériter
-   **parent::** : appeler une méthode du parent
-   **Override** : redéfinir une méthode héritée
-   **protected** : partagé avec les enfants

**Prochaine étape :** Une fois ce QCM réussi (>20/25), vous êtes prêt pour la Phase 3 "Maîtrise" avec polymorphisme et interfaces !
