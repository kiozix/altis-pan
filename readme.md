# [CMS] AltisPan [v4.0]
##### By [Emile LEPETIT](http://emile-lepetit.fr) & Lucas GRALAUD
> AltisPan CMS pour AltisLife - Arma III
---

|Version Stable|Téléchargements|License|Laravel|
|:------:|:-------:|:-------:|:------:|
|[![Version Stable](https://img.shields.io/packagist/v/emile442/altis-pan.svg?style=flat-square)](https://packagist.org/packages/emile442/altis-pan)|[![Téléchargements](https://img.shields.io/packagist/dt/emile442/altis-pan.svg?style=flat-square)](https://packagist.org/packages/emile442/altis-pan)|[![License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://packagist.org/packages/emile442/altis-pan)|[![Laravel](https://img.shields.io/badge/Laravel 5-%E2%99%A5-44CB12.svg?style=flat-square)](https://laravel.com/)

### Description
AltisPan est un CMS (Content management System) développer pour Arma III et plus précisément pour le mod de jeux Altis Life. Il est composé d'une partie site est d'une partie back office (Panel Admin). Depuis le panel admin il vous sera facile de réaliser toutes les modifications que vous souhaiter faires. Pour ceux qui veulent en savoir plus, le panel est développé sous le framwork laravel avec une structure de type MVC.

### Installation
1. Dézipper l'archive dans votre dossier `www`
2. [Télécharger](https://getcomposer.org/download/) et éxécuter composer suivi de l'installation de celui-ci
3. Ouvrer une invite de commande dans le dossier et exécuter ceci :
    - `composer update`
4. Renommer le fichier `.env.example` en `.env`
    - `php artisan key:generate`
5. Ouvrer le fichier `.env` situer à la racine est renseigné les informations demandées
6. Ré ouvrée vôtres invites de commande est exécuté ceci (Création des tables dans la base de données):
   - Conseil : effectuer une sauvegarde de votre base de donnée
   - `php artisan migrate`
7. Pointer votre `DocumentRoot` sur `/public`
8. Créer votre utilisateur
9. Aller sur votre base donnée puis dans la table `users` et metter `rank` à `3` sur votre utilisateur.
10. Pour paramétrer paypal aller dans `/app/AltisPan/PaypalPayment.php`
11. Merci de votre confiance !

## Informations
* Si `php artisan ....` ne fonctionne pas metter le chemain de votre `php.exe` en absolue
* Il est **foremellement interdit** de modifié le footer de _AltisPan_

## Crédits
&copy; [Emile LEPETIT](http://emile-lepetit.fr)