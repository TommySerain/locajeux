
# Configuration
Dans phpMyAdmin, créer une nouvelle base de donnée et importer la bdd se trouvant dans le dossier data.  
Dans le dossier config, renommer le dossier db-template en db et personnaliser les données.  
# Bases de données
## MCD
### Règles de gestion
+ **Un jeu aura :**
   * un id unique
   * un nom
   * une image carré
   * un fichier
   * un fichier de règle en PDF
   * un identifiant du jeux parents si c'es une extension
   * un prix de location
   * un prix de caution
+ **Un type aura :**
   * un id unique
   * un nom
+ **Une catégorie aura :**
   * un id unique
   * un nom
+ **Un utilisateur aura :**
   * un id unique
   * un nom
   * un prénom
   * un mail
   * un mot de passe
   * une adresse
   * un compteur de jeux loué
+ **Une ville aura :**
   * un id unique
   * un nom
+ **Un jeu aura un et un seul stype**
+ **Un jeu aura une et une seule catégorie**
+ **Un utilisateur pourra louer un ou plusieurs jeux**
+ **Un utilisateur a une et une seule ville**

### Dictionnaire de données
| **Code Mnemonic** | **Description**          | **Type** | **Taille** | **Commentaire**     |
|-------------------|--------------------------|----------|------------|---------------------|
|id_j               | identifiant jeu          | N        | 10         | UNSIGNED            |
|name_j             | nom jeu                  | AN       | 100        |                     |
|img_j              | image jeu                | AN       | 255        | carre (ex: 200*200) |
|rules_j            | règles jeu               | AN       | 255        |                     |
|loc_j              | prix location jeu        | N        | 5          | UNSIGNED            |
|caution_j          | prix caution  jeu        | N        | 5          | UNSIGNED            |
|id_t               | identifiant type         | N        | 10         | UNSIGNED            |
|name_t             | nom type                 | AN       | 100        |                     |
|id_c               | identifiant catégorie    | N        | 10         | UNSIGNED            |
|name_c             | nom catégorie            | AN       | 100        |                     |
|id_u               | identifiant utilisateur  | N        | 10         | UNSIGNED            |
|name_u             | nom utilisateur          | AN       | 100        |                     |
|firstname_u        | prenom utilisateur       | AN       | 100        |                     |
|email_u            | email utilisateur        | AN       | 100        |                     |
|address_u          | address utilisateur      | AN       | 100        |                     |
|mdp_u              | mot de passe utilisateur | AN       | 100        | doit être haché     |
|compteur_u         | compteur jeu utilisateur | N        | 10         |                     |
|id_v               | identifiant ville        | N        | 10         | UNSIGNED            |
|name_v             | nom ville                | AN       | 100        |                     |

### Dépendance fonctionnelles
+ **id_j** ?name_j, img_j, rules_j, loc_jcaution_j
+ **id_t** ? name_t
+ **id_c** ? name_c
+ **id_u** ? name_u, firstname_u, email_u, address_u, mdp_u, compteur_u
+ **id_v** ? name_v

### Schéma MCD
![Schéma MCD](img/mcd.png "MCD")

