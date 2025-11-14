# QCM - POO PHP : Phase 3 "Maîtrise niveau 3"

**Formation :** Projet POO - Commerce de Jeux Vidéo  
**Phase :** 3 - La Maîtrise (Jour 3)  
**Durée estimée :** 30-35 minutes  
**Questions :** 20 questions  
**Barème :** 30 points (questions complexes)

---

## 📋 Consignes

-   Cochez la ou les bonnes réponses pour chaque question
-   Certaines questions peuvent avoir plusieurs bonnes réponses
-   Lisez attentivement les exemples de code
-   Basez-vous sur les concepts avancés : polymorphisme, abstraction, interfaces

---

## 🎯 Questions

### 1. Qu'est-ce que le polymorphisme en POO ? _(1 point)_

-   [ ] A) Le fait d'avoir plusieurs constructeurs
-   [ ] B) La capacité pour des objets différents de répondre à la même méthode de façon différente
-   [ ] C) L'héritage multiple entre classes
-   [ ] D) La protection des données avec private

### 2. Quelle analogie a été utilisée pour expliquer le polymorphisme ? _(1 point)_

-   [ ] A) DNA familial
-   [ ] B) Coffre-fort
-   [ ] C) Télécommande universelle (même bouton, actions différentes)
-   [ ] D) Plan architectural

### 3. Qu'est-ce qu'une classe abstraite ? _(2 points)_

-   [ ] A) Une classe qui ne peut pas être instanciée directement
-   [ ] B) Une classe normale qui hérite d'une autre
-   [ ] C) Une classe qui sert de modèle pour d'autres classes
-   [ ] D) Une classe qui contient uniquement des propriétés

### 4. Comment déclare-t-on une classe abstraite en PHP ? _(1 point)_

-   [ ] A) `class abstract MaClasse {}`
-   [ ] B) `abstract class MaClasse {}`
-   [ ] C) `interface MaClasse {}`
-   [ ] D) `virtual class MaClasse {}`

### 5. Que se passe-t-il si on essaie d'instancier une classe abstraite ? _(1 point)_

```php
abstract class Forme {
    protected $couleur;
}

$forme = new Forme(); // Cette ligne
```

-   [ ] A) Crée un objet Forme normalement
-   [ ] B) Génère une erreur fatale
-   [ ] C) Crée un objet vide
-   [ ] D) Retourne null

### 6. Qu'est-ce qu'une méthode abstraite ? _(2 points)_

-   [ ] A) Une méthode normale dans une classe abstraite
-   [ ] B) Une méthode déclarée sans implémentation dans la classe parent
-   [ ] C) Une méthode qui doit obligatoirement être implémentée par les classes enfants
-   [ ] D) Une méthode privée

### 7. Analysez ce code. Qu'est-ce qui est obligatoire pour la classe Cercle ? _(2 points)_

```php
abstract class Forme {
    protected $couleur;

    abstract public function calculerAire();

    public function definirCouleur($couleur) {
        $this->couleur = $couleur;
    }
}

class Cercle extends Forme {
    private $rayon;

    // Qu'est-ce qui est obligatoire ici ?
}
```

-   [ ] A) Redéfinir definirCouleur()
-   [ ] B) Implémenter calculerAire()
-   [ ] C) Déclarer $couleur comme private
-   [ ] D) Rien d'obligatoire

### 8. Qu'est-ce qu'une interface en PHP ? _(2 points)_

-   [ ] A) Une classe normale qui peut être instanciée
-   [ ] B) Un contrat qui définit quelles méthodes une classe doit implémenter
-   [ ] C) Une classe abstraite avec des propriétés
-   [ ] D) Un type de variable spécial

### 9. Comment déclare-t-on une interface ? _(1 point)_

-   [ ] A) `class PaymentInterface {}`
-   [ ] B) `abstract class PaymentInterface {}`
-   [ ] C) `interface PaymentInterface {}`
-   [ ] D) `contract PaymentInterface {}`

