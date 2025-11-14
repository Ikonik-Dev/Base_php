# QCM - POO PHP : Phase 1 "Fondations niveau 1"

**Formation :** Projet POO - Commerce de Jeux Vidéo  
**Phase :** 1 - Les Fondations (Jour 1)  
**Durée estimée :** 20-25 minutes  
**Questions :** 15 questions  
**Barème :** 20 points (certaines questions valent plus)

---

## 📋 Consignes

-   Cochez la ou les bonnes réponses pour chaque question
-   Certaines questions peuvent avoir plusieurs bonnes réponses
-   Lisez attentivement les exemples de code
-   Basez-vous sur les concepts vus en Phase 1 uniquement

---

## 🎯 Questions

### 1. Qu'est-ce qu'une classe en POO ? _(1 point)_

-   [ ] A) Un fichier PHP qui contient du code
-   [ ] B) Un modèle ou un plan pour créer des objets
-   [ ] C) Une variable qui stocke des données
-   [ ] D) Une fonction qui exécute des actions

### 2. Quelle analogie a été utilisée pour expliquer une classe ? _(1 point)_

-   [ ] A) Une voiture
-   [ ] B) Un moule à gâteau
-   [ ] C) Un livre
-   [ ] D) Un ordinateur

### 3. Comment déclare-t-on une classe en PHP ? _(1 point)_

-   [ ] A) `function MaClasse() {}`
-   [ ] B) `class MaClasse {}`
-   [ ] C) `new MaClasse {}`
-   [ ] D) `object MaClasse {}`

### 4. Comment crée-t-on un objet (instance) d'une classe ? _(1 point)_

```php
class JeuVideo {
    public $nom;
}
```

-   [ ] A) `$jeu = JeuVideo();`
-   [ ] B) `$jeu = new JeuVideo();`
-   [ ] C) `$jeu = create JeuVideo();`
-   [ ] D) `$jeu = class JeuVideo();`

### 5. Que représente un objet par rapport à une classe ? _(1 point)_

-   [ ] A) Le moule pour créer la classe
-   [ ] B) Une instance concrète créée à partir de la classe
-   [ ] C) Le même chose qu'une classe
-   [ ] D) Une copie du code de la classe

### 6. Qu'est-ce qu'une propriété dans une classe ? _(1 point)_

-   [ ] A) Une fonction de la classe
-   [ ] B) Une variable qui appartient à la classe
-   [ ] C) Un commentaire dans le code
-   [ ] D) Un type de données PHP

### 7. Comment accède-t-on à une propriété d'un objet ? _(2 points)_

```php
class JeuVideo {
    public $nom;
    public $prix;
}
$jeu = new JeuVideo();
```

-   [ ] A) `$jeu.nom`
-   [ ] B) `$jeu->nom`
-   [ ] C) `$jeu[nom]`
-   [ ] D) `$jeu::nom`

### 8. Qu'est-ce qu'une méthode dans une classe ? _(1 point)_

-   [ ] A) Une variable de la classe
-   [ ] B) Une fonction qui appartient à la classe
-   [ ] C) Un type de propriété spéciale
-   [ ] D) Un commentaire explicatif

### 9. Comment appelle-t-on une méthode sur un objet ? _(2 points)_

```php
class JeuVideo {
    public function afficherInfos() {
        return "Informations du jeu";
    }
}
$jeu = new JeuVideo();
```

-   [ ] A) `$jeu.afficherInfos()`
-   [ ] B) `$jeu->afficherInfos()`
-   [ ] C) `$jeu[afficherInfos()]`
-   [ ] D) `afficherInfos($jeu)`

### 10. Que fait le constructeur d'une classe ? _(2 points)_

-   [ ] A) Il détruit l'objet quand on n'en a plus besoin
-   [ ] B) Il s'exécute automatiquement quand on crée un nouvel objet
-   [ ] C) Il permet de modifier les propriétés après création
-   [ ] D) Il affiche les informations de l'objet

### 11. Comment déclare-t-on un constructeur en PHP ? _(1 point)_