## MLD
+ types (**id_t**, name_t)
+ categories (**id_c**, name_c)
+ utilisateurs (**id_u**, name_u, firstname_u, email_u, address_u, mdp_u, compteur_u, #id_v)
+ jeux (**id_j**, name_j, img_j, rules_j, loc_j, caution_j, #id_t, #id_c, #id_j_p)
+ l_jeux_utilisateurs (**#id_j**, **#id_u**, note, com)
+ villes (**id_v**, name_v)

## MPD
![Schéma MPD](img/mpd-mysql.png "MPD")

# Création des pages

## Début du projet
J'ai commencé par créer une petite "base de données" en fichier .txt en imaginant qu'un client aurait pu la fournir.  
Je l'ai ensuite importer dans la base de donnée, dans un premier temps grâce à une requête query puis,  
finalement par une requête préparée pour m'exercer sur ces requêtes qui seront plus sécurisés de manière générale.

## Création du moteur de recherche
J'ai d'abord créer le moteur de recherche avec 8 else/elseif pour gérer tous les cas possible.
J'ai finalement mofifié ce moteur de recherche en créant la requête SQL en récupérant les données de la super global GET pour diminuer grandement le nombre de if et simplifier le code

## Création de la page jeu
J'ai créé la page jeu qui affichera toutes les infos du jeu
Pour cela j'ai décidé simplement d'ajouter l'id du jeu voulu dans l'url afin de le récupérer dans le tableau GET
J'ai ensuite ajouté un bouton Louer qui n'apparaitra que si le jeu est disponible et que l'utilisateur est connecté.

## Création de la connexion
J'ai créé un formulaire de connexion dans la modale
le formualire envoie sur la page de connexion qui sert au traitement de la connexion.
J'ai décider d'utiliser la super global SERVER avec [HTTP_REFERER] pour rediriger vers la page précédent la connexion pour améliorer l'experience utilisateur.

## Création de la page déconnexion
Idem que la connexion
j'ai décidé d'utiliser Refresh: 1 dans la redirection pour que l'utilisateur reste 1 seconde sur la page éconnexion afin d'afficher un msg de déco.

## Création de la page mon compte
La page mon compte sert afficher les infos de l'utilisateur connecté.
Elle servira également à indiquer le nombre de jeu que l'utilisateur à loué.

## Création de l'inscription
J'ai créé un formulaire d'inscription dans la modale
le formualire envoie sur la page de inscription qui sert au traitement de l'inscription.
Il a fallut créer plusieurs exceptions pour géer les erreurs tel que un email déjà inscrit, une mauvaise date, un email au mauvais format, l'inscription d'un mineur.
J'ai décidé de créer plusieurs exceptions que j'ai regroupé avec l'exception InscriptionExeption afin de simplifier le code en évitant de multiple catch.

# Modification

## Affichage des jeux sur l'index
J'ai simplement fais un while après la requête SQL pour afficher tous mes jeux.  
Dans un premier temps je n'affichais que les images des jeux et aucunes autres infos.  
Donc aucun soucis jusque là.  
J'ai voulu par la suite ajouter l'info si le jeu est disponible ou non j'ai donc décidé de créer une instance de la class Game avec la méthod isAvailable.  
Ce qui fonctionnait tant que je voulais juste afficher disponible ou non disponible.  
![screen](img/Game.png "screen")
Plus tard j'ai décider d'afficher disponilbe si le jeu l'étais et la date à laquelle il sera dispo dans le cas contraire.  
Et là il y à deux soucis, 1 la class Game n'a pas cette propriété et je me sers de cette class pour autre chose ou il ne faut pas cette propriété,  
                          2 je ne stock cette information nulle part !  
J'ai donc décidé de modifier ma base de donnée : 
  Dans la tale de liaison jeux/utilisateur :
    + ajout d'une colonne date de location
    + ajout d'une colonne date de rendu
    + ajout d'une colonne id de location
Les deux premières vont me servir à stocké les deux dates dont j'ai besoin,  
J'ai eu besoin de la troisième plus tard car j'avais utilisé l'id-utilisateurs+l'id_jeux pour faire une clé composite,  
mais si un joueur loue deux fois le même jeu on se retrouve avec deux fois la même combinaison de clé et donc un doublon de clé primaire.  
j'ai donc eu besoin de créer un identifiant de location pour paliker ce problème.
![nouveau schéma mdp](img/nouveau_mdp.png "MPD")

## beaucoup de refactorisation
J'ai du refactoriser beaucoup de choses, notemment la PDO et tous les fichiers qui faisaient trop de choses différentes.
J'ai créé des classes pour la plupart des refactos mais pour m'exercé j'ai aussi créé quelques fonctions.
Sur la page mon compte, pour essayer différentes méthode, j'ai aussi simplement pris un bout de code que j'ai mis dans un autre fichier, dans template et que j'ai require once à l'endroit voulue. En le faisant je me suis bien rendu compte que ce n'est pas une bonne méthode mais étant en apprentissage, j'ai décidé de laissé ça comme ça pour que quand je reviendrais dessus je puisse revoir les différentes méthodes y compris les moins bonnes.
![mauvaise_méthode-refacto](img/require-template-mon-compte.png "mauvaise-méthode")

## Liens des images et des règles
Pour deux raisons j'ai décicdé de créer des constantes pour les chemins d'accès des images et des règles :  
  * Si je veux changer les fichiers d'emplacement, je n'aurai cas changer le chemain à un endroit.
  * Pour simplifier les valeurs de la base de données, je n'ai plus que les noms des fichiers au lieu d'avoir tout le chemin.

## Modifications de la class Game
Avant, j'étais obligé de donné absolument tous les attributs au moment de l'instanciation d'un nouvel objet Game, j'ai donc fait une refonte de ma class pour n'avoir plus q'uà lui donner un ID et un objet pdo, et le constructeur se charge d'aller chercher toutes les autres infos dans la bdd.
Je lui ai également apporté plusieurs méthodes en lien avec ctte class (par exemple isExtension).  
Par contre j'avais oublié que j'avais utilisé cette class pour importer le fichier text dans ma base de donnée et donc j'ai cassé cette fonctionnalité.
Après réflexion j'ai décidé de supprimer cette fonctionnalité qui n'était pas vraiment utile dans ce projet.
