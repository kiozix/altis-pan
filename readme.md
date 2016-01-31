# [CMS] AltisPan
##### By [Emile LEPETIT](http://emile-lepetit.fr) & Lucas GRALAUD
---

### Description
AltisPan est un CMS (Content management System) développer pour Arma III et plus précisément pour le mod de jeux Altis Life. Il est composé d'une partie site est d'une partie back office (Panel Admin). Depuis le panel admin il vous sera facile de réaliser toutes les modifications que vous souhaiter faires. Pour ceux qui veulent en savoir plus, le panel est développé sous le framwork laravel avec une structure de type MVC.

### Installation
1. Dézipper l'archive dans votre dossier `www`
2. Exécuter composer.exe est suivi l'installation de celui-ci
3. Ouvrer une invite de commande dans le dossier et exécuter ceci :
    - `composer update --no-dev`
    - `php artisan key:generate`
4. Ouvrer le fichier `.env` situer à la racine est renseigné les informations demandées
5. Ré ouvrée vôtres invites de commande est exécuté ceci (Création des tables dans la base de données):
   - Conseil : effectuer une sauvegarde de votre base de donnée
   - `php artisan migrate`
6. Pointer votre `DocumentRoot` sur `/public`
7. Créer votre utilisateur
8. Aller sur votre base donnée puis dans la table `users` et metter `admin` à `1` sur votre utilisateur.
9. Merci de votre achat !

## Informations
* Si `php artisan ....` ne fonctionne metter le chemain de votre `php.exe` en absolue
* Il est **foremellement interdit** de modifié le footer de _AltisPan_
* Toutes redistribution est **foremellement interdit** par quelconques moyen.
* Vous disposez d'une seul licences par achat.
* Aucune modifications n'est autorisez sans l'accord explicite écrit par [Emile LEPETIT](http://emile-lepetit.fr)

## Crédits
&copy; [Emile LEPETIT](http://emile-lepetit.fr)