-   [ ] A) `public function constructor() {}`
-   [ ] B) `public function __construct() {}`
-   [ ] C) `public function new() {}`
-   [ ] D) `public function init() {}`

### 12. Analysez ce code et trouvez l'erreur : _(2 points)_

```php
class JeuVideo {
    public $nom;
    public $prix;

    public function __construct($nom, $prix) {
        $nom = $nom;
        $prix = $prix;
    }
}
```

-   [ ] A) La syntaxe du constructeur est incorrecte
-   [ ] B) Il manque `$this->` devant les propriétés dans le constructeur
-   [ ] C) Les propriétés devraient être privées
-   [ ] D) Il n'y a pas d'erreur

### 13. Que signifie `$this` dans une classe ? _(2 points)_

-   [ ] A) Une variable globale PHP
-   [ ] B) Une référence à l'objet courant (moi-même)
-   [ ] C) Le nom de la classe
-   [ ] D) Une fonction spéciale

### 14. Complétez ce code pour créer un jeu "Call of Duty" à 60€ : _(2 points)_

```php
class JeuVideo {
    public $nom;
    public $prix;

    public function __construct($nom, $prix) {
        $this->nom = $nom;
        $this->prix = $prix;
    }
}

// Votre code ici :
$jeu = _________________;
```

-   [ ] A) `new JeuVideo("Call of Duty", 60)`
-   [ ] B) `new JeuVideo()->nom("Call of Duty")->prix(60)`
-   [ ] C) `JeuVideo("Call of Duty", 60)`
-   [ ] D) `create JeuVideo("Call of Duty", 60)`

### 15. Parmi ces concepts, lesquels font partie de la Phase 1 "Fondations" ? _(2 points)_

_Plusieurs réponses possibles_

-   [ ] A) Classes et objets
-   [ ] B) Propriétés et méthodes
-   [ ] C) Constructeur
-   [ ] D) Héritage
-   [ ] E) Encapsulation (private/protected)
-   [ ] F) Interfaces

---

## 🔑 Correction

### Réponses correctes :

1. **B** - Un modèle ou un plan pour créer des objets
2. **B** - Un moule à gâteau
3. **B** - `class MaClasse {}`
4. **B** - `$jeu = new JeuVideo();`
5. **B** - Une instance concrète créée à partir de la classe
6. **B** - Une variable qui appartient à la classe
7. **B** - `$jeu->nom`
8. **B** - Une fonction qui appartient à la classe
9. **B** - `$jeu->afficherInfos()`
10. **B** - Il s'exécute automatiquement quand on crée un nouvel objet
11. **B** - `public function __construct() {}`
12. **B** - Il manque `$this->` devant les propriétés dans le constructeur
13. **B** - Une référence à l'objet courant (moi-même)
14. **A** - `new JeuVideo("Call of Duty", 60)`
15. **A, B, C** - Classes et objets, Propriétés et méthodes, Constructeur

---

## 📊 Barème de notation

-   **18-20 points** : Excellent ! Concepts parfaitement maîtrisés
-   **15-17 points** : Très bien, quelques révisions mineures
-   **12-14 points** : Bien, revoir les concepts moins maîtrisés
-   **9-11 points** : Moyen, révisions nécessaires avant la Phase 2
-   **< 9 points** : Insuffisant, reprendre la Phase 1 entièrement

---

## 💡 Points clés à retenir

Si vous avez eu des difficultés sur certaines questions, relisez ces concepts :

-   **Classe** = modèle/moule, **Objet** = instance/gâteau créé
-   **Propriété** = caractéristique de l'objet (`$nom`, `$prix`)
-   **Méthode** = action que peut faire l'objet (`afficherInfos()`)
-   **Constructeur** = méthode spéciale qui s'exécute à la création (`__construct()`)
-   **`$this`** = référence à l'objet courant dans la classe
-   **Syntaxe** : `->` pour accéder aux propriétés et méthodes

**Prochaine étape :** Une fois ce QCM réussi (>15/20), vous êtes prêt pour la Phase 2 "Organisation" avec l'encapsulation et l'héritage !
