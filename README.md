# Test technique – Gestion de contacts  
**PHP 8.2 · Doctrine ORM · AJAX · CSS**

---

## Contexte

Ce test a pour objectif d’évaluer votre capacité à concevoir et implémenter une application web simple, propre et maintenable, à partir de spécifications fonctionnelles.

Le périmètre est volontairement restreint afin de vous laisser de la liberté sur :
- l’architecture
- l’organisation du code
- les choix techniques (dans le cadre des contraintes)

 

---

## Objectif

Développer une application minimale de **gestion de contacts**, reposant sur :

- une base de données relationnelle
- Doctrine ORM
- PHP 8.2

L’application doit proposer une page principale accessible à l’URL :

```
/contacts
```

---

## Fonctionnalités attendues

### 1. Liste des contacts

La page `/contacts` doit afficher une liste de contacts avec, a minima :

- Nom  
- Prénom  
- Email  
- Téléphone  
- Catégorie associée (si existante)

L’ordre d’affichage est libre (alphabétique recommandé).

---

### 2. Filtre par catégorie (AJAX)

- Un filtre par **catégorie** doit être présent (select ou équivalent)
- Le changement de catégorie déclenche une mise à jour de la liste :
  - **sans rechargement complet de la page**
  - via une requête AJAX
- Le filtre “toutes les catégories” doit être possible

Endpoint attendu :

```
GET /contacts/list?categorie=<id>
```

Le format de réponse (HTML partiel ou JSON) est **au choix**.

---

## Données

Le projet fourni contient :

- le schéma SQL (`categorie`, `contact`)
- un jeu de données de test
- les entités Doctrine correspondantes

Ces éléments ne doivent pas être modifiés, sauf incohérence manifeste.

---

## Contraintes techniques

- **PHP 8.2**
- **Doctrine ORM**
- Pas de framework (Symfony, Laravel, etc.)
- Pas de librairies CSS ou JavaScript externes  
  (Bootstrap, Tailwind, jQuery… interdits)
- Code structuré et lisible
- Sécurité minimale :
  - validation des entrées utilisateur
  - échappement des sorties HTML

---

## Interface & CSS

Un CSS minimal est fourni.

Il est attendu que vous proposiez :
- une mise en page claire et professionnelle
- un tableau lisible
- une interface agréable à consulter
- un affichage correct sur écran desktop  
  (responsive simple apprécié)

La **qualité du CSS fait partie de l’évaluation**.

---

## Structure du projet

Le projet fourni contient uniquement :
- le bootstrap technique
- les entités
- la configuration Doctrine
- les données de test

À vous de :
- définir l’architecture
- créer les contrôleurs, repositories, templates, scripts JS
- organiser le code de manière cohérente

---

## Installation

### Prérequis

- PHP 8.2
- MySQL ou MariaDB
- Composer

### Étapes

```bash
composer install
```

1. Créer la base de données  
2. Importer :
   - `database/schema.sql`
   - `database/data.sql`
3. Copier `.env.example` vers `.env` et adapter la configuration
4. Lancer le serveur :

```bash
php -S 127.0.0.1:8000 -t public
```

Accès :

```
http://127.0.0.1:8000/contacts
```

---

## Livrables attendus

- Projet fonctionnel
- Code clair, structuré et maintenable
- CSS amélioré
- Aucun fichier inutile ajouté

---

## Évaluation

Les critères d’évaluation incluent notamment :

- qualité du code PHP
- utilisation correcte de Doctrine ORM
- implémentation AJAX
- structuration du projet
- lisibilité HTML/CSS
- respect des contraintes
- autonomie et prise d’initiative

---

## Bonus (facultatif)

- pagination  
- tri  
- recherche texte  
- amélioration UX (loader, messages d’erreur)  
- tests unitaires  

---

## Remarque finale

Il n’est pas attendu un projet « parfait », mais un code  
**cohérent, propre et fonctionnel**, reflétant votre manière de travailler.

---

Bonne réalisation.
