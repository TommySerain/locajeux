
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
+ *id_j* ?name_j, img_j, rules_j, loc_jcaution_j
+ *id_t* ? name_t
+ *id_c* ? name_c
+ *id_u* ? name_u, firstname_u, email_u, address_u, mdp_u, compteur_u
+ *id_v* ? name_v

### Schéma MCD
![Schéma MCD](img/mcd.png "MCD")
