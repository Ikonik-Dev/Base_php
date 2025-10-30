# Architecture Front-End Modulaire - Cours PHP

## 📁 Structure du projet

```
assets/
├── js/                    # Modules JavaScript
│   ├── sidebar-manager.js
│   ├── navbar-manager.js
│   └── code-block-manager.js
├── styles/               # Feuilles de style modulaires
│   ├── variables.css     # Variables CSS centralisées
│   ├── reset.css        # Reset CSS
│   ├── grid.css         # Système de grille responsive
│   ├── sidebar.css      # Composant sidebar
│   ├── card.css         # Composant card
│   ├── button.css       # Composant button
│   ├── code-block.css   # Composant code-block
│   ├── section.css      # Composant section
│   ├── layout.css       # Layout principal
│   ├── components.css   # Composants divers
│   └── app.css          # Styles globaux
└── app.js               # Point d'entrée principal

templates/
└── components/          # Composants Twig réutilisables
    ├── sidebar.html.twig
    ├── card.html.twig
    ├── button.html.twig
    ├── code-block.html.twig
    ├── section.html.twig
    ├── grid.html.twig
    └── navigation.html.twig
```

## 🧩 Composants Twig

### 1. Sidebar (`sidebar.html.twig`)

Composant de navigation latérale avec gestion des sections et des éléments actifs.

**Paramètres :**

-   `title` : Titre de la sidebar
-   `sections` : Array de sections avec leurs éléments

**Exemple d'utilisation :**

```twig
{% include 'components/sidebar.html.twig' with {
    title: 'NAVIGATION',
    sections: [
        {
            items: [
                { label: 'Accueil', path: path('app_home'), route: 'app_home' },
                { label: 'Variables', path: path('app_variables'), route: 'app_variables' }
            ]
        },
        {
            separator: true,
            title: 'RÉFÉRENCE',
            items: [
                { label: 'Glossaire', path: path('app_glossaire'), route: 'app_glossaire' }
            ]
        }
    ]
} %}
```

### 2. Card (`card.html.twig`)

Composant de carte polyvalent pour afficher du contenu structuré.

**Paramètres :**

-   `type` : Type de carte (concept, example, practice, exercise)
-   `size` : Taille (small, large)
-   `interactive` : Booléen pour l'interactivité
-   `title` : Titre de la carte
-   `description` : Description
-   `example` : Bloc d'exemple avec code
-   `actions` : Boutons d'action

**Exemple d'utilisation :**

```twig
{% include 'components/card.html.twig' with {
    type: 'concept',
    interactive: true,
    title: 'Variables PHP',
    description: 'Les variables permettent de stocker des données.',
    example: {
        language: 'php',
        code: '$nom = "John";'
    },
    actions: [
        { label: 'En savoir plus', url: '#', type: 'primary' }
    ]
} %}
```

### 3. Grid (`grid.html.twig`)

Système de grille responsive pour organiser le contenu.

**Paramètres :**

-   `cols` : Nombre de colonnes (1-6)
-   `gap` : Espacement (xs, sm, md, lg, xl)
-   `responsive` : Configuration responsive
-   `items` : Éléments de la grille

**Exemple d'utilisation :**

```twig
{% include 'components/grid.html.twig' with {
    cols: 3,
    gap: 'md',
    responsive: { 'sm': 1, 'md': 2, 'lg': 3 },
    items: [
        { component: 'card', data: {...} },
        { content: '<p>Contenu HTML</p>' }
    ]
} %}
```

### 4. Button (`button.html.twig`)

Composant bouton personnalisable.

**Paramètres :**

-   `variant` : Style (primary, secondary, outline, ghost, danger)
-   `size` : Taille (small, large)
-   `href` : Lien (pour un bouton-lien)
-   `type` : Type de bouton (button, submit, reset)
-   `label` : Texte du bouton
-   `icon` : Classe d'icône

**Exemple d'utilisation :**

```twig
{% include 'components/button.html.twig' with {
    variant: 'primary',
    size: 'large',
    label: 'Commencer',
    icon: 'icon-arrow-right',
    href: path('app_variables')
} %}
```

### 5. Code Block (`code-block.html.twig`)

Composant pour afficher du code avec coloration syntaxique.

**Paramètres :**

