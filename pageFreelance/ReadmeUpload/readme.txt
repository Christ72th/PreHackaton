           Gestion de Comptes Bancaires en Java

Ce projet Java simule la gestion de comptes clients dans une banque. Il permet de créer différents types de comptes (compte courant, compte épargne, compte sécurisé) et d'effectuer des opérations courantes (dépôt, retrait, calcul d'intérêts).

I- Fonctionnalités

*   **Compte (Classe `Compte`) :**
    *   Représente un compte bancaire de base.
    *   Attributs : numéro de compte (String), propriétaire (String), solde (int).
    *   Constructeur : `Compte(String numero, String proprietaire, int soldeInitial)`
    *   Méthodes : `deposer(int montant)`, `retirer(int montant)`, `getNumero()`, `getProprietaire()`, `getSolde()`.

*   **Compte Épargne (Classe `CompteEpargne`) :**
    *   Hérite de la classe `Compte`.
    *   Attribut supplémentaire : taux d'intérêt annuel (int).
    *   Constructeur : `CompteEpargne(String numero, String proprietaire, int soldeInitial, int tauxInteret)`
    *   Méthode : `appliquerInteret()` (calcule et ajoute les intérêts au solde).

*   **Compte Sécurisé (Classe `CompteSecurise`) :**
    *   Hérite de la classe `Compte`.
    *   Constructeur : `CompteSecurise(String numero, String proprietaire, int soldeInitial)`
    *   Méthode `retirer(int montant)` redéfinie (`@Override`) : vérifie si le solde est suffisant avant d'autoriser le retrait.

II- Prérequis

*   JDK 17 (ou version ultérieure) : [https://adoptium.net/](https://adoptium.net/) (distribution recommandée)
*   Maven (facultatif, mais utile pour gérer les dépendances) : [https://maven.apache.org/](https://maven.apache.org/)
III- Compilation et Exécution

a) Avec un IDE (IntelliJ IDEA, Eclipse, etc.)

1.  Importez le projet dans votre IDE.
2.  Assurez-vous que le JDK 17 est configuré dans les paramètres du projet.
3.  Compilez le projet (généralement, l'IDE le fait automatiquement).
4.  Exécutez la classe `Main` (ou la classe principale de votre programme).

b) Avec Maven (en ligne de commande)

1.  Clonez le dépôt Git (si applicable) : `git clone https://github.com/username/repo.git`
2.  Accédez au répertoire du projet : `cd repo`
3.  Compilez le projet : `mvn compile`
4.  Exécutez le programme : `mvn exec:java -Dexec.mainClass="Main"`

IV- Utilisation

Le programme principal (`Main.java`) propose un menu interactif pour effectuer les opérations suivantes :

1.  Créer un compte (choisir le type : courant, épargne, sécurisé).
2.  Déposer de l'argent.
3.  Retirer de l'argent.
4.  Afficher le solde.
5.  Quitter.
6.  Appliquer les intérêts (pour les comptes épargne).

V- Structure du code

*   `Compte.java` : Définition de la classe `Compte`.
*   `CompteEpargne.java` : Définition de la classe `CompteEpargne`.
*   `CompteSecurise.java` : Définition de la classe `CompteSecurise`.
*   `Main.java` : Programme principal avec le menu interactif.

VI- Améliorations Possibles

*   **Gestion des exceptions :** Utiliser des blocs `try-catch` pour gérer les erreurs potentielles (par exemple, solde insuffisant, numéro de compte invalide).
*   **Interface utilisateur :** Créer une interface graphique (Swing, JavaFX) ou en ligne de commande plus conviviale.
*   **Persistance des données :** Ajouter la possibilité d'enregistrer et de charger les données des comptes (fichiers, base de données).
*   **Validation des entrées :** Valider les entrées utilisateur pour éviter les erreurs (par exemple, vérifier que le numéro de compte est au bon format, que les montants sont positifs).

VII- Auteur

Kenmogne ange glorieuse (23U2490 )
