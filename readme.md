# [CMS] AltisPan
##### By [Emile LEPETIT](http://emile-lepetit.fr) & Lucas GRALAUD
> AltisPan est mon premier gros projet.
---

### Description
AltisPan est un CMS (Content management System) développer pour Arma III et plus précisément pour le mod de jeux Altis Life. Il est composé d'une partie site est d'une partie back office (Panel Admin). Depuis le panel admin il vous sera facile de réaliser toutes les modifications que vous souhaiter faires. Pour ceux qui veulent en savoir plus, le panel est développé sous le framwork laravel avec une structure de type MVC.

### Installation
1. Dézipper l'archive dans votre dossier `www`
2. Exécuter composer.exe suivi de l'installation de celui-ci
3. Ouvrer une invite de commande dans le dossier et exécuter ceci :
    - `composer update --no-dev`
    - `php artisan key:generate`
4. Renommer le fichier `.env.exemple` en `.env`
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
* Si `php artisan ....` ne fonctionne metter le chemain de votre `php.exe` en absolue
* Il est **foremellement interdit** de modifié le footer de _AltisPan_

## Crédits
&copy; [Emile LEPETIT](http://emile-lepetit.fr)