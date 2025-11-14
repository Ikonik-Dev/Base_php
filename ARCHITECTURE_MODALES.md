# Architecture Système de Modales - Cours PHP

## 📋 Vue d'ensemble

Système de modales détaillées pour afficher des informations approfondies sur chaque concept PHP. Chaque card peut ouvrir une modale avec :

-   Description complète
-   Détails techniques
-   Exemples de code
-   Cas d'utilisation
-   Avertissements
-   Bonnes pratiques
-   Ressources externes
-   Notions liées

## 🏗️ Architecture

### Structure des fichiers

```
assets/
├── js/
│   └── modal-manager.js          # Gestionnaire de modales
├── styles/
│   └── modal.css                 # Styles des modales
templates/
├── components/
│   ├── card.html.twig            # Carte avec support modal
│   └── modal.html.twig           # Composant modal
```

## 🎯 Utilisation

### 1. Créer une Card avec Modal

```twig
{% include 'components/card.html.twig' with {
    type: 'concept',
    interactive: true,
    modalId: 'modal-variables',        {# ID de la modale à ouvrir #}
    title: 'Variables PHP',
    description: 'Les variables stockent des données...',
    example: {
        language: 'php',
        code: '$maVariable = "Hello";'
    }
} %}
```

### 2. Créer la Modal correspondante

```twig
{% include 'components/modal.html.twig' with {
    id: 'modal-variables',              {# Même ID que modalId de la card #}
    title: 'Variables PHP',
    icon: '📌',
    description: 'Description complète des variables...',

    details: 'Les variables en PHP commencent par $...',

    example: {
        language: 'php',
        code: '$nom = "John";\n$age = 25;'
    },

    useCases: [
        'Stocker des informations utilisateur',
        'Calculer des valeurs dynamiques',
        'Transmettre des données entre fonctions'
    ],

    warnings: [
        'Toujours initialiser vos variables',
        'Attention à la portée des variables (scope)'
    ],

    bestPractices: [
        'Utiliser des noms explicites',
        'Respecter la convention camelCase',
        'Éviter les variables globales'
    ],

    resources: [
        { title: 'Doc PHP - Variables', url: 'https://php.net/variables', icon: '📖' },
        { title: 'PHP The Right Way', url: 'https://phptherightway.com', icon: '🎓' }
    ],

    relatedTopics: [
        { id: 'modal-types', label: 'Types de données' },
        { id: 'modal-scope', label: 'Portée des variables' }
    ]
} %}
```

## 📊 Pattern de données pour les Controllers

### Structure recommandée pour enrichir les données

```php
// Dans le controller
$dataVariablesPHP = [
    'declaration' => [
        'description' => 'Description courte pour la card',
        'example' => 'Code exemple court',

        // Nouvelles propriétés pour la modale
        'details' => 'Explication détaillée et complète...',
        'useCases' => [
            'Cas d\'utilisation 1',
            'Cas d\'utilisation 2',
            'Cas d\'utilisation 3'
        ],
        'warnings' => [
            'Point d\'attention 1',
            'Piège à éviter'
        ],
        'bestPractices' => [
            'Bonne pratique 1',
            'Bonne pratique 2'
        ],
        'resources' => [
            [
                'title' => 'Documentation officielle',
                'url' => 'https://php.net/manual/fr/...',
                'icon' => '📖'
            ]
        ],
        'relatedTopics' => [
            ['id' => 'modal-types', 'label' => 'Types de données'],
            ['id' => 'modal-scope', 'label' => 'Portée']
        ]
    ],
    // ...
];
```

## 🎨 Personnalisation

### Tailles de modales

```twig
{# Petite modale #}
{% include 'components/modal.html.twig' with {
    size: 'small',
    ...
} %}

{# Modale normale (par défaut) #}
{% include 'components/modal.html.twig' with { ... } %}

{# Grande modale #}
{% include 'components/modal.html.twig' with {
    size: 'large',
    ...
} %}
```

### Actions personnalisées

```twig
{% include 'components/modal.html.twig' with {
    ...,
    actions: [
        {
            label: 'Voir les exercices',
            url: path('app_exercises_variables'),
            type: 'primary'
        },
        {
            label: 'Documentation',
            url: 'https://php.net',
            type: 'secondary'
        }
    ]
} %}
```

