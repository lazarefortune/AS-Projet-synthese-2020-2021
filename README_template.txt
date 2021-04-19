--------------- README - Template version 1.0.0 --------------


*********** Autres pages ***********
Le code HTML des autres pages doivent être mis dans des fichiers HTML séparés.
pour tester le tout avec le template vous avez 2 options.

-------OPTION 1:
soit placer le HTML à l'emplacement indiqué dans le index.html du templace :

<div id="page-content-wrapper">
   <div class="app-main">
      <div class="container-fluid pt-4">

        <!-- CONTENU DE LA PAGE A PLACER ICI -->

      </div>
   </div>
</div>

Les liens vers les autres pages n'ont pas encore été défini. N'oubliez pas de donner des noms clairs 
aux pages pour éviter tout conflit sur le github et dans l'appel aux pages.

-------OPTION 2 (recommandé)
Mettre tous les fichiers avec l'extension .php et fonctionner avec des includes php.


********** SIDE BAR **********

la classe .active permet de rendre un lien actif
la classe .show permet de déplié une section, il faut la placer div du "child menu"

exemple: (les classes sont en majuscule), dans cet exemple nous sommes sur la page de définition des dates d'accès au site au site
et la section "Gestion globale" est déplié grace au SHOW

<!-- .menu-header -->
<li class="menu-header">Gestion globale</li>
<!-- /.menu-header -->
<li class="menu-item has-child">
   <a href="#" class="menu-link " data-bs-toggle="collapse" data-bs-target="#access-collapse" aria-expanded="true">
   <span class="menu-icon fas fa-user-lock"></span>
   <span class="menu-text dropdown-toggle">Accès au site</span>
   </a>
   <!-- child menu -->
   <div class="ml-4 collapse SHOW" id="access-collapse">
      <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
         <li><a href="#" class="link-dark text-muted ACTIVE">Définir les dates</a></li>
         <li><a href="#" class="link-dark text-muted">Accès personalisé</a></li>
         <li><a href="#" class="link-dark text-muted">Gestion des utilisateurs</a></li>
      </ul>
   </div>
</li>


********** CSS & JS ***********

Si vous avez du CSS et du JS que vous souhaitez ajouter, il est fortement recommandé de créer un autre fichier css/js, portant un nom assez parlant des modifications souhaitées, et doit être ajouter dans le dossier correspondant (CSS/JS).
Vous pouvez utiliser toutes les classes bootstrap disponibles sur le site.
Si vous constatez un conflit à l'affichage veuillez le signaler rapidement.

------------ MISE A JOUR A VENIR ----------------

MAJ 1:
La sidebar ne scroll pas et ne reste pas fixe, une mise à jour pourrait survenir dans les jours qui suivent pour corriger le problème.

MAJ 2:
le fichier style.css sera réduit et des ajouts de classes concernant les bouttons seront ajoutés.

********** GITHUB *************
Cette version  du template ne sera pas mise sur github.
Il faudra au préalable créer les différentes branches avant la mise en ligne sur github

-------------------------------------
Merci ;-)
