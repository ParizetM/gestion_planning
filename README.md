# Application de Gestion des Absences

## Introduction

Cette application Laravel a été conçu en cours

## Fonctionnalités

- **Gestion des Absences**
- **Gestion des Motifs**

## Prérequis

- PHP 8.3 ou supérieur
- Composer
- MySQL ou une autre base de données compatible avec Laravel
- Node.js et npm (pour les assets front-end)

## Installation

### 1. Cloner le Repository

```bash
cd chemin/vers/votre/projet
git clone https://github.com/ParizetM/gestion_planning.git .
```


### 2. Configurer l'environnement

Copiez le fichier .env.example en .env

```bash
cp .env.example .env
```
Configurez les paramètres de votre environnement, notamment les informations de connexion à la base de données.

```php
// Changer le nom de l'application
APP_NAME='gestion planning'

// Changer le Timezone de l'application
APP_TIMEZONE='Europe/Paris'

// Changer l'url de  l'application
APP_URL=http://localhost

// Changer les informations sur la langue
APP_LOCALE=fr
APP_FAKER_LOCALE=fr_FR

// Changer les informations pour que cela corresponde à votre base de données
DB_CONNECTION=mysql
DB_HOST=127.0.0.1  // ou l'adresse de votre base de données
DB_PORT=3306
DB_DATABASE=formation_gestion_planning
DB_USERNAME=votre_nom_d'utilisateur
DB_PASSWORD=votre_mot_de_passe

```

### 3. Installer les dépendances

```bash
composer install
npm install
npm run build
npm run dev
```

### 4. Générer la clé de l'application

```bash
php artisan key:generate
```

### 5. Exécuter les migrations

```bash
php artisan migrate
```

### 6. Remplir la base de données

```bash
php artisan db:seed
```
### 7. Logins et mot de passes

Pour vous connectez veuillez enregistrer un compte dans l'application en allant dans :
login -> S'enregistrer

Si vous souhaitez un compte administrateur :
Mail: admin@admin.com
MDP: Not24get

### 8. Accéder à l'application

Maintenant, vous devrez pouvoir atteindre l'application en allant sur l'url que vous avez indiqué.