### 10. Comment fait une classe pour implémenter une interface ? _(1 point)_

-   [ ] A) `class MaClasse extends MonInterface {}`
-   [ ] B) `class MaClasse implements MonInterface {}`
-   [ ] C) `class MaClasse uses MonInterface {}`
-   [ ] D) `class MaClasse inherits MonInterface {}`

### 11. Que peut contenir une interface ? _(2 points)_

_Plusieurs réponses possibles_

-   [ ] A) Des déclarations de méthodes publiques
-   [ ] B) Des propriétés privées
-   [ ] C) Des constantes
-   [ ] D) Des méthodes avec implémentation
-   [ ] E) Des constructeurs

### 12. Analysez ce code. Qu'est-ce qui est incorrect ? _(3 points)_

```php
interface PaymentInterface {
    private $solde;  // Ligne A

    public function payer($montant);  // Ligne B

    public function verifierSolde() {  // Ligne C
        return $this->solde;
    }

    const TVA = 0.20;  // Ligne D
}
```

-   [ ] A) Ligne A : interface ne peut pas avoir de propriétés
-   [ ] B) Ligne B : syntaxe correcte pour une interface
-   [ ] C) Ligne C : interface ne peut pas avoir d'implémentation
-   [ ] D) Ligne D : syntaxe correcte pour une constante

### 13. Une classe peut-elle implémenter plusieurs interfaces ? _(1 point)_

-   [ ] A) Non, une seule interface par classe
-   [ ] B) Oui, avec des virgules : `implements Interface1, Interface2`
-   [ ] C) Seulement si elles sont de la même famille
-   [ ] D) Seulement les classes abstraites

### 14. Voici du code polymorphe. Que va-t-il afficher ? _(3 points)_

```php
interface PaymentInterface {
    public function payer($montant);
}

class CarteCredit implements PaymentInterface {
    public function payer($montant) {
        return "Paiement de {$montant}€ par carte";
    }
}

class PayPal implements PaymentInterface {
    public function payer($montant) {
        return "Paiement de {$montant}€ via PayPal";
    }
}

$moyens = [new CarteCredit(), new PayPal()];
foreach ($moyens as $moyen) {
    echo $moyen->payer(50) . "\n";
}
```

-   [ ] A) Deux fois "Paiement de 50€ par carte"
-   [ ] B) "Paiement de 50€ par carte" puis "Paiement de 50€ via PayPal"
-   [ ] C) Une erreur car les classes sont différentes
-   [ ] D) "Paiement de 50€ via PayPal" deux fois

### 15. Quelle est la différence principale entre classe abstraite et interface ? _(3 points)_

-   [ ] A) Classe abstraite peut avoir des méthodes avec implémentation, interface non
-   [ ] B) Interface peut avoir des propriétés, classe abstraite non
-   [ ] C) On peut hériter de plusieurs classes abstraites mais une seule interface
-   [ ] D) Une classe peut implémenter plusieurs interfaces mais hériter d'une seule classe abstraite

### 16. Dans le contexte du projet, quel est l'avantage du polymorphisme pour le panier ? _(2 points)_

-   [ ] A) Le panier peut contenir différents types de produits (jeux, accessoires)
-   [ ] B) Le panier calcule automatiquement le total sans connaître le type exact
-   [ ] C) Le panier devient plus rapide
-   [ ] D) Le panier utilise moins de mémoire

### 17. Pourquoi utiliser une interface PaymentInterface ? _(2 points)_

-   [ ] A) Pour forcer tous les moyens de paiement à avoir les mêmes méthodes
-   [ ] B) Pour pouvoir traiter tous les paiements de la même façon
-   [ ] C) Pour améliorer les performances
-   [ ] D) Pour réduire la taille du code

### 18. Qu'est-ce que l'analogie du "contrat de travail" représente ? _(1 point)_

-   [ ] A) Les classes abstraites
-   [ ] B) L'héritage
-   [ ] C) Les interfaces (obligations à respecter)
-   [ ] D) L'encapsulation