## 🔧 API JavaScript

### Ouvrir une modale programmatiquement

```javascript
// Depuis n'importe où dans votre code
ModalManager.openModal("modal-variables");
```

### Fermer la modale active

```javascript
ModalManager.closeModal();
```

### Écouter les événements

```javascript
// Modale ouverte
document.addEventListener("modal:opened", (e) => {
    console.log("Modale ouverte:", e.detail.modalId);
});

// Modale fermée
document.addEventListener("modal:closed", (e) => {
    console.log("Modale fermée:", e.detail.modalId);
});
```

## ♿ Accessibilité

Le système de modales respecte les bonnes pratiques d'accessibilité :

-   ✅ Navigation au clavier (Tab, Shift+Tab, Échap)
-   ✅ Focus trap (le focus reste dans la modale)
-   ✅ Attributs ARIA (`role="dialog"`, `aria-hidden`, `aria-labelledby`)
-   ✅ Focus automatique sur le premier élément
-   ✅ Restauration du scroll lors de la fermeture

## 📱 Responsive

Les modales s'adaptent automatiquement :

-   Desktop : 900px max-width, centrée
-   Tablette : 90% de largeur
-   Mobile : 95% de largeur, height optimisée

## 🚀 Migration des templates existants

### Avant (template actuel)

```twig
<article class="concept-card">
    <h3>{{ key|replace({'_': ' '})|title }}</h3>
    <p>{{ concept.description }}</p>
    <div class="concept-card-example">
        <pre><code>{{ concept.example }}</code></pre>
    </div>
</article>
```

### Après (avec composant Card + Modal)

```twig
{# La card #}
{% include 'components/card.html.twig' with {
    type: 'concept',
    interactive: true,
    modalId: 'modal-' ~ key,
    title: key|replace({'_': ' '})|title,
    description: concept.description,
    example: {
        language: 'php',
        code: concept.example
    }
} %}

{# La modale associée #}
{% include 'components/modal.html.twig' with {
    id: 'modal-' ~ key,
    title: key|replace({'_': ' '})|title,
    description: concept.description,
    example: {
        language: 'php',
        code: concept.example
    },
    ...
} %}
```

## 🎯 Pages concernées

Pages à migrer vers le système de modales :

-   ✅ **Accueil** (`/`) - Vue d'ensemble des modules
-   🔄 **Variables** (`/variables`) - Concepts de variables
-   🔄 **Types de données** (`/typages`) - Types PHP
-   🔄 **Opérateurs** (`/operateurs`) - Tous les opérateurs
-   🔄 **Structures de contrôle** (`/structure/controle`) - if, switch, boucles
-   🔄 **Fonctions** (`/fonction/p/h/p`) - Fonctions PHP
-   🔄 **POO** (`/poo`) - Programmation orientée objet
-   🔄 **Bases de données** (`/bdd`) - Interaction BDD

## 📝 Checklist d'implémentation

Pour chaque page :

1. [ ] Enrichir les données du controller avec `details`, `useCases`, `warnings`, etc.
2. [ ] Remplacer les cards HTML par le composant `card.html.twig`
3. [ ] Ajouter les modales correspondantes avec `modal.html.twig`
4. [ ] Tester l'ouverture/fermeture des modales
5. [ ] Vérifier l'accessibilité (clavier, lecteur d'écran)
6. [ ] Tester sur mobile et tablette

## 🎨 Théming Matrix

Les modales suivent le thème Matrix de l'application :

-   Couleur principale : `var(--matrix-green)` (#00ff41)
-   Fond : Dégradé noir/gris foncé
-   Bordures : Vert Matrix avec glow effect
-   Animations : Smooth, cyberpunk-style

## 💡 Bonnes pratiques

1. **ID uniques** : Chaque modale doit avoir un ID unique
2. **Contenu concis sur la card** : Description courte, détails dans la modale
3. **Code examples** : Garder les exemples courts et pertinents
4. **Ressources externes** : Toujours ouvrir dans un nouvel onglet (`target="_blank"`)
5. **Navigation entre modales** : Utiliser `relatedTopics` pour créer des liens entre concepts

---

**Architecture par Ikonik-Dev** 🚀