-   `title` : Titre du bloc
-   `language` : Langage de programmation
-   `code` : Code à afficher
-   `copyable` : Bouton de copie
-   `filename` : Nom de fichier

**Exemple d'utilisation :**

```twig
{% include 'components/code-block.html.twig' with {
    title: 'Exemple PHP',
    language: 'php',
    copyable: true,
    filename: 'example.php',
    code: '<?php
echo "Hello World!";
?>'
} %}
```

### 6. Section (`section.html.twig`)

Composant de section pour structurer le contenu.

**Paramètres :**

-   `title` : Titre de la section
-   `subtitle` : Sous-titre
-   `navigation` : Navigation entre sections
-   `content` : Contenu de la section

**Exemple d'utilisation :**

```twig
{% include 'components/section.html.twig' with {
    title: 'Les Variables',
    subtitle: 'Comprendre le stockage de données en PHP',
    navigation: true,
    content: '<p>Contenu de la section...</p>'
} %}
```

## 🎨 Système CSS

### Variables CSS Centralisées

Toutes les variables sont définies dans `variables.css` :

-   Couleurs Matrix (vert, noir, bordures)
-   Espacements (xs, sm, md, lg, xl, 2xl)
-   Typographie (tailles, familles de polices)
-   Breakpoints responsive
-   Animations et transitions
-   Rayons de bordure et ombres

### Architecture BEM

Chaque composant suit la méthodologie BEM :

```css
.composant {
} /* Block */
.composant__element {
} /* Element */
.composant--modifier {
} /* Modifier */
```

### Grille Responsive

Système de grille flexible basé sur CSS Grid :

```css
.grid--cols-3              /* 3 colonnes */
/* 3 colonnes */
.grid--gap-md              /* Espacement moyen */
.grid--sm-1                /* 1 colonne sur mobile */
.grid--md-2                /* 2 colonnes sur tablette */
.grid--lg-3; /* 3 colonnes sur desktop */
```

## 📱 JavaScript Modulaire

### Gestionnaires de Composants

Chaque composant complexe a son propre gestionnaire JavaScript :

1. **SidebarManager** : Gestion de l'état de la sidebar
2. **NavbarManager** : Navbar flottante au hover
3. **CodeBlockManager** : Copie de code et coloration syntaxique

### Utilisation

Les modules s'initialisent automatiquement au chargement DOM :

```javascript
// Les gestionnaires s'auto-initialisent
document.addEventListener("DOMContentLoaded", function () {
    new SidebarManager();
    new NavbarManager();
    new CodeBlockManager();
});
```

## 🔧 Utilisation dans les Templates

### Template Simple

```twig
{% extends 'base.html.twig' %}

{% block body %}
    <main class="main-content">
        {% include 'components/section.html.twig' with {
            title: 'Les Variables PHP',
            content: content_variable
        } %}

        {% include 'components/grid.html.twig' with {
            cols: 2,
            gap: 'lg',
            items: cards_data
        } %}
    </main>
{% endblock %}
```

### Template avec Composants Imbriqués

```twig
{% set concepts_cards = [] %}
{% for concept in concepts %}
    {% set concepts_cards = concepts_cards|merge([{
        component: 'card',
        data: {
            type: 'concept',
            interactive: true,
            title: concept.title,
            description: concept.description,
            example: concept.example
        }
    }]) %}
{% endfor %}

{% include 'components/grid.html.twig' with {
    cols: 3,
    items: concepts_cards
} %}
```

## 🚀 Avantages de cette Architecture

1. **Réutilisabilité** : Composants modulaires réutilisables
2. **Maintenabilité** : Code organisé et facile à maintenir
3. **Cohérence** : Design system unifié
4. **Performance** : CSS et JS optimisés
5. **Responsive** : Design adaptatif sur tous écrans
6. **Accessibilité** : Composants accessibles par défaut
7. **Extensibilité** : Facile d'ajouter de nouveaux composants

## 📋 Checklist Migration

-   [x] Créer composants Twig modulaires
-   [x] Refactoriser CSS en modules BEM
-   [x] Extraire JavaScript en modules ES6
-   [x] Optimiser template de base
-   [x] Créer système de grille responsive
-   [x] Documenter l'architecture

Cette architecture modulaire transforme votre application en un système de design cohérent et maintenable ! 🎉