### 19. Complétez ce code pour implémenter correctement l'interface : _(3 points)_

```php
interface Volant {
    public function voler();
    public function atterrir();
}

class Avion _______ Volant {
    public function _______() {
        return "L'avion vole";
    }

    // Qu'est-ce qui manque ?
}
```

-   [ ] A) `implements` et `voler` et il manque `atterrir()`
-   [ ] B) `extends` et `voler` et il manque `atterrir()`
-   [ ] C) `implements` et `fly` et il manque `land()`
-   [ ] D) Le code est complet comme ça

### 20. Parmi ces concepts, lesquels appartiennent à la Phase 3 "Maîtrise" ? _(3 points)_

_Plusieurs réponses possibles_

-   [ ] A) Polymorphisme
-   [ ] B) Classes abstraites
-   [ ] C) Interfaces
-   [ ] D) Encapsulation
-   [ ] E) Héritage simple
-   [ ] F) Méthodes abstraites
-   [ ] G) Implémentation multiple d'interfaces

---

## 🔑 Correction

### Réponses correctes :

1. **B** - La capacité pour des objets différents de répondre à la même méthode de façon différente
2. **C** - Télécommande universelle (même bouton, actions différentes)
3. **A, C** - Ne peut pas être instanciée directement ET sert de modèle
4. **B** - `abstract class MaClasse {}`
5. **B** - Génère une erreur fatale
6. **B, C** - Méthode déclarée sans implémentation ET doit être implémentée par les enfants
7. **B** - Implémenter calculerAire()
8. **B** - Un contrat qui définit quelles méthodes une classe doit implémenter
9. **C** - `interface PaymentInterface {}`
10. **B** - `class MaClasse implements MonInterface {}`
11. **A, C** - Déclarations de méthodes publiques ET constantes
12. **A, C** - Ligne A (pas de propriétés) ET Ligne C (pas d'implémentation)
13. **B** - Oui, avec des virgules : `implements Interface1, Interface2`
14. **B** - "Paiement de 50€ par carte" puis "Paiement de 50€ via PayPal"
15. **A, D** - Classe abstraite peut avoir implémentation ET classe peut implémenter plusieurs interfaces
16. **A, B** - Peut contenir différents types ET calcule automatiquement
17. **A, B** - Force les mêmes méthodes ET traitement uniforme
18. **C** - Les interfaces (obligations à respecter)
19. **A** - `implements` et `voler` et il manque `atterrir()`
20. **A, B, C, F, G** - Polymorphisme, Classes abstraites, Interfaces, Méthodes abstraites, Implémentation multiple

---

## 📊 Barème de notation

-   **27-30 points** : Expert ! Maîtrise parfaite des concepts avancés POO
-   **23-26 points** : Très bien, concepts avancés bien assimilés
-   **18-22 points** : Bien, quelques révisions sur polymorphisme ou interfaces
-   **13-17 points** : Moyen, revoir les concepts abstraits
-   **< 13 points** : Insuffisant, reprendre la Phase 3 entièrement

---

## 💡 Points clés à retenir

Si vous avez eu des difficultés, relisez ces concepts :

### 🔄 **Polymorphisme**

-   **Même interface, comportements différents**
-   **Traitement uniforme d'objets différents**
-   **Flexibilité et extensibilité du code**

### 🏗️ **Classes Abstraites**

-   **`abstract class`** : ne peut pas être instanciée
-   **Méthodes abstraites** : déclarées sans implémentation
-   **Enfants doivent implémenter** les méthodes abstraites

### 📋 **Interfaces**

-   **`interface`** : contrat à respecter
-   **`implements`** : pour implémenter une interface
-   **Seulement déclarations** de méthodes publiques et constantes
-   **Implémentation multiple** possible

### 🎯 **Avantages**

-   **Code plus flexible** et maintenable
-   **Réutilisabilité** accrue
-   **Séparation** des responsabilités

**Félicitations !** Si vous maîtrisez ces concepts, vous avez une solide base en POO PHP ! 🎉